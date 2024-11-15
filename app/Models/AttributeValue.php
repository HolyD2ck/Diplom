<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Attribute;

class AttributeValue extends Model
{
    protected $table = "attribute_values";
    protected $fillable = ["value", "product_id", "attribute_id"];
    protected $casts = ['value' => 'string'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
