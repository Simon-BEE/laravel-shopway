<?php

use App\Models\Users\Role;
use App\Models\Users\User;
use App\Models\Users\Address;
use App\Models\Users\Permission;
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


        factory(User::class, 20)
            ->create()
            ->each(function ($user) {
                $user->addresses()->createMany(
                    factory(Address::class, mt_rand(2, 3))->make()->toArray()
                );
        });
    }
}
