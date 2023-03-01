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

class ClassTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = DB::select(DB::raw("select * from `class_types` order by `shorting_id`"));
        return view('admin.manage.class.list',compact('classes'));
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
    // public function search(Request $request)
    // {
    //     $classFee = ClassFee::where('class_fees.session_id',$request->id)->join('class_types','class_types.id','=','class_fees.class_id')->get(['class_types.id','class_types.name','class_types.alias']);
    //     return response()->json($classFee);
    // }
   
    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
         
    //     $admin=Auth::guard('admin')->user()->id;
    //     $this->validate($request,[
    //         'name' => 'required|max:20|unique:class_types',
    //         'code' => 'required|max:5|unique:class_types,alias',
    //         'shorting_id' => 'required|max:2|unique:class_types',
    //         ]);
    //     $class = new ClassType();
    //     $class->name = $request->name;
    //     $class->alias = $request->code;
    //     $class->shorting_id = $request->shorting_id;
    //     $class->last_updated_by = $admin;
    //     if ($class->save()) {
    //         return redirect()->back()->with(['class'=>'success','message'=>'Class created success ...']);
    //     }
    //     return redirect()->back()->with(['class'=>'error','message'=>'Whoops ! Look like somthing went wrong ..']);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\ClassType  $classType
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(ClassType $classType)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\ClassType  $classType
    //  * @return \Illuminate\Http\Response
    //  */
    
    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $classes = DB::select(DB::raw("select * from `class_types` where `id` = $id limit 1;"));
            $classes = reset($classes);
        }else { 
            $classes = ''; 
        }
        return view('admin.manage.class.edit',compact('classes'));
    }

    // *
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\ClassType  $classType
    //  * @return \Illuminate\Http\Response
     
    public function update(Request $request,$id='')
    {  
        $rules=[
            'name' => 'required|max:20',
            'code' => 'required|max:5',
            'shorting_id' => 'required|max:2',
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
        $class_name = MyFuncs::removeSpacialChr($request->name);
        $class_code = MyFuncs::removeSpacialChr($request->code);
        $class_order = MyFuncs::removeSpacialChr($request->shorting_id);
        
        $rs_update = DB::select(DB::raw("call `up_save_classes`($id, '$class_name', '$class_code', $class_order, $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\ClassType  $classType
    //  * @return \Illuminate\Http\Response
    //  */
    public function deleteclass($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `class_types` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }


    public function pdfGenerate()
    { 
        $report_header = "Classes";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Name',65),
            array('Code',25)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `alias` from `class_types` order by `shorting_id`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('class.pdf');         
    }
}
