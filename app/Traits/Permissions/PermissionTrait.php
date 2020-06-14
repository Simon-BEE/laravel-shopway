<?php

namespace App\Traits\Permissions;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

trait PermissionTrait
{
    /**
     * Check if a user has permission to do an action
     *
     * @param string|Permission $permission Permission's slug or Object
     * @return boolean
     */
    public function hasPermissionTo($permission): bool
    {
        if (is_string($permission)) {
            return $this->hasPermission($permission);
        }

        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    /**
     * Give permission not already added to a user
     *
     * @param array ...$permissions
     * @return bool
     */
    public function givePermissionsTo(array $permissions): bool
    {
        $permissionsShouldBeAdded = $this->getPermissionsRequested($permissions);
        if ($permissionsShouldBeAdded->isNotEmpty()) {
            $this->permissions()->attach($permissionsShouldBeAdded);
            return true;
        }

        return false;
    }

    /**
     * Give permissions to user through his role
     *
     * @param Permission $permission
     * @return void
     */
    public function givePermissionsThroughRole(): void
    {
        foreach ($this->roles as $role) {
            $this->givePermissionsTo($role->permissions->pluck('slug')->toArray());
        }
    }

    /**
     * Get all permissions through his roles
     *
     * @return SupportCollection
     */
    public function getPermissionsThroughRole(): SupportCollection
    {
        return $this->roles
            ->mapWithKeys(function ($role){
                return [$role->name => $role->permissions->pluck('name')->implode(', ')];
            })
        ;
    }

    /**
     * Remove permission not already added to a user
     *
     * @param array ...$permissions
     * @return void
     */
    public function removePermissionsTo(array $permissions): void
    {
        $this->permissions()->detach($this->getPermissionsRequested($permissions, false));
    }
    /**
     * Check if a user has permission to do something through his permissions
     *
     * @param string|Permission $permission Permission's slug
     * @return boolean
     */
    private function hasPermission($permission): bool
    {
        $slug = is_string($permission) ? $permission : $permission->slug;

        return $this->permissions
            ->contains('slug', $slug)
        ;
    }

    /**
     * Check if a user has permission to do something through his role
     *
     * @param Permission $permission
     * @return boolean
     */
    private function hasPermissionThroughRole(Permission $permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all permissions requested if exists
     *
     * @param array $permissions
     * @param bool $new
     * @return Collection
     */
    private function getPermissionsRequested(array $permissions, bool $new = true): Collection
    {
        $permissionsRequested = Permission::whereIn('slug', $permissions)->get();

        if ($new) {
            $filteredPermissionsRequested = $permissionsRequested->reject(function ($permission){
                return $this->hasPermissionTo($permission);
            });
        } else {
            $filteredPermissionsRequested = $permissionsRequested->reject(function ($permission){
                return !$this->hasPermissionTo($permission);
            });
        }

        return $filteredPermissionsRequested;
    }
}
