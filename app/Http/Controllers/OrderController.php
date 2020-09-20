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
        $orderBuilder->data = $request->all();
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

        // ...
        // Payment logic...
        // ...

        $orderBuilder->save();
        $request->session()->remove('order');

        return redirect(null, 200)->route('order.success', $order);
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
