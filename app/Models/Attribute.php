<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'атрибуты';

    protected $fillable = ['название'];

    // Связь многие ко многим с категориями
    public function категории()
    {
        return $this->belongsToMany(Category::class, 'категория_атрибуты', 'атрибут_id', 'категория_id');
    }
    // Связь один ко многим с значениями атрибутов
    public function значения()
    {
        return $this->hasMany(AttributeValue::class, 'атрибут_id');
    }
}
