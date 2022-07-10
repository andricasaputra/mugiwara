<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\Account as AccountResource;
use Illuminate\Http\Request;

class AccountUserController extends Controller
{
    public function index()
    {
        $account = request()->user()->load('account');

        return (new AccountResource($account))
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Akun',
                ]);
    }

    public function update(UpdateAccountRequest $request)
    {
        $user = $request->user();

        if ($request->has('mobile_number') && $user->hasVerifiedMobileNumber()) {
            return response()->json([
                'message' => 'anda tidak dapat merubah nomor telepon yang sudah di verifikasi!'
            ]);
        }

        $user->update($request->validated());
        
        $user->account()->update([
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
        ]);

        return (new AccountResource($user))->additional([
            'status' => 'success',
            'message' => 'Akun berhasil diubah',
        ]);
    }
}
