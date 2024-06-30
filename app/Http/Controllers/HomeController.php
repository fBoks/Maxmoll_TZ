<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
            ->orderBy('products.id')
            ->paginate(10,
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

        return view('home', compact('products', 'warehouses'));
    }
}
