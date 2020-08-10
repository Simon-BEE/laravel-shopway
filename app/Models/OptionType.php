<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionType extends Model
{
    protected $guarded = ['id'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
