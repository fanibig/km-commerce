<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $guard = ['admin'];

    protected $fillable = ['name', 'type', 'is_active'];

    public function rates()
    {
        return $this->hasMany(ShippingRate::class);
    }
}