<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Address extends Model
{
    protected $table = "addresses";
    protected $fillable = ["street", "city", "state", "postal_code", "country"];
    protected $casts = [
        'street' => 'string',
        'city' => 'string',
        'state' => 'string',
        'postal_code' => 'string',
        'country' => 'string',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }
}
