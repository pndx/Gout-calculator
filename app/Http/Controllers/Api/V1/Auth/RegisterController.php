<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request): array
    {
        $register = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $register['password'] = bcrypt($request->input('password'));

        $user = User::create($register);

        $accessToken = $user->createToken('authToken')->accessToken;

        return ['access_token' => $accessToken];
    }
}
