<?php

namespace App\Traits\Permissions;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

trait RoleTrait
{
    /**
     * Check if a user has some roles
     *
     * @param string ...$roles
     * @return boolean
     */
   public function hasRoles(string ...$roles): bool
   {
       foreach ($roles as $role) {
           if ($this->roles->contains('slug', $role)) {
               return true;
            }
       }
       return false;
   }

   /**
    * Give role not already added to a user
    *
    * @param array $roles
    * @return void
    */
   public function giveRolesTo(array $roles): void
   {
       $this->roles()->sync($this->getRolesRequested($roles));
   }

   /**
    * Remove role not already added to a user
    *
    * @param array $roles
    * @return void
    */
   public function removeRolesTo(array $roles): void
   {
       $this->roles()->detach($this->getRolesRequested($roles, false));
   }

    /**
     * Get all roles requested if exists
     *
     * @param array $roles
     * @param bool $new
     * @return Collection
     */
    private function getRolesRequested(array $roles, bool $new = true): Collection
    {
        $allRoles = Role::all();

        $rolesRequested = $allRoles->filter(function ($role) use ($roles){
            foreach ($roles as $roleRequest) {
                if ($roleRequest == $role->slug) {
                    return true;
                }
            }
        });

        if ($new) {
            $filteredRolesRequested = $rolesRequested->reject(function ($role){
                return $this->hasRoles($role->slug);
            });
        } else {
            $filteredRolesRequested = $rolesRequested->reject(function ($role){
                return !$this->hasRoles($role->slug);
            });
        }

        // throw_if($rolesRequested->isEmpty(), \Exception::class ,'No roles found');

        return $filteredRolesRequested;
    }
}
