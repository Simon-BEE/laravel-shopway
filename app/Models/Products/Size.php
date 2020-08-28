<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Size extends Model
{
    const QUANTITY_ALERT = 1;

    protected $guarded = ['id'];

    public function decrementQuantity(int $quantity = 1)
    {
        if (is_null($this->pivot)) {
            return;
        }

        $this->pivot->quantity = $this->pivot->quantity - $quantity;

        if ($this->pivot->quantity <= 0) {
            $this->pivot->delete();

            return;
        }

        $this->pivot->save();
    }

    public function incrementQuantity(int $quantity = 1)
    {
        if (is_null($this->pivot)) {
            return;
        }

        $this->pivot->quantity = $this->pivot->quantity + $quantity;
        $this->pivot->save();
    }

    public function hasEnoughQuantity(): bool
    {
        if (is_null($this->pivot)) {
            return false;
        }

       return $this->pivot->quantity > self::QUANTITY_ALERT;
    }

    /**
     * ? Attributes
    */

    public function getIsAvalaibleAttribute(): bool
    {
        return $this->hasEnoughQuantity();
    }

    /**
     * ? Scopes
    */

    public function scopeGetNameById(Builder $query, int $sizeId): string
    {
        $allSizes = self::allSizes();

        return $allSizes->firstWhere('id', $sizeId)->name;
    }

    public function scopeAllSizes(Builder $query)
    {
        return Cache::remember('sizes_names', now()->addHours(2), function () use($query){
            return $query->get();
        });
    }

    /**
     * ? Relations
    */

    public function product_option()
    {
        return $this->belongsToMany(ProductOption::class)->withPivot('quantity');
    }
}
