<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->guard('profile')->attempt($validatedData)) {
            return response(['message' => 'Your credentials are incorrect']);
        }
        $accessToken = auth()->guard('profile')->user()->createToken('authToken')->accessToken;
        return response(['profile' => auth()->guard('profile')->user(), 'access_Token' => $accessToken]);
    }
}
