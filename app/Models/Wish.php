<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $guarded = ['id'];

    /**
     * ? RELATIONS
     */

    public function scopeWishlist(Builder $query)
    {
        return $query
            ->where('user_id', auth()->id())
            ->with('reference')
        ;
    }

     /**
      * Select a wish by auth id and reference id
      *
      * @param [type] $query
      * @param integer $referenceId
      * @return self|null
      */
    public function scopeRemove(Builder $query, int $referenceId, int $userId)
    {
        return $query
            ->where('user_id', $userId)
            ->where('reference_id', $referenceId)
            ->delete()
        ;
    }

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
