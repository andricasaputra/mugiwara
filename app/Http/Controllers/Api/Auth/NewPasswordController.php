<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
    protected $signature;
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('mobile.mobile-reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'otp_code' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if($request->user()->otp_verify_code != $request->otp_code){
            return response()->json([
                'message' => 'kode otp tidak sesuai'
            ]);
        }

        $request->user()->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        return $this->successStatus();
    }

    protected function successStatus()
    {
        return response()->json(['message' => 'berhasil perbarui password']);
    }

    protected function errorStatus($message = null)
    {
        return response()->json(['message' => $message ?? 'gagal perbarui password']);
    }

}
