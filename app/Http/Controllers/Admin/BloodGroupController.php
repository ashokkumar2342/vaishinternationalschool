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


class BloodGroupController extends Controller
{
    public function index()
    {
        $rs_bgroup = DB::select(DB::raw("select * from `blood_groups` order by `name`;"));
        return view('admin.master.bloodGroup.list',compact('rs_bgroup'));
    }

    
    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $rs_bgroup = DB::select(DB::raw("select * from `blood_groups` where `id` = $id limit 1;"));
            $rs_bgroup = reset($rs_bgroup);
        }else { 
            $rs_bgroup = ''; 
        }
        return view('admin.master.bloodGroup.edit',compact('rs_bgroup'));
    }


    public function update(Request $request,$id='')
    {  
        $rules=[
            'name' => 'required|max:10',
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
        $bgroup_name = MyFuncs::removeSpacialChr($request->name);
        
        $rs_update = DB::select(DB::raw("call `up_save_blood_group`($id, '$bgroup_name', $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

   

    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `blood_groups` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function pdfGenerate()
    {
        $report_header = "Blood Group List";
        $tcols = 2;
        $qcols = array(
            array('Sr. No.',20),
            array('Blood Group',80)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name` from `blood_groups`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('bloodgroup.pdf');
       
    }
     
}
