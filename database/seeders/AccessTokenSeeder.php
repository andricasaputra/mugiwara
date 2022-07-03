<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereType('customer')->first();

        DB::table('personal_access_tokens')->insert(
            [
                'tokenable_type' => Customer::class,
                'tokenable_id' => $user->id,
                'token' => 'ad58cc3671ea99e2c44d74d9eb154deb40226e2513f36c593e2a67989152cb33',
                'name' => 'access_token',
                'abilities' => "['*']",
                'last_used_at' => now(),
                'created_at' => now()
            ]
        );
    }
}
