<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Favorite extends Model
{
    use HasFactory;

    protected $table = 'избранное';
    protected $fillable = [
        'пользователь_id',
        'товар_id',
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