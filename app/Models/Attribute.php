<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'admin_name',
        'type',
        'validation',
        'position',
        'is_required',
        'is_unique',
        'value_per_locale',
        'value_per_channel',
        'is_filterable',
        'is_configurable',
        'is_user_defined',
        'is_visible_on_front',
        'swatch_type',
        'use_in_flat',
        'is_comparable',
    ];

    public function attributeOptions()
    {
        return $this->hasMany(AttributeOption::class);
    }
}