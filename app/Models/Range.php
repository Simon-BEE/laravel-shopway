<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    /**
     * ? RELATIONS
     */

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'shippings')->withPivot('price');
    }
}
