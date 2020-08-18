<?php

namespace App\Models\Orders;

use App\Models\Products\ProductOption;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = ['id'];

    public $with = ['option'];

    /**
     * ? RELATIONS
     */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product_option()
    {
        return $this->belongsTo(ProductOption::class);
    }
}
