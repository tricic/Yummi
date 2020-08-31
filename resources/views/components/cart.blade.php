<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
<form id="cart" class="card" action="{{ route('checkout') }}" method="POST">
    <div class="card-header">
        <h4 class="m-0">
            Cart
            <button type="button" onclick="cart.empty()" class="btn btn-sm btn-outline-danger" style="float: right;"><i class="fas fa-trash-alt"></i></button>
        </h4>
    </div>

    <div class="card-body">
        <div class="cart-items">
            <template class="cart-item-template">
                <div class="cart-item row mb-2">
                    <button type="button" class="cart-item-remove text-danger btn p-0">
                        <i class="fas fa-times-circle"></i>
                    </button>
                    <div class="col-3 pr-0 d-flex align-items-center">
                        <input type="number" name="" class="cart-item-quantity form-control" min="0" max="99">
                    </div>
                    <div class="col">
                        <div class="cart-item-name m-0 font-weight-bold">null</div>
                        <small>Size: <span class="cart-item-size">null</span></small>
                    </div>
                    <div class="col-3 pl-0 h6 d-flex align-items-center text-right">
                        <span class="cart-item-price d-inline pr-3">0.00</span>
                    </div>
                </div>
            </template>
        </div>

        <hr>

        <div class="text-right">
            <div class="h6">Delivery fee: <span class="cart-delivery-fee">0.00</span></div>
            <div class="h4 mb-0">Total: <span class="cart-total-price">0.00</span> <span class="cart-currency">USD</span></div>
        </div>
    </div>
    <div class="card-footer">
        @csrf
        <input type="hidden" id="data-input" name="data">
        <button type="submit" onclick="$('#data-input').val(JSON.stringify(cart.data))" class="cart-checkout-button btn btn-primary form-control">Checkout</button>
    </div>
</form>

<script src="{{ asset('js/Cart.js') }}"></script>
<script>
$(document).ready(function() {
    cart = new Cart($("#cart"), 1);
});
</script>

