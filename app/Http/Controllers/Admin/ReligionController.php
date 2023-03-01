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


class ReligionController extends Controller
{
    public function index()
    {
        $rs_religion = DB::select(DB::raw("select * from `religions` order by `name`;"));
        return view('admin.master.religion.list',compact('rs_religion'));
    }

    
    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $rs_religion = DB::select(DB::raw("select * from `religions` where `id` = $id limit 1;"));
            $rs_religion = reset($rs_religion);
        }else { 
            $rs_religion = ''; 
        }
        return view('admin.master.religion.edit',compact('rs_religion'));
    }


    public function update(Request $request,$id='')
    {  
        $rules=[
            'name' => 'required|max:50',
            'code' => 'required|max:2',
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
        $religion_name = MyFuncs::removeSpacialChr($request->name);
        $religion_code = MyFuncs::removeSpacialChr($request->code);
        
        $rs_update = DB::select(DB::raw("call `up_save_religion`($id, '$religion_name', '$religion_code', $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

   

    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `religions` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function pdfGenerate()
    {
        $report_header = "Religions List";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Religion Name',65),
            array('Code',25)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `code` from `religions`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('religions.pdf');
       
    }
     
}
