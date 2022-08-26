<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IndoRegionSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);

        $this->call([
            UserTableSeeder::class,
            CustomerSeeder::class,
            CategoryPostSeeder::class,
            //PostSeeder::class,
            SliderSeeder::class,
            FacilityTableSeeder::class,
            TypeTableSeeder::class,
            //ProductSeeder::class,
            VoucherSeeder::class,
            AccessTokenSeeder::class,
            AccomodationTableSeeder::class,
            OfficeTableSeeder::class,
            PostTableSeeder::class,
            PromoTableSeeder::class,
            RefundReasonTableSeeder::class,
            ManajemenMenuTableSeeder::class,
        ]);
    }
}
