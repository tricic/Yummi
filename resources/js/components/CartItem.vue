<template>
    <div class="cart-item row mb-2">
        <button @click="remove" type="button" class="cart-item-remove text-danger btn p-0">
            <i class="fas fa-times-circle"></i>
        </button>

        <div class="col-3 pr-0 d-flex align-items-center">
            <input v-model="item.quantity" @blur="onFocusLost" type="number" class="cart-item-quantity form-control" min="0" max="99">
        </div>

        <div class="col">
            <div class="cart-item-name m-0 font-weight-bold">{{ item.name }}</div>
            <small>
                Size:
                <span class="cart-item-size">{{ item.size }}</span>
            </small>
        </div>

        <div class="col-3 pl-0 h6 d-flex align-items-center text-right">
            <span class="cart-item-price d-inline pr-3">{{ total | toCurrency }}</span>
        </div>
    </div>
</template>

<script>
import Bootbox from 'bootbox';

export default {
    props: {
        item: Object,
        index: Number
    },
    computed: {
        total: function() {
            return this.item.price * this.item.quantity;
        }
    },
    methods: {
        remove: function() {
            this.$root.$emit('removeFromCart', this.index);
        },
        confirmRemove: function(oldQty) {
            let self = this;
            Bootbox.confirm({
                animate: false,
                centerVertical: true,
                message: `Remove ${self.item.name} (${self.item.size}) from cart?`,
                callback: function (result) {
                    if (result)
                        self.remove();
                    else
                        self.item.quantity = oldQty > 0 ? oldQty : 1;
                }
            });
        },
        onFocusLost: function(e) {
            let qty = Number(this.item.quantity);
            if (qty == 0 || qty == NaN)
            {
                this.item.quantity = 1;
            }
        }
    },
    watch: {
        'item.quantity': function(newQty, oldQty) {
            if (newQty == '')
                return;

            if (newQty < 1)
                this.confirmRemove(oldQty);
        }
    }
}
</script>

<style lang="scss" scoped>
input {
    padding-left: .5rem;
    padding-right: .5rem;
}

.cart-item-name {
    line-height: normal;
}

.cart-item-quantity {
    margin-top: 6px;
}
</style>
