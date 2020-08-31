class Cart
{
    constructor($cart, deliveryFee)
    {
        this.deliveryFee = parseFloat(deliveryFee);
        this.$cart = $cart;
        this.$items = $cart.find('.cart-items');
        this.$template = $cart.find('.cart-item-template');
        this.$checkoutButton = $cart.find('.cart-checkout-button');

        this.load();
        this.init();
    }

    load()
    {
        this.data = JSON.parse(localStorage.getItem('cart')) ?? { items: [] };
    }

    save()
    {
        localStorage.setItem('cart', JSON.stringify(this.data));
    }

    init()
    {
        for (let i = 0; i < this.data.items.length; ++i)
        {
            let item = this.data.items[i];
            this.renderItem(item);
        }

        let $deliveryFee = this.$cart.find('.cart-delivery-fee');
        $deliveryFee.text(this.deliveryFee.toFixed(2));

        this.calculateTotalPrice();
    }

    containsItem(item)
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
            bootbox.confirm(`Remove ${item.name} (${item.size}) from cart?`, function(result) {
                if (result)
                {
                    self.removeItem(item);
                }
                else
                {
                    let index = self.containsItem(item);
                    let originalItem = self.data.items[index];
                    self.addItem(originalItem, originalItem.quantity, true);
                }
            });

            return;
        }

        let index = this.containsItem(item);

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
        this.save();
    }

    removeItem(item)
    {
        let index = this.containsItem(item);

        if (index !== false)
        {
            this.data.items.splice(index, 1);
            this.$item(item).remove();

            this.calculateTotalPrice();
            this.save();
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
            $item.find('.cart-item-name').text(item.name);
            $item.find('.cart-item-size').text(item.size);
            $item.find('.cart-item-quantity').val(item.quantity);
            $item.find('.cart-item-price').text((item.price * item.quantity).toFixed(2));
        }
        else
        {
            let self = this;
            let $newItem = this.$template.contents().clone();

            $newItem.attr('data-id', item.id);
            $newItem.attr('id', `cart-item-${item.id}`);

            $newItem.find('.cart-item-name').text(item.name);
            $newItem.find('.cart-item-size').text(item.size);
            $newItem.find('.cart-item-quantity').val(item.quantity);
            $newItem.find('.cart-item-price').text((item.price * item.quantity).toFixed(2));

            $newItem.find('.cart-item-remove').on('click', function() {
                self.removeItem(item);
            });

            $newItem.find('.cart-item-quantity').on('change', function () {
                let qty = parseFloat($(this).val());
                self.addItem(item, qty, true);
            });

            this.$items.append($newItem);
        }
    }

    calculateTotalPrice()
    {
        let totalPrice = this.deliveryFee;

        this.$cart.find('.cart-item-price').each(function () {
            totalPrice += parseFloat($(this).text());
        });

        this.$cart.find('.cart-total-price').text(totalPrice.toFixed(2));

        this.data.jsTotalPrice = totalPrice;
    }

    empty()
    {
        this.data = { items: [] };
        this.$cart.find('.cart-item').remove();
        this.$checkoutButton.prop('disabled', true);

        this.calculateTotalPrice();
        this.save()
    }

    isEmpty()
    {
        return this.data.items.length == 0;
    }

    $item(item)
    {
        return this.$cart.find(`#cart-item-${item.id}`);
    }
}
