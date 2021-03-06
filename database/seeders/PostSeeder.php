<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id' => '1',
            'category_post_id' => '1',
            'title' => 'Maaf Ada Kabar Nggak Enak Buat Yang Sudah Pernah Kena Omicron',
            'body' => 'Harap hati hati dan jaga jarak',
            'slug' => 'maaf-ada-kabar-nggak-enak-buat-yang-sudah-pernah-kena-omicron',
            'image' => 'image.jpg',
            'is_active' => 1
        ]);
    }
}
