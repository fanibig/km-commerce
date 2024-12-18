<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingZone extends Model
{
    protected $guard = ['admin'];

    protected $table = 'shipping_zones';

    public function locations()
    {
        return $this->hasMany(ShippingZone::class);
    }

    public function rates()
    {
        return $this->hasMany(ShippingRate::class);
    }
}