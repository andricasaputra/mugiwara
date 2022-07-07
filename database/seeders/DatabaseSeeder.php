<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IndoRegionSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);

        $superadmin = \App\Models\User::create([
           'name' => 'superadmin',
            'email' => 'superadmin@admin.com',
            'email_verified_at' => now(),
            'mobile_number' => '000',
            'mobile_verified_at' => now(),
            'password' => bcrypt('password123'),
        ]);

        $admin = \App\Models\User::create([
           'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'mobile_number' => '001',
            'mobile_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        $customer = \App\Models\Customer::create([
           'name' => 'andri',
            'email' => 'andri@email.com',
            'email_verified_at' => now(),
            'mobile_number' => '081238422099',
            'mobile_verified_at' => null,
            'type' => 'customer',
            'password' => bcrypt('password'),
        ]);

        $superadmin->assignRole('superadmin');
        $superadmin->assignRole('admin');
        $admin->assignRole('admin');

        $users = \App\Models\User::factory(5)->create();

        $users->each(fn ($user) => $user->assignRole('employee'));

        $this->call([
            PostSeeder::class,
            SliderSeeder::class,
            FacilityTableSeeder::class,
            TypeTableSeeder::class,
            ProductSeeder::class,
            VoucherSeeder::class,
            CustomerSeeder::class,
            AccessTokenSeeder::class,
            AccomodationTableSeeder::class,
        ]);
    }
}
