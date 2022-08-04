<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;
use Illuminate\Support\Arr;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 15; $i++) { 

            $code = Random::generate(6, 'A-Z');
            $discount = Arr::random(['percent', 'fixed']);
            $fixed_disc = Arr::random([100000, 20000, 30000, 40000, 50000, 100000]);
            $percent_disc = Arr::random([10, 20, 30, 40, 50, 60]);

            Voucher::create([
                'code' =>  $code,
                'name' => 'VOUCHER ' .  $code,
                'description' => 'Vouche diskon menginap',
                'max_uses' => 30,
                'max_uses_user' => 1,
                'type' => 'voucher',
                'category' => Arr::random(['menarik', 'rekomendasi']),
                'image' => Arr::random(['vouchers/voucher_1.png', 'vouchers/voucher_2.png', 'vouchers/voucher_3.png', 'vouchers/voucher_4.png']) ,
                'discount_amount' => $discount == 'fixed' ? $fixed_disc : NULL,
                'discount_percent' => $discount == 'percent' ? $percent_disc : NULL,
                'discount_type' => $discount,
                'starts_at' => now(),
                'is_active' => '1',
                'expires_at' => Carbon::now()->addDay(14),
                'point_needed' => $fixed_disc,
            ]);
        }
    }
}
