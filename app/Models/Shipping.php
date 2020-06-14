<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $guarded = ['id'];

    /**
     * ? RELATIONS
     */

    public function shipping_company()
    {
        return $this->belongsTo(ShippingCompany::class, 'company_id');
    }
}
