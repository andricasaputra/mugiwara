<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccomodationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {

            $accomodation = \App\Models\Accomodation::create(
                [
                    'name' => 'Arjuna Bamboe',
                    'province_id' => 18,
                    'regency_id' => 1871,
                    'address' => 'Jln. Majapahit No. 119 Bandar Lampung'
                ],
            );

            $room = $accomodation->room()->create(
                [
                    'room_number' => '01',
                    'type_id' => 1,
                    'max_guest' => 2,
                    'price' => 300000,
                    'discount_type' => 'flat',
                    'discount_amount' => 50000,
                ]
            );

            $room->facilities()->attach([
                [
                    'facility_id' => 1
                ],
                [
                    'facility_id' => 2
                ],
            ]);

            $room->images()->createMany([
                [
                    'image' => 'room_1.jpg' ,
                ],
                [
                    'image' => 'room_2.jpg' ,
                ],
                [
                    'image' => 'room_3.jpg' ,
                ],
                [
                    'image' => 'room_4.jpg' ,
                ],
            ]);

            $room = $accomodation->room()->create(
                [
                    'room_number' => '02',
                    'type_id' => 2,
                    'max_guest' => 2,
                    'price' => 200000,
                    'discount_type' => 'percent',
                    'discount_amount' => 25,
                ]
            );

            $room->facilities()->attach([
                [
                    'facility_id' => 1
                ],
            ]);

            $room->images()->createMany([
                [
                    'image' => 'room_1.jpg' ,
                ],
                [
                    'image' => 'room_2.jpg' ,
                ],
                [
                    'image' => 'room_3.jpg' ,
                ],
            ]);

            // Accomodation 2
            $accomodation2 = \App\Models\Accomodation::create(
                [
                    'name' => 'Lampung Inn',
                    'province_id' => 18,
                    'regency_id' => 1871,
                    'address' => 'Jln. Majapahit No. 200 Bandar Lampung'
                ],
            );

            $room2 = $accomodation2->room()->create(
                [
                    'room_number' => '02',
                    'type_id' => 1,
                    'max_guest' => 1,
                    'price' => 500000,
                ]
            );

            $room2->facilities()->attach([
                [
                    'facility_id' => 1
                ],
                [
                    'facility_id' => 2
                ],
                [
                    'facility_id' => 3
                ],
            ]);

            $room2->images()->createMany([
                [
                    'image' => 'room_1.jpg' ,
                ],
                [
                    'image' => 'room_2.jpg' ,
                ],
                [
                    'image' => 'room_3.jpg' ,
                ],
                [
                    'image' => 'room_4.jpg' ,
                ],
            ]);

            $accomodation3 = \App\Models\Accomodation::create(
                [
                    'name' => 'Grand Capsuule',
                    'province_id' => 18,
                    'regency_id' => 1872,
                    'address' => 'Jln. Jendral Sudirman No. 12 Lampung'
                ],
            );

            $room3 = $accomodation3->room()->create(
                [
                    'room_number' => '01',
                    'type_id' => 1,
                    'max_guest' => 3,
                    'price' => 400000,
                ]
            );

            $room3->facilities()->attach([
                [
                    'facility_id' => 1
                ],
                [
                    'facility_id' => 2
                ],
                [
                    'facility_id' => 3
                ],
            ]);

            $room3->images()->createMany([
                [
                    'image' => 'room_1.jpg' ,
                ],
                [
                    'image' => 'room_2.jpg' ,
                ],
                [
                    'image' => 'room_3.jpg' ,
                ],
                [
                    'image' => 'room_4.jpg' ,
                ],
            ]);

            $room3 = $accomodation3->room()->create(
                [
                    'room_number' => '02',
                    'type_id' => 3,
                    'max_guest' => 2,
                    'price' => 1000000,
                    'discount_type' => 'flat',
                    'discount_amount' => 70000,
                ]
            );

            $room3->facilities()->attach([
                [
                    'facility_id' => 1
                ],
                [
                    'facility_id' => 2
                ],
                [
                    'facility_id' => 3
                ],
                [
                    'facility_id' => 4
                ],
            ]);

            $room3->images()->createMany([
                [
                    'image' => 'room_1.jpg' ,
                ],
                [
                    'image' => 'room_2.jpg' ,
                ],
                [
                    'image' => 'room_3.jpg' ,
                ],
                [
                    'image' => 'room_4.jpg' ,
                ],
            ]);

            DB::commit();

            
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
        }

    }

}
