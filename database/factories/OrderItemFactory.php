<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => $this->faker->numberBetween(1, Order::count()),
            'item_id' => $this->faker->numberBetween(1, Item::count()),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(null, 5, 10)
        ];
    }
}
