<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $guarded = ['id'];

    /**
     * ? RELATIONS
     */

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
