<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user.username' => 'required',
            'user.email' => 'required | email | unique:users,email',
            'user.password' => 'required',
        ]);

        $user = User::create([
            'username' => $request->input('user.username'),
            'email' => $request->input('user.email'),
            'password' => Hash::make($request->input('user.password')),
        ]);

        return response()->json([
            'user' => [
                'email' => $user->email,
                'token' => null,
                'username' => $user->username
            ]
        ], 201);
    }
}
