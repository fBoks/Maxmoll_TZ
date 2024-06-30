<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
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

        return view('products.index', compact('products'));
    }

    public function create()
    {
        echo 'Добавить товар';
    }

    public function edit($id) {
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

        return view('products.edit', compact('products'));
    }
}
