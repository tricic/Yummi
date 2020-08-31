<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // TODO
    }

    public function history(Request $request): View
    {
        if (!$request->user())
        {
            return abort(401, 'Login to your account to see your order history.');
        }

        $orders = $request->user()->orders()->with('order_items.item')->orderBy('id', 'desc')->get();

        return view('order.history', [
            'orders' => $orders
        ]);
    }
}
