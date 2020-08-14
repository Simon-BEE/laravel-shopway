<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = ['id'];

    public $with = ['product_option'];

    /**
     * ? RELATIONS
     */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product_option()
    {
        return $this->belongsTo(ProductItemOption::class, 'product_item_option_id');
    }
}
