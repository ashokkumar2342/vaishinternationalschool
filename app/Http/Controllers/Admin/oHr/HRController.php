<?php

namespace App\Http\Controllers\Admin\Hr;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Model\Gender;
use App\Model\Hr\Allowance;
use App\Model\Hr\Bank;
use App\Model\Hr\BankDetail;
use App\Model\Hr\Department;
use App\Model\Hr\Designation;
use App\Model\Hr\Employee;
use App\Model\Hr\EmployeeBasicSalary;
use App\Model\Hr\EmployeeSalary;
use App\Model\Hr\EmployeeSalaryStructure;
use App\Model\Hr\Experience;
use App\Model\Hr\HrGroup;
use App\Model\Hr\Payhead;
use App\Model\Hr\SalarySetting;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class HRController extends Controller
{
    public function index(){ 
    	return view('admin.hr.employee.index');
    }
    public function addForm($id=null){
        $admins=Role::orderBy('name','ASC')->get();  
        $Departments=Department::orderBy('name','ASC')->get();  
        $Designations=Designation::orderBy('name','ASC')->get();  
        $groups=HrGroup::orderBy('name','ASC')->get();  
        $experiences=Experience::orderBy('name','ASC')->get();
        $genders=Gender::orderBy('genders','ASC')->get();
        if ($id!=null) {
          	$Employee=Employee::find(Crypt::decrypt($id));
          }
          if ($id==null) {
          	$Employee='';
          }  
        return view('admin.hr.employee.add_form',compact('admins','Departments','groups','experiences','Employee','Designations','genders'));
    }
    public function store(Request $request,$id=null){
        $rules=[
            'code' => 'required|string|max:20|unique:employees,code,'.$id, 
            'role' => 'required',
            'name' => 'required',
            'mobile' => 'required|unique:admins',
            'email' => 'required|email|unique:admins',
            'aadhaar_no' => 'required|unique:employees,aadhaar_no,'.$id, 
            'pan_number' => 'nullable|unique:employees,pan_number,'.$id, 
            'pf_account_number' => 'nullable|unique:employees,pf_account_number,'.$id, 
            'esi' => 'nullable|unique:employees,esi,'.$id, 
            ];

            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $response=array();
                $response["status"]=0;
                $response["msg"]=$errors[0];
                return response()->json($response);// response as json
            }
              else {
                $char = substr( str_shuffle("0123456789"), 0, 6 ); 
                $employees=Employee::firstOrNew(['id'=>$id]);
                $employees->code=$request->code;
				$employees->date_of_joining=$request->date_of_joining;
				$employees->department_id=$request->department; 
                $employees->designation_id=$request->designation; 
                $employees->group_id=$request->group; 
				$employees->qualification=$request->qualification;
				$employees->experience_id=$request->experience; 
                $employees->role_id=$request->role;
                $employees->name=$request->name;
                $employees->Last_name=$request->Last_name;
                $employees->date_of_birth=$request->dob;
				$employees->gender_id=$request->gender; 
                $employees->aadhaar_no=$request->aadhaar_no;
				$employees->pan_number=$request->pan_number;
                $employees->pf_account_number=$request->pf_account_number; 
                $employees->esi=$request->esi; 
                $employees->mobile_no=$request->mobile; 
                $employees->contact_no=$request->contact_no; 
                $employees->email=$request->email; 
                $employees->country=$request->country; 
                $employees->state=$request->state; 
                $employees->city=$request->city; 
                $employees->pincode=$request->pincode; 
                $employees->current_address=$request->current_address; 
                $employees->permanent_address=$request->permanent_address;
                if ($id==null) { 
                $employees->dpassword_encript = bcrypt($char);
                $employees->dpassword =$char; 
                }
                $employees->save();
                $response=['status'=>1,'msg'=>'Submit Successfully'];
                return response()->json($response);
                }
    }
    public function tableShow(){ 
    	$employees=Employee::all();
        return view('admin.hr.employee.table',compact('employees'));
    }
    public function destroy($id){ 
      $Employee=Employee::find(Crypt::decrypt($id));
      $Employee->delete();
      $response=['status'=>1,'msg'=>'Delete Successfully'];
     return response()->json($response);
    }


    public function salarySettings($value='')
    {
     $salarySettings=SalarySetting::all();   
     return view('admin.hr.employee.salary_settings',compact('salarySettings'));   
    }
    public function salarySettingsAddForm($id=null)
    {
        $Designations=Designation::orderBy('name','ASC')->get();
        $employees=Employee::all();  
        $Payheads=Payhead::orderBy('name','ASC')->get();  
        if ($id!=null) {
            $salarySettings=SalarySetting::find(Crypt::decrypt($id));  
          }
          if ($id==null) {
            $salarySettings='';  
          }  
       return view('admin.hr.employee.salary_settings_add',compact('salarySettings','Designations','Payheads','employees'));  
    }
    public function salarySettingsstore(Request $request,$id=null){
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
              else {
                $employees=SalarySetting::firstOrNew(['id'=>$id]);
                // $employees->designation_id=$request->designation;
                $employees->employee_id=$request->employee;
                $employees->pay_head_type_id=$request->pay_head_type; 
                $employees->unit=$request->unit; 
                $employees->type=$request->type; 
                $employees->save();
                $response=['status'=>1,'msg'=>'Submit Successfully'];
              }     return response()->json($response);
    }


    public function employeeSalary($value='')
    {
       return view('admin.hr.employee.employee_salary',compact('salarySettings','Designations','Payheads','employees'));    
    }
    public function employeeSalaryAddForm($id=null)
    {
        $Designations=Designation::orderBy('name','ASC')->get();
        $employees=Employee::all();  
        $Payheads=Payhead::orderBy('name','ASC')->get();  
        if ($id!=null) {
            $employeeSalary=EmployeeSalary::find(Crypt::decrypt($id));  
          }
          if ($id==null) {
            $employeeSalary='';  
          }  
       return view('admin.hr.employee.employee_salary_add',compact('employeeSalary','Designations','Payheads','employees'));  
    }
    public function employeeBankDetails($value='')
    {
        $Designations=Designation::orderBy('name','ASC')->get(); 
        return view('admin.hr.employee.bank_details',compact('employeeSalary','Designations','Payheads','employees'));    
    }
    public function designationWiseEmployee(Request $request)
    {
         $employees=Employee::where('designation_id',$request->id)->get(); 
        return view('admin.hr.employee.employee_select_box',compact('employeeSalary','Designations','Payheads','employees'));    
    } 
    public function bankDetailsAddForm()
    {
        $Designations=Designation::orderBy('name','ASC')->get(); 
        $banks=Bank::orderBy('name','ASC')->get(); 
        return view('admin.hr.employee.bank_details_add',compact('banks','Designations','Payheads','employees'));    
    }
    public function bankDetailsStore(Request $request){
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
              else {
                $employees=BankDetail::firstOrNew(['designation_id'=>$request->designation_id,'employee_id'=>$request->employee_id]);
                $employees->designation_id=$request->designation_id;
                $employees->employee_id=$request->employee_id;
                $employees->bank_id=$request->bank_id; 
                $employees->branch=$request->branch; 
                $employees->account_no=$request->account_no; 
                $employees->ifsc_code=$request->ifsc_code; 
                $employees->bank_address=$request->bank_address; 
                $employees->dd_payable_address=$request->dd_payable_address; 
                $employees->save();
                $response=['status'=>1,'msg'=>'Submit Successfully'];
              }     return response()->json($response);
    }
    public function employeeBankDetailsShow(Request $request)
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
              
            if ($request->designation_id!=0 && $request->employee_id!=null) {
               $employees=BankDetail::where('designation_id',$request->designation_id)->where('employee_id',$request->employee_id)->get();   
            } 
            elseif ($request->designation_id==0) {
             $employees=BankDetail::all();   
            }
            elseif ($request->designation_id!=0 && $request->employee_id==null) {
             $employees=BankDetail::where('designation_id',$request->designation_id)->get();   
            }
            $response=array();
            $response['status']=1;
            $response['data']= view('admin.hr.employee.employee_bank_details_list',compact('employees'))->render();
            return $response; 
                
    }
    public function employeeBasicSalary()
    {
        $Employees=Employee::orderBy('code','ASC')->get();
        $EmployeeBasicSalary=EmployeeBasicSalary::all();
        return view('admin.hr.basicSalary.view',compact('Employees'));
    }
    public function employeeBasicSalaryStore(Request $request)
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
            $EmployeeBasicSalary=EmployeeBasicSalary::firstOrNew(['employee_id'=>$request->employee_id]);
            $EmployeeBasicSalary->employee_id=$request->employee_id;
            $EmployeeBasicSalary->basic_salary=$request->basic_salary;
            $EmployeeBasicSalary->from_date=$request->from_date;
            $EmployeeBasicSalary->to_date=$request->to_date;
            $EmployeeBasicSalary->save();
            $response=['status'=>1,'msg'=>'Submit Successfully'];
                return response()->json($response);
    }
    public function employeeBasicSalaryList(Request $request)
    {
        $EmployeeBasicSalarys=EmployeeBasicSalary::where('employee_id',$request->id)->get();
        return view('admin.hr.basicSalary.list',compact('EmployeeBasicSalarys'));
    }

    //----------------------employee-salary-structure--------------------------------------------------------------

    public function employeeSalaryStructure()
    {
      $Employees=Employee::orderBy('code','ASC')->get();
      $allowances=Allowance::orderBy('allowance','ASC')->get();
      return view('admin.hr.salaryStructure.view',compact('Employees','allowances'));  
    }
    public function employeeSalaryStructureStore(Request $request)
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
            $employeeSalaryStructure=EmployeeSalaryStructure::firstOrNew(['employee_id'=>$request->employee_id]);
            $employeeSalaryStructure->employee_id=$request->employee_id;
            $employeeSalaryStructure->allowance_id=$request->allowance_id;
            $employeeSalaryStructure->fix_or_percent=$request->fix_percent;
            $employeeSalaryStructure->amount=$request->amount;
            $employeeSalaryStructure->from_date=$request->from_date;
            $employeeSalaryStructure->to_date=$request->to_date;
            $employeeSalaryStructure->save();
            $response=['status'=>1,'msg'=>'Submit Successfully'];
                return response()->json($response);
    }
    public function employeeSalaryStructureList(Request $request)
    {
        $EmployeeSalaryStructures=EmployeeSalaryStructure::where('employee_id',$request->id)->get();
        return view('admin.hr.salaryStructure.list',compact('EmployeeSalaryStructures'));
    }
 
}
