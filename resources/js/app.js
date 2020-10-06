require('./bootstrap');

import Vue from 'vue';
import Cart from './components/Cart';

Vue.filter('toCurrency', function(value) {
    let val = (value / 1).toFixed(2).replace('.', ',');
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

window.vue = new Vue({
    el: '#app',
    components: {
        Cart
    },
    methods: {
        addToCart: function(item) {
            this.$root.$emit('addToCart', item);
        }
    },
});
