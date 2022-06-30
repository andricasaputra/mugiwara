<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::create([
            'code' => 'v-01',
            'name' => 'Voucher A',
            'description' => 'Desk A',
            'uses_count' => '0',
            'max_uses' => '1',
            'max_uses_user' => '1',
            'type' => 'voucher',
            'category' => 'menarik',
            'image' => 'asdfsa',
            'discount_amount' => null,
            'discount_percent' => '10',
            'discount_type' => 'percent',
            'starts_at' => Carbon::now()->addDay(7),
            'is_active' => '1',
            'expires_at' => Carbon::now()->addDay(14),
            'point_needed' => '500000',
        ]);
    }
}
