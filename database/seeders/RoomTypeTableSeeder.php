<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RoomType::insert([
            [
                'name' => 'medium',
            ],
            [
                'name' => 'vip',
            ],
            [
                'name' => 'vvip',
            ],
        ]);
    }
}
