<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->join('warehouses', 'warehouses.id', '=', 'orders.warehouse_id')
            ->orderBy('orders.id')
            ->get(
                [
                    'orders.id',
                    'orders.customer',
                    'orders.created_at',
                    'orders.completed_at',
                    'orders.status',
                    'warehouses.name as warehouse_name'
                ]
            );

        $products = Product::query()
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
            ->orderBy('products.id')
            ->limit(10)
            ->get(
                [
                    'products.id',
                    'products.name as product_name',
                    'products.price',
                    'stocks.stock',
                    'warehouses.name as warehouse_name'
                ]
            );

        $warehouses = Warehouse::query()
            ->limit(10)
            ->get();

        return view('home', compact('orders', 'products', 'warehouses'));
    }
}
