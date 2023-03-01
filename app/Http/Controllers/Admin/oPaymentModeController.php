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

class PaymentModeController extends Controller
{
    public function index()
    {
        $paymentmodes = DB::select(DB::raw("select * from `payment_modes` order by `sorting_order_id`;"));
    	return view('admin.master.paymentmode.list',compact('paymentmodes'));
    }

    // public function store(Request $request)
    // {

    //    $admin=Auth::guard('admin')->user()->id;
    //     $validator = Validator::make($request->all(), [
        
    //        'name' => 'required|min:2|max:30|unique:payment_modes',
    //        'sorting_order_id' => 'required|max:2',  
    //     ]);
    //     if ($validator->fails()) {                    
    //          return response()->json(['errors'=>$validator->errors()->all(),'class'=>'error']);  
    //     }
         
    //    $paymentmode = new PaymentMode();
    //    $paymentmode->name = $request->name; 
    //    $paymentmode->sorting_order_id = $request->sorting_order_id;        
    //    $paymentmode->last_updated_by=$admin; 

    //    $paymentmode->save();
    //    return response()->json([$paymentmode,'class'=>'success','message'=>'Payment Mode Created Successfully']);
    // }

    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $paymentMode = DB::select(DB::raw("select * from `payment_modes` where `id` = $id limit 1;"));
            $paymentMode = reset($paymentMode);
        }else { 
            $paymentMode = ''; 
        }
        return view('admin.master.paymentmode.edit',compact('paymentMode'));
    }

    
    public function update(Request $request,$id='')
    {  
        $rules=[
            'name' => 'required|max:30',
            'code' => 'required|max:2',
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
        $pm_name = MyFuncs::removeSpacialChr($request->name);
        $pm_code = MyFuncs::removeSpacialChr($request->code);
        $pm_order = MyFuncs::removeSpacialChr($request->sorting_order_id);
        
        $rs_update = DB::select(DB::raw("call `up_save_payment_mode`($id, '$pm_name', '$pm_code', $pm_order, $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `payment_modes` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function pdfGenerate()
    {
        $report_header = "Payment Modes";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Name',65),
            array('Code',25)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `code` from `payment_modes` order by `sorting_order_id`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('paymentModes.pdf');
       
    }
   
}
