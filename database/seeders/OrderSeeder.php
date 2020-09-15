<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = Order::factory()->count(50)->create();
        $orders->each(function ($order) {
            OrderItem::factory()->count(random_int(2, 5))->create([
                'order_id' => $order
            ]);

            $order->calculateTotalPrice();
        });
    }
}
