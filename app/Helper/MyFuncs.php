<?php

namespace App\Helper;
use App\Admin;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Route;
use Illuminate\Support\Facades\DB;

class MyFuncs {

  public static function getReportHeader() {
    $result_rs = DB::select(DB::raw("select `report_header` from `school_details`;;"));  
    return $result_rs[0]->report_header;
  }

  public static function removeSpacialChr($strValue)
  {
    $newString = trim(str_replace('\'', '', $strValue));
    $newString = trim(str_replace('\\', '', $newString));
    return $newString;
  }

  public static function getStudentDetailsByStudetId($student_id)
  {
    try 
    {
      $result_rs = DB::select(DB::raw("select * from `students` where `id` = $student_id;"));
      return $result_rs;   
    } 
    catch (Exception $e) {
      return $e;
    }
  }

  public static function getStudentDefaultVal() {
    $user_rs=Auth::guard('admin')->user();  
    $user_id = $user_rs->id;
    $result_rs = DB::select(DB::raw("select * from `student_default_values` where `user_id` = $user_id;"));  
    return $result_rs;
  }

  public static function getHostingType() {
    $result_rs = DB::select(DB::raw("select `hosting_type` from `web_hosting_default`;"));  
    return $result_rs[0]->hosting_type;
  }

  public static function getSchoolDetailContactEmail() {
    $result_rs = DB::select(DB::raw("select `contact`, `email`, `name`, `reg_length` from `school_details`;"));  
    return $result_rs;
  }

  //      // all permission check  (Pending)
  public static function isPermission(){ 
    $user_rs = Auth::guard('admin')->user(); 
    if(empty($user_rs)){
      return true;
    }

    $user_role = $user_rs->role_id;
    $user_id = $user_rs->id;
    $routeName = Route::currentRouteName();
    
    $result_rs = DB::select(DB::raw("select * from `sub_menus` where `url` = '$routeName' limit 1;"));    
    if(count($result_rs)==0){
      return true;  
    }

    $result_rs = DB::select(DB::raw("select * from `default_role_menu` `drm` inner join `sub_menus` `sm` on `sm`.`id` = `drm`.`sub_menu_id` where (`drm`.`role_id` = $user_role or `drm`.`role_id` in (select `ar`.`role_id` from `additional_roles` `ar` where `ar`.`user_id` = $user_id and `ar`.`status` = 1)) and `drm`.`status` = 1 and `sm`.`url` = '$routeName' limit 1;"));
    
    if(count($result_rs)>0){
      return true;  
    }
    return false;
  }

  public static function userHasMinu(){ 
    $user_rs=Auth::guard('admin')->user();  
    $user_role = $user_rs->role_id;
    $user_id = $user_rs->id;
    return $menuTypes = DB::select(DB::raw("select * from `minu_types` where `id` in (select Distinct `sm`.`menu_type_id` from `default_role_menu` `drm` inner join `sub_menus` `sm` on `sm`.`id` = `drm`.`sub_menu_id` where (`drm`.`role_id` = $user_role or `drm`.`role_id` in (select `ar`.`role_id` from `additional_roles` `ar` where `ar`.`user_id` = $user_id and `ar`.`status` = 1)) and `drm`.`status` = 1) order by `sorting_id` ;")); 
  } 

  public static function mainMenu($menu_type_id){ 
    $user_rs=Auth::guard('admin')->user();  
    $user_role = $user_rs->role_id;
    $user_id = $user_rs->id;
    
    return $subMenus = DB::select(DB::raw("select `sm`.`id`, `sm`.`name`, `sm`.`status`, `sm`.`url` from `default_role_menu` `drm` inner join `sub_menus` `sm` on `sm`.`id` = `drm`.`sub_menu_id` where (`drm`.`role_id` = $user_role or `drm`.`role_id` in (select `ar`.`role_id` from `additional_roles` `ar` where `ar`.`user_id` = $user_id and `ar`.`status` = 1)) and `drm`.`status` = 1 and `sm`.`menu_type_id` = $menu_type_id order by `sm`.`sorting_id` ;"));
  }

  public static function hotMenu(){ 
    $user_rs=Auth::guard('admin')->user();  
    $user_role = $user_rs->role_id;
    return $subMenus = DB::select(DB::raw("select `sm`.`id`, `sm`.`name`, `sm`.`status`, `sm`.`url` from `default_role_quick_menu` `drqm` inner join `sub_menus` `sm` on `sm`.`id` = `drqm`.`sub_menu_id` where `drqm`.`role_id` = $user_role and `drqm`.`status` = 1 limit 5;")); 
  }

  public static function getDefaultAcademicYearName(){ 
    $academic_year_rs = DB::select(DB::raw("select `name` from `academic_years` where `status` = 1 limit 1;"));
    $year_name = "";
    if (count($academic_year_rs)>0){
      $year_name = $academic_year_rs[0]->name;
    } 
    return $year_name;
  }

  public static function getDefaultAcademicYearID(){ 
    $academic_year_rs = DB::select(DB::raw("select `id` from `academic_years` where `status` = 1 limit 1;"));
    $year_id = 0;
    if (count($academic_year_rs)>0){
      $year_id = $academic_year_rs[0]->id;
    } 
    return $year_id;
  }


  public static function countNotification(){  
    try {
      $user_id = Auth::guard('admin')->user()->id;
      // $notifications = DB::select(DB::raw("select count(*) as `tcount` from `notifications` where `status` = 0 and `user_id` = $user_id;")); //Comment on 31-12-2022
      $notifications = DB::select(DB::raw("select 0 as `tcount` ;")); //temp add on 31-12-2022
      return $notifications[0]->tcount;
    } catch (Exception $e) {
      Log::error('Gereral-Helper-countNotificationCenter: '.$e->getMessage()); // making log in file
      return $e;  
    }  
  }

  public static function getStudentCount($classid, $sectionid, $classSectionId, $userId){ 
    $tcount = 0;
    // $result_rs = DB::select(DB::raw("call `up_getStudentCount`($classid, $sectionid, $classSectionId, $userId);")); //Comment on 31-12-2022
    // $tcount = $result_rs[0]->tcount; //Comment on 31-12-2022
    return $tcount;
  }

  public static function getNewRegistrationCount(){ 
    $tcount = 0;
    // $result_rs = DB::select(DB::raw("call `up_get_new_adm_app_count`();"));  //Comment on 31-12-2022 
    // $tcount = $result_rs[0]->tcount;   //Comment on 31-12-2022
    return $tcount;
  }

  public static function getReceiptsAmt(){ 
    $tamt = 0;
    // $result_rs = DB::select(DB::raw("select ifnull(sum(`amount`),0) as `tamt` from `receipt_payments` where `transaction_date` >= CURDATE();"));   //Comment on 31-12-2022
    // $tamt = $result_rs[0]->tamt;   //Comment on 31-12-2022
    return $tamt;
  }

  public static function getFeeDueAmt(){ 
    $damt = 0;
    // $result_rs = DB::select(DB::raw("select ifnull(sum(`fee_amount`),0) - ifnull(sum(`concession_amount`),0) as `damt` from `student_fee_details`  where `paid` = 0 and (`due_year`*12+`due_month`) <= (YEAR(CURDATE())*12+month(CURDATE()));"));   //Comment on 31-12-2022
    // $damt = $result_rs[0]->damt;   //Comment on 31-12-2022
    return $damt;
  }

  public static function getBirthdayList(){ 
  $result_rs = DB::select(DB::raw("select '' as `id`, '' as `name`, '' as `picture`, '' as `dob`, '' as `registration_no`, '' as `class_name`;"));    //temp add on 31-12-2022
  // $result_rs = DB::select(DB::raw("select `st`.`id`, `st`.`name`, `st`.`picture`, `st`.`dob`, `st`.`registration_no`, concat(`ct`.`name`, '-', `sec`.`name`) as `class_name` from `students` `st` inner join `class_types` `ct` on `ct`.`id` = `st`.`class_id` inner join `section_types` `sec` on `sec`.`id` = `st`.`section_id` where day(`st`.`dob`) = day(CURDATE()) and month(`st`.`dob`) = month(CURDATE()) and `status` = 1 order by `st`.`name`;"));   //Comment on 31-12-2022
    return $result_rs;
  }

  public static function getClassTestList(){ 
    $result_rs = DB::select(DB::raw("select '' as `id`, '' as `class_name`, '' as `name`, '' as `max_marks`, '' as `test_date`, '' as `discription` ;")); //temp add on 31-12-2022
    // $result_rs = DB::select(DB::raw("select `test`.`id`, concat(`ct`.`name`, '-', `sec`.`name`) as `class_name`, `sub`.`name`, `test`.`max_marks`, `test`.`test_date`, `test`.`discription` from `class_tests` `test` inner join `class_types` `ct` on `ct`.`id` = `test`.`class_id` inner join `section_types` `sec` on `sec`.`id` = `test`.`section_id` inner join `subject_types` `sub` on `sub`.`id` = `test`.`subject_id` where `test`.`test_date` = curdate() order by `ct`.`shorting_id`, `sec`.`sorting_order_id` ;")); //Comment on 31-12-2022
    return $result_rs;
  }

  public static function getClassWiseStudentCount(){ 
    $result_rs = DB::select(DB::raw("select '' as `name`, 0 as `tcount` ;"));    //temp add on 31-12-2022
    // $result_rs = DB::select(DB::raw("select `ct`.`name`, (select count(*) from `students` `stu` where `stu`.`class_id` = `ct`.`id` and `student_status_id` = 1) as `tcount` from `class_types` `ct` order by `ct`.`shorting_id`;"));    //Comment on 31-12-2022
    return $result_rs;
  }

  public static function getFeeDetailList($refreshList){ 
    // $result_rs = DB::select(DB::raw("call `up_fetch_feeReport_monthYearWise`($refreshList);"));  //Comment on 31-12-2022
    // $result_rs = DB::select(DB::raw("select * from `rpt_fee_monthyearwise` order by `due_year`, `due_month`;"));  //Comment on 31-12-2022
    $result_rs = DB::select(DB::raw("select 0 as `due_year`, 0 as `due_month`, 0 as `fee_due`, 0 as `fee_concession`, 0 as `fee_received` ;"));  //temp add on 31-12-2022
    return $result_rs;
  }

  public static function getclassAttendanceReport($refreshList){ 
    // $result_rs = DB::select(DB::raw("call `up_fetch_class_attendace_report`($refreshList);"));   //Comment on 31-12-2022
    // $result_rs = DB::select(DB::raw("select * from `rpt_attendance_class`;"));  //Comment on 31-12-2022
    $result_rs = DB::select(DB::raw("select '' as `class_name`, 0 as `tpresent`, 0 as `tabsent` ;"));  //temp add on 31-12-2022
    return $result_rs;
  }

  // public static function getStudentClasses(){ 
  //   $user = MyFuncs::getUser();    
  //   $userClass = UserClassType::where('admin_id',$user->id)->distinct()->get(['class_id']);
  //   return $classes = array_pluck(ClassType::get(['id','name'])->toArray(),'name', 'id');
  // }

  public static function getClasses(){
    $user = MyFuncs::getUser();
    $user_id = $user->id;
    $result_rs = DB::select(DB::raw("select * from `class_types` where `id` in (select distinct `class_id` from `user_class_types` where `admin_id` = $user_id) order by `shorting_id`;"));

    return $result_rs;
  }

  // public static function getStudentSections($class_id){
  //   $user = MyFuncs::getUser();
  //   $userClass = UserClassType::where('admin_id',$user->id)->distinct()->get(['class_id']);
  //   $userSections = UserClassType::where('admin_id',$user->id)->where('class_id',$class_id)->get(['section_id']);  
  //  return SectionType::all(); 
  // }

  public static function getSections($class_id){
    $result_rs = DB::select(DB::raw("select `sec`.`id`, `sec`.`name` from `section_types` `sec` inner join `sections` `cls` on `cls`.`section_id` = `sec`.`id` where `cls`.`class_id` = $class_id order by `sec`.`sorting_order_id`;"));

    return $result_rs;
  }

  public static function getUser(){
    return $user = Auth::guard('admin')->user();  
  }

  public static function get_reg_no_size(){
    $schoolinfo = DB::select(DB::raw("select `reg_length` from `schoolinfo` limit 1;"));
    if(count($schoolinfo)>0){
      return $schoolinfo[0]->reg_length;
    }
    return 6;  
  }











  

//-----------End---------------------



//   //function to get only classes :: permitted_or_all ::- 1 Permitted, 2 All
//   public static function getClassOnly($userid, $permitted_or_all) {
//     if($permitted_or_all==2){
//       $classes=DB::select(DB::raw("select `name`, `id`, `alias` from `class_types` order by `shorting_id`;"));  
//     }else{
//       $classes=DB::select(DB::raw("select distinct `ct`.`name`, `ct`.`id`, `ct`.`alias` from `user_class_types` `uct` inner join `class_types` `ct` on ct`.`id` = `uct`.`class_id` where `uct`.`admin_id` = $userid order by `ct`.`shorting_id`;"));  
//     }
//     return $classes;
//   }


//     public static function full_name($first_name,$last_name) {
//         // return $first_name . ', '. $last_name;   
//         return $first_name . ', '. $last_name;   
//     }
//     public static function hello(){
//     	return 'hello';
//     } 

//     public static function getUser(){
//        return $user = Auth::guard('admin')->user();  
//     }

//     public static function getUserId(){
//        return $user = Auth::guard('admin')->user()->id;  
//     } 
//     public static function getStudentClasses(){

//         $user = MyFuncs::getUser();    
//         $userClass = UserClassType::where('admin_id',$user->id)->distinct()->get(['class_id']);
//         return $classes = array_pluck(ClassType::get(['id','name'])->toArray(),'name', 'id');
//     }
//     public static function getClasses(){

//         $user = MyFuncs::getUser();    
//         $userClass = UserClassType::where('admin_id',$user->id)->distinct()->get(['class_id']);
//         return $classes = array_pluck(ClassType::whereIn('id',$userClass)->get(['id','name'])->toArray(),'name', 'id');
//     }

//     public static function getClassByHasUser(){
//         $user = MyFuncs::getUser();
//         $userClass = UserClassType::where('admin_id',$user->id)->distinct()->get(['class_id']);
//         return $classes = ClassType::whereIn('id',$userClass)->get();
//     }

//     public static function getAllClasses(){ 
//         return $classes = array_pluck(ClassType::get(['id','name'])->toArray(),'name', 'id');
//     }

//     public static function getSections($class_id){
//         $user = MyFuncs::getUser();
//         $userClass = UserClassType::where('admin_id',$user->id)->distinct()->get(['class_id']);
//         $userSections = UserClassType::where('admin_id',$user->id)->where('class_id',$class_id)->get(['section_id']);  
//        return SectionType::whereIn('id',$userSections)->get();
       
//     }
//     public static function getSectionsClaasArrayId($class_id){
//         $user = MyFuncs::getUser();
//         $userClass = UserClassType::where('admin_id',$user->id)->distinct()->get(['class_id']);
//         $userSections = UserClassType::where('admin_id',$user->id)->whereIn('class_id',$class_id)->get(['section_id']);  
//        return SectionType::whereIn('id',$userSections)->get();
       
//     }
//     public static function getStudentSections($class_id){
//         $user = MyFuncs::getUser();
//         $userClass = UserClassType::where('admin_id',$user->id)->distinct()->get(['class_id']);
//         $userSections = UserClassType::where('admin_id',$user->id)->where('class_id',$class_id)->get(['section_id']);  
//        return SectionType::all();
       
//     }


//      // read write delete permission check
  // public static function menuPermission(){ 
  //   $user_id =Auth::guard('admin')->user()->id;
  //   $routeName= Route::currentRouteName();
  //   $previousRoute= app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
  //   $subMenu =SubMenu::where('url',$routeName)->first(); 
  //   $previoussubMenu =SubMenu::where('url',$previousRoute)->first(); 
  //   if (empty($subMenu)) {
  //     return Minu::where('admin_id',$user_id)->where('status',1)->where('sub_menu_id',$previoussubMenu->id)->first();   
  //    } 
  //   return Minu::where('admin_id',$user_id)->where('status',1)->where('sub_menu_id',$subMenu->id)->first();
              

  // }
// // read write delete permission check

//   public static function showMenu(){
//     $menu='';
//     $subMenus=array();
//     $menuTypes = MinuType::orderBy('sorting_id','asc')->get();
//     foreach ($menuTypes as  $menuType) {
        
//          $menus=MyFuncs::mainMenu($menuType->id);
//          foreach ($menus as $subMenu) {
//              $subMenus[]=$subMenu->id;
//          }
//     }
//     return $subMenus;
//     // $mainMenus = Minu::where('admin_id',Auth::guard('admin')->user()->id)
//     //                     ->where('minu_id',$menu_type_id)
//     //                     ->get(['sub_menu_id']); 
   
//   }

//   public function getMonthYear()
//   {     
//       $AcademicYear=AcademicYear::where('status',1)->first(); 

//       $start    = (new DateTime($AcademicYear->start_date))->modify('first day of this month');
//       $end      = (new DateTime($AcademicYear->end_date))->modify('first day of next month');
//       $interval = DateInterval::createFromDateString('1 month');
//       $period   = new DatePeriod($start, $interval, $end);
//       $yearmonths = array();
//       foreach ($period as $dt) {
//           $yearmonths[]=$dt->format("d-m-Y");
//       }
//       return $yearmonths;
//   }  

//   public function getMonthYearById($academic_year_id)
//   {     
//       $AcademicYear=AcademicYear::where('id',$academic_year_id)->first(); 
//       $start    = (new DateTime($AcademicYear->start_date))->modify('first day of this month');
//       $end      = (new DateTime($AcademicYear->end_date))->modify('first day of next month');
//       $interval = DateInterval::createFromDateString('1 month');
//       $period   = new DatePeriod($start, $interval, $end);
//       $yearmonths = array();
//       foreach ($period as $dt) {
//           $yearmonths[]=$dt->format("d-m-Y");
//       }
//       return $yearmonths;
//   } 
//    public function getSiblingById()
//   { 
//       $student = Auth::guard('admin')->user();  
//       $userIdBySibling =new StudentUserMap();
//       return $userIdBySibling->userIdBySibling($student->id);
//   }

//   public static function getStudent(){
//     try {
//         $admin = Auth::guard('admin')->user();  
//         $StudentUserMap =new StudentUserMap();
//         return $StudentUserMap->userIdByStudetnDetails($admin->id);
//     } catch (Exception $e) {
//         return $e;
//     }
    
//   }

//   // notification save send function
//   public static function notification($to_user_id,$from_user_id,$class_id,$reference_id,$message,$notification_type_id=NULL){
//       try {
//           $notifications = new Notification();
//            $insArray = array();   
              
//                $insArray['user_id'] = $to_user_id;    
//                $insArray['from_user_id'] = $from_user_id;
//                $insArray['role_id'] = $role_id;
//                $insArray['reference_id'] = $reference_id;
//                $insArray['message'] = $message;
//                $insArray['notification_type_id'] = $legal_type_id; 
//                $insArray['status'] = 1;   
//                $insArray['read_status'] = 1;  
//                $notifications->insNotification($insArray); 
           
          
//       } catch (Exception $e) {
//           Log::error('Gereral-Helper-notificationCenter: '.$e->getMessage()); // making log in file
//           return $e;  
//       }
      
       
//   } 

//   public static function UserWiseStudentDefaultValue(){
//         $user = MyFuncs::getUser();
//        return $StudentDefaultValue = StudentDefaultValue::where('user_id',$user->id)->first();
          
//     }

   
//   public static function getClassByuserId($user_id){ 
//       $userClass = UserClassType::where('admin_id',$user_id)->distinct()->get(['class_id']);
//       return $classes = ClassType::whereIn('id',$userClass)->get(['id','name']);
//   }
//   public static function getSectionsByuserId($user_id,$class_id){
       
//       $userClass = UserClassType::where('admin_id',$user_id)->distinct()->get(['class_id']);
//       $userSections = UserClassType::where('admin_id',$user_id)->where('class_id',$class_id)->get(['section_id']);  
//      return SectionType::whereIn('id',$userSections)->get(['id','name']);
     
//   }
//   public static function getSubject($user_id,$class_id){
       
//       $subject =new Subject();
//      return $subject->getSubjectByuserIdOrClassId($user_id,$class_id);
     
//   }

}