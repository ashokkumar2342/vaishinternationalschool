<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Helper\MyFuncs;
use Auth;

class StudentSiblingInfoController extends Controller
{
    public function tableShow($student_id)
    { 
        $studentId = Crypt::decrypt($student_id);
        $rs_siblings = DB::select(DB::raw("call `up_get_sibling_info_all`($studentId);"));
        return view('admin.student.studentdetails.include.sibling_info_list',compact('rs_siblings', 'student_id'));                
    }

    public function addForm($student_id)
    {  
        $reg_no_size = MyFuncs::get_reg_no_size();
        return view('admin.student.studentdetails.include.add_sibling_info',compact('student_id', 'reg_no_size'));
    }

    public function store(Request $request, $student_id)
    {
        $rules=[
            'sibling_registration_no' => 'required', 
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }

        $studentId = Crypt::decrypt($student_id);

        $sib_regis_no = MyFuncs::removeSpacialChr($request->sibling_registration_no);
        $rs_fetch = DB::select(DB::raw("select `id` from `students` where `registration_no` = '$sib_regis_no' limit 1;"));
        $sib_id = 0;
        if(count($rs_fetch)>0){
            $sib_id = $rs_fetch[0]->id;
        }

        if($sib_id == 0){
            $response=array();
            $response["status"]=0;
            $response["msg"]='Registration No. Not Valid';
            return response()->json($response);// response as json
        }


        $userId = Auth::guard('admin')->user(); 

        $rs_update = DB::select(DB::raw("call `up_add_sibling_detail`($studentId, $sib_id, $userId->id);"));

        $response=array();
        $response["status"] = $rs_update[0]->status;
        $response["msg"] = $rs_update[0]->result;
        return response()->json($response);// response as json
    }

    public function destroy(Request $request,$student_id)
    {
        $studentId = Crypt::decrypt($student_id);
        $userId = Auth::guard('admin')->user(); 

        $rs_delete = DB::select(DB::raw("call `UP_DeleteSiblingDetail`($studentId, $userId->id);"));
       
        $response=['status'=>$rs_delete[0]->status,'msg'=>$rs_delete[0]->result];
        return response()->json($response);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request, Student $student)
    // {
    //     $rules=[
    //          'student_sibling_id' => 'required',
             
    //      ];
    //      $validator = Validator::make($request->all(),$rules);
    //      if ($validator->fails()) {
    //          $errors = $validator->errors()->all();
    //          $response=array();
    //          $response["status"]=0;
    //          $response["msg"]=$errors[0];
    //          return response()->json($response);// response as json
    //      }
          
    //         $StudentPerentDetail = new StudentPerentDetail();
    //         $StudentAddressDetail = new StudentAddressDetail();
    //         $sibling_student = Student::where('registration_no',$request->student_sibling_id)->first();
    //         if ($sibling_student==null) {
    //            $response=array();
    //            $response["status"]=0;
    //            $response["msg"]='Registration Not Found';
    //            return response()->json($response);// response as json
    //          }
    //         $arrayStudentIdSiblingIds=array(); 
    //         $arrayStudentIdSiblingIds=[$student->id,$sibling_student->id]; 
          

    //         $studentSiblingInfo=SiblingGroup::where('student_id',$student->id)->orWhere('student_id',$sibling_student->id)->first();

    //         $studentSiblingGropId=SiblingGroup::orderBy('group','DESC')->first();

    //         if ($studentSiblingGropId==null) {
    //            foreach ($arrayStudentIdSiblingIds as  $key => $arrayStudentIdSiblingId) {
    //             $sibling =SiblingGroup::firstOrNew(['student_id' =>  $arrayStudentIdSiblingId]);
    //                        $sibling->student_id = $arrayStudentIdSiblingId; 
    //                        $sibling->group =1; 
    //                        $sibling->save(); 
                    
    //                  }
    //         }else{
    //             foreach ($arrayStudentIdSiblingIds as  $key => $arrayStudentIdSiblingId) {
    //             $sibling =SiblingGroup::firstOrNew(['student_id' =>  $arrayStudentIdSiblingId]);
    //                        $sibling->student_id = $arrayStudentIdSiblingId;
    //                        if (!empty($studentSiblingInfo->student_id)) {
    //                          $sibling->group =$studentSiblingInfo->group;
    //                         } 
    //                         if (empty($studentSiblingInfo->student_id)) {
    //                          $sibling->group =$studentSiblingGropId->group+1;
    //                         }   
    //                        $sibling->save(); 
                    
    //                  }
    //         }
             
           
    //        $StudentPerentDetailArrId =$StudentPerentDetail->getParentArrId($student->id,$sibling_student->id);  
    //        $StudentAddressDetailArrId =$StudentAddressDetail->getAddressArrId($student->id,$sibling_student->id);  

    //     $response=array();
    //     $response["status"]=1;
    //     $response["msg"]='Add Successfully';
    //     return response()->json($response);// response as json

 
      
 
        
 
    // }

    // // public function parentDetailsStore($parent_arr_id,$student_arr_id)
    // // {
    // //     foreach ($parent_arr_id as $key => $id) {
            
    // //     }
    // //     $studentParentDetails=StudentPerentDetail::firstOrNew(['relation_id' => $relation_id, 'student_id' => $student_id]);
    // //     $studentParentDetails->student_id=$student_id; 
    // //     $studentParentDetails->perent_info_id=$perent_info_id;
    // //     $studentParentDetails->relation_id=$relation_id;
    // //     $studentParentDetails->save();
    // // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Model\StudentSiblingInfo  $studentSiblingInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Student $student)
    // {
    //      // $data1 = SiblingGroup::find(1)->siblings;
        
    //     $data2 = Student::find($student->id)->siblings;
    //      return $data2;
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Model\StudentSiblingInfo  $studentSiblingInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Request $request,$student_id)
    // {
         
    //     $student=Student::find($student_id);
    //     return  view('admin.student.studentdetails.include.sibling_info_edit',compact('student'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Model\StudentSiblingInfo  $studentSiblingInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request,$student_id)
    // {
    //     $rules=[
           
       
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
    //     $stidents=Student::find($student_id);
    //      $stidents->registration_no=$request->registration_no;
    //      $stidents->name=$request->name;
    //      $stidents->save();
    //     $response=['status'=>1,'msg'=>'Created Successfully'];
    //         return response()->json($response);
    //     } 
         
         
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Model\StudentSiblingInfo  $studentSiblingInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request,$student_id)
    // {
        
    //        $SiblingGroup=SiblingGroup::where('student_id',$student_id)->first();
    //        if ($SiblingGroup!=null) {
    //            $SiblingGroup->delete(); 
    //         }
    //         $StudentAddressDetail=StudentAddressDetail::where('student_id',$student_id)->first();
    //        if ($StudentAddressDetail!=null) { 
    //           $StudentAddressDetail->delete();
    //         }
    //         $StudentAddressDetails=StudentPerentDetail::where('student_id',$student_id)->get();     
    //         if($StudentAddressDetails!=null){
    //         foreach ($StudentAddressDetails as   $StudentAddressDetail) {
    //               $StudentAddressDetail->delete();
    //           }  
    //         }
            
    //        $response=['status'=>1,'msg'=>'Delete Successfully'];
    //         return response()->json($response);

        

    // }
}
