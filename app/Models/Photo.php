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

    protected $with = ['product'];

    // Связь с товаром
    public function product()
    {
        return $this->belongsTo(Product::class, 'товар_id');
    }

    // Логика для того, чтобы только одно фото было основным
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ($model->основное) {
                Photo::where('товар_id', $model->товар_id)
                    ->update(['основное' => false]);
            }
        });
    }
}
