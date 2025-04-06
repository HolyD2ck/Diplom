<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
    use HasFactory;
    protected $table = 'заказы';
    protected $fillable = ['пользователь_id', 'итоговая_цена', 'статус', 'адрес_доставки_id'];
    protected $casts = [
        'итоговая_цена' => 'float',
    ];


    // Связь с пользователем (один ко многим)
    public function пользователь()
    {
        return $this->belongsTo(User::class, 'пользователь_id');
    }

    // Связь с адресом (один ко многим)
    public function адрес()
    {
        return $this->belongsTo(Address::class, 'адрес_доставки_id');
    }

    // Связь с деталями заказа (один ко многим)
    public function деталиЗаказа()
    {
        return $this->hasMany(OrderDetail::class, 'заказ_id');
    }

    // Дополнительный метод для получения товаров через детали заказа
    public function товары()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderDetail::class,
            'заказ_id',
            'id',
            'id',
            'товар_id'
        );
    }
    // Метод для пересчета итоговой цены
    public function пересчитатьИтоговуюЦену()
    {
        $this->итоговая_цена = $this->деталиЗаказа->sum('цена');
        $this->saveQuietly();
    }
}
