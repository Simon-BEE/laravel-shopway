<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($category){
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category){
            $category->slug = Str::slug($category->name);
        });
    }

    /**
     * ? ATTRIBUTES
     */

    public function hasProduct(Product $product): bool
    {
        return $this->products->contains($product);
    }

    /**
     * ? ATTRIBUTES
     */

    public function getNameAttribute(string $name)
    {
        return ucfirst($name);
    }
    

    /**
     * ? RELATIONS
     */

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
