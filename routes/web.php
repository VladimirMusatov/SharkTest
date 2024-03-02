<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

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

Route::get('/',[MainController::class, 'index'])->name('index');

Route::post('/store_order', [MainController::class, 'store_order'])->name('store_order');
Route::get('/order_list', [MainController::class, 'order_list'])->name('order_list');

Route::get('/accept_name/{id}', [MainController::class, 'accept_order'])->name('accept');
Route::post('/decline_name', [MainController::class, 'decline_order'])->name('decline');