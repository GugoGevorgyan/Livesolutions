<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Http\Controllers\Api\LoginController;

class RegisterController extends Controller
{
    protected function create(Request $request)
    {
//$code= Str::random(20) + timestamp;
         Profile::create([
            'fullName' => $request['fullName'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'passport' => $request['passport'],
            'site' => $request['site'],
            'code' => $request['code'],
            'status' => $code,
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['role_id'],

        ]);
        //1 maili uxarkum yst statusi  send($code)
//        $ban = send($code)
//        if ($ban){
//            login
//        }else {
//            sxal ej
//        }
        //verify

//        $data = ['email' => $request['email'], 'password' =>$request['password']];
//        $login = new LoginController();
//        return $login->login($request);
//        return route('login')->with(  $request );
    }

}
