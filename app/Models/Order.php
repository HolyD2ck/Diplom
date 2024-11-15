<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'заказы';
    protected $fillable = ['пользователь_id', 'итоговая_цена', 'статус', 'адрес_доставки_id'];
    protected $casts = [
        'итоговая_цена' => 'float',
        'статус' => 'string',
    ];

    public function пользователь()
    {
        return $this->belongsTo(User::class, 'пользователь_id');
    }

    public function адрес()
    {
        return $this->belongsTo(Address::class, 'адрес_доставки_id');
    }

    public function детали()
    {
        return $this->hasMany(OrderDetail::class, 'заказ_id');
    }
}
