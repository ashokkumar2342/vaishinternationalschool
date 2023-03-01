<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Helper\MyFuncs;
use App\Helper\SelectBox;
use Auth;

class StudentSportHobbyController extends Controller
{
    public function show($student_id)
    {   
        $studentId= Crypt::decrypt($student_id);
        $sportHobbies =  DB::select(DB::raw("select `ssh`.`id`, `ssh`.`student_id`, `ay`.`name` as `academic_year`, `awl`.`name` as `award_level`, `ssh`.`sports_activity_name` from `student_sport_hobbies` `ssh` inner join `academic_years` `ay` on `ay`.`id` = `ssh`.`session_id` inner join `award_levels` `awl` on `awl`.`id` = `ssh`.`award_level` where `ssh`.`student_id` = $studentId order by `awl`.`code`;"));
        return view('admin.student.studentdetails.include.sport_hobbies_list',compact('sportHobbies', 'student_id'));
    }

    public function addForm($student_id)
    {   
        $academicYears = SelectBox::getAllAcademicYear();
        $awardLevels = SelectBox::getAwardLevelType();
        return view('admin.student.studentdetails.include.add_sport_hobby',compact('student_id','academicYears','awardLevels'));
    }

    public function store(Request $request,$sport_id=null)
    {  
        $rules=[
        'academic_year'=>'required',
        'level'=>'required',
        'sports_activity_name'=>'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $sport_id= Crypt::decrypt($sport_id);  
        $academic_year = $request->academic_year;
        $award_level = $request->level;
        $sports_activity_name = MyFuncs::removeSpacialChr($request->sports_activity_name);
        if (!empty($sport_id)) {
            $rs_save =  DB::select(DB::raw("update `student_sport_hobbies` set `session_id` = $academic_year, `award_level` = $award_level, `sports_activity_name` = '$sports_activity_name' where `id` = $sport_id limit 1"));    
        }else{
            $studentId= Crypt::decrypt($request->student_id); 
            $rs_save =  DB::select(DB::raw("insert into `student_sport_hobbies` (`student_id`, `session_id`, `award_level`, `sports_activity_name`) values ($studentId, $academic_year, $award_level, '$sports_activity_name')"));
        } 
        
        
          
        $response=['status'=>1,'msg'=>'Created Successfully'];
        return response()->json($response);
          
    }

    public function edit(Request $request, $sport_id)
    {   
        $sport_id= Crypt::decrypt($sport_id); 
        $sportHobbies =  DB::select(DB::raw("select * from `student_sport_hobbies` where `id` = $sport_id limit 1")); 
        $academicYears = SelectBox::getAllAcademicYear();
        $awardLevels = SelectBox::getAwardLevelType();
        return view('admin.student.studentdetails.include.add_sport_hobby',compact('sportHobbies','academicYears','awardLevels'));
    }

    public function destroy($sport_id)
    { 
        $sport_id= Crypt::decrypt($sport_id);
        $sportHobbies =  DB::select(DB::raw("delete from `student_sport_hobbies` where `id` = $sport_id limit 1"));  
        $response=['status'=>1,'msg'=>'Delete Successfully'];
        return response()->json($response); 
    }
}
