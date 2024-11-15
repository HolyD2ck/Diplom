<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Photo;
use App\Models\OrderDetail;
use App\Models\AttributeValue;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = 
    ["name", 
    "description", 
    "manufacturer", 
    "price", 
    "release_date", 
    "sale_start_date", 
    "category_id"];
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'manufacturer' => 'string',
        'price' => 'decimal:2',
        'release_date' => 'date',
        'sale_start_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'product_photo', 'product_id', 'photo_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'product_id');
    }
    
}
