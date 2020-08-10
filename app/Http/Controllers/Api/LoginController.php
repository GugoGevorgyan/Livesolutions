<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
                $validatedData = $request->validate([
                    'email' => 'email|required',
                    'password' => 'required',
                ]);
                if (!auth()->attempt($validatedData)){
                    return response(['message' => 'Your credentials are incorrect']);
                }
                $accessToken = auth()-> user()->createToken('authToken')->accessToken;
                return response(['user' => auth()->user(), 'access_Token' => $accessToken]);
    }
}
