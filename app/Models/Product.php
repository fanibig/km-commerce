<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use App\Models\ProductAttributeOption;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use Sluggable;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $guarded = ['admin'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_at',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency',
        'sku',
        'category',
        'image',
        'type',
        'attributes',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $width = config('common.image.medium.width');
        $height = config('common.image.medium.height');
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, $width, $height)
            ->nonQueued();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_variant_attributes')
            ->withPivot('attribute_value_id');
    }

    public function productAttributeOptions()
    {
        return $this->hasMany(ProductAttributeOption::class, 'product_id', 'id');
    }

    public function downloadable()
    {
        return $this->hasOne(DownloadableProduct::class, 'product_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onCreate' => true,
                'onUpdate' => true,
                'separator' => '-',
                'unique' => true,
            ]
        ];
    }

    public function createTags($tags)
    {
        if (is_array($tags)) {
            $tagIds = [];

            foreach ($tags as $tag) {
                // Check if the tag is an array and extract the title, otherwise use the tag directly
                if (is_array($tag)) {
                    $title = $tag['title'];
                } else {
                    $title = $tag;
                }

                // Trim and format the tag title
                $formattedTitle = ucwords(trim($title));
                $slug = Str::slug($formattedTitle); // Generate slug based on the formatted title

                // Use firstOrCreate to avoid duplicates
                $newTag = Tag::firstOrCreate(
                    ['slug' => $slug], // Check if a tag exists by slug
                    ['title' => $formattedTitle] // If not found, create with the title
                );

                // Collect the tag IDs for syncing
                $tagIds[] = $newTag->id;
            }

            // Sync the tag IDs with the product (assuming many-to-many relationship)
            $this->tags()->sync($tagIds);
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    public function scopePublished($query)
    {
        return $query->where("status", "published");
    }

    public function scopeScheduled($query)
    {
        return $query->where("status", "scheduled");
    }

    public function scopePrivate($query)
    {
        return $query->where("status", "private");
    }

    public function scopeDraft($query)
    {
        return $query->where("status", "draft");
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOldest($query)
    {
        return $query->orderBy('id', 'asc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function scopeTrending($query)
    {
        return $query->orderBy('reviews', 'desc');
    }

    public function scopeDiscounted($query)
    {
        return $query->where('sale_price', '>', 0);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_type', '=', 'in_stock');
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('stock_type', '=', 'out_of_stock');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%');
    }

    public function getImageUrlAttribute()
    {
        if (!empty($this->image)) {
            return asset('storage/' . $this->image);
        } else {
            return 'https://via.placeholder.com/150';
        }
    }
}