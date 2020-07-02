<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $guarded = ['id'];

    public static function booted()
    {
        static::deleted(function ($image){
            Storage::disk('products')->delete($image->filename);
        });
    }

    /**
     * ? RELATIONS
     */

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
