<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function store(Request $request, $orderId)
    {
        $validated = $request->validate([
            'product' => ['required'],
            'count' => ['required', 'integer', 'min:1'],
        ]);

        OrderItem::query()->create([
            'order_id' => $orderId,
            'product_id' => $validated['product'],
            'count' => $validated['count'],
        ]);

        alert(__('Заказ обновлен'));
        return redirect()->route('orders.edit', $orderId);
    }

    public function delete($orderId, $id)
    {
        OrderItem::query()->where('id', $id)->delete();

        return redirect()->route('orders.edit', $orderId);
    }
}
