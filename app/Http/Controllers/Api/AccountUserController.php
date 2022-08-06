<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\Account as AccountResource;
use App\Models\User;
use Illuminate\Http\Request;

class AccountUserController extends Controller
{
    protected $uplaod;
    protected $files = [];
    protected $fileName = [];

    public function index()
    {
        $account = Account::where('user_id', request()->user()->id)->first();

        return response()->json([
            'data' => $account
        ]);
    }

    public function update(UpdateAccountRequest $request)
    {
        try {

            $user = $request->user();

            if ($request->has('mobile_number') && $user->hasVerifiedMobileNumber()) {
                return response()->json([
                    'message' => 'anda tidak dapat merubah nomor telepon yang sudah di verifikasi!'
                ]);
            }

            $user->update($request->validated());

            // $request->user()->name = $request->name;
            // $request->user()->mobile_number = $request->mobile_number;
            // $request->user()->save();
            
            $user->account()->update([
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
            ]);

            return (new AccountResource($user))->additional([
                'status' => 'success',
                'message' => 'Akun berhasil diubah',
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No HP Sudah Terdaftar Sebelumnya'
            ]);
        }
    }

    public function updatePhotoProfile(Request $request)
    {
        $request->validate([
            'photo_profile' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        if(! $request->hasFile('photo_profile')){

            return response()->json([
                'message' => 'filed photo profile harus diisi'
            ]);
            
        }

        $this->files = $request->file('photo_profile');

        $this->upload  = app()->make(UploadServiceInterface::class);

        $this->fileName = $this->upload->process($this->files);

        $request->user()?->account()?->update([
            'avatar' => $this->fileName
        ]);

        return new AccountResource($request->user()?->load('account'));
    }
}
