<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SiteReviews extends Model
{
    use HasFactory;
    protected $table = "отзывы_сайта";

    protected $fillable = [
        "имя_клиента",
        "отзыв",
        "email",
    ];
    protected $casts = [
        'имя_клиента' => 'string',
        'отзыв' => 'string',
        "email" => 'string',
    ];
}
