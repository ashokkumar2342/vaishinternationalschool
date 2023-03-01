<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Helper\MyFuncs;
use App\Helper\SelectBox;
use Auth;

class StudentMedicalInfoController extends Controller
{
    public function medicalInfoList($student_id)
    {
        $studentId = Crypt::decrypt($student_id);
        $rs_addresses = DB::select(DB::raw("select `smi`.`id`, `smi`.`ondate`, `smi`.`bloodgroup_id`, `bg`.`name` as `blood_group`, `smi`.`hb`, `smi`.`weight`, `smi`.`height`, `smi`.`narration`, `smi`.`vision`, `smi`.`complextion`, `cmp`.`name` as `complextion_name`, `smi`.`isalgeric`, `smi`.`alergey`, `smi`.`alergey_vacc`, `smi`.`ishandicapped`, `smi`.`handi_percent`, `smi`.`physical_handicapped`, `smi`.`id_marks1`, `smi`.`id_marks2`, `smi`.`dental`, `smi`.`bp_lower`, `smi`.`bp_uper` from `student_medical_infos` `smi` left join `blood_groups` `bg` on `bg`.`id` = `smi`.`bloodgroup_id` left join `complextions` `cmp` on `cmp`.`id` = `smi`.`complextion` where `smi`.`student_id` = $studentId order by `smi`.`ondate` desc;"));
        return view('admin.student.studentdetails.include.medical_info_list',compact('studentId', 'rs_addresses'));

    }

    public function medicalInfoAddForm(Request $request, $student_id)
    {
        $studentId = Crypt::decrypt($student_id);
        $student = DB::select(DB::raw("call `up_get_StudentDetail`($studentId);"));
        $Bloodgroups = SelectBox::getBloodgroups(); 
        $complextions = SelectBox::getComplextions(); 
         
        return view('admin.student.studentdetails.include.add_medical_info',compact('student', 'Bloodgroups', 'complextions'));
    }

    public function store(Request $request, $student_id)
    {  
        $rules=[
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
        $smi_id = Crypt::decrypt($request->smi_id);
        $ondate = $request->ondate;

        $insert_fields = "insert into `student_medical_infos` (`student_id`, `ondate`";
        $insert_values = "values (".$studentId.", '".$ondate."'";

        $update_query = "update `student_medical_infos` set `ondate` = '$ondate'";
        if(!empty($request->bloodgroup_id)){
            $bloodgroup_id = $request->bloodgroup_id;
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `bloodgroup_id`";
                $insert_values = $insert_values.", ".$bloodgroup_id;
            }else{
                $update_query = $update_query.", `bloodgroup_id` = ".$bloodgroup_id;
            }
        }
        if(!empty($request->hb)){
            $hb = MyFuncs::removeSpacialChr($request->hb);
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `hb`";
                $insert_values = $insert_values.", ".$hb;
            }else{
                $update_query = $update_query.", `hb` = ".$hb;
            }
        }
        if(!empty($request->bp_lower)){
            $bp_lower = MyFuncs::removeSpacialChr($request->bp_lower);
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `bp_lower`";
                $insert_values = $insert_values.", ".$bp_lower;
            }else{
                $update_query = $update_query.", `bp_lower` = ".$bp_lower;
            }
        }
        if(!empty($request->bp_uper)){
            $bp_uper = MyFuncs::removeSpacialChr($request->bp_uper);
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `bp_uper`";
                $insert_values = $insert_values.", ".$bp_uper;
            }else{
                $update_query = $update_query.", `bp_uper` = ".$bp_uper;
            }
        }
        if(!empty($request->height)){
            $height = MyFuncs::removeSpacialChr($request->height);
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `height`";
                $insert_values = $insert_values.", ".$height;
            }else{
                $update_query = $update_query.", `height` = ".$height;
            }
        }
        if(!empty($request->weight)){
            $weight = MyFuncs::removeSpacialChr($request->weight);
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `weight`";
                $insert_values = $insert_values.", ".$weight;
            }else{
                $update_query = $update_query.", `weight` = ".$weight;
            }
        }
        if(!empty($request->vision)){
            $vision = "'".MyFuncs::removeSpacialChr($request->vision)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `vision`";
                $insert_values = $insert_values.", ".$vision;
            }else{
                $update_query = $update_query.", `vision` = ".$vision;
            }
        }
        if(!empty($request->complextion)){
            $complextion = $request->complextion;
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `complextion`";
                $insert_values = $insert_values.", ".$complextion;
            }else{
                $update_query = $update_query.", `complextion` = ".$complextion;
            }
        }
        if(!empty($request->id_marks1)){
            $id_marks1 = "'".MyFuncs::removeSpacialChr($request->id_marks1)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `id_marks1`";
                $insert_values = $insert_values.", ".$id_marks1;
            }else{
                $update_query = $update_query.", `id_marks1` = ".$id_marks1;
            }
        }
        if(!empty($request->id_marks2)){
            $id_marks2 = "'".MyFuncs::removeSpacialChr($request->id_marks2)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `id_marks2`";
                $insert_values = $insert_values.", ".$id_marks2;
            }else{
                $update_query = $update_query.", `id_marks2` = ".$id_marks2;
            }
        }
        if(!empty($request->dental)){
            $dental = "'".MyFuncs::removeSpacialChr($request->dental)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `dental`";
                $insert_values = $insert_values.", ".$dental;
            }else{
                $update_query = $update_query.", `dental` = ".$dental;
            }
        }
        if(!empty($request->alergey)){
            $alergey = $request->alergey;
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `isalgeric`";
                $insert_values = $insert_values.", ".$alergey;
            }else{
                $update_query = $update_query.", `isalgeric` = ".$alergey;
            }
        }
        if(!empty($request->alergey_desc)){
            $alergey_desc = "'".MyFuncs::removeSpacialChr($request->alergey_desc)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `alergey`";
                $insert_values = $insert_values.", ".$alergey_desc;
            }else{
                $update_query = $update_query.", `alergey` = ".$alergey_desc;
            }
        }
        if(!empty($request->alergey_vacc)){
            $alergey_vacc = "'".MyFuncs::removeSpacialChr($request->alergey_vacc)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `alergey_vacc`";
                $insert_values = $insert_values.", ".$alergey_vacc;
            }else{
                $update_query = $update_query.", `alergey_vacc` = ".$alergey_vacc;
            }
        }
        if(!empty($request->physical_handicapped)){
            $physical_handicapped = $request->physical_handicapped;
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `ishandicapped`";
                $insert_values = $insert_values.", ".$physical_handicapped;
            }else{
                $update_query = $update_query.", `ishandicapped` = ".$physical_handicapped;
            }
        }
        if(!empty($request->handicapped_parcent)){
            $handicapped_parcent = "'".MyFuncs::removeSpacialChr($request->handicapped_parcent)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `handi_percent`";
                $insert_values = $insert_values.", ".$handicapped_parcent;
            }else{
                $update_query = $update_query.", `handi_percent` = ".$handicapped_parcent;
            }
        }
        if(!empty($request->handicapped_desc)){
            $handicapped_desc = "'".MyFuncs::removeSpacialChr($request->handicapped_desc)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `physical_handicapped`";
                $insert_values = $insert_values.", ".$handicapped_desc;
            }else{
                $update_query = $update_query.", `physical_handicapped` = ".$handicapped_desc;
            }
        }
        if(!empty($request->narration)){
            $narration = "'".MyFuncs::removeSpacialChr($request->narration)."'";
            if (empty($smi_id)){
                $insert_fields = $insert_fields.", `narration`";
                $insert_values = $insert_values.", ".$narration;
            }else{
                $update_query = $update_query.", `narration` = ".$narration;
            }
        }

        $insert_fields = $insert_fields.") ";
        $insert_values = $insert_values.") ";
        $update_query = $update_query." where `id` = ".$smi_id;
        
        if (empty($smi_id)) {
            $rs_update = DB::select(DB::raw("$insert_fields $insert_values"));
        }else{
            $rs_update = DB::select(DB::raw("$update_query"));
        }
        
        // if ($request->send_sms==1) {
        // $this->medicalSendSms($request->student_id); 
        // }
        // if ($request->send_email==2) {
        // return  $this->medicalSendEmail($request->student_id);
        // }
       
        $response=['status'=>1,'msg'=>'Created Successfully'];
        return response()->json($response);          

    }

    public function edit(Request $request, $id)
    {
        $smi_id = Crypt::decrypt($id);
        $smi_result = DB::select(DB::raw("select * from `student_medical_infos` where `id` = $smi_id limit 1"));
        $studentId = $smi_result[0]->student_id;
        $student = DB::select(DB::raw("call `up_get_StudentDetail`($studentId);"));
        $Bloodgroups = SelectBox::getBloodgroups(); 
        $complextions = SelectBox::getComplextions(); 
         
        return view('admin.student.studentdetails.include.add_medical_info',compact('student', 'Bloodgroups', 'complextions', 'smi_result'));
    }

    public function destroy($id)
    {
        $smi_id = Crypt::decrypt($id);
        $rs_delete = DB::select(DB::raw("delete from `student_medical_infos` where `id` = $smi_id limit 1"));
        $response=['status'=>1,'msg'=>'Delete Successfully'];
        return response()->json($response);
    }


    // public function medicalSendSms($student_id)
    // { 
    //     $user_id=Auth::guard('admin')->user()->id;
    //      $st=new Student();
    //      $student=$st->getStudentDetailsById($student_id);
    //      $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->medical_message_id; 
    //      $smsTemplate = SmsTemplate::where('id',$messageId)->first()->message;

    //     $findword = ["#SN#", "#FN#", "#MN#"];
    //     $replaceword   = [$student->name, $student->parents[0]->parentInfo->name, $student->parents[1]->parentInfo->name];

    //      $message = str_replace($findword, $replaceword, $smsTemplate); 
    //      event(new SmsEvent($student->addressDetails->address->primary_mobile,$message)); 
    //     return  redirect()->back()->with(['message'=>'Send  Successfully','class'=>'success']);   
         
        
    // }
    // public function medicalSendEmail($student_id)
    // {
    //     $medicalInfo =StudentMedicalInfo::where('student_id',$student_id)->orderBy('id','DESC')->first();
    //     $st=new Student();
    //      $student=$st->getStudentDetailsById($student_id);
    //      $documentUrl = Storage_path() . '/app/student/medical/';
    //      @mkdir($documentUrl, 0755, true);
    //      $pdf = PDF::loadView('admin.student.studentdetails.include.medical_send_email',compact('medicalInfo'))->save($documentUrl.'/'.$student->registration_no.'_medical.pdf'); 
    //      $url =$documentUrl.$student->registration_no.'_medical.pdf';
    //         $message =$medicalInfo;         
    //         $emailto = $student->addressDetails->address->primary_email;         
    //         $subject = 'Medical Details'; 
    //         $up_u=array(); 
    //         $up_u['medicalInfo']=$message;
    //         $up_u['subject']=$subject;
         
    //     $mailHelper =new MailHelper(); 
    //     $mailHelper->mailsendwithattachment('emails.message',$up_u,'No-Reply',$subject,$emailto,'noreply@esgekool.com',5,$url);
    //    $response=['status'=>1,'msg'=>'Send  Successfully'];
    //         return response()->json($response);
    // }
    // public function templateView($id)
    // { 
    //      $user_id=Auth::guard('admin')->user()->id;
    //      if ($id==1) {
    //        $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->birthday_message_id; 
    //        $emailId=StudentDefaultValue::where('user_id',$user_id)->first()->birthday_email_id; 
    //      }
    //      elseif ($id==2) {
    //        $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->homework_message_id; 
    //        $emailId=StudentDefaultValue::where('user_id',$user_id)->first()->homework_email_id; 
    //      }
    //      elseif ($id==3) {
    //        $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->classTest_message_id; 
    //        $emailId=StudentDefaultValue::where('user_id',$user_id)->first()->classTest_email_id; 
    //      }
    //      elseif ($id==4) {
    //        $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->class_test_details_message_id; 
    //        $emailId=StudentDefaultValue::where('user_id',$user_id)->first()->class_test_details_email_id; 
    //      }
    //      elseif ($id==5) {
    //        $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->timetable_message_id; 
    //        $emailId=StudentDefaultValue::where('user_id',$user_id)->first()->timetable_email_id; 
    //      }
    //      elseif ($id==6) {
    //        $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->medical_message_id; 
    //        $emailId=StudentDefaultValue::where('user_id',$user_id)->first()->medical_email_id; 
    //      }
    //      elseif ($id==7) {
    //        $messageId=StudentDefaultValue::where('user_id',$user_id)->first()->absent_student_message_id; 
    //        $emailId=StudentDefaultValue::where('user_id',$user_id)->first()->absent_student_email_id; 
    //      } 
    //      $SMStemplateView=SmsTemplate::where('id',$messageId)->first();
    //      $EmailtemplateView=EmailTemplate::where('id',$emailId)->first();
    //      return view('admin.sms.smsTemplate.template_view',compact('SMStemplateView','EmailtemplateView'));
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Model\StudentMedicalInfo  $studentMedicalInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {    
    //      $studentMedicalInfo=StudentMedicalInfo::find($id);
    //     return view('admin.student.studentdetails.include.medical_info_view',compact('studentMedicalInfo'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Model\StudentMedicalInfo  $studentMedicalInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Request $request, $id)
    // {
    //     $medicalInfo = StudentMedicalInfo::find($id);
    //      $student=$request->id; 
    //      $parentsType = array_pluck(GuardianRelationType::get(['id','name'])->toArray(),'name','id');
    //     $incomes = array_pluck(IncomeRange::get(['id','range'])->toArray(),'range', 'id');
    //     $documentTypes = array_pluck(DocumentType::get(['id','name'])->toArray(),'name', 'id');
    //     $subjectTypes = array_pluck(SubjectType::get(['id','name'])->toArray(),'name', 'id');
    //     $isoptionals = array_pluck(Isoptional::get(['id','name'])->toArray(),'name', 'id');
    //     $bloodgroups = array_pluck(BloodGroup::orderBy('name','ASC')->get(['id','name'])->toArray(),'name', 'id');
    //     $professions = array_pluck(Profession::get(['id','name'])->toArray(),'name', 'id');
    //     $complextions=Complextion::orderBy('name','ASC')->get();  
    //    return view('admin.student.studentdetails.include.medical_info_edit',compact('student','parentsType','incomes','documentTypes','isoptionals','sessions','subjectTypes','bloodgroups','complextions','medicalInfo'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Model\StudentMedicalInfo  $studentMedicalInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request,$id)
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
    //     $medical =StudentMedicalInfo::find($id);
    //     $medical->isalgeric = $request->alergey; 
    //     $medical->alergey = $request->isalgeric;
    //     $medical->alergey_vacc = $request->alergey_vacc;
    //     $medical->bp_lower = $request->bp_lower;
    //     $medical->bp_uper = $request->bp_uper;
    //     $medical->bloodgroup_id = $request->bloodgroup_id;
    //     $medical->complextion = $request->complextion;
    //     $medical->dental = $request->dental;
    //     $medical->hb = $request->hb;
    //     $medical->height = $request->height;
    //     $medical->id_marks1 = $request->id_marks1;
    //     $medical->id_marks2 = $request->id_marks2;
    //     $medical->narration = $request->narration;
    //     $medical->ondate = $request->ondate == null ? $request->ondate : date('Y-m-d',strtotime($request->ondate));
    //     $medical->physical_handicapped = $request->ishandicapped;
    //     $medical->ishandicapped = $request->physical_handicapped; 
    //     $medical->handi_percent = $request->parcent; 
         
    //     $medical->vision = $request->vision;
    //     $medical->weight = $request->weight; 
        
    //    $medical->save();
    //     $response=['status'=>1,'msg'=>'Update Successfully'];
    //         return response()->json($response);
    //     }  

    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Model\StudentMedicalInfo  $studentMedicalInfo
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request,$id)
    // {
    //       $medicalInfo = StudentMedicalInfo::find($id);
           

    //      $medicalInfo->delete();

         
    //     $response=['status'=>1,'msg'=>'Update Successfully'];
    //         return response()->json($response);
    // }

    
    
    

    // public function pdfGenerate($student_id)
    // {

         
    //        $medicalInfos = StudentMedicalInfo::where('student_id',$student_id)->get(); 
    //        if (1==1) {
    //         $pdf = PDF::setOptions([
    //         'logOutputFile' => storage_path('logs/log.htm'),
    //         'tempDir' => storage_path('logs/')
    //     ])
    //     ->loadView('admin.student.studentdetails.include.medical_info_pdf_generate',compact('medicalInfos','student_id'));
    //             return  $pdf->stream('student_medical.pdf');
    //         }else{   
    //            $pdf = PDF::setOptions([
    //         'logOutputFile' => storage_path('logs/log.htm'),
    //         'tempDir' => storage_path('logs/')
    //     ])
    //     ->loadView('admin.student.studentdetails.include.medical_info_pdf_generate_blank',compact('medicalInfos'));
    //            return  $pdf->stream('student_medical.pdf');
    //           }    
            

          

            
           
          
    // }
    // public function studentMedicalAdd($value='')
    // {
    //     $st= new Student();
    //     $student=$st->getAllStudents();
    //     $schoolinfo=Schoolinfo::first()->reg_length;
    //    return view('admin.student.studentdetails.studentMedical.view',compact('student','schoolinfo'));  
    // }
    // public function studentShow(Request $request)
    // {   
    //     $user_id=Auth::guard('admin')->user()->id;
    //     $student_id=Student::where('registration_no',$request->registration_no)->first();
    //     $students=DB::select(DB::raw("call up_get_parentDetail($student_id->id)"));
         
    //     $default = StudentDefaultValue::where('user_id',$user_id)->first(); 
    //     $bloodgroups = array_pluck(BloodGroup::orderBy('name','ASC')->get(['id','name'])->toArray(),'name', 'id'); 
    //     $complextions=Complextion::orderBy('name','ASC')->get();
        
       
    //    return view('admin.student.studentdetails.studentMedical.student_list',compact('students','bloodgroups','default','complextions','student_id'));
    // }
}
