<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev = User::create([
            'name' => 'Benkin',
            'email' => 'im@bennykindangen.com',
            'photo' => 'assets/admin/benkin.jpg',
            'password' => Hash::make('asdfasdf')
        ]);

        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'photo' => 'assets/admin/default.png',
            'password' => Hash::make('asdfasdf')
        ]);

        Role::create(['name' => 'Developer']);
        $dev->assignRole('Developer');

        $sa_role = Role::create(['name' => 'Super Admin']);
        $admin_role = Role::create(['name' => 'Admin']);
        
        $super_admin->assignRole($sa_role);
    }
}
