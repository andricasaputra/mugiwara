<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Account;
use App\Models\Customer;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Socialite;

class GoogleApiController extends Controller
{
    public function googleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'device_token' => 'required'
        ]);

        $newUser = Customer::firstOrCreate([
            'email' => $request->email,
            'device_token' => $request->device_token
        ], [
            'email_verified_at' => now(),
            'name' => $request->name,
            'type' => 'customer',
            'google_id' => $request->id,
            'password' => bcrypt(env('DEFAULT_PASSWORD')),
        ]);

        $account = Account::where('user_id', $newUser->id)->first();

        if(! $account){
            Account::create([
                'user_id' => $newUser->id,
                'avatar' => $request->photo ?? NULL,
                'refferral_code' => Random::generate(6, 'A-Z'),
                'point' => 0
            ]);
        }

        $token = $newUser->createToken('access_token');

        return (new UserResource($newUser))->additional(
            [
                'data' => [
                    'token' => $token->plainTextToken,
                ],
            ]
        );
    }
}
