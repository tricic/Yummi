<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class OrderService
{
    public $order;

    public $errors;
    public $request;

    public $localMode = false;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->errors = collect([]);
    }

    public function handle(): void
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

        $order = new Order();
        $order->user_id = $this->request->user()->id;
        $order->delivery_fee = (float) env('DELIVERY_FEE');
        $order->vat = (float) env('VAT');

        $order->first_name = $this->request->first_name;
        $order->last_name = $this->request->last_name;
        $order->address = $this->request->address;
        $order->city = $this->request->city;
        $order->phone = $this->request->phone;
        $order->notes = $this->request->notes;

        foreach ($cart->items as $itemData)
        {
            $item = Item::find($itemData->id);

            if (empty($item))
            {
                $this->errors->push("Menu item with ID $itemData->id not found. Please try re-populating your cart.");
                break;
            }

            $orderItem = new OrderItem();
            $orderItem->item = $item;
            $orderItem->order = $order;
            $orderItem->quantity = $itemData->quantity;
            $orderItem->price = $item->price;

            $order->order_items->push($orderItem);
        }

        $this->order = $order;
        $this->order->calculateTotalPrice(false);

        if (!$this->localMode)
        {
            $this->order = self::createOrder($order->toArray());
        }
    }

    public static function createOrder(array $orderData): Order
    {
        $order = Order::create($orderData);

        foreach ($orderData['order_items'] as $orderItemData)
        {
            $orderItemData['item_id'] = $orderItemData['item']['id'];
            $order->order_items()->create($orderItemData);
        }

        return $order;
    }
}
