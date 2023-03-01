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


class SectionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = DB::select(DB::raw("select * from `section_types` order by `sorting_order_id`;"));
        return view('admin.manage.section.list',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectList(Request $request)
    {
        $class_id = $request->id;
        $sections = DB::select(DB::raw("select `st`.`id`, `st`.`name`, ifnull(`sec`.`status`,0) as `selected` from `section_types` `st` left join `sections` `sec` on `st`.`id` = `sec`.`section_id` where `sec`.`class_id` = $class_id or `sec`.`class_id` is null order by `st`.`sorting_order_id`;"));

        $data= view('admin.manage.section.selectList',compact('sections'))->render(); 
        return response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // { 
    //      $admin=Auth::guard('admin')->user()->id;
    //     $this->validate($request,[
    //         'name' => 'required|max:30|unique:section_types',             
    //         'code' => 'required|max:5|unique:section_types',             
    //         'sorting_order_id' => 'required|max:2|unique:section_types',             
    //         ]);
    //     $section = new SectionType();
    //     $section->name = $request->name;        
    //     $section->code = $request->code;        
    //     $section->sorting_order_id = $request->sorting_order_id;        
    //     $section->last_updated_by = $admin;        
    //     if ($section->save()) {
    //         return redirect()->back()->with(['section'=>'success','message'=>'Section created success ...']);
    //     }
    //     return redirect()->back()->with(['class'=>'error','message'=>'Whoops ! Look like somthing went wrong ..']);
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    // public function show(SectionType $sectionType)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $sectionType = DB::select(DB::raw("select * from `section_types` where `id` = $id limit 1;"));
            $sectionType = reset($sectionType);
        }else { 
            $sectionType = ''; 
        }
        return view('admin.manage.section.section_edit',compact('sectionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id='')
    {  
        $rules=[
            'name' => 'required|max:30',
            'code' => 'required|max:5',
            'sorting_order_id' => 'required|max:2',
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
        $section_name = MyFuncs::removeSpacialChr($request->name);
        $section_code = MyFuncs::removeSpacialChr($request->code);
        $section_order = MyFuncs::removeSpacialChr($request->sorting_order_id);
        
        $rs_update = DB::select(DB::raw("call `up_save_sections`($id, '$section_name', '$section_code', $section_order, $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `section_types` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function pdfGenerate()
    {
        $report_header = "Sections";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Name',65),
            array('Code',25)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `code` from `section_types` order by `sorting_order_id`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('section.pdf');
       
    }


    public function classWiseSection(Request $request){
        $classID = $request->id;
        $sections = MyFuncs::getSections($classID);
        return view('admin.manage.section.selectBox',compact('sections'));
    }
     
}
