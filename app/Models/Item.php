<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = [
        'item_parent_id', 'size', 'price'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ItemParent::class, null, null, 'item_parent');
    }
}
