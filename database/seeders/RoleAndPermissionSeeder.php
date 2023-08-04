<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

/**
 * Seeder for roles and permisision
 * by default is created admin, system, operator and customer,
 */
class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permissions list
        Permission::create(['name' => 'view-dashboard']);

        Permission::create(['name' => 'view-users']);
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'view-roles-permissions']);
        Permission::create(['name' => 'create-roles-permissions']);
        Permission::create(['name' => 'edit-roles-permissions']);
        Permission::create(['name' => 'delete-roles-permissions']);

        Permission::create(['name' => 'view-profiles']);
        Permission::create(['name' => 'create-profiles']);
        Permission::create(['name' => 'edit-profiles']);
        Permission::create(['name' => 'delete-profiles']);

        Permission::create(['name' => 'view-documents']);
        Permission::create(['name' => 'create-documents']);
        Permission::create(['name' => 'edit-documents']);
        Permission::create(['name' => 'delete-documents']);

        Permission::create(['name' => 'view-wallet']);
        Permission::create(['name' => 'create-wallet']);
        Permission::create(['name' => 'edit-wallet']);
        Permission::create(['name' => 'delete-wallet']);

        Permission::create(['name' => 'view-deposit']);
        Permission::create(['name' => 'create-deposit']);
        Permission::create(['name' => 'edit-deposit']);
        Permission::create(['name' => 'delete-deposit']);

        Permission::create(['name' => 'view-drawback']);
        Permission::create(['name' => 'create-drawback']);
        Permission::create(['name' => 'edit-drawback']);
        Permission::create(['name' => 'delete-drawback']);

        Permission::create(['name' => 'view-reports']);
        Permission::create(['name' => 'create-reports']);
        Permission::create(['name' => 'edit-reports']);
        Permission::create(['name' => 'delete-reports']);

        Permission::create(['name' => 'view-config']);
        Permission::create(['name' => 'create-config']);
        Permission::create(['name' => 'edit-config']);
        Permission::create(['name' => 'delete-config']);

        Permission::create(['name' => 'view-log']);
        Permission::create(['name' => 'create-log']);
        Permission::create(['name' => 'edit-log']);
        Permission::create(['name' => 'delete-log']);

        Permission::create(['name' => 'view-txs']);
        Permission::create(['name' => 'create-txs']);
        Permission::create(['name' => 'edit-txs']);
        Permission::create(['name' => 'delete-txs']);

        //roles list
        $systemRole = Role::create(['name' => 'System']);
        $adminRole = Role::create(['name' => 'Admin']);
        $operatorRole = Role::create(['name' => 'Operator']);
        $customerRole = Role::create(['name' => 'Customer']);

        //asigments permissions to roles
        $systemRole->givePermissionTo(
            [
                'view-dashboard',

                'view-users',
                'create-users',
                'edit-users',
                'delete-users',

                'view-roles-permissions',
                'create-roles-permissions',
                'edit-roles-permissions',
                'delete-roles-permissions',

                'view-profiles',
                'create-profiles',
                'edit-profiles',
                'delete-profiles',

                'view-documents',
                'create-documents',
                'edit-documents',
                'delete-documents',

                'view-wallet',
                'create-wallet',
                'edit-wallet',
                'delete-wallet',

                'view-deposit',
                'create-deposit',
                'edit-deposit',
                'delete-deposit',

                'view-drawback',
                'create-drawback',
                'edit-drawback',
                'delete-drawback',

                'view-reports',
                'create-reports',
                'edit-reports',
                'delete-reports',

                'view-config',
                'create-config',
                'edit-config',
                'delete-config',

                'view-log',
                'create-log',
                'edit-log',
                'delete-log',

                'view-txs',
                'create-txs',
                'edit-txs',
                'delete-txs',
            ]
        );

        $adminRole->givePermissionTo(
            [
                'view-dashboard',

                'view-users',
                'create-users',
                'edit-users',
                'delete-users',

                'view-roles-permissions',
                'create-roles-permissions',
                'edit-roles-permissions',
                'delete-roles-permissions',

                'view-profiles',
                'create-profiles',
                'edit-profiles',
                'delete-profiles',

                'view-documents',
                'create-documents',
                'edit-documents',
                'delete-documents',

                'view-wallet',
                'create-wallet',
                'edit-wallet',
                'delete-wallet',

                'view-deposit',
                'create-deposit',
                'edit-deposit',
                'delete-deposit',

                'view-drawback',
                'create-drawback',
                'edit-drawback',
                'delete-drawback',

                'view-reports',
                'create-reports',
                'edit-reports',
                'delete-reports',

                'view-config',
                'create-config',
                'edit-config',
                'delete-config',

                'view-txs',
                'create-txs',
                'edit-txs',
                'delete-txs',
            ]
        );

        $operatorRole->givePermissionTo(
            [
                'view-dashboard',
               
                'view-reports',
                'create-reports',
                'edit-reports',
                'delete-reports',

                'view-txs',
                'create-txs',
                'edit-txs',
                'delete-txs',
            ]
        );

        $customerRole->givePermissionTo(
            [
                'view-dashboard',

                'view-profiles',
                'create-profiles',
                'edit-profiles',
                'delete-profiles',

                'view-documents',
                'create-documents',
                'edit-documents',
                'delete-documents',

                'view-wallet',
                'create-wallet',
                'edit-wallet',
                'delete-wallet',

                'view-deposit',
                'create-deposit',
                'edit-deposit',
                'delete-deposit',

                'view-drawback',
                'create-drawback',
                'edit-drawback',
                'delete-drawback',

                'view-reports',
                'create-reports',
                'edit-reports',
                'delete-reports',

                'view-txs',
                'create-txs',
                'edit-txs',
                'delete-txs',
            ]
        );
    }
}
