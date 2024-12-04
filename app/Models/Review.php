<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'отзывы';
    protected $fillable = ['пользователь_id', 'товар_id', 'оценка', 'текст_отзыва'];
    protected $casts = [
        'оценка' => 'integer',
        'текст_отзыва' => 'string',
    ];

    // Значения по умолчанию
    protected $attributes = [
        'оценка' => 5,  // дефолтная оценка, если она не была установлена
    ];

    // Связь с пользователем
    public function пользователь()
    {
        return $this->belongsTo(User::class, 'пользователь_id');
    }

    // Связь с товаром
    public function товар()
    {
        return $this->belongsTo(Product::class, 'товар_id');
    }

    // Метод для получения оценки
    public function getRatingAttribute()
    {
        return $this->оценка;
    }

    // Пример валидации длины текста отзыва
    public static function boot()
    {
        parent::boot();

        static::creating(function ($review) {
            if (strlen($review->текст_отзыва) > 1000) {
                throw new \Exception('Отзыв не может быть длиннее 1000 символов');
            }
        });
    }
}
