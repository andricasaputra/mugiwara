<?php

namespace Database\Seeders;

use App\Models\Room;
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

        $room = Room::find(1);

        $promotion = \App\Models\Promotion::create([
            'accomodation_id' => 1,
            'room_number' => $room->room_number,
            'room_type' => $room->type->name,
            'name' => 'Promo Akhir tahun',
            'description' => 'Menginap bersama keluarga tercinta',
            'is_active' => 1,
            'start_date' => '2022-08-01',
            'end_date' => '2022-12-31'
        ]);

        $promotion->images()->create(['image' => '1658982553_GoSend_Promo_Cashback_GoPay_Coins_-.png']);


    }
}
