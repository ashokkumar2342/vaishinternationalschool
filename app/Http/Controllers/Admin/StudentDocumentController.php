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
use Response;

class StudentDocumentController extends Controller
{
    
    public function index($student_id)
    {   
        $studentId = Crypt::decrypt($student_id);
        $documents = DB::select(DB::raw("select `doc`.`id`, `doc`.`document_url`, `doct`.`name` from `documents` `doc` inner join `document_types` `doct` on `doct`.`id` = `doc`.`document_type_id` where `doc`.`student_id` = $studentId order by `doct`.`code`;"));
        return view('admin.student.studentdetails.include.document_list',compact('student_id', 'documents'));
    }

    public function addForm($student_id)
    {   
        $documrnt_types = SelectBox::getDocumentType(); 
        return view('admin.student.studentdetails.include.add_document',compact('documrnt_types', 'student_id'));
    }

    
    public function store(Request $request, $student_id)
    {   
        $rules=[
        'document_type_id' => 'required',
        "document" => "required|mimes:pdf|max:10000",
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
        $document_type_id=$request->document_type_id;
        $attachment=$request->document;
        $filename=$studentId.'_'.date('d-m-Y').time().'.pdf'; 
        $attachment->storeAs('student/document/',$filename);

        $rs_save = DB::select(DB::raw("insert into `documents`(`student_id`, `document_type_id`, `name`, `document_url`) values ($studentId, $document_type_id, '', '$filename')"));

        $response=['status'=>1,'msg'=>'Upload Document Successfully'];
        return response()->json($response);
    }

    public function download($document_id)
    {   
        $document_id = Crypt::decrypt($document_id);
        $documents = DB::select(DB::raw("select * from `documents` where `id` = $document_id limit 1"));
        $path= storage_path('app/student/document/'.$documents[0]->document_url);
        return Response::download($path);
       
         
    }

    public function destroy($document_id)
    {
        $document_id = Crypt::decrypt($document_id);
        $documents = DB::select(DB::raw("delete from `documents` where `id` = $document_id limit 1"));
        $response=['status'=>1,'msg'=>'Delete Successfully'];
        return response()->json($response);
    }

   
    // public function verify($document_id)
    // {
    //     $document=Document::find($document_id);
    //     $document->status=1;
    //     $document->save();
    //     $response=['status'=>1,'msg'=>'Verified Successfully'];
    //     return response()->json($response);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Document  $document
     * @return \Illuminate\Http\Response
     */
    // public function reject($document_id)
    // {
    //     return view('admin.student.studentdetails.documentverify.reject',compact('document_id'));
    // }
    // public function rejectStore(Request $request)
    // {
    //     $document=Document::find($request->document_id);
    //     $document->remark=$request->remark;
    //     $document->status=0;
    //     $document->save();
    //     $response=['status'=>1,'msg'=>'Reject Successfully'];
    //     return response()->json($response);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Document  $document
     * @return \Illuminate\Http\Response
     */
    
    
}
