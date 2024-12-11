<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'адреса';

    protected $fillable = [
        'название_пункта',
        'улица',
        'город',
        'область',
        'почтовый_индекс',
        'страна',
        'часы_работы',
        'телефон',
        'координаты',
    ];

    // Связь с заказами (один адрес может быть привязан к нескольким заказам)
    public function заказы()
    {
        return $this->hasMany(Order::class, 'адрес_доставки_id');
    }
}
