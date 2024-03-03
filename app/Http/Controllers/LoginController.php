<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user.email' => 'required|email',
            'user.password' => 'required',
        ]);

        $credentials = [
            'email' => $request->input('user.email'),
            'password' => $request->input('user.password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'user' => [
                    'email' => $user->email,
                    'token' => $token
                ]
            ], 200);
        } else {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }
}
