<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Facility::insert([
            [
                'name' => 'wifi',
                'image' =>  'wifi.png',
            ],
            [
                'name' => 'bathub',
                'image' =>  'bathub.png',
            ],
            [
                'name' => 'sarapan',
                'image' =>  'sarapan.png',
            ],
            [
                'name' => 'swimming_pool',
                'image' =>  'pool.png',
            ],
            [
                'name' => 'large_bed',
                'image' =>  'large_bed.png',
            ],
        ]);
    }
}
