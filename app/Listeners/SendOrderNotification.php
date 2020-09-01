<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderNotification implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(OrderCreated $event)
    {
        // TODO: Send e-mail notification to customer and restaurant
    }
}
