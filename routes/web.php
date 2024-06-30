<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::get('orders', [OrderController::class, 'index'])->name('orders');

Route::get('warehouses', [WarehouseController::class, 'index'])->name('warehouses');
