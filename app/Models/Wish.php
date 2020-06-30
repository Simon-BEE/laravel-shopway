<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $guarded = ['id'];

    /**
     * ? RELATIONS
     */

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
