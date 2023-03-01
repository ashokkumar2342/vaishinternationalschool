<?php

namespace App\Http\Controllers\Admin;

use App\Events\SmsEvent;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Mail;
use PDF;
use App\Helper\MyFuncs;
use App\Helper\SelectBox;
use Symfony\Component\HttpKernel\DataCollector\collect;

class AccountController extends Controller
{

  public function removeSpacialChr($strValue)
  {
    $newString = trim(str_replace('\'', '', $strValue));
    $newString = trim(str_replace('\\', '', $newString));
    return $newString;
  }

  public function studentNewRegistrationStore(Request $request)
  {  
    $this->validate($request,[
          'name' => 'required',             
          'email' => 'required|email|max:50|unique:admins',             
          'mobile' => 'required|numeric|digits:10|unique:admins',             
          'password' => 'required|min:6',
          'password_confirm' => 'required_with:password|same:password|min:6',
          'captcha' => 'required|captcha'             
          ]);

    $name = $this->removeSpacialChr($request->name);
    $email = $this->removeSpacialChr($request->email);
    $password = $this->removeSpacialChr($request->password);
    $en_password = bcrypt($request['password']);
    
    $otp_mobile=rand(1000,9999); 
    $otp_email=rand(1000,9999);
    $insert_rs = DB::select(DB::raw("insert into `admins` (`first_name`, `email` , `mobile` , `password` , `password_plain`, `role_id`, `status` ) values ('$name', '$email', '$request->mobile', '$en_password', '$password',  12, 2);"));

    $userid = DB::select(DB::raw("select `id` from `admins` where `email` = '$email';"));
    $user_id = $userid[0]->id;

    $message =$otp_email;         
    $emailto = $email;         
    $subject = 'Otp'; 
    $up_u=array(); 
    $up_u['medicalInfo']=$message;
    $up_u['subject']=$subject; 
    $up_u['data']='Test Api Integration Successfully'; 
    // $mailHelper =new MailHelper(); 
    // $mailHelper->mailsend('emails.message',$up_u,'No-Reply',$subject,$emailto,'noreply@eageskool.com',5); 

    $data = array( 'email' => $emailto, 'data' => $message, 'from' => 'noreply@eageskool.com', 'from_name' => 'eageskool' );
    Mail::send('emails.message', $data, function( $message ) use ($data)
    {
      $message->to( $data['email'] )->from( $data['from'], 'eageskool' )->subject( 'Test Api Integration Successfully' );
    }); 
    $result_rs = DB::select(DB::raw("insert into `admins_otp` (`admin_id`, `otp`, `otp_type`, `valid_upto`, `otp_verified`) values ($user_id, $otp_mobile, 1, '2023-02-11', 0 )"));
    $result_rs = DB::select(DB::raw("insert into `admins_otp` (`admin_id`, `otp`, `otp_type`, `valid_upto`, `otp_verified`) values ($user_id, $otp_email, 2, '2023-02-11', 0 )"));

    
    $new_id = $userid[0]->id;
    return redirect()->route('student.resitration.verification',Crypt::encrypt($new_id))->with(['message'=>'Account created Successfully.','class'=>'success']); 
  }



  //registration parent-----------
  public function firststep()
  {
    return view('front.registration.firststep');
  }


  public function resendOTP(Request $request,$user_id,$otp_type)
  {
    if ($otp_type==1) {
      $rs_fetch = DB::select(DB::raw("select * from `admins_otp` where `admin_id` = $user_id and `otp_verified` = 1 limit 1;"));
    }
    if ($otp_type==2) {
      $rs_fetch = DB::select(DB::raw("select * from `admins_otp` where `admin_id` = $user_id and `otp_verified` = 2 limit 1;"));
      $rs_email = DB::select(DB::raw("select * from `admins` where `id` = $user_id limit 1;"));
      $message =$rs_fetch[0]->otp;         
      $emailto = $rs_email[0]->email;         
      $subject = 'Otp'; 
      $up_u=array(); 
      $up_u['medicalInfo']=$message;
      $up_u['subject']=$subject; 
      $up_u['data']='Test Api Integration Successfully'; 
      // $mailHelper =new MailHelper(); 
      // $mailHelper->mailsend('emails.message',$up_u,'No-Reply',$subject,$emailto,'noreply@eageskool.com',5); 

      $data = array( 'email' => $emailto, 'data' => $message, 'from' => 'noreply@eageskool.com', 'from_name' => 'eageskool' );
      Mail::send('emails.message', $data, function( $message ) use ($data)
      {
        $message->to( $data['email'] )->from( $data['from'], 'eageskool' )->subject( 'Test Api Integration Successfully' );
      });
    }


    
    return redirect()->back()->with(['message'=>'OTP Resend Successfully.','class'=>'success']); 
  }

  public function otpVerify(Request $request)
  { 
    
    $user_id = $request->user_id;   
    $mobile_otp = MyFuncs::removeSpacialChr($request->mobile_otp);   
    $email_otp = MyFuncs::removeSpacialChr($request->email_otp);

    $verified_otp_mobile = 1;
    $verified_otp_email = 1;
    
    if (!empty($mobile_otp)) {
      $rs_update = DB::select(DB::raw("call `up_verify_registration_otp`($user_id, 1, '$mobile_otp')"));
      $status = $rs_update[0]->status;
      $all_verified = $rs_update[0]->all_verified;
      $remarks = $rs_update[0]->remarks;

      $verified_otp_mobile = $status;

      $l_class = 'error';
      if($status == 1){
        $l_class = 'success';  
      }
      
      if($all_verified == 1){
        return redirect()->route('vms.erplogin')->withErrors(['message'=>'Otp Verified Successfully','class'=>'success']);  
      }
    }

    if (!empty($email_otp)) {
      $rs_update = DB::select(DB::raw("call `up_verify_registration_otp`($user_id, 2, '$email_otp')"));
      $status = $rs_update[0]->status;
      $all_verified = $rs_update[0]->all_verified;
      $remarks = $rs_update[0]->remarks;

      $verified_otp_email = $status;

      $l_class = 'error';
      if($status == 1){
        $l_class = 'success';  
      }
      
      if($all_verified == 1){
        return redirect()->route('vms.erplogin')->withErrors(['message'=>'Otp Verified Successfully','class'=>'success']);  
      }
    }

    if($verified_otp_mobile == 0 || $verified_otp_email == 0){
      return redirect()->back()->withErrors(['Invalid OTP']);  
    }else{
      return redirect()->back()->withErrors(['message'=>'Otp Verified Successfully','class'=>'success']);
    }
    
  }

  // public function verifyEmail(Request $request)
  // {
  //   $this->validate($request,[                
  //        'email_otp' => 'required|numeric',  
  //        ]);
      
  //   $user_id = $request->userid;   
  //   $email_rs = DB::select(DB::raw("select * from `admins_otp` where `admin_id` = $user_id and `otp_type` = 2 and `otp` = $request->email_otp limit 1;"));
  //   $count_rs = count($email_rs); 
  //   if ($count_rs >= 1) {
  //       $update_rs = DB::select(DB::raw("update `admins_otp` set `otp_verified` = 1 where `admin_id` = $user_id and `otp_type` = 2 limit 1;"));

  //       $result_rs = DB::select(DB::raw("select * from `admins_otp` where `admin_id` = $user_id and `otp_verified` = 1 limit 2;"));
  //       $count_rs = count($result_rs); 
  //       if($count_rs == 2){
  //         return redirect()->route('admin.login')->with(['class'=>'success','message'=>'EMail Otp Verified Successfully']);
  //       }
  //       return redirect()->back()->with(['class'=>'success','message'=>'EMail Otp Verified Successfully']);      
  //   }
  //   return redirect()->back()->with(['class'=>'error','message'=>'Invalid OTP, Please Try Again']);

  // }
  

  // public function verifyMobile(Request $request)
  // {  
  //   $this->validate($request,[              
  //       'mobile_otp' => 'required|numeric',  
  //       ]);
  //   $user_id = $request->userid;   
  //   $mobile_rs = DB::select(DB::raw("select * from `admins_otp` where `admin_id` = $user_id and `otp_type` = 1 and `otp` = $request->mobile_otp limit 1;"));
  //   $count_rs = count($mobile_rs); 
  //   if ($count_rs >= 1) {
  //       $update_rs = DB::select(DB::raw("update `admins_otp` set `otp_verified` = 1 where `admin_id` = $user_id and `otp_type` = 1 limit 1;"));

  //       $result_rs = DB::select(DB::raw("select * from `admins_otp` where `admin_id` = $user_id and `otp_verified` = 1 limit 2;"));
  //       $count_rs = count($result_rs); 
  //       if($count_rs == 2){
  //         return redirect()->route('admin.login')->with(['class'=>'success','message'=>'Mobile Otp Verified Successfully']);
  //       }
  //       return redirect()->back()->with(['class'=>'success','message'=>'Mobile Otp Verified Successfully']);      
  //   }
  //   return redirect()->back()->with(['class'=>'error','message'=>'Invalid OTP, Please Try Again']);
  // }

  
  public function verification($id)
  {

    $user_id = Crypt::decrypt($id);
    $result_rs = DB::select(DB::raw("select * from `admins` where `id` = '$user_id' limit 1;"));
    $result_rs = reset($result_rs);
    $mobile_no = $result_rs->mobile;
    $email_id = $result_rs->email;
    $mobile_rs = DB::select(DB::raw("select * from `admins_otp` where `admin_id` = $user_id and `otp_type` = 1 limit 1;"));
    $email_rs = DB::select(DB::raw("select * from `admins_otp` where `admin_id` = $user_id and `otp_type` = 2 limit 1;"));

    return view('front.registration.verification',compact('mobile_rs','email_rs', 'user_id'));
  }


//----------------End --------------------------


  Public function index()
  {  	
    $accounts = DB::select(DB::raw("select `us`.`id`, concat(`us`.`first_name`, ' ', ifnull(`us`.`last_name`,'')) as `user_name`, `us`.`email`, `us`.`mobile`, `us`.`status`, `ro`.`name` as `role` from `admins` `us` inner join `roles` `ro` on `ro`.`id` = `us`.`role_id` where `us`.`id` > 1 order by `us`.`first_name`; "));
    return view('admin.account.list',compact('accounts'));
  }

  public function pdfGenerate()
  {
    $report_header = "Users List";
    $tcols = 6;
    $qcols = array(
      array('Sr. No.',10),
      array('User Name',20),
      array('Email ID',25),
      array('Mobile No.',15),
      array('Role',15),
      array('Status',15)
    );

    // $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `code` from `categories`;");
    $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, concat(`us`.`first_name`, ' ', ifnull(`us`.`last_name`,'')) as `user_name`, `us`.`email`, `us`.`mobile`, `ro`.`name` as `role`, case `us`.`status` when 1 then 'Active' else 'Deactivated' end as `user_status` from `admins` `us` inner join `roles` `ro` on `ro`.`id` = `us`.`role_id` where `us`.`id` > 1 ; ");
    $path=Storage_path('fonts/');
    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir']; 
    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata']; 
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
        'fontDir' => array_merge($fontDirs, [
             __DIR__ . $path,
        ]),
        'fontdata' => $fontData + [
             'frutiger' => [
                 'R' => 'FreeSans.ttf',
                 'I' => 'FreeSansOblique.ttf',
             ]
        ],
        'default_font' => 'freesans',
        'pagenumPrefix' => '',
        'pagenumSuffix' => '',
        'nbpgPrefix' => ' कुल ',
        'nbpgSuffix' => ' पृष्ठों का पृष्ठ'
    ]);
    
    $html = view('admin.report.general.report',compact('rs_result' , 'tcols' ,'qcols')); 
    $mpdf->WriteHTML($html); 
    $mpdf->Output();
     
  }

  public function edit($id='0')
  {
    if ($id!='0') {
      $id = Crypt::decrypt($id);
      $account = DB::select(DB::raw("select * from `admins` where `id` = $id limit 1;"));
      $account = reset($account);
    }else { 
      $account = ''; 
    }
    $roles = SelectBox::getUserRoles();
    return view('admin.account.edit',compact('account','roles'));
  }

  public function update(Request $request,$id='')
  {  
    $rules=[
      'first_name' => 'required|string|min:3|max:50',
      'mobile' => 'required|numeric|digits:10',
      "role_id" => 'required',
      "email" => 'required|max:100',
      "last_name" => 'max:50',
    ];

    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
      $errors = $validator->errors()->all();
      $response=array();
      $response["status"]=0;
      $response["msg"]=$errors[0];
      return response()->json($response);// response as json
    }

    $id =Crypt::decrypt($id);
    $userid = Auth::guard('admin')->user()->id;
    $user_name = MyFuncs::removeSpacialChr($request->first_name);
    if($request->last_name == null){
      $user_last_name = "";  
    }else{
      $user_last_name = MyFuncs::removeSpacialChr($request->last_name);  
    }
    $user_mobile = MyFuncs::removeSpacialChr($request->mobile);
    $user_email = MyFuncs::removeSpacialChr($request->email);
    if($request->role_id==null){
      $user_role = 0;
    }else{
      $user_role = $request->role_id;  
    }
    
    
    $rs_update = DB::select(DB::raw("call `up_update_user_detail`($id, '$user_name', '$user_last_name', '$user_mobile', '$user_email', $user_role, $userid);"));

    $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
    return response()->json($response);
       
  }

  Public function toggleStatus($id=''){
    $id =Crypt::decrypt($id);
    $userid = Auth::guard('admin')->user()->id;
    $rs_update = DB::select(DB::raw("call `up_toggle_user_status`($id, $userid);"));

    return  redirect()->back()->with(['message'=>$rs_update[0]->result,'class'=>'success']);
  }
  
  Public function formNewUser(){       
  	$roles = SelectBox::getUserRoles();
    $default_role = 1;
  	return view('admin.account.new_user_form',compact('roles', 'default_role'));
  }

  
  public function newUserStore(Request $request,$id='')
  {  
    $rules=[
      'first_name' => 'required|string|min:3|max:50',
      'mobile' => 'required|numeric|digits:10',
      'role_id' => 'required',
      'email' => 'required|max:100',
      'last_name' => 'max:50',
      'password' => 'required|min:6|max:15', 
      'dob' => 'required',
    ];

    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
      $errors = $validator->errors()->all();
      $response=array();
      $response["status"]=0;
      $response["msg"]=$errors[0];
      return response()->json($response);// response as json
    }

    $userid = Auth::guard('admin')->user()->id;
    $user_name = MyFuncs::removeSpacialChr($request->first_name);
    if($request->last_name == null){
      $user_last_name = "";  
    }else{
      $user_last_name = MyFuncs::removeSpacialChr($request->last_name);  
    }
    $user_mobile = MyFuncs::removeSpacialChr($request->mobile);
    $user_email = MyFuncs::removeSpacialChr($request->email);
    if($request->role_id==null){
      $user_role = 0;
    }else{
      $user_role = $request->role_id;  
    }
    $password_encript = bcrypt(MyFuncs::removeSpacialChr($request->password));
    $dob = $request->dob == null ? $request->dob : date('Y-m-d',strtotime($request->dob));
    $password = MyFuncs::removeSpacialChr($request->password);

    $rs_update = DB::select(DB::raw("call `up_save_newuser_detail`('$user_name', '$user_last_name', '$user_mobile', '$user_email', $user_role, '$password_encript', '$password', '$dob', $userid);"));

    $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
    return response()->json($response);
       
  }


  Public function userClass()
  {
    $users = DB::select(DB::raw("select `id`, concat(`first_name`, ' ',ifnull(`last_name`,'')) as `user_name`, `email`, `role_id` from `admins` where `role_id` <> 12 and `id` > 1 order by `first_name`;"));
    
    return view('admin.account.userClass',compact('users'));  
  }

  Public function classAllSelect(Request $request)
  {
    $user_id = $request->id;   
    $classes = SelectBox::getAllClass(); 

    $userClassTypes = DB::select(DB::raw("select `uct`.`id`, concat(`clt`.`name`, ' - ', `sec`.`name`) as `class_name` from `user_class_types` `uct` inner join `class_types` `clt` on `clt`.`id` = `uct`.`class_id` inner join `section_types` `sec` on `sec`.`id` = `uct`.`section_id` where `uct`.`admin_id` = $user_id and `uct`.`status` = 1 order by `clt`.`shorting_id`, `sec`.`sorting_order_id`;"));

    $data= view('admin.account.classAllSelect',compact('classes','user_id','userClassTypes'))->render(); 
    return response($data);
  }

  Public function classAccess(Request $request)
  {

    $user_id = $request->user_id;
    $class_id = $request->class_id;

    $usersSections = DB::select(DB::raw("select `sec`.`id`, `sec`.`name`, `sec`.`sorting_order_id`, `uct`.`status` from `section_types` `sec` left join `user_class_types` `uct` on `uct`.`section_id` = `sec`.`id` where `uct`.`admin_id` = $user_id and `uct`.`class_id` = $class_id and `sec`.`id` in (select `section_id` from `sections` where `class_id` = 2 and `status` = 1) union select `id`, `name`, `sorting_order_id`, 0 as `status` from `section_types` where `id` not in (select `section_id` from `user_class_types` where `admin_id` = $user_id and `class_id` = $class_id) and `id` in (select `section_id` from `sections` where `class_id` = $class_id and `status` = 1) order by `sorting_order_id`;"));

    $data= view('admin.account.classSelect',compact('usersSections'))->render(); 
    return response($data);

  }

  Public function userClassStore(Request $request)
  {
       
    $rules=[
     'class_id' => 'required|max:199',             
     'user' => 'required|max:1000',  
    ]; 
    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $response=array();
        $response["status"]=0;
        $response["msg"]=$errors[0];
        return response()->json($response);// response as json
    }

    $user_id = $request->user;
    $class_id = $request->class_id;
    $section_ids = "0";
    if (!empty($request->section)){
      $section_ids = implode(",", $request->section);  
    }
    

    $rs_update = DB::select(DB::raw("call `up_save_user_class_assign`($user_id, $class_id, '$section_ids');"));


    $response['msg'] = 'Save Successfully';
    $response['status'] = 1;
    return response()->json($response);  
  }  

  public function ClassUserAssignReportGenerate($user_id)
  {
    $user_id =Crypt::decrypt($user_id);
    $rs_result = DB::select("select `email` from `admins` where `id` = $user_id;");    
    $report_header = "Class Permission :: ".$rs_result[0]->email;
    $tcols = 2;
    $qcols = array(
      array('Sr. No.',10),
      array('Class - Section',90)
    );

    $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, concat(`clt`.`name`, ' - ', `sec`.`name`) as `class_name` from `user_class_types` `uct` inner join `class_types` `clt` on `clt`.`id` = `uct`.`class_id` inner join `section_types` `sec` on `sec`.`id` = `uct`.`section_id` where `uct`.`admin_id` = $user_id and `uct`.`status` = 1;");

    $pdf=PDF::setOptions([
      'logOutputFile' => storage_path('logs/log.htm'),
      'tempDir' => storage_path('logs/')
    ])
    ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
    return $pdf->stream('users_class_permission.pdf');
     
  }


  public function changePassword()
    {
      return view('admin.account.change_password');
    }


    public function changePasswordStore(Request $request)
    {

        $rules=[
            'oldpassword'=> 'required',
            'password'=> 'required|min:6',
            'passwordconfirmation'=> 'required|min:6|same:password',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
        return response()->json($response);// response as json
        }        
        $user=Auth::guard('admin')->user();              

        if(password_verify($request->oldpassword,$user->password)){
        if ($request->oldpassword == $request->password) {
            $response=['status'=>0,'msg'=>'Old Password And New Password Cannot Be Same'];
            return response()->json($response);
        }else{
            $accounts =  Admin::find($user->id); 
            $accounts->password = bcrypt($request['password']); 
            $accounts->password_plain=$request->password;  
            $accounts->save();  
            $response=['status'=>1,'msg'=>'Password Change Successfully'];
        return response()->json($response);// response as json 
        }

        }else{               
        $response=['status'=>0,'msg'=>'Old Password Is Not Correct'];
        return response()->json($response);// response as json
        }        

    }

  //Passwod Reset

  public function resetPassWord()
  {
    $admins = DB::select(DB::raw("select `id`, concat(`first_name`, ' ',ifnull(`last_name`,'')) as `user_name`, `email`, `role_id` from `admins` where `id` > 1 order by `email`;"));
    return view('admin.account.reset_password',compact('admins'));
  }


  public function resetPassWordChange(Request $request)
  {
    if ($request->new_pass!=$request->con_pass) {
      $response=['status'=>0,'msg'=>'Password Not Match'];
      return response()->json($response);
    }
    
    $password_feed = $request['new_pass'];
    $new_PassWord = MyFuncs::removeSpacialChr($request['new_pass']);   
    if ($password_feed!=$new_PassWord) {
      $response=['status'=>0,'msg'=>'Spacial Symbol \' and \\ not allowed'];
      return response()->json($response);
    }

    $enript_PassWord = bcrypt($new_PassWord);
    $userid = $request->email;

    $rs_update = DB::select(DB::raw("call `up_reset_user_password`($userid, '$enript_PassWord');"));

    $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
    return response()->json($response);
  }

//Default Role/User Permission
  public function roleMenuPermission(){
    $roles = SelectBox::getUserRoles();
    return view('admin.account.roleListMenuPermission',compact('roles'));
  }

  Public function roleMenuTable(Request $request)
  {
    $role_id = $request->id;
    $rs_result = DB::select(DB::raw("select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, `drm`.`status`, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id` as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` inner join `default_role_menu` `drm` on `drm`.`sub_menu_id` = `sm`.`id` where `sm`.`status` = 1 and `drm`.`role_id` = $role_id union select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, 0, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id`  as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` and `sm`.`id` not in (select `sub_menu_id` from `default_role_menu` where `role_id` = $role_id) order by `menu_order`, `menu_name`, `sub_menu_order`;"));
    
    $rs_role = DB::select(DB::raw("select * from `roles` where `id` = $role_id limit 1;"));
    $role_name = '';
    if (count($rs_role) > 0 ){
      $role_name = $rs_role[0]->name;
    }
    $report_type = 1;
    $data= view('admin.account.roleMenuTable',compact('rs_result', 'role_id', 'role_name', 'report_type'))->render(); 
    return response($data);
  }


  public function roleMenuStore(Request $request)
  {

    $rules=[
      'sub_menu' => 'required|max:1000',             
      'role' => 'required|max:199',  
    ];

    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
      $errors = $validator->errors()->all();
      $response=array();
      $response["status"]=0;
      $response["msg"]=$errors[0];
      return response()->json($response);// response as json
    } 

    $sub_menu= implode(',',$request->sub_menu); 
    DB::select(DB::raw("call up_set_default_role_permission ($request->role, '$sub_menu')")); 

          
    $response['msg'] = 'Save Successfully';
    $response['status'] = 1;
    return response()->json($response);  
  }
  

  public function defaultUserRolrReportGenerate(Request $request, $id, $report_type)
  {
    $role_id = Crypt::decrypt($id);
    $report_type = Crypt::decrypt($report_type);
    $rs_role = DB::select(DB::raw("select * from `roles` where `id` = $role_id limit 1;"));
    $role_name = '';
    if (count($rs_role) > 0 ){
      $role_name = $rs_role[0]->name;
    }

    
    if ($request->optradio=='selected') {
      if ($report_type == 1){
        $rs_result = DB::select(DB::raw("select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, `drm`.`status`, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id` as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` inner join `default_role_menu` `drm` on `drm`.`sub_menu_id` = `sm`.`id` where `sm`.`status` = 1 and `drm`.`role_id` = $role_id order by `menu_order`, `menu_name`, `sub_menu_order`;"));
      }else{
        $rs_result = DB::select(DB::raw("select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, `drm`.`status`, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id` as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` inner join `default_role_quick_menu` `drm` on `drm`.`sub_menu_id` = `sm`.`id` where `sm`.`status` = 1 and `drm`.`role_id` = $role_id order by `menu_order`, `menu_name`, `sub_menu_order`;"));
      }

    }elseif($request->optradio=='all'){
      if ($report_type == 1){
        $rs_result = DB::select(DB::raw("select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, `drm`.`status`, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id` as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` inner join `default_role_menu` `drm` on `drm`.`sub_menu_id` = `sm`.`id` where `sm`.`status` = 1 and `drm`.`role_id` = $role_id union select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, 0, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id`  as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` and `sm`.`id` not in (select `sub_menu_id` from `default_role_menu` where `role_id` = $role_id) order by `menu_order`, `menu_name`, `sub_menu_order`;"));
      }else{
        $rs_result = DB::select(DB::raw("select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, `drm`.`status`, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id` as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` inner join `default_role_quick_menu` `drm` on `drm`.`sub_menu_id` = `sm`.`id` where `sm`.`status` = 1 and `drm`.`role_id` = $role_id union select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, 0, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id`  as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` and `sm`.`id` not in (select `sub_menu_id` from `default_role_quick_menu` where `role_id` = $role_id) order by `menu_order`, `menu_name`, `sub_menu_order`;"));
      }
    }
    
    $pdf = PDF::setOptions([
      'logOutputFile' => storage_path('logs/log.htm'),
      'tempDir' => storage_path('logs/')
    ])
    ->loadView('admin.account.report.result',compact('rs_result','role_id','role_name'));
    return $pdf->stream('roleMenu_report.pdf');
    
  }


  //Quick/HOT Permission

  public function quickView()
  {
    $roles = SelectBox::getUserRoles();
    return view('admin.account.quick_view',compact('roles'));
  } 

  Public function defultRoleQuickMenuShow(Request $request)
  {

    $role_id = $request->id;
    $rs_result = DB::select(DB::raw("select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, `drm`.`status`, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id` as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` inner join `default_role_quick_menu` `drm` on `drm`.`sub_menu_id` = `sm`.`id` where `sm`.`status` = 1 and `drm`.`role_id` = $role_id union select `sm`.`id`, `sm`.`name` as `sub_menu_name`, `mt`.`name` as `menu_name`, 0, `mt`.`sorting_id` as `menu_order`, `sm`.`sorting_id`  as `sub_menu_order` From `sub_menus` `sm` inner join `minu_types` `mt` on `mt`.`id` = `sm`.`menu_type_id` and `sm`.`id` not in (select `sub_menu_id` from `default_role_quick_menu` where `role_id` = $role_id) order by `menu_order`, `menu_name`, `sub_menu_order`;"));
    
    $rs_role = DB::select(DB::raw("select * from `roles` where `id` = 1 limit 1;"));
    $role_name = '';
    if (count($rs_role) > 0 ){
      $role_name = $rs_role[0]->name;
    }

    $report_type = 2;
    $data= view('admin.account.roleMenuTable',compact('rs_result', 'role_id', 'role_name', 'report_type'))->render(); 
    return response($data);
  }

  public function defaultRoleQuickStore(Request $request)
  {  
    $rules=[
      'sub_menu' => 'required|max:1000',             
      'role' => 'required|max:199',  
    ]; 
    
    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
      $errors = $validator->errors()->all();
      $response=array();
      $response["status"]=0;
      $response["msg"]=$errors[0];
      return response()->json($response);// response as json
    }  

    $sub_menu= implode(',',$request->sub_menu); 
    DB::select(DB::raw("call up_set_default_role_quick_permission ($request->role, '$sub_menu')")); 
        
    $response['msg'] = 'Save Successfully';
    $response['status'] = 1;
    return response()->json($response);  
  }


  //Menu Order Reset
  public function menuOrdering()
  {
    $menuTypes = DB::select(DB::raw("select * from `minu_types` order by `sorting_id`;"));
    return view('admin.account.menu_sorting_order',compact('menuTypes'));
  }


  public function menuFilter(Request $request,$id)
  { 
    $menu_id = Crypt::decrypt($id);
    $submenus = DB::select(DB::raw("select * from `sub_menus` where `menu_type_id` = $menu_id order by `sorting_id`;"));
    return view('admin.account.sub_menu_ordering',compact('submenus'));
  } 

  public function subMenuOrderingStore(Request $request)
  {  

    $id = Input::get('id');
    $sorting = Input::get('sorting');
    
    $rs_update = DB::select(DB::raw("update `sub_menus` set `sorting_id` = $sorting where `id` = $id limit 1;"));
    $response=array();
    $response['msg'] = 'Save Successfully';
    $response['status'] = 1;
    return response()->json($response); 
  } 

  public function menuOrderingStore(Request $request)
  { 
    $id = Input::get('id');
    $sorting = Input::get('sorting');
    
    $rs_update = DB::select(DB::raw("update `minu_types` set `sorting_id` = $sorting where `id` = $id limit 1;")); 
  }

  public function menuReport(Request $request)
  {
    $optradio=$request->optradio;
    
    $rs_result = DB::select(DB::raw("select `mt`.`name` as `menu_name`, `sm`.`name` as `sub_menu_name` from `minu_types` `mt` inner join `sub_menus` `sm` on `sm`.`menu_type_id` = `mt`.`id` where `sm`.`status` = 1 order by `mt`.`sorting_id`, `sm`.`sorting_id`;")); 

    $pdf=PDF::setOptions([
      'logOutputFile' => storage_path('logs/log.htm'),
      'tempDir' => storage_path('logs/')
    ])
    ->loadView('admin.account.report.menu_order_report',compact('rs_result','optradio'));
    return $pdf->stream('menu_report.pdf');
    

  } 
  
      
  
  

  // public function ClassUserAssignReportGenerate($user_id)
  //   {
  //      $usersName = Admin::find($user_id);
  //      $userClassTypes = UserClassType::where('admin_id',$user_id)->where('status',1)->orderBy('class_id','ASC')->orderBy('section_id','ASC')->get();
  //       $pdf=PDF::setOptions([
  //           'logOutputFile' => storage_path('logs/log.htm'),
  //           'tempDir' => storage_path('logs/')
  //       ])
  //       ->loadView('admin.account.report.class_assign_pdf',compact('userClassTypes','usersName'));
  //       return $pdf->stream('academicYear.pdf');
  //   }  

    
  //   // public function defaultMenuAccess($roleId,$userId){
  //   //     $role =Role::find($roleId); 
  //   //     $subMenus = explode(',',$role->sub_menu_id);

  //   //     foreach ($subMenus as $key => $value) {
  //   //       $menu =  new Minu();
  //   //       $menu->admin_id = $userId;   
  //   //       $menuData= SubMenu::find($value); 
  //   //       $menu->minu_id = $menuData->menu_type_id; 
  //   //       $menu->sub_menu_id = $value;
  //   //       $menu->save();
  //   //     }

        

  //   // } 

  
  
  //   Public function destroy($account){
         
  //     $admins=Admin::find(Crypt::decrypt($account));     
  //     $admins->delete();     
  //     return redirect()->back()->with(['message'=>'accoount deleted','class'=>'success']);
      
  //   }

  
  //    Public function rstatus(Admin $account){
        
  //       $data = ($account->r_status == 1)?['r_status' => 0]:['r_status' => 1 ]; 
  //       $account->r_status = $data['r_status'];
  //       if( $account->save()){
  //           return redirect()->back()->with(['class'=>'success','message'=>'status change  successfully ...']);   
  //       }
  //       else{
  //           return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
  //       }
  //   }

  //   Public function wstatus(Admin $account){
        
  //       $data = ($account->w_status == 1)?['r_status' => 0]:['r_status' => 1 ]; 
  //       $account->w_status = $data['r_status'];
  //       if( $account->save()){
  //           return redirect()->back()->with(['class'=>'success','message'=>'status change  successfully ...']);   
  //       }
  //       else{
  //           return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
  //       }
  //   }

  //   Public function dstatus(Admin $account){
        
  //       $data = ($account->d_status == 1)?['r_status' => 0]:['r_status' => 1 ]; 
  //       $account->d_status = $data['r_status'];
  //       if( $account->save()){
  //           return redirect()->back()->with(['class'=>'success','message'=>'status change  successfully ...']);   
  //       }
  //       else{
  //           return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
  //       }
  //   }

  //   Public function minu(Request $request, Admin $account){
  //       $roles = Role::all();
  //       $minus = Minu::where('admin_id',$account->id)->get();  
  //       return view('admin.account.minu',compact('account','roles','minus')); 
  //   }

  //   Public function access(Request $request, Admin $account){
  //           $menus = MinuType::all();
             
  //           $users = Admin::all();   
  //       return view('admin.account.access',compact('menus','users')); 
  //   } 

  //   Public function accessHotMenu(Request $request, Admin $account){
  //           $menus = MinuType::all(); 
  //           $users = Admin::all();   
  //       return view('admin.account.accessHotMenu',compact('menus','users')); 
  //   } 
  //   Public function accessHotMenuShow(Request $request){  
  //     $id = $request->id;    
  //     $usersmenusType= Minu::where('admin_id',$id)->where('status',1)->get(['sub_menu_id']);
  //     $menusType = Minu::where('admin_id',$id)->where('status',1)->get(['minu_id']);
  //     $menus = MinuType::whereIn('id',$menusType)->get();  
  //     $subMenus = SubMenu::whereIn('id',$usersmenusType)->where('status',1)->get();
  //     $usersmenus = array_pluck(HotMenu::where('admin_id',$id)->where('status',1)->get(['sub_menu_id'])->toArray(), 'sub_menu_id'); 
  //     $data= view('admin.account.hotmenuTable',compact('menus','subMenus','id','usersmenus'))->render(); 
  //     return response($data);
  //   }  

  //   Public function menuTable(Request $request){

  //               $id = $request->id;
  //           $menus = MinuType::all();
  //           $subMenus = SubMenu::all();
  //          $usersmenus = array_pluck(Minu::where('admin_id',$id)->where('status',1)->get(['sub_menu_id'])->toArray(), 'sub_menu_id'); 
  //       $data= view('admin.account.menuTable',compact('menus','subMenus','usersmenus','id'))->render(); 
  //       return response($data);
  //   }
  //   public function defaultUserMenuAssignReport($id)
  //   {
  //    $id=Crypt::decrypt($id); 
  //    $previousRoute= app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
  //    if ($previousRoute=='admin.account.access') {
  //        $usersmenus = array_pluck(Minu::where('admin_id',$id)->where('status',1)->get(['sub_menu_id'])->toArray(), 'sub_menu_id'); 
  //        $menus = MinuType::all();
  //        $subMenus = SubMenu::all(); 
  //    }elseif ($previousRoute=='admin.account.access.hotmenu'){ 
  //     $usersmenusType= Minu::where('admin_id',$id)->where('status',1)->get(['sub_menu_id']);
  //     $menusType = Minu::where('admin_id',$id)->where('status',1)->get(['minu_id']);
  //     $menus = MinuType::whereIn('id',$menusType)->get();  
  //     $subMenus = SubMenu::whereIn('id',$usersmenusType)->where('status',1)->get();
  //     $usersmenus = array_pluck(HotMenu::where('admin_id',$id)->where('status',1)->get(['sub_menu_id'])->toArray(), 'sub_menu_id');
  //    }
      
  //    $pdf = PDF::setOptions([
  //           'logOutputFile' => storage_path('logs/log.htm'),
  //           'tempDir' => storage_path('logs/')
  //       ])
  //       ->loadView('admin.account.report.user_menu_assign_repot',compact('menus','subMenus','usersmenus','id'));
  //       return $pdf->stream('menu_report.pdf');
  //   }




  

  
  
  

  //   // User access Store
  //   Public function accessStore(Request $request){
 
  //           $rules=[
  //           'sub_menu' => 'required|max:1000',             
  //           'user' => 'required|max:1000',  
  //           ]; 
  //           $validator = Validator::make($request->all(),$rules);
  //           if ($validator->fails()) {
  //               $errors = $validator->errors()->all();
  //               $response=array();
  //               $response["status"]=0;
  //               $response["msg"]=$errors[0];
  //               return response()->json($response);// response as json
  //           }     
  //       $menuId= implode(',',$request->sub_menu); 
  //       DB::select(DB::raw("call up_setuserpermission ($request->user, '$menuId')")); 
  //       $response['msg'] = 'Access Save Successfully';
  //       $response['status'] = 1;
  //       return response()->json($response);  

        
        
  //   }
  //   // User access hot menu Store
  //   Public function accessHotMenuStore(Request $request){

  //           $rules=[
  //           'sub_menu' => 'required|max:1000',             
  //           'user' => 'required|max:199',  
  //           ]; 
  //           $validator = Validator::make($request->all(),$rules);
  //           if ($validator->fails()) {
  //               $errors = $validator->errors()->all();
  //               $response=array();
  //               $response["status"]=0;
  //               $response["msg"]=$errors[0];
  //               return response()->json($response);// response as json
  //           } 
  //           $menuId= implode(',',$request->sub_menu); 
  //           DB::select(DB::raw("call up_setuserquickpermission ($request->user, '$menuId')")); 
            
  //         $response['msg'] = 'Access Save Successfully';
  //          $response['status'] = 1;
  //          return response()->json($response);  

        
        
  //   }

  
  
         
    


 
  
  
  
  
  
  
  //   /**
  //    * Display the specified resource.
  //    *
  //    * @param  \App\ParentRegistration  $parentRegistration
  //    * @return \Illuminate\Http\Response
  //    */
  
  
}
