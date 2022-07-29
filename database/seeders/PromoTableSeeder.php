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
        $promotion = \App\Models\Promotion::create([
            'name' => 'Promo Akhir tahun',
            'description' => 'Menginap bersama keluarga tercinta',
            'is_active' => 1,
            'start_date' => '2022-08-01',
            'end_date' => '2022-12-31'
        ]);

        $promotion->images()->create(['image' => '1658982553_GoSend_Promo_Cashback_GoPay_Coins_-.png']);

        $rooms = [1,2,3];

        foreach($rooms as $room_id)
        {
            $acc = \App\Models\AccomodationPromotion::create([
                'promotion_id' => $promotion->id,
                'accomodation_id' => 1,
                'room_id' => $room_id
            ]);
        }


    }
}
