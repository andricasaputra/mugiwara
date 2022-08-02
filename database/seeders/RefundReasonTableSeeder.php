<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefundReasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RefundReason::create([
            'name' => 'Perubahan Rencana Menginap'
        ]);

        \App\Models\RefundReason::create([
            'name' => 'Sudah booking ditempat lain'
        ]);

        \App\Models\RefundReason::create([
            'name' => 'Lokasi penginapan terlalu jauh'
        ]);
    }
}
