<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\NotificationInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function store(Request $request, ?NotificationInterface $notification)
    {
         $request->validate([
            'email' => ['required_without:mobile_number', 'email'],
            'mobile_number' => ['required_without:email', 'numeric'],
        ]);

        $text = $request->email ?? $request->mobile_number;

        return response()->json([
            'message' => 'reset password link telah kami kirimkan ke ' . $text
        ], 200);
    }

}
