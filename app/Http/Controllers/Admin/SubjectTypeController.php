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


class SubjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = DB::select(DB::raw("select * from `subject_types` order by `sorting_order_id`;"));
        return view('admin.subject.list',compact('subjects'));
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
    // public function store(Request $request)
    // {
         
    //       $admin=Auth::guard('admin')->user()->id;
    //      $request->validate([
    //         'sorting_order_id' => 'required|max:2|unique:subject_types',
    //      'name' => 'required|min:2|max:50|unique:subject_types',
    //         'code' => 'required|max:10|unique:subject_types',
    //      ]);
         
    //     $subject = new SubjectType();
    //     $subject->name = $request->name;
    //     $subject->code = $request->code;
    //     $subject->sorting_order_id = $request->sorting_order_id;
    //     $subject->last_updated_by = $admin;
    //     if ($subject->save()) {
    //         return redirect()->back()->with(['subject'=>'success','message'=>'subject created success ...']);
    //     }
    //     return redirect()->back()->with(['class'=>'error','message'=>'Whoops ! Look like somthing went wrong ..']);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Model\SubjectType  $subjectType
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(SubjectType $subjectType)
    // {
    //     $subjects = subjectType::all();
    //     return view('admin.manage.class.list',compact('subjects','subjectType'));
    // }


    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Model\SubjectType  $subjectType
    //  * @return \Illuminate\Http\Response
    //  */
    
    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $subjects = DB::select(DB::raw("select * from `subject_types` where `id` = $id limit 1;"));
            $subjects = reset($subjects);
        }else { 
            $subjects = ''; 
        }
        return view('admin.subject.subject_edit',compact('subjects'));
    }

    // *
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Model\SubjectType  $subjectType
    //  * @return \Illuminate\Http\Response
    
    public function update(Request $request,$id='')
    {  
        $rules=[
            'name' => 'required|min:2|max:30',
            'code' => 'required|max:10',
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
        $subject_name = MyFuncs::removeSpacialChr($request->name);
        $subject_code = MyFuncs::removeSpacialChr($request->code);
        $subject_order = MyFuncs::removeSpacialChr($request->sorting_order_id);
        
        $rs_update = DB::select(DB::raw("call `up_save_subjects`($id, '$subject_name', '$subject_code', $subject_order, $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `subject_types` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Model\SubjectType  $subjectType
    //  * @return \Illuminate\Http\Response
    //  */
   
    public function pdfGenerate()
    {
        $report_header = "Subjects";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Name',65),
            array('Code',25)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `code` from `subject_types` order by `sorting_order_id`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('subjects.pdf');
       
    }
}
