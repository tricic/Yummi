@extends('layouts.app')

@section('title', 'Delivery info')

@section('content')
<form class="order-delivery card" action="{{ route('order.checkout') }}" method="POST">
    @csrf
    <input type="hidden" id="input-cart" name="cart">
    <script>
        $("#input-cart").val(localStorage.getItem('cart'));
    </script>

    <div class="card-header">
        <h4 class="m-0">Delivery
            <a href="{{ route('menu') }}" class="btn btn-sm btn-outline-secondary" style="float: right;">Back to menu</a>
        </h4>
    </div>

    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>First name</label>
                <input required name="first_name" type="text" class="form-control" placeholder="John">
            </div>

            <div class="form-group col-md-6">
                <label>Last name</label>
                <input required name="last_name" type="text" class="form-control" placeholder="Doe">
            </div>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input required name="address" type="text" class="form-control" placeholder="1234 Main St">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>City</label>
                <input required name="city" type="text" class="form-control" placeholder="Springfield">
            </div>

            <div class="form-group col-md-6">
                <label>Phone</label>
                <input required name="phone" type="text" class="form-control" placeholder="123 456 789" pattern="^(?=.*\d)[\d ]+$">
            </div>
        </div>

        <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" rows="3" class="form-control"></textarea>
        </div>

        {{-- @guest
            <hr>
            <div class="form-row">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            I want to register an account
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
            </div>
        @endguest --}}
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary px-5">Checkout</button>
    </div>
</form>
@endsection
