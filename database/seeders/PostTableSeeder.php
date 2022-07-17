<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            'post_1.jpg',
            'post_2.jpg',
            'post_3.jpg',
            'post_4.jpg',
            'post_5.jpg',
            'post_6.jpg',
            'post_7.jpg',
            'post_8.jpg',
            'post_9.jpg',
            'post_10.jpg',
        ];

        $faker = app(Generator::class);

        for ($i=0; $i < 25; $i++) { 
            \App\Models\Post::create([
                'user_id' => $faker->numberBetween(2, 5),
                'category_post_id' => $faker->numberBetween(1, 3),
                'title' => Arr::random(['What is Lorem Ipsum?', 'Why do we use it?', 'Where does it come from?']),
                'body' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32',
                'slug' => Arr::random([Str::slug('What is Lorem Ipsum?'), Str::slug('Why do we use it?'), Str::slug('Where does it come from?')]),
                'image' =>  Arr::random($images),
                'is_active' => 1
            ]);
        }
    }
}
