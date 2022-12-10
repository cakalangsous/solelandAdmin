<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // role perms
        Permission::create(['name' => 'roles_view', 'table_name' => 'roles']);
        Permission::create(['name' => 'roles_add', 'table_name' => 'roles']);
        Permission::create(['name' => 'roles_update', 'table_name' => 'roles']);
        Permission::create(['name' => 'roles_delete', 'table_name' => 'roles']);

        // permission perms
        Permission::create(['name' => 'permissions_view', 'table_name' => 'permissions']);
        Permission::create(['name' => 'permissions_add', 'table_name' => 'permissions']);
        Permission::create(['name' => 'permissions_update', 'table_name' => 'permissions']);
        Permission::create(['name' => 'permissions_delete', 'table_name' => 'permissions']);

        // user perms
        Permission::create(['name' => 'users_view', 'table_name' => 'users']);
        Permission::create(['name' => 'users_add', 'table_name' => 'users']);
        Permission::create(['name' => 'users_update', 'table_name' => 'users']);
        Permission::create(['name' => 'users_delete', 'table_name' => 'users']);

        // access perms
        Permission::create(['name' => 'access_view', 'table_name' => 'access']);
        Permission::create(['name' => 'access_update', 'table_name' => 'access']);
    }
}
