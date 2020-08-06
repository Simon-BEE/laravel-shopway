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

    public function getPaymentTextAttribute($value)
    {
        $texts = [
            'card' => 'Carte bancaire',
            'bank transfer' => 'Virement',
            'check' => 'Chèque',
            'money order' => 'Mandat administratif',
        ];

        return $texts[$this->payment];
    }

    public function getPriceAttribute()
    {
        return $this->total + $this->shipping;
    }

    public function getShippingCompanyAttribute()
    {
        $shipping = Shipping::where('price', $this->shipping)->first();

        return $shipping ? $shipping->company->name : ShippingCompany::first()->name;
    }

    /**
     * ? RELATIONS
     */

    public function address()
    {
        return $this->belongsTo(Address::class);
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
}
