<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug',
    ];

    /**
     * * METHODS
     */

    /**
     * Check if a role has a permission
     *
     * @param integer $permissionId
     * @return boolean
     */
    public function hasPermission(int $permissionId): bool
    {
        return $this->permissions->contains('id', $permissionId);
    }

    /**
     * * SCOPES
     */

     /**
      * Return all roles without the main role Admin
      *
      * @return Collection
      */
     public function scopeAllWithoutAdmin(): Collection
     {
         return self::all()->reject(function ($role){
            return $role->slug === 'admin';
        });
     }

    /**
     * * RELATIONSHIPS
     */

    /**
     * The permissions that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
