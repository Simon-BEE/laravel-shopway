<?php

namespace App\Models\Users;

use App\Models\Country;
use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($address){
            if (!$address->getMainUserAddress()) {
                $address->is_main = true;
            }
        });
    }

    public function scopeAllByUser(Builder $query, User $user = null): Builder
    {
        return $query->where('user_id', $user ? $user->id : auth()->id());
    }

    /**
     * ? MISC
     */

    public function setAsMain()
    {
        if (!$this->is_main) {
            $this->resetMain();

            $this->update([
                'is_main' => true
            ]);
        }
    }

    public function resetMain()
    {
        return self::where('user_id', auth()->id())
            ->where('is_main', true)
            ->update([
            'is_main' => false,
        ]);
    }

    public function getMainUserAddress()
    {
        return self::where('user_id', auth()->id())->where('is_main', true)->first();
    }

    /**
     * ? ATTRIBUTES
     */

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function getFullAddressAttribute()
    {
        $fullAddress = $this->address;

        $fullAddress .= $this->info_address ? ' ' . $this->info_address . ',' : ',';

        $fullAddress .= " $this->city $this->zipcode - {$this->country->name}";

        return $fullAddress;
    }

    /**
     * ? RELATIONS
     */

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
