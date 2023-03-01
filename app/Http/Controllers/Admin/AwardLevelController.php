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

class AwardLevelController extends Controller
{

  public function index()
  {
    $rs_award = DB::select(DB::raw("select * from `award_levels` order by `name`;"));
    return view('admin.award.awardLevel.list',compact('rs_award'));
  }

  public function edit($id='0')
  {
    if ($id!='0') {
      $id = Crypt::decrypt($id);
      $rs_award = DB::select(DB::raw("select * from `award_levels` where `id` = $id limit 1;"));
      $rs_award = reset($rs_award);
    }else { 
      $rs_award = ''; 
    }
    return view('admin.award.awardLevel.edit',compact('rs_award'));
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
    $award_name = MyFuncs::removeSpacialChr($request->name);
    $award_code = MyFuncs::removeSpacialChr($request->code);
    
    $rs_update = DB::select(DB::raw("call `up_save_award_level`($id, '$award_name', '$award_code', $userid);"));

    $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
    return response()->json($response);
       
  }

  public function destroy($id)
  {  
    $id =Crypt::decrypt($id);
    $rs_update = DB::select(DB::raw("delete from `award_levels` where `id` = $id;"));
    
    return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
  }

  public function pdfGenerate()
  {
    $report_header = "Award Levels List";
    $tcols = 3;
    $qcols = array(
      array('Sr. No.',10),
      array('Award Level',65),
      array('Code',25)
    );

    $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `code` from `award_levels`;");
    $pdf=PDF::setOptions([
      'logOutputFile' => storage_path('logs/log.htm'),
      'tempDir' => storage_path('logs/')
    ])
    ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
    return $pdf->stream('awardLevel.pdf');
     
  }


  
   // public function addForm($id=null)
   // {
   	
   //   if ($id!=null) {
   //   	     $id=Crypt::decrypt($id);
   //           $awardLevel= AwardLevel::find($id); 
   //      }else{
   //          $awardLevel=null;
   //      } 
   	  
   // 	 return view('admin.award.awardLevel.add_form',compact('awardLevel'));
   // }
   // public function store(Request $request ,$id=null)
   // {
   	 
   // 	 $rules=[
    	  
   //          'award_level' => 'required|max:50|unique:award_levels,name,'.$id, 
   //          'code' => 'required|max:5|unique:award_levels,code,'.$id, 
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
   //  	$awardLevel= AwardLevel::firstOrNew(['id'=>$id]); 
   //  	$awardLevel->name=$request->award_level; 
   //    $awardLevel->code=$request->code; 
   //  	$awardLevel->save();
   //  	$response=['status'=>1,'msg'=>'Submit Successfully'];
   //          return response()->json($response);
   //      }
   // }
   // public function list()
   // { $awardLevels= AwardLevel::orderBy('id','ASC')->get(); 
   // 	 return view('admin.award.awardLevel.list',compact('awardLevels'));
   // }
   // public function destroy($id)
   // {
   // 	$id=Crypt::decrypt($id);
   //  $awardLevel= AwardLevel::find($id);
   //  $awardLevel->delete();
   //  return redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);
   // }
   // public function report($value='')
   //  {
   //       $awardLevels= AwardLevel::orderBy('id','ASC')->get();
   //      $pdf=PDF::setOptions([
   //          'logOutputFile' => storage_path('logs/log.htm'),
   //          'tempDir' => storage_path('logs/')
   //      ])
   //      ->loadView('admin.award.awardLevel.pdf',compact('awardLevels'));
   //      return $pdf->stream('room.pdf');
   //  }
}
