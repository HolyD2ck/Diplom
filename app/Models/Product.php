<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'товары';
    protected $fillable = [
        'название',
        'описание',
        'производитель',
        'цена',
        'дата_выпуска',
        'дата_поступления_в_продажу',
        'категория_id',
    ];
    protected $casts = [
        'цена' => 'float',
        'дата_выпуска' => 'date',
        'дата_поступления_в_продажу' => 'date',
    ];

    public function категория()
    {
        return $this->belongsTo(Category::class, 'категория_id');
    }

    public function значенияАтрибутов()
    {
        return $this->hasMany(AttributeValue::class, 'товар_id');
    }

    public function фотографии()
    {
        return $this->hasMany(Photo::class, 'товар_id');
    }
}
