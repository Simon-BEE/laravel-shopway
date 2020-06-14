<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * * Roles creation
         */
        Role::create([
            'slug' => 'admin',
            'name' => 'Administrator',
        ]);
        $managerRole = Role::create([
            'slug' => 'manager',
            'name' => 'Product Manager',
        ]);
        Role::create([
            'slug' => 'moderator',
            'name' => 'Moderator',
        ]);

        /**
         * * Permissions creation
         */
        $editProduct = Permission::create([
            'slug' => 'edit-product',
            'name' => 'Edit product',
        ]);
        $createProduct = Permission::create([
            'slug' => 'create-product',
            'name' => 'Create product',
        ]);

        /**
         * * Relations between roles and permissions
         */
        $managerRole->permissions()->attach($editProduct);
        $managerRole->permissions()->attach($createProduct);

        // Always at the end of seeder
    }
}
