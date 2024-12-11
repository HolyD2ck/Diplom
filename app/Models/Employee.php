<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'сотрудники';

    protected $fillable = [
        'имя',
        'фамилия',
        'должность',
        'электронная_почта',
        'телефон',
        'дата_рождения',
        'дата_найма',
        'зарплата',
        'адрес',
    ];

    protected $casts = [
        'дата_рождения' => 'date',
        'дата_найма' => 'date',
        'зарплата' => 'float',
    ];
}
