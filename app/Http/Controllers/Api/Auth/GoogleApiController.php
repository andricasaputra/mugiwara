<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use Socialite;
use Nette\Utils\Random;

class GoogleApiController extends Controller
{
    public function googleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required'
        ]);

        $newUser = Customer::firstOrCreate([
            'email' => $request->email
        ], [
            'email_verified_at' => now(),
            'name' => $request->name,
            'type' => 'customer',
            'google_id' => $request->id,
            'password' => bcrypt(env('DEFAULT_PASSWORD'))
        ]);

        if($newUser->account()->refferral_code == NULL){
            $newUser->account()->updateOrCreate(
                [
                    'avatar' => $request->photo ?? NULL,
                ],
                [
                    'refferral_code' => Random::generate(6, 'A-Z'),
                    'point' => 0
                ]
            );
        } else{
            $newUser->account()->updateOrCreate(
                [
                    'avatar' => $request->photo ?? NULL,
                ],
                [
                    'point' => 0
                ]
            );
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
