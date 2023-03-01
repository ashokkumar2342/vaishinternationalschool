<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helper\MyFuncs;
use App\Helper\SelectBox;
use App\Helpers\MailHelper;
use Auth;
use Carbon;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use DB;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use PDF;
use Response;
use Storage;
use setasign\Fpdi\Fpdi;


class StudentController extends Controller
{

  public function addStudentForm()
  {   
    $user = Auth::guard('admin')->user();
    
    $classes = SelectBox::getAllClass();   
    $genders = SelectBox::getGenders();   
    $houses = SelectBox::getAllHouses();   
    $default = MyFuncs::getStudentDefaultVal();   
    $reg_no_size = MyFuncs::get_reg_no_size();
    return view('admin.student.studentdetails.add',compact('classes', 'genders', 'houses', 'default', 'reg_no_size'));
  }

  public function show($student_id,$source)
  {    
    $userId=Auth::guard('admin')->user(); 
    
    $studentId= Crypt::decrypt($student_id);
    
    return view('admin.student.studentdetails.view',compact('studentId'));
  }

    
  
  public function student_info_show($student_id)
  {    
    $userId = Auth::guard('admin')->user(); 
    
    $studentId = Crypt::decrypt($student_id);
    $student = DB::select(DB::raw("call `up_get_StudentDetail`($studentId);"));

    return view('admin.student.studentdetails.include.student_info',compact('student', 'student_id'));
  }

  public function student_info_edit($student_id)
  {    
    $userId = Auth::guard('admin')->user(); 
    
    $studentId = Crypt::decrypt($student_id);
    $student = DB::select(DB::raw("call `up_get_StudentDetail`($studentId);"));

    $class_id = $student[0]->class_id;
    
    $houses = DB::select(DB::raw("select `id`, `name` from `houses` order by `name`;"));
    $genders = DB::select(DB::raw("select `id`,`genders` from `genders` order by `genders`;"));
    $classes = MyFuncs::getClasses();
    $sections = MyFuncs::getSections($class_id);


    $reg_no_size = MyFuncs::get_reg_no_size();
    
    return view('admin.student.studentdetails.include.student_info_edit',compact('student', 'student_id', 'classes', 'sections', 'houses', 'genders', 'reg_no_size'));
  }

  public function imageUpload($student_id)
  {
    return view('admin.student.studentdetails.include.student_image_upload',compact('student_id'));
  }

  public function imageUploadSave(Request $request, $student_id)
  {
    $studentId = Crypt::decrypt($student_id);
    $data = $request->image; 
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $timestamps =date('ymdHis');
    $image_name = $studentId.'_'.$timestamps.'.jpg';       
    $path = Storage_path() . "/app/student/profile/" . $image_name; 
    @mkdir(Storage_path() . "/app/student/profile/", 0755, true);     
    file_put_contents($path, $data); 

    $update_rs = DB::select(DB::raw("update `students` set `picture` = '$image_name' where `id` = $studentId limit 1;"));

    
    return response()->json(['success'=>'done']);
  }

  public function camera(Request $request, $student_id)
  { 
    return view('admin.student.studentdetails.include.student_image_camera',compact('student_id')); 
  }

  public function cameraSave(Request $request, $student_id)
  {
    
    $studentId = Crypt::decrypt($student_id);
    $data = $request->image; 
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $timestamps =date('ymdHis');
    $image_name = $studentId.'_'.$timestamps.'.jpg';       
    $path = Storage_path() . "/app/student/profile/" . $image_name; 
    @mkdir(Storage_path() . "/app/student/profile/", 0755, true);     
    file_put_contents($path, $data); 

    $update_rs = DB::select(DB::raw("update `students` set `picture` = '$image_name' where `id` = $studentId limit 1;"));

    $response=['status'=>1,'msg'=>'Save Successfully'];
    return response()->json($response);
    
  }

  public function updateStudentInfo(Request $request,$student_id)
  { 
    $studentId = Crypt::decrypt($student_id);
    try
    {
      $rules=[ 
        "student_name" => 'required|max:50',
        "nick_name" => 'max:20|nullable', 
        "class" => 'required', 
        "date_of_birth" => 'required|max:199', 
        "aadhaar_no" => 'required|digits:12',
        "gender" => "required",  
      ]; 
      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $response=array();
        $response["status"]=0;
        $response["msg"]=$errors[0];
        return response()->json($response);// response as json
      }  
      

      $stu_name = MyFuncs::removeSpacialChr($request->student_name);
      $nick_name = MyFuncs::removeSpacialChr($request->nick_name);
      $class_id = $request->class;
      $section_id = $request->section;
      $reg_length = floatval($request->reg_length);
      $registration_no = MyFuncs::removeSpacialChr($request->registration_no);
      $admission_no = MyFuncs::removeSpacialChr($request->admission_no);
      $roll_no = floatval($request->roll_no);
      $date_of_birth = $request->date_of_birth;
      $date_of_admission = $request->date_of_admission;
      $date_of_activation = $request->date_of_activation;
      $aadhaar_no = MyFuncs::removeSpacialChr($request->aadhaar_no);
      $gender = $request->gender;
      
      if(empty($request->house)){$house = 0;}
      else{$house = $request->house;}
      

      //Check Validation
      if(strlen($registration_no)!=$reg_length){
        $response=array();
        $response['status']=0;
        $response['msg']='Registration No. Length should be of '.$reg_length;   
        return $response;        
      }

      $rs_check = DB::select(DB::raw("select `id` from `students` where `registration_no` = '$registration_no' and `id` <> $studentId limit 1;"));
      if(count($rs_check)>0){
        $response=array();
        $response['status']=0;
        $response['msg']='Registration No. Already Exists';   
        return $response;        
      }

      $rs_check = DB::select(DB::raw("select `id` from `students` where `admission_no` = '$admission_no' and `id` <> $studentId limit 1;"));
      if(count($rs_check)>0){
        $response=array();
        $response['status']=0;
        $response['msg']='Admission No. Already Exists';   
        return $response;        
      }

      $rs_check = DB::select(DB::raw("select `id` from `students` where `adhar_no` = '$aadhaar_no' and `id` <> $studentId limit 1;"));
      if(count($rs_check)>0){
        $response=array();
        $response['status']=0;
        $response['msg']='AADHAR No. Already Exists';   
        return $response;        
      }

      $rs_update = DB::select(DB::raw("UPDATE `students` set `name` = '$stu_name', `nick_name` = '$nick_name', `registration_no` = '$registration_no', `admission_no` = '$admission_no', `roll_no` = '$roll_no', `class_id` = $class_id , `section_id`='$section_id', `date_of_admission` = '$date_of_admission', `date_of_activation` = '$date_of_activation', `dob` = '$date_of_birth', `gender_id` = $gender, `adhar_no` = '$aadhaar_no', `house_no` = $house where `id` = $studentId limit 1;")); 

      $response=array();
      $response['status']=1;
      $response['msg']='Save Successfully';   
      $response['student_id']=Crypt::encrypt($student_id);
      return $response;  
    } catch (Exception $e) {
      Log::error('Update :'.$e);
    } 
  }   

  //Function to show student detail modified by Amit Bansal $source:: 1-Student, 2-Application Form
  // public function showDetailedAppForm_SiblingNotAdmitted($student_id,$source)
  // { 
  //   // dd($source);
  //   $studentId = Crypt::decrypt($student_id);
  //   $userId = Auth::guard('admin')->user(); 

  //   $parentsType=DB::select(DB::raw("select `name`, `id` from `guardian_relation_types` order by `name`;"));
  //   $incomes=DB::select(DB::raw("select `range`, `id` from `income_ranges` order by `id`;"));
  //   $documentTypes=DB::select(DB::raw("select `name`, `id` from `document_types` order by `name`;"));
  //   $subjectTypes=DB::select(DB::raw("select `name`, `id` from `subject_types` order by `name`;"));
  //   $sessions=DB::select(DB::raw("select `name`, `id` from `academic_years` order by `name`;"));
  //   $awardLevels=DB::select(DB::raw("select `name`, `id` from `award_levels` order by `name`;"));
  //   $isoptionals=DB::select(DB::raw("select `name`, `id` from `isoptionals` order by `name`;"));
  //   $bloodgroups=DB::select(DB::raw("select `name`, `id` from `blood_groups` order by `name`;"));
  //   $professions=DB::select(DB::raw("select `name`, `id` from `professions` order by `name`;"));

  //   if($source == 1){
  //     $classes = MyFuncs::getClassOnly($userId->id,1);  
  //   }else{
  //     $classes = MyFuncs::getClassOnly($userId->id,2);
  //   }

  //   $student_user_status=DB::select(DB::raw("call up_check_student_adm_app_status ($studentId, $userId->id)")); 
    

  //     $st=new Student();
  //     $student=$st->getStudentDetailsById($studentId);
  //     // $parentsType = array_pluck(GuardianRelationType::get(['id','name'])->toArray(),'name','id');
  //     // $incomes = array_pluck(IncomeRange::get(['id','range'])->toArray(),'range', 'id');
  //     // $documentTypes = array_pluck(DocumentType::get(['id','name'])->toArray(),'name', 'id');
  //     // $subjectTypes = array_pluck(SubjectType::get(['id','name'])->toArray(),'name', 'id');
  //     // $sessions = array_pluck(AcademicYear::get(['id','name'])->toArray(),'name', 'id');
  //     // $awardLevels = array_pluck(AwardLevel::get(['id','name'])->toArray(),'name', 'id');
  //     // $isoptionals = array_pluck(Isoptional::get(['id','name'])->toArray(),'name', 'id');
  //     // $bloodgroups = array_pluck(BloodGroup::get(['id','name'])->toArray(),'name', 'id');
  //     // $professions = array_pluck(Profession::get(['id','name'])->toArray(),'name', 'id');
  //     // if ($userId->role_id==12) {
  //     //    $classes = MyFuncs::getStudentClasses();
  //     // }else{
  //     //    $classes = MyFuncs::getClasses();
  //     // } 
  //     if ($userId->role_id==12) {
  //         $sections = MyFuncs::getStudentSections($student->class_id);
  //     }else{
  //       $sections = MyFuncs::getSections($student->class_id);
  //     } 
  //     $houses=House::orderBy('id','ASC')->get(); 
  //     $genders=Gender::orderBy('genders','ASC')->get();
  //     $schoolinfo=Schoolinfo::first();
  //     $studentStatus=DB::select(DB::raw("call up_check_user_student_status ('$userId->id')")); 
  //     if ($studentStatus[0]->show_status==1) {
  //         $showHide='';
  //     }else{
  //         $showHide='hidden';
  //     } 
       
  //     return view('admin.student.studentdetails.view',compact('student','parentsType','incomes','documentTypes','isoptionals','sessions','awardLevels','subjectTypes','bloodgroups','professions','classes','sections','houses','genders','userId','schoolinfo','showHide','source', 'student_user_status'));
  // }

  
    //code for admission form Author :: Amit Bansal
  public function studentSearchByRegisAppNo(Request $request,$type)
  { 
    $message_type = '';
    $error = 0;
    if($type==1){
      $message_type = 'Registration';
    } else{
      $message_type = 'Application';
    } 
    if(trim($request->id) == ''){
      return '<p style="color:red">Plz Enter Sibling '.$message_type.' No.</p>';  
    }

    $student = $this->getSiblingDetail($request->id, $type);
    $error = $student[0]->error;
    if($error > 0){
      return '<p style="color:red">'.$message_type.' No. not found, please enter correct '.$message_type.' no.</p>';
    }else{
      return view('admin.student.studentdetails.details',compact('student'))->render();  
    }
    
  }


    //input type :: 1-registration no, 2-Application No.
  public function getSiblingDetail($regis_app_no, $input_type){
    try {
      $sibDetail = DB::select(DB::raw("call `up_get_sibling_detail_app_form`('$regis_app_no', $input_type);"));   
      return $sibDetail;
    } catch (QueryException $e) {
      return $e; 
    }
  }//function End

  //   //----school-help Desk-Registration-----------------------------
  public function schoolWiseAdmission($value='')
  {
    $user = Auth::guard('admin')->user();
    
    $academicYears = SelectBox::getYearAdmissionOpen(); 
    $course_medium = SelectBox::getCourseMedium(); 
    
    $genders = SelectBox::getGenders(); 
    // $default = StudentDefaultValue::find(1); 
    return view('admin.student.studentdetails.schoolwiseadmission.form',compact('academicYears','default','genders', 'course_medium'));
  }

  public function getExamScheduleDetailBy_AY_Class(Request $request)
  {
    try {
      $ac_year_id = $request->academic_year_id;
      $class_id = $request->class_id;
      $rs_exam_schedult = DB::select(DB::raw("select * from `admission_schedule` where `academic_year_id` = $ac_year_id and `class_id` = $class_id limit 1;"));
      
      return view('admin.student.studentdetails.schoolwiseadmission.test_div_box',compact('rs_exam_schedult'));
    } catch (QueryException $e) {
      return $e; 
    }
  }//function End

  public function helpDeskNewAdmImage()
  {
     return view('admin.student.studentdetails.schoolwiseadmission.webcam');
  }

  // //----------------- student registraion -------------
  // public function registrationFormByStudent($value='')
  // {
  //   $user_rs = Auth::guard('admin')->user();
  //   $user_role = $user_rs->role_id;
    
  //   $academicYears = SelectBox::getYearAdmissionOpen();
  //   $genders = SelectBox::getGenders();

  //   return view('admin.student.studentdetails.newregistration.form',compact('academicYears','genders'));
  // }


  public function studentAddNewStep1Store(Request $request)
  {    
    // return $request->dob;
    try {  
      $rules=[
        'sibling_registration' => 'required',
        'sibling_registration_no' => 'required_if:sibling_registration,1',
        'class' => 'required',
        'section' => 'required',
        'registration_no' => "required|unique:students|min:$request->reg_length|max:$request->reg_length",
        'admission_no' => 'required|max:20|unique:students',
        'roll_no' => 'required|max:20',
        'date_of_admission' => 'required|date', 
        "date_of_activation" => 'required|date',
        "student_name" => 'required|max:50', 
        "dob" => 'required|date',
        "aadhaar_no" => "required|digits:12|min:12",
        "house_name" => "required", 
      ];
       
      if ($request->sibling_registration=='0') {
        $rules['mobileno']= 'required_if:sibling_registration,0|unique:admins,mobile';
        $rules['emailid'] ='required_if:sibling_registration,0|unique:admins,email'; 
      }

      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $response=array();
        $response["status"]=0;
        $response["msg"]=$errors[0];
        return response()->json($response);// response as json
      }

      $sib_type_select = 0;
      if ($request->sibling_registration=='1') {  
        $sib_type_select = 1;
        $regis_app_no = MyFuncs::removeSpacialChr($request->sibling_registration_no);
        $message_type = 'Registration'; 
      }

      $siblingID = 0;
      $emailid = '';
      $mobile_no = '';
      if($sib_type_select > 0){  
        $sib_detail = $this->getSiblingDetail($regis_app_no, $sib_type_select);
        $error = $sib_detail[0]->error;
        if($error > 0){
          $response=array();
          $response['status']=0;
          $response['msg']='Sibling '.$message_type.' No. is not valid, Please enter correct detail';
          return $response;
        }
        $siblingID = $sib_detail[0]->sib_id;
      }else{
        $emailid = MyFuncs::removeSpacialChr($request->emailid);
        $mobile_no = MyFuncs::removeSpacialChr($request->mobileno);
      }

      $user_rs = Auth::guard('admin')->user();
      $user_id=$user_rs->id;
      $password = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyz0123456789" ), 0, 6 );
      $encrypt_password = bcrypt($password);

      $st_name = MyFuncs::removeSpacialChr($request->student_name);
      $st_nickname = MyFuncs::removeSpacialChr($request->nick_name);
      $st_aadhar = MyFuncs::removeSpacialChr($request->aadhaar_no);

      $pre_school_name = MyFuncs::removeSpacialChr($request->last_school_name);
      $marks_percentage = floatval($request->marks_percent);
      $marks_obt = floatval($request->marks_obt);
      $marks_max = floatval($request->max_marks);
      
      $st_regis_no = MyFuncs::removeSpacialChr($request->registration_no);
      $st_adm_no = MyFuncs::removeSpacialChr($request->admission_no);
      $st_roll_no = MyFuncs::removeSpacialChr($request->roll_no);

      $stu_insert_rs = DB::select(DB::raw("insert into `students`(`registration_no`, `admission_no`, `roll_no`, `emailid`, `mobileno`, `dpassword`, `dpassword_encrypt`, `admin_id`, `name`, `nick_name`, `class_id`, `section_id`, `dob`, `gender_id`, `student_status_id`, `adhar_no`, `house_no`, `date_of_admission`, `date_of_activation`) values('$st_regis_no', '$st_adm_no', '$st_roll_no', '$emailid', '$mobile_no', '$password', '$encrypt_password', $user_id, '$st_name', '$st_nickname', $request->class, $request->section, '$request->dob', $request->gender, 1, '$st_aadhar', $request->house_name, '$request->date_of_admission', '$request->date_of_activation');"));

      $new_student_rs = DB::select(DB::raw("select `id` from `students` where `adhar_no` = '$st_aadhar' limit 1;"));
      $new_stu_id = $new_student_rs[0]->id;

      $response=array();
      $response['status']=1;
      $response['msg']='Student Added Successfully';   
      $response['student_id']=Crypt::encrypt($new_stu_id);
      $response['source']=1;
      return $response; 
       
    } catch (Exception $e) {
      Log::error('Student store :'.$e);
    }
  }

  // //Help Desk Registration Step 1 Store
  public function helpDeskNewAdmFormStep1Store(Request $request)
  {
    $sib_type_select = 0;
    $regis_app_no = '';
    $message_type = '';
    $error = 0;
    try{
      $rules=[
        'academic_year_id' => 'required',
        'sibling_registration' => 'required',
        'sibling_registration_no' => 'required_if:sibling_registration,1',
        'sibling_application_no' => 'required_if:sibling_registration,2', 
        'class' => 'required', 
        'subject_id' => 'required', 
        'course_medium' => 'required', 
        "student_name" => 'required|max:50', 
        "father_name" => 'required|max:50', 
        "dob" => 'required|date',
        "gender" => "required", 
        "aadhaar_no" => "required|digits:12|unique:students,adhar_no",
        "test_date" => "required|date",
        "test_time" => "required",
        "result_date" => "required|date",
        "result_time" => "required",
        "test_duration" => "required",
        "form_fee" => "required",
      ];
      if ($request->sibling_registration=='0') {
        $rules['mobileno']= 'required_if:sibling_registration,0|unique:admins,mobile';
        $rules['emailid'] ='required_if:sibling_registration,0|unique:admins,email'; 
      }
      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $response=array();
        $response["status"]=0;
        $response["msg"]=$errors[0];
        return response()->json($response);// response as json
      }

      $sib_type_select = 0;
      if ($request->sibling_registration=='1'){
        $sib_type_select = 1;
        $regis_app_no = MyFuncs::removeSpacialChr($request->sibling_registration_no);
        $message_type = 'Registration';  
      }elseif ($request->sibling_registration=='2'){
        $sib_type_select = 2;
        $regis_app_no = MyFuncs::removeSpacialChr($request->sibling_application_no);
        $message_type = 'Application';
      }


      $siblingID = 0;
      $emailid = '';
      $mobile_no = '';
      if($sib_type_select > 0){  
        $sib_detail = $this->getSiblingDetail($regis_app_no, $sib_type_select);
        $error = $sib_detail[0]->error;
        if($error > 0){
          $response=array();
          $response['status']=0;
          $response['msg']='Sibling '.$message_type.' No. is not valid, Please enter correct detail';
          return $response;
        }
        $siblingID = $sib_detail[0]->sib_id;
      }else{
        $emailid = MyFuncs::removeSpacialChr($request->emailid);
        $mobile_no = MyFuncs::removeSpacialChr($request->mobileno);
      }

      $user_rs = Auth::guard('admin')->user();
      $user_id=$user_rs->id;
      $password = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyz0123456789" ), 0, 6 );
      $encrypt_password = bcrypt($password);
      $academic_year_id = $request->academic_year_id;
      $class_id= $request->class; 
      $subject_id= implode(',',$request->subject_id);
      $course_medium= $request->course_medium; 
      $st_name = MyFuncs::removeSpacialChr($request->student_name);
      $st_nickname = MyFuncs::removeSpacialChr($request->nick_name);
      $father_name = MyFuncs::removeSpacialChr($request->father_name);
      $st_aadhar = MyFuncs::removeSpacialChr($request->aadhaar_no);
      $test_date = $request->test_date;
      $test_time = MyFuncs::removeSpacialChr($request->test_time);
      $result_date = $request->result_date;
      $result_time = MyFuncs::removeSpacialChr($request->result_time);
      $test_duration = MyFuncs::removeSpacialChr($request->test_duration);
      $form_fee = $request->form_fee;

      $pre_school_name = MyFuncs::removeSpacialChr($request->last_school_name);
      $marks_max = floatval($request->max_marks);
      $marks_obt = floatval($request->marks_obt);
      $marks_percentage = floatval($request->marks_percent);
      $application_date = date('Y-m-d');
      
      $stu_insert_rs = DB::select(DB::raw("insert into `students`(`emailid`, `mobileno`, `dpassword`, `dpassword_encrypt`, `admin_id`, `name`, `nick_name`, `class_id`, `dob`, `gender_id`, `student_status_id`, `adhar_no`) values('$emailid', '$mobile_no', '$password', '$encrypt_password', $user_id, '$st_name', '$st_nickname', $class_id, '$request->dob', $request->gender, 8, '$st_aadhar');"));

      $new_student_rs = DB::select(DB::raw("select `id` from `students` where `adhar_no` = '$st_aadhar' limit 1;"));
      $new_stu_id = $new_student_rs[0]->id;
      //image-store-start//
      if (empty($request->image)) {
        $data = $request->webcam_image; 
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $timestamps =date('ymdHis');
        $image_name = $new_stu_id.'_'.$timestamps.'.jpg';       
        $path = Storage_path() . "/app/student/profile/" . $image_name; 
        @mkdir(Storage_path() . "/app/student/profile/", 0755, true);     
        file_put_contents($path, $data);
      }else{
        $image=$request->image;
        $timestamps =date('ymdHis');
        $image_name = $new_stu_id.'_'.$timestamps.'.jpg';  
        $image->storeAs('student/profile/',$image_name);
      }
        
      $update_rs = DB::select(DB::raw("update `students` set `picture` = '$image_name' where `id` = $new_stu_id limit 1;"));
      //image-store-end//
      $stu_insert_app = DB::select(DB::raw("insert into `admission_applications`(`for_academic_year`, `class_id`, `student_id`, `fathers_name`, `course_medium`, `test_date`, `test_time`, `result_date`, `result_time`, `form_fee`, `test_duration`, `last_school_name`, `marks_max`, `marks_obt`, `marks_percentage`, `status`, `application_date`) values($academic_year_id, $class_id, $new_stu_id, '$father_name', $course_medium, '$test_date', '$test_time', '$result_date', '$result_time', $form_fee, '$test_duration', '$pre_school_name', '$marks_max', '$marks_obt', '$marks_percentage', 1, '$application_date');"));

      // $adm_app_rs = DB::select(DB::raw("select * from `admission_applications` where `student_id` = $new_stu_id and `status` = 1 limit 1;"));
      $adm_app_rs = DB::select(DB::raw("select `adm`.`id`, `ay`.`name` as `year_name`, `adm`.`class_id`, `clt`.`name` as `class_name`, `adm`.`application_date`, `adm`.`fathers_name`, `cm`.`medium_name`, `adm`.`test_date`, `adm`.`test_time`, `adm`.`result_date`, `adm`.`result_time`, `adm`.`form_fee`, `adm`.`test_duration`, `ay`.`id` as `year_id` from `admission_applications` `adm` inner join `academic_years` `ay` on `ay`.`id` = `adm`.`for_academic_year` inner join `class_types` `clt` on `clt`.`id` = `adm`.`class_id` inner join `course_medium` `cm` on `cm`.`id` = `adm`.`course_medium` where `adm`.`student_id` = $new_stu_id and `adm`.`status` = 1 limit 1;"));
      $adm_app_id = $adm_app_rs[0]->id;
      
      $subject_update_rs = DB::select(DB::raw("insert into `adm_app_test_subjects` (`adm_app_id`, `subject_id`)  select $adm_app_id, `id` from `subject_types` where `id` in ($subject_id);"));

      $student_rs = DB::select(DB::raw("select `stu`.`name` as `stu_name`, `stu`.`class_id`, `clt`.`name` as `cl_name` from `students` `stu` inner join `class_types` `clt` on `clt`.`id` = `stu`.`class_id` where `stu`.`id` = $new_stu_id limit 1;"));
      
      $subjects_rs = DB::select(DB::raw("select `st`.`name` from `adm_app_test_subjects` `aats` inner join `subject_types` `st` on `st`.`id` = `aats`.`subject_id` where `aats`.`adm_app_id` = $adm_app_id order by `st`.`sorting_order_id`;"));

      $subjects = '';

      foreach ($subjects_rs as $key=>$val_subject) {
        if($subjects == ''){
          $subjects = $val_subject->name;  
        }else{
          $subjects = $subjects.', '.$val_subject->name;
        }
        
      }

      $fetch_rs = DB::select(DB::raw("select `id` from `admission_schedule` where `class_id` = $class_id and `academic_year_id` = $academic_year_id limit 1;"));
      $adm_sch_id = $fetch_rs[0]->id;
      
      $document_rs = DB::select(DB::raw("select `dt`.`name` from `adm_document_required` `adr` inner join `document_types` `dt` on `dt`.`id` = `adr`.`document_id` where `adr`.`adm_sch_id` = $adm_sch_id order by `dt`.`id`;"));
      
      $fetch_rs = DB::select(DB::raw("select `incharge_name`, `principal_name` from `admission_incharge_detail` where `class_id` = $class_id limit 1;"));
      $incharge_name = "";
      $principal_name = "";
      if (count($fetch_rs) > 0) {
        $incharge_name = $fetch_rs[0]->incharge_name;
        $principal_name = $fetch_rs[0]->principal_name;
      }

      $rs_image = DB::select(DB::raw("select `picture` from `students` where `id` = $new_stu_id limit 1;"));
      $image = Storage_path() . "/app/student/profile/" . $rs_image[0]->picture;

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
      
      $html = view('admin.student.studentdetails.schoolwiseadmission.pdf_page',compact('student_rs','adm_app_rs', 'subjects', 'document_rs', 'principal_name', 'incharge_name', 'image')); 
      $mpdf->WriteHTML($html); 
      $documentUrl = Storage_path() . '/app/student/admission/'.$academic_year_id.'/'.$class_id.'/'.$adm_app_id;
      $filename = $academic_year_id.'/'.$class_id.'/'.$adm_app_id;
      @mkdir($documentUrl, 0755, true);  
      $mpdf->Output($documentUrl.'.pdf', 'F');

      $adm_update_rs = DB::select(DB::raw("update `admission_applications` set `profile_path` = '$filename' where `id` = $adm_app_id limit 1;"));
      
      $response=array();
      $response['status']=1;
      $response['msg']='Save Successfully';   
      $response['student_id']=Crypt::encrypt($new_stu_id);   
      return $response; 

    }catch (Exception $e){
      Log::error('Application Form :'.$e);
    } 
  }//Function End

  public function helpDeskNewAdmView($student_id,$source)
  {    
    $userId=Auth::guard('admin')->user(); 
    $studentId= Crypt::decrypt($student_id);
    
    return view('admin.student.studentdetails.schoolwiseadmission.view',compact('studentId'));
  }

  public function helpDeskNewAdmStudentInfo($student_id)
  {
    $studentId = Crypt::decrypt($student_id);
    $student = DB::select(DB::raw("select * from `students` where `id` = $studentId limit 1;"));
    return view('admin.student.studentdetails.schoolwiseadmission.student_info',compact('student'));
  }

  public function helpDeskNewAdmDownload($student_id)
  {
    $studentId = Crypt::decrypt($student_id);
    $rs_fetch = DB::select(DB::raw("select * from `admission_applications` where `student_id` = $studentId limit 1"));
    $path= storage_path('app/student/admission/'.$rs_fetch[0]->profile_path.'.pdf');
    return Response::download($path);
  }

  //admAppEditForm

  public function admAppEditForm()
  {
    return view('admin.student.studentdetails.schoolwiseadmission.edit_app_form.search_form'); 
  }

  public function admAppEditFormSearch(Request $request)
  {
    $rules=[
        'application_no' => 'required', 
    ];
    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
      $errors = $validator->errors()->all();
      $response=array();
      $response["status"]=0;
      $response["msg"]=$errors[0];
      return response()->json($response);// response as json
    }
    $application_no = $request->application_no;
    $adm_app_list = DB::select(DB::raw("select `adm`.`id`, `adm`.`student_id`, `ay`.`name` as `year_name`, `stu`.`name` as `student_name`, `adm`.`class_id`, `clt`.`name` as `class_name`, `adm`.`application_date`, `adm`.`fathers_name`, `cm`.`medium_name`, `adm`.`test_date`, `adm`.`test_time`, `adm`.`result_date`, `adm`.`result_time`, `adm`.`form_fee`, `adm`.`test_duration`, `ay`.`id` as `year_id` from `admission_applications` `adm` inner join `academic_years` `ay` on `ay`.`id` = `adm`.`for_academic_year` inner join `class_types` `clt` on `clt`.`id` = `adm`.`class_id` inner join `course_medium` `cm` on `cm`.`id` = `adm`.`course_medium` inner join `students` `stu` on `stu`.`id` = `adm`.`student_id` where `adm`.`id` = $application_no and `adm`.`status` = 1 limit 1;"));
    if (empty($adm_app_list)) {
      $response = array();  
      $response['msg']= 'Invalid Application No.';
      $response['status'] = 0;
      return $response;
    }
    $response = array();  
    $response['data']= view('admin.student.studentdetails.schoolwiseadmission.edit_app_form.student_app_list',compact('adm_app_list'))->render();
    $response['status'] = 1;
    return $response;
    
  }

  public function admAppEditFormEdit($student_id)
  { 
    $studentId = Crypt::decrypt($student_id);
    $image_path = DB::select(DB::raw("select `picture` from `students` where `id` = $studentId limit 1")); 
    $academicYears = SelectBox::getYearAdmissionOpen(); 
    $course_medium = SelectBox::getCourseMedium(); 
    $genders = SelectBox::getGenders();
    $adm_app_list = DB::select(DB::raw("select `adm`.`id`, `adm`.`student_id`, `stu`.`name` as `student_name`, `stu`.`nick_name`, `stu`.`dob`, `stu`.`gender_id`, `stu`.`adhar_no`, `adm`.`class_id`, `adm`.`course_medium`, `adm`.`application_date`, `adm`.`fathers_name`, `adm`.`test_date`, `adm`.`test_time`, `adm`.`result_date`, `adm`.`result_time`, `adm`.`form_fee`, `adm`.`test_duration`, `ay`.`id` as `year_id`, `adm`.`last_school_name`, `adm`.`marks_percentage`, `adm`.`marks_obt`, `adm`.`marks_max` from `admission_applications` `adm` inner join `academic_years` `ay` on `ay`.`id` = `adm`.`for_academic_year` inner join `class_types` `clt` on `clt`.`id` = `adm`.`class_id` inner join `students` `stu` on `stu`.`id` = `adm`.`student_id` where `adm`.`student_id` = $studentId and `adm`.`status` = 1 limit 1;"));  
    return view('admin.student.studentdetails.schoolwiseadmission.edit_app_form.edit_form',compact('academicYears','default','genders', 'course_medium', 'adm_app_list', 'image_path'));
  }

  public function admAppAcadWiseClass(Request $request)
  {
    $yearId = $request->academic_year_id;
    $studentId = Crypt::decrypt($request->student_id);
    $rs_fetch = DB::select(DB::raw("select `class_id` from `admission_applications` where `student_id` = $studentId limit 1"));
    $rs_class_id = $rs_fetch[0]->class_id;
    $classes = SelectBox::getClassAdmissionOpenYearWise($yearId);
    return view('admin.student.studentdetails.schoolwiseadmission.edit_app_form.class_select_box',compact('classes', 'rs_class_id'));

    
  }

  public function admAppAcadWiseSubject(Request $request)
  {
    $studentId = Crypt::decrypt($request->student_id);
    $ac_year_id = $request->academic_year_id;
    $class_id = $request->class_id;
    $rs_fetch = DB::select(DB::raw("select `id` from `admission_schedule` where `academic_year_id` = $ac_year_id and `class_id` = $class_id limit 1;"));
    $adm_schedule_id = 0;
    if(count($rs_fetch)>0){
      $adm_schedule_id = $rs_fetch[0]->id;
    }

    $rs_subjects = DB::select(DB::raw("select `id`, `name`, 0 as `selected` from `subject_types` `st`  where `id` not in (select `subject_id` from `adm_test_subjects` where `adm_sch_id` = $adm_schedule_id) union select `id`, `name`, 1 as `selected` from `subject_types` `st`  where `id` in (select `subject_id` from `adm_test_subjects` where `adm_sch_id` = $adm_schedule_id) order by `name`;"));
    return view('admin.student.studentdetails.schoolwiseadmission.edit_app_form.subject_select_box',compact('rs_subjects'));

    
  }

  public function admAppEditFormStore(Request $request, $student_id)
  {
    $new_stu_id = Crypt::decrypt($student_id); 
    $regis_app_no = '';
    $message_type = '';
    $error = 0;
    try{
      $rules=[
        'academic_year_id' => 'required',
        'class' => 'required', 
        'subject_id' => 'required', 
        'course_medium' => 'required', 
        "student_name" => 'required|max:50', 
        "father_name" => 'required|max:50', 
        "dob" => 'required|date',
        "gender" => "required", 
        "aadhaar_no" => "required|digits:12|unique:students,adhar_no,".$new_stu_id,
        "test_date" => "required|date",
        "test_time" => "required",
        "result_date" => "required|date",
        "result_time" => "required",
        "test_duration" => "required",
        "form_fee" => "required",
      ];
      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $response=array();
        $response["status"]=0;
        $response["msg"]=$errors[0];
        return response()->json($response);// response as json
      }

      $user_rs = Auth::guard('admin')->user();
      $user_id=$user_rs->id;
      $academic_year_id = $request->academic_year_id;
      $class_id= $request->class; 
      $subject_id= implode(',',$request->subject_id);
      $course_medium= $request->course_medium; 
      $st_name = MyFuncs::removeSpacialChr($request->student_name);
      $st_nickname = MyFuncs::removeSpacialChr($request->nick_name);
      $father_name = MyFuncs::removeSpacialChr($request->father_name);
      $st_aadhar = MyFuncs::removeSpacialChr($request->aadhaar_no);
      $test_date = $request->test_date;
      $test_time = MyFuncs::removeSpacialChr($request->test_time);
      $result_date = $request->result_date;
      $result_time = MyFuncs::removeSpacialChr($request->result_time);
      $test_duration = MyFuncs::removeSpacialChr($request->test_duration);
      $form_fee = $request->form_fee;

      $pre_school_name = MyFuncs::removeSpacialChr($request->last_school_name);
      $marks_max = floatval($request->max_marks);
      $marks_obt = floatval($request->marks_obt);
      $marks_percentage = floatval($request->marks_percent);
      
      $stu_update_rs = DB::select(DB::raw("update `students` set `name` = '$st_name', `nick_name` = '$st_nickname', `class_id` = $class_id, `dob` = '$request->dob', `gender_id` = $request->gender, `adhar_no` = '$st_aadhar' where `id` = $new_stu_id limit 1;"));

      //image-store-start//
      $rs_image = DB::select(DB::raw("select `picture` from `students` where `id` = $new_stu_id limit 1;")); 
      
      if (empty($request->image) && empty($request->webcam_image)) {
        $image_name = $rs_image[0]->picture; 
      }else{
        if (!empty($request->image)) {
          $image=$request->image;
          $timestamps =date('ymdHis');
          $image_name = $new_stu_id.'_'.$timestamps.'.jpg';  
          $image->storeAs('student/profile/',$image_name); 
        }else{
          $data = $request->webcam_image; 
          list($type, $data) = explode(';', $data);
          list(, $data)      = explode(',', $data);
          $data = base64_decode($data);
          $timestamps =date('ymdHis');
          $image_name = $new_stu_id.'_'.$timestamps.'.jpg';       
          $path = Storage_path() . "/app/student/profile/" . $image_name; 
          @mkdir(Storage_path() . "/app/student/profile/", 0755, true);     
          file_put_contents($path, $data);
        
        }
      } 
      
      $update_rs = DB::select(DB::raw("update `students` set `picture` = '$image_name' where `id` = $new_stu_id limit 1;"));
      //image-store-end//
      

      $adm_fetch_rs = DB::select(DB::raw("select `adm`.`id` from `admission_applications` `adm` where `adm`.`student_id` = $new_stu_id and `adm`.`status` = 1 limit 1;"));
      $adm_app_id = $adm_fetch_rs[0]->id;

      $stu_update_app = DB::select(DB::raw("update `admission_applications` set `for_academic_year` = $academic_year_id, `class_id` = $class_id, `fathers_name` = '$father_name', `course_medium` = $course_medium, `test_date` = '$test_date', `test_time` = '$test_time', `result_date` = '$result_date', `result_time` = '$result_time', `form_fee` = $form_fee, `test_duration` = '$test_duration', `last_school_name` = '$pre_school_name', `marks_max` = '$marks_max', `marks_obt` = '$marks_obt', `marks_percentage` = '$marks_percentage' where `id` = $adm_app_id limit 1;"));

      $subject_update_rs = DB::select(DB::raw("delete from `adm_app_test_subjects` where `adm_app_id` = $adm_app_id and `subject_id` not in ($subject_id);"));

      $subject_update_rs = DB::select(DB::raw("insert into `adm_app_test_subjects` (`adm_app_id`, `subject_id`)  select $adm_app_id, `id` from `subject_types` where `id` in ($subject_id) and `id` not in (select `subject_id` from `adm_app_test_subjects` where `adm_app_id` = $adm_app_id);"));

      $adm_app_rs = DB::select(DB::raw("select `adm`.`id`, `ay`.`name` as `year_name`, `adm`.`class_id`, `clt`.`name` as `class_name`, `adm`.`application_date`, `adm`.`fathers_name`, `cm`.`medium_name`, `adm`.`test_date`, `adm`.`test_time`, `adm`.`result_date`, `adm`.`result_time`, `adm`.`form_fee`, `adm`.`test_duration`, `ay`.`id` as `year_id` from `admission_applications` `adm` inner join `academic_years` `ay` on `ay`.`id` = `adm`.`for_academic_year` inner join `class_types` `clt` on `clt`.`id` = `adm`.`class_id` inner join `course_medium` `cm` on `cm`.`id` = `adm`.`course_medium` where `adm`.`id` = $adm_app_id limit 1;"));
      
      $student_rs = DB::select(DB::raw("select `stu`.`name` as `stu_name`, `stu`.`class_id`, `clt`.`name` as `cl_name` from `students` `stu` inner join `class_types` `clt` on `clt`.`id` = `stu`.`class_id` where `stu`.`id` = $new_stu_id limit 1;"));
      
      $subjects_rs = DB::select(DB::raw("select `st`.`name` from `adm_app_test_subjects` `aats` inner join `subject_types` `st` on `st`.`id` = `aats`.`subject_id` where `aats`.`adm_app_id` = $adm_app_id order by `st`.`sorting_order_id`;"));

      $subjects = '';

      foreach ($subjects_rs as $key=>$val_subject) {
        if($subjects == ''){
          $subjects = $val_subject->name;  
        }else{
          $subjects = $subjects.', '.$val_subject->name;
        }
        
      }

      $fetch_rs = DB::select(DB::raw("select `id` from `admission_schedule` where `class_id` = $class_id and `academic_year_id` = $academic_year_id limit 1;"));
      $adm_sch_id = $fetch_rs[0]->id;
      
      $document_rs = DB::select(DB::raw("select `dt`.`name` from `adm_document_required` `adr` inner join `document_types` `dt` on `dt`.`id` = `adr`.`document_id` where `adr`.`adm_sch_id` = $adm_sch_id order by `dt`.`id`;"));
      
      $fetch_rs = DB::select(DB::raw("select `incharge_name`, `principal_name` from `admission_incharge_detail` where `class_id` = $class_id limit 1;"));
      $incharge_name = "";
      $principal_name = "";
      if (count($fetch_rs) > 0) {
        $incharge_name = $fetch_rs[0]->incharge_name;
        $principal_name = $fetch_rs[0]->principal_name;
      }
      $rs_image = DB::select(DB::raw("select `picture` from `students` where `id` = $new_stu_id limit 1;"));
      $image = Storage_path() . "/app/student/profile/" . $rs_image[0]->picture; 
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
      
      $html = view('admin.student.studentdetails.schoolwiseadmission.pdf_page',compact('student_rs','adm_app_rs', 'subjects', 'document_rs', 'principal_name', 'incharge_name','image')); 
      $mpdf->WriteHTML($html); 
      $documentUrl = Storage_path() . '/app/student/admission/'.$academic_year_id.'/'.$class_id.'/'.$adm_app_id;
      $filename = $academic_year_id.'/'.$class_id.'/'.$adm_app_id;
      @mkdir($documentUrl, 0755, true);  
      $mpdf->Output($documentUrl.'.pdf', 'F');

      $adm_update_rs = DB::select(DB::raw("update `admission_applications` set `profile_path` = '$filename' where `id` = $adm_app_id limit 1;"));
      
      $response=array();
      $response['status']=1;
      $response['msg']='Update Successfully';   
      $response['student_id']=Crypt::encrypt($new_stu_id);   
      return $response; 

    }catch (Exception $e){
      Log::error('Application Form :'.$e);
    }
  }



  // public function studentNewAdmFormStep1Store(Request $request)
  // {   
     
  //   try {
  //     $rules=[
  //       'class' => 'required', 
  //       "student_name" => 'required|max:199', 
  //       "dob" => 'required|date',
  //       "gender" => "required", 
  //       "aadhaar_no" => "required|digits:12|unique:students,adhar_no",   
  //     ];
       
  //     $validator = Validator::make($request->all(),$rules);
  //     if ($validator->fails()) {
  //       $errors = $validator->errors()->all();
  //       $response=array();
  //       $response["status"]=0;
  //       $response["msg"]=$errors[0];
  //       return response()->json($response);// response as json
  //     } 
       
  //     $user_rs = Auth::guard('admin')->user();
  //     $user_id=$user_rs->id;
      
  //     $st_name = MyFuncs::removeSpacialChr($request->student_name);
  //     $st_nickname = MyFuncs::removeSpacialChr($request->nick_name);
  //     $st_aadhar = MyFuncs::removeSpacialChr($request->aadhaar_no);

  //     $pre_school_name = MyFuncs::removeSpacialChr($request->last_school_name);
  //     $marks_percentage = floatval($request->marks_percent);
  //     $marks_obt = floatval($request->marks_obt);
  //     $marks_max = floatval($request->max_marks);


  //     $stu_insert_rs = DB::select(DB::raw("insert into `students`(`admin_id`, `name`, `nick_name`, `class_id`, `dob`, `gender_id`, `student_status_id`, `adhar_no`) values($user_id, '$st_name', '$st_nickname', $request->class, '$request->dob', $request->gender, 8, '$st_aadhar');"));

  //     $new_student_rs = DB::select(DB::raw("select `id` from `students` where `adhar_no` = '$st_aadhar' limit 1;"));
  //     $new_stu_id = $new_student_rs[0]->id;

  //     $adm_app_rs = DB::select(DB::raw("select `id` from `admission_applications` where `student_id` = $new_stu_id and `status` = 1 limit 1;"));
  //     $adm_app_id = $adm_app_rs[0]->id;

  //     $adm_update_rs = DB::select(DB::raw("update `admission_applications` set `for_academic_year` = $request->academic_year_id, `last_school_name` = '$pre_school_name', `marks_percentage` = $marks_percentage, `marks_obt` = $marks_obt, `marks_max` = $marks_max , `remark` = '' where `id` = $adm_app_id limit 1;"));

  //     $subject_update_rs = DB::select(DB::raw("update `student_subjects` set `session_id` = $request->academic_year_id where `student_id` = $new_stu_id;"));
      
  //     // $encrypt_new_stu_id = Crypt::encrypt($new_stu_id);
  //     // return redirect()->route('admin.student.view,$encrypt_new_stu_id'); 

  //     $response=array();
  //     $response['status']=1;
  //     $response['msg']='Save Successfully';   
  //     $response['student_id']=Crypt::encrypt($new_stu_id);
  //     return $response; 
         
  //   } catch (Exception $e) {
  //     Log::error('Student store :'.$e);
  //   }
  // }

  // public function editAppFormStudent($student_id)
  // { 

  //   $userId=Auth::guard('admin')->user();   
  //   $studentId= Crypt::decrypt($student_id); 
    
  //   $student=MyFuncs::getStudentDetailsByStudetId($studentId);
  //   $parentsType = SelectBox::getGurdianRelationType();
  //   $incomes = SelectBox::getIncomeSlabType();
  //   $documentTypes = SelectBox::getDocumentType();
  //   $academicYears = SelectBox::getYearAdmissionOpen(); 
  //   $subjectTypes = SelectBox::getSubjectType(); 
  //   $awardLevels = SelectBox::getAwardLevelType();
  //   $isoptionals = SelectBox::getIsoptionals();
  //   $bloodgroups = SelectBox::getBloodgroups();
  //   $professions = SelectBox::getProfessions(); 
  //   $houses = SelectBox::getAllHouses();
  //   $genders = SelectBox::getGenders();
  //   $schoolinfo = MyFuncs::getSchoolDetailContactEmail();
  //   $adm_app_rs = DB::select(DB::raw("select `for_academic_year`,`class_id` from `admission_applications` where `student_id` = $studentId and `status` = 1 limit 1;"));
   
  //   $studentStatus=DB::select(DB::raw("call up_check_user_student_status ('$userId->id')")); 
  //   if ($studentStatus[0]->show_status==1) {
  //       $showHide='';
  //   }else{
  //       $showHide='hidden';
  //   } 
     
  //   return view('admin.student.studentdetails.newregistration.complete_adm_app_form',compact('student', 'parentsType', 'incomes', 'documentTypes', 'isoptionals', 'academicYears', 'awardLevels', 'subjectTypes', 'bloodgroups', 'professions', 'houses', 'genders', 'userId', 'schoolinfo', 'studentStatus','adm_app_rs'));
  // }
  
  public function showForm()
  {  
    $student=MyFuncs::getStudentDetailsByStudetId(2);  
    $parentsType =DB::select(DB::raw("select  `id` , `name`  from `guardian_relation_types`;"));
    $incomes =DB::select(DB::raw("select  `id` , `range`  from `income_ranges`;"));
    $documentTypes =DB::select(DB::raw("select  `id` , `name`  from `document_types`;"));
    $sessions =SelectBox::getAllAcademicYear(); 
    $subjectTypes =DB::select(DB::raw("select  `id` , `name`  from  `subject_types`;"));
    $awardLevels =DB::select(DB::raw("select  `id` , `name`  from  `award_levels`;"));
    $isoptionals =DB::select(DB::raw("select  `id` , `name`  from  `isoptionals`;"));
    $bloodgroups =DB::select(DB::raw("select  `id` , `name`  from  `blood_groups`;"));
    $professions =DB::select(DB::raw("select  `id` , `name`  from  `professions`;"));
    $houses =DB::select(DB::raw("select  `id` , `name`  from  `houses`;"));
    $genders =SelectBox::getGenders();
    $classes = MyFuncs::getClasses(); 
    // $menuPermission= MyFuncs::menuPermission(); 
    return view('admin.student.studentdetails.show_form',compact('classes','sessions','default','genders','religions','categories','menuPermission','students'));
  }

  // public function applicationStatus()
  // { 
  //   $userId=Auth::guard('admin')->user();     
  //   $applicationStatus =DB::select(DB::raw("select `ay`.`name` as `year_name`, `ct`.`name` as `class_name`, `st`.`name` as `student_name`, `aa`.`id` as `app_id`, `st`.`id` as `stu_id`, `aa`.`status` as `app_status`, `st`.`student_status_id`, `aasm`.`name` as `adm_app_status`, `aasm`.`button_caption`, `aasm`.`route_link` from `student_user_map` `sum` inner join `admission_applications` `aa` on `aa`.`student_id` = `sum`.`student_id` inner join `students` `st` on `st`.`id` = `sum`.`student_id` inner join `academic_years` `ay` on `ay`.`id` = `aa`.`for_academic_year` inner join `class_types` `ct` on `ct`.`id` = `aa`.`class_id` inner join `adm_app_status_master` `aasm` on `aasm`.`id` = `aa`.`status` where `sum`.`userid` = $userId->id order by `aa`.`id`;"));
  //   return view('admin.student.studentdetails.newregistration.student_list',compact('applicationStatus')); 
  // }
 
  
  public function image($picture)
  {
    $storagePath = storage_path('app/student/profile/'.$picture);          
    $mimeType = mime_content_type($storagePath); 
    if( ! \File::exists($storagePath)){
      return view('error.home');
    }
    $headers = array(
      'Content-Type' => $mimeType,
      'Content-Disposition' => 'inline; '
    );            
    return Response::make(file_get_contents($storagePath), 200, $headers);     
  }

  public function showList(Request $request, $type)
  {
    // return $request;
    // $menuPermissionId = $menuPermissionId;
    $type = $type;
    if ($type==1) {
      $students =DB::select(DB::raw("select * from `students`;"));
    }
    $type = $type;
    if ($type==2) {
      $students =DB::select(DB::raw("select * from `students`;"));
    }
    $type = $type;
    if ($type==3) {
      $students =DB::select(DB::raw("select * from `students`;"));
    }
    $response = array();  
    $response['data']= view('admin.student.studentdetails.list',compact('students','menuPermision','fatherDetail','source'))->render();
    $response['status'] = 1;
    return $response;
  }



                  
   
       
   
  
    

  //--------------End------------------


  // public function registrationStore(Request $request)
  // {   
     
  //    try {
  //     $rules=[
          
  //          'class' => 'required', 
  //          "student_name" => 'required|max:199', 
  //          "dob" => 'required|date',
  //          "gender" => "required", 
  //          "aadhaar_no" => "required|digits:12|unique:students,adhar_no",
           
  //      ];
  //      $validator = Validator::make($request->all(),$rules);
  //      if ($validator->fails()) {
  //          $errors = $validator->errors()->all();
  //          $response=array();
  //          $response["status"]=0;
  //          $response["msg"]=$errors[0];
  //          return response()->json($response);// response as json
  //      } 
  //      else {   
  //      $admin_id = Auth::guard('admin')->user()->id;
  //      $char = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyz0123456789" ), 0, 6 );
  //      $student= new Student(); 
  //      $student->dpassword= $char;  
  //      $student->dpassword_encrypt= bcrypt($char); 
  //      $student->roll_no=$request->academic_year_id; 
  //      $student->admin_id = $admin_id; 
  //      $student->class_id= $request->class; 
  //      $student->name= $request->student_name;
  //      $student->nick_name= $request->nick_name; 
  //      $student->dob= $request->date_of_birth == null ? $request->dob : date('Y-m-d',strtotime($request->dob));
  //      $student->gender_id= $request->gender;        
  //      $student->adhar_no= $request->aadhaar_no; 
  //      $student->student_status_id=8; 
  //      $student->save();
  //      $AdmissionApplication=AdmissionApplication::orderBy('id','DESC')->first();
  //      $AdmissionApplication=AdmissionApplication::find($AdmissionApplication->id);
  //      $AdmissionApplication->last_school_name=$request->last_school_name;
  //      $AdmissionApplication->marks_max=$request->max_marks;
  //      $AdmissionApplication->marks_obt=$request->marks_obt;
  //      $AdmissionApplication->marks_percentage=$request->marks_percent;
  //      $AdmissionApplication->save();
  //      $response=array();
  //      $response['status']=1;
  //      $response['msg']='Registration Successfully';   
  //      $response['student_id']=Crypt::encrypt($student->id);
  //      return $response; 
  //      }  
  //    } catch (Exception $e) {
  //      Log::error('Student store :'.$e);
  //    }
  // }



        // $classes = MyFuncs::getClasses();
  //   public function index(Request $request,$menuPermissionId,$type)
  //   {   
  //       $source=$type;        
  //       if ($request->class!=null) {
  //         $st =new Student();           
  //         $students =$st->getStudentByClassSection($request->class,$request->section); 
  //       }elseif($request->student_id!=null){
  //         $student=Student::where('registration_no',$request->student_id)->first();
  //         if (empty($student)) {
  //          $response=array();
  //           $response["status"]=0;
  //           $response["msg"]='Registration No Not Exist';
  //           return response()->json($response);
  //         }  
  //         $st =new Student();           
  //         $students =$st->getStudentDetailsByArrId([$student->id]);
  //       }elseif($request->application_no!=null){
  //         $application_no=AdmissionApplication::where('id',$request->application_no)->first();
  //         if (empty($application_no)) {
  //          $response=array();
  //           $response["status"]=0;
  //           $response["msg"]='Application No Not Exist';
  //           return response()->json($response);
  //         }  
  //         $st =new Student();           
  //         $students =$st->getStudentDetailsByArrId([$application_no->student_id]);
  //       }elseif($request->search_id!=null){
  //         $st =new Student();           
  //         $students =$st->getStudentsSearchDetilas($request->search_id);

  //       }
  //       $menuPermision= Minu::find($menuPermissionId); 

  //       $previousRoute= app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();        
         

  //       $response = array(); 
  //       if ($previousRoute=='admin.student.image.upload') {
  //          $response['data']= view('admin.student.studentdetails.student_list_table',compact('students','menuPermision','fatherDetail'))->render(); 
  //            $response['status'] = 1;
  //            return $response;
  //        }
  //       $response['data']= view('admin.student.studentdetails.list',compact('students','menuPermision','fatherDetail','source'))->render();
  //           $response['status'] = 1;
  //           return $response;
  //   }
  //   public function studentImageUploadList($conditionId)
  //   {
  //     if($conditionId==1){
  //       $students=Student::orderBy('id','ASC')->where('picture_status',0)->get();
  //     }elseif($conditionId==2){
  //       $students=Student::orderBy('id','ASC')->where('picture_status',1)->get();
  //     }elseif($conditionId==3){
  //       $students=Student::orderBy('id','ASC')->get();
  //     }
        
  //     return view('admin.student.studentdetails.student_list_table',compact('students','conditionId')); 
  //   }
  //   public function studentSearch(Request $request,$menuPermissionId)
  //   { 
  //       $search = $request->input('id');
  //       if ($request->has('search_id')) {
  //         $search = $request->input('search_id');
  //       }
  //       $st=new Student();
  //       $students=$st->getStudentsSearchDetilas($search); 
  //       $menuPermision= Minu::find($menuPermissionId); 

  //      $previousRoute= app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();        
  //       if ($previousRoute=='admin.student.image.upload') {
  //         return  view('admin.student.studentdetails.student_list_table',compact('students','menuPermision','fatherDetail')); 
  //       }
  //      return  view('admin.student.studentdetails.list',compact('students','menuPermision','fatherDetail')); 
            
  //   }
   
     

  
  //   public function showForm()
  //   {        
  //       $st= new Student();
  //       $students=$st->getAllStudents();    
  //       $sessions = array_pluck(AcademicYear::get(['id','name'])->toArray(),'name', 'id');
  //       $genders = array_pluck(Gender::get(['id','genders'])->toArray(),'genders', 'id');
  //       $religions = array_pluck(Religion::get(['id','name'])->toArray(),'name', 'id');
  //       $categories = array_pluck(Category::get(['id','name'])->toArray(),'name', 'id');
  //       $default = StudentDefaultValue::find(1); 
  //       $menuPermission= MyFuncs::menuPermission(); 
  //       return view('admin.student.studentdetails.showForm',compact('classes','sessions','default','genders','religions','categories','menuPermission','students'));
  //   }

  //   public function  passwordReset(Student $student){
  //       $char = substr( str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 6 );
  //       $student->password = bcrypt($char);
  //       $student->tmp_pass = $char;
  //       if($student->save()){ 
  //            //Event::fire('');
  //           return redirect()->back()->with(['class'=>'success','message'=>'student Password reset success ...']);
           
  //       }
  //       return redirect()->back()->with(['class'=>'error','message'=>'Whoops ! Look like somthing went wrong ..']);
  //   }
     
  public function previewshow($student_id)
  {
    $studentId = Crypt::decrypt($student_id);
    $student = DB::select(DB::raw("call `up_get_StudentDetail`($studentId);"));
    $rs_parentInfo = DB::select(DB::raw("select `grt`.`name` as `relation`, `pi`.`id`, `pi`.`name`, `pi`.`education`, `pi`.`occupation`, `pf`.`name` as `profession`, `pi`.`income_id`, `ir`.`range` as `income`, `pi`.`mobile`, `pi`.`email`, `pi`.`dob`, `pi`.`doa`, `pi`.`office_address`, `pi`.`photo`, `pi`.`organization_address`, `pi`.`f_designation`, `pi`.`islive` from `student_perent_details` `spd` inner join `guardian_relation_types` `grt` on `grt`.`id` = `spd`.`relation_id` inner join `parents_infos` `pi` on `pi`.`id` = `spd`.`perent_info_id` inner join `professions` `pf` on `pf`.`id` = `pi`.`occupation` inner join `income_ranges` `ir` on `ir`.`id` = `pi`.`income_id` where `spd`.`student_id` = $studentId order by `grt`.`id`;"));
    $rs_medicals = DB::select(DB::raw("select `smi`.`id`, `smi`.`ondate`, `smi`.`bloodgroup_id`, `bg`.`name` as `blood_group`, `smi`.`hb`, `smi`.`weight`, `smi`.`height`, `smi`.`narration`, `smi`.`vision`, `smi`.`complextion`, `cmp`.`name` as `complextion_name`, `smi`.`isalgeric`, `smi`.`alergey`, `smi`.`alergey_vacc`, `smi`.`ishandicapped`, `smi`.`handi_percent`, `smi`.`physical_handicapped`, `smi`.`id_marks1`, `smi`.`id_marks2`, `smi`.`dental`, `smi`.`bp_lower`, `smi`.`bp_uper` from `student_medical_infos` `smi` left join `blood_groups` `bg` on `bg`.`id` = `smi`.`bloodgroup_id` left join `complextions` `cmp` on `cmp`.`id` = `smi`.`complextion` where `smi`.`student_id` = $studentId order by `smi`.`ondate` desc;"));
    $rs_siblings = DB::select(DB::raw("call `up_get_sibling_info_all`($studentId);"));
    $default_year_id = MyFuncs::getDefaultAcademicYearID();
    $studentSubjects=DB::select(DB::raw("select `sts`.`id`, `sts`.`subject_type_id`, `sub`.`name`, case `sts`.`isoptional_id` when 1 then 'Compulsory' else 'Optional' end as `is_compulsory` from `student_subjects` `sts` inner join `subject_types` `sub` on `sub`.`id` = `sts`.`subject_type_id` where `sts`.`student_id` = $studentId and `sts`.`session_id` = $default_year_id and `sts`.`status` = 1 order by `sub`.`sorting_order_id`;"));
 
    return view('admin.student.studentdetails.preview',compact('student', 'rs_parentInfo', 'rs_medicals', 'rs_siblings', 'studentSubjects'));
  }

  public function profileDownload($student_id)
  {
    $studentId = Crypt::decrypt($student_id);
    $student = DB::select(DB::raw("call `up_get_StudentDetail`($studentId);"));
    $rs_parentInfo = DB::select(DB::raw("select `grt`.`name` as `relation`, `pi`.`id`, `pi`.`name`, `pi`.`education`, `pi`.`occupation`, `pf`.`name` as `profession`, `pi`.`income_id`, `ir`.`range` as `income`, `pi`.`mobile`, `pi`.`email`, `pi`.`dob`, `pi`.`doa`, `pi`.`office_address`, `pi`.`photo`, `pi`.`organization_address`, `pi`.`f_designation`, `pi`.`islive` from `student_perent_details` `spd` inner join `guardian_relation_types` `grt` on `grt`.`id` = `spd`.`relation_id` inner join `parents_infos` `pi` on `pi`.`id` = `spd`.`perent_info_id` inner join `professions` `pf` on `pf`.`id` = `pi`.`occupation` inner join `income_ranges` `ir` on `ir`.`id` = `pi`.`income_id` where `spd`.`student_id` = $studentId order by `grt`.`id`;"));
    $rs_medicals = DB::select(DB::raw("select `smi`.`id`, `smi`.`ondate`, `smi`.`bloodgroup_id`, `bg`.`name` as `blood_group`, `smi`.`hb`, `smi`.`weight`, `smi`.`height`, `smi`.`narration`, `smi`.`vision`, `smi`.`complextion`, `cmp`.`name` as `complextion_name`, `smi`.`isalgeric`, `smi`.`alergey`, `smi`.`alergey_vacc`, `smi`.`ishandicapped`, `smi`.`handi_percent`, `smi`.`physical_handicapped`, `smi`.`id_marks1`, `smi`.`id_marks2`, `smi`.`dental`, `smi`.`bp_lower`, `smi`.`bp_uper` from `student_medical_infos` `smi` left join `blood_groups` `bg` on `bg`.`id` = `smi`.`bloodgroup_id` left join `complextions` `cmp` on `cmp`.`id` = `smi`.`complextion` where `smi`.`student_id` = $studentId order by `smi`.`ondate` desc;"));
    $rs_siblings = DB::select(DB::raw("call `up_get_sibling_info_all`($studentId);"));
    $default_year_id = MyFuncs::getDefaultAcademicYearID();
    $studentSubjects=DB::select(DB::raw("select `sts`.`id`, `sts`.`subject_type_id`, `sub`.`name`, case `sts`.`isoptional_id` when 1 then 'Compulsory' else 'Optional' end as `is_compulsory` from `student_subjects` `sts` inner join `subject_types` `sub` on `sub`.`id` = `sts`.`subject_type_id` where `sts`.`student_id` = $studentId and `sts`.`session_id` = $default_year_id and `sts`.`status` = 1 order by `sub`.`sorting_order_id`;"));
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
    
    $html = view('admin.student.studentdetails.profile_download',compact('student', 'rs_parentInfo', 'rs_medicals', 'rs_siblings', 'studentSubjects')); 
    $mpdf->WriteHTML($html); 
    $mpdf->Output();
  }

    // public function pdfGenerate($id){
    //   // return 'dddddd';
    //   $id=Crypt::decrypt($id);
    //     $st =new Student();
    //        $student=$st->getStudentDetailsById($id); 
    //        //sibling details//
    //       $studentSibling=SiblingGroup::
    //                                     where('student_id',$id)
    //                                     ->count();
    //      if ($studentSibling!=0) {
    //        $studentSiblingId=SiblingGroup::
    //                                        where('student_id',$id)
    //                                        ->first();
    //      $studentSiblingInfos=SiblingGroup::
    //                                         where('group',$studentSiblingId->group)
    //                                        ->where('student_id','!=',$id)
    //                                         ->get();
    //      }else{
    //         $studentSiblingInfos=array();
    //      } 
    //      //end sibling detaild///
    //      //application barcode ///
                   
    //                  // $admissionApplication=AdmissionApplication::where('student_id',$student->id)->first();
    //                  // if (!empty($admissionApplication)) { 
    //                  // $value=$admissionApplication->id; 
    //                  // $barcode = new BarcodeGenerator();
    //                  // $barcode->setText($value);
    //                  // $barcode->setType(BarcodeGenerator::Code128);
    //                  // $barcode->setScale(2);
    //                  // $barcode->setThickness(25);
    //                  // $barcode->setFontSize(10);
    //                  // $code = $barcode->generate();
    //                  // $data = base64_decode($code);
    //                  // $image_name= $value.'.png';     
    //                  // $path = Storage_path() . "/app/student/barcode/application/";
    //                  // $paths = Storage_path() . "/app/student/barcode/application/" . $image_name;
    //                  // @mkdir($path, 0755, true); 
    //                  // file_put_contents($paths, $data); 
    //                  // }
    //                  if (!empty($student->registration_no)) { 
    //                  $value=$student->registration_no; 
    //                  $barcode = new BarcodeGenerator();
    //                  $barcode->setText($value);
    //                  $barcode->setType(BarcodeGenerator::Code128);
    //                  $barcode->setScale(2);
    //                  $barcode->setThickness(25);
    //                  $barcode->setFontSize(10);
    //                  $code = $barcode->generate();
    //                  $data = base64_decode($code);
    //                  $image_name= $value.'.png';     
    //                  $path = Storage_path() . "/app/student/barcode/";
    //                  $paths = Storage_path() . "/app/student/barcode/" . $image_name;
    //                  @mkdir($path, 0755, true); 
    //                  file_put_contents($paths, $data); 
    //                  }
                   
    //        //application barcode end///          
    //       $studentMedicalInfos = StudentMedicalInfo::where('student_id',$id)->get(); 
    //       $documents = Document::where('student_id',$id)->get(); 
    //       $studentSubjects=StudentSubject::where('student_id',$id)->get();
    //       $path =Storage_path() . '/app/student/profile/profileDetails/';
    //       $profilePdfUrl = Storage_path() . '/app/student/profile/profileDetails/'.$student->registration_no.'_student_all_details.pdf';
    //       @mkdir($path, 0755, true); 
    //       $pdf = PDF::setOptions([
    //         'logOutputFile' => storage_path('logs/log.htm'),
    //         'tempDir' => storage_path('logs/')
    //     ])
    //     ->loadView('admin.student.studentdetails.pdf_generate',compact('student','fatherDetail','motherDetail','documents','studentMedicalInfos','studentSiblingInfos','studentSubjects','address','data','admissionApplication'))->save($profilePdfUrl);
    //     $docs=$documents; 
    //                $pdfMerge = new Fpdi();
    //                $dt =array();
    //               $dt['student']=$profilePdfUrl;
    //                foreach ($docs as $key=>$document) {
                    
    //                  $dt[$key]=Storage_path('app/'.$document->document_url);  
                  
    //               }
                
    //                $files =$dt;
    //                foreach ($files as $file) {
    //                   $pageCount =$pdfMerge->setSourceFile($file);
    //                   for ($pageNo=1; $pageNo <=$pageCount ; $pageNo++) { 
    //                       $pdfMerge->AddPage();
    //                       $pageId = $pdfMerge->importPage($pageNo, '/MediaBox');
    //                       //$pageId = $pdfMerge->importPage($pageNo, Fpdi\PdfReader\PageBoundaries::ART_BOX);
    //                       $s = $pdfMerge->useTemplate($pageId, 10, 10, 200);
    //                   }
    //                }
    //                $file = uniqid().'.pdf';
    //                // $pdfMerge->Output('I', 'simple.pdf');
    //                   $pdf->stream('student_all_report.pdf'); 
    //                dd($pdfMerge->Output('I', 'profile_details.pdf'));
      
    //   return $pdf->stream('student_all_report.pdf');
    // }

    
  //   /**
  //    * Store a newly created resource in storage.
  //    *
  //    * @param  \Illuminate\Http\Request  $request
  //    * @return \Illuminate\Http\Response
  //    */
  //   public function store(Request $request)
  //   {   
       
  //      try {
          
  //       $rules=[
  //            'sibling_registration' => 'required',
  //            'sibling_registration_no' => 'required_if:sibling_registration,yes',
             
  //            'class' => 'required',
  //            "section" => 'required',
  //            'registration_no' => "required|unique:students|min:$request->reg_length|max:$request->reg_length",
  //            // "registration_no" => 'required|max:20|unique:students',
  //            "admission_no" => 'required|max:20|unique:students',
  //            "roll_no" => 'required|max:20',
  //            "date_of_admission" => 'required|date', 
  //            "date_of_activation" => 'required|date',
  //            "student_name" => 'required|max:199', 
  //            "date_of_birth" => 'required|date',
  //            "aadhaar_no" => "required|digits:12",
  //            "house_name" => "required", 
  //        ];
  //        if ($request->sibling_registration=='no') {
  //          $rules['mobileno']= 'required_if:sibling_registration,no|unique:students,mobileno';
  //          $rules['emailid'] ='required_if:sibling_registration,no|unique:students,emailid'; 
  //         }

  //        $validator = Validator::make($request->all(),$rules);
  //        if ($validator->fails()) {
  //            $errors = $validator->errors()->all();
  //            $response=array();
  //            $response["status"]=0;
  //            $response["msg"]=$errors[0];
  //            return response()->json($response);// response as json
  //        } 
  //        else {  
  //        $admin_id = Auth::guard('admin')->user()->id;
  //        $username = str_random('10');
  //        $char = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyz0123456789" ), 0, 6 );
  //        $student= new Student();
  //        if ($request->sibling_registration=='yes') {  
  //          $sibling= $student->getDetailByRegistrationNo($request->sibling_registration_no);
  //          if (is_null($sibling)) {
  //            $response=array();
  //            $response['status']=0;
  //            $response['msg']='Sibling Invalied Ragistration No';
  //            return $response;
  //          }
  //          $student->siblingId= $sibling->id;
  //        }
         
          
  //        $student->emailid= $request->emailid;  
  //        $student->mobileno= $request->mobileno; 
  //        $student->dpassword= $char;  
  //        $student->dpassword_encrypt= bcrypt($char); 
  //        $student->admin_id = $admin_id; 
  //        $student->class_id= $request->class;
  //        $student->section_id= $request->section;     
  //        $student->registration_no= $request->registration_no;     
  //        $student->admission_no= $request->admission_no;     
  //        $student->roll_no= $request->roll_no;     
  //        $student->adhar_no= $request->aadhaar_no;     
  //        $student->house_no= $request->house_name;     
  //        $student->date_of_admission= $request->date_of_admission == null ? $request->date_of_admission : date('Y-m-d',strtotime($request->date_of_admission));        
  //        $student->date_of_activation= $request->date_of_activation == null ? $request->date_of_activation : date('Y-m-d',strtotime($request->date_of_activation));
  //        $student->name= $request->student_name;
  //        $student->nick_name= $request->nick_name; 
         
  //        $student->dob= $request->date_of_birth == null ? $request->date_of_birth : date('Y-m-d',strtotime($request->date_of_birth));
  //        $student->gender_id= $request->gender;        
  //        $student->save();
  //        $response=array();
  //        $response['status']=1;
  //        $response['msg']='Created Successfully';   
  //        $response['student_id']=Crypt::encrypt($student->id);
  //        return $response; 
  //        } 
         
  //      } catch (Exception $e) {
  //        Log::error('Student store :'.$e);
  //      }
 
  //   }

  //   /**
  //    * Display the specified resource.
  //    *
  //    * @param  \App\StudentDetails  $studentDetails
  //    * @return \Illuminate\Http\Response
  //    */
    
  


  //   public function excelData(){

  //       $students = Student::orderBy('class_id','section_id')->where('student_status_id',1)->get();
  //       foreach($students as $student){
  //           $data[] =['id'=>$student->username,'name'=>$student->name,'class'=>$student->classes->name,'section'=>$student->sections->name,'date of admission'=>Carbon\Carbon::parse( $student->date_of_admission)->format('d-m-Y'),'father name'=>$student->father_name,'mother name'=>$student->mother_name,'date of birthday'=>Carbon\Carbon::parse( $student->dob)->format('d-m-Y')];
  //       }
  //       Excel::create('studentlist', function($excel) use ($data) {
  //           $excel->sheet('sheet', function($sheet) use ($data) {
  //               $sheet->fromArray($data);
  //           });
  //       })->export('xls');

  //   }
  //   public function image($image){
  //       $parent=ParentsInfo::find($image);

  //       $storagePath = storage_path('app/student/profile/'.$image);              
  //       $mimeType = mime_content_type($storagePath); 
  //       if( ! \File::exists($storagePath)){

  //           return view('error.home');
  //       }
  //       $headers = array(
  //           'Content-Type' => $mimeType,
  //           'Content-Disposition' => 'inline; '
  //       );
          
  //       if($image==null)
  //       {
  //            ob_end_clean(); // discards the contents of the topmost output buffer
  //           return Response::make(file_get_contents('profile-img/user.png'), 200, $headers);
  //       }
  //       else
  //       {   ob_end_clean(); // discards the contents of the topmost output buffer
  //           return Response::make(file_get_contents($storagePath), 200, $headers);

  //       }
  //       $img = Storage::disk('student')->get('profile/'.$image);
  //        return response($img)->header('Content-Type', 'image/jpeg');
       
  //   }
  //    public function imageWebUpdate(Request $request,$id){
      
  //     $name = date('YmdHis').".jpg";
  //     $file = file_put_contents( $name, file_get_contents('php://input') );

  //     if(!$file){
  //         return "ERROR: Failed to write data to ".$name.", check permissions\n";
  //     }
  //     else
  //     {
                    
  //         $path = $name;
  //         $type = pathinfo($path, PATHINFO_EXTENSION);
  //         $data = file_get_contents($path);
  //         $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data); 
  //         $data = base64_decode(base64_encode($data));
  //       $image_name= 'profile'.date('d-m-Y').time().'.jpg';       
  //       $path = Storage_path() . "/app/student/profile/" . $image_name;       
  //       file_put_contents($path, $data); 

  //         $student= Student::find($id) ;
  //         $student->picture = $image_name;
  //         $student->save();
  //         return response()->json(['success'=>'done']);
  //     }  


  //    }

         
    // public function camera(Request $request,$student_id)
    // {
    //   $studentId = Crypt::decrypt($student_id);
    //   $student = DB::select(DB::raw("select `id` from `students` where `id` = $studentId;")); 
    //   return view('admin.student.studentdetails.include.student_image_camera',compact('student'));  
        
    // }

  //    public function imageUpdate(Request $request, Student $student){
        
  //       $data = $request->image; 
  //       list($type, $data) = explode(';', $data);
  //       list(, $data)      = explode(',', $data);
  //       $data = base64_decode($data);
  //       $image_name= time().'.jpg';       
  //       $path = Storage_path() . "/app/student/profile/" . $image_name; 
  //       @mkdir(Storage_path() . "/app/student/profile/", 0755, true);     
  //       file_put_contents($path, $data); 
  //       $student->picture = $image_name;
  //       $student->save();
  //       return response()->json(['success'=>'done']);
    
  //   }
  //   public function studentImageUpload(Request $request)
  //   {
  //     $classes = MyFuncs::getClasses();
  //       $st= new Student();
  //       $students=$st->getAllStudents();    
  //       $sessions = array_pluck(AcademicYear::get(['id','name'])->toArray(),'name', 'id');
  //       $genders = array_pluck(Gender::get(['id','genders'])->toArray(),'genders', 'id');
  //       $religions = array_pluck(Religion::get(['id','name'])->toArray(),'name', 'id');
  //       $categories = array_pluck(Category::get(['id','name'])->toArray(),'name', 'id');
  //       $default = StudentDefaultValue::find(1); 
  //       $menuPermission= MyFuncs::menuPermission(); 
  //       return view('admin.student.studentdetails.image_upload',compact('classes','sessions','default','genders','religions','categories','menuPermission','students'));
  //   }  
  //   public function studentImageUploadStore(Request $request,$id)
  //   { 
  //     $id =Crypt::decrypt($id);
          
  //        $rules=[
  //          "file" => "required|mimes:jpg,jpeg,png|max:10000",
            
  //        ];

  //        $validator = Validator::make($request->all(),$rules);
  //        if ($validator->fails()) {
  //            $errors = $validator->errors()->all();
  //            $response=array();
  //            $response["status"]=0;
  //            $response["msg"]=$errors[0];
  //            return response()->json($response);// response as json
  //        } 
  //       if ($request->hasFile('file')) { 

  //               $file=$request->file; 

  //               $filename=$file->hashName();
  //               $destinationPath = storage_path('app/student/profile/');
  //               $thumb_img = Image::make($file->getRealPath())->resize(220, 300);
  //               if (!file_exists($destinationPath)) {
  //                          mkdir($destinationPath, 666, true);
  //                      }
                
  //               $thumb_img->save($destinationPath.'/'.$filename,100);

  //               // $file->storeAs('student/profile/',$filename);
  //               $student=Student::find($id);
  //               $student->picture=$filename; 
  //               $student->picture_status=1; 
  //               $student->save();
  //               $response=array();
  //                $response["status"]=1;
  //                $response["msg"]="Upload Successfully";
  //                return $response;
  //        }  
  //   }
  //   public function studentDocumentVerify(Request $request)
  //   {
  //      return view('admin.student.studentdetails.documentverify.index');   
  //   }
  //   public function studentDocumentVerifyList(Student $student,$conditionId)
  //   {
  //       $st= new Student();
  //       $students=$st->getAllStudents(); 
  //       $menuPermision= MyFuncs::menuPermission();
  //       return view('admin.student.studentdetails.documentverify.student_list',compact('students','menuPermision'));    
  //   }
  //   public function studentDocumentVerifyView(Request $request,$student_id)
  //   {
  //      $documents=Document::where('student_id',$student_id)->get();
  //      return view('admin.student.studentdetails.documentverify.view',compact('documents'));   
  //   }
  //   public function studentDocumentVerifyPrint($id)
  //   {
  //     try {
  //       $documents=Document::find($id);
  //       $storagePath = storage_path('/app/'.$documents->document_url);
  //       $mimeType = mime_content_type($storagePath);
  //       if( ! \File::exists($storagePath)){
  //         return 'file not found';
  //       }
  //       $headers = array(
  //         'Content-Type' => $mimeType,
  //         'Content-Disposition' => 'inline; filename="'.$documents->name.'"'
  //       );
  //       return Response::make(file_get_contents($storagePath), 200, $headers);
  //     } catch (Exception $e) {
  //       Log::error('StudentController-studentDocumentVerifyPrint: '.$e->getMessage()); 
  //       return view('error.home');
  //     }
  //   }

  //   public function edit(Student $student)
  //   {   $houses=House::orderBy('id','ASC')->get();      
  //      $classes = MyFuncs::getClasses();    
  //      $sessions = array_pluck(AcademicYear::get(['id','name'])->toArray(),'nameP', 'id');
  //      $genders = array_pluck(Gender::get(['id','genders'])->toArray(),'genders', 'id');
  //      $religions = array_pluck(Religion::get(['id','name'])->toArray(),'name', 'id');
  //      $categories = array_pluck(Category::get(['id','name'])->toArray(),'name', 'id');
  //      $default = StudentDefaultValue::find(1); 
          
  //      return view('admin.student.studentdetails.edit',compact('student','classes','sessions','default','genders','religions','categories','houses'));
  //   }

  //   /**
  //    * Update the specified resource in storage.
  //    *
  //    * @param  \Illuminate\Http\Request  $request
  //    * @param  \App\StudentDetails  $studentDetails
  //    * @return \Illuminate\Http\Response
  //    */
  //   public function totalfeeupdate(Request $request, Student $student)
  //   {
  //       $this->validate($request,[
  //           'center' => 'required|numeric',

  //           'session' => 'required|numeric',
  //           'class' => 'required|numeric',
  //           "section" => 'required|numeric',           
  //           "student_name" => 'required|max:199',            
            
  //           'payment_type' => 'required|numeric'
      
  //       ]);
  //       $transport_fee = ($request->driver_id)?$request->transport_fees:0;
  //       $transport_fee2 = (!$request->driver_id)?$request->transport_fees:0;
        
        

  //       $student->center_id= $request->center; 
  //       $student->class_id= $request->class;
  //       $student->section_id= $request->section;
  //       $student->totalFee= $request->total_fee-$transport_fee2;
  //       $student->firsttime_fee = ($request->admission_fees+$request->registration_fees+$request->annual_charges+$request->caution_money) ;
  //       $student->installment_fee = ($request->activity_charges+$request->smart_class_fees+$request->sms_charges+$request->tution_fees+$transport_fee);
        
  //       $student->admission_fee =$request->admission_fees ;
  //       $student->registration_fee =$request->registration_fees ;
  //       $student->annual_charge =$request->annual_charges ;
  //       $student->caution_money =$request->caution_money ;
        
  //       $student->activity_charge =$request->activity_charges ;
  //       $student->smart_class_fee =$request->smart_class_fees ;
  //       $student->sms_charge =$request->sms_charges;
  //       $student->tution_fee = $request->tution_fees;
  //       $student->transport_fee= $transport_fee;
        
        
  //       $student->name= $request->student_name;
        
  //       $student->discount_type_id= $request->discount_type;
  //       $student->payment_type_id= $request->payment_type;
       
        
  //       if($student->save()){ 
  //           return redirect()->route('admin.student.view',$student->id)->with(['class'=>'success','message'=>'student fee update success ...']);
  //       }
  //       return redirect()->back()->with(['class'=>'error','message'=>'Whoops ! Look like somthing went wrong ..']);
  //   }

  //   public function update(Request $request, Student $student)
  //   { 
  //       $rules=[
  //           'class' => 'required|numeric|max:20',
  //           "section" => 'required|numeric|max:20', 
  //           "date_of_admission" => 'required|date', 
  //           "date_of_activation" => 'required|date',
  //           "student_name" => 'required|max:199', 
  //           "date_of_birth" => 'required|max:199', 
  //           "aadhaar_no" => "required|digits:12",
  //           "house_name" => "required", 
  //         ];

  //        $validator = Validator::make($request->all(),$rules);
  //        if ($validator->fails()) {
  //            $errors = $validator->errors()->all();
  //            $response=array();
  //            $response["status"]=0;
  //            $response["msg"]=$errors[0];
  //            return response()->json($response);// response as json
  //        }
         
         
  //       $admin_id = Auth::guard('admin')->user()->id; 
  //       $student->admin_id = $admin_id; 
  //       $student->class_id= $request->class;
  //       $student->section_id= $request->section; 
  //       $student->adhar_no= $request->aadhaar_no;     
  //       $student->house_no= $request->house_name;     
  //       $student->date_of_admission= $request->date_of_admission == null ? $request->date_of_admission : date('Y-m-d',strtotime($request->date_of_admission));
  //       $student->date_of_leaving= $request->date_of_leaving == null ? $request->date_of_leaving : date('Y-m-d',strtotime($request->date_of_leaving)); 
  //       $student->date_of_activation= $request->date_of_activation == null ? $request->date_of_activation : date('Y-m-d',strtotime($request->date_of_activation));
  //       $student->name= $request->student_name;
  //       $student->nick_name= $request->nick_name; 
  //       $student->dob= $request->date_of_birth == null ? $request->date_of_birth : date('Y-m-d',strtotime($request->date_of_birth));
  //       $student->gender_id= $request->gender; 
  //        $student->save();           
  //          $response= array();
  //          $response['status']= 1;
  //          $response['msg']= 'Student Update Successfully';
  //       return $response; 
        
       
  //   }

  //   public function viewUpdate(Request $request, Student $student)
  //   {  
  //       // $reg_length=$request->reg_length;
  //      $userId=Auth::guard('admin')->user();
  //      if ($userId->role_id!=12) { 
  //           $rules=[ 
               
  //               "student_name" => 'required|max:199',
  //               "nick_name" => 'max:30|nullable', 
  //               "class" => 'required', 
  //               "section" => 'required',
  //               'registration_no' => "required|max:$request->reg_length|min:$request->reg_length|unique:students,registration_no,".$student->id,

  //               // "registration_no" => 'required|max:20|unique:students,registration_no,'.$student->id, 
  //               "roll_no" => 'required|max:20', 
  //               "admission_no" => 'required|max:10|unique:students,admission_no,'.$student->id,
  //                "date_of_admission" => 'required|date', 
  //               "date_of_activation" => 'required|date', 
  //               "date_of_birth" => 'required|max:199', 
  //               "aadhaar_no" => 'required|digits:12|unique:students,adhar_no,'.$student->id, 
  //               "gender" => "required", 
  //               "house" => "required", 
  //             ]; 
  //            $validator = Validator::make($request->all(),$rules);
  //            if ($validator->fails()) {
  //                $errors = $validator->errors()->all();
  //                $response=array();
  //                $response["status"]=0;
  //                $response["msg"]=$errors[0];
  //                return response()->json($response);// response as json
  //            } 
  //           $admin_id = Auth::guard('admin')->user()->id; 
  //           $student->admin_id = $admin_id; 
  //           $student->class_id= $request->class;     
  //           $student->section_id= $request->section;     
  //           $student->registration_no= $request->registration_no;     
  //           $student->roll_no= $request->roll_no;     
  //           $student->admission_no= $request->admission_no;     
  //           $student->date_of_admission= $request->date_of_admission == null ? $request->date_of_admission : date('Y-m-d',strtotime($request->date_of_admission));
  //           $student->date_of_leaving= $request->date_of_leaving == null ? $request->date_of_leaving : date('Y-m-d',strtotime($request->date_of_leaving)); 
  //           $student->date_of_activation= $request->date_of_activation == null ? $request->date_of_activation : date('Y-m-d',strtotime($request->date_of_activation));
  //           $student->name= $request->student_name;
  //          $student->nick_name= $request->nick_name; 
  //           $student->adhar_no= $request->aadhaar_no; 
  //           $student->house_no= $request->house; 
  //           $student->gender_id= $request->gender; 
  //            $student->dob= $request->date_of_birth == null ? $request->date_of_birth : date('Y-m-d',strtotime($request->date_of_birth)); 
  //            $student->save();           
  //              $response= array();
  //              $response['status']= 1;
  //              $response['msg']= 'Student Update Successfully';
  //           return $response; 
  //        }else{  
  //           $rules=[ 
  //               "student_name" => 'required|max:50',
  //               "nick_name" => 'max:20|nullable', 
  //               "class" => 'required', 
  //               "date_of_birth" => 'required|max:199', 
  //               "aadhaar_no" => 'required|digits:12|unique:students,adhar_no,'.$student->id,
  //                "gender" => "required",  
  //             ]; 
  //            $validator = Validator::make($request->all(),$rules);
  //            if ($validator->fails()) {
  //                $errors = $validator->errors()->all();
  //                $response=array();
  //                $response["status"]=0;
  //                $response["msg"]=$errors[0];
  //                return response()->json($response);// response as json
  //            } 
  //           $admin_id = Auth::guard('admin')->user()->id; 
  //           $student->admin_id = $admin_id; 
  //           $student->class_id= $request->class; 
  //           $student->name= $request->student_name;
  //           $student->nick_name= $request->nick_name; 
  //           $student->adhar_no= $request->aadhaar_no; 
  //           $student->dob= $request->date_of_birth == null ? $request->date_of_birth : date('Y-m-d',strtotime($request->date_of_birth));
  //            $student->gender_id= $request->gender;  
  //           $student->save();           
  //              $response= array();
  //              $response['status']= 1;
  //              $response['msg']= 'Student Update Successfully';
  //              return $response; 
  //        }
       
  //   }

  //   public function profileupdate(Request $request, Student $student)
  //   {
  //       $this->validate($request,[
  //           'center' => 'required|numeric',

  //           'session' => 'required|numeric',
  //           'class' => 'required|numeric',
  //           "section" => 'required|numeric',
  //           "date_of_admission" => 'required|date',
  //           "student_name" => 'required|max:199',
  //           "father_name" => 'required|max:199',
  //           "mother_name" => 'required|max:199',
  //           "date_of_birth" => 'required|max:199',
  //           "religion" => "required|max:199",
  //           "category" => "required|max:199",
  //           "address" => 'required|max:1000',
  //           "state" => "required|max:199",
  //           "city" => "required|max:199",
  //           "pincode" => 'required|numeric',
  //           "mobile_one" => 'nullable|numeric',
  //           "mobile_two" => 'nullable|numeric',
  //           "mobile_sms" => 'required|numeric',
            
      
  //       ]);
       
  //       $student->center_id= $request->center; 
  //       $student->class_id= $request->class;
  //       $student->section_id= $request->section;
  //       $student->date_of_admission= date('Y-m-d',strtotime($request->date_of_admission));
  //       $student->name= $request->student_name;
  //       $student->father_name= $request->father_name;
  //       $student->mother_name= $request->mother_name;
  //       $student->dob= date('Y-m-d',strtotime($request->date_of_birth));
  //       $student->religion= $request->religion;
  //       $student->category= $request->category;
  //       $student->address= $request->address;
  //       $student->state= $request->state;
  //       $student->city= $request->city;
  //       $student->pincode= $request->pincode;
  //       $student->mobile_one= $request->mobile_one;
  //       $student->mobile_two= $request->mobile_two;
  //       $student->mobile_sms= $request->mobile_sms;
     
  //       if($student->save()){ 
  //           return redirect()->route('admin.student.view',$student->id)->with(['class'=>'success','message'=>'student profile update success ...']);
  //       }
  //       return redirect()->back()->with(['class'=>'error','message'=>'Whoops ! Look like somthing went wrong ..']);
  //   }
  //   public function importview() {
         
  //       $classes = MyFuncs::getClasses();    
  //       $sessions = array_pluck(AcademicYear::get(['id','name'])->toArray(),'name', 'id');
  //       $genders = array_pluck(Gender::get(['id','genders'])->toArray(),'genders', 'id');
  //       $religions = array_pluck(Religion::get(['id','name'])->toArray(),'name', 'id');
  //       $categories = array_pluck(Category::get(['id','name'])->toArray(),'name', 'id');
  //       $default = StudentDefaultValue::find(1);  
  //       return view('admin.student.studentdetails.import',compact('classes','sessions','default','genders','religions','categories'));
  //   }
  //   public function importStudent(Request $request){  
  //       $rules=[
  //       'class' => 'required',
  //       'section' => 'required',                 
  //       'excel_file' => 'required|max:10000',
  //       ];
  //       $validator = Validator::make($request->all(),$rules);
  //       if($validator->fails()){
  //           $errors = $validator->errors()->all();
  //           $response=array();
  //           $response["status"]=0;
  //           $response["msg"]=$errors[0];
  //           return response()->json($response);// response as json
  //       }
  //       $file = Input::file('excel_file'); 
  //       $file_name = $file->getClientOriginalName();
  //       $file->move('files/',$file_name);
  //       $results = Excel::load('files/'.$file_name,function($reader){
  //           $reader->all();
  //       })->get();  
  //      foreach ($results as $key => $value) {   dd($value[0]->registration_no);
  //       $admin_id = Auth::guard('admin')->user()->id;
  //       $username = str_random('10');
  //       $char = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyz0123456789" ), 0, 6 );
  //       $student= Student::firstOrNew(['registration_no' => $value->registration_no]);
  //       $student->username= $username;    
  //       $student->password = bcrypt($char);
  //       $student->tem_pass = $char; 
  //       $student->admin_id = $admin_id; 
  //       $student->class_id= $request->class;
  //       $student->section_id= $request->section;     
  //       $student->registration_no = $value->registration_no;     
  //       $student->admission_no= $value->admission_no;     
  //       $student->roll_no= $value->roll_no;     
  //       $student->date_of_admission= $value->date_of_admission == null ? $value->date_of_admission : date('Y-m-d',strtotime($value->date_of_admission));
  //       $student->date_of_leaving= $value->date_of_leaving == null ? $value->date_of_leaving : date('Y-m-d',strtotime($value->date_of_leaving)); 
  //       $student->date_of_activation= $value->date_of_activation == null ? $value->date_of_activation : date('Y-m-d',strtotime($value->date_of_activation));
  //       $student->name= $value->name;
  //       $student->nick_name= $value->nick_name; 
  //       $student->dob= $value->dob == null ? $value->dob : date('Y-m-d',strtotime($value->dob));
  //       $student->gender_id= $value->gender_id;  
  //      } 
  //      $response=array();
  //      $response['status']=1;
  //      $response['msg']='Excel Import Data successfully';
  //       return $response; 
  //      }
    
  //   public function destroy(Student $student)
  //   {  
       
  //       if ($student->delete()) { 
  //       $response=array();
  //       $response['status']=1;
  //       $response['msg']='Delete successfully';
  //       return $response;
           
  //       }
  //       return redirect()->back()->with(['class'=>'error','message'=>'Whoops ! Look like somthing went wrong ..']);
  //   }
  //   //
  //   public function feeReceipt(StudentFee $studentFee)
  //   {
  //       return view('admin.student.studentdetails.feeReceipt',compact('studentFee'));
  //   }

  //   //birthday
  //   Public function birthday(){
         
  //    $st =new Student();
  //    $students=$st->getStudentAllDetailsTodayBirthday();
  //      return view('admin.student.birthday.list',compact('students'));                     
  //   }

  //     //birthday
  //   Public function birthdaySearch(Request $request){
         
  //    $from_month =date('m',strtotime($request->from_date));
  //    $to_month =date('m',strtotime($request->to_date));
  //    $from_day =date('d',strtotime($request->from_date));
  //    $to_day =date('d',strtotime($request->to_date));

  //    $st =new Student();
  //    $students=$st->getStudentAllDetailsBirthday($from_month,$to_month,$from_day,$to_day); 
      
  //   $response= array();                       
  //   $response['status']= 1;                       
  //   $response['data']=view('admin.student.birthday.search_result',compact('students'))->render();
  //   return $response;

  //   }

  //   //birthday print one
  //   public function birthdayPrint($id){
          
  //        $reportTemplate=ReportTemplate::where('reports_type_id',7)->where('status',1)->first();
  //        if (empty($reportTemplate)) {
  //            $page='T1_Student_Birthday';
  //         }else{
  //           $page=$reportTemplate->name;
  //         } 
  //        $viewUrl = 'admin.student.birthday.'.$page;
  //        $student = Student::find($id);
  //        $students = Student::where('id',$id)->get();
  //        $customPaper = array(0,0,655.00,530.80);   
  //        $pdf = PDF::setOptions([
  //           'logOutputFile' => storage_path('logs/log.htm'),
  //           'tempDir' => storage_path('logs/')
  //       ])
  //       ->loadView($viewUrl,compact('students','template'))->setPaper($customPaper, 'landscape');;  
  //       return $pdf->stream($student->registration_no.'_birthday_card.pdf');
  //   }

  //   //birthday print all
  //   public function birthdayPrintAll(Request $request){
  //         $user_id=Auth::guard('admin')->user()->id;
  //    switch ($request->input('action')) {

  //       case 'generate':
  //          $this->validate($request,[ 
  //           'student' => 'required', 
  //       ]);
  //       $message='';   
  //       $students = Student::whereIn('id',$request->student)->get();
  //       $reportTemplate=ReportTemplate::where('reports_type_id',7)->where('status',1)->first();
  //        if (empty($reportTemplate)) {
  //            $page='T1_Student_Birthday';
  //         }else{
  //           $page=$reportTemplate->name;
  //         } 
  //        $customPaper = array(0,0,655.00,530.80);   
  //       $pdf = PDF::setOptions([
  //           'logOutputFile' => storage_path('logs/log.htm'),
  //           'tempDir' => storage_path('logs/')
  //       ])->loadView('admin.student.birthday.'.$page, compact('students','message'))->setPaper($customPaper, 'landscape'); 
       
  //       return $pdf->stream('_birthday_card.pdf');
  //           break;


  //       case 'send_sms':
           
  //       if ($request->student==null) {
  //           $response=array();
  //           $response=['status'=>0,'msg'=>'Student Not Selected'];
  //           return response()->json($response);
  //        }
          
  //        $st=new Student();
  //        $studentBirthdaySendSms=$st->getStudentDetailsByArrId($request->student); 
  //        foreach ($studentBirthdaySendSms as  $value) { 
  //        $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->birthday_message_id; 
  //        $smsTemplate = SmsTemplate::where('id',$messageId)->first()->message;

  //       $findword = ["#SN#", "#FN#", "#MN#"];
  //       $replaceword   = [$value->name, $value->parents[0]->parentInfo->name, $value->parents[1]->parentInfo->name];

  //        $message = str_replace($findword, $replaceword, $smsTemplate);
  //         event(new SmsEvent($value->addressDetails->address->primary_mobile,$message)); 
  //        }
  //        $response=['status'=>1,'msg'=>'Message Sent successfully'];
  //           return response()->json($response);
  //           break;

  //       case 'send_email':
  //          $st=new Student();
  //        $students=$st->getStudentDetailsByArrId($request->student);
  //        foreach ($students as $student) {
           
  //        $StudentDefaultValue=StudentDefaultValue::where('user_id',$user_id)->first()->birthday_email_id;
  //        $smsTemplate = EmailTemplate::where('id',$StudentDefaultValue)->first()->message;
  //        $findword = ["#SN#", "#FN#", "#MN#"];
  //        $replaceword   = [$student->name]; 
  //        $message = str_replace($findword, $replaceword, $smsTemplate);
  //        // $documentUrl = Storage_path() . '/app/student/birthday/';
  //        // @mkdir($documentUrl, 0755, true);
  //        // $pdf = PDF::loadView('admin.student.birthday.birthday_card',compact('student','message','id'))->save($documentUrl.'/'.$student->registration_no.'_birthday_card.pdf'); 
  //        // $url =$documentUrl.$student->registration_no.'_birthday_card.pdf';
  //           $message ='test';         
  //           $emailto = $student->addressDetails->address->primary_email;         
  //           $subject = 'Happy Birthday'; 
  //           $up_u=array(); 
  //           $up_u['medicalInfo']=$message;
  //           $up_u['subject']=$subject;
         
  //       $mailHelper =new MailHelper(); 
  //       $mailHelper->mailsend('emails.message',$up_u,'No-Reply',$subject,$emailto,'noreply@esgekool.com',5);
  //        }
  //     return  redirect()->back()->with(['message'=>'Send  Successfully','class'=>'success']);
  //           break;
  //   }
         
        
  //   }
  //   public function birthdayDashboard($value='')
  //   {
  //     $st =new Student();
  //    $studentDOBs=$st->getStudentAllDetailsTodayBirthday();
        
  //        return view('admin.student.birthday.birthday',compact('studentDOBs'));
  //   } 
  //   public function birthdayDashboardUpcoming($value='')
  //   {   $date = date('Y-m-d'); 
  //       $tommowDate = date('Y-m-d',strtotime($date ."+1 days"));   
  //        $nextWeek=date('Y-m-d',strtotime($tommowDate ."+7 days"));  
  //        $data = array();
  //           for ($i=1; $i <7 ; $i++) { 
  //              $students = Student::where('student_status_id',1)->whereMonth('dob',date('m',strtotime($date ." +1 days")))->whereDay('dob',date('d',strtotime($date .'+'.$i."days")))->get(); 
  //              if (!empty($students)) {
  //                foreach ($students as $key => $student) {
  //                $data[]= $student->id;
  //               }  
  //              }
                
  //           }
  //           $st = new Student();
  //           $studentDOBs=$st->getStudentsByArrId($data);
        
         
  //        return view('admin.student.birthday.birthday',compact('studentDOBs'));
  //   }
  //   public function birthdaySmsSend($student_id,$id){
  //        $user_id=Auth::guard('admin')->user()->id;
  //       if ($id==1) {
  //        $st = new Student();
  //        $student = $st->getStudentDetailsById($student_id);
  //        $StudentDefaultValue=StudentDefaultValue::where('user_id',$user_id)->first()->birthday_message_id;
  //        $smsTemplate = SmsTemplate::where('id',$StudentDefaultValue)->first()->message;
  //        $findword = ["#SN#", "#FN#", "#MN#"];
  //        $replaceword   = [$student->name, $student->parents[0]->parentInfo->name, $student->parents[1]->parentInfo->name]; 
  //        $message = str_replace($findword, $replaceword, $smsTemplate);
  //       event(new SmsEvent($student->addressDetails->address->primary_mobile,$message)); 
       
            
  //       }
  //       elseif ($id==2) {
  //         $st=new Student();
  //        $students=$st->getStudentDetailsById($student_id);
  //        $StudentDefaultValue=StudentDefaultValue::where('user_id',$user_id)->first()->birthday_email_id;
  //        $smsTemplate = EmailTemplate::where('id',$StudentDefaultValue)->first()->message;
  //        $findword = ["#SN#", "#FN#", "#MN#"];
  //        $replaceword   = [$students->name, $students->parents[0]->parentInfo->name, $students->parents[1]->parentInfo->name]; 
  //        $message = str_replace($findword, $replaceword, $smsTemplate);
  //        $documentUrl = Storage_path() . '/app/student/birthday/';
  //        @mkdir($documentUrl, 0755, true);
  //        $pdf = PDF::loadView('admin.student.birthday.birthday_card',compact('students','message','id'))->save($documentUrl.'/'.$students->registration_no.'_birthday_card.pdf'); 
  //        $url =$documentUrl.$students->registration_no.'_birthday_card.pdf';
  //           $message ='test';         
  //           $emailto = $students->addressDetails->address->primary_email;         
  //           $subject = 'Happy Birthday'; 
  //           $up_u=array(); 
  //           $up_u['medicalInfo']=$message;
  //           $up_u['subject']=$subject;
         
  //       $mailHelper =new MailHelper(); 
  //       $mailHelper->mailsendwithattachment('emails.message',$up_u,'No-Reply',$subject,$emailto,'noreply@esgekool.com',5,$url);
  //     return  redirect()->back()->with(['message'=>'Send  Successfully','class'=>'success']);  
  //       }
  //   }

  //    public function resetAdmission(Request $request)
  //   {
        
  //       $classes = MyFuncs::getClasses();  

  //       return view('admin.student.reset.list',compact('classes'));
  //   }
  //   // newAdmissionStudentShow
  //   public function resetAdmissionStudentShow(Request $request)
  //   {  

  //      $students = Student::where('admission_no',$request->admission_no) 
  //                                  ->where('student_status_id',1)
  //                                  ->get();
          
  //       $response= array();                       
  //       $response['status']= 1;                       
  //       $response['data']=view('admin.student.reset.student_list',compact('students'))->render();
  //       return $response;
         
  //   }
  //   public function resetRollNoshow(Request $request)
  //   {  if ($request->select_format==1) {
  //        $students = Student::where('class_id',$request->class) 
  //                                    ->where('section_id',$request->section)
  //                                    ->where('student_status_id',1)
  //                                    ->orderBy('name','asc')
  //                                    ->get();
  //       }
  //       if ($request->select_format==2) {
  //                $students = Student::where('class_id',$request->class) 
  //                                            ->where('section_id',$request->section)
  //                                            ->where('student_status_id',1)
  //                                            ->orderBy('admission_no','asc')
  //                                            ->get();
  //           }
  //       if ($request->select_format==3) {
  //                $students = Student::where('class_id',$request->class) 
  //                                            ->where('section_id',$request->section)
  //                                            ->where('student_status_id',1)
  //                                            ->orderBy('roll_no','asc')
  //                                            ->get();
  //           }    
       
          
  //       $response= array();                       
  //       $response['status']= 1;                       
  //       $response['data']=view('admin.student.reset.student_list_show',compact('students'))->render();
  //       return $response;
         
  //   }

  // public function resetRollNoshowUpdate(Request $request) 
  // {    

  //   $rules=[

  //     'admission_no' => 'required', 
  //     ];

  //    $validator = Validator::make($request->all(),$rules);
  //    if ($validator->fails()) {
  //        $errors = $validator->errors()->all();
  //        $response=array();
  //        $response["status"]=0;
  //        $response["msg"]=$errors[0];
  //        return response()->json($response);// response as json
  //    }
         
  //  foreach ($request->admission_no as $student_id => $admission_no) {
           
  //         $student=Student::find($student_id)->pluck('admission_no')->toArray();
  //        if (in_array($admission_no,$student)) {                   
  //                 $response=['status'=>0,'msg'=>'Admission No Already Teken'];
  //                 return response()->json($response);
  //             }else{

  //              $student =Student::find($student_id);
  //              $student->admission_no =$admission_no;
  //              $student->save();
  //             }  
  //           }  
  //      $response= array();                       
  //      $response['status']= 1; 
  //      $response['msg']= 'Update Adminssion No Successfully '; 

  //      return  $response;

  // }
  // // resetRoollno
  // public function resetRollNoUpdate(Request $request) 
  // {       
  //   $rules=[

  //     'roll_no' => 'required', 
       
  //     ];

  //    $validator = Validator::make($request->all(),$rules);
  //    if ($validator->fails()) {
  //        $errors = $validator->errors()->all();
  //        $response=array();
  //        $response["status"]=0;
  //        $response["msg"]=$errors[0];
  //        return response()->json($response);// response as json
  //    }

  //    foreach ($request->roll_no as $student_id => $roll_no) {
  //      $student =Student::find($student_id);
  //      $student->roll_no =$roll_no;
  //      $student->save();
  //     }   
   
      
  //      $response= array();                       
  //      $response['status']= 1; 
  //      $response['msg']= 'Update roll Number Successfully '; 

  //      return  $response;

  // }


  //   public function resetRollNo(Request $request)
  //   {
  //       $students = Student::where('student_status_id',1)->get();
  //       $classes = MyFuncs::getClasses();  
    
  //       return view('admin.student.reset.resetRollNo',compact('students','classes'));
  //   }

  //   public function newAdmission(Request $request)
  //   {
  //       $students = Student::where('student_status_id',2)->get();     
  //   return view('admin.student.newadmission.list',compact('students'));
  //   }

  //   public function newAdmissionStatusChange($id)
  //   {
  //       $student = Student::find(Crypt::decrypt($id));     
  //       $student->student_status_id =1;
  //       $student->save();
  //   return redirect()->back()->with(['class'=>'success','message'=>'Final Addmission Successfully']);
  //   }
  //   public function studentRequestUpdate($value='')
  //   {
  //       $studentRequests=RequestUpdate::orderBy('id','DESC')->get();
  //       return view('admin.student.requestUpdation.request_list',compact('studentRequests')); 
  //   }

  //   // public function studentSearchByRegisterNo(Request $request,$type)
  //   // {  
  //   //   //return $type;
  //   //     if(trim($request->id) == ''){
  //   //       return '<p style="color:red">Plz Enter Sibling Registration No.</p>';  
  //   //     }

  //   //     $st =new Student();
  //   //     $std= $st->getDetailByRegistrationNo($request->id);
  //   //     if ($std==null) {
  //   //        return '<p style="color:red">Sibling Registration No Invalid</p>';
  //   //     }
  //   //     $student= $st->getStudentDetailsById($std->id);
  //   //     return view('admin.student.studentdetails.details',compact('student'))->render();
  //   // }



  
  
  
  //   public function registrationList()
  //   {   
  //      return view('admin.student.studentdetails.newregistration.student_list'); 
  //   }
  //   public function registrationListFilter(Request $request,$id)
  //   {   
  //      $userId=Auth::guard('admin')->user();
  //      $conditionId=$id;
  //      $studentUserMaps=StudentUserMap::where('userId',$userId->id)->pluck('student_id')->toArray();
  //      if ($id==1) {
  //        $students=Student::whereIn('id',$studentUserMaps)->where('student_status_id',8)->get(); 
  //      }elseif ($id==2) {
  //        $students=Student::whereIn('id',$studentUserMaps)->where('student_status_id',1)->get(); 
  //      }elseif ($id==3) { 
  //        $students=Student::whereIn('id',$studentUserMaps)->where('student_status_id','>',8)->get(); 
  //      }
  //      return view('admin.student.studentdetails.newregistration.student_list_filter',compact('students','conditionId')); 
  //   }

    
  //   public function registrationFinalSubmit($student_id)
  //   {
  //      $st =new Student();
  //          $student=$st->getStudentDetailsById($student_id); 
  //          //sibling details//
  //         $studentSibling=SiblingGroup::
  //                                       where('student_id',$student_id)
  //                                       ->count();
  //        if ($studentSibling!=0) {
  //          $studentSiblingId=SiblingGroup::
  //                                          where('student_id',$student_id)
  //                                          ->first();
  //        $studentSiblingInfos=SiblingGroup::
  //                                           where('group',$studentSiblingId->group)
  //                                          ->where('student_id','!=',$student_id)
  //                                           ->get();
  //        }else{
  //           $studentSiblingInfos=array();
  //        } 
  //        //end sibling detaild///
  //        //application barcode ///
  //                    $admissionApplication=AdmissionApplication::where('student_id',$student->id)->first();
  //                    if ($student->registration_no==null) {
  //                    $value=$admissionApplication->id;     
  //                    $barcode = new BarcodeGenerator();
  //                    $barcode->setText($value);
  //                    $barcode->setType(BarcodeGenerator::Code128);
  //                    $barcode->setScale(2);
  //                    $barcode->setThickness(25);
  //                    $barcode->setFontSize(10);
  //                    $code = $barcode->generate();
  //                    $data = base64_decode($code);
  //                    $image_name= $value.'.png';     
  //                    $path = Storage_path() . "/app/student/barcode/application/" . $image_name;
  //                    @mkdir(Storage_path() . "/app/student/barcode/application/", 0755, true); 
  //                    file_put_contents($path, $data); 
  //                    }else{
  //                    $value=$student->registration_no;     
  //                    $barcode = new BarcodeGenerator();
  //                    $barcode->setText($value);
  //                    $barcode->setType(BarcodeGenerator::Code128);
  //                    $barcode->setScale(2);
  //                    $barcode->setThickness(25);
  //                    $barcode->setFontSize(10);
  //                    $code = $barcode->generate();
  //                    $data = base64_decode($code);
  //                    $image_name= $value.'.png';     
  //                    $path = Storage_path() . "/app/student/barcode/";
  //                    $paths = Storage_path() . "/app/student/barcode/" . $image_name;
  //                    @mkdir($path, 0755, true); 
  //                    file_put_contents($paths, $data);
  //                    }
  //          //application barcode end///          
  //         $studentMedicalInfos = StudentMedicalInfo::where('student_id',$student_id)->get(); 
  //         $documents = Document::where('student_id',$student_id)->get(); 
  //         $studentSubjects=StudentSubject::where('student_id',$student_id)->get();
  //         $admissionApplication=AdmissionApplication::where('student_id',$student_id)->first(); 
  //         $profilePdfUrl = Storage_path() . '/app/student/profile/newstudent/';
  //         @mkdir($profilePdfUrl, 0755, true); 
  //         $pdf = PDF::setOptions([
  //           'logOutputFile' => storage_path('logs/log.htm'),
  //           'tempDir' => storage_path('logs/')
  //       ])
  //       ->loadView('admin.student.studentdetails.pdf_generate',compact('student','fatherDetail','motherDetail','documents','studentMedicalInfos','studentSiblingInfos','studentSubjects','address','data'))->save($profilePdfUrl.'/'.$admissionApplication->id.'_student_all_details.pdf'); 
        
  //        $admissionApplication->status=2;
  //        $admissionApplication->profile_path='student/profile/newstudent/'.$admissionApplication->id.'_student_all_details.pdf';
  //        $admissionApplication->save();
  //       return redirect()->back()->with(['message'=>'Final Submit successfully','class'=>'success']);
      
  //   }
  //   public function registrationProfileView($student_id)
  //   {   $student_id=Crypt::decrypt($student_id);
  //       $admissionApplication=AdmissionApplication::where('student_id',$student_id)->first();
  //       $student=Student::find($student_id);
  //       $profilePdfUrl = Storage_path() . '/app/student/profile/profileDetails/'.$student->registration_no.'_student_all_details.pdf';
  //       $documents=Document::where('student_id',$student_id)->get(); 
  //       $docs=$documents; 
  //                  $pdfMerge = new Fpdi();
  //                  $dt =array(); 
  //                  $base_path =Storage_path() . "/app/".$admissionApplication->profile_path;
  //                   $dt['student']=$base_path; 
  //                  foreach ($docs as $key=>$document) {
                    
  //                    $dt[$key]=Storage_path('app/'.$document->document_url);  
                  
  //                 }
                
  //                  $files =$dt;
  //                  foreach ($files as $file) {
  //                     $pageCount =$pdfMerge->setSourceFile($file);
  //                     for ($pageNo=1; $pageNo <=$pageCount ; $pageNo++) { 
  //                         $pdfMerge->AddPage();
  //                         $pageId = $pdfMerge->importPage($pageNo, '/MediaBox');
  //                         //$pageId = $pdfMerge->importPage($pageNo, Fpdi\PdfReader\PageBoundaries::ART_BOX);
  //                         $s = $pdfMerge->useTemplate($pageId, 10, 10, 200);
  //                     }
  //                  }
  //                  $file = uniqid().'.pdf';
  //                  // $pdfMerge->Output('I', 'simple.pdf');
  //                     // $pdf->stream('student_all_report.pdf'); 
  //                  dd($pdfMerge->Output('I', 'simple.pdf'));
      
  //     // return $pdf->stream('student_all_report.pdf');
  //   }


  //   //----------------------admission-test-marks------------------------------------------------

  //   public function admissionTestMarks($value='')
  //   {
  //      $academicYears=AcademicYear::all();
  //      $classTypes=MyFuncs::getClassByHasUser();
  //      return view('admin.student.studentdetails.admissiontestmark.view',compact('classTypes','academicYears'));
  //   }
  //   public function admissionTestMarksSearch(Request $request)
  //   {
  //      $rules=[
  //            'academic_year_id' => 'required',
  //            'class_id' => 'required',
              
  //        ];
  //        $validator = Validator::make($request->all(),$rules);
  //        if ($validator->fails()) {
  //            $errors = $validator->errors()->all();
  //            $response=array();
  //            $response["status"]=0;
  //            $response["msg"]=$errors[0];
  //            return response()->json($response);// response as json
  //        } 
  //      $academic_year_id=$request->academic_year_id;
  //      $class_id=$request->class_id;
  //      $student=Student::where('student_status_id','!=',1)->where('class_id',$class_id)->pluck('id')->toArray();
  //        $admissionApplications=AdmissionApplication::whereIn('student_id',$student)->where('for_academic_year',$academic_year_id)->where('status',4)->get();
  //      $response=array();
  //      $response['status']=1;
  //      $response['data']=view('admin.student.studentdetails.admissiontestmark.student_marks',compact('admissionApplications'))->render();
  //      return $response;
  //   }
  //    public function admissionTestMarksfilter(Request $request,$class_id,$academicYear_id,$conditionId)
  //   { 
       
  //        $student=Student::where('student_status_id','!=',1)->where('class_id',$class_id)->pluck('id')->toArray();
  //        $admissionApplications=AdmissionApplication::whereIn('student_id',$student)->where('for_academic_year',$academicYear_id)->where('status',$conditionId)->get();
      
  //           return  view('admin.student.studentdetails.admissiontestmark.student_marks',compact('admissionApplications'))->render();
         
  //   }
  //   public function admissionTestMarksStore(Request $request)
  //   { 
  //       foreach ($request->marks as $student_id => $mark) { 
  //          $admissionApplications=AdmissionApplication::firstOrNew(['student_id'=>$student_id]); 
  //          $admissionApplications->test_marks=$mark; 
  //          $admissionApplications->status=6; 
  //          $admissionApplications->save();
  //       } 
  //         $response=array();
  //         $response['status']=1;
  //         $response['msg']='Submit Successfully';
  //         return $response;
  //   }
  //   public function takeAdmission($value='')
  //   {
  //     $user = Auth::guard('admin')->user();
  //       $classTypes=MyFuncs::getClassByHasUser();
  //       $default = StudentDefaultValue::where('user_id',$user)->first();
  //       $schoolinfo=Schoolinfo::first();
  //       $houses=House::orderBy('id','ASC')->get();   
  //      return view('admin.student.studentdetails.takeadmission.view',compact('default','schoolinfo','houses','classTypes'));
  //   }
  //   public function takeAdmissionStore(Request $request)
  //   { 
  //       $rules=[
  //            'application_no' => 'required',
  //            'class_id' => 'required',
  //            'section_id' => 'required',
  //            'registration_no' => "required|unique:students|min:$request->reg_length|max:$request->reg_length", 
  //            "admission_no" => 'required|max:20|unique:students',
  //            "roll_no" => 'required|max:20',
  //            'date_of_admission' => 'required',
  //            'date_of_activation' => 'required',
  //            'house_name' => 'required',
              
  //        ];
  //        $validator = Validator::make($request->all(),$rules);
  //        if ($validator->fails()) {
  //            $errors = $validator->errors()->all();
  //            $response=array();
  //            $response["status"]=0;
  //            $response["msg"]=$errors[0];
  //            return response()->json($response);// response as json
  //        }
       
  //      $application=AdmissionApplication::where('id',$request->application_no)->first();
  //      if (empty($application)) {
  //        $response=array();
  //        $response['status']=0;
  //        $response['msg']='Invalid Application No.';
  //        return $response;  
  //      }elseif($application->status==9){
  //        $response=array();
  //        $response['status']=0;
  //        $response['msg']='This Application No. Already Admitted';
  //        return $response;
  //      }elseif($application->status==6){
  //         $student=Student::find($application->student_id); 
  //          $student->class_id=$request->class_id;
  //          $student->section_id=$request->section_id;
  //          $student->registration_no=$request->registration_no;
  //          $student->admission_no=$request->admission_no;
  //          $student->roll_no=$request->roll_no;
  //          $student->date_of_admission=$request->date_of_admission;
  //          $student->date_of_activation=$request->date_of_activation;
  //          $student->house_no=$request->house_name;
  //          $student->student_status_id=1;
  //          $student->save();
  //          $application->status=9;
  //          $application->save();
  //          $response=array();
  //          $response['status']=1;
  //          $response['msg']='Admission Successfully.';
  //          return $response; 
  //      }
  //        $response=array();
  //        $response['status']=0;
  //        $response['msg']='This Application No. Not Pass';
  //        return $response;
          
  //   }
  //   //-------------new-application-report-----------------------------------------------------

  //   public function newApplicationReport($value='')
  //   {
  //      $academicYears=AcademicYear::all();
  //      $classTypes=MyFuncs::getClassByHasUser();
  //      return view('admin.report.newApplicationReport.view',compact('academicYears','classTypes'));
  //   }
  //   public function newApplicationReportFilter(Request $request)
  //  {   
  //      $rules=array();  
  //     if ($request->academic_year_id!=null && $request->class_id!=null && $request->status!=null) {
  //        $student=Student::where('class_id',$request->class_id)->pluck('id')->toArray();
  //        $students=AdmissionApplication::whereIn('student_id',$student)->where('for_academic_year',$request->academic_year_id)->where('status',$request->status)->get();  
  //     }
  //     elseif ($request->academic_year_id!=null && $request->class_id!=null) {
  //         $student=Student::where('class_id',$request->class_id)->pluck('id')->toArray(); 
  //         $students=AdmissionApplication::whereIn('student_id',$student)->where('for_academic_year',$request->academic_year_id)->get(); 
  //     }
  //     elseif ($request->academic_year_id!=null && $request->status!=null) {
          
  //         $students=AdmissionApplication::where('status',$request->status)->where('for_academic_year',$request->academic_year_id)->get(); 
  //     }
  //     elseif ($request->academic_year_id!=null) { 
  //         $students=AdmissionApplication::where('for_academic_year',$request->academic_year_id)->get();  
  //     }
  //     $rules['academic_year_id']='required';
  //     $validator = Validator::make($request->all(),$rules);
  //     if ($validator->fails()) {
  //         $errors = $validator->errors()->all();
  //         $response=array();
  //         $response["status"]=0;
  //         $response["msg"]=$errors[0];
  //         return response()->json($response);// response as json
  //     }
  //     $response = array();
  //                 $response['status'] = 1; 
  //                 $response['data'] =view('admin.report.newApplicationReport.result' ,compact('students'))->render(); 
  //                   return response()->json($response); 
  //  }

  
  //   //Admission Form Functions

  

  //   //Function to show student detail modified by Amit Bansal $source:: 1-Student, 2-Application Form
  //   public function show($student_id,$source)
  //   { 
  //     // dd($source);
  //     $studentId= Crypt::decrypt($student_id);
  //     $userId=Auth::guard('admin')->user(); 

  //     $parentsType=DB::select(DB::raw("select `name`, `id` from `guardian_relation_types` order by `name`;"));
  //     $incomes=DB::select(DB::raw("select `range`, `id` from `income_ranges` order by `id`;"));
  //     $documentTypes=DB::select(DB::raw("select `name`, `id` from `document_types` order by `name`;"));
  //     $subjectTypes=DB::select(DB::raw("select `name`, `id` from `subject_types` order by `name`;"));
  //     $sessions=DB::select(DB::raw("select `name`, `id` from `academic_years` order by `name`;"));
  //     $awardLevels=DB::select(DB::raw("select `name`, `id` from `award_levels` order by `name`;"));
  //     $isoptionals=DB::select(DB::raw("select `name`, `id` from `isoptionals` order by `name`;"));
  //     $bloodgroups=DB::select(DB::raw("select `name`, `id` from `blood_groups` order by `name`;"));
  //     $professions=DB::select(DB::raw("select `name`, `id` from `professions` order by `name`;"));

  //     if($source == 1){
  //       $classes = MyFuncs::getClassOnly($userId->id,1);  
  //     }else{
  //       $classes = MyFuncs::getClassOnly($userId->id,2);
  //     }

  //     $student_user_status=DB::select(DB::raw("call up_check_student_adm_app_status ($studentId, $userId->id)")); 
      

  //       $st=new Student();
  //       $student=$st->getStudentDetailsById($studentId);
  //       // $parentsType = array_pluck(GuardianRelationType::get(['id','name'])->toArray(),'name','id');
  //       // $incomes = array_pluck(IncomeRange::get(['id','range'])->toArray(),'range', 'id');
  //       // $documentTypes = array_pluck(DocumentType::get(['id','name'])->toArray(),'name', 'id');
  //       // $subjectTypes = array_pluck(SubjectType::get(['id','name'])->toArray(),'name', 'id');
  //       // $sessions = array_pluck(AcademicYear::get(['id','name'])->toArray(),'name', 'id');
  //       // $awardLevels = array_pluck(AwardLevel::get(['id','name'])->toArray(),'name', 'id');
  //       // $isoptionals = array_pluck(Isoptional::get(['id','name'])->toArray(),'name', 'id');
  //       // $bloodgroups = array_pluck(BloodGroup::get(['id','name'])->toArray(),'name', 'id');
  //       // $professions = array_pluck(Profession::get(['id','name'])->toArray(),'name', 'id');
  //       // if ($userId->role_id==12) {
  //       //    $classes = MyFuncs::getStudentClasses();
  //       // }else{
  //       //    $classes = MyFuncs::getClasses();
  //       // } 
  //       if ($userId->role_id==12) {
  //           $sections = MyFuncs::getStudentSections($student->class_id);
  //       }else{
  //         $sections = MyFuncs::getSections($student->class_id);
  //       } 
  //       $houses=House::orderBy('id','ASC')->get(); 
  //       $genders=Gender::orderBy('genders','ASC')->get();
  //       $schoolinfo=Schoolinfo::first();
  //       $studentStatus=DB::select(DB::raw("call up_check_user_student_status ('$userId->id')")); 
  //       if ($studentStatus[0]->show_status==1) {
  //           $showHide='';
  //       }else{
  //           $showHide='hidden';
  //       } 
         
  //       return view('admin.student.studentdetails.view',compact('student','parentsType','incomes','documentTypes','isoptionals','sessions','awardLevels','subjectTypes','bloodgroups','professions','classes','sections','houses','genders','userId','schoolinfo','showHide','source', 'student_user_status'));
  //   }


}