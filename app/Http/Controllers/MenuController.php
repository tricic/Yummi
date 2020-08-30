<?php

namespace App\Http\Controllers;

use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with('item_parents.items')->get();

        return view('menu.index', ['categories' => $categories]);
    }
}
