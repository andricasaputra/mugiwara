<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'user_id' => '1',
            'title' => 'Slider A',
            'description' => 'Untuk banner pada order 1',
            'image' => 'image.jpg',
            'order' => '1',
            'is_active' => 1
        ]);
    }
}
