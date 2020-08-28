<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => Order::inRandomOrder()->first(),
        'item_id' => Item::inRandomOrder()->first(),
        'quantity' => $faker->numberBetween(1, 5),
        'price' => $faker->randomFloat(null, 5, 10)
    ];
});
