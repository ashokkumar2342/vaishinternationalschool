<?php

namespace App\Http\Controllers\Admin;

 
use App\Events\SmsEvent;
use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\AttendanceType;
use App\Model\ClassType;
use App\Model\Schoolinfo;
use App\Model\SessionDate;
use App\Model\Sms\SmsTemplate;
use App\Model\StudentAttendance;
use App\Model\StudentAttendanceClass;
use App\Model\StudentDefaultValue;
use App\Student;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        $classes = MyFuncs::getClassByHasUser();
        return view('admin.attendance.student.list',compact('centers','classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request,$condition_id)
    {     $date=$request->date;
          $class=$request->class_id;
          $section=$request->section_id;
         $rules=[
          
            'class_id' => 'required', 
            'section_id' => 'required', 
            'date' => "required", 
       
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $students=Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->get();
        $attendancesTypes=AttendanceType::all();
         $response=array();
        $response["status"]=1;
        if ($condition_id==1) { 
         $response["data"]=view('admin.attendance.student.attendance_table',compact('students','attendancesTypes','date','class','section'))->render(); 
        }else{
            $response["data"]=view('admin.attendance.student.verify_attendance',compact('students','attendancesTypes','date','class','section'))->render();  
        }
        return $response;
        
        
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $user_id=Auth::guard('admin')->user()->id;
         $date=$request->date;
        $rules=[
            'class_id' => 'required', 
            'section_id' => 'required', 
            'date' => "required", 
            'attendenceType_id' => "required", 

        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        
        foreach ($request->attendenceType_id as $key => $value) {
           $studentAttendance = StudentAttendance::where(['date'=>date('Y-m-d',strtotime($date)),'student_id'=>$key])->firstOrNew(['student_id'=>$key]); 
           $studentAttendance->student_id = $key;
           $studentAttendance->attendance_type_id = $value;
           $studentAttendance->date = date('Y-m-d',strtotime($date));
           $studentAttendance->last_updated_by = $user_id;
           $studentAttendance->verified_attendance_type_id =0;
           $studentAttendance->verified =0;
           $studentAttendance->save(); 
        }
        $studentAttendanceClass=StudentAttendanceClass::firstOrNew(['date'=>date('Y-m-d',strtotime($date)),'class_id'=>$request->class_id,'section_id'=>$request->section_id]);
        $studentAttendanceClass->class_id=$request->class_id;
        $studentAttendanceClass->section_id=$request->section_id;
        $studentAttendanceClass->last_updated_by = $user_id; 
        $studentAttendanceClass->attendance =1; 
        $studentAttendanceClass->verified =0;
        $studentAttendanceClass->sms_sent =0;
        $studentAttendanceClass->save(); 
         $response=['status'=>1,'msg'=>'Save successfully'];
            return response()->json($response); 
    }

    public function verify()
    {    $classes = MyFuncs::getClassByHasUser();
         return view('admin.attendance.student.verify',compact('classes')); 
    }
    public function verifyStore(Request $request)
    {    
         $user_id=Auth::guard('admin')->user()->id;
         $date=$request->date;
        $rules=[

        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        } 
        foreach ($request->attendenceType_id as $key => $value) {
           $studentAttendance = StudentAttendance::where(['date'=>date('Y-m-d',strtotime($date)),'student_id'=>$key])->firstOrNew(['student_id'=>$key]);  
           $studentAttendance->verified_attendance_type_id =$value;
           $studentAttendance->verified =1;
           $studentAttendance->verified_by =$user_id;
           $studentAttendance->save(); 
        }
        $studentAttendanceClass=StudentAttendanceClass::firstOrNew(['date'=>date('Y-m-d',strtotime($date)),'class_id'=>$request->class_id,'section_id'=>$request->section_id]); 
        
        $studentAttendanceClass->verified =1;
        $studentAttendanceClass->verified_by =$user_id;
        $studentAttendanceClass->save(); 
         $response=['status'=>1,'msg'=>'Verified successfully'];
            return response()->json($response);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function unlock($ctudentAttendanceClass_id)
    {
          $studentAttendanceClass=StudentAttendanceClass::find($ctudentAttendanceClass_id);
          if ($studentAttendanceClass->sms_sent==0) {
          $studentAttendanceClass->verified=0;
          $studentAttendanceClass->verified_by=null;
          $studentAttendanceClass->save();
          $students=Student::where('class_id',$studentAttendanceClass->class_id)
                            ->where('section_id',$studentAttendanceClass->section_id)
                            ->get();
          foreach ($students as $student) {
            $studentAttendances = StudentAttendance::
                                            where('student_id',$student->id)
                                            ->where('date',$studentAttendanceClass->date)
                                            ->get();
               foreach ($studentAttendances as $studentAttendance) {
                    
                        $studentAttendance->verified_attendance_type_id=0;
                        $studentAttendance->verified=0;
                        $studentAttendance->verified_by=null;
                        $studentAttendance->save();                 
               }
          }
           $response=['status'=>1,'msg'=>'Unlock successfully'];
            return response()->json($response);
            
         }

        $response=['status'=>0,'msg'=>' Not Unlock '];
            return response()->json($response);       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAttendance $studentAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAttendance $studentAttendance)
    {
        //
    }
    public function attendanceContinue($value='')
    {
        
        $studentAttendances= StudentAttendance::where('attendance_type_id',2)->where('date', '>', Carbon::now()->subDays(2))->distinct('student_id')->get(['student_id']);

          

        return  view('admin.attendance.student.absent_continue',compact('studentAttendances'));
    }
    //-------------------student-absent-------------------------------------------------//
    public function studentAbsent()
    {
        return  view('admin.attendance.student.student_absent_list');
    }
     public function studentAbsentList()
    {
        $StudentAttendances=StudentAttendance::where('date',date('Y-m-d'))->where('attendance_type_id',2)->get();
        return  view('admin.attendance.student.student_absent_list_show',compact('StudentAttendances'));
    }
    public function studentAbsentSendSms(Request $request,$id)
    {
        $user_id=Auth::guard('admin')->user()->id;
        if ($request->student_id==null) {
            $response=array();
            $response=['status'=>0,'msg'=>'Student Not Found'];
            return response()->json($response);
         }
          
         $st=new Student();
         $studentAbsentSendSms=$st->getStudentDetailsByArrId($request->student_id); 
         foreach ($studentAbsentSendSms as  $value) { 
         $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->absent_student_message_id; 
         $smsTemplate = SmsTemplate::where('id',$messageId)->first()->message;

        $findword = ["#SN#", "#FN#", "#MN#"];
        $replaceword   = [$value->name, $value->parents[0]->parentInfo->name, $value->parents[1]->parentInfo->name];

         $message = str_replace($findword, $replaceword, $smsTemplate);
          event(new SmsEvent($value->addressDetails->address->primary_mobile,$message)); 
         }
        $response=['status'=>1,'msg'=>'Message Sent successfully'];
            return response()->json($response);
    }
//-------------------attendance-barcode------------------------------------------------//
    public function attendanceBarcode()
    {
      $schoolinfo=Schoolinfo::first()->reg_length; 
      return  view('admin.attendance.student.barcode',compact('schoolinfo'));   
    }
    public function btnClick()
    {
          
      return  view('admin.attendance.student.barcode_form');   
    }
    public function attendanceBarcodeshow(Request $request)
    {  
      $user_id=Auth::guard('admin')->user()->id;
          $StudentAttendancesBarcode=DB::select(DB::raw("call up_mark_att_student_barcode ('$request->registration_no', '$user_id')")); 
        
       
        return  view('admin.attendance.student.student_list_barcode',compact('StudentAttendancesBarcode')); 
        
        
    }

    public function attendanceBarcodeSave(Request $request)
    {  
         $user_id=Auth::guard('admin')->user()->id;
         $StudentAttendancesBarcode=Student::find($request->student_id);
        $date=date('d-m-Y');
        
        $rules=[];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        else {
         $student = StudentAttendance::where(['date'=>date('Y-m-d',strtotime($date)),'student_id'=>$StudentAttendancesBarcode->id])->firstOrNew(['student_id'=>$StudentAttendancesBarcode->id]);
           $student->student_id = $StudentAttendancesBarcode->id;
           $student->attendance_type_id =1;
           $student->date = date('Y-m-d',strtotime($date));
           $student->last_updated_by = $user_id;
           $student->verified_attendance_type_id =0;
           $student->verified =0;
           $student->save();
           $studentAttendanceClass=StudentAttendanceClass::firstOrNew(['date'=>date('Y-m-d',strtotime($date)),'class_id'=>$StudentAttendancesBarcode->class_id,'section_id'=>$StudentAttendancesBarcode->section_id]);
            $studentAttendanceClass->class_id=$StudentAttendancesBarcode->class_id;
            $studentAttendanceClass->section_id=$StudentAttendancesBarcode->section_id;
            $studentAttendanceClass->last_updated_by = $user_id; 
            $studentAttendanceClass->attendance =0; 
            $studentAttendanceClass->verified =0;
            $studentAttendanceClass->verified_by =0;
            $studentAttendanceClass->save();
        $response=['status'=>1,'msg'=>'Save Successfully'];
            return response()->json($response);
        
        }   
         
         
    }
}
