<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeValue extends Model
{
    use HasFactory;
    protected $table = 'значения_атрибутов';
    protected $fillable = ['товар_id', 'атрибут_id', 'значение'];
    protected $visible = ['значение', 'атрибут'];

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
