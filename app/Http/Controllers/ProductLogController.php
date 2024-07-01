<?php

namespace App\Http\Controllers;

use App\Models\ProductLog;
use Illuminate\Http\Request;

class ProductLogController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = '';
        $orderByColumn = 'product_logs.id';
        $sortOrder = 'asc';

        if ($request->input('idSort')){
            $sortBy = 'idSort';
            $orderByColumn = 'product_logs.id';
            $sortOrder = $request->input('idSort');
        }

        if ($request->input('orderSort')){
            $sortBy = 'orderSort';
            $orderByColumn = 'orders.id';
            $sortOrder = $request->input('orderSort');
        }

        if ($request->input('productSort')){
            $sortBy = 'productSort';
            $orderByColumn = 'products.name';
            $sortOrder = $request->input('productSort');
        }

        if ($request->input('countSort')){
            $sortBy = 'countSort';
            $orderByColumn = 'orders.completed_at';
            $sortOrder = $request->input('countSort');
        }

        if ($request->input('statusSort')){
            $sortBy = 'statusSort';
            $orderByColumn = 'product_logs.status';
            $sortOrder = $request->input('statusSort');
        }

        $productLogs = ProductLog::query()
            ->join('orders', 'orders.id', '=', 'product_logs.order_id')
            ->join('products', 'products.id', '=', 'product_logs.product_id')
            ->orderBy($orderByColumn, $sortOrder)
            ->paginate(10, ([
                'product_logs.id as id',
                'orders.id as order',
                'products.name as product',
                'product_logs.count as count',
                'product_logs.status as status',
            ]));

        return view('products.log.index', compact('productLogs', 'sortBy', 'sortOrder'));
    }
    public function store($orderId, $productId, $count, $status = 0)
    {

    }
}
