<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'фотографии';
    protected $fillable = ['товар_id', 'путь', 'основное'];
    protected $casts = [
        'путь' => 'string',
        'основное' => 'boolean',
    ];

    // Связь с товаром
    public function товар()
    {
        return $this->belongsTo(Product::class, 'товар_id');
    }
}
