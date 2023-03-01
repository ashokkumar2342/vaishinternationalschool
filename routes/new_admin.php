<?php


Route::get('index', 'VmsController@index')->name('vms.index'); 
 
Route::get('erplogin', 'VmsController@erplogin')->name('vms.erplogin');
Route::post('loginpost', 'VmsController@loginPost')->name('vms.login.post'); 
Route::get('captcha-refresh', 'VmsController@captchaRefresh')->name('vms.refresh.captcha');
Route::get('change-password', 'AccountController@changePassword')->name('vms.change.password'); 
Route::post('change-password-store', 'AccountController@changePasswordStore')->name('vms.change.password.store');

Route::prefix('admissions')->group(function () {
	Route::get('admission-procedure', 'VmsController@admissionProcedure')->name('vms.admission.procedure');
	// Route::get('admissions', 'VmsController@admissions')->name('vms.admissions');
	// Route::get('admission-help-desk', 'VmsController@admissionHelpDesk')->name('vms.admission.help.desk');
});

Route::prefix('abouts')->group(function () { 
	Route::get('abouts', 'VmsController@abouts')->name('vms.abouts');

	// Route::get('school-management', 'VmsController@schoolManagement')->name('vms.school.management'); 
	Route::get('president-message', 'VmsController@presidentMessage')->name('vms.president.message'); 
	Route::get('general-secretary', 'VmsController@generalSecretary')->name('vms.general.secretary'); 
	Route::get('senior-wing', 'VmsController@seniorWing')->name('vms.senior.wing');
	
	
});

Route::prefix('infrastructure')->group(function () { 
	Route::get('lab', 'VmsController@infrastructureLab')->name('vms.infrastructure.lab'); 
	Route::get('art-craft-room', 'VmsController@artCraftRoom')->name('vms.art.craft.room'); 
	Route::get('music-room', 'VmsController@musicRoom')->name('vms.music.room'); 
	Route::get('audio-visual-room', 'VmsController@audioVisualRoom')->name('vms.audio.visual.room'); 
	Route::get('library', 'VmsController@library')->name('vms.infrastructure.library'); 
	Route::get('activity-hall', 'VmsController@activityHall')->name('vms.activity.hall'); 
	 
	Route::get('transportation', 'VmsController@transportation')->name('vms.transportation'); 
	Route::get('dance-hall', 'VmsController@danceHall')->name('vms.dance.hall'); 
});

Route::prefix('student-life')->group(function () { 
	Route::get('academic', 'VmsController@academic')->name('vms.student.life.academic');  
	Route::get('sports', 'VmsController@sports')->name('vms.student.life.sports');
	Route::get('co-curricular', 'VmsController@coCurricular')->name('vms.co.curricular');  
	Route::get('yoga-life-science', 'VmsController@yogaLifeScience')->name('vms.yoga.life.science');  
	  
	 
});

Route::prefix('news-calendar')->group(function () { 
	Route::get('academic-news', 'VmsController@academicNews')->name('vms.academic.news');  
	Route::get('celebration-news', 'VmsController@celebrationNews')->name('vms.celebration.news');  
	Route::get('sports-news', 'VmsController@sportsNews')->name('vms.sports.news');  
	Route::get('co-curricular-news', 'VmsController@coCurricularNews')->name('vms.co.curricular.news');  
	Route::get('news-letters-magazines', 'VmsController@newsLettersMagazines')->name('vms.news.letters.magazines');  
	Route::get('calendar-events', 'VmsController@calendarEvents')->name('vms.calendar.events');  
	Route::get('archives', 'VmsController@archives')->name('vms.archives');  
	  
	 
});

Route::get('alumni', 'VmsController@alumni')->name('vms.alumni');
Route::get('contacts', 'VmsController@contacts')->name('vms.contacts');


 
Route::get('academic-life', 'VmsController@academicLife')->name('vms.academic.life'); 
Route::get('pastoral-care', 'VmsController@pastoralCare')->name('vms.pastoral.care'); 
// Route::get('co-curricular', 'VmsController@coCurricular')->name('vms.co.curricular'); 
Route::get('social-responsibility', 'VmsController@socialResponsibility')->name('vms.social.responsibility'); 
 
Route::get('news', 'VmsController@news')->name('vms.news'); 
Route::get('events', 'VmsController@events')->name('vms.events'); 
Route::get('media', 'VmsController@media')->name('vms.media'); 
Route::get('sports', 'VmsController@sports')->name('vms.sports'); 
Route::get('clubs-and-societies', 'VmsController@clubsAndSocieties')->name('vms.clubs.and.societies'); 




