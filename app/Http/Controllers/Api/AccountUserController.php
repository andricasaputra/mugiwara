<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account as ResourcesAccount;
use App\Http\Resources\Point as ResourcesPoint;
use App\Models\Account;
use App\Models\AccountPoint;
use App\Models\Point;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountUserController extends Controller
{
    public function index()
    {
        $account = User::where('id', auth()->user()->id)->with('account')->first();
        $account = new ResourcesAccount($account);
        return $account
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Akun',
                ]);
    }
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
        ]);
        Account::where('user_id', $user->id)->update([
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
        ]);
        $user = new ResourcesAccount($user);
        return $user
                ->additional([
                    'status' => 'success',
                    'message' => 'Akun berhasil diubah',
                ]);
    }
}
