<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm(Request $request,$token)
    {

        $result_rs = DB::select(DB::raw("select * from `admins` where `token` = '$token' and `status` = 1 limit 1;"));
        if(count($result_rs)>0){
            return view('admin.auth.reset_password', compact('result_rs'));
        }else{
            return Redirect()->route('admin.login')->with(['message'=>'Invalid Link','class'=>'error']);
        }
        
    }
}
