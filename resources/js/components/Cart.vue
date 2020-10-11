<template>
    <div id="cart" class="card">
        <div class="card-header">
            <h4 class="m-0">
                Cart
                <button type="button" @click="empty" class="btn btn-sm btn-outline-danger" style="float: right;"><i class="fas fa-trash-alt"></i></button>
            </h4>
        </div>

        <div class="card-body">
            <div class="cart-items">
                <cart-item v-for="(item, index) in items" :key="item.id" :item="item" :index="index" />
            </div>

            <hr>

            <div class="text-right">
                <div class="h6">Delivery fee: {{ deliveryFee | toCurrency }}</div>
                <div class="h4 mb-0">Total: {{ total | toCurrency }} <span class="cart-currency">USD</span></div>
            </div>
        </div>

        <div class="card-footer">
            <a href="order/delivery" class="cart-checkout-button btn btn-primary form-control" :class="{ disabled: isEmpty }">Checkout</a>
        </div>
    </div>
</template>

<script>
import CartItem from './CartItem';

export default {
    components: {
        CartItem
    },
    props: [
        'deliveryFee'
    ],
    data: function() {
        return {
            items: Array
        }
    },
    mounted: function() {
        this.loadData();
        this.$root.$on('addToCart', (item) => this.add(item));
        this.$root.$on('removeFromCart', (index) => this.remove(index));
    },
    computed: {
        isEmpty: function() {
            return this.items.length == 0;
        },
        total: function() {
            let total = parseFloat(this.deliveryFee);

            for (let i = 0; i < this.items.length; ++i)
            {
                if (this.items[i] instanceof Object)
                {
                    total += parseFloat(this.items[i].price) * this.items[i].quantity;
                }
            }

            return total;
        }
    },
    methods: {
        add: function(item, quantity = 1) {
            let existingItem = this.find(item);

            if (existingItem === false)
            {
                this.items.push({
                    id: Number(item.id),
                    name: String(item.name),
                    price: Number(item.price),
                    size: String(item.size),
                    quantity: Number(quantity)
                });
            }
            else
            {
                existingItem.item.quantity++;
            }
        },
        remove: function(index) {
            this.items.splice(index, 1);
        },
        empty: function() {
            this.items = [];
        },
        find: function(item) {
            for (let i = 0; i < this.items.length; ++i)
            {
                if (this.items[i].id == item.id)
                {
                    return {
                        index: i,
                        item: this.items[i]
                    };
                }
            }

            return false;
        },
        loadData: function() {
            let cart = JSON.parse(localStorage.getItem('cart'));

            if (cart == null)
                this.items = [];
            else
                this.items = cart.items ?? [];
        },
        saveData: function() {
            localStorage.setItem('cart', JSON.stringify({
                updated: new Date().toLocaleDateString(),
                items: this.items
            }));
        }
    },
    watch: {
        items: {
            deep: true,
            handler: function() {
                this.saveData();
            }
        }
    }
}
</script>
