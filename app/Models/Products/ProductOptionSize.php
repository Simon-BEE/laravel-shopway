<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductOptionSize extends Pivot
{
    protected $table = "product_option_size";

    public static function booted()
    {
        static::created(function ($productOptionSize){
            $productOption = ProductOption::find($productOptionSize->product_option_id);
            $productOption->product->refreshStatus();
        });

        static::updated(function ($productOptionSize){
            $productOption = ProductOption::find($productOptionSize->product_option_id);
            $productOption->product->refreshStatus();
        });

        static::deleted(function ($productOptionSize){
            $productOption = ProductOption::find($productOptionSize->product_option_id);
            $productOption->product->refreshStatus();
        });
    }
}
