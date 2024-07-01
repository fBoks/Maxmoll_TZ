<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\ProductLog;
use App\Models\Stock;
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

        Stock::query()->where('product_id', $validated['product'])->decrement('stock', $validated['count']);

        ProductLog::log($orderId, $validated['product'], $validated['count']);

        alert(__('Заказ обновлен'));
        return redirect()->route('orders.edit', $orderId);
    }

    public function delete($orderId, $id)
    {
        $productId = OrderItem::query()->where('id', $id)->value('product_id');
        $itemCount = OrderItem::query()->where('id', $id)->value('count');
        ProductLog::log($orderId, $productId, $itemCount, 'Приход');
        Stock::query()->where('product_id', $productId)->increment('stock', $itemCount);
        OrderItem::query()->where('id', $id)->delete();

        return redirect()->route('orders.edit', $orderId);
    }
}
