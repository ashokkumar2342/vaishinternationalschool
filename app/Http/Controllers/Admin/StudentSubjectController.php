<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Validator;
use DB;
use Illuminate\Support\Facades\Crypt;
use App\Helper\MyFuncs;
use App\Helper\SelectBox;

class StudentSubjectController extends Controller
{

   public function index(Request $request,$student_id)
   {  
      $studentId = Crypt::decrypt($student_id);
      $default_year_id = MyFuncs::getDefaultAcademicYearID();
      $studentSubjects=DB::select(DB::raw("select `sts`.`id`, `sts`.`subject_type_id`, `sub`.`name`, case `sts`.`isoptional_id` when 1 then 'Compulsory' else 'Optional' end as `is_compulsory` from `student_subjects` `sts` inner join `subject_types` `sub` on `sub`.`id` = `sts`.`subject_type_id` where `sts`.`student_id` = $studentId and `sts`.`session_id` = $default_year_id and `sts`.`status` = 1 order by `sub`.`sorting_order_id`;"));
      return view('admin.student.studentdetails.include.subject_list',compact('studentSubjects', 'studentId'));
   }

   public function addForm(Request $request, $student_id)
   {
      $student=$student_id;
      $rs_fetch = DB::select(DB::raw("select `class_id` from `students` where `id` = $student limit 1;"));
      $class_id = 0;
      if(count($rs_fetch)>0){
         $class_id = $rs_fetch[0]->class_id;
      }

      $subjectTypes = SelectBox::getSubjectTypeByClass($class_id);

      $isoptionals= DB::select(DB::raw("select * from `isoptionals`"));
      return view('admin.student.studentdetails.include.add_subject',compact('subjectTypes','student','isoptionals'));
   }

   public function store(Request $request)
   {
     
      $rules=[
      'subject' => 'required',
      'isoptional' => 'required',
      ];
      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
         $errors = $validator->errors()->all();
         $response=array();
         $response["status"]=0;
         $response["msg"]=$errors[0];
         return response()->json($response);// response as json
      }

      $student_id = $request->student_id;
      $subject_type_id = $request->subject;
      $isoptional_id = $request->isoptional;
      $default_year_id = MyFuncs::getDefaultAcademicYearID();
      $rs_update = DB::select(DB::raw("call `UP_AddStudentSubject`($student_id, $subject_type_id, $isoptional_id, $default_year_id, 0);"));
      
      $response=['status'=>$rs_update[0]->status,'msg'=>$rs_update[0]->result];
      return response()->json($response);
   }

   public function destroy(Request $request, $subject_id)
   {   
      $subjecttId = Crypt::decrypt($subject_id);
      $rs_fetch = DB::select(DB::raw("delete from `student_subjects` where `id` = $subjecttId limit 1;"));
      $response=['status'=>1,'msg'=>'Delete Succeefully'];
      return response()->json($response);
     
   }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Model\StudentSubject  $studentSubject
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(StudentSubject $studentSubject)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Model\StudentSubject  $studentSubject
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Request $request,StudentSubject $studentSubject)
    // {
    //     $studentSubject = StudentSubject::where('id', $request->id)->get();
    //     return response()->json(['studentSubject'=>$studentSubject]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Model\StudentSubject  $studentSubject
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, StudentSubject $studentSubject)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Model\StudentSubject  $studentSubject
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request,$id)
    // {
        
    //     $studentSubject = StudentSubject::find($id);
    //     $studentSubject->delete();
    //     $response=['status'=>1,'msg'=>'Delete Succeefully'];
    //         return response()->json($response);

     
    // }
}
