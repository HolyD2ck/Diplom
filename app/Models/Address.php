<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'адреса';
    protected $fillable = ['улица', 'город', 'область', 'почтовый_индекс', 'страна'];
    protected $casts = [
        'улица' => 'string',
        'город' => 'string',
        'область' => 'string',
        'почтовый_индекс' => 'string',
        'страна' => 'string',
    ];

    public function заказы()
    {
        return $this->hasMany(Order::class, 'адрес_доставки_id');
    }
}
