<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\FeedbackMail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return csrf_token();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function email()
    {
        return "ggg";
    }


    public function store(Request $request)
    {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function show()
    {
        dd('asdcasdcsacd');
//        echo $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verify(Request $request)
    {
        $user = DB::table('profiles')->where('status',$request->code)->update('status',1);
//        $user_id =$user[0]->id;
//        Profile::where('id', $user_id)->update([
//            'status'=> 1,
//        ]);
        return 'ok';
    }

    public function send($code)
    {
//        $generete = 'hgcgfc54e76gfcgf';
        $userEmail = 'gg.@bk.ru';
        $comment = "Go to by this
                <a href=http://127.0.0.1:8000/api/verify/?code=${$code}>
                link
                </a> to verify your email";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $toEmail = "gugo.90@bk.ru";
        Mail::to($toEmail)->send(new FeedbackMail($comment));

        return 'Message sent to address ' . " " . $toEmail;
    }

}
