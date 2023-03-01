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


class IncomeSlabController extends Controller
{
    public function index()
    {
        $incomeSlabs = DB::select(DB::raw("select * from `income_ranges` order by `code`;"));
        return view('admin.master.income_slab.list',compact('incomeSlabs'));
    }

    
    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $incomeRange = DB::select(DB::raw("select * from `income_ranges` where `id` = $id limit 1;"));
            $incomeRange = reset($incomeRange);
        }else { 
            $incomeRange = ''; 
        }
        return view('admin.master.income_slab.edit',compact('incomeRange'));
    }


    public function update(Request $request,$id='')
    {  
        $rules=[
            'range' => 'required|max:30',
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
        $income_name = MyFuncs::removeSpacialChr($request->range);
        $income_code = MyFuncs::removeSpacialChr($request->code);
        
        $rs_update = DB::select(DB::raw("call `up_save_income_ranges`($id, '$income_name', '$income_code', $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

   

    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `income_ranges` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function pdfGenerate()
    {
        $report_header = "Income Slabs";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Income Slab',65),
            array('Code',25)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `range`, `code` from `income_ranges`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('incomeSlabs.pdf');
       
    }
     
}
