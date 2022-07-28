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
                ['name' => 'Arjuna Bamboe'],
                ['name' => 'Grand Hotel'],
                ['name' => 'Fortune Hotel'],
                ['name' => 'Astoria'],
                ['name' => 'GOlden Palace'],
                ['name' => 'Grand Izzy'],
                ['name' => 'Sriwijaya Hotel'],
                ['name' => 'Nutana Hotel'],
                ['name' => 'Sedayu hotel'],
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
                        'description' => $faker->paragraph
                    ],
                );

                // Create rooms
                for ($i=0; $i < 5; $i++) :

                    $discount_type = Arr::random(['flat', 'percent', 'none']);
                    $status = Arr::random(['available', 'booked', 'stayed']);

                   if($discount_type == 'flat'){
                        $discount = Arr::random([10000, 20000, 30000, 40000, 50000]);
                    }elseif($discount_type == 'percent'){
                         $discount = Arr::random([5, 10, 15, 20, 25]);
                    }

                    $booked_until = NULL;
                    $stayed_until = NULL;
                    if($status == 'booked'){
                        $booked_until = now()->addDays(1);
                    }elseif($status == 'stayed'){

                        $days = $faker->numberBetween(1, 3);
                        $stayed_until = now()->addDays($days);
                    }
                    
                    $type  = $faker->numberBetween(1, 3);
                    $price_1 = Arr::random([100000, 200000, 300000]);
                    $price_2 = Arr::random([300000, 400000, 500000]);
                    $price_3 = Arr::random([500000, 750000, 10000000]);

                    if($type == 1){
                        $price = $price_1;
                    }elseif($type == 2){
                       $price = $price_2;
                    }else{
                        $price = $price_3;
                    }

                    $room = [
                        'room_number' => $i + 1,
                        'type_id' => $type,
                        'max_guest' => $faker->numberBetween(1, 3),
                        'status' => $status,
                        'booked_untill' => $booked_until,
                        'stayed_untill' => $stayed_until,
                        'price' => $price,
                        'description' => $faker->paragraph
                    ];

                    if ($discount_type != 'none') {
                        $room = array_merge($room, ['discount_type' => $discount_type ]);
                        $room = array_merge($room, ['discount_amount' => $discount]);
                    }

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
