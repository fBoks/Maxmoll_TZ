<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Каких то особенных функций в программе в целом нет. Просто коммент.
     * Надеюсь, код читается нормально. Поэтому хз что комментить
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $sortBy = '';
        $orderByColumn = 'orders.id';
        $sortOrder = 'asc';

        if ($request->input('idSort')){
            $sortBy = 'idSort';
            $orderByColumn = 'orders.id';
            $sortOrder = $request->input('idSort');
        }

        if ($request->input('clientSort')){
            $sortBy = 'clientSort';
            $orderByColumn = 'orders.customer';
            $sortOrder = $request->input('clientSort');
        }

        if ($request->input('createdAtSort')){
            $sortBy = 'createdAtSort';
            $orderByColumn = 'orders.created_at';
            $sortOrder = $request->input('createdAtSort');
        }

        if ($request->input('completedAtSort')){
            $sortBy = 'completedAtSort';
            $orderByColumn = 'orders.completed_at';
            $sortOrder = $request->input('completedAtSort');
        }

        if ($request->input('warehouseSort')){
            $sortBy = 'warehouseSort';
            $orderByColumn = 'warehouses.name';
            $sortOrder = $request->input('warehouseSort');
        }

        if ($request->input('statusSort')){
            $sortBy = 'statusSort';
            $orderByColumn = 'orders.status';
            $sortOrder = $request->input('statusSort');
        }



        $orders = Order::query()
            ->join('warehouses', 'warehouses.id', '=', 'orders.warehouse_id')
            ->orderBy($orderByColumn, $sortOrder)
            ->paginate(
                10,
                [
                    'orders.id',
                    'orders.customer',
                    'orders.created_at',
                    'orders.completed_at',
                    'orders.status',
                    'warehouses.name as warehouse_name'
                ]
            );
        return view('orders.index', compact('orders', 'sortBy', 'sortOrder'));
    }

    public function edit($id)
    {
        $order = Order::query()->findOrFail($id);

        $warehouses = Warehouse::all();

        $products = Product::all();

        $orderItems = OrderItem::query()
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('order_id', $id)
            ->get(
                [
                    'order_items.id as id',
                    'order_items.count as count',
                    'products.id as product_id',
                    'products.name as name',
                    'products.price as price'
                ]
            );

        return view('orders.edit', compact('order', 'warehouses', 'products', 'id', 'orderItems'));
    }

    public function update(Request $request, $id, $status = null)
    {
        if ($status) {
            $completed_at = $status === 'completed' ? now() : null;
            Order::query()->where('id', $id)->update([
                'status' => $status,
                'completed_at' => $completed_at
            ]);

            alert(__('Статус обновлен'));

            if ($status === 'active') {
                return redirect()->route('orders.edit', $id);
            }

            return redirect()->route('orders');
        }

        $validated = $request->validate([
            'customer' => ['required', 'string', 'max:255'],
            'warehouse' => ['required'],
        ]);

        Order::query()->where('id', $id)->update([
            'customer' => $validated['customer'],
            'warehouse_id' => $validated['warehouse'],
        ]);

        alert(__('Заказ обновлен'));
        return redirect()->route('orders.edit', $id);
    }

    public function create()
    {
        $warehouses = Warehouse::all();

        $products = Product::all();

        return view('orders.create', compact('warehouses', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer' => ['required', 'string', 'max:255'],
            'warehouse' => ['required'],
            'product' => ['required'],
            'count' => ['required', 'integer', 'min:1'],
        ]);

        $order = Order::query()->create([
            'customer' => $validated['customer'],
            'warehouse_id' => $validated['warehouse'],
            'status' => 'active',
        ]);

        OrderItem::query()->create([
            'order_id' => $order->id,
            'product_id' => $validated['product'],
            'count' => $validated['count'],
        ]);

        alert(__('Заказ создан'));

        return redirect()->route('orders.edit', $order->id);
    }

    public function delete()
    {
    }
}
