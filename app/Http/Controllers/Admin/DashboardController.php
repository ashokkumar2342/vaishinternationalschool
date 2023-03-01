<?php

namespace App\Http\Controllers\Admin;

// use App\Admin;
use App\Http\Controllers\Controller;
// use App\Model\AcademicYear;
// use App\Model\Cashbook;
// use App\Model\ClassType;
// use App\Model\Event\EventDetails;
// use App\Model\Exam\ClassTest;
// use App\Model\Homework;
// use App\Model\ParentRegistration;
// use App\Model\StudentAttendance;
// use App\Model\StudentFeeDetail;
// use App\Model\StudentRemark;
// use App\Model\StudentUserMap;
// use App\Student;
// use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\createToken;
use Storage;
use Illuminate\Support\Facades\DB;
use App\Helper\MyFuncs;
class DashboardController extends Controller
{
    
    public function index()
    {  
        $admins=Auth::guard('admin')->user();
        if ($admins->role_id==1) {
            //Administrator
            
            $date = date('Y-m-d');
            // $present = StudentAttendance::where('attendance_type_id',1)
            //         ->Where('date',$date)
            //         ->OrWhere('attendance_type_id',3)
            //         ->OrWhere('attendance_type_id',4)->count();
            // $absent = StudentAttendance::where('attendance_type_id',2) 
            //         ->Where('date',$date)
            //         ->count();
        
            // $date = date('Y-m-d');
            // $students = Student::where('student_status_id',1)->count();
            // $studentDOBs = Student::whereMonth('dob',date('m'))
            //                 ->whereDay('dob',date('d'))
            //                 ->get(); 
            // // $newRegistraions = ParentRegistration::get();  
            // $feeDues = StudentFeeDetail::where('paid',0)->get()->sum('fee_amount');                      
            // $feePaid = StudentFeeDetail::where('paid',1)->get()->sum('fee_amount');
            // $classTypes=ClassType::orderBy('id','ASC')->get(); 
            return view('admin/dashboard/dashboard');
        }elseif($admins->role_id==12) {

            //student    
            $user_rs = Auth::guard('admin')->user();
            $user_id = $user_rs->id;

            $studentUser = DB::select(DB::raw("select `student_id` from `student_user_map` where `userid` = $user_id;"));
            if (!empty($studentUser)) {
                // return view('admin/dashboard/new_student_dashboard');
                return view('admin/dashboard/ostudent_dashboard');
            }else{
                return view('admin/dashboard/new_student_dashboard');
            }
        }else {
            return view('admin/dashboard/dashboard_'.$admins->role_id);
        }
        
        
    }  

    
    // public function showStudentDetails(Request $request)
    // {
    //     $classes = ClassType::all();
    //     $students = Student::all(); 
    //     return view('admin/dashboard/studentDetails',compact('classes','students'))->render();
    // }
    // //show Student Registration Details 
    // public function showStudentRegistrationDetails(Request $request)
    // {
    //     $classes = ClassType::all();
    //    $students = ParentRegistration::all(); 
    //     return view('admin/dashboard/studentRegistrationDetails',compact('classes','students'))->render();
    // }

    // public function passportTokenCreate(){
    //     $user = Admin::find(1);
    //     // Creating a token without scopes...
    //     $token = $user->createToken('Student')->accessToken;

    //     // Creating a token with scopes...
    //    // $token = $user->createToken('My Token', ['place-orders'])->accessToken;
    //     return $token;
    // }

    public function proFile()
    {
        $admins = Auth::guard('admin')->user();
        return view('admin/dashboard/profile/view',compact('admins'));
    }

    public function proFileShow()
    {
        $admins = Auth::guard('admin')->user();
        return view('admin/dashboard/profile/profile_show',compact('admins'));
    }


    public function profileUpdate(Request $request)
    {
           
        $admins = Auth::guard('admin')->user();
        $user_id = $admins->id;
        $rules=[
          
            'first_name' => 'required',
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


        $first_name = MyFuncs::removeSpacialChr($request->first_name);
        $dob = $request->dob;
        $update_rs = DB::select(DB::raw("update `admins` set `first_name` = '$first_name', `dob` = '$dob' where `id` = $user_id limit 1;"));


        $response=['status'=>1,'msg'=>'Profile Updated Successfully'];
        return response()->json($response);   
    }


    public function profilePhoto()
    { 
        return view('admin/dashboard/profile/profile_upload');
    } 


    public function profilePhotoUpload(Request $request)
    {
        $admins = Auth::guard('admin')->user();
        $user_id = $admins->id;
        $rules=[
          
             // 'image' => 'required|mimes:jpeg,jpg,png,gif|max:5000'          
            
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        
        $data = $request->image; 
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name = time().'.jpg';       
        $path = Storage_path() . "/app/student/profile/admin/" . $image_name; 
        @mkdir(Storage_path() . "/app/student/profile/admin/", 0755, true);     
        file_put_contents($path, $data); 

        $update_rs = DB::select(DB::raw("update `admins` set `profile_pic` = '$image_name' where `id` = $user_id limit 1;"));

        
        return response()->json(['success'=>'done']);
    }
    
    public function proFilePhotoShow(Request $request,$profile_pic)
    {
        $profile_pic = Storage::disk('student')->get('profile/admin/'.$profile_pic);           
        return  response($profile_pic)->header('Content-Type', 'image/jpeg');
    }


    public function profilePhotoRefrash()
    {
        return view('admin.dashboard.profile.photo_refrash');
    } 


     public function passwordChange(Request $request)
    {
        $rules=[
          'old_password' => 'required', 
          'password' => 'required|min:6|max:50', 
          'confirm_password' => 'required|min:6|max:50', 
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        if ($request->confirm_password!=$request->password) {
            $response =array();
            $response['status'] =0;
            $response['msg'] ='Confirm Password Not Match with Password';
            return $response;
        }
        
        $admin = Auth::guard('admin')->user();
        $user_id = $admin->id;
        $response =array();
            
        //Check Old Password Matching
        $en_password = bcrypt($request['old_password']);
        $update_rs = DB::select(DB::raw("select `password` from `admins` where `id` = $user_id limit 1;"));
        if(count($update_rs)>0){
            if($en_password == $update_rs[0]->password){
                $en_password = bcrypt($request['password']);
                $update_rs = DB::select(DB::raw("update `admins` set `password` = '$en_password' where `id` = $user_id limit 1;"));
                $response['status'] = 1;
                $response['msg'] ='Password Changed Successfully'; 
            }else{
                $response['status'] = 0;
                $response['msg'] ='Old Password not Matched, Please Try Again';    
            }
        }else{
            $response['status'] = 0;
            $response['msg'] ='Old Password not Matched, Please Try Again';
        }
        
        return $response;

        // if (Hash::check($request->old_password, $admin->password))
        // {
        //     $newPasswrod = Hash::make($request->password);
        //     $st=Admin::find($admin->id);
        //     $st->password =$newPasswrod ;
        //     $st->save();
        //     $response =array();
        //     $response['status'] =1;
        //     $response['msg'] ='Password Updated Successfully';
        //     return $response;
        // }else{
        //    return 'not fond';
        // }

    }



   
}
