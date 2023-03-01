<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Model\CertificateType;
use App\Model\Hr\Employee;
use App\Model\IssueAuthortyType;
use App\Model\SignatureStamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;
use App\Helper\SelectBox;

class SignatureStampController extends Controller
{

  public function index()
  {
    $CertificateTypes = SelectBox::getCertificateTypes();
    $IssueAthortiTypes = SelectBox::getIssuingAuthorityType();  
  	return view('admin.master.signature.view',compact('CertificateTypes','IssueAthortiTypes'));  
  }

  public function tableShow(Request $request)
  { 
    $signatureStamps=SignatureStamp::where('certificate_type_id',$request->certificate_type)->where('authority_type_id',$request->authority_type)->get();
    $response=array();
    $response["status"]=1;
    $response["data"]=view('admin.master.signature.table_show',compact('signatureStamps'))->render();   
    return $response;
     
  }


    // public function addForm($id=null)
    // {
    //     if ($id==null) {
    //         $signatureStamps='';
    //     }elseif ($id!=null) {
    //     $signatureStamps=SignatureStamp::find(Crypt::decrypt($id));
    //     }
    // 	$Employees=Employee::orderBy('name','ASC')->get();
    //     $CertificateTypes=CertificateType::orderBy('name','ASC')->get();
    //     $IssueAthortiTypes=IssueAuthortyType::orderBy('name','ASC')->get();
    // 	return view('admin.master.signature.add_form',compact('Employees','CertificateTypes','IssueAthortiTypes','signatureStamps')); 
    // }
    
    //  public function store(Request $request,$id=null)
    // {  

    //   if ($id==null) {
    //    $rules=[ 
    //         'employee' => 'required', 
    //         'designation' => 'required', 
    //         'certificate_type' => 'required', 
    //         'authority_type' => 'required', 
    //         'from_date' => 'required',  
            
    //     ];
    //   }else{
    //    $rules=[  
    //         'designation' => 'required', 
           
    //     ]; 
    //   }
    	 

    //     $validator = Validator::make($request->all(),$rules);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors()->all();
    //         $response=array();
    //         $response["status"]=0;
    //         $response["msg"]=$errors[0];
    //         return response()->json($response);// response as json
    //     }
    //     else {
    //             $signatureStamp=  SignatureStamp::firstOrNew(['id'=>$id]);  
    //             $signatureStamp->to_date=$request->to_date;
    //             $signatureStamp->Designation=$request->designation;
    //             if ($id==null) {
    //             $signatureStamp->certificate_type_id=$request->certificate_type;
    //             $signatureStamp->emp_id=$request->employee; 
    //             $signatureStamp->authority_type_id=$request->authority_type;
    //             $signatureStamp->from_date=$request->from_date;
    //             $signatureStamp->status=0; 
    //             }
    //       if ($request->hasFile('signature')) { 
    //             $signature=$request->signature;
    //             $filename=$request->student_id.'signature'.date('d-m-Y').time(); 
    //             $signature->storeAs('student/signaturestamp/',$filename);
    //             $signatureStamp->signature=$filename; 
    //       }
    //       if ($request->hasFile('stamp')) { 
    //             $stamp=$request->stamp;
    //             $filename=$request->student_id.'stamp'.date('d-m-Y').time(); 
    //             $stamp->storeAs('student/signaturestamp/',$filename);
    //             $signatureStamp->stamp=$filename; 
    //       } 
    //            $signatureStamp->save();
    //            $response=['status'=>1,'msg'=>'Submit Successfully'];
    //            return response()->json($response);   
            
    //      }
    // }
    // public function status($id)
    // {
    //       $SignatureStampsss =SignatureStamp::find($id); 
    //       $SignatureStamps =SignatureStamp::where('authority_type_id',$SignatureStampsss->authority_type_id)->where('certificate_type_id',$SignatureStampsss->certificate_type_id)->get(); 
    //       foreach ($SignatureStamps as  $value) {
    //          $SignatureStamp =SignatureStamp::find($value->id);
    //          $SignatureStamp->status=0;
    //          $SignatureStamp->save(); 
    //       }
    //       $Signature =SignatureStamp::find($id); 
    //       $Signature->status=1;
    //       $Signature->save();
    //    $response=['status'=>1,'msg'=>'Change Successfully'];
    //      return response()->json($response);
    // }
    // public function report($value='')
    // {
    //     $CertificateTypes=CertificateType::orderBy('name','ASC')->get();
    //     $IssueAthortiTypes=IssueAuthortyType::orderBy('name','ASC')->get();
    //     return view('admin.master.signature.report',compact('CertificateTypes','IssueAthortiTypes')); 
    // }
    // public function reportGenerate(Request $request)
    // {    $rules=[ 
    //         'certificate_type' => 'required', 
    //         'authority_type' => 'required', 
    //         'report_type' => 'required',  
    //     ];
    //     $validator = Validator::make($request->all(),$rules);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors()->all();
    //         $response=array();
    //         $response["status"]=0;
    //         $response["msg"]=$errors[0];
    //         return response()->json($response);// response as json
    //     }
    //     $report_type=$request->report_type;
    //     $signatureStamps= DB::select(DB::raw("call up_report_certificateAuthority ('$request->report_type','$request->certificate_type','$request->authority_type')")); 
    //     $pdf=PDF::setOptions([
    //         'logOutputFile' => storage_path('logs/log.htm'),
    //         'tempDir' => storage_path('logs/')
    //     ])
    //     ->loadView('admin.master.signature.report_generate',compact('signatureStamps','report_type'));
    //     return $pdf->stream('signature_stamps.pdf');
        
    // }
}
