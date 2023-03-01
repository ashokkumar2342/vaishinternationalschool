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

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = MyFuncs::getUser();
        $user_id = $user->id;

        $subjectTypes = DB::select("select * from `subject_types` order by `sorting_order_id`;");
        
        $manageSubjects = DB::select("select `cs`.`id`, `ct`.`name` as `class_name`, `sub`.`name` as `subject_name`, `io`.`name` as `optional` from `subjects` `cs` inner join `subject_types` `sub` on `sub`.`id` = `cs`.`subjectType_id` inner join `class_types` `ct` on `ct`.`id` = `cs`.`classType_id` inner join `isoptionals` `io` on `io`.`id` = `cs`.`isoptional_id` where `cs`.`status` = 1 and `ct`.`id` in (select distinct `class_id` from `user_class_types` where `admin_id` = $user_id) order by `ct`.`name`, `sub`.`name`;");

        $classes = MyFuncs::getClasses(); 
        return view('admin.subject.manageSubject',compact('subjectTypes','manageSubjects','classes'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
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
        $user = MyFuncs::getUser();
        $user_id = $user->id;
        $class_id = $request->class;
        foreach ($request->value as $key => $value) {

            $rs_update = DB::select("call `up_save_class_subjects`($key, $class_id, $value, $user_id);");
        }
        
        return response()->json(['response'=>'OK','message'=>'Subject Added/Updated Successfully', 'class'=>'sucess']);

    }


    public function search(Request $request)
    {
        $class = $request->id;
        $subjectTypes = DB::select("select `sub`.`id`, `sub`.`code`, `sub`.`name` as `subject_name`, ifnull(`io`.`name`,'') as `optional`, ifnull(`cs`.`status`,0) as `is_class_sub`, ifnull(`io`.`id`,0) as `opt_id`, `sub`.`sorting_order_id` from `subject_types` `sub` inner join `subjects` `cs` on `sub`.`id` = `cs`.`subjectType_id` inner join `isoptionals` `io` on `io`.`id` = `cs`.`isoptional_id` where (`cs`.`classType_id` = $class) union select `sub1`.`id`, `sub1`.`code`, `sub1`.`name` as `subject_name`, '' as `optional`, 0 as `is_class_sub`, 0 as `opt_id`, `sub1`.`sorting_order_id` from `subject_types` `sub1` where `sub1`.`id` not in (select `subjectType_id` from `subjects` where `classType_id` = $class) order by `sorting_order_id`;");
        
        return view('admin.subject.subject_list',compact('subjectTypes'));
    }

    // *
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Model\Subject  $subject
    //  * @return \Illuminate\Http\Response
     
    // public function show(Subject $subject)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Model\Subject  $subject
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Subject $subject)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Model\Subject  $subject
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Subject $subject)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Model\Subject  $subject
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `subjects` where `id` = $id limit 1;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function classSubjectPDF(Request $request)
    {

        $conditionVal=$request->optradio;
        $user = MyFuncs::getUser();
        $user_id = $user->id;
        if($conditionVal==1){
            $report_header = "Class Wise Subjects";
            $tcols = 3;
            $qcols = array(
                array('Class',35),
                array('Subject Name',35),
                array('Compulsory/Elective',30)
            );

            $rs_result = DB::select("select `ct`.`name` as `class_name`, `sub`.`name` as `subject_name`, `io`.`name` as `optional` from `subjects` `cs` inner join `subject_types` `sub` on `sub`.`id` = `cs`.`subjectType_id` inner join `class_types` `ct` on `ct`.`id` = `cs`.`classType_id` inner join `isoptionals` `io` on `io`.`id` = `cs`.`isoptional_id` where `cs`.`status` = 1 and `ct`.`id` in (select distinct `class_id` from `user_class_types` where `admin_id` = $user_id) order by `ct`.`shorting_id`, `sub`.`sorting_order_id`;");    
        }else{
            $report_header = "Subject in Classes";
            $tcols = 3;
            $qcols = array(
                array('Subject Name',35),
                array('Class',35),
                array('Compulsory/Elective',30)
            );

            $rs_result = DB::select("select `sub`.`name` as `subject_name`, `ct`.`name` as `class_name`, `io`.`name` as `optional` from `subjects` `cs` inner join `subject_types` `sub` on `sub`.`id` = `cs`.`subjectType_id` inner join `class_types` `ct` on `ct`.`id` = `cs`.`classType_id` inner join `isoptionals` `io` on `io`.`id` = `cs`.`isoptional_id` where `cs`.`status` = 1 and `ct`.`id` in (select distinct `class_id` from `user_class_types` where `admin_id` = $user_id) order by `sub`.`sorting_order_id`, `ct`.`shorting_id`;"); 
        }
        
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('class_subject.pdf');

    }
}
