<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'товары';

    protected $fillable = [
        'название',
        'описание',
        'производитель',
        'цена',
        'скидка',
        'дата_выпуска',
        'дата_поступления_в_продажу',
        'категория_id',
        'поставщик_id',
    ];

    protected $casts = [
        'цена' => 'float',
        'дата_выпуска' => 'date',
        'дата_поступления_в_продажу' => 'date',
    ];


    // Связь с категорией (один продукт принадлежит одной категории)
    public function категория()
    {
        return $this->belongsTo(Category::class, 'категория_id');
    }

    // Связь с поставщиком (один продукт принадлежит одному поставщику)
    public function поставщик()
    {
        return $this->belongsTo(Supplier::class, 'поставщик_id');
    }

    // Связь с значениями атрибутов (множество атрибутов для каждого товара)
    public function значенияАтрибутов()
    {
        return $this->hasMany(AttributeValue::class, 'товар_id');
    }

    // Связь с фотографиями (множество фотографий для каждого товара)
    public function фотографии()
    {
        return $this->hasMany(Photo::class, 'товар_id');
    }

    // Получить основное фото товара
    public function основноеФото()
    {
        return $this->hasOne(Photo::class, 'товар_id')->where('основное', true);
    }

    // Связь с отзывами
    public function отзывы()
    {
        return $this->hasMany(Review::class, 'товар_id');
    }
    public function среднийРейтинг()
    {
        return $this->hasMany(ProductRaiting::class, 'товар_id');
    }

}
