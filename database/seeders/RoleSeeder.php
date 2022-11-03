<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin permissions
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'view user info']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'assign product to user']);
        Permission::create(['name' => 'view user products']);

        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'view all products']);

        //user permissions
        Permission::create(['name' => 'show products']);

        //Default Roles
        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'add user',
                'edit user',
                'view user info',
                'delete user',
                'assign product to user',
                'view user products',
                'edit product',
                'delete product',
                'view all products',
            ]);

        Role::create(['name' => 'user'])
            ->givePermissionTo([
                'show products',
            ]);
    }
}
