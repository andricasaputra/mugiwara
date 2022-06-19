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
            'token' => ['required'],
            'email' => ['required_without:mobile_number', 'email'],
            'mobile_number' => ['required_without:email', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if($request->has('email')) {
            $user = $this->resetWithEmail($request->email, $request->token);
        }elseif($request->has('mobile_number')){
            $user = $this->resetWithMobileNumber($request->mobile_number, $request->token);
        }

        if(! $this->signature){
            return $this->errorStatus('Invalid Signature (token and mobile_number)');
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        $this->cleanoldPassword()->delete();

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

    protected function resetWithEmail($email, $token)
    {
        $user = User::whereEmail($email)->first();

        $this->signature = DB::table('password_resets')
            ->whereEmail($email)
            ->whereToken($token)
            ->first();

        return $user;
    }

    protected function resetWithMobileNumber($mobile_number, $token)
    {
        $user = User::whereMobileNumber($mobile_number)->first();

        $this->signature = DB::table('password_resets')
            ->whereMobileNumber($mobile_number)
            ->whereToken($token)
            ->first();

        return $user;
    }

    protected function cleanoldPassword()
    {
        return DB::table('password_resets')
            ->whereEmail($this->signature->email)
            ->orWhere('mobile_number', $this->signature->mobile_number);
    }
}
