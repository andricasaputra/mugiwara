<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        $superadmin->assignRole('superadmin');
        $superadmin->assignRole('admin');
        $admin->assignRole('admin');

        //$users = \App\Models\User::factory(5)->create();

        //$users->each(fn ($user) => $user->assignRole('employee'));

        // $users->each(function($user) {

        //     $gender = Arr::random(['pria', 'wanita']);

        //     return $user->account()->create([
        //        'gender' => $gender,
        //        'birth_date' => Carbon::now()->subDays(rand(0, 7))->format('Y-m-d'),
        //        'avatar' => $gender == 'pria' ? 'default_man.png' : 'default_woman.png',
        //        'refferral_code' => Random::generate(6, 'A-Z'),
        //        'point' => random_int(50000, 200000),
        //     ]);
        // });
    }
}
