<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductController::class);

Route::resource('orders', OrderController::class)->except(['edit', 'update', 'destroy']);
Route::patch('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');

Route::redirect('/', '/products');

Auth::routes();
