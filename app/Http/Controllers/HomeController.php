<?php

namespace App\Http\Controllers;

use App\Models\ItemParent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $itemParents = ItemParent::with('items')->get();

        return view('home', ['itemParents' => $itemParents]);
    }
}
