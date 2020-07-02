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
            ->with('product')
        ;
    }

     /**
      * Select a wish by auth id and product id
      *
      * @param [type] $query
      * @param integer $productId
      * @return self|null
      */
    public function scopeRemove(Builder $query, int $productId, int $userId)
    {
        return $query
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete()
        ;
    }

    /**
     * ? RELATIONS
     */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
