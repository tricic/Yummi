@extends('layouts.app')

@section('title', 'Checkout')

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/money.js/0.1.3/money.min.js" integrity="sha512-wONtKxSNySBmha5jvJFjqWxzHFI4y5bGfPCz5B1VWvUrCf9xxOvlPaiGVG5a0LSvaKYoThRofSyt10mnHGw0GA==" crossorigin="anonymous"></script>
@endpush

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
            <b>Notes:</b> {{ $order->notes }}
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
                        <td class="text-right">
                            <span class="price" data-usd="{{ $orderItem->total }}">
                                {{ number_format($orderItem->total, 2) }}
                            </span>
                            <span class="currency">USD</span>
                        </td>
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
                    Delivery fee:
                    <span class="price" data-usd="{{ $order->delivery_fee }}">
                        {{ number_format($order->delivery_fee, 2) }}
                    </span>
                    <span class="currency">USD</span>
                </div>

                <div class="h6 font-weight-normal">
                    VAT ({{ $order->vat }}%):
                    <span class="price" data-usd="{{ $order->vat_amount }}">
                        {{ number_format($order->vat_amount, 2) }}
                    </span>
                    <span class="currency">USD</span>
                </div>

                <hr class="my-2">

                <div class="h5 mb-0">
                    Total:
                    <span class="price" data-usd="{{ $order->total_price }}">
                        {{ number_format($order->total_price, 2) }}
                    </span>
                    <span class="currency">USD</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer text-right">
        <select name="currency" id="input-currency" class="form-control d-inline-block pr-5" style="width: auto;">
            <option>USD</option>
            <option>EUR</option>
        </select>
        <button type="submit" class="btn btn-primary px-5 ml-3">Pay order</button>
    </div>
</form>
<script>
document.addEventListener('DOMContentLoaded', function(event) {
    fx.base = '{{ env('BASE_CURRENCY') }}';
    fx.rates = {
        'EUR': {{ env('USD_EUR_EXCHANGE_RATE') }}
    };

    $('#input-currency').on('change', function () {
        let currency = $(this).val();

        if (['USD', 'EUR'].includes(currency) == false)
        {
            return console.log('ERR: Unsupported currency.');
        }

        $('.price').each(function () {
            let usd = parseFloat($(this).data('usd'));
            let convertedPrice = fx(usd).from('USD').to(currency);

            $(this).text(convertedPrice.toFixed(2));
            $('.currency').text(currency);
        });
    });
});
</script>
@endsection
