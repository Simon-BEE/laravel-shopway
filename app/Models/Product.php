<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($product){
            $product->slug = Str::slug($product->title);
        });
    }

    /**
     * ? ATTRIBUTES
     */

     /**
      * Return title with uppercase on first character
      *
      * @param string $title
      * @return string
      */
    public function getTitleAttribute(string $title): string
    {
        return ucfirst($title);
    }

    /**
     * Return the main reference of a product
     *
     * @return Reference (model)
     */
    public function getFirstReferenceAttribute(): Reference
    {
        return $this->references->first();
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

    /**
     * ? ATTRIBUTES
     */

     /**
      * Return a random collection of products
      *
      * @param Builder $query
      * @param string $with
      * @param integer $number
      * @return Builder
      */
    public function scopeRandomProducts(Builder $query, string $with = 'references', int $number = 12): Builder
    {
        return $query
            ->with($with)
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

    public function references()
    {
        return $this->hasMany(Reference::class);
    }
}
