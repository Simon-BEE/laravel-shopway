<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = ['id'];

    /**
     * ? Relations
    */

    public function product_option()
    {
        return $this->belongsTo(ProductOption::class);
    }
}
