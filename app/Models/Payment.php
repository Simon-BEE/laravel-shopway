<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];

    const STRIPE_TYPE = 'stripe';
    const PAYPAL_TYPE = 'paypal';

    /**
     * ? RELATIONS
     */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
