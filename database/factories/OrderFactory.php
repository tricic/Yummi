<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'created_at' => now(),
        'updated_at' => now(),

        'user_id' => User::inRandomOrder()->first(),
        'vat' => 10,
        'delivery_fee' => 1,

        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'notes' => $faker->text
    ];
});
