<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Photo extends Model
{
    protected $table = "photos";
    protected $fillable = ["path"];
    protected $casts = ['path' => 'string'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_photo', 'photo_id', 'product_id');
    }
    
}
