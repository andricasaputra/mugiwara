<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\CustomRegistered;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Nette\Utils\Random;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string'],
            'birth_date' => ['required', 'date'],
            'mobile_number' => ['required', 'string', 'max:13', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'otp_verify_code' => Random::generate(6, 1234567890),
            'mobile_attempts_left' => 0,
            'password' => Hash::make($request->password),
            'type' => 'customer',
        ]);

        $token = $user->createToken('access_token');
        
        //event(new CustomRegistered($user));
        event(new Registered($user));

        return (new UserResource($user))->additional(
            [
                'data' => [
                    'token' => $token->plainTextToken,
                    'message' => 'silahkan lakukan verifikasi alamat email anda',
                    'verifcation_url' => route('api.otp.verification'),
                    'resend_email_url' => route('api.otp.verification.resend')
                ],
            ]
        );
    }
}
