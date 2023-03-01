<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Helper\SelectBox;
use Illuminate\Support\Facades\Crypt;
use App\Helper\MyFuncs;

class StudentAddressDetailController extends Controller
{
	
  public function address($student_id)
  {   
    
    $rs_addresses = DB::select(DB::raw("select `sad`.`id`, `adr`.`id`, `adr`.`primary_mobile`, `adr`.`primary_email`, `adr`.`category_id`, `adr`.`religion_id`, `adr`.`state`, `adr`.`city`, `adr`.`p_address`, `adr`.`c_address`, `adr`.`p_pincode`, `adr`.`c_pincode`, `adr`.`nationality`, `cat`.`name` as `category`, `rgn`.`name` as `religion` from `student_address_details` `sad` inner join `addresses` `adr` on `adr`.`id` = `sad`.`student_address_details_id` left join `categories` `cat` on `cat`.`id` = `adr`.`category_id` left join `religions` `rgn` on `rgn`.`id` = `adr`.`religion_id` where `sad`.`student_id` = $student_id;"));

    return view('admin.student.studentdetails.parent.address_list',compact('student_id','rs_addresses'));   
  }
 //    public function addAddress(Request $request,$student_id)
 //    {
        
 //        $cotegorys=Category::orderBy('name','ASC')->get();
 //        $religions=Religion::orderBy('name','ASC')->get(); 
 //        return view('admin.student.studentdetails.parent.add_address',compact('cotegorys','religions','student_id'));   
 //    }
 //    public function sameAS(Request $request)
 //    {
 //      return $request;
 //    }
 //    public function addressStore(Request $request)
 //    { 
 //        $rules=[
 //          'primary_mobile'=>'required',
 //          'cotegory_id'=>'required',
 //          'religion_id'=>'required',
 //          'nationality'=>'required',
 //          'state'=>'required',
 //          'city'=>'required',
 //          'p_address'=>'required',
 //          'p_pincode'=>'required',
 //          'c_address'=>'required',
 //          'c_pincode'=>'required',
 //        ];

 //        $validator = Validator::make($request->all(),$rules);
 //        if ($validator->fails()) {
 //            $errors = $validator->errors()->all();
 //            $response=array();                       
 //            $response["status"]=0;
 //            $response["msg"]=$errors[0];
 //            return response()->json($response);// response as json
 //        } 
        
 //        $address = new Address();
        
 //        $address->primary_mobile=$request->primary_mobile;
 //        $address->primary_email=$request->primary_email;
 //        $address->category_id=$request->cotegory_id;
 //        $address->religion_id=$request->religion_id;
 //        $address->state=$request->state;
 //        $address->city=$request->city;
 //        $address->p_address=$request->p_address;
 //        $address->c_address=$request->c_address;
 //        $address->p_pincode=$request->p_pincode;
 //        $address->c_pincode=$request->c_pincode;
 //        $address->nationality=$request->nationality; 
 //        $address->save();
 //        $addressId=$address->id;
 //         $this->StudentAddressDetailsStore($request->student_id,$addressId);
 //         $response=['status'=>1,'msg'=>'Address Save Successfully'];
 //        return response()->json($response);
 //    } 
 //    public function StudentAddressDetailsStore($student_id,$addressId)
 //    {   
 //       $StudentSiblingInfo = new SiblingGroup();
 //       $StudentSiblingArrId =$StudentSiblingInfo->getStudentSiblingArrId($student_id);
 //       if (!empty($StudentSiblingArrId)) {
 //         foreach ($StudentSiblingArrId as $key => $student_id) {
 //           $studentAddressDetail=StudentAddressDetail::firstOrNew(['student_id' => $student_id]);
 //           $studentAddressDetail->student_id=$student_id; 
 //           $studentAddressDetail->student_address_details_id=$addressId; 
 //           $studentAddressDetail->save(); 
 //         }
 //       }else{
 //         $studentAddressDetail=StudentAddressDetail::firstOrNew(['student_id' => $student_id]);
 //           $studentAddressDetail->student_id=$student_id; 
 //           $studentAddressDetail->student_address_details_id=$addressId; 
 //           $studentAddressDetail->save();
      
 //       }

      
 //    }
  public function addressEdit($id)
  {
    $add_id = Crypt::decrypt($id);
    $rs_addresses = DB::select(DB::raw("select `sad`.`id`, `adr`.`id`, `adr`.`primary_mobile`, `adr`.`primary_email`, `adr`.`category_id`, `adr`.`religion_id`, `adr`.`state`, `adr`.`city`, `adr`.`p_address`, `adr`.`c_address`, `adr`.`p_pincode`, `adr`.`c_pincode`, `adr`.`nationality`, `cat`.`name` as `category`, `rgn`.`name` as `religion` from `student_address_details` `sad` inner join `addresses` `adr` on `adr`.`id` = `sad`.`student_address_details_id` left join `categories` `cat` on `cat`.`id` = `adr`.`category_id` left join `religions` `rgn` on `rgn`.`id` = `adr`.`religion_id` where `adr`.`id` = $add_id limit 1;"));
    
    $cotegorys = SelectBox::getCategories();
    $religions = SelectBox::getReligions();
    return view('admin.student.studentdetails.parent.add_address_edit',compact('cotegorys','religions','rs_addresses')); 
  }

  public function addressUpdate(Request $request, $id)
  { 
    $rules=[
      'cotegory_id'=>'required',
      'religion_id'=>'required',
      'nationality'=>'required',
      'state'=>'required',
      'city'=>'required',
      'p_address'=>'required',
      'p_pincode'=>'required',
      'c_address'=>'required',
      'c_pincode'=>'required',
    ];
    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $response=array();                       
        $response["status"]=0;
        $response["msg"]=$errors[0];
        return response()->json($response);// response as json
    }
    $add_id = Crypt::decrypt($id);
    $category_id = $request->cotegory_id;
    $religion_id = $request->religion_id;
    $state = MyFuncs::removeSpacialChr($request->state);
    $city = MyFuncs::removeSpacialChr($request->city);
    $p_address = MyFuncs::removeSpacialChr($request->p_address);
    $c_address = MyFuncs::removeSpacialChr($request->c_address);
    $p_pincode = MyFuncs::removeSpacialChr($request->p_pincode);
    $c_pincode = MyFuncs::removeSpacialChr($request->c_pincode);
    $nationality = $request->nationality;

    $rs_update = DB::select(DB::raw("update `addresses` set `category_id` = $category_id, `religion_id` = $religion_id, `state` = '$state', `city` = '$city', `p_address` = '$p_address', `c_address` = '$c_address', `p_pincode` = '$p_pincode', `c_pincode` = '$c_pincode', `nationality` = $nationality where `id` = $add_id limit 1;"));


    $response=['status'=>1,'msg'=>'Address Save Successfully'];
    return response()->json($response);
    }


  public function addressDelete($id)
  {
    $add_id = Crypt::decrypt($id);

    // $address =Address::find($id);
    // $address->delete();
    //   $StudentAddressDetails=StudentAddressDetail::where('student_address_details_id',$id)->get();
    // if ($StudentAddressDetails!=null) {
    //   foreach ($StudentAddressDetails as $StudentAddressDetail) {
    //      $StudentAddressDetail->delete();
    //   }
    // }
    $response=['status'=>1,'msg'=>'Delete Successfully'];
    return response()->json($response);
  } 

}
