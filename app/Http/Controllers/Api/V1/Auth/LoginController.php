<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	$login = $request->validate([
    		'email'    => 'required|email',
    		'password' => 'required|string',
    	]);

    	if (!Auth::attempt($login) || !$user = Auth::user()) {
    		return ['message' => 'Invalid login credentials.'];
    	}

    	$accessToken = $user->createToken('authToken')->accessToken;

    	return ['access_token' => $accessToken];
    }
}
