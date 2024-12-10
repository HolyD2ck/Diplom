<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderDetail extends Model
{
    protected $table = 'детали_заказов';
    protected $fillable = ['заказ_id', 'товар_id', 'количество', 'цена'];
    protected $casts = [
        'количество' => 'integer',
        'цена' => 'decimal:2',
    ];

    // Связь с заказом
    public function заказ()
    {
        return $this->belongsTo(Order::class, 'заказ_id');
    }

    // Связь с товаром
    public function товар()
    {
        return $this->belongsTo(Product::class, 'товар_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($detail) {
            $product = Product::find($detail->товар_id);
            if ($product) {
                $detail->цена = $product->цена * $detail->количество;
            }
        });
    }

}
