<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager_role = Role::where('slug', 'manager')->first();
        $admin_role = Role::where('slug', 'admin')->first();

        // ADMINISTRATOR - BIGBOSS
        $admin = User::create([
            'firstname' => 'Simon',
            'lastname' => 'Pro',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123'),
        ]);
        $admin->roles()->attach($admin_role);

        // MANAGER - BOSSHANDS
        $manager = User::create([
            'firstname' => 'Lily',
            'lastname' => 'Manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('123123'),
        ]);
        $manager->roles()->attach($manager_role);
    }
}
