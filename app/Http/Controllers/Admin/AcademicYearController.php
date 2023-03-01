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
class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academicYears = DB::select(DB::raw("select * from `academic_years` order by `start_date` desc;"));
        return view('admin.master.academicyear.list',compact('academicYears'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $admin=Auth::guard('admin')->user()->id;
    //     $validator = Validator::make($request->all(), [
        
    //         'name' => 'required|max:30|unique:academic_years',
    //         'start_date' => 'required', 
    //         'end_date' => 'required', 
    //     ]);
    //     if ($validator->fails()) {                    
    //          return response()->json(['errors'=>$validator->errors()->all(),'class'=>'error']); 

    //     }
    //    $academicYears = new AcademicYear();
    //    $academicYears->name = $request->name;
    //    $academicYears->start_date = date('Y-m-d',strtotime($request->start_date)) ;
    //    $academicYears->end_date = date('Y-m-d',strtotime($request->end_date));
    //    $academicYears->description = $request->description; 
    //    $academicYears->last_updated_by = $admin; 
    //    $academicYears->save();
    //    return response()->json([$academicYears,'class'=>'success','message'=>'Academic Year Created Successfully']);
    // }

    public function edit($id='')
    {   

        if ($id!='') {
            $id = Crypt::decrypt($id);
            $academicYear = DB::select(DB::raw("select * from `academic_years` where `id` = $id limit 1;"));
            $academicYear = reset($academicYear);
        }else { 
            $academicYear = ''; 
        }
        return view('admin.master.academicyear.edit',compact('academicYear'));    
    }

    public function update(Request $request,$id='')
    { 
        // $admin=Auth::guard('admin')->user()->id; 
        // dd($request);
        $id =Crypt::decrypt($id);

        $rules=[
          
            'name' => 'required',
            'start_date' => 'required', 
            'end_date' => 'required', 
       
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
        $year_name = MyFuncs::removeSpacialChr($request->name);
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $year_desc = MyFuncs::removeSpacialChr($request->description);
        
        $rs_update = DB::select(DB::raw("call `up_save_academic_year`($id, '$year_name', '$start_date', '$end_date', '$year_desc', $userid);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
        
       
    }


    // public function search(Request $request)
    // {
    //     $academic = AcademicYear::find($request->academic_year_id);

    //     return response()->json(['start_date'=>date('d-m-Y',strtotime($academic->start_date)),'end_date'=>date('d-m-Y',strtotime($academic->end_date))]);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Model\AcademicYear  $academicYear
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(AcademicYear $academicYear)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Model\AcademicYear  $academicYear
    //  * @return \Illuminate\Http\Response
    //  */
     

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Model\AcademicYear  $academicYear
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {  
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("delete from `academic_years` where `id` = $id;"));
        
        return  redirect()->back()->with(['message'=>'Deleted Successfully','class'=>'success']);
    }
    
    public function defaultValue($id)
    {
        $id =Crypt::decrypt($id);
        $rs_update = DB::select(DB::raw("call `up_set_default_academic_year`($id);"));

        // $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return  redirect()->back()->with(['message'=>'Default Value Set Successfully','class'=>'success']);
    }
    
    public function pdfGenerate()
    {
        $report_header = "Academic Years";
        $tcols = 5;
        $qcols = array(
            array('Sr. No.',10),
            array('Name',25),
            array('From Date',15),
            array('To Date',15),
            array('Description',35)
        );

        $rs_result = DB::select("select @srno := ifnull(@srno,0) + 1 AS `row_num`, `name`, date_format(`start_date`, '%d-%m-%Y') as `from_date`, date_format(`end_date`, '%d-%m-%Y') as `to_date`, `description` from `academic_years` order by `start_date` desc;");
        $pdf=PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.report.general.report',compact('rs_result', 'report_header', 'tcols', 'qcols'));
        return $pdf->stream('academicYear.pdf');
    }
}
