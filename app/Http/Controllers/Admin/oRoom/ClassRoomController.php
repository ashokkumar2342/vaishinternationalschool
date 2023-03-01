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

class ClassRoomController extends Controller
{
    public function index()
    {
        
        $userid = Auth::guard('admin')->user()->id;
     	$classWiseRooms = DB::select(DB::raw("select `clr`.`id`, concat(`clt`.`name`, ' - ', `sec`.`name`) as `class_name`, `room`.`name` as `room_name` from `class_wise_rooms` `clr` inner join `class_types` `clt` on `clt`.`id` = `clr`.`class_id` inner join `section_types` `sec` on `sec`.`id` = `clr`.`section_id` inner join `room_types` `room` on `room`.`id` = `clr`.`room_id` where `clt`.`id` in (select distinct `class_id` from `user_class_types` where `admin_id` = $userid) order by `clt`.`shorting_id`, `sec`.`sorting_order_id`"));
        
    	$classTypes=MyFuncs::getClasses();
    	return view('admin.room.classWiseRoom.class_wise_room_view',compact('classTypes','classWiseRooms'));
    }

    public function reFrash($value='')
    {
        $roomTypes = DB::select(DB::raw("select * from `room_types` where `id` not in (select `room_id` from `class_wise_rooms`) order by `name`;"));
        
        return view('admin.room.classWiseRoom.room_select_box',compact('roomTypes'));
    }

    public function store(Request $request){
        // dd($request);
        $rules=[
            'room_id' => 'required',
            'class_id' => 'required',
            'section' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }

        $userid = Auth::guard('admin')->user()->id;
        $class_id = $request->class_id;
        $section_id = $request->section;
        $room_id = $request->room_id;
        
        $rs_update = DB::select(DB::raw("call `up_save_class_rooms`($class_id, $section_id, $room_id, $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
    }

    // public function edit($id){
    	 
    // 	$roomTypes=RoomType::all();
    // 	$classTypes=MyFuncs::getClassByHasUser();
    //     $classWiseRoomSaveId=ClassWiseRoom::pluck('room_id')->toArray();
    //   $classWiseRooms=ClassWiseRoom::findOrFail(Crypt::decrypt($id));
    // return view('admin.room.classWiseRoom.class_wise_room_edit',compact('classWiseRooms','roomTypes','classTypes','classWiseRoomSaveId'));
    // }
    
    public function destroy($id)
    {
    	$id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `class_wise_rooms` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);

    }

    public function pdfGenerate()
    {
        $report_header = "Class - Section - Room";
        $tcols = 3;
        $qcols = array(
            array('Sr. No.',10),
            array('Class - Section',45),
            array('Room No./Name',45)
        );

        $userid = Auth::guard('admin')->user()->id;
        $rs_result = DB::select(DB::raw("select @srno := ifnull(@srno,0) + 1 AS `row_num`, concat(`clt`.`name`, ' - ', `sec`.`name`) as `class_name`, `room`.`name` as `room_name` from `class_wise_rooms` `clr` inner join `class_types` `clt` on `clt`.`id` = `clr`.`class_id` inner join `section_types` `sec` on `sec`.`id` = `clr`.`section_id` inner join `room_types` `room` on `room`.`id` = `clr`.`room_id` where `clt`.`id` in (select distinct `class_id` from `user_class_types` where `admin_id` = $userid)"));

        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('classRooms.pdf');
       
    }
    //  public function update(Request $request,$id){
    //      $admin=Auth::guard('admin')->user()->id;
    // 	$rules=[
    	  
    //         'room_name' => 'required', 
             
       
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
    //           $classWiseRoom= ClassWiseRoom::where('class_id',$request->class_id)
    //                                     ->where('section_id',$request->section_id)->first();
    //        if ($classWiseRoom!=null) {
    //           $response=['status'=>0,'msg'=>'Already Existing'];
    //           return response()->json($response);  
    //        }
    //      $classWiseRooms= ClassWiseRoom::find($id);
    //      $classWiseRooms->class_id=$request->class_id;
    //      $classWiseRooms->section_id=$request->section_id;
    //      $classWiseRooms->room_id=$request->room_name;
    //      $classWiseRooms->last_updated_by=$admin;
    //      $classWiseRooms->save();
    //      $response=['status'=>1,'msg'=>'Update Successfully'];
    //         return response()->json($response);
    //     } 
    // }

    //  public function report($value='')
    // {
    //     $classWiseRooms=ClassWiseRoom::orderBy('class_id','ASC')->orderBy('section_id','ASC')->get();
    //     $pdf=PDF::setOptions([
    //         'logOutputFile' => storage_path('logs/log.htm'),
    //         'tempDir' => storage_path('logs/')
    //     ])
    //     ->loadView('admin.room.classWiseRoom.class_wise_room_pdf',compact('classWiseRooms'));
    //     return $pdf->stream('class_wise_room.pdf');
    // }

    // //---------------Sublect-Wisw-Room----------------------------------------------------------------------------------

    // public function subjectWiseRoom(){
    //     $subjectTypes=SubjectType::all();
    //     $roomTypes=RoomType::all();
    //     $subjectWiseRooms=SubjectWiseRoom::all();
    //      return view('admin.room.subjectWiseRoom.view',compact('subjectTypes','roomTypes','subjectWiseRooms'));
    // }

    //  public function subjectWiseRoomStore(Request $request){
    //      $admin=Auth::guard('admin')->user()->id;
    //     $rules=[
          
    //         'subject' => 'required', 
    //         'room' => 'required', 
             
       
    //     ];

    //     $validator = Validator::make($request->all(),$rules);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors()->all();
    //         $response=array();
    //         $response["status"]=0;
    //         $response["msg"]=$errors[0];
    //         return response()->json($response);// response as json
    //     }
    //     else {
    //      $subjectWiseRoom=new SubjectWiseRoom();
    //      $subjectWiseRoom->subject_id=$request->subject;
    //      $subjectWiseRoom->room_id=$request->room;
    //      $subjectWiseRoom->last_updated_by=$admin;
    //      $subjectWiseRoom->save();
    //      $response=['status'=>1,'msg'=>'Create Successfully'];
    //         return response()->json($response);
    //     } 
         
    // }
    // public function Delete($id)
    // {
    //    $subjectWiseRoom= SubjectWiseRoom::findOrFail(Crypt::decrypt($id));
    //    $subjectWiseRoom->delete();
    //    return redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);

    // }
}
