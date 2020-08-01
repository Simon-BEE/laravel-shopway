<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public static function getStateIdBySlug($slug = 'card'): int
    {
        return self::where('slug', $slug)->first()->id;
    }

    /**
     * ? RELATIONS
     */

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
