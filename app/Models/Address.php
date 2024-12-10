<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'адреса';

    protected $fillable = ['улица', 'город', 'область', 'почтовый_индекс', 'страна'];  // заполняемые поля

    // Связь с заказами (от один ко многим)
    public function заказы()
    {
        return $this->hasMany(Order::class, 'адрес_доставки_id');  // связь с моделью Order через 'адрес_доставки_id'
    }
}
