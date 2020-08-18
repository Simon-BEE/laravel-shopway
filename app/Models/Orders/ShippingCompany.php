<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    protected $guarded = ['id'];

    /**
     * ? RELATIONS
     */

    public function shippings()
    {
        return $this->hasMany(Shipping::class, 'company_id');
    }
}
