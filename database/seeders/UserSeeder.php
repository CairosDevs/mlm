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
                'membership' => true
                ]
            );
            $user->assignRole('System');

            \App\Models\AsignProfile::create(
                [
                'user_id' => 1,
                'dni' => 'documents/dni/RmOrPpVk.png',
                'country' => '',
                'placeBirth' => '',
                'birthdate' => now(),
                'address' => '',
                'PostalCode' => '',
                'digitalContract' => 'documents/contract/EiLOCPyK.pdf',
                'status' => true
                ]
            );

            \App\Models\AsingPin::create(
                [
                'user_id' => 1,
                'pin' => '14975f78-04b1-4927-bc44-bdc134da8f8e	',
                'status' => 0,
                ]
            );

            \App\Models\OrderPayment::create(
                [
                'payment_id' => '25392f29',
                'external_payment_id' => '6209282706',
                'user_id' => 1,
                'amount' => 20,
                'type' => 'membership',
                'status' => 'paid',
                ]
            );

            //create admin user
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
                'membership' => true
                ]
            );
            $user->assignRole('Admin');

            \App\Models\AsignProfile::create(
                [
                'user_id' => 2,
                'dni' => 'documents/dni/RmOrPpVk.png',
                'country' => '',
                'placeBirth' => '',
                'birthdate' => now(),
                'address' => '',
                'PostalCode' => '',
                'digitalContract' => 'documents/contract/EiLOCPyK.pdf',
                'status' => true
                ]
            );

            \App\Models\AsingPin::create(
                [
                'user_id' => 2,
                'pin' => '14975f78-04b1-4927-bc44-bdc134da8f8e	',
                'status' => 0,
                ]
            );

            \App\Models\OrderPayment::create(
                [
                'payment_id' => '25392f29',
                'external_payment_id' => '6209282706',
                'user_id' => 2,
                'amount' => 20,
                'type' => 'membership',
                'status' => 'paid',
                ]
            );

            //create operator
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
                'membership' => true
                ]
            );
            $user->assignRole('Operator');

           \App\Models\AsignProfile::create(
                [
                'user_id' => 3,
                'dni' => 'documents/dni/RmOrPpVk.png',
                'country' => '',
                'placeBirth' => '',
                'birthdate' => now(),
                'address' => '',
                'PostalCode' => '',
                'digitalContract' => 'documents/contract/EiLOCPyK.pdf',
                'status' => true
                ]
            );

            \App\Models\AsingPin::create(
                [
                'user_id' => 3,
                'pin' => '14975f78-04b1-4927-bc44-bdc134da8f8e	',
                'status' => 0,
                ]
            );

            \App\Models\OrderPayment::create(
                [
                'payment_id' => '25392f29',
                'external_payment_id' => '6209282706',
                'user_id' => 3,
                'amount' => 20,
                'type' => 'membership',
                'status' => 'paid',
                ]
            );
            //create customer
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
                'membership' => true
                ]
            );
            $user->assignRole('Customer');

            \App\Models\AsignProfile::create(
                [
                'user_id' => 4,
                'dni' => 'documents/dni/RmOrPpVk.png',
                'country' => '',
                'placeBirth' => '',
                'birthdate' => now(),
                'address' => '',
                'PostalCode' => '',
                'digitalContract' => 'documents/contract/EiLOCPyK.pdf',
                'status' => true
                ]
            );

            \App\Models\AsingPin::create(
                [
                'user_id' => 4,
                'pin' => '14975f78-04b1-4927-bc44-bdc134da8f8e	',
                'status' => 0,
                ]
            );
            \App\Models\OrderPayment::create(
                [
                'payment_id' => '25392f29',
                'external_payment_id' => '6209282706',
                'user_id' => 4,
                'amount' => 20,
                'type' => 'membership',
                'status' => 'paid',
                ]
            );
            
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
                'membership' => true
                ]
            );
            $user->assignRole('System');

            \App\Models\AsignProfile::create(
                [
                'user_id' => 1,
                'dni' => 'documents/dni/RmOrPpVk.png',
                'country' => '',
                'placeBirth' => '',
                'birthdate' => now(),
                'address' => '',
                'PostalCode' => '',
                'digitalContract' => 'documents/contract/EiLOCPyK.pdf',
                'status' => true
                ]
            );

            \App\Models\AsingPin::create(
                [
                'user_id' => 1,
                'pin' => '14975f78-04b1-4927-bc44-bdc134da8f8e	',
                'status' => 0,
                ]
            );

            \App\Models\OrderPayment::create(
                [
                'payment_id' => '25392f29',
                'external_payment_id' => '6209282706',
                'user_id' => 1,
                'amount' => 20,
                'type' => 'membership',
                'status' => 'paid',
                ]
            );

            $user = \App\Models\User::create(
                [
                'name' => 'Admin',
                'email' => 'admin@mlm.com',
                'lastName' => 'Admin',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'membership' => true
                ]
            );
            $user->assignRole('Admin');

            \App\Models\AsignProfile::create(
                [
                'user_id' => 2,
                'dni' => 'documents/dni/RmOrPpVk.png',
                'country' => '',
                'placeBirth' => '',
                'birthdate' => now(),
                'address' => '',
                'PostalCode' => '',
                'digitalContract' => 'documents/contract/EiLOCPyK.pdf',
                'status' => true
                ]
            );

            \App\Models\AsingPin::create(
                [
                'user_id' => 2,
                'pin' => '14975f78-04b1-4927-bc44-bdc134da8f8e	',
                'status' => 0,
                ]
            );

            \App\Models\OrderPayment::create(
                [
                'payment_id' => '25392f29',
                'external_payment_id' => '6209282706',
                'user_id' => 2,
                'amount' => 20,
                'type' => 'membership',
                'status' => 'paid',
                ]
            );

            $user = \App\Models\User::create(
                [
                'name' => 'Operator',
                'email' => 'operator@mlm.com',
                'lastName' => '',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'membership' => true
                ]
            );
            $user->assignRole('Operator');

            \App\Models\AsignProfile::create(
                [
                'user_id' => 3,
                'dni' => 'documents/dni/RmOrPpVk.png',
                'country' => '',
                'placeBirth' => '',
                'birthdate' => now(),
                'address' => '',
                'PostalCode' => '',
                'digitalContract' => 'documents/contract/EiLOCPyK.pdf',
                'status' => true
                ]
            );

            \App\Models\AsingPin::create(
                [
                'user_id' => 3,
                'pin' => '14975f78-04b1-4927-bc44-bdc134da8f8e	',
                'status' => 0,
                ]
            );

            \App\Models\OrderPayment::create(
                [
                'payment_id' => '25392f29',
                'external_payment_id' => '6209282706',
                'user_id' => 3,
                'amount' => 20,
                'type' => 'membership',
                'status' => 'paid',
                ]
            );

            $user = \App\Models\User::create(
                [
                'name' => 'Customer',
                'email' => 'customer@mlm.com',
                'lastName' => '',
                'phone' => '5555555',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'membership' => true
                ]
            );
            $user->assignRole('Customer');
            
            \App\Models\AsignProfile::create(
                [
                'user_id' => 4,
                'dni' => 'documents/dni/RmOrPpVk.png',
                'country' => '',
                'placeBirth' => '',
                'birthdate' => now(),
                'address' => '',
                'PostalCode' => '',
                'digitalContract' => 'documents/contract/EiLOCPyK.pdf',
                'status' => true
                ]
            );

            \App\Models\AsingPin::create(
                [
                'user_id' => 4,
                'pin' => '14975f78-04b1-4927-bc44-bdc134da8f8e	',
                'status' => 0,
                ]
            );

            \App\Models\OrderPayment::create(
                [
                'payment_id' => '25392f29',
                'external_payment_id' => '6209282706',
                'user_id' => 4,
                'amount' => 20,
                'type' => 'membership',
                'status' => 'paid',
                ]
            );

            $this->call(
            [
               //
            ]);

        }

    }
}
