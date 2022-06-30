<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountPoint;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::create([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'email_verified_at' => now(),
            'mobile_number' => '0040',
            'mobile_verified_at' => now(),
            'password' => bcrypt('password'),
            'type' => 'customer'
        ]);
        Account::create([
            'user_id' => $customer->id,
            'gender' => 'pria',
            'birth_date' => '2000-01-01',
            'avatar' => null,
            'refferral_code' => '92983338',
            'point' => 1500000,
        ]);
        $accountPoin = AccountPoint::create([
            'user_id' => $customer->id,
            'voucher_id' => '1',
            'before' => '1500000',
            'after' => '1000000',
        ]);
        $customer = Account::where('user_id', $accountPoin->user_id)->first();
        $pointAkhir = $customer->point - ($accountPoin->before - $accountPoin->after);
        $customer->update([
            'point' => $pointAkhir
        ]);
    }
}
