@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<form class="order-checkout card" action="{{ route('order.pay') }}" method="POST">
    @csrf

    <div class="card-header">
        <h4 class="m-0">
            Checkout
            <a href="{{ route('order.delivery') }}" class="btn btn-sm btn-outline-secondary" style="float: right;">Back to delivery</a>
        </h4>
    </div>

    <div class="card-body">
        <div class="delivery-data mb-4">
            <b>Deliver to:</b> {{ $order->first_name }} {{ $order->last_name }}, {{ $order->address }}, {{ $order->city }}
            <br>
            <b>Contact:</b> {{ $order->phone }}
            <br>
            <b>Note:</b> {{ $order->notes }}
        </div>

        <div class="cart-data">
            <table class="table mb-0">
                <thead class="">
                    <tr>
                        <th>Qty.</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_items as $orderItem)
                    <tr>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>{{ $orderItem->item->name }}</td>
                        <td>{{$orderItem->item->size}}</td>
                        <td class="text-right">{{ number_format($orderItem->total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right">
                <small>* VAT included</small>
            </div>

            <hr class="my-2">

            <div class="text-right">
                <div class="h6 font-weight-normal">
                    Delivery fee: {{ number_format($order->delivery_fee, 2) }} <span class="currency">USD</span>
                </div>

                <div class="h6 font-weight-normal">
                    VAT ({{ $order->vat }}%): {{ number_format($order->vat_amount, 2) }} <span class="currency">USD</span>
                </div>

                <hr class="my-2">

                <div class="h5">
                    Total: {{ number_format($order->total_price, 2) }} <span class="currency">USD</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary px-5">Pay & Finish</button>
    </div>
</form>
@endsection
