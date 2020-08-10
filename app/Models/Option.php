<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(OptionType::class);
    }

    public function product_items()
    {
        return $this->belongsToMany(ProductItemOption::class, 'option_product');
    }
}
