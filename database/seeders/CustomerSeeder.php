<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = \App\Models\Customer::create([
           'name' => 'andri',
            'email' => 'andri@email.com',
            'email_verified_at' => now(),
            'mobile_number' => '082145372360',
            'mobile_verified_at' => null,
            'type' => 'customer',
            'password' => bcrypt('password'),
        ]);

        $customer2 = \App\Models\Customer::create([
           'name' => 'Abdur Rahim',
            'email' => 'abdoerrahiem2@gmail.com',
            'email_verified_at' => now(),
            'mobile_number' => '089694624299',
            'mobile_verified_at' => now(),
            'type' => 'customer',
            'password' => bcrypt('password'),
        ]);

        $gender = Arr::random(['pria', 'wanita']);

        $customer->account()->create([
           'gender' => $gender,
           'birth_date' => Carbon::now()->subDays(rand(0, 7))->format('Y-m-d'),
           'avatar' => $gender == 'pria' ? 'default_man.png' : 'default_woman.png',
           'refferral_code' => Random::generate(6, 'A-Z'),
           'point' => random_int(50000, 200000),
        ]);

         $customer2->account()->create([
           'gender' => $gender,
           'birth_date' => Carbon::now()->subDays(rand(0, 7))->format('Y-m-d'),
           'avatar' => 'default_man.png',
           'refferral_code' => Random::generate(6, 'A-Z'),
           'point' => 1000000,
        ]);

        $customers = \App\Models\User::factory(10)->create(
            ['type' => 'customer']
        );

        $customers->each(function($customer) {

            $gender = Arr::random(['pria', 'wanita']);

            return $customer->account()->create([
               'gender' => $gender,
               'birth_date' => Carbon::now()->subDays(rand(0, 7))->format('Y-m-d'),
               'avatar' => $gender == 'pria' ? 'default_man.png' : 'default_woman.png',
               'refferral_code' => Random::generate(6, 'A-Z'),
               'point' => random_int(50000, 200000),
            ]);
        });
    }
}
