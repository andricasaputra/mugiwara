<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset as ResetPassword;
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
            'reset_token' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();

        try {

            $reset_token = PasswordReset::where('token', $request->reset_token)->latest()->first();

            if(! $reset_token){
                return response()->json(['message' => 'reset token tidak ditemukan']);
            }

            if($reset_token->token != $request->reset_token){
                return response()->json(['message' => 'reset token tidak sesuai']);
            }

            if(! is_null($reset_token->email)){
                $query = 'DELETE FROM password_resets WHERE email = ?';
                DB::delete($query, [$reset_token->email]);

            } else {
                $query = 'DELETE FROM password_resets WHERE mobile_number = ?';
                DB::delete($query, [$reset_token->mobile_number]);
            }

            $request->user()->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ])->save();

            DB::commit();

            return $this->successStatus();
            
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['message' => $e->getMessage()]);
        }
    }

    protected function successStatus()
    {
        return response()->json(['message' => 'Berhasil perbarui password']);
    }

    protected function errorStatus($message = null)
    {
        return response()->json(['message' => $message ?? 'Gagal perbarui password']);
    }

}
