<?php

namespace App\Http\Controllers\Admin;

// use App\Admin;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
// use App\Model\Minu;
// use App\Model\MinuType;
// use App\Model\Role;
// use App\Model\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Helper\MyFuncs;
use App\Helper\SelectBox;


class UserReportController extends Controller
{
  
  public function index()
  {
    return view('admin.account.report.userReport.view');
  }
    
  public function reportTypeFilter(Request $request)
  { 
  	
    $reportType=$request->report_type;
    if ($request->report_type==1) {
      $datas = SelectBox::getUserRoles();
  	}elseif ($request->report_type==3) {
      $datas = DB::select(DB::raw("select `sm`.`id`, `mt`.`name` as `menu_name`, `sm`.`name` as `sub_menu_name` from `minu_types` `mt` inner join `sub_menus` `sm` on `sm`.`menu_type_id` = `mt`.`id` where `sm`.`status` = 1 order by `mt`.`sorting_id`, `sm`.`sorting_id`;"));
  	}
  	
    return view('admin.account.report.userReport.report_type_page',compact('datas','reportType'));
  }

  public function filter(Request $request)
  {
    // dd($request);
    $report_type = $request->report_type;
    $user_status = $request->user_status;
    
    $menu_name = '';
    if ($report_type==1) {
      if ($request->role_id==0) { 
        $roles = DB::select(DB::raw("select * from `roles` where `id` <> 12 order by `name`;"));
      }else{
        $roles = DB::select(DB::raw("select * from `roles` where `id` = $request->role_id limit 1;"));
      } 
      $pdf = PDF::setOptions([
        'logOutputFile' => storage_path('logs/log.htm'),
        'tempDir' => storage_path('logs/')
      ])
      ->loadView('admin.account.report.userReport.role_list_with_menu',compact('roles','user_status', 'menu_name')); 
      return $pdf->stream('role_report.pdf');
    }elseif($report_type==3)  {  
      $menu_id = $request->sub_menu_id;
      $roles = DB::select(DB::raw("select * from `roles` where `id` in (select `role_id` from `default_role_menu` where `sub_menu_id` = $menu_id and `status` = 1) order by `name`;"));
      
      $rs_menu = DB::select(DB::raw("select * from `sub_menus` where `id` = $menu_id limit 1;"));
      $menu_name = '';
      if(count($rs_menu)>0){
        $menu_name = $rs_menu[0]->name;
      }

      $pdf = PDF::setOptions([
        'logOutputFile' => storage_path('logs/log.htm'),
        'tempDir' => storage_path('logs/')
      ])
      ->loadView('admin.account.report.userReport.role_list_with_menu',compact('roles','user_status', 'menu_name')); 
      return $pdf->stream('role_report.pdf');
    }

  } 

}
