<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use Socialite;

class GoogleController extends Controller 
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function callback()
    {
        try {
    
            $googleUser = Socialite::driver('google')->user();
            $user = Customer::whereEmail($googleUser->email)->first();
     
            if(!$user){
                $user = $this->createOrUpdate($googleUser);
            }

            $user->google_id ?? $user->update(['google_id' => $googleUser->id]);

            $token = $user->createToken('access_token');

            return (new UserResource($user))->additional(
                [
                    'data' => [
                        'token' => $token->plainTextToken,
                    ],
                ]
            );
    
        } catch (\Throwable $e) {
            return response()->json(['message' => 'unauthenticated']);
        }
    }

    public function createOrUpdate($user)
    {
        return Customer::updateOrCreate([
            'name' => $user->name,
            'email' => $user->email,
            'google_id'=> $user->id,
            'type' => 'customer',
            'password' => bcrypt('password'),
        ]);
    }
}
