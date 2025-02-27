<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteReviews extends Model
{
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
