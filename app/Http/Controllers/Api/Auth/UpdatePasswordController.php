<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if (Hash::check($request->password, $request->user()->password)) {
            return response()->json([
                'message' => 'Success'
            ]);
        }

        return response()->json([
            'message' => 'Password yang anda masukkan salah'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed'
        ]);

        $user = $request->user();
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            'data' => $user,
            'message' => 'successfully update password'
        ]);
    }
}
