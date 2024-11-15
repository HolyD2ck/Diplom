<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'атрибуты';
    protected $fillable = ['название'];
    protected $casts = [
        'название' => 'string',
    ];

    public function категории()
    {
        return $this->belongsToMany(Category::class, 'категория_атрибуты', 'атрибут_id', 'категория_id');
    }

    public function значения()
    {
        return $this->hasMany(AttributeValue::class, 'атрибут_id');
    }
}
