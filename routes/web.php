<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'MenuController@index')->name('home');

Route::get('/menu', 'MenuController@index')->name('menu');
Route::get('/menu/search', 'MenuController@search')->name('menu.search');

Route::post('/checkout', 'OrderController@checkout')->name('checkout');
Route::get('order/history', 'OrderController@history')->name('order.history');
