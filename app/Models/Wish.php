<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $guarded = ['id'];

    /**
     * ? RELATIONS
     */

     /**
      * Select a wish by auth id and reference id
      *
      * @param [type] $query
      * @param integer $referenceId
      * @return self|null
      */
    public function scopeRemove($query, int $referenceId, int $userId)
    {
        return $query
            ->where('user_id', $userId)
            ->where('reference_id', $referenceId)
            ->delete();
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
