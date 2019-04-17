<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'User')->first();
        $role_admin  = Role::where('name', 'Admin')->first();
        $role_moderator  = Role::where('name', 'Moderator')->first();

        for ( $i = 1; $i <= 255; $i ++ )
        {
            $user = new User();
            $user->name = "User_$i Name";
            $user->email = "user_$i@example.com";
            $user->phone = rand(1000, 100000);
            $user->password = bcrypt('user');
            $user->country_id = $i;
            $user->save();
            $user->roles()->attach($role_user);
        }

        $admin = new User();
        $admin->name = 'admin Name';
        $admin->email = 'admin@example.com';
        $admin->phone = rand(1000, 100000);
        $admin->password = bcrypt('admin');
        $admin->country_id = rand(1, 5);
        $admin->save();
        $admin->roles()->attach($role_admin);

        $moderator = new User();
        $moderator->name = 'Moderator Name';
        $moderator->email = 'moderator@example.com';
        $moderator->phone = rand(1000, 100000);
        $moderator->password = bcrypt('moderator');
        $moderator->country_id = rand(1, 5);
        $moderator->save();
        $moderator->roles()->attach($role_moderator);
    }
}
