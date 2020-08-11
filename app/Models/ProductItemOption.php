<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItemOption extends Model
{
    protected $guarded = ['id'];

    public function imagePath(string $filename): string
    {
        return asset('/storage/products') . '/' . $filename;
    }

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

    public function getColorAttribute(): Option
    {
        return $this->options()->where('option_type_id', Option::COLOR_OPTION)->first();
    }

    public function getMaterialAttribute(): Option
    {
        return $this->options()->where('option_type_id', Option::MATERIAL_OPTION)->first();
    }

    public function getDefaultSizeAttribute(): Option
    {
        return $this->sizes_available->first();
    }

    public function getSizesAvailableAttribute()
    {
        return $this->options()->where('option_type_id', Option::SIZE_OPTION)->get();
    }

    public function getClassnameAttribute()
    {
        if ($this->color->name === 'black') {
            return "bg-black text-white";
        }elseif($this->color->name === 'white'){
            return "bg-white text-gray-700";
        }else{
            return "bg-{$this->color->name}-500 text-white";
        }
    }

    ////

    public function hasColor(int $colorId)
    {
        return $this->options->contains('id', $colorId);
    }

    public function hasSize(int $sizeId)
    {
        return $this->options->contains('id', $sizeId);
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
