<?php
namespace App\Http\Controllers\Admin\Notification;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
// use App\Model\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;

class NotificationController extends Controller
{
     //show notification in head page 
  public function nextPage(Request $request) {
    try {
      $user_rs = Auth::guard('admin')->user();
      $user_id = $$user_rs->id;
      $notifications = DB::select(DB::raw("select * from `notifications` where `user_id` = $user_id and `status` < 2 order by `id` desc;"))->paginate(10);
      return [
             'notifications' => view('admin.notification.list')->with(compact('notifications'))->render(),
             'next_page' => $notifications->nextPageUrl()        
         ];

      // $notification = new Notification();
      // $user_id =MyFuncs::getUser()->id;
      // $notifications = $notification->getNotification($user_id);
      // return [
      //        'notifications' => view('admin.notification.list')->with(compact('notifications'))->render(),
      //        'next_page' => $notifications->nextPageUrl()        
      //    ];    
    } catch (Exception $e) {
       Log::error('NotificationController-nextPage: '.$e->getMessage());      // making log in file
       return view('error.home');  
    }
  }

  //notification show all
  public function showNotification(Request $request) {
    try {
      // $notification = new Notification();
      // $user_id =MyFuncs::getUser()->id;
      // $notifications = $notification->getAllNotification($user_id);
      
      $user_rs = Auth::guard('admin')->user();
      $user_id = $$user_rs->id;
      $notifications = DB::select(DB::raw("select * from `notifications` where `user_id` = $user_id and `status` < 2 order by `id` desc;"))->paginate(15);
       
      if($request->ajax()) {
        return [
          'notifications' => view('admin.notification.notificationOnScroll')->with(compact('notifications'))->render(),
          'next_page' => $notifications->nextPageUrl()
        ];
      }
      return view('admin.notification.notificationAll')->with(compact('notifications')); 
    } catch (Exception $e) {
      Log::error('NotificationController-showNotification: '.$e->getMessage());      // making log in file
      return view('error.home');    
    } 
  }

    //notification Clear all
  public function markAll(Request $request) {
    try {
      $user_rs = Auth::guard('admin')->user();
      $user_id = $$user_rs->id;
      $result_rs = DB::select(DB::raw("update `notifications` set `status` = 1 where `status` = 0 and `user_id` = $user_id;"));
      $response = array();
      $response['status'] = 1;
      $response['msg'] = 'Mark All as Read Successful';
      return $response;  
    } catch (Exception $e) {
      Log::error('NotificationController-markAll: '.$e->getMessage());      // making log in file
      return view('error.home');  
    }      
  }


  //notification Clear all
  public function noficationClear($id) {
    try {
      $id = Crypt::decrypt($id);
      // $notification = new Notification();
      // $notifications = $notification->noficationRemove($id);
      
      $user_rs = Auth::guard('admin')->user();
      $user_id = $$user_rs->id;
      $result_rs = DB::select(DB::raw("update `notifications` set `status` = 2 where `id` = $id and `user_id` = $user_id limit 1;"));
      
      $response = array();
      $response['status'] = 1;        
      $response['msg'] = 'Remove Successful';        
      return redirect()->back()->with(['message'=>'Remove Successful','class'=>'success']);
    } catch (Exception $e) {
      Log::error('NotificationController-noficationClear: '.$e->getMessage());      // making log in file
      return view('error.home');    
    } 	
  }
    
    //notification Status Changed to read
  public function readStatus($id) {
    try {
      $id = Crypt::decrypt($id);
      $result_rs = DB::select(DB::raw("update `notifications` set `status` = 1 where `id` = $id limit 1;"));
      $response = array();
      $response['status'] = 1; 
      return $response;
    } catch (Exception $e) {
      Log::error('NotificationController-readStatus: '.$e->getMessage());      // making log in file
      return view('error.home');     
    }
  }




}
