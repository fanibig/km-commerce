<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadableProduct extends Model
{
    protected $fillable = [
        'product_id',
        'file_url',
        'file_size',
        'file_type',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}