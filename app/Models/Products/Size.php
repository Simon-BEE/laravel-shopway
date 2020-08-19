<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $guarded = ['id'];

    /**
     * ? Relations
    */

    public function product_option()
    {
        return $this->belongsToMany(ProductOption::class)->withPivot('quantity');
    }
}
