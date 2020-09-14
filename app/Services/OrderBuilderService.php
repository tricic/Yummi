<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderBuilderService
{
    public $order;

    public $errors;
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->errors = collect([]);
    }

    public function build(): void
    {
        $cart = json_decode($this->request->cart);

        if ($cart === null)
        {
            $this->errors->push('Invalid request.');
            return;
        }

        if (empty($cart->items))
        {
            $this->errors->push('Cart is empty.');
            return;
        }

        $this->order = $order = new Order();
        $order->user_id = $this->request->user()->id ?? null;
        $order->delivery_fee = (float) env('DELIVERY_FEE');
        $order->vat = (float) env('VAT');

        $order->first_name = $this->request->first_name;
        $order->last_name = $this->request->last_name;
        $order->address = $this->request->address;
        $order->city = $this->request->city;
        $order->phone = $this->request->phone;
        $order->notes = $this->request->notes;

        $this->validateDeliveryInfo();

        foreach ($cart->items as $itemData)
        {
            $item = Item::find($itemData->id);

            if (empty($item))
            {
                $this->errors->push("Menu item with ID $itemData->id not found. Please try re-populating your cart.");
                break;
            }

            $order->order_items->push(new OrderItem([
                'item_id' => $item->id,
                'quantity' => $itemData->quantity,
                'price' => $item->price
            ]));
        }

        $order->calculateTotalPrice(false);
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

    public function hasErrors(): bool
    {
        return $this->errors->isNotEmpty();
    }

    protected function validateDeliveryInfo(): void
    {
        if (empty($this->order->first_name)) $this->errors->push('First name must not be empty.');
        if (empty($this->order->last_name))  $this->errors->push('Last name must not be empty.');
        if (empty($this->order->address))    $this->errors->push('Address must not be empty.');
        if (empty($this->order->city))       $this->errors->push('City must not be empty.');
        if (empty($this->order->phone))      $this->errors->push('Phone number must not be empty.');
    }
}
