<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // // create permissions
        // Permission::create(['name' => 'browse-admin']);

        // // create seeder for menus
        // Permission::create(['name' => 'create-menu']);
        // Permission::create(['name' => 'update-menu']);
        // Permission::create(['name' => 'read-menu']);
        // Permission::create(['name' => 'delete-menu']);

        // // create seeder for permissions
        // Permission::create(['name' => 'create-permission']);
        // Permission::create(['name' => 'update-permission']);
        // Permission::create(['name' => 'read-permission']);
        // Permission::create(['name' => 'delete-permission']);

        // // create seeder for roles
        // Permission::create(['name' => 'create-role']);
        // Permission::create(['name' => 'update-role']);
        // Permission::create(['name' => 'read-role']);
        // Permission::create(['name' => 'delete-role']);

        // // create seeder for users
        // Permission::create(['name' => 'create-user']);
        // Permission::create(['name' => 'update-user']);
        // Permission::create(['name' => 'read-user']);
        // Permission::create(['name' => 'delete-user']);

        // // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin', 'display_name' => 'Administrator']);
        // $role1->givePermissionTo('browse-admin');
        // $role1->givePermissionTo('create-menu');
        // $role1->givePermissionTo('update-menu');
        // $role1->givePermissionTo('read-menu');
        // $role1->givePermissionTo('delete-menu');
        // $role1->givePermissionTo('create-permission');
        // $role1->givePermissionTo('update-permission');
        // $role1->givePermissionTo('read-permission');
        // $role1->givePermissionTo('delete-permission');
        // $role1->givePermissionTo('create-role');
        // $role1->givePermissionTo('update-role');
        // $role1->givePermissionTo('read-role');
        // $role1->givePermissionTo('delete-role');
        // $role1->givePermissionTo('create-user');
        // $role1->givePermissionTo('update-user');
        // $role1->givePermissionTo('read-user');
        // $role1->givePermissionTo('delete-user');

        $role2 = Role::create(['name' => 'manager', 'display_name' => 'Manager']);
        // $role2->givePermissionTo('browse-admin');
        // $role2->givePermissionTo('create-menu');
        // $role2->givePermissionTo('update-menu');
        // $role2->givePermissionTo('read-menu');
        // $role2->givePermissionTo('delete-menu');
        

        $role3 = Role::create(['name' => 'super-admin', 'display_name' => 'Super Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        // $user = \App\Models\User::create([
        //     'first_name' => 'Super Admin',
        //     'email' => 'superadmin@gmail.com',
        //     'password' => Hash::make('password'),
        //     'user_type' => 'superadmin',
        // ]);
        // $user->assignRole($role3);
    }
}
