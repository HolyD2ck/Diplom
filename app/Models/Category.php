<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'категории';
    protected $fillable = ['название'];
    protected $casts = [
        'название' => 'string',
    ];

    public function товары()
    {
        return $this->hasMany(Product::class, 'категория_id');
    }

    public function атрибуты()
    {
        return $this->belongsToMany(Attribute::class, 'категория_атрибуты', 'категория_id', 'атрибут_id');
    }
}
