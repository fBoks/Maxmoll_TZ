<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'count',
        'status'
    ];

    public static function log($orderId, $productId, $count, $status = 'Расход')
    {
        self::query()->create([
            'order_id' => $orderId,
            'product_id' => $productId,
            'count' => $count,
            'status' => $status,
        ]);
    }
}
