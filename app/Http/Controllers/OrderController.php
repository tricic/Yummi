<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderBuilderService as OrderBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('history');
    }

    public function delivery(Request $request): View
    {
        return view('order.delivery', ['user' => $request->user()]);
    }

    public function checkout(Request $request, OrderBuilder $orderBuilder)
    {
        $orderBuilder->build();

        if ($orderBuilder->hasErrors())
        {
            return back()->with('danger', $orderBuilder->errors->toArray());
        }

        $request->session()->put('order', serialize($orderBuilder->order));

        return view('order.checkout', ['order' => $orderBuilder->order]);
    }

    public function pay(Request $request, OrderBuilder $orderBuilder): RedirectResponse
    {
        $order = unserialize($request->session()->get('order'));

        $orderBuilder->order = $order;

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
            $orderBuilder->save();

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
        $orders = $request->user()->orders()->with('order_items.item')->orderBy('id', 'desc')->get();

        return view('order.history', ['orders' => $orders]);
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
