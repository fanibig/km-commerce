<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    protected $guard = ['admin'];

    protected $fillable = [
        'method_id',
        'zone_id',
        'price',
    ];
    public function method()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function zone()
    {
        return $this->belongsTo(ShippingZone::class);
    }
}