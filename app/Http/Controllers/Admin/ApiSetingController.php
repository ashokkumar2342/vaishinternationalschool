<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Helper\MyFuncs;

use App\Events\SmsEvent;
use App\Helper\MailHelper;
use Mail;

class ApiSetingController extends Controller
{
  public function index()
  {
    return view('admin.apiSeting.index'); 
  }


  public function smsApiAdd($id='0')
  {
    if ($id!='0') {
      $id = Crypt::decrypt($id);
      $smsApi = DB::select(DB::raw("select * from `sms_apis` where `id` = $id limit 1;"));
      $smsApi = reset($smsApi); 

    }else { 
      $smsApi = ''; 
    }
    return view('admin.apiSeting.smsApi.add_form',compact('smsApi'));
  }
   
  public function smsApiStore(Request $request,$id='')
  {  
   	$rules=[  	  
      'user_name' => 'required|max:50', 
      'password' => 'required|max:50', 
      'sender_name' => "required|max:6", 
      'url' => "required|max:250", 
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
    $user_name = MyFuncs::removeSpacialChr($request->user_name);
    $password = MyFuncs::removeSpacialChr($request->password);
    $url = MyFuncs::removeSpacialChr($request->url);
    $sender = MyFuncs::removeSpacialChr($request->sender_name);
    if(empty($request->enable_auto_send)){
      $auto_send = 0;  
    }else{
      $auto_send = $request->enable_auto_send;
    }
    
    $rs_update = DB::select(DB::raw("call `up_save_sms_api`($id, '$user_name', '$password', '$url', '$sender', $auto_send, $userid);"));

    $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
    return response()->json($response);

  }

  public function smsApiList($value='')
  {
 	  $smsApis = DB::select("select * from `sms_apis` order by `status` desc, `id`;");
 	  return view('admin.apiSeting.smsApi.list',compact('smsApis'));   
  }
   
  public function smsApiDestroy($id)
  {

    $id =Crypt::decrypt($id);
    $rs_update = DB::select(DB::raw("delete from `sms_apis` where `id` = $id;"));
    
    $response=['status'=>1,'msg'=>'Deleted Successfully'];
    return response()->json($response);

  }



  public function emailApiAdd($id='0')
  {
    if ($id!='0') {
      $id = Crypt::decrypt($id);
      $emailApi = DB::select(DB::raw("select * from `email_apis` where `id` = $id limit 1;"));
      $emailApi = reset($emailApi); 

    }else { 
      $emailApi = ''; 
    }
    return view('admin.apiSeting.emailApi.add_form',compact('emailApi'));
  }

  public function emailApiStore(Request $request,$id='')
  {  
    $rules=[      
      'host' => 'required|max:200', 
      'port' => 'required|max:4', 
      'username' => "required|max:50", 
      'password' => "required|max:50", 
      'encryption' => "required|max:200", 
      'from' => "required|max:50", 
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
    $host = MyFuncs::removeSpacialChr($request->host);
    $port = MyFuncs::removeSpacialChr($request->port);
    $username = MyFuncs::removeSpacialChr($request->username);
    $password = MyFuncs::removeSpacialChr($request->password);
    $encryption = MyFuncs::removeSpacialChr($request->encryption);
    $from = MyFuncs::removeSpacialChr($request->from);
    if(empty($request->enable_auto_send)){
      $auto_send = 0;  
    }else{
      $auto_send = $request->enable_auto_send;
    }
    
    $rs_update = DB::select(DB::raw("call `up_save_email_api`($id, '$host', '$port', '$username', '$password', '$encryption', '$from', $auto_send, $userid);"));

    $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
    return response()->json($response);

  }

   
  public function emailApiList($value='')
  {
   	$smsApis = DB::select("select * from `email_apis` order by `status` desc, `id`;");
   	return view('admin.apiSeting.emailApi.list',compact('smsApis'));    
  }

  public function emailApiDestroy($id)
  {

    $id =Crypt::decrypt($id);
    $rs_update = DB::select(DB::raw("delete from `email_apis` where `id` = $id;"));
    
    $response=['status'=>1,'msg'=>'Deleted Successfully'];
    return response()->json($response);

  }

   
  public function setstatus($id,$condition_id)
  {

    $id =Crypt::decrypt($id);
    $rs_update = DB::select(DB::raw("call `up_set_default_sms_email_api`($id, $condition_id);"));

    $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
    return response()->json($response);

  }


  public function testMessage(Request $request,$id)
  {
    return view('admin.apiSeting.test_form',compact('id'));     
  }
   
  public function MessageSend(Request $request)
  { 
    if ($request->test==1) {
      event(new SmsEvent($request->mobile,'Api Integration Successfully')); 
    }else{ 
        $message ='Test Api Integration Successfully';         
        $emailto = $request->email;         
        $subject = 'Test Api'; 
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
    $response=['status'=>1,'msg'=>'send Successfully'];
    return response()->json($response); 

  }

}
