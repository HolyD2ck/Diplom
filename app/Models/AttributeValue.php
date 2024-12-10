<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'значения_атрибутов';
    protected $fillable = ['товар_id', 'атрибут_id', 'значение'];

    // Связь с товаром (один к одному)
    public function товар()
    {
        return $this->belongsTo(Product::class, 'товар_id');
    }

    // Связь с атрибутом (один к одному)
    public function атрибут()
    {
        return $this->belongsTo(Attribute::class, 'атрибут_id');
    }
}
