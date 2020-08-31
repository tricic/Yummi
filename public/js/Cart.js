class Cart
{
    constructor($cart, deliveryFee)
    {
        this.$cart = $cart;
        this.deliveryFee = parseFloat(deliveryFee);

        this.LOCAL_STORAGE_KEY = 'cart';
        this.ITEM_ID_PREFIX = 'cart-item-';
        this.Q_ITEM_TEMPLATE = '.cart-item-template';
        this.Q_ITEMS = '.cart-items';
        this.Q_ITEM = '.cart-item';
        this.Q_ITEM_NAME = '.cart-item-name';
        this.Q_ITEM_SIZE = '.cart-item-size';
        this.Q_ITEM_QUANTITY = '.cart-item-quantity';
        this.Q_ITEM_PRICE = '.cart-item-price';
        this.Q_ITEM_REMOVE = ".cart-item-remove";
        this.Q_DELIVERY_FEE = '.cart-delivery-fee';
        this.Q_TOTAL_PRICE = '.cart-total-price';
        this.Q_CHECKOUT_BUTTON = '.cart-checkout-button';
    }

    loadData()
    {
        this.data = JSON.parse(localStorage.getItem(this.LOCAL_STORAGE_KEY)) ?? { items: [] };
    }

    saveData()
    {
        localStorage.setItem(this.LOCAL_STORAGE_KEY, JSON.stringify(this.data));
    }

    setup()
    {
        this.$checkoutButton = this.$cart.find(this.Q_CHECKOUT_BUTTON);
        this.$deliveryFee = this.$cart.find(this.Q_DELIVERY_FEE);
        this.$items = this.$cart.find(this.Q_ITEMS);
        this.$template = this.$cart.find(this.Q_ITEM_TEMPLATE);
        this.$totalPrice = this.$cart.find(this.Q_TOTAL_PRICE);

        this.loadData();

        this.data.items.forEach(item => this.renderItem(item));
        this.$deliveryFee.text(this.deliveryFee.toFixed(2));

        this.calculateTotalPrice();
    }

    findItem(item)
    {
        return this.data.items.find(i => i.id == item.id) ?? false;
    }

    findItemIndex(item)
    {
        for (let i = 0; i < this.data.items.length; i++)
        {
            if (this.data.items[i].id == item.id)
            {
                return i;
            }
        }

        return false;
    }

    addItem(item, quantity = 1, overwriteQuantity = false)
    {
        let self = this;

        if (quantity < 1 && overwriteQuantity)
        {
            bootbox.confirm(`Remove ${item.name} (${item.size}) from cart?`, function (shouldRemove) {
                if (shouldRemove)
                {
                    self.removeItem(item);
                }
                else
                {
                    let originalItem = self.findItem(item);
                    self.addItem(originalItem, originalItem.quantity, true);
                }
            });

            return;
        }

        let index = this.findItemIndex(item);

        if (index !== false)
        {
            if (overwriteQuantity)
            {
                this.data.items[index].quantity = quantity;
            }
            else
            {
                this.data.items[index].quantity += quantity;
            }

            item = this.data.items[index];
        }
        else
        {
            item = {
                'id': item.id,
                'name': item.name,
                'size': item.size,
                'price': item.price,
                'quantity': quantity
            };

            this.data.items.push(item);
        }

        this.$checkoutButton.prop('disabled', false);

        this.renderItem(item);
        this.calculateTotalPrice();
        this.saveData();
    }

    removeItem(item)
    {
        let index = this.findItemIndex(item);

        if (index !== false)
        {
            this.data.items.splice(index, 1);
            this.$item(item).remove();

            this.calculateTotalPrice();
            this.saveData();
        }
        else
        {
            console.log('ERR! removeItem(): Item not found.');
        }

        if (this.data.items.length == 0)
        {
            this.empty();
        }
    }

    renderItem(item)
    {
        let $item = this.$item(item);

        if ($item.length)
        {
            $item.find(this.Q_ITEM_NAME).text(item.name);
            $item.find(this.Q_ITEM_SIZE).text(item.size);
            $item.find(this.Q_ITEM_QUANTITY).val(item.quantity);
            $item.find(this.Q_ITEM_PRICE).text((item.price * item.quantity).toFixed(2));
        }
        else
        {
            let self = this;
            let $newItem = this.$template.contents().clone();

            $newItem.attr('id', this.ITEM_ID_PREFIX + item.id);
            $newItem.find(this.Q_ITEM_NAME).text(item.name);
            $newItem.find(this.Q_ITEM_SIZE).text(item.size);
            $newItem.find(this.Q_ITEM_QUANTITY).val(item.quantity);
            $newItem.find(this.Q_ITEM_PRICE).text((item.price * item.quantity).toFixed(2));

            $newItem.find(this.Q_ITEM_REMOVE).on('click', function() {
                self.removeItem(item);
            });

            $newItem.find(this.Q_ITEM_QUANTITY).on('change', function () {
                let qty = parseFloat($(this).val());
                self.addItem(item, qty, true);
            });

            this.$items.append($newItem);
        }

        this.$checkoutButton.prop('disabled', false);
    }

    empty()
    {
        this.data = { items: [] };
        this.$cart.find(this.Q_ITEM).remove();
        this.$checkoutButton.prop('disabled', true);

        this.calculateTotalPrice();
        this.saveData()
    }

    isEmpty()
    {
        return this.data.items.length == 0;
    }

    calculateTotalPrice()
    {
        let totalPrice = this.deliveryFee;

        this.$cart.find(this.Q_ITEM_PRICE).each(function () {
            totalPrice += parseFloat($(this).text());
        });

        this.$totalPrice.text(totalPrice.toFixed(2));

        this.data.jsTotalPrice = totalPrice;
    }

    $item(item)
    {
        return this.$cart.find('#' + this.ITEM_ID_PREFIX + item.id);
    }
}
