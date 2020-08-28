<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'vat', 'delivery_fee', 'total_price', 'first_name', 'last_name', 'address', 'city', 'phone', 'notes'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getItemsCount(): int
    {
        return $this->order_items->count();
    }

    public function getSubTotal(): float
    {
        return $this->total_price - $this->delivery_fee - $this->getVatValue();
    }

    public function getVatValue(): float
    {
        return $this->total_price * ($this->vat / 100);
    }

    public function calculateTotalPrice(bool $updateAttribute = true): float
    {
        $total = $this->delivery_fee;

        foreach ($this->order_items as $orderItem)
        {
            $total += $orderItem->quantity * $orderItem->price;
        }

        if ($updateAttribute)
        {
            $this->update(['total_price' => $total]);
        }

        return $total;
    }
}
