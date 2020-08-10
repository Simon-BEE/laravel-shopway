<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItemOption extends Model
{
    protected $guarded = ['id'];

    /**
     * ? Attributes
     */

    public function getMainImagePathAttribute()
    {
        return $this->images->isNotEmpty() 
            ? $this->imagePath($this->main_image->filename) 
            : "https://picsum.photos/800";
    }

    public function getMainImageAttribute()
    {
        if ($this->images->contains('is_main', true)) {
            return $this->images->skipUntil(function ($image){
                return $image->is_main;
            })->first();
        }

        return $this->images->first();
    }

    public function getTypeAttribute()
    {
        return $this->options->map(function ($option){
            return $option->type_string;
        })->first();
    }

    public function getOptions()
    {
        return $this->options->map(function ($option){
            return $option->name;
        });
    }

    /**
     * ? Relations
     */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_product');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
