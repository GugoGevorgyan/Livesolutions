<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\LiveSolutions;

class RegisterController extends Controller
{
    public function create(Request $request)
    {

        $rules = [
            'fullName' => 'required|alpha',
            'phone' => 'required|numeric|digits_between:7,20',
            'address' => 'required',
            'passport' =>'required|alpha_num',
            'site' => 'required',
            'code' => 'required|numeric|digits_between:8,8',
            'email' => 'sometimes|required|email',
            'password' => 'required',
        ];


        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];
        try {
           $res = $this->validate($request, $rules, $customMessages);
        }catch (\Exception $err){
            return $err;
        }

        $code = Str::random(20).time();

         $toEmail = $this->send($code,$request['email']);

         if ($toEmail === 'true'){
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
             return "dashboard";
         }
         return  $request->email ." is unavailable: user not found ";
    }

    public function send($code, $email)
    {
        $toEmail = $email;

        try {
            Mail::to($toEmail)->send(new LiveSolutions($code));

        }catch (\Exception $err){
            return $err;
        }
        return 'true';
    }

    public function verify(Request $request)
    {

        DB::table('profiles')->where('status',$request->code)->update(['status'=>1]);
        return 'ok';
    }
}
