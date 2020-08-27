<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

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

       return $this->pivot->quantity >= self::QUANTITY_ALERT;
    }

    /**
     * ? Relations
    */

    public function product_option()
    {
        return $this->belongsToMany(ProductOption::class)->withPivot('quantity');
    }
}
