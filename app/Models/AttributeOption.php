<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'admin_name',
        'sort_order',
        'swatch_value',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}