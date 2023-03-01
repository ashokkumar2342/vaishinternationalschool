<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\MyFuncs;
use App\Helper\SelectBox;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Model\StudentDefaultValue;
use Auth;
use Carbon;
use DB;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Storage;

class StudentDefaultValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::guard('admin')->user()->id;
        $classes = MyFuncs::getClasses();
        $genders = SelectBox::getGenders();
        $religions = SelectBox::getReligions();
        $categories = SelectBox::getCategories();
        $houses = SelectBox::getAllHouses();
        $rs_sections = SelectBox::getAllSections();
        
        $default = DB::select("select * from `student_default_values` where `user_id` = 1 limit 1;");
        $default = reset($default);
        
        return view('admin.student.studentdetails.default',compact('classes','default','genders','religions','categories','houses', 'rs_sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
         // return $request;
        $user_id=Auth::guard('admin')->user()->id;
        $default = StudentDefaultValue::firstOrNew(['user_id'=>$user_id]); 
        $default->user_id = $user_id;
        $default->class_id = $request->class;
        $default->section_id = $request->section;
        $default->religion_id = $request->religion;
        $default->category_id = $request->category;
        $default->gender_id = $request->gender;
        $default->admission_date = $request->admission_date;
        $default->activation_date = $request->activation_date_;
        $default->house_id = $request->house;
        $default->state = $request->state;
        $default->city = $request->city;
        $default->pincode = $request->pincode;
        $default->nationality = $request->nationality;
        $default->alive = $request->alive; 
        $default->m_ondate = $request->m_ondate;
        $default->m_hb = $request->m_hb;
        $default->m_bp_l = $request->m_bp_l;
        $default->m_bp_u = $request->m_bp_u;
        $default->m_weight = $request->m_weight;
        $default->m_height = $request->m_height; 
         
 
        
        // $default->birthday_message_id = $request->birthday_message_id;
        // $default->birthday_email_id = $request->birthday_email_id; 
        
        
        // $default->homework_message_id = $request->homework_message_id;
        // $default->homework_email_id = $request->homework_email_id; 
        
        
        // $default->classTest_message_id = $request->classTest_message_id;
        // $default->classTest_email_id = $request->classTest_email_id;

        // $default->class_test_details_email_id = $request->class_test_details_email_id;
        // $default->class_test_details_message_id = $request->class_test_details_message_id; 
        
       
        // $default->timetable_message_id = $request->timetable_message_id;
        // $default->timetable_email_id = $request->timetable_email_id;

        // $default->medical_message_id = $request->medical_message_id;
        // $default->medical_email_id = $request->medical_email_id;

        // $default->absent_student_message_id = $request->absent_student_message_id;
        // $default->absent_student_email_id = $request->absent_student_email_id; 
        
        $default->save();
        return redirect()->back()->with(['message'=>'Default Value Updated','class'=>'success']);


    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Model\StudentDefaultValue  $studentDefaultValue
    //  * @return \Illuminate\Http\Response
    //  */
    // public function template(Request $request,$option_id)
    // {
    //     if ($option_id==1) {
    //         if ($request->id==1) {
    //             $default = StudentDefaultValue::
    //                                            where('birthday_template_id',$request->id)
    //                                            ->first()->birthday_message_id; 
    //         }
    //         if ($request->id==2) { 
    //             $default = StudentDefaultValue::
    //                                           where('homework_template_id',$request->id)
    //                                           ->first()->homework_message_id;
    //         }
    //         if ($request->id==3) {
    //             $default = StudentDefaultValue::
    //                                           where('classTest_template_id',$request->id)
    //                                           ->first()->classTest_message_id;
    //         }                                  
    //        $smsTemplates=SmsTemplate::where('template_type_id',$request->id)->get();
    //        return view('admin.student.studentdetails.template_default',compact('option_id','smsTemplates','default'));   
    //     }

    //    $default = StudentDefaultValue::where('email_template_type_id',$request->id)->first();
    //    $EmailTemplates=EmailTemplate::where('template_type_id',$request->id)->get();
    //    return view('admin.student.studentdetails.template_default',compact('option_id','EmailTemplates'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Model\StudentDefaultValue  $studentDefaultValue
    //  * @return \Illuminate\Http\Response
    //  */
    // public function admissionSchedule()
    // {
    //     $userId=Auth::guard('admin')->user()->id;
    //     $adminssionSeat=AdmissionSeatDefault::where('user_id',$userId)->first();
    //    return view('admin.master.admissionSeat.default_value',compact('adminssionSeat'));  
    // }
    // public function admissionScheduleStore(Request $request)
    // {
    //      // return $request;
    //     $user_id=Auth::guard('admin')->user()->id;
    //     $default = AdmissionSeatDefault::firstOrNew(['user_id'=>$user_id]); 
    //     $default->user_id = $user_id;
    //     $default->total_seat = $request->total_seat;
    //     $default->form_fee = $request->form_fee;
    //     $default->from_date = $request->from_date;
    //     $default->last_date = $request->last_date;
    //     $default->test_date = $request->test_date;
    //     $default->retest_date = $request->retest_date;
    //     $default->result_date = $request->result_date;
    //     $default->save();
    //     return redirect()->back()->with(['message'=>'Default Value Updated','class'=>'success']);


    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Model\StudentDefaultValue  $studentDefaultValue
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, StudentDefaultValue $studentDefaultValue)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Model\StudentDefaultValue  $studentDefaultValue
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(StudentDefaultValue $studentDefaultValue)
    // {
    //     //
    // }
}
