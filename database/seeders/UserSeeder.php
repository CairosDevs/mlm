<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.debug')) {

            $this->call(
                [
                    RoleAndPermissionSeeder::class,
                ]
            );

            //create System user
            $user = \App\Models\User::create(
                [
                'name' => 'System',
                'email' => 'system@mlm.com',
                'lastName' => 'Admin',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'confirmed' => true,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole('System');

            $user = \App\Models\User::create(
                [
                'name' => 'Admin',
                'email' => 'admin@mlm.com',
                'lastName' => 'Admin',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'confirmed' => true,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole('Admin');

            $user = \App\Models\User::create(
                [
                'name' => 'Operator',
                'email' => 'operator@mlm.com',
                'lastName' => '',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'confirmed' => true,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole('Operator');

            $user = \App\Models\User::create(
                [
                'name' => 'Customer',
                'email' => 'customer@mlm.com',
                'lastName' => '',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'confirmed' => true,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole('Customer');
            
            $this->call(
            [
               //
            ]
        );

        } else {

            $this->call(
                [
                    RoleAndPermissionSeeder::class,
                ]
            );

            //create System user
            $user = \App\Models\User::create(
                [
                'name' => 'System',
                'email' => 'system@mlm.com',
                'lastName' => 'Admin',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole('System');

            $user = \App\Models\User::create(
                [
                'name' => 'Admin',
                'email' => 'admin@mlm.com',
                'lastName' => 'Admin',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole('Admin');

            $user = \App\Models\User::create(
                [
                'name' => 'Operator',
                'email' => 'operator@mlm.com',
                'lastName' => '',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole('Operator');

            $user = \App\Models\User::create(
                [
                'name' => 'Customer',
                'email' => 'customer@mlm.com',
                'lastName' => '',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole('Customer');
            
            $this->call(
            [
               //
            ]);

        }

    }
}
