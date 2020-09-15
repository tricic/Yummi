<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 month');

        return [
            'created_at' => $date,
            'updated_at' => $date,

            'user_id' => $this->faker->numberBetween(1, User::count()),
            'vat' => 10,
            'delivery_fee' => 1,

            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'notes' => $this->faker->sentence
        ];
    }
}
