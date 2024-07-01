<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductLogController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('products/{product_id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('products/{product_id}', [ProductController::class, 'update'])->name('products.update');

Route::get('products/log/}', [ProductLogController::class, 'index'])->name('products.log');
Route::post('products/log/{product_id}', [ProductLogController::class, 'store'])->name('products.log.store');

Route::get('orders', [OrderController::class, 'index'])->name('orders');
Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::get('orders/{order_id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('orders/{order_id}/{status?}', [OrderController::class, 'update'])->name('orders.update');

Route::post('orders/{order_id}/item', [OrderItemController::class, 'store'])->name('orders.item.store');
Route::delete('orders/{order_id}/item/{item_id}', [OrderItemController::class, 'delete'])->name('order.item.delete');

Route::get('warehouses', [WarehouseController::class, 'index'])->name('warehouses');
