<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualProduct extends Model
{
    protected $fillable = [
        'product_id',
        'access_period',
        'download_link',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}