<?php

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = factory(Order::class, 50)->create();

        foreach ($orders as $order)
        {
            factory(OrderItem::class, random_int(1, 5))->create([
                'order_id' => $order
            ]);

            $order->calculateTotalPrice();
        }
    }
}
