<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdatePasswordController extends Controller
{
    public function __invoke(Request $request)
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
