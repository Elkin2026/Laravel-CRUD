<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home_page');
});
Route::get('order/list', [OrderController::class, 'list']);
Route::get('product/list', [ProductController::class, 'list']);

Route::resource('client', ClientController::class);
Route::resource('order', OrderController::class);
Route::resource('product', ProductController::class);
