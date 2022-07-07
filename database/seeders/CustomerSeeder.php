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
            'mobile_number' => '081238422099',
            'mobile_verified_at' => null,
            'type' => 'customer',
            'password' => bcrypt('password'),
        ]);

        $customer->account()->create([
           'gender' => Arr::random(['pria', 'wanita']),
           'birth_date' => Carbon::now()->subDays(rand(0, 7))->format('Y-m-d'),
           'avatar' => 'avatars/default_avatar.png',
           'refferral_code' => Random::generate(6, 'A-Z'),
           'point' => 0,
        ]);

        $customers = \App\Models\User::factory(10)->create(
            ['type' => 'customer']
        );

        $customers->each(function($customer) {
            return $customer->account()->create([
               'gender' => Arr::random(['pria', 'wanita']),
               'birth_date' => Carbon::now()->subDays(rand(0, 7))->format('Y-m-d'),
               'avatar' => 'storage/avatars/default_avatar.jpg',
               'refferral_code' => Random::generate(6, 'A-Z'),
               'point' => 0,
            ]);
        });
    }
}
