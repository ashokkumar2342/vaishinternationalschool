<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Laravel\Passport\createToken;
use Illuminate\Support\Facades\DB;
use App\Helper\MyFuncs;
use Illuminate\Support\Facades\Response;
class VmsController extends Controller
{
    
public function index()
{ 
    return view('vms.index');
}

public function erplogin()
{ 
    return view('vms.login');
}

//--start-admissions--//

public function admissions()
{ 
    return view('vms.admission.admission');
}

public function admissionHelpDesk()
{ 
    return view('vms.admission.admission_help_desk');
}

public function admissionProcedure()
{ 
    return view('vms.admission.admission_procedure');
}

//--start-admissions--//

//--start-abouts--//

public function abouts()
{ 
    return view('vms.abouts.abouts');
}


public function generalSecretary()
{ 
    return view('vms.abouts.general_secretary');
}

public function presidentMessage()
{ 
    return view('vms.abouts.president_message');
}


public function seniorWing()
{ 
    return view('vms.abouts.senior_wing');
}



//--end-abouts--//
//--start-infrastructure--//

public function infrastructureLab()
{ 
    return view('vms.infrastructure.lab');
}

public function artCraftRoom()
{ 
    return view('vms.infrastructure.art_craft_room');
}

public function musicRoom()
{ 
    return view('vms.infrastructure.music_room');
}

public function audioVisualRoom()
{ 
    return view('vms.infrastructure.audio_visual_room');
}

public function library()
{ 
    return view('vms.infrastructure.library');
}

public function activityHall()
{ 
    return view('vms.infrastructure.activity_hall');
}

public function transportation()
{ 
    return view('vms.infrastructure.transportation');
}

public function danceHall()
{ 
    return view('vms.infrastructure.dance_hall');
}

//--end-infrastructure--//

//--start-student-life--//

public function academic()
{ 
    return view('vms.studentlife.academic');
}

public function sports()
{ 
    return view('vms.studentlife.sports');
}

public function coCurricular()
{ 
    return view('vms.studentlife.co_curricular');
}

public function yogaLifeScience()
{ 
    return view('vms.studentlife.yoga_life_science');
}

//--end-student-life--// 

//--start-new-calendar--// 

public function academicNews()
{
   return view('vms.newscalendar.academic_news');
}

public function celebrationNews()
{
   return view('vms.newscalendar.celebration_news');
}

public function sportsNews()
{
   return view('vms.newscalendar.sports_new');
}

public function coCurricularNews()
{
   return view('vms.newscalendar.co_curricular_news');
}

public function newsLettersMagazines()
{
   return view('vms.newscalendar.news_letters_magazines');
}

public function calendarEvents()
{
   return view('vms.newscalendar.calendar_events');
}

public function archives()
{
   return view('vms.newscalendar.archives');
}
//--end-new-calendar--// 

// public function alumni()
// { 
//     return view('vms.alumni.alumni');
// }

public function contacts()
{ 
    return view('vms.contacts.contacts');
}



















public function captchaRefresh()
{
    return  captcha_img('flat');
}

public function loginPost(Request $request){ 
    $this->validate($request, [
        'email' => 'required', 
        'password' => 'required',
        'captcha' => 'required|captcha' 
    ]);

    $email = str_replace("'", "", trim($request->email));
    
    $result_rs = DB::select(DB::raw("select * from `admins` where `email` = '$email' and `status` = 2 limit 1;"));
    $rs_count = count($result_rs);
    if ($rs_count >0) {
      return redirect()->route('student.resitration.verification',Crypt::encrypt($result_rs[0]->id)); 
    }
    $credentials = [
               'email' => $request['email'],
               'password' => $request['password'],
               'status' => 1,
           ]; 
    if(auth()->guard('admin')->attempt($credentials)) {

      return redirect()->route('admin.dashboard');     
    } 
    
    return Redirect()->back()->with(['message'=>'Invalid User or Password','class'=>'error']);    
  }
  




      
}
