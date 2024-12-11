<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'поставщики';

    protected $fillable = [
        'название_компании',
        'контактное_лицо',
        'телефон',
        'электронная_почта',
        'вебсайт',
        'банковский_счет',
        'инн',
        'дата_начала_сотрудничества',
        'дата_окончания_сотрудничества',
    ];

    protected $casts = [
        'дата_начала_сотрудничества' => 'date',
        'дата_окончания_сотрудничества' => 'date',
    ];

    // Связь с продуктами (один поставщик может иметь множество товаров)
    public function товары()
    {
        return $this->hasMany(Product::class, 'поставщик_id');
    }
}
