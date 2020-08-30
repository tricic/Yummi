<?php

namespace App\View\Components;

use App\Models\ItemParent;
use Illuminate\View\Component;
use Illuminate\View\View;

class MenuItem extends Component
{
    public $itemParent;
    public $items;

    public function __construct(ItemParent $itemParent)
    {
        $this->itemParent = $itemParent;
        $this->items = $itemParent->items;
    }

    public function render(): View
    {
        return view('components.menu-item');
    }
}
