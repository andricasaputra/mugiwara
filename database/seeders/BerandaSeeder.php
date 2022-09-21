<?php

namespace Database\Seeders;

use App\Models\Beranda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BerandaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $beranda = new Beranda;
        $beranda->title = 'CapsuleInn, Hotel dan penginapan';
        $beranda->description = 'CapsuleInn adalah sebuah aplikasi atau platform yang digunakan untuk melakukan pemesanan hotel dengan mudah. CapsuleInn menawarkan kemudahan mencari hotel dan memberikan banyak fasilitas untuk mendukung kenyamanan pelanggan.';
        $beranda->section = 1;
        $beranda->status = 1;
        $beranda->created_by = 1;
        $beranda->save();

        $beranda = new Beranda;
        $beranda->title = 'Mencari penginapan terdekat dari lokasi anda';
        $beranda->description = 'Anda tidak perlu khawatir jika sedang bepergian jauh dari lokasi tempat tinggal anda, tidak perlu bersusah payah berkeliling mencari hotel untuk menginap. Karena, aplikasi CapsuleInn hadir untuk membantu anda mencari lokasi penginapan yang sesuai referensi dan terdekat dengan lokasi anda berada.';
        $beranda->section = 2;
        $beranda->status = 1;
        $beranda->created_by = 1;
        $beranda->save();

        $beranda = new Beranda;
        $beranda->title = 'Menjamin kepuasan pengguna dan mitra CapsuleInn';
        $beranda->description = 'Berbagai macam layanan yang disediakan oleh CapsuleInn, akan membantu anda sebagai pengguna untuk menyelesaikan permasalahan terkait dengan penginapan dan membantu anda sebagai mitra untuk mengembangkan bisnis anda dengan sangat pesat. CapsuleInn menjamin pemberian layanan terbaik demi kepuasan anda.';
        $beranda->section = 3;
        $beranda->status = 1;
        $beranda->created_by = 1;
        $beranda->save();

        $beranda = new Beranda;
        $beranda->title = 'Fitur - fitur yang tersedia di aplikasi CapsuleInn';
        $beranda->description = 'CapsuleInn memiliki banyak fitur yang dapat digunakan untuk memberikan layanan terbaik bagi pengguna CapsuleInn. Semua fitur kami sediakan untuk mendukung kepuasan anda selaku pengguna, selain itu kami merancang CapsuleInn untuk memberikan anda keuntungan selain dari layanan dengan adanya Referral.';
        $beranda->section = 4;
        $beranda->status = 1;
        $beranda->created_by = 1;
        $beranda->save();
        
        $beranda = new Beranda;
        $beranda->title = 'Apa yang pengguna lain katakan tentang kami';
        $beranda->description = '-';
        $beranda->section = 5;
        $beranda->status = 1;
        $beranda->created_by = 1;
        $beranda->save();
        
        $beranda = new Beranda;
        $beranda->title = 'Dengan membaca anda dapat menambah informasi';
        $beranda->description = '-';
        $beranda->section = 6;
        $beranda->status = 1;
        $beranda->created_by = 1;
        $beranda->save();
    }
}
