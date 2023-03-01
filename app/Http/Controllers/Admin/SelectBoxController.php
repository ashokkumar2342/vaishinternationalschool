<?php

namespace App\Http\Controllers\Admin;
 use App\Http\Controllers\Controller;
// use App\Events\SmsEvent;
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

class SelectBoxController extends Controller
{
  
  public function getScetionByClass(Request $request)
  {
    $class_id = $request->id;
    $section_rs = SelectBox::getSectionByClass($class_id);
    
    $html_code = "";  
    foreach ($section_rs as $key => $value) {
      $html_code = $html_code."<option value='$value->id'>$value->name</option>";
    }

    return $html_code;
    // return view('admin.student.studentdetails.newregistration.class_select_box',compact('classes'));
  }

  public function getSubjectsByExamScheduleAY_Class(Request $request)
  {
    try {
      $ac_year_id = $request->academic_year_id;
      $class_id = $request->class_id;
      $rs_fetch = DB::select(DB::raw("select `id` from `admission_schedule` where `academic_year_id` = $ac_year_id and `class_id` = $class_id limit 1;"));
      $adm_schedule_id = 0;
      if(count($rs_fetch)>0){
        $adm_schedule_id = $rs_fetch[0]->id;
      }

      $rs_subjects = DB::select(DB::raw("select `id`, `name`, 0 as `selected` from `subject_types` `st`  where `id` not in (select `subject_id` from `adm_test_subjects` where `adm_sch_id` = $adm_schedule_id) union select `id`, `name`, 1 as `selected` from `subject_types` `st`  where `id` in (select `subject_id` from `adm_test_subjects` where `adm_sch_id` = $adm_schedule_id) order by `name`;"));
      return view('admin.student.studentdetails.schoolwiseadmission.subject_select_box',compact('rs_subjects')); 
     
      
    } catch (QueryException $e) {
      return $e; 
    }
  }//function End

  // public function getClassAdmissionOpenByYear(Request $request ,$student_id)
  // {
  //   $yearId = $request->id;
  //   $classes = SelectBox::getClassAdmissionOpenYearWise($yearId);
  //   $st_class = MyFuncs::getStudentDetailsByStudetId($student_id);
  //   $class=$st_class[0]->class_id;
  //   $html_code = ""; 
  //   foreach ($classes as $key => $value) {
  //     $html_code = $html_code."<option value='$value->id'$value->id==$class?'selected':''>$value->name</option>";
  //   }

  //   return $html_code;
  //   // return view('admin.student.studentdetails.newregistration.class_select_box',compact('classes'));
  // }

  public function getClassAdmissionOpenByYear(Request $request)
  {
    $yearId = $request->id;
    $classes = SelectBox::getClassAdmissionOpenYearWise($yearId);
    // $st_class = MyFuncs::getStudentDetailsByStudetId($student_id);
    // $class=$st_class[0]->class_id;
    $html_code = ""; 
    foreach ($classes as $key => $value) {
      $html_code = $html_code."<option value='$value->id'>$value->name</option>";
    }

    return $html_code;
    // return view('admin.student.studentdetails.newregistration.class_select_box',compact('classes'));
  }

  
  public function getYearAdmissionOpen()
  {
    $result_rs = SelectBox::getYearAdmissionOpen();

    //return view('admin.student.studentdetails.newregistration.form',compact('academicYears','genders'));
  }


  public function getGenders(){ 
    $result_rs = SelectBox::getGenders();
    
  }


  //--------------End------------------


        

}