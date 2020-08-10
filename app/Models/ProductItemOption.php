<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItemOption extends Model
{
    protected $guarded = ['id'];

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
