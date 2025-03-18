<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Cart extends Model
{
    use HasFactory;

    protected $table = 'корзины';
    protected $fillable = [
        'пользователь_id',
        'товар_id',
        'количество',
    ];

    public function пользователь()
    {
        return $this->belongsTo(User::class, 'пользователь_id');
    }

    public function товар()
    {
        return $this->belongsTo(Product::class, 'товар_id');
    }
}