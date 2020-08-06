<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Shipping extends Model
{
    protected $guarded = ['id'];

    public function scopeByWeight(Builder $query, int $weight, int $country = null)
    {
        $range = Range::byWeight($weight)->first();

        return $query->where('range_id', $range->id)
            ->where('country_id', $country ?? auth()->user()->address->country->id)
        ;
    }

    /**
     * ? RELATIONS
     */

    public function company()
    {
        return $this->belongsTo(ShippingCompany::class, 'company_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function range()
    {
        return $this->belongsTo(Range::class);
    }
}
