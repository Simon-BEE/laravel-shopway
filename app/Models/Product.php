<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{

    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'boolean',
        'price' => 'float',
        'weight' => 'float',
        'quantity' => 'integer',
    ];

    /**
     * ? MISC
     */

    public function imagePath(string $filename): string
    {
        return asset('/storage/products') . '/' . $filename;
    }

    public function hasCategory(Category $category): bool
    {
        return $this->categories->contains($category);
    }

    /**
     * ? ATTRIBUTES
     */

     /**
      * Return name with uppercase on first character
      *
      * @param string $name
      * @return string
      */
    public function getNameAttribute(string $name): string
    {
        return ucfirst($name);
    }

    public function getMainImagePathAttribute()
    {
        return $this->images->isNotEmpty() 
            ? $this->imagePath($this->getMainImage()->filename) 
            : "https://picsum.photos/800";
    }

    public function getMainImage()
    {
        if ($this->images->contains('is_main', true)) {
            return $this->images->skipUntil(function ($image){
                return $image->is_main;
            })->first();
        }

        return $this->images->first();
    }

    public function getIsInWishlistAttribute(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return $this->wishes->contains('user_id', auth()->id());
    }

    /**
     * Return truncate description of a product
     *
     * @return string
     */
    public function getExcerptAttribute(): string
    {
        return substr($this->description, 0, 200) . '...';
    }

    public function getCategoriesListAttribute()
    {
        return $this->categories->pluck('name')->implode(', ');
    }

    /**
     * ? SCOPES
     */

     /**
      * Return a random collection of products
      *
      * @param Builder $query
      * @param string $with
      * @param integer $number
      * @return Builder
      */
    public function scopeRandomProducts(Builder $query, int $number = 12): Builder
    {
        return $query
            ->where('active', true)
            ->inRandomOrder()
            ->take($number);
    }

    /**
     * ? RELATIONS
     */

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }
}
