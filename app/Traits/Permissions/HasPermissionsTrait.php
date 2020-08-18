<?php

namespace App\Traits\Permissions;

use App\Models\Users\Role;
use App\Models\Users\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissionsTrait
{
    use PermissionTrait, RoleTrait;

    /**
     * * Roles METHODS
     * @see App\Traits\Permissions\RoleTrait;
     */

    /**
     * * Permissions METHODS
     * @see App\Traits\Permissions\PermissionTrait;
     */

    /**
     * * RELATIONSHIPS
     */

    /**
     * The roles that belong to the user.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * The permissions that belong to the user.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }
}
