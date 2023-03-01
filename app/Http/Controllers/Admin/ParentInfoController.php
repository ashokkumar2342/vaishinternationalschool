<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;
use Auth;
use DB;
use App\Helper\SelectBox;
use App\Helper\MyFuncs;
use Illuminate\Support\Facades\Crypt;

class ParentInfoController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }
    public function perentTable($student_id)
    {
        $studentId = Crypt::decrypt($student_id);
        $rs_parentInfo = DB::select(DB::raw("select `grt`.`name` as `relation`, `pi`.`id`, `pi`.`name`, `pi`.`education`, `pi`.`occupation`, `pf`.`name` as `profession`, `pi`.`income_id`, `ir`.`range` as `income`, `pi`.`mobile`, `pi`.`email`, `pi`.`dob`, `pi`.`doa`, `pi`.`office_address`, `pi`.`photo`, `pi`.`organization_address`, `pi`.`f_designation`, `pi`.`islive` from `student_perent_details` `spd` inner join `guardian_relation_types` `grt` on `grt`.`id` = `spd`.`relation_id` inner join `parents_infos` `pi` on `pi`.`id` = `spd`.`perent_info_id` inner join `professions` `pf` on `pf`.`id` = `pi`.`occupation` inner join `income_ranges` `ir` on `ir`.`id` = `pi`.`income_id` where `spd`.`student_id` = $studentId order by `grt`.`id`;"));
       
        return view('admin.student.studentdetails.include.parents_info_list',compact('rs_parentInfo', 'student_id'));
    }
    public function perentInfoAddForm(Request $request, $student_id)
    {   
        $studentId = Crypt::decrypt($student_id);
        $parentsType = DB::select(DB::raw("select `id`, `name` from `guardian_relation_types` where `id` not in (select `relation_id` from `student_perent_details` where `student_id` = $studentId and `relation_id` in (1,2)) order by `id`;"));
        return view('admin.student.studentdetails.include.add_parents_info',compact('student_id','parentsType'));
    }

    public function parentAddNew(Request $request)
    {     

        $user_id=Auth::guard('admin')->user()->id;

        $professions = SelectBox::getProfessions();
        $incomes = SelectBox::getIncomeSlabType();
        $default = DB::select(DB::raw("select * from `student_default_values` where `user_id` = $user_id limit 1;"));
        return view('admin.student.studentdetails.parent.new',compact('incomes', 'professions','default'));
        
    }

    public function parentSearch(Request $request)
    {  
        $relation_type_id=$request->relation_type_id;
        return view('admin.student.studentdetails.parent.search',compact('relation_type_id'));       
    }

    public function parentSearchPost(Request $request)
    {    
        $relation_type_id= $request->relation_type_id;
        $mobile_no = MyFuncs::removeSpacialChr($request->mobile_no);
        $parentInfos = DB::select(DB::raw("select * from `parents_infos` where `mobile` like '%$mobile_no%' order by `name`;"));
        
        $response=array();                       
        $response["status"]=1;
        $response["data"]=view('admin.student.studentdetails.parent.existing',compact('parentInfos','relation_type_id'))->render();
        return $response; 
    }

    public function store(Request $request)
    {    
        $rules=[
        'name' => 'required', 
        'profession' => 'required',              
        'income' => 'required', 
        'islive' => 'required',  
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();                       
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $user_id = Auth::guard('admin')->user()->id;
        $student_id = Crypt::decrypt($request->student_id);
        $relation_id = $request->relation_type_id;

        $name = MyFuncs::removeSpacialChr($request->name);
        $education = MyFuncs::removeSpacialChr($request->education);
        $profession = $request->profession;
        $income = $request->income;
        $mobile = MyFuncs::removeSpacialChr($request->mobile);
        $email = MyFuncs::removeSpacialChr($request->email);
        $dob = date('Y-m-d',strtotime($request->dob));
        $doa = date('Y-m-d',strtotime($request->doa));
        $organization_address = MyFuncs::removeSpacialChr($request->organization_address);
        $f_designation = MyFuncs::removeSpacialChr($request->f_designation);
        $office_address = MyFuncs::removeSpacialChr($request->office_address);
        $islive = $request->islive;

        $rs_save = DB::select(DB::raw("insert into `parents_infos` (`name`, `education`, `occupation`, `income_id`, `mobile`, `email`, `dob`, `doa`, `organization_address`, `f_designation`, `office_address`, `islive`) values ('$name', '$education', '$profession', '$income', '$mobile', '$email', '$dob', '$doa', '$organization_address', '$f_designation', '$office_address', '$islive');"));
        $rs_fetch = DB::select(DB::raw("select ifnull(max(`id`),0) as `new_id` from `parents_infos` where `name` = '$name' and `mobile` = '$mobile';"));

        $new_id = $rs_fetch[0]->new_id;
        $rs_save = DB::select(DB::raw("call `UP_AddStudentParent`($student_id, $new_id, $relation_id, $user_id);"));

        // $this->parentDetailsStore($request->student_id,$parentsinfo_id,$request->relation_type_id);
        $response=['status'=>1,'msg'=>'Parent Information Save Successfully'];
        return response()->json($response); 
    }

    public function edit(Request $request, $parent_id)
    {
        $parent_id = Crypt::decrypt($parent_id);
        $parentsInfo = DB::select(DB::raw("select * from `parents_infos` where `id` = $parent_id"));
        $professions = SelectBox::getProfessions();
        $incomes = SelectBox::getIncomeSlabType(); 
        return view('admin.student.studentdetails.include.parents_info_edit',compact('parentsInfo','professions','incomes'));
    }

    public function update(Request $request,$parent_id)
    {   
        $rules=[
        'name' => 'required',  
        'profession' => 'required',              
        'income' => 'required',  
        'islive' => 'required', 
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();                       
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $parent_id = Crypt::decrypt($parent_id);
        $name = MyFuncs::removeSpacialChr($request->name);
        $education = MyFuncs::removeSpacialChr($request->education);
        $profession = $request->profession;
        $income = $request->income;
        $mobile = MyFuncs::removeSpacialChr($request->mobile);
        $email = MyFuncs::removeSpacialChr($request->email);
        $dob = date('Y-m-d',strtotime($request->dob));
        $doa = date('Y-m-d',strtotime($request->doa));
        $organization_address = MyFuncs::removeSpacialChr($request->organization_address);
        $f_designation = MyFuncs::removeSpacialChr($request->f_designation);
        $office_address = MyFuncs::removeSpacialChr($request->office_address);
        $islive = $request->islive;

        $rs_save = DB::select(DB::raw("update `parents_infos` set `name`='$name', `education`='$education', `occupation`='$profession', `income_id`='$income', `mobile`='$mobile', `email`='$email', `dob`='$dob', `doa`='$doa', `organization_address`='$organization_address', `f_designation`='$f_designation', `office_address`='$office_address', `islive`='$islive' where `id`=$parent_id"));
        
        $response=['status'=>1,'msg'=>'Parent Information Update Successfully'];
         return response()->json($response); 
    }

    public function destroy(Request $request, $parent_id, $student_id)
    {
        $user_id = Auth::guard('admin')->user()->id;
        $parent_id = Crypt::decrypt($parent_id);
        $student_id = Crypt::decrypt($student_id);
        $rs_delete = DB::select(DB::raw("call `UP_DeleteStudentParent`($student_id, $parent_id, $user_id)"));
        
        $response=['status'=>1,'msg'=>'Delete Successfully'];
        return response()->json($response);
    }

    
    public function parentExistingStore(Request $request)
    {   
        $user_id = Auth::guard('admin')->user()->id;
        $student_id = Crypt::decrypt($request->student_id);
        $perent_info_id = $request->perent_info_id;
        $relation_id = $request->relation_id;
        $rs_save = DB::select(DB::raw("call `UP_AddStudentParent`($student_id, $perent_info_id, $relation_id, $user_id);"));
       
        $response=['status'=>1,'msg'=>'Created Successfully'];
        return response()->json($response);
    }

    public function image(Request $request,$id)
    {
        $parent_id=$id;
        return view('admin.student.studentdetails.include.add_parents_image',compact('parent_id'));
        
    }
    public function imageStore(Request $request,$parent_id)
    {  
        $rules=[
            'image' => 'required', 
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();                       
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }  
         
        $data = $request->image; 
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= $parent_id.'.jpg';       
        $path = Storage_path() . "/app/parent/profile/" . $image_name; 
        @mkdir(Storage_path() . "/app/parent/profile/", 0755, true);  
        file_put_contents($path, $data); 
        $rs_update = DB::select(DB::raw("update `parents_infos` set `photo` ='$image_name' where `id` = $parent_id"));  
        
        return response()->json(['success'=>'done']); 
    }

    public function imageShow($photo)
    { 
        $storagePath = storage_path('app/parent/profile/'.$photo);              
        $mimeType = mime_content_type($storagePath); 
        if( ! \File::exists($storagePath)){

            return view('error.home');
        }
        $headers = array(
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; '
        ); 
        if($photo==null)
        {
             ob_end_clean(); // discards the contents of the topmost output buffer
            return Response::make(file_get_contents('profile-img/user.png'), 200, $headers);
        }
        else
        {   ob_end_clean(); // discards the contents of the topmost output buffer
            return Response::make(file_get_contents($storagePath), 200, $headers);

        }  
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function image(Request $request,$id)
    // {
    //       $parent_id=$id;
    //       return view('admin.student.studentdetails.include.add_parents_image',compact('parent_id'));
        
    // }
    // public function imageStore(Request $request,$parent_id)
    // { 
       
    //      $rules=[
    //         'image' => 'required',

              
    //     ];

    //    $validator = Validator::make($request->all(),$rules);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors()->all();
    //         $response=array();                       
    //         $response["status"]=0;
    //         $response["msg"]=$errors[0];
    //         return response()->json($response);// response as json
    //     } 
       
    //         // $profilePhoto=$request->image;
    //         // $filename='parent'.date('d-m-Y').time().'.jpg'; 
    //         // $path ='student/profile/parent/';
    //         // $profilePhoto->storeAs($path,$filename); 
    //         // $parentsinfo=ParentsInfo::find($request->parent_id); 
    //         // $parentsinfo->photo=$path.$filename; 
    //         // $parentsinfo->save(); 
    //         // $response=['status'=>1,'msg'=>'Upload Successfully'];
    //         // return response()->json($response); 

    //         $parentsinfo=ParentsInfo::find($parent_id); 
    //         $data = $request->image; 
    //         list($type, $data) = explode(';', $data);
    //         list(, $data)      = explode(',', $data);
    //         $data = base64_decode($data);
    //         $image_name= time().'.jpg';       
    //         $path = Storage_path() . "/app/student/profile/parent/" . $image_name; 
    //         $pathSave = "student/profile/parent/" . $image_name; 
    //         @mkdir(Storage_path() . "/app/student/profile/parent/", 0755, true);     
    //         file_put_contents($path, $data); 
    //         $parentsinfo->photo = $pathSave;
    //         $parentsinfo->save();
    //         return response()->json(['success'=>'done']);
      

        
    // }
    // public function imageShow($id)
    // { 
    //             $parent=ParentsInfo::find($id);

    //             $storagePath = storage_path('app/'.$parent->photo);              
    //             $mimeType = mime_content_type($storagePath); 
    //             if( ! \File::exists($storagePath)){

    //                 return view('error.home');
    //             }
    //             $headers = array(
    //                 'Content-Type' => $mimeType,
    //                 'Content-Disposition' => 'inline; '
    //             );
                  
    //             if($parent->photo==null)
    //             {
    //                  ob_end_clean(); // discards the contents of the topmost output buffer
    //                 return Response::make(file_get_contents('profile-img/user.png'), 200, $headers);
    //             }
    //             else
    //             {   ob_end_clean(); // discards the contents of the topmost output buffer
    //                 return Response::make(file_get_contents($storagePath), 200, $headers);

    //             } 

    // }

        
    //       public function imageRefresh($parent_id)
    //       {
    //            return view('admin.student.studentdetails.include.parents_image_refresh',compact('parent_id'));
    //       }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {    
    //     $rules=[
    //     'name' => 'required',               
             
        
    //     'profession' => 'required',              
    //     'income' => 'required',              
           
    //     'islive' => 'required',              
                   
        
    //     ];

    //     $validator = Validator::make($request->all(),$rules);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors()->all();
    //         $response=array();                       
    //         $response["status"]=0;
    //         $response["msg"]=$errors[0];
    //         return response()->json($response);// response as json
    //     } 
    //     $parentsinfo = new ParentsInfo(); 
    //     $parentsinfo->name = $request->name; 
    //     $parentsinfo->education = $request->education;
    //     $parentsinfo->occupation = $request->profession;
    //     $parentsinfo->income_id = $request->income;
    //     $parentsinfo->mobile = $request->mobile;
    //     $parentsinfo->email = $request->email;
    //     $parentsinfo->dob = $request->dob == null ? $request->dob : date('Y-m-d',strtotime($request->dob));
    //     $parentsinfo->doa = $request->doa == null ? $request->doa : date('Y-m-d',strtotime($request->doa));
    //     $parentsinfo->organization_address = $request->organization_address;
    //     $parentsinfo->f_designation = $request->f_designation;
    //     $parentsinfo->office_address = $request->office_address;
    //     $parentsinfo->islive = $request->islive;
    //     $parentsinfo->save();
    //     $parentsinfo_id= $parentsinfo->id;

       
    //     $this->parentDetailsStore($request->student_id,$parentsinfo_id,$request->relation_type_id);
    //      $response=['status'=>1,'msg'=>'Parent Information Save Successfully'];
    //     return response()->json($response); 
    // }
    // //parentDetailsStore
    // public function parentDetailsStore($student_id,$perent_info_id,$relation_id)
    // {   
    //    $StudentSiblingInfo = new SiblingGroup();
    //    $StudentSiblingArrId =$StudentSiblingInfo->getStudentSiblingArrId($student_id);
    //    if (!empty($StudentSiblingArrId)) {
    //      foreach ($StudentSiblingArrId as $key => $student_id) {
    //        $studentParentDetails=StudentPerentDetail::firstOrNew(['relation_id' => $relation_id, 'student_id' => $student_id]);
    //        $studentParentDetails->student_id=$student_id; 
    //        $studentParentDetails->perent_info_id=$perent_info_id;
    //        $studentParentDetails->relation_id=$relation_id;
    //        $studentParentDetails->save();
          
    //      }
    //    }else{
    //     $studentParentDetails=StudentPerentDetail::firstOrNew(['relation_id' => $relation_id, 'student_id' => $student_id]);
    //     $studentParentDetails->student_id=$student_id; 
    //     $studentParentDetails->perent_info_id=$perent_info_id;
    //     $studentParentDetails->relation_id=$relation_id;
    //     $studentParentDetails->save();
      
    //    }

      
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Model\ParentsInfo  $parentsInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(ParentsInfo $parentsInfo)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Model\ParentsInfo  $parentsInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Request $request,$id)
    // {
    //     $parentsInfo = ParentsInfo::find($id);
    //      $parentsType= array_pluck(GuardianRelationType::get(['id','name'])->toArray(),'name', 'id'); 
    //     $professions = array_pluck(Profession::orderBy('name','ASC')->get(['id','name'])->toArray(),'name', 'id'); 
    //     $incomes = array_pluck(IncomeRange::orderBy('code','ASC')->get(['id','range'])->toArray(),'range', 'id');
    //     $student=$request->id;
    //       return view('admin.student.studentdetails.include.parents_info_edit',compact('student','parentsType','incomes','documentTypes','isoptionals','sessions','subjectTypes','bloodgroups','professions','parentsInfo'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Model\ParentsInfo  $parentsInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request,$id)
    // {   
    //     $rules=[
    //    'name' => 'required',               
             
    //     'profession' => 'required',              
    //     'income' => 'required',              
          
    //     'islive' => 'required',              
        
    //     ];

    //     $validator = Validator::make($request->all(),$rules);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors()->all();
    //         $response=array();                       
    //         $response["status"]=0;
    //         $response["msg"]=$errors[0];
    //         return response()->json($response);// response as json
    //     }
         
          

    //     $parentsinfo = ParentsInfo::find($id);
    //     $parentsinfo->name = $request->name; 
    //     $parentsinfo->education = $request->education;
    //     $parentsinfo->occupation = $request->profession;
    //     $parentsinfo->income_id = $request->income;
    //     $parentsinfo->mobile = $request->mobile;
    //     $parentsinfo->email = $request->email;
    //     $parentsinfo->dob = $request->dob == null ? $request->dob : date('Y-m-d',strtotime($request->dob));
    //     $parentsinfo->doa = $request->doa == null ? $request->doa : date('Y-m-d',strtotime($request->doa));
    //     $parentsinfo->organization_address = $request->organization_address;
    //     $parentsinfo->f_designation = $request->f_designation;
    //     $parentsinfo->office_address = $request->office_address;
    //     $parentsinfo->islive = $request->islive;   
    //     $parentsinfo->save();
    //     $response=['status'=>1,'msg'=>'Parent Information Update Successfully'];
    //      return response()->json($response); 
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Model\ParentsInfo  $parentsInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request,$id)
    // {
        
    //      $studentParentDetails=StudentPerentDetail::where('perent_info_id',$id)->get();
    //      foreach ($studentParentDetails as $studentParentDetail) {
    //               $studentParentDetail->delete();
    //      }
    //      $parents = ParentsInfo::find($id); 
    //      $parents->delete(); 
    //      $response=['status'=>1,'msg'=>'Delete Successfully'];
    //      return response()->json($response);
    // }

    
    // public function parentAddNew(Request $request)
    // {     $user_id=Auth::guard('admin')->user()->id;
    //       $student=$request->id;
    //      $parentsType= array_pluck(GuardianRelationType::get(['id','name'])->toArray(),'name', 'id'); 
    //     $professions = array_pluck(Profession::orderBy('name','ASC')->get(['id','name'])->toArray(),'name', 'id'); 
    //     $incomes = array_pluck(IncomeRange::orderBy('code','ASC')->get(['id','range'])->toArray(),'range', 'id'); 
    //     $default = StudentDefaultValue::where('user_id',$user_id)->first(); 
    //       return view('admin.student.studentdetails.parent.new',compact('student','parentsType','incomes','documentTypes','isoptionals','sessions','subjectTypes','bloodgroups','professions','default'));
        
    // }
    // public function parentSearch(Request $request)
    // {  
    //       $relation_type_id=$request->relation_type_id;
    //       return view('admin.student.studentdetails.parent.search',compact('relation_type_id'));
        
    // }
    // public function parentSearchPost(Request $request)
    // {    $relation_type_id= $request->relation_type_id;
    //         $parentInfos = ParentsInfo::where('mobile', 'like', '%' . $request->mobile_no . '%')->get(); 
    //         $response=array();                       
    //         $response["status"]=1;
    //         $response["data"]=view('admin.student.studentdetails.parent.existing',compact('parentInfos','relation_type_id'))->render();
    //         return $response;
        
    // }
   
    // public function parentExistingStore(Request $request)
    // {    
       
    //      $studentParentDetails=StudentPerentDetail::firstOrNew(['relation_id' => $request->relation_id, 'student_id' => $request->student_id]);
    //     $studentParentDetails->student_id=$request->student_id; 
    //     $studentParentDetails->perent_info_id=$request->perent_info_id;
    //     $studentParentDetails->relation_id=$request->relation_id;
    //     $studentParentDetails->save();
    //     $response=['status'=>1,'msg'=>'Created Successfully'];
    //         return response()->json($response);
          
        
        
    // }
}
