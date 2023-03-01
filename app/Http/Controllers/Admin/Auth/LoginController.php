<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
// use App\Student;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
        $this->middleware('student.guest');
    }


  public function showLoginForm(){
    return view('admin.auth.login');
  }
 

  public function login(Request $request){ 
    $this->validate($request, [
        'email' => 'required', 
        'password' => 'required',
        'captcha' => 'required|captcha' 
    ]);

    $email = str_replace("'", "", trim($request->email));
    
    $result_rs = DB::select(DB::raw("select * from `admins` where `email` = '$email' and `status` = 2 limit 1;"));
    $rs_count = count($result_rs);
    if ($rs_count >0) {
      return redirect()->route('student.resitration.verification',Crypt::encrypt($result_rs[0]->id)); 
    }
    $credentials = [
               'email' => $request['email'],
               'password' => $request['password'],
               'status' => 1,
           ]; 
    if(auth()->guard('admin')->attempt($credentials)) {

      return redirect()->route('admin.dashboard');     
    } 
    
    return Redirect()->back()->with(['message'=>'Invalid User or Password','class'=>'error']);    
  }

  public function forgetPassword()
  {
    return view('admin.auth.forget_password');
  }

 
  public function refreshCaptcha()
  {  
    return  captcha_img('math');
  }

  public function forgetPasswordSendLink(Request $request)
  {
    
    $emailID = $request->email; 
    $result_rs = DB::select(DB::raw("select * from `admins` where `email` = '$emailID' and `status` = 1 limit 1;"));
    if (count($result_rs)>0){
      $mailHelper = new MailHelper();
      $mailHelper->forgetmail($request->email);
                     
      $response=array();
      $response['status']=1;
      $response['msg']='Reset Link Sent successfully';  
    }else{
      $response=array();
      $response['status']=0;
      $response['msg']='Invalid Email-Id';
    }
    
    return $response;

  }


  public function resetPassword(Request $request, $userid)
  {
    $this->validate($request, [
        'new_password' => 'required', 
        'confirm_password' => 'required|same:new_password',
    ]);
    $user_id = Crypt::decrypt($userid);
    $password = $request->new_password;
    $confirm_password = $request->confirm_password;

    if($password == $confirm_password){
      $password = bcrypt($request->new_password);
      $result_rs = DB::select(DB::raw("update `admins` set `password` = '$password', `token` = null where `id` = $user_id limit 1;"));
      return Redirect()->route('admin.login')->with(['message'=>'Password Reset Successfully','class'=>'sucess']);
    }else{
      return Redirect()->back()->with(['message'=>'Password and Confirm Password Not Matched','class'=>'error']);  
    }
  }

     // Logout method with guard logout for admin only
  public function logout()
  {
    $this->guard()->logout();
    return redirect()->route('vms.erplogin');
  }
 

  protected function credentials(Request $request)
  {
      // return $request->only($this->username(), 'password');
      return ['email'=>$request->{$this->username()},'password'=>$request->password,'status'=>'1'];
  }


 //    public function index(){
 //        return redirect()->route('admin.login');
        
 //    }
    
    
 //    public function loginApi($id){ 
 //      $user= auth()->guard('admin')->loginUsingId($id);

 //    }
  

    
    //defining auth  guard
  protected function guard()
  {
    return Auth::guard('admin');
  }
    
}
