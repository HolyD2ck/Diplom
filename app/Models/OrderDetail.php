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

    protected $with = ['order', 'product']; // Подгрузка связанных моделей

    // Связь с заказом
    public function order()
    {
        return $this->belongsTo(Order::class, 'заказ_id');
    }

    // Связь с товаром
    public function product()
    {
        return $this->belongsTo(Product::class, 'товар_id');
    }

}
