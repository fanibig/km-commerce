<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = ['admin'];

    protected $fillable = ['title', 'slug', 'brand_logo', 'status', 'description', 'meta_keywords'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setTitleSlugAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setMetaKeywordsAttribute($value)
    {
        $this->attributes['meta_keywords'] = Str::lower(Str::replace('_', ' ', $value));
    }

    public function getBrandLogoUrlAttribute()
    {
        if (!empty($this->brand_logo)) {
            return asset('storage/' . $this->brand_logo);
        } else {
            return asset('assets/placeholder2.png');
        }
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}