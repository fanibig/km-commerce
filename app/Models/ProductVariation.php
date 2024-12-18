<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $table = 'product_variants';
    protected $guarded = ['admin'];

    protected $fillable = [
        'product_id',
        'attribute_id',
        'price',
        'sale_price',
        'sale_start_date',
        'sale_end_date',
        'sku',
        'quantity',
        'status',
        'stock_type',
        'image',
        'options',
        'weight',
        'weight_unit',
        'length',
        'width',
        'height',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}