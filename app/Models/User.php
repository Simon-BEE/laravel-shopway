<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'newsletter', 'last_login_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_login_at',
    ];

    public function scopeAdmins(Builder $query, bool $isAdmin = true)
    {
        return self::all()->filter(function ($user){
            return $user->hasRoles('admin');
        });
    }

    /**
     * ? ATTRIBUTES
     */

    public function getRolesStringAttribute()
    {
        return $this->roles->implode('name', ', ');
    }

    public function getPermissionsThroughtRolesInStringAttribute()
    {
        return $this->getPermissionsThroughRole()->implode(', ');
    }

    public function getHasAlreadyCartAttribute(): bool
    {
        return $this->cart ? true : false;
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function getAddressAttribute()
    {
        if ($this->addresses->isEmpty()) {
            return null;
        }

        return $this->addresses->firstWhere('is_main', true);
    }

    //

    public function isInWishlist(int $productId): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return $this->wishes->contains('product_id', $productId);
    }

    /**
     * ? RELATIONS
     */

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
