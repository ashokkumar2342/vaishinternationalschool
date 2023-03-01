<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
    
// });
 
// 	Route::group(['prefix' => 'student'], function() {
// 		Route::post('imageweb/{student}/update', function(Request $request) {
// 			return $request->all();
// 		    // return response()->json($data);
// 		})->name('admin.student.profilepic.webupdate');
	   
// 	    // Route::post('imageweb/{student}/update', 'Admin/backupstudent@imageWebUpdate')->name('admin.student.profilepic.webupdate');
	          
// 	    // });
// 	});
// Route::post('imageweb/{id}', 'Admin\StudentController@imageWebUpdate')->name('admin.student.profilepic.webupdate');	
// // Route::post('login', 'Api\StudentController@login');	
// Route::get('search-school', 'Api\StudentController@searchSchool'); 
// Route::get('login', 'Api\StudentController@login');	 
// Route::get('forgot-password', 'Api\StudentController@forgotPassword');	
// Route::get('forgot-password/otp-verify', 'Api\StudentController@forgotPasswordOtpVerify');	
// Route::get('test', function(Request $request){
//  return response()->json(['ashok'=>'ashok']);
// });	
//  Route::group(['prefix' => 'student'], function() {
//  	Route::get('details/{id}', 'Api\StudentController@index'); 
//     Route::get('image/{id}', 'Api\StudentController@image'); 
//     Route::post('image-upload/{id}', 'Api\StudentController@imageUpload');
//     Route::get('homework/{id}', 'Api\StudentController@homework'); 
//     Route::get('homework-latest/{id}', 'Api\StudentController@homeworkToday'); 
//     Route::get('attendance/{id}', 'Api\StudentController@attendance'); 
//     Route::get('fee/{id}', 'Api\StudentController@feeDetails'); 
//     Route::get('last-fee/{id}', 'Api\StudentController@lastFee'); 
//     Route::get('fee-upto/{id}', 'Api\StudentController@feeUpto'); 
//     Route::get('event/{id}', 'Api\StudentController@event'); 
//     Route::get('remarks/{id}', 'Api\StudentController@remarks'); 
//     Route::get('quotes/{id}', 'Api\StudentController@quotes'); 
//     Route::post('request-update/{id}', 'Api\StudentController@requestUpdate'); 
  
//  });

//  Route::group(['prefix' => 'admin'], function() {
//  	Route::get('details/{id}', 'Api\AdminController@index'); 
//     Route::get('academic-year', 'Api\AdminController@academicYear'); 
//     Route::get('image/{id}', 'Api\AdminController@image'); 
//     Route::get('homework/{id}', 'Api\AdminController@homework'); 
//     Route::post('homework/store', 'Api\AdminController@homeworkStore'); 
//     Route::get('homework-latest/{id}', 'Api\AdminController@homeworkToday'); 
//     Route::get('attendance/{id}', 'Api\AdminController@attendance'); 
//     Route::get('get-attendance/{class_id}/{section_id}/{date}', 'Api\AdminController@getAttendance'); 
//     Route::post('attendance/store', 'Api\AdminController@attendanceStore'); 
//     Route::get('fee/{id}', 'Api\AdminController@feeDetails'); 
//     Route::get('last-fee/{id}', 'Api\AdminController@lastFee'); 
//     Route::get('fee-upto/{id}', 'Api\AdminController@feeUpto'); 
//     Route::get('event/{id}', 'Api\AdminController@event'); 
//     Route::get('remarks/{id}', 'Api\AdminController@remarks'); 
//     Route::get('quotes/{id}', 'Api\AdminController@quotes'); 
//     Route::get('getclass/{id}', 'Api\AdminController@getClass'); 
//     Route::get('getsection/{user_id}/{class_id}', 'Api\AdminController@getSection'); 
//     Route::get('getsubject/{user_id}/{class_id}', 'Api\AdminController@getSubject'); 
//     Route::get('getstudent/{class_id}/{section_id}', 'Api\AdminController@getStudent'); 
//     Route::post('classtest/store', 'Api\AdminController@classTestStore');
//     Route::post('classtest/show', 'Api\AdminController@classTestShow');
//     Route::get('classtest/status/{id}', 'Api\AdminController@classTestStatus');
//  });

//  Route::get('student-details/{id}', 'Api\StudentController@studentDetails'); 
 
