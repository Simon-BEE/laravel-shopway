<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $guarded = ['id'];

    // protected $with = ['wishes'];

    public function getNameAttribute(string $name)
    {
        return ucfirst($name);
    }

    public function getImagePathAttribute()
    {
        return "https://picsum.photos/800";
    }

    public function getIsInWishlistAttribute(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return $this->wishes->contains('user_id', auth()->id());
    }

    /**
     * ? RELATIONS
     */

    public function product()
    {
        return $this->belongsTo(Product::class);
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
