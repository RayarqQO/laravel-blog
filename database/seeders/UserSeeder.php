<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = Role::where('slug','web-developer')->first();
        $manager = Role::where('slug', 'project-manager')->first();
        $createTasks = Permission::where('slug','create-tasks')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();

        $user1 = new User();
        $user1->name = 'Jhon';
        $user1->email = 'jhon@email.com';
        $user1->password = bcrypt('123');
        $user1->is_admin = 1;
        $user1->save();
        $user1->roles()->attach($developer);
        $user1->permissions()->attach($createTasks);

        $user2 = new User();
        $user2->name = 'Dave';
        $user2->email = 'dave@email.com';
        $user2->password = bcrypt('321');
        $user2->is_admin = 1;
        $user2->save();
        $user2->roles()->attach($manager);
        $user2->permissions()->attach($manageUsers);
    }
}
