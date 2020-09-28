<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $appends = [
        'name'
    ];

    protected $casts = [
        'price' => 'float'
    ];

    protected $fillable = [
        'item_parent_id', 'size', 'price'
    ];

    protected $with = [
        'parent'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ItemParent::class, null, null, 'item_parent');
    }

    public function getNameAttribute(): string
    {
        return $this->parent->name;
    }
}
