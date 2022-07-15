<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Generator;
use Nette\Utils\Random;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        for ($i=0; $i < 10; $i++) { 
            \App\Models\Office::create([
                'name' => Arr::random(['Kantor ' . Random::generate(6, 'A-Z'), 'Kanotr' . Random::generate(6, 'A-Z')]),
                'type' => Arr::random(['main_office', 'sub_office']),
                'address' => $faker->address(),
                'mobile_number' => $faker->phoneNumber,
                'user_id' => $faker->numberBetween(2, 8),
                'accomodation_id' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
