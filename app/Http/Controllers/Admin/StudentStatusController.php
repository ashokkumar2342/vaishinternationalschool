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


class StudentStatusController extends Controller
{
    public function index()
    {
        $rs_status = DB::select(DB::raw("select * from `student_statuses` order by `name`;"));
        return view('admin.master.studentStatus.list',compact('rs_status'));
    }

    
    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $rs_status = DB::select(DB::raw("select * from `student_statuses` where `id` = $id limit 1;"));
            $rs_status = reset($rs_status);
        }else { 
            $rs_status = ''; 
        }
        return view('admin.master.studentStatus.edit',compact('rs_status'));
    }


    public function update(Request $request,$id='')
    {  
        $rules=[
            'name' => 'required|max:50',
            'code' => 'required|max:5',
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
        $stu_status_name = MyFuncs::removeSpacialChr($request->name);
        $stu_status_code = MyFuncs::removeSpacialChr($request->code);
        
        $rs_update = DB::select(DB::raw("call `up_save_student_status_master`($id, '$stu_status_name', '$stu_status_code', $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

   

    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `student_statuses` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function pdfGenerate()
    {
        $report_header = "Student Status List";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Student Status',65),
            array('Code',25)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `code` from `student_statuses`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('student_status.pdf');
       
    }
     
}
