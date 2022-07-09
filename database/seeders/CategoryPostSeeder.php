<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryPost::create([
            'name' => 'Informasi'
        ]);
        CategoryPost::create([
            'name' => 'Tips - Trik'
        ]);
        CategoryPost::create([
            'name' => 'Gaya Hidup'
        ]);
    }
}
