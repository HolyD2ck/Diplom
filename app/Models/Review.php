<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Review extends Model
{
    use HasFactory;
    protected $table = 'отзывы';
    protected $fillable = ['пользователь_id', 'товар_id', 'рейтинг', 'отзыв'];
    protected $casts = [
        'рейтинг' => 'integer',
        'отзыв' => 'string',
    ];

    // Значения по умолчанию
    protected $attributes = [
        'рейтинг' => 5,
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
    public function получитьСреднийРейтинг()
    {
        return $this->товар->рейтинг_товаров->средний_рейтинг;
    }
    //Метод вызывемый при создании или   обновлении отзыва
    public static function boot()
    {
        parent::boot();

        static::created(function ($review) {
            static::updateAverageRating($review->товар_id);
        });

        static::updated(function ($review) {
            static::updateAverageRating($review->товар_id);
        });
    }
    //Метод обработки средней оценки товара
    public static function updateAverageRating($productId)
    {
        $averageRating = DB::table('отзывы')
            ->where('товар_id', $productId)
            ->avg('рейтинг');

        DB::table('рейтинг_товаров')->updateOrInsert(
            ['товар_id' => $productId],
            ['средний_рейтинг' => $averageRating]
        );
    }
}
