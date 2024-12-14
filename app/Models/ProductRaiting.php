<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRaiting extends Model
{
    protected $table = "рейтинг_товаров";
    protected $fillable = [
        'товар_id',
        'средний_рейтинг',
    ];
}
