<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ItemParent;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with('item_parents.items')->get();

        return view('menu.index', ['categories' => $categories]);
    }

    public function search(Request $request): View
    {
        $itemParents = ItemParent::where('name', 'LIKE', "%$request->q%")->with('items')->get();

        return view('menu.search', [
            'q' => $request->q,
            'itemParents' => $itemParents
        ]);
    }
}
