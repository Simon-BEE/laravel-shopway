<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

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

    public function getTotalOrderAttribute()
    {
        return $this->total + $this->shipping;
    }

    /**
     * ? RELATIONS
     */

    public function adresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    // public function order_items()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }

    public function products()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
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
