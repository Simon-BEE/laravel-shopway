<?php

namespace App\Models\Orders;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Range extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function scopeByWeight(Builder $query, int $weight): Builder
    {
        return $query->select('id')->where('max', '>', $weight);
    }

    /**
     * ? RELATIONS
     */

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'shippings')->withPivot('price');
    }
}
