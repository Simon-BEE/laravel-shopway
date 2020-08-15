<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    protected $guarded = ['id'];

    public function scopeAllByUser(Builder $query, User $user = null): Builder
    {
        return $query->where('user_id', $user ? $user->id : auth()->id());
    }

    /**
     * ? ATTRIBUTES
     */

    public function getTotalAttribute()
    {
        return $this->price + $this->shipping_amount;
    }

    public function getShippingCompanyAttribute()
    {
        return $this->shipping->company->name;;
    }

    public function getShippingAmountAttribute()
    {
        return $this->shipping->price;
    }

    public function getStatusAttribute()
    {
        return $this->state->name;
    }

    public function getReferenceAttribute()
    {
        return $this->payment ? $this->payment->payment_id : '';
    }

    /**
     * ? RELATIONS
     */

    public function address()
    {
        return $this->belongsTo(Address::class)->withTrashed();
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
}
