<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Faker\Generator;

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

            $accLists = [
                [   
                    'name' => 'Arjuna Bamboe', 
                    'longitude' => '-5.382', 
                    'latitude' => '10.525921'
                ],
                [
                    'name' => 'Grand Hotel',
                    'longitude' => '--5.43226,', 
                    'latitude' => '10.525822'
                ],
                [
                    'name' => 'Fortune Hotel',
                     'longitude' => '-542.629', 
                     'latitude' => '10.525122'
                ],
                [
                    'name' => 'Astoria',
                    'longitude' => '-544.013', 
                    'latitude' => '10.525466'
                ],
                [
                    'name' => 'GOlden Palace',
                     'longitude' => '-5.382', 
                    'latitude' => '10.525921'
                ],
                [
                    'name' => 'Grand Izzy',
                    'longitude' => '-567.372', 
                    'latitude' => '10.553324'
                ],
                [
                    'name' => 'Sriwijaya Hotel',
                    'longitude' => '-5.382', 
                    'latitude' => '10.525921'
                ],
                [
                    'name' => 'Nutana Hotel',
                    'longitude' => '-5.382', 
                    'latitude' => '10.525921'
                ],
                [
                    'name' => 'Sedayu hotel',
                    'longitude' => '-5.382', 
                    'latitude' => '10.525921'
                ],
            ];

            $faker = app(Generator::class);

            foreach($accLists as $acc):

                $province = Arr::random([
                    ['id' => 18 ], 
                    ['id' => 31 ], 
                    ['id' => 34 ], 
                    ['id' => 35 ], 
                    ['id' => 51 ],
                ]);

                $regency = \App\Models\Regency::where('province_id', $province['id'])->first();
                $districts = \App\Models\District::where('regency_id', $regency['id'])->first();

                // Create Accomodation
                $accomodation = \App\Models\Accomodation::create(
                    [
                        'name' => $acc['name'],
                        'province_id' => $province['id'],
                        'regency_id' => $regency->id,
                        'districts_id' => $districts->id,
                        'address' => $faker->address(),
                        'description' => $faker->paragraph,
                        'lat' => $acc['latitude'],
                        'lang' => $acc['longitude'],
                    ],
                );

                // Create rooms
                for ($i=0; $i < 15; $i++) :

                    $status = Arr::random(['available', 'booked', 'stayed']);

                    $booked_until = NULL;
                    $stayed_until = NULL;
                    if($status == 'booked'){
                        $booked_until = now()->addDays(1);
                    }elseif($status == 'stayed'){

                        $days = $faker->numberBetween(1, 3);
                        $stayed_until = now()->addDays($days);
                    }
                    
                    $type  = $faker->numberBetween(1, 3);
                    $price_1 = 300000;
                    $price_2 = 500000;
                    $price_3 = 10000000;

                    if($type == 1){
                        $price = $price_1;
                        $discount_type = NULL;
                        $discount = NULL;
                    }elseif($type == 2){
                       $price = $price_2;
                       $discount_type = 'percent';
                       $discount = 10;
                    }else{
                        $price = $price_3;
                        $discount_type = 'flat';
                        $discount = 200000;
                    }

                    $room = [
                        'room_number' => $i + 1,
                        'type_id' => $type,
                        'max_guest' => $faker->numberBetween(1, 3),
                        'status' => $status,
                        'booked_untill' => $booked_until,
                        'stayed_untill' => $stayed_until,
                        'price' => 1000,
                        'description' => $faker->paragraph,
                        'discount_type' => $discount_type,
                        'discount_amount' => $discount
                    ];

                    $room = $accomodation->room()->create($room);

                    $images = $this->imagesList();

                    // Create room facilities, images, reviews
                    for ($j=0; $j < 10; $j++) { 

                       $facilities = Arr::random(\App\Models\Facility::get()
                                ->map(fn($f) => ['facility_id' => $f['id']])->toArray());

                        $room->facilities()->detach($facilities);
                        $room->facilities()->attach($facilities);

                        $room->images()->updateOrCreate(Arr::random($images));

                        $room->reviews()->create(
                            [
                                'user_id' => $faker->numberBetween(10, 18),
                                'comment' => $faker->paragraph,
                                'rating' => $faker->numberBetween(3, 5),
                            ]
                        );
                    }

                endfor;

            endforeach;

            DB::commit();

        } catch (\Exception $e) {

            dd($e->getMessage());

            DB::rollback();
        }

    }

    protected function imagesList()
    {   
         return [
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
            [
                'image' => 'room_5.jpg' ,
            ],
            [
                'image' => 'room_6.jpg' ,
            ],
            [
                'image' => 'room_7.jpg' ,
            ],
            [
                'image' => 'room_8.jpg' ,
            ],
            [
                'image' => 'room_9.jpg' ,
            ],
            [
                'image' => 'room_10.jpg' ,
            ],
            [
                'image' => 'room_11.jpg' ,
            ],
        ];
    }

}
