<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    protected function create(Request $request)
    {

        return Profile::create([
            'fullName' => $request['fullName'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'passport' => $request['passport'],
            'site' => $request['site'],
            'code' => $request['code'],
            'status' => Str::random(20),
            'email' => $request['email'],
            'password' => Hash::make($request['password']),

        ]);
    }

}
