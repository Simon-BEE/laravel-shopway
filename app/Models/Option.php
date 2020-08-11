<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = ['id'];

    const SIZE_OPTION = 1;
    const COLOR_OPTION = 2;
    const MATERIAL_OPTION = 3;

    public function getTypeStringAttribute()
    {
        return $this->type->name;
    }

    public function type()
    {
        return $this->belongsTo(OptionType::class, 'option_type_id');
    }

    public function product_items()
    {
        return $this->belongsToMany(ProductItemOption::class, 'option_product');
    }
}
