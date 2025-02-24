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
    // Метод вызывемый при создании, обновлении или удалении детали заказа
    protected static function boot()
    {
        parent::boot();

        // Метод вызывается перед сохранением детали заказа
        // Он пересчитывает цену детали заказа, умножая цену товара на количество
        static::creating(function ($detail) {
            $product = Product::find($detail->товар_id);
            if ($product) {
                $скидка = $product->цена - ($product->цена * $product->скидка / 100);
                $detail->цена = $скидка * $detail->количество;
            }
        });

        // Метод вызывается после сохранения детали заказа
        // Он вызывает пересчет итоговой цены заказа
        static::saved(function ($detail) {
            if ($detail->заказ) {
                $detail->заказ->пересчитатьИтоговуюЦену();
            }
        });

        // Метод вызывается после удаления детали заказа
        // Он вызывает пересчет итоговой цены заказа
        static::deleted(function ($detail) {
            if ($detail->заказ) {
                $detail->заказ->пересчитатьИтоговуюЦену();
            }
        });
    }

}
