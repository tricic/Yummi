<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [MenuController::class, 'index'])->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');

Route::get('order/delivery', [OrderController::class, 'delivery'])->name('order.delivery');
Route::post('order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('order/history', [OrderController::class, 'history'])->name('order.history');
Route::post('order/pay', [OrderController::class, 'pay'])->name('order.pay');
Route::get('order/success/{order}', [OrderController::class, 'success'])->name('order.success');
Route::get('order/failed', [OrderController::class, 'failed'])->name('order.failed');
