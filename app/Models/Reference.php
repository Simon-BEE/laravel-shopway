<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        return "https://picsum.photos/800";
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
}
