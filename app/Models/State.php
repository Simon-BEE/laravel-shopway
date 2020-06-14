<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    /**
     * ? RELATIONS
     */

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
