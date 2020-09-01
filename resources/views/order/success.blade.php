@extends('layouts.app')

@section('content')
<div class="text-center py-5">
    <div class="lead">
        Thank you for the order!
    </div>

    <hr>

    <div>
        <p>The order ID is: {{ $order->id }}</p>
        <p>Your order will be delivered with 40mins!</p>
    </div>

    <a href="{{ route('menu') }}" class="btn btn-primary">Back to menu</a>
</div>
<script>
    localStorage.clear('cart');
</script>
@endsection
