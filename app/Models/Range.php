<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function scopeByWeight(Builder $query, int $weight): Builder
    {
        return $query->where('max', '>', $weight);
    }

    /**
     * ? RELATIONS
     */

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'shippings')->withPivot('price');
    }
}
