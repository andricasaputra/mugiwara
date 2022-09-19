<?php

namespace Database\Seeders;

use App\Models\Tambah_menu_compro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Tambah_menu_compro;
        $menu->nama_menu = 'Beranda';
        $menu->url_menu = env('APP_URL', 'http://localhost:8000');
        $menu->save();

        $menu = new Tambah_menu_compro;
        $menu->nama_menu = 'Jadi Mitra';
        $menu->url_menu = env('APP_URL', 'http://localhost:8000') . '/mitra';
        $menu->save();

        $menu = new Tambah_menu_compro;
        $menu->nama_menu = 'Hotel';
        $menu->url_menu = env('APP_URL', 'http://localhost:8000') . '/hotel';
        $menu->save();

        $menu = new Tambah_menu_compro;
        $menu->nama_menu = 'Tentang Kami';
        $menu->url_menu = env('APP_URL', 'http://localhost:8000') . '/tentang';
        $menu->save();

        $menu = new Tambah_menu_compro;
        $menu->nama_menu = 'Bantuan';
        $menu->url_menu = env('APP_URL', 'http://localhost:8000') . '/bantuan';
        $menu->save();
    }
}
