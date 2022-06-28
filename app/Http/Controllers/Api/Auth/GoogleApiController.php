<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use Socialite;

class GoogleApiController extends Controller
{
    public function googleLogin(Request $request)
    {
        $newUser = Customer::firstOrCreate([
            'email' => $request->email
        ], [
            'email_verified_at' => now(),
            'name' => $request->name,
            'type' => 'customer',
            'google_id' => $request->id,
            'password' => bcrypt(env('DEFAULT_PASSWORD'))
        ]);

        $newUser->account()->updateOrCreate(
            [
                'avatar' => $request->photo ?? NULL,
            ],
        );
    
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
