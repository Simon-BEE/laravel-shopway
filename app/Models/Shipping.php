<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Shipping extends Model
{
    protected $guarded = ['id'];

    public function scopeByWeight(Builder $query, int $weight)
    {
        $range = Range::byWeight($weight)->first();

        return $query->where('range_id', $range->id)
            ->where('country_id', auth()->user()->address->country->id)
        ;
    }

    /**
     * ? RELATIONS
     */

    public function shipping_company()
    {
        return $this->belongsTo(ShippingCompany::class, 'company_id');
    }
}
