@extends('layouts.app')

@section('title', 'Order history')


@section('content')
<div class="order-history row">
    @foreach ($orders as $order)
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="mb-0">
                        Order #{{ $order->id }}
                        <button disabled type="button" class="btn btn-sm btn-outline-secondary float-right">Order again</button>
                    </h4>
                </div>
                <div class="card-body">
                    <div>
                        <div>Date: <b>{{ $order->created_at }}</b></div>
                        <div>Total price: <b>{{ number_format($order->total_price, 2) }}</b> <b class="currency">USD</b></div>
                    </div>

                    <hr>

                    <div>
                        @foreach ($order->order_items as $orderItem)
                            {{ $orderItem->quantity }} x {{ $orderItem->item->name }} ({{ $orderItem->item->size }})
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div
@endsection
