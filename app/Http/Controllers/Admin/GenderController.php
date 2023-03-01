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

class GenderController extends Controller
{
    public function index()
    {
        $genders = DB::select(DB::raw("select * from `genders` order by `genders`;"));
        return view('admin.gender.list',compact('genders'));
    }

    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $genders = DB::select(DB::raw("select * from `genders` where `id` = $id limit 1;"));
            $genders = reset($genders);
        }else { 
            $genders = ''; 
        }
        return view('admin.gender.edit',compact('genders'));
    }

    public function update(Request $request,$id='')
    {  
        $rules=[
            'gender_name' => 'required|max:20',
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
        $gender_name = MyFuncs::removeSpacialChr($request->gender_name);
        $gender_code = MyFuncs::removeSpacialChr($request->code);
        
        $rs_update = DB::select(DB::raw("call `up_save_genders`($id, '$gender_name', '$gender_code', $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `genders` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function pdfGenerate()
    {
        $report_header = "Genders List";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Gender Name',65),
            array('Code',25)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `genders`, `code` from `genders`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('guardian.pdf');
       
    }

   // public function index()
   //  {
   //    $genders=Gender::orderBy('genders','ASC')->get(); 
   //   return view('admin.gender.gender',compact('genders'));    
   //  }
   //  public function addForm($id='')
   //  {
   //     if ($id!='') {
   //     	 $genders=Gender::find($id);
   //     }
   //     if ($id=='') {
   //     	 $genders='';
   //     }
   //   return view('admin.gender.add_form',compact('genders'));    
   //  }
   //  public function store(Request $request,$id=null)
   //  { 
   //  	 $rules=[
    	  
   //          'gender_name' => 'required|max:20|unique:genders,genders'.$id, 
   //          'code' => 'required|max:2|unique:genders,code'.$id, 
             
       
   //  	];

   //  	$validator = Validator::make($request->all(),$rules);
   //  	if ($validator->fails()) {
   //  	    $errors = $validator->errors()->all();
   //  	    $response=array();
   //  	    $response["status"]=0;
   //  	    $response["msg"]=$errors[0];
   //  	    return response()->json($response);// response as json
   //  	}
   //      else {
   //  	$Gender=Gender::firstOrNew(['id'=>$id]);
   //  	$Gender->genders=$request->gender_name;
   //  	$Gender->code=$request->code; 
   //  	$Gender->save();
   //  	$response=['status'=>1,'msg'=>'Created Successfully'];
   //          return response()->json($response);
   //      }
   //  }
   //  public function destroy($id)
   //  {
   //  	$genders=Gender::find($id);
   //  	$genders->delete();
   //  	return redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);
   //  }
   //  public function report($value='')
   //     {
   //      $genders=Gender::orderBy('genders','ASC')->get();
   //      $pdf=PDF::setOptions([
   //          'logOutputFile' => storage_path('logs/log.htm'),
   //          'tempDir' => storage_path('logs/')
   //      ])
   //      ->loadView('admin.gender.pdf',compact('genders'));
   //      return $pdf->stream('room.pdf');
   //      }
}
