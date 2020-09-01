<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function checkout(Request $request, OrderService $orderService)
    {
        $orderService->localMode = true;
        $orderService->handle();

        if ($orderService->errors->isNotEmpty())
        {
            return redirect()->route('menu')->with('danger', $orderService->errors->toArray());
        }

        $order = $orderService->order;

        $request->session()->put('order', serialize($order->toArray()));

        return view('order.checkout', [
            'order' => $order
        ]);
    }

    public function delivery(Request $request): View
    {
        return view('order.delivery', ['user' => $request->user()]);
    }

    public function pay(Request $request): RedirectResponse
    {
        $orderData = unserialize($request->session()->get('order'));

        // Payment logic should go here...
        // $payment->setAmount($order->total_price);
        // ...
        // $paymentSuccess = $payment->process();

        $paymentSuccess = true;

        if (!$paymentSuccess)
        {
            return redirect(null, 500)->route('order.failed');
        }

        try
        {
            $order = OrderService::createOrder($orderData);

            $request->session()->remove('order');

            return redirect(null, 200)->route('order.success', $order);
        }
        catch (\Exception $e)
        {
            if (config('app.debug'))
            {
                throw $e;
            }
            else
            {
                // Refund payment here
                return redirect(null, 500)->route('order.failed');
            }
        }
    }

    public function history(Request $request): View
    {
        abort_if(!$request->user(), 401);

        $orders = $request->user()->orders()->with('order_items.item')->orderBy('id', 'desc')->get();

        return view('order.history', [
            'orders' => $orders
        ]);
    }

    public function success(Order $order): View
    {
        return view('order.success', ['order' => $order]);
    }

    public function failed(): View
    {
        return view('order.failed');
    }
}
