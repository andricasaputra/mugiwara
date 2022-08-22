<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\NotificationInterface;
use App\Events\ForgotPasswordEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Nette\Utils\Random;
use illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PasswordResetLinkController extends Controller
{
    protected $resend_url;

    public function store(Request $request)
    {

        $request->validate([
            'email' => ['required_without:mobile_number', 'email'],
            'mobile_number' => ['required_without:email', 'numeric'],
        ]);

        DB::beginTransaction();

        try {

            $text = $request->email ?? $request->mobile_number;

            $user = $this->checkUser($request->email, $request->mobile_number);

            if (! $user) {
                return response()->json([
                    'message' => 'User tidak ditemukan'
                ], 404);
            }

            $user->otp_verify_code = Random::generate(6, 1234567890);
            $user->save();

            $reset_token = Str::random(16);

            $password_reset = PasswordReset::create([
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'reset_token' => $reset_token,
                'token' => $reset_token,
                'created_at' => now()
            ]);

            event(new ForgotPasswordEvent($user, $request));

            $token = $user->createToken('access_token');

            DB::commit();

            return (new UserResource($user))->additional(
                [
                    'data' => [
                        'reset_token' => $reset_token,
                        'token' => $token->plainTextToken,
                        'message' => 'kode otp telah kami kirim ke ' . $text,
                        'verifcation_url' => route('api.reset.password.post'),
                        'resend_url' => $this->resend_url
                    ],
                ]
            );
            
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'message' => $e->getMessage()
            ], 403);
        }
    }

    private function checkUser($email = null, $mobile = null)
    {
        if (isset($email) && $email) {
            $this->resend_url = route('api.otp.verification.resend.email');
            return Customer::whereEmail($email)->first();
        }

        if (isset($mobile) && $mobile) {
            $this->resend_url = NULL; //route('api.otp.verification.resend.whatsapp');
            $user = Customer::whereMobileNumber($mobile)->first();

            if (is_null($user?->mobile_verified_at)) {
                throw new \Exception('Nomor HP belum diverifikasi');
            }

            return $user;
        }

        return false;
    }

}
