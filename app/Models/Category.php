<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'категории';
    protected $fillable = ['название'];

    public $timestamps = true;


    // Связь один ко многим с товарами
    public function товары()
    {
        return $this->hasMany(Product::class, 'категория_id');
    }

    // Связь многие ко многим с атрибутами
    public function аттрибуты()
    {
        return $this->belongsToMany(Attribute::class, 'категория_атрибуты', 'категория_id', 'атрибут_id');
    }

}
