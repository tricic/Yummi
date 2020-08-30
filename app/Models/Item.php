<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'item_parent_id', 'size', 'price'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ItemParent::class, null, null, 'item_parent');
    }
}
