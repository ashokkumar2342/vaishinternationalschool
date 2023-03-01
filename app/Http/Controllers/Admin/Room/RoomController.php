<?php

namespace App\Http\Controllers\Admin\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Helper\MyFuncs;


class RoomController extends Controller
{
    public function index(){
    	$roomTypes = DB::select(DB::raw("select * from `room_types` order by `name`;"));
        return view('admin.room.view',compact('roomTypes'));
    }

    // public function store(Request $request){
    //   $admin=Auth::guard('admin')->user()->id;
    // 	$rules=[
    	  
    //         'room_name' => 'required|max:50|unique:room_types,name',
    //         'location' => 'required', 
             
       
    // 	];

    // 	$validator = Validator::make($request->all(),$rules);
    // 	if ($validator->fails()) {
    // 	    $errors = $validator->errors()->all();
    // 	    $response=array();
    // 	    $response["status"]=0;
    // 	    $response["msg"]=$errors[0];
    // 	    return response()->json($response);// response as json
    // 	}
    //     else {
    //      $roomType=new RoomType();
    //      $roomType->name=$request->room_name;
    //      $roomType->location=$request->location;
    //      $roomType->last_updated_by=$admin;
    //      $roomType->save();
    //      $response=['status'=>1,'msg'=>'Created Successfully'];
    //         return response()->json($response);
    //     } 
    // }

    public function edit($id='0')
    {
        if ($id!='0') {
            $id = Crypt::decrypt($id);
            $roomTypes = DB::select(DB::raw("select * from `room_types` where `id` = $id limit 1;"));
            $roomTypes = reset($roomTypes);
        }else { 
            $roomTypes = ''; 
        }
        return view('admin.room.edit',compact('roomTypes'));
    }

    
    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `room_types` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }

    public function update(Request $request,$id='')
    {  
        $rules=[
            'room_name' => 'required|max:50',
            'location' => 'max:100',
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
        $room_name = MyFuncs::removeSpacialChr($request->room_name);
        $room_location = MyFuncs::removeSpacialChr($request->location);
        
        $rs_update = DB::select(DB::raw("call `up_save_rooms`($id, '$room_name', '$room_location', $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

     
    public function pdfGenerate()
    {
        $report_header = "Rooms List";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Name',45),
            array('Location',45)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `location` from `room_types`;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('rooms.pdf');
       
    }
}
