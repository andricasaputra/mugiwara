<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promo = \App\Models\Promotion::create([
            'name' => 'Promo Akhir tahun',
            'description' => 'Menginap bersama keluarga tercinta',
            'is_active' => 1,
            'start_date' => '2022-08-01',
            'end_date' => '2022-12-31'
        ]);

        $promo->images()->create(['image' => '1658982553_GoSend_Promo_Cashback_GoPay_Coins_-.png']);


    }
}
