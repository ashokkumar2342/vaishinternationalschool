<?php

namespace App\Http\Controllers\Admin\SchoolDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Helper\MyFuncs;


class SchoolDetailsController extends Controller
{
    public function index()
    {
    	return view('schoolDetails.view');
    }
    
    public function tableShow()
    {
        $SchoolDetail = DB::select("select * from `school_details`;");
        $SchoolDetail = reset($SchoolDetail);
        return view('schoolDetails.table_show',compact('SchoolDetail'));
    }

    public function addForm()
    {
        $SchoolDetail = DB::select(DB::raw("select * from `school_details`;"));
        $SchoolDetail = reset($SchoolDetail);
    	return view('schoolDetails.add_form',compact('SchoolDetail'));
    }

    public function store(Request $request)
    {  
        $rules=[
            'name' => 'required|max:100', 
            'mobile' => 'required|digits:10', 
            'contact' => 'required|digits:10',
            'address' => 'required|max:1000',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }

        $school_logo = '';
        if ($request->hasFile('logo')) {
            $logoImage=$request->logo; 
            $filelogo='logo'.date('d-m-Y').time().'.jpg'; 
            $path ='school/logo/';
            $logoImage->storeAs($path,$filelogo);
            $school_logo = $path.$filelogo;
        }

        $school_image = '';
        if ($request->hasFile('image')) {
            $image=$request->image;            
            $filename='image'.date('d-m-Y').time().'.jpg';  
            $path ='school/image/';
            $image->storeAs($path,$filename);    
            $school_image = $path.$filename;
        }   
        
        $userid = Auth::guard('admin')->user()->id;
        $school_name = MyFuncs::removeSpacialChr($request->name);
        $school_mobile = MyFuncs::removeSpacialChr($request->mobile);
        $school_contact = MyFuncs::removeSpacialChr($request->contact);
        $school_address = MyFuncs::removeSpacialChr($request->address);
        $school_header = MyFuncs::removeSpacialChr($request->report_header);
        
        
        
        $rs_update = DB::select(DB::raw("call `up_save_school_detail`('$school_name', '$school_mobile', '$school_contact', '', '$school_address', '$school_logo', '$school_image', '$school_header', $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
         
    }

    public function reportCheck()
    {
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('schoolDetails.logo_header');
        return $pdf->stream('ckeck.pdf');
    }

    public function showlogo($image)
    {
        $path=Crypt::decrypt($image);
        $storagePath = storage_path('app/'.$path);              
        $mimeType = mime_content_type($storagePath); 
        if( ! \File::exists($storagePath)){
            return view('error.home');
        }

        $headers = array(
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; '
        );  

        return \Response::make(file_get_contents($storagePath), 200, $headers);
    }


    // public function quotesindex(){
    //     return view('schoolDetails.quotes.index'); 
    // }

    // public function quotesAddForm(){
    //     return view('schoolDetails.quotes.add_form'); 
    // }
    // public function quotesStore(Request $request)
    // {

    //     $rules=[
          
    //          'date' => 'required', 
    //         'discription' => 'required',
       
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
    //      $userId=Auth::guard('admin')->user()->id;
    //     $Quotes= new Quote(); 
    //     $Quotes->created_by=$userId; 
    //     $Quotes->date=$request->date; 
    //     $Quotes->discription=$request->discription; 
    //     $Quotes->save();
    //     $response=['status'=>1,'msg'=>'Created Successfully'];
    //         return response()->json($response);
        

    //     }  
    // }
    // public function quotesTableShow()
    // {
    //      $Quotes=Quote::all();
    //      return view('schoolDetails.quotes.table_show',compact('Quotes'));
    // }
    // public function quotesEdit($id)
    // {
    //      $Quotes=Quote::find($id);
    //      return view('schoolDetails.quotes.edit',compact('Quotes'));
    // }
    // public function quotesUpdate(Request $request,$id)
    // {

    //     $rules=[
          
    //         'date' => 'required', 
    //         'discription' => 'required', 
            
             
       
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
    //      $userId=Auth::guard('admin')->user()->id;
    //     $Quotes=Quote::find($id); 
    //     $Quotes->created_by=$userId; 
    //     $Quotes->date=$request->date; 
    //     $Quotes->discription=$request->discription; 
    //     $Quotes->save();
    //     $response=['status'=>1,'msg'=>'Update Successfully'];
    //         return response()->json($response);
        

    //     }  
    // }
    // public function quotesDestroy($id){
    //      $Quotes=Quote::find($id); 
    //      $Quotes->delete();
    //      return  redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);
    // }

    
    
}

