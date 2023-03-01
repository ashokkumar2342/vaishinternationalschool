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

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = DB::select("select * from `section_types` order by `sorting_order_id`;");
        
        // $manageSections =Section::where('status',1)->orderBy('class_id','ASC')->orderBy('section_id','ASC')->get(); 
        $manageSections = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `ct`.`name` as `class_name`, `st`.`name` as `section_name` from `sections` `sec` inner join `class_types` `ct` on `ct`.`id` = `sec`.`class_id` inner join `section_types` `st` on `st`.`id` = `sec`.`section_id` where `sec`.`status` = 1 ;");

        // $classes = ClassType::orderBy('shorting_id','ASC')->get();     
        $classes = DB::select("select * from `class_types` order by `shorting_id`;");
        return view('admin.manage.section.manageSection',compact('sections','classes','manageSections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    // public function search(Request $request)
    // {
       
    //   $sections =MyFuncs::getSections($request->id); 
    //     return response()->json($sections);
   
    // }
    //  public function search2(Request $request)
    // {   
    //   $sections =MyFuncs::getSections($request->id);
    //   return response()->json(['section'=>$sections]);
   
    // }

    //  public function sectionSelectBox(Request $request)
    // {  
    //     $sections =MyFuncs::getSections($request->id); 
    //       return view('admin.manage.section.selectBox',compact('sections'))->render();
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        
        $rules=[
            'section_id' => 'required|max:199',
            'class' => 'required|numeric'   
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
        $data = $request->except('_token');        
        $section_count = count($data['section_id']);
        $section_ids = implode(",", $data['section_id']);
        $class_id = $request->class;

        $rs_update = DB::select(DB::raw("call `up_save_class_section`($userid, $class_id, '$section_ids');"));

        $response['msg'] = 'Save Successfully';
        $response['status'] = 1;
        return response()->json($response); 
         
    }

    public function pdfGenerate()
    {
        $report_header = "Class Sections";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Class Name',45),
            array('Section Name',45)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `ct`.`name` as `class_name`, `st`.`name` as `section_name` from `sections` `sec` inner join `class_types` `ct` on `ct`.`id` = `sec`.`class_id` inner join `section_types` `st` on `st`.`id` = `sec`.`section_id` where `sec`.`status` = 1 ;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('class_section.pdf');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    // public function show(Section $sectionType)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    // public function edit(Section $sectionEdit)
    // {
    //     $sections = Section::all();
    //     $classes = MyFuncs::getClasses();
    //     $sessions = array_pluck(SessionDate::get(['id','date'])->toArray(),'date', 'id');
    //     return view('admin.manage.section.list',compact('sections','sectionEdit','classes','sessions'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Section $section)
    // {
    //     $this->validate($request,[
    //         'session' => 'required|max:199',
    //         'class' => 'required|numeric',
    //         'sectionName' => 'required|max:199'
    //         ]);
    //     $section->name = $request->sectionName;
    //     $section->class_id = $request->class;
    //     $section->session_id = $request->session;
    //     if ($section->save()) {
    //         return redirect()->route('admin.section.list')->with(['class'=>'success','message'=>'Class created success ...']);
    //     }
    //     return redirect()->back()->with(['class'=>'error','message'=>'Whoops ! Look like somthing went wrong ..']);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    // 

}
