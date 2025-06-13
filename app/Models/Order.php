<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'status',
        'comment',
        'product_id',
        'quantity',
        'total_price',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->total_price) && $order->product) {
                $order->total_price = $order->product->price * $order->quantity;
            }
        });
    }
}
