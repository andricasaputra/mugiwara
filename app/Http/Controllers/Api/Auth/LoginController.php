<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
            'device_token' => ['required'],
        ]);
        

        if (! auth()->attempt($credentials)) {

             return response()->json([
                'message' => 'Identitas tersebut tidak cocok dengan data kami.'
            ], 401);
        }

        $user = auth()->user();

        $user->update([
            'device_token' => $request->device_token
        ]);

        return (new UserResource($user))->additional([
            'data' => [
                'token' => $user->createToken('access_token')->plainTextToken,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->validate([
            'device_token' => ['required'],
        ]);

        $request->user()->update([
            'device_token' => NULL
        ]);

        $request->user()->tokens()->delete();
    }
}
