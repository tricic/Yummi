<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;

class OrderBuilderService
{
    /** @var array */
    public $data;

    /** @var \Illuminate\Support\Collection */
    public $errors;

    /** @var \App\Models\Order */
    public $order;

    /** @var bool */
    public $isValidCart = true;

    /** @var bool */
    public $isNotEmptyCart = true;

    /** @var bool */
    public $areValidItems  = true;

    /** @var bool */
    public $isValidDelivery = true;

    public function __construct(array $data = [])
    {
        $this->data = $data;
        $this->errors = collect([]);
    }

    public static function make(...$args): OrderBuilderService
    {
        return new OrderBuilderService($args);
    }

    public function build(): void
    {
        $cart = json_decode($this->data['cart'] ?? '');

        if ($cart === null)
        {
            $this->isValidCart = false;
            $this->errors->push('Invalid cart JSON data.');
            return;
        }

        if (empty($cart->items))
        {
            $this->isNotEmptyCart = false;
            $this->errors->push('Cart is empty.');
            return;
        }

        $this->order = new Order();
        $this->order->user_id      = auth()->user()->id ?? null;
        $this->order->delivery_fee = floatval(env('DELIVERY_FEE'));
        $this->order->vat          = floatval(env('VAT'));

        $this->order->first_name = @$this->data['first_name'];
        $this->order->last_name  = @$this->data['last_name'];
        $this->order->address    = @$this->data['address'];
        $this->order->city       = @$this->data['city'];
        $this->order->phone      = @$this->data['phone'];
        $this->order->notes      = @$this->data['notes'];

        $this->validateDeliveryInfo();

        foreach ($cart->items as $itemData)
        {
            $item = Item::find($itemData->id);

            if (empty($item))
            {
                $this->areValidItems = false;
                $this->errors->push("Menu item with ID $itemData->id not found. Please try re-populating your cart.");
                break;
            }

            $this->order->order_items->push(new OrderItem([
                'item_id' => $item->id,
                'quantity' => $itemData->quantity,
                'price' => $item->price
            ]));
        }

        $this->order->calculateTotalPrice(false);
    }

    public function hasErrors(): bool
    {
        return $this->errors->isNotEmpty();
    }

    public function save(): void
    {
        $this->order->save();

        foreach ($this->order->order_items as $orderItem)
        {
            $orderItem->order_id = $this->order->id;
            $orderItem->save();
        }

        event(new OrderCreated($this->order));
    }

    protected function validateDeliveryInfo(): void
    {
        if (empty($this->order->first_name))
        {
            $this->isValidDelivery = false;
            $this->errors->push('First name must not be empty.');
        }

        if (empty($this->order->last_name))
        {
            $this->isValidDelivery = false;
            $this->errors->push('Last name must not be empty.');
        }

        if (empty($this->order->address))
        {
            $this->isValidDelivery = false;
            $this->errors->push('Address must not be empty.');
        }

        if (empty($this->order->city))
        {
            $this->isValidDelivery = false;
            $this->errors->push('City must not be empty.');
        }

        if (empty($this->order->phone))
        {
            $this->isValidDelivery = false;
            $this->errors->push('Phone number must not be empty.');
        }
    }
}
