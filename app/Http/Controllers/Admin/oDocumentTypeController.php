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

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
      $documentTypes = DB::select(DB::raw("select * from `document_types` order by `name`;"));
      return view('admin.master.document.list',compact('documentTypes'));
    }

  //   /**
  //    * Show the form for creating a new resource.
  //    *
  //    * @return \Illuminate\Http\Response
  //    */
  
  public function edit($id='0')
  {
    if ($id!='0') {
      $id = Crypt::decrypt($id);
      $document = DB::select(DB::raw("select * from `document_types` where `id` = $id limit 1;"));
      $document = reset($document);
    }else { 
        $document = ''; 
    }
    return view('admin.master.document.edit',compact('document'));
  }

  public function update(Request $request,$id='')
  {  
    $rules=[
      'documentType' => 'required|max:50',
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
    $document_name = MyFuncs::removeSpacialChr($request->documentType);
    $document_code = MyFuncs::removeSpacialChr($request->code);
    
    $rs_update = DB::select(DB::raw("call `up_save_document_type`($id, '$document_name', '$document_code', $userid);"));

    $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
    return response()->json($response);
       
  }


  //   /**
  //    * Store a newly created resource in storage.
  //    *
  //    * @param  \Illuminate\Http\Request  $request
  //    * @return \Illuminate\Http\Response
  //    */
  //   public function store(Request $request)
  //   {
  //        $admin=Auth::guard('admin')->user()->id;
  //        $rules=[
  //      'name' => 'required|string|min:2|max:50|unique:document_types', 
  //       'code' => 'required|min:2|max:5|unique:document_types',
  //       ];

  //       $validator = Validator::make($request->all(),$rules);
  //       if ($validator->fails()) {
  //           $errors = $validator->errors()->all();
  //           $response=array();
  //           $response["status"]=0;
  //           $response["msg"]=$errors[0];
  //           return response()->json($response);// response as json
  //       }
       
             
  //       $document = new DocumentType();
  //       $document->name = $request->name; 
  //       $document->code = $request->code; 
  //       $document->last_updated_by = $admin; 
  //       $document->save();  
  //       $response['msg'] = 'Account created Successfully';
  //       $response['status'] = 1;
  //       return response()->json($response); 
  //   }
  //    public function search(Request $request)
  //   {
  //       $academic = AcademicYear::find($request->academic_year_id);

  //       return response()->json(['start_date'=>date('d-m-Y',strtotime($academic->start_date)),'end_date'=>date('d-m-Y',strtotime($academic->end_date))]);
  //   }

  //   /**
  //    * Display the specified resource.
  //    *
  //    * @param  \App\Model\AcademicYear  $academicYear
  //    * @return \Illuminate\Http\Response
  //    */
  

  //   /**
  //    * Show the form for editing the specified resource.
  //    *
  //    * @param  \App\Model\AcademicYear  $academicYear
  //    * @return \Illuminate\Http\Response
  //    */
    

  //   /**
  //    * Remove the specified resource from storage.
  //    *
  //    * @param  \App\Model\AcademicYear  $academicYear
  //    * @return \Illuminate\Http\Response
  //    */
  
  public function destroy($id)
  {  
    $id =Crypt::decrypt($id);
    $rs_update = DB::select(DB::raw("delete from `document_types` where `id` = $id;"));
    
    return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
  }

  public function pdfGenerate()
  {
    $report_header = "Documents List";
    $tcols = 3;
    $qcols = array(
      array('Sr. No.',10),
      array('Name',65),
      array('Code',25)
    );

    $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, `code` from `document_types`;");
    $pdf=PDF::setOptions([
      'logOutputFile' => storage_path('logs/log.htm'),
      'tempDir' => storage_path('logs/')
    ])
    ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
    return $pdf->stream('documentType.pdf');
     
  }

}
