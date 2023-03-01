<?php

// use App\Http\Controllers\Admin\reportGenerateBarcode;
// //registration start
Route::prefix('resitration')->group(function () {
    Route::get('form', 'AccountController@firststep')->name('student.resitration.firststep');	//OK---------
    Route::post('form', 'AccountController@studentNewRegistrationStore')->name('student.resitration.firststep.store');	//OK-------
    Route::get('verification/{id}', 'AccountController@verification')->name('student.resitration.verification'); //OK --------------
    Route::post('otp-verify', 'AccountController@otpVerify')->name('student.resitration.otp.verify'); //OK -------
    // Route::post('email-verify', 'AccountController@verifyEmail')->name('student.resitration.verifyEmail');	//OK---------
    Route::get('resend-otp/{id?}/{otp_type}', 'AccountController@resendOTP')->name('student.resitration.resend.otp');	//OK-------------

     
//     Route::get('resitration-form', 'AccountController@resitrationForm')->name('student.resitration.resitrationForm'); 
//  Route::get('resitration-form1', 'AccountController@resitrationForm')->name('student.resitration.resitrationForm'); 
});
// //registration end 
// Route::get('/', 'Auth\LoginController@index')->name('admin.home');
// Route::get('loginapi/{id}', 'Auth\LoginController@loginApi')->name('admin.login');

// Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login'); 	//OK--------

// Route::get('admin-password/reset', 'Auth\ForgetPasswordController@sendResetLinkEmail')->name('admin.password.email');
// Route::get('passwordreset/reset/{token}', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout.get');		//OK--------------
Route::post('login', 'Auth\LoginController@login')->name('admin.login.post');	//OK ------------
Route::get('forget-password', 'Auth\LoginController@forgetPassword')->name('admin.forget.password');	//OK----------
// Route::post('forget-password-send-link', 'Auth\LoginController@forgetPasswordSendLink')->name('admin.forget.password.send.link');		//OK-----------

// Route::post('reset-password/{userid}', 'Auth\LoginController@resetPassword')->name('admin.reset.password');	//OK--------

Route::get('refreshcaptcha', 'Auth\LoginController@refreshCaptcha')->name('admin.refresh.captcha');	//OK---------


Route::group(['middleware' => 'admin'], function() {
	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard'); 		//OK----------
	Route::get('show-details', 'DashboardController@showStudentDetails')->name('admin.student.show.details');
	Route::get('registration-show-details', 'DashboardController@showStudentRegistrationDetails')->name('admin.student.Registration.details');
// 	Route::get('token', 'DashboardController@passportTokenCreate')->name('admin.token');

	Route::get('profile', 'DashboardController@proFile')->name('admin.profile');	//OK--------------
// 	Route::get('profile-show', 'DashboardController@proFileShow')->name('admin.profile.show');	//OK------------
	Route::get('profile-show/{profile_pic}', 'DashboardController@proFilePhotoShow')->name('admin.profile.photo.show'); 	//OK-------------------
// 	Route::post('profile-update', 'DashboardController@profileUpdate')->name('admin.profile.update');	//OK-----------
// 	Route::post('password-change', 'DashboardController@passwordChange')->name('admin.password.change');	//OK----------
// 	Route::get('profile-photo', 'DashboardController@profilePhoto')->name('admin.profile.photo');	//OK---------
// 	Route::post('upload-photo', 'DashboardController@profilePhotoUpload')->name('admin.profile.photo.upload');	//OK-------
	Route::get('photo-refrash', 'DashboardController@profilePhotoRefrash')->name('admin.profile.photo.refrash');	//OK----------

// 	//---------------account-----------------------------------------	
	Route::prefix('account')->group(function () {
	    Route::get('form', 'AccountController@formNewUser')->name('admin.account.form');		//OK------------
	    Route::post('store', 'AccountController@newUserStore')->name('admin.account.newuser.store');	//OK---------
		Route::get('list', 'AccountController@index')->name('admin.account.list');		//OK----------
		Route::get('list-user-generate1', 'AccountController@pdfGenerate')->name('admin.account.list.user.generate');	//OK------

		// Route::get('access', 'AccountController@access')->name('admin.account.access');
// 		Route::get('hot-menu', 'AccountController@accessHotMenu')->name('admin.account.access.hotmenu');
// 		Route::get('menuTable', 'AccountController@menuTable')->name('admin.account.menuTable');
// 		Route::get('access/hotmenu', 'AccountController@accessHotMenuShow')->name('admin.account.access.hotmenuTable');
// 		Route::post('access-store', 'AccountController@accessStore')->name('admin.userAccess.add');
// 		Route::post('access-hot-menu-store', 'AccountController@accessHotMenuStore')->name('admin.userAccess.hotMenuAdd');
		
		Route::get('edit/{id}', 'AccountController@edit')->name('admin.account.edit');		//OK----------
		Route::post('update/{id}', 'AccountController@update')->name('admin.account.edit.post');	//OK---------

// 		Route::get('delete/{account}', 'AccountController@destroy')->name('admin.account.delete');	
		Route::get('status/{id}', 'AccountController@toggleStatus')->name('admin.account.toggle.status');	 //OK---------

// 		Route::get('r--status/{account}', 'AccountController@rstatus')->name('admin.account.r_status');	 
// 		Route::get('w-status/{account}', 'AccountController@wstatus')->name('admin.account.w_status');	 
// 		Route::get('d-status/{account}', 'AccountController@dstatus')->name('admin.account.d_status');
// 		Route::get('minu/{account}', 'AccountController@minu')->name('admin.account.minu');	

		Route::get('role', 'AccountController@roleMenuPermission')->name('admin.account.role');		//OK---------
		Route::get('role-menu', 'AccountController@roleMenuTable')->name('admin.account.roleMenuTable'); 	//OK-----
		Route::post('role-menu-store', 'AccountController@roleMenuStore')->name('admin.roleAccess.subMenuStore');	//OK--------

// 		//Default Quick/Hot Menu Permission
		Route::get('role-quick-menu-view', 'AccountController@quickView')->name('admin.roleAccess.quick.view');	//OK------
		Route::get('defult-role-menu-show', 'AccountController@defultRoleQuickMenuShow')->name('admin.account.role.default.quick.menu');	//OK----
		Route::post('default-role-quick-menu-store', 'AccountController@defaultRoleQuickStore')->name('admin.roleAccess.quick.role.menu.store');	//OK----------

		Route::get('class-access', 'AccountController@classAccess')->name('admin.account.classAccess'); 	//OK----
		Route::get('class-all', 'AccountController@classAllSelect')->name('admin.account.classAllSelect'); 	//OK-----		
		Route::get('reset-password', 'AccountController@resetPassWord')->name('admin.account.reset.password'); 	//OK------
		Route::post('reset-password-change', 'AccountController@resetPassWordChange')->name('admin.account.reset.password.change');	//OK------

// 		//Menu/SubMenu Reset Orders
		Route::get('menu-ordering', 'AccountController@menuOrdering')->name('admin.account.menu.ordering');		//OK--------
		Route::get('menu-ordering-store', 'AccountController@menuOrderingStore')->name('admin.account.menu.ordering.store');	//OK------- 
		Route::get('submenu-ordering-store', 'AccountController@subMenuOrderingStore')->name('admin.account.submenu.ordering.store');	//OK---- 
		Route::get('menu-filter/{id}', 'AccountController@menuFilter')->name('admin.account.menu.filte'); 	//OK-------
		Route::post('menu-report', 'AccountController@menuReport')->name('admin.account.menu.report');	//OK-------

// 		Route::get('user-menu-assign-report/{id}', 'AccountController@defaultUserMenuAssignReport')->name('admin.account.user.menu.assign.report'); 
		Route::post('default-user-role-report-generate/{id}/{report_type}', 'AccountController@defaultUserRolrReportGenerate')->name('admin.account.default.user.role.report.generate');	//OK----------- 
		Route::get('class-user-assign-report-generate/{user_id}', 'AccountController@ClassUserAssignReportGenerate')->name('admin.account.class.user.assign.report.generate');		//OK---------- 
		
						
// 		// Route::get('status/{minu}', 'AccountController@minustatus')->name('admin.minu.status'); 
	});
	});
	
	Route::prefix('user-report')->group(function () {
	    Route::get('/', 'UserReportController@index')->name('admin.user.report');		//OK--------
	    Route::get('report-type-filter', 'UserReportController@reportTypeFilter')->name('admin.user.report.type.filter');	//OK------
	    Route::post('filter', 'UserReportController@filter')->name('admin.user.report.filter');		//OK---------
		     
	});
// 	//---------------master-----------------------------------------	
	Route::prefix('master-minu')->group(function () {
		Route::prefix('academic-year')->group(function () {
		    Route::get('list', 'AcademicYearController@index')->name('admin.academicYear.list');	//OK-------------

// 		    Route::post('store', 'AcademicYearController@store')->name('admin.academicYear.store');

		    Route::get('edit/{id?}', 'AcademicYearController@edit')->name('admin.academicYear.edit');	//OK-----------
		    Route::get('default-value/{id}', 'AcademicYearController@defaultValue')->name('admin.academicYear.default.value');	//OK-----
		    Route::get('pdf-generate', 'AcademicYearController@pdfGenerate')->name('admin.academicYear.pdf.generate');	//OK---------
		    Route::post('update/{id?}', 'AcademicYearController@update')->name('admin.academicYear.update');	//OK--------
		    Route::get('delete/{id}', 'AcademicYearController@destroy')->name('admin.academicYear.delete');	//OK------

// 		    //Document Types
		    Route::get('document-type', 'DocumentTypeController@index')->name('admin.document.type');	//OK----

// 		    Route::post('document-store', 'DocumentTypeController@store')->name('admin.document.store');

		    Route::get('document-edit/{id?}', 'DocumentTypeController@edit')->name('admin.document.type.edit');	//OK---------
		    Route::post('document-update/{id?}', 'DocumentTypeController@update')->name('admin.document.type.update');	//OK-----
		    Route::get('document-delete/{id}', 'DocumentTypeController@destroy')->name('admin.document.type.delete');	//OK-----
		    Route::get('report', 'DocumentTypeController@pdfGenerate')->name('admin.document.type.report');	//OK----------
		     
		});
		Route::prefix('payment-mode')->group(function () {
		    Route::get('list', 'PaymentModeController@index')->name('admin.paymentMode.list');	//OK----------

// 		    Route::post('store', 'PaymentModeController@store')->name('admin.paymentMode.store');
		    
		    Route::get('edit/{id?}', 'PaymentModeController@edit')->name('admin.paymentMode.edit');		//OK----
		    Route::post('update/{id?}', 'PaymentModeController@update')->name('admin.paymentMode.update');	//OK---------
		    Route::get('delete/{id}', 'PaymentModeController@destroy')->name('admin.paymentMode.delete');	//OK-----
		    Route::get('pdf-generate', 'PaymentModeController@pdfGenerate')->name('admin.paymentMode.pdf.generate');	//OK---
		     
		});
	 
	     
	});
// 		//---------------minu-----------------------------------------	
// 	Route::prefix('minu')->group(function () {
	    
// 		Route::get('status/{minu}', 'MinuController@status')->name('admin.minu.status');	 
// 		Route::get('r--status/{minu}', 'MinuController@rstatus')->name('admin.minu.r_status');	 
// 		Route::get('w-status/{minu}', 'MinuController@wstatus')->name('admin.minu.w_status');	 
// 		Route::get('d-status/{minu}', 'MinuController@dstatus')->name('admin.minu.d_status');
// 		Route::get('minu/{minu}', 'MinuController@minu')->name('admin.minu.minu');
// 		Route::post('menu-permission-check', 'MinuController@menuPermissionCheck')->name('admin.account.menu.permission.check'); 	 
// 	});
// 	//---------------Class create----------------------------------------
	Route::group(['prefix' => 'class'], function() {
	    Route::get('/', 'ClassTypeController@index')->name('admin.class.list');		//OK----------

// 	    Route::get('search', 'ClassTypeController@search')->name('admin.class.search');
// 	    Route::post('add', 'ClassTypeController@store')->name('admin.class.add');

	    Route::get('edit/{id?}', 'ClassTypeController@edit')->name('admin.class.edit');	//OK-----------
	    Route::post('update/{id?}', 'ClassTypeController@update')->name('admin.class.update');	//OK----------
	    Route::get('deleteclass/{id}', 'ClassTypeController@deleteclass')->name('admin.class.deleteclass');	//OK---------
	    Route::get('pdf-generate', 'ClassTypeController@pdfGenerate')->name('admin.class.pdf.generate');	//OK----------
	});
// 		//---------------Section Type create----------------------------------------
	Route::group(['prefix' => 'section'], function() {
	    Route::get('/', 'SectionTypeController@index')->name('admin.section.list');		//OK---------
	    Route::get('select', 'SectionTypeController@selectList')->name('admin.section.selectList');		//OK ---------

// 	    Route::get('search', 'SectionTypeController@search')->name('admin.section.search');
// 	    Route::post('add', 'SectionTypeController@store')->name('admin.sectionType.add');

	    Route::get('edit/{id?}', 'SectionTypeController@edit')->name('admin.section.edit');	//OK------------
	    Route::post('update/{id?}', 'SectionTypeController@update')->name('admin.section.update');	//OK--------
	    Route::get('delete/{id}', 'SectionTypeController@destroy')->name('admin.section.delete');	//OK--------
	    Route::get('pdf-generate', 'SectionTypeController@pdfGenerate')->name('admin.section.pdf.generate');	//OK---------
	    Route::get('class-section', 'SectionTypeController@classWiseSection')->name('admin.class.wise.section');	//OK--------

	});
// 	// ---------------Section with class----------------------------------------
	Route::group(['prefix' => 'manage-section'], function() {
	    Route::get('/', 'SectionController@index')->name('admin.manageSection.list');	//OK----------

	    Route::get('search', 'SectionController@search')->name('admin.manageSection.search');	//OK----------

	    Route::get('search2', 'SectionController@search2')->name('admin.manageSection.search2');	//OK---------
	    Route::get('section-by-class', 'SelectBoxController@getScetionByClass')->name('admin.selbox.getsection.byclass');	//OK---------------
	    Route::post('add', 'SectionController@store')->name('admin.section.add');		//OK-------------

// 	    Route::get('{manageSectionEdit}/edit', 'SectionController@edit')->name('admin.manageSection.edit');
// 	    Route::post('{manageSection}/update', 'SectionController@update')->name('admin.manageSection.update');
// 	    Route::get('{manageSection}/delete', 'SectionController@destroy')->name('admin.manageSection.delete');
// 	    Route::get('selectBoxSection', 'SectionController@sectionSelectBox')->name('admin.section.selectBox');        

	    Route::get('class-section-pdf', 'SectionController@pdfGenerate')->name('admin.section.class.section.pdf');  //OK-----------      
	});
// 		// ---------------User with class----------------------------------------
	Route::group(['prefix' => 'user-class'], function() {
	    Route::get('/', 'AccountController@userClass')->name('admin.userClass.list');	//OK----------	   
	    Route::post('add', 'AccountController@userClassStore')->name('admin.userClass.add');	//OK---------
// 	    // Route::get('{manageSectionEdit}/edit', 'SectionController@edit')->name('admin.manageSection.edit');
// 	    // Route::post('{manageSection}/update', 'SectionController@update')->name('admin.manageSection.update');
// 	    // Route::get('{manageSection}/delete', 'SectionController@destroy')->name('admin.manageSection.delete');        
	});
// 	//---------------Class fee----------------------------------------
// 	 Route::group(['prefix' => 'class-fee'], function() {
//         Route::group(['prefix' => 'class-fee'], function() {
//              Route::get('/', 'ClassFeeController@index')->name('admin.account.classfee.list');
//             Route::post('add', 'ClassFeeController@store')->name('admin.account.classfee.add');
//             Route::get('{classFee}/edit', 'ClassFeeController@edit')->name('admin.account.classfee.edit');
//             Route::post('{classFee}/update', 'ClassFeeController@update')->name('admin.account.classfee.update');
//             Route::get('{classFee}/delete', 'ClassFeeController@destroy')->name('admin.account.classfee.delete');
//         });
//     });
// 	//---------------Student--------------------------------------------------------------------
	Route::group(['prefix' => 'student'], function() {
	    Route::get('addstudent', 'StudentController@addStudentForm')->name('admin.student.form');	//OK------------
// 	    Route::get('editadmapp/{student}', 'StudentController@editAppFormStudent')->name('admin.admapp.edit'); //OK---------
// 	    Route::get('editadmappstuform/{student}', 'StudentController@editadmappstuform')->name('admin.admapp.editadmappstuform'); //OK---------
	    Route::get('view/{student}/{source?}', 'StudentController@show')->name('admin.student.view');	//OK---------

	     Route::get('preview/{id}', 'StudentController@previewshow')->name('admin.student.preview');	   //Pending
	     Route::get('profile-download/{id}', 'StudentController@profileDownload')->name('admin.student.profile.download');	   //Pending
// 	     Route::get('{student}/edit', 'StudentController@edit')->name('admin.student.edit');
// 	     Route::get('{student}/delete', 'StudentController@destroy')->name('admin.student.delete');
// 	     Route::get('{student}/totalfeeedit', 'StudentController@totalfeeedit')->name('admin.student.totalfeeedit');
// 	     Route::post('{student}/totalfeeupdate', 'StudentController@totalfeeupdate')->name('admin.student.totalfeeupdate');

// 	     Route::post('add', 'StudentController@store')->name('admin.student.post');
	     
	     Route::post('add', 'StudentController@studentAddNewStep1Store')->name('admin.student.addnew.step1store');	//OK----------------

// 	     Route::post('{student}/update', 'StudentController@update')->name('admin.student.update');
	     Route::post('{student}/view-update', 'StudentController@updateStudentInfo')->name('admin.student.view-update');	//Pending
// 	     Route::post('{student}/profileupdate', 'StudentController@profileupdate')->name('admin.student.profileupdate');
	     Route::post('show-list/{type}', 'StudentController@showList')->name('admin.student.show.list'); 
	     Route::get('show-form', 'StudentController@showForm')->name('admin.student.show');
// 	     Route::get('student-image-upload', 'StudentController@studentImageUpload')->name('admin.student.image.upload');
// 	     Route::get('student-image-upload-list/{id?}', 'StudentController@studentImageUploadList')->name('admin.student.image.upload.list');
// 	     Route::post('student-image-upload-store/{id}', 'StudentController@studentImageUploadStore')->name('admin.student.image.upload.store');
// 	     Route::get('student-document-verify', 'StudentController@studentDocumentVerify')->name('admin.student.document.verify');
// 	     Route::get('student-document-verify-list/{id}', 'StudentController@studentDocumentVerifyList')->name('admin.student.document.verify.list');
// 	     Route::get('student-document-verify-view/{id}', 'StudentController@studentDocumentVerifyView')->name('admin.student.document.verify.view');
// 	     Route::get('student-document-verify-print/{id}', 'StudentController@studentDocumentVerifyPrint')->name('admin.student.document.verify.print');
	    
// 	     Route::get('{student}/password-reset', 'StudentController@passwordReset')->name('admin.student.passwordreset'); 
	     Route::get('image/{image}', 'StudentController@image')->name('admin.student.image');		//Pending -- OK
	     Route::get('image-upload/{student_id}', 'StudentController@imageUpload')->name('admin.student.image.upload');		//Pending --Dilip
	     Route::post('image-upload-save/{student_id}', 'StudentController@imageUploadSave')->name('admin.student.image.upload.save'); // Pending -- Dilip
// 	     Route::get('image/{student}/update', 'StudentController@imageUpdate')->name('admin.student.profilepic.update');
// 	     Route::post('imageweb', 'StudentController@imageWebUpdate')->name('admin.student.profilepic.webupdate');
	     Route::get('camera/{student_id}', 'StudentController@camera')->name('admin.student.camera');		//Pending
	     Route::post('camera-save/{student_id}', 'StudentController@cameraSave')->name('admin.student.camera.save');		//Pending
// 	     Route::get('export', 'StudentController@excelData')->name('admin.student.excel');
// 	     Route::get('import-view', 'StudentController@importview')->name('admin.student.excel.import');	      
// 	     Route::get('import-show', 'StudentController@importshow')->name('admin.student.excel.show');	      
// 	     Route::get('birthday', 'StudentController@birthday')->name('admin.student.birthday.list');	      
// 	     Route::post('birthday-search', 'StudentController@birthdaySearch')->name('admin.birthday.search'); 
// 	     Route::get('birthday-card/{id}', 'StudentController@birthdayPrint')->name('admin.birthday.card.pdf'); 
// 	     Route::get('birthday-sms-send/{student_id}{id}', 'StudentController@birthdaySmsSend')->name('admin.birthday.card.sms.send'); 
// 	     Route::post('birthday-card-all', 'StudentController@birthdayPrintAll')->name('admin.birthday.card.pdfAll');   
// 	     Route::post('import', 'StudentController@importStudent')->name('admin.student.excel.store');	      
	     Route::get('birthday-dashboard', 'StudentController@birthdayDashboard')->name('admin.student.birthday.dashboard');		//Pending	      
	     Route::get('birthday-upcoming', 'StudentController@birthdayDashboardUpcoming')->name('admin.student.birthday.dashboard.upcoming');		//Pending	      
	     
// 		 Route::get('new-admission', 'StudentController@newAdmission')->name('admin.student.new.adminssion');
// 		 Route::get('new-admission-status-change/{id}', 'StudentController@newAdmissionStatusChange')->name('admin.new.student.status.change');
// 		 Route::get('reset-admission', 'StudentController@resetAdmission')->name('admin.student.reset.adminssion');
// 		 Route::post('reset-admission-student-show', 'StudentController@resetAdmissionStudentShow')->name('admin.student.reset.adminssion.student.show');	      
		 
// 		Route::get('reset-roll-no', 'StudentController@resetRollNo')->name('admin.student.reset.roll');
// 		Route::post('reset-roll-no-show', 'StudentController@resetRollNoshow')->name('admin.student.reset.roll.no.show');
// 		Route::post('reset-roll-no-show-update', 'StudentController@resetRollNoshowUpdate')->name('admin.student.reset.roll.no.show.update');
// 		Route::post('reset-roll-no-update', 'StudentController@resetRollNoUpdate')->name('admin.student.reset.roll.no.update');
// 		Route::get('student-request-update', 'StudentController@studentRequestUpdate')->name('admin.student.request.update');
// 		Route::get('student-serach/{menu_id}', 'StudentController@studentSearch')->name('admin.student.view.search');

		Route::get('student-serach-by-reg-app-no/{type}', 'StudentController@studentSearchByRegisAppNo')->name('admin.student.search.by.regsapp.details.show');		//OK---------------------

// 		//----------student role url -------------------
// 		Route::get('registration-form', 'StudentController@registrationFormByStudent')->name('admin.student.registration.form');		//OK--------------
		Route::get('registration-loadclass/{student_id?}', 'SelectBoxController@getClassAdmissionOpenByYear')->name('selbox.class.admission.yearwise');//OK Pending--------------
		Route::get('subject-year-class-wise', 'SelectBoxController@getSubjectsByExamScheduleAY_Class')->name('selbox.subject.year.class.wise');//OK Pending--------------


// 		Route::get('admission-class-avalval', 'StudentController@academicYearOnchange')->name('admin.student.registration.academicYear'); 


// 		Route::post('registration-store', 'StudentController@registrationStore')->name('admin.student.registration.store');		
		
// 		Route::post('registration-step1store', 'StudentController@studentNewAdmFormStep1Store')->name('admin.student.adm.appform.step1store');	//OK---------------	

// 		Route::get('application-status', 'StudentController@applicationStatus')->name('admin.student.adm.application.status');

// 		Route::get('registration-list-filter/{id?}', 'StudentController@registrationListFilter')->name('admin.student.registration.list.filter'); 
// 		Route::get('final-submit/{id?}', 'StudentController@registrationFinalSubmit')->name('admin.student.registration.final.submit'); 
		Route::get('profile-view/{id?}', 'StudentController@registrationProfileView')->name('admin.student.registration.profile.view'); 	//Pending

//         //-----------student school wise admission-------- 
        Route::get('school-help-desk-admission', 'StudentController@schoolWiseAdmission')->name('admin.student.school.wise.admission');	//OK Pending-----------
        Route::get('school-help-desk-edit-adm-app-form', 'StudentController@admAppEditForm')->name('admin.student.school.edit.adm.app.form');	//OK Pending-----------
        Route::post('school-help-desk-edit-adm-app-search', 'StudentController@admAppEditFormSearch')->name('admin.student.school.edit.adm.app.search');	//OK Pending-----------
        Route::get('school-help-desk-edit-adm-app-edit/{student_id}', 'StudentController@admAppEditFormEdit')->name('admin.student.school.edit.adm.app.edit');	//OK Pending-----------
        Route::post('school-help-desk-edit-adm-app-store/{student_id}', 'StudentController@admAppEditFormStore')->name('admin.student.school.edit.adm.app.store');	//OK Pending-----------

        Route::get('school-help-desk-acad-wise-class', 'StudentController@admAppAcadWiseClass')->name('admin.student.school.acad.wise.class');	//OK Pending-----------
        Route::get('school-help-desk-acad-wise-subject', 'StudentController@admAppAcadWiseSubject')->name('admin.student.school.acad.wise.subject');	//OK Pending-----------
        
        Route::post('school-helpdesk-admission-step1store', 'StudentController@helpDeskNewAdmFormStep1Store')->name('admin.helpdesk.school.admission.step1store');	//Pending
        Route::get('school-helpdesk-admission-test-div', 'StudentController@getExamScheduleDetailBy_AY_Class')->name('admin.helpdesk.school.admission.test.div');	//Pending
        Route::get('school-helpdesk-admission-image', 'StudentController@helpDeskNewAdmImage')->name('admin.helpdesk.school.admission.image');	//Pending
        Route::get('school-helpdesk-admission-view/{student_id}/{source}', 'StudentController@helpDeskNewAdmView')->name('admin.helpdesk.school.admission.view');	//Pending
        Route::get('school-helpdesk-student-info/{student_id}', 'StudentController@helpDeskNewAdmStudentInfo')->name('admin.helpdesk.school.student.info');	//Pending
        Route::get('school-helpdesk-admission-download/{student_id}', 'StudentController@helpDeskNewAdmDownload')->name('admin.helpdesk.school.admission.download');	//Pending

//         //-----------admission-test-marks-------- 
//         Route::get('admission-test-marks', 'StudentController@admissionTestMarks')->name('admin.student.admission.test.marks');	 
//         Route::post('admission-test-marks-search', 'StudentController@admissionTestMarksSearch')->name('admin.student.admission.test.marks.search'); 
//         Route::get('admission-test-marks-filter/{class_id}/{academicYear_id}/{condition_id}', 'StudentController@admissionTestMarksfilter')->name('admin.student.admission.test.marks.filter');	 
//         Route::post('admission-test-marks-store', 'StudentController@admissionTestMarksStore')->name('admin.student.admission.test.marks.store');	 
//         //-----------admission-test-marks-------- 
//         Route::get('take-admission', 'StudentController@takeAdmission')->name('admin.student.take.admission'); 
//         Route::post('take-admission-store', 'StudentController@takeAdmissionStore')->name('admin.student.take.admission.store'); //-----------new-application-report-------- 
//         Route::get('new-application-report', 'StudentController@newApplicationReport')->name('admin.student.new.application.report'); 
//         Route::post('new-application-filter', 'StudentController@newApplicationReportFilter')->name('admin.student.new.application.report.filter'); 
		});

// 	 	// ---------------student-fine-details ----------------------------------------
// 	 Route::group(['prefix' => 'student-fine-details'], function() {
// 	    Route::get('/', 'StudentFineDetailController@index')->name('admin.student.fine.details');
// 	    Route::post('show', 'StudentFineDetailController@show')->name('admin.student.fine.details.show');
// 	    Route::get('add-form/{id?}', 'StudentFineDetailController@addForm')->name('admin.student.fine.details.addform');
// 	    Route::post('store/{id?}', 'StudentFineDetailController@store')->name('admin.student.fine.details.store');
// 	    Route::get('edit/{id?}', 'StudentFineDetailController@edit')->name('admin.student.fine.details.edit');
// 	    Route::get('delete/{id?}', 'StudentFineDetailController@delete')->name('admin.student.fine.details.delete');
// 	    Route::post('update/{id?}', 'StudentFineDetailController@update')->name('admin.student.fine.details.update');
	     
	    
// 	 });
// 	 Route::group(['prefix' => 'absent-fine-details'], function() {
// 	    Route::get('absent-index', 'StudentFineDetailController@absentIndex')->name('admin.absent.fine.details');
// 	    Route::post('absent-show', 'StudentFineDetailController@absentShow')->name('admin.absent.fine.details.show');
// 	    Route::post('absent-store', 'StudentFineDetailController@absentStore')->name('admin.absent.fine.details.store');
	    
	     
	    
// 	 });
// 	 // ---------------Submit Application Form ----------------------------------------
// 	 Route::group(['prefix' => 'submit-application-form'], function() {
// 	    Route::get('/', 'SubmitApplicationFormController@index')->name('admin.submit.application.form');
// 	    Route::post('search', 'SubmitApplicationFormController@search')->name('admin.submit.application.search');
// 	    Route::post('submitted', 'SubmitApplicationFormController@submitted')->name('admin.submit.application.submitted');
	     
	    
// 	 });
// 	 Route::group(['prefix' => 'application-scrutiny'], function() {
// 	    Route::get('scrutiny', 'SubmitApplicationFormController@scrutiny')->name('admin.submit.application.scrutiny');
// 	    Route::get('filter/{id?}', 'SubmitApplicationFormController@filter')->name('admin.submit.application.filter');
// 	    Route::get('remark/{id}/{status}', 'SubmitApplicationFormController@remark')->name('admin.submit.application.remark');
// 	    Route::post('remark-store/{id}', 'SubmitApplicationFormController@remarkStore')->name('admin.submit.application.remark.store');
	    
	  
	    
// 	 });
// 	 Route::group(['prefix' => 'application'], function() {
// 	    Route::get('update', 'SubmitApplicationFormController@applicationUpdate')->name('admin.submit.application.update');
// 	    Route::post('update-redirect', 'SubmitApplicationFormController@applicationUpdateRedirect')->name('admin.submit.application.update.redirect');
	    
// 	 });
	Route::group(['prefix' => 'default-Value'], function() {
		Route::get('/', 'StudentDefaultValueController@index')->name('admin.defaultValue.list');	//OK------
	    Route::post('add', 'StudentDefaultValueController@store')->name('admin.defaultValue.post');		//OK--------

// 	    Route::get('template/{id}', 'StudentDefaultValueController@template')->name('admin.defaultValue.template');
// 	    Route::get('admission-schedule', 'StudentDefaultValueController@admissionSchedule')->name('admin.defaultValue.admission.schedule');
// 	    Route::post('admission-schedule-store', 'StudentDefaultValueController@admissionScheduleStore')->name('admin.defaultValue.admission.schedule.store');
	    
	});
// 	 // ---------------Parents Info----------------------------------------
	 Route::group(['prefix' => 'parents-info'], function() {
	    Route::post('Parents-add', 'ParentInfoController@store')->name('admin.parents.store');
	    Route::get('Parents-list/{student_id}', 'ParentInfoController@perentTable')->name('admin.parents.list');	//Pending
	    Route::get('Parents-add-form/{id}', 'ParentInfoController@perentInfoAddForm')->name('admin.parents.add.form');//Pending
	    Route::get('delete/{parent_id}/{student_id}', 'ParentInfoController@destroy')->name('admin.parents.delete');	//Pending
	    Route::get('edit/{parent_id}', 'ParentInfoController@edit')->name('admin.parents.edit');		//Pending
	    Route::post('update/{parent_id}', 'ParentInfoController@update')->name('admin.parents.update');//Pending
	    Route::get('image/{id}', 'ParentInfoController@image')->name('admin.parents.image');	//Pending
	    Route::post('image-store/{id}', 'ParentInfoController@imageStore')->name('admin.parents.image.store');//Pending
	    Route::get('image-show/{image}', 'ParentInfoController@imageShow')->name('admin.parents.image.show');//Pending
// 	    Route::get('image-refresh/{image}', 'ParentInfoController@imageRefresh')->name('admin.parents.image.refresh');//Pending
	    Route::get('parent-add-new', 'ParentInfoController@parentAddNew')->name('admin.parents.add.new'); //Pending
	    Route::get('parent-search', 'ParentInfoController@parentSearch')->name('admin.parents.search');//Pending
	    Route::post('parent-search-post', 'ParentInfoController@parentSearchPost')->name('admin.parents.search.post');//Pending
	    Route::get('parent-add-existing', 'ParentInfoController@parentExisting')->name('admin.parents.existing');//Pending
	    Route::post('parent-add-existing-store', 'ParentInfoController@parentExistingStore')->name('admin.parents.existing.store');//Pending
	 });
	Route::group(['prefix' => 'address'], function() {
	    Route::get('address/{student_id}', 'StudentAddressDetailController@address')->name('admin.parents.address');	//Pending
	    Route::get('add-address/{student_id}', 'StudentAddressDetailController@addAddress')->name('admin.parents.add.address');		//Pending
// 	    Route::get('sameAS', 'StudentAddressDetailController@sameAS')->name('admin.parents.add.address.sameas');
// 	    Route::post('address-store', 'StudentAddressDetailController@addressStore')->name('admin.parents.address.store');
	    Route::get('address-edit/{id}', 'StudentAddressDetailController@addressEdit')->name('admin.parents.address.edit');
	    Route::get('address-delete/{id}', 'StudentAddressDetailController@addressDelete')->name('admin.parents.address.delete');
	    Route::post('address-update/{id}', 'StudentAddressDetailController@addressUpdate')->name('admin.parents.address.update');
	});
// 	  	// ---------------Medical Info----------------------------------------
	Route::group(['prefix' => 'medical-info'], function() {
	    Route::get('list/{id}', 'StudentMedicalInfoController@medicalInfoList')->name('admin.medical.info.list');	//Pending
	    Route::get('add-form/{id}', 'StudentMedicalInfoController@medicalInfoAddForm')->name('admin.medical.info.add.form');
	    Route::post('store/{id}', 'StudentMedicalInfoController@store')->name('admin.student.medical.store');

	    Route::get('edit/{id}', 'StudentMedicalInfoController@edit')->name('admin.medical.edit');
	    Route::get('delete/{id}', 'StudentMedicalInfoController@destroy')->name('admin.medical.delete');
// 	    Route::get('view/{id}', 'StudentMedicalInfoController@show')->name('admin.medical.view');
// 	    Route::post('update/{id}', 'StudentMedicalInfoController@update')->name('admin.medical.update');
// 	    Route::get('pdf-generate/{id}', 'StudentMedicalInfoController@pdfGenerate')->name('admin.medical.pdf.generate');
// 	    Route::get('send-sms/{id}', 'StudentMedicalInfoController@medicalSendSms')->name('admin.medical.send.sms');
// 	    Route::get('send-email/{id}', 'StudentMedicalInfoController@medicalSendEmail')->name('admin.medical.send.email');
// 	    Route::get('template-view/{id}', 'StudentMedicalInfoController@templateView')->name('admin.medical.template.view');
// 	    Route::get('medical-add', 'StudentMedicalInfoController@studentMedicalAdd')->name('admin.medical.student.medical.add');
// 	    Route::get('student-show', 'StudentMedicalInfoController@studentShow')->name('admin.medical.student.show');
	}); 
// 	   	// ---------------Sibling Info----------------------------------------
	Route::group(['prefix' => 'sibling-info'], function() {
// 	    Route::get('show/{student}', 'StudentSiblingInfoController@show')->name('admin.sibling.show');
	    Route::get('table-show/{student_id}', 'StudentSiblingInfoController@tableShow')->name('admin.sibling.table.show');	//Pending
	    Route::get('add-form/{student_id}', 'StudentSiblingInfoController@addForm')->name('admin.sibling.add.form');	//Pending
	    Route::post('add/{student_id}', 'StudentSiblingInfoController@store')->name('admin.sibling.store');		//Pending
	    Route::get('delete/{student_id}', 'StudentSiblingInfoController@destroy')->name('admin.sibling.delete');	//Pending
// 	    Route::get('edit/{id}', 'StudentSiblingInfoController@edit')->name('admin.sibling.edit');
// 	    Route::post('update/{id}', 'StudentSiblingInfoController@update')->name('admin.sibling.update');
	});
	
	// ---------------Student Info Tab----------------------------------------
	Route::group(['prefix' => 'student-info'], function() {
	    Route::get('table-show/{student_id}', 'StudentController@student_info_show')->name('admin.student.table.show');	//Pending--OK
	    Route::get('info-edit/{student_id}', 'StudentController@student_info_edit')->name('admin.student.info.edit');	//Pending--OK
	});

// 	Route::group(['prefix' => 'student-subject'], function() {
	    Route::get('list/{student_id}', 'StudentSubjectController@index')->name('admin.studentSubject.list');	//Pending
	    Route::get('add/{student_id}', 'StudentSubjectController@addForm')->name('admin.studentSubject.add');
	    Route::post('store', 'StudentSubjectController@store')->name('admin.studentSubject.store');
	    Route::get('delete/{id}', 'StudentSubjectController@destroy')->name('admin.studentSubject.delete');
// 	    Route::get('edit', 'StudentSubjectController@edit')->name('admin.studentSubject.edit');
// 	    Route::get('update', 'StudentSubjectController@edit')->name('admin.studentSubject.update');
// 	});
 
// 	     	// ---------------sport-hobby----------------------------------------
	 Route::group(['prefix' => 'sport-hobby'], function() {
	    Route::get('list/{id}', 'StudentSportHobbyController@show')->name('admin.student.sports.list');	//Pending
	    Route::get('add/{id?}', 'StudentSportHobbyController@addForm')->name('admin.student.sports.add');
	    Route::post('store/{id?}', 'StudentSportHobbyController@store')->name('admin.student.sports.store');
	    Route::get('edit/{id?}', 'StudentSportHobbyController@edit')->name('admin.student.sports.edit');
	    Route::get('delete/{id}', 'StudentSportHobbyController@destroy')->name('admin.student.sports.delete');
	 });
// 	 // ---------------award-level----------------------------------------
	 Route::group(['prefix' => 'award-level'], function() {
	    Route::get('/', 'AwardLevelController@index')->name('admin.award.level');	//OK----------
	    Route::get('edit/{id?}', 'AwardLevelController@edit')->name('admin.award.level.edit');	//OK---------
	    Route::post('store/{id?}', 'AwardLevelController@update')->name('admin.award.level.update');	//OK--------

// 	    Route::get('list', 'AwardLevelController@list')->name('admin.award.level.list');

	    Route::get('delete/{id}', 'AwardLevelController@destroy')->name('admin.award.level.delete');	//OK-------
	    Route::get('report', 'AwardLevelController@pdfGenerate')->name('admin.award.level.report');	//OK--------
	    
	 });
// 	      	// ---------------student Document----------------------------------------
	 Route::group(['prefix' => 'student-document'], function() {
	    Route::get('list/{student_id}', 'StudentDocumentController@index')->name('admin.student.document.list');
	    Route::get('addform/{student_id}', 'StudentDocumentController@addForm')->name('admin.student.document.add');
	    Route::post('store/{student_id}', 'StudentDocumentController@store')->name('admin.student.document.store');
	    Route::get('download/{document}', 'StudentDocumentController@download')->name('admin.document.download');
	    Route::get('delete/{document}', 'StudentDocumentController@destroy')->name('admin.document.delete');
// 	    Route::get('list/{id}', 'StudentDocumentController@documentList')->name('admin.document.list');
// 	    Route::get('edit', 'StudentDocumentController@edit')->name('admin.document.edit');
// 	    Route::get('update', 'StudentDocumentController@edit')->name('admin.document.update');
// 	    Route::get('verify/{document_id}', 'StudentDocumentController@verify')->name('admin.document.verify');
// 	    Route::get('reject/{document_id}', 'StudentDocumentController@reject')->name('admin.document.reject');
// 	    Route::get('reject-store', 'StudentDocumentController@rejectStore')->name('admin.document.reject.store');
	 });
// 	 // ---------------Document-report---------------------------------------
	 // Route::group(['prefix' => 'document'], function() { 
	    Route::get('/', 'DocumentReportController@index')->name('admin.document.perort');
// 	    Route::post('filter', 'DocumentReportController@filter')->name('admin.document.filter');
	     
	 // });

// 	 		// ---------------Suject Type----------------------------------------
	 	Route::group(['prefix' => 'subject-type'], function() {
	 	    Route::get('/', 'SubjectTypeController@index')->name('admin.subjectType.list');		//OK---------

// 	 	   // Route::get('search', 'SubjectTypeController@search')->name('admin.subject.search');
// 	 	   Route::post('SubjectType-add', 'SubjectTypeController@store')->name('admin.subjectType.add');

	 	   Route::get('edit/{id?}', 'SubjectTypeController@edit')->name('admin.subjectType.edit');	//OK----------
	 	   Route::post('update/{id?}', 'SubjectTypeController@update')->name('admin.subjectType.update');	//OK-------
	 	   Route::get('delete/{id}', 'SubjectTypeController@destroy')->name('admin.subjectType.delete');	//OK-------
	 	   Route::get('pdf-generate', 'SubjectTypeController@pdfGenerate')->name('admin.subjectType.pdf.generate');	//OK--------
	         
	 	}); 
  
// 	 	// ---------------Subject----------------------------------------
	 	Route::group(['prefix' => 'subject'], function() {
	 	    Route::get('/', 'SubjectController@index')->name('admin.subject.manageSubject');	//OK----------
	 	    Route::get('search', 'SubjectController@search')->name('admin.subject.search');		//OK-----------
	 	    Route::post('add', 'SubjectController@store')->name('admin.subject.add');	//OK----------

// 	 	    Route::get('{manageSubjectEdit}/edit', 'SubjectController@edit')->name('admin.manageSubject.edit');
// 	 	    Route::post('{manageSubject}/update', 'SubjectController@update')->name('admin.manageSubject.update');

	 	    Route::get('delete/{id}', 'SubjectController@destroy')->name('admin.manageSubject.delete');	//OK--------
	 	    Route::post('class-subject-pdf', 'SubjectController@classSubjectPDF')->name('admin.manageSubject.pdf.generate');	//OK------        
	 	});
// 	 // ---------------Signature-stamp---------------------------------------
	 	Route::group(['prefix' => 'Signature-stamp'], function() {
	     	Route::get('/', 'SignatureStampController@index')->name('admin.signature.stamp');	//OK-------
	     	// Route::get('add-form/{id?}', 'SignatureStampController@addForm')->name('admin.signature.stamp.add.form');
	     	// Route::post('store/{id?}', 'SignatureStampController@store')->name('admin.signature.stamp.store');

	     	Route::post('table-show', 'SignatureStampController@tableShow')->name('admin.signature.stamp.table.show');	//OK--------
	     
	     	// Route::get('status/{id}', 'SignatureStampController@status')->name('admin.signature.stamp.status');
	     	// Route::get('report', 'SignatureStampController@report')->name('admin.signature.stamp.report');
	     	// Route::post('report-generate', 'SignatureStampController@reportGenerate')->name('admin.signature.stamp.report.generate');
	 	});
// 	 Route::group(['prefix' => 'activity'], function() {
// 	     Route::get('/', 'ActivityController@index')->name('admin.activity.list');
// 	     Route::get('delete/{activity}', 'ActivityController@destroy')->name('admin.activity.delete');
         
// 	 });
// 	  // ---------------Report----------------------------------------
	 Route::group(['prefix' => 'report'], function() {
	     Route::get('/', 'ReportController@index')->name('admin.student.report');
	     // Route::post('search', 'ReportController@reportfilter')->name('admin.student.report.post');      
         
	 }); 
// 	 Route::group(['prefix' => 'student-report'], function() {
// 	     Route::get('report', 'ReportController@finalReportIndex')->name('admin.student.final.report');
// 	     Route::get('report-for', 'ReportController@finalReportForChange')->name('admin.student.final.report.for.change');
	     // Route::get('class-wise-section', 'ReportController@finalReportClassWiseSection')->name('admin.student.final.report.class.wise.section');	//Pending
// 	     Route::post('report-show', 'ReportController@finalReportShow')->name('admin.student.final.report.show');
// 	     Route::get('student-check', 'ReportController@finalReportStudentDetailsCheck')->name('admin.student.final.report.student.details.check'); 
// 	     Route::get('report-pendin-show', 'ReportController@finalReportPendingShow')->name('admin.student.final.report.pending.show'); 
// 	     Route::get('report-pendin-download', 'ReportController@finalReportPendingDownload')->name('admin.student.final.report.pending.download'); 
         
// 	 });
// 	 Route::group(['prefix' => 'general-report'], function() {
// 	     Route::get('report', 'ReportController@generalReport')->name('admin.student.general.report'); 
// 	     Route::get('report-for', 'ReportController@generalReportFor')->name('admin.student.general.report.for'); 
// 	     Route::post('report-generate', 'ReportController@reportGenerateBarcode')->name('admin.student.general.report.barcode'); 
// 	 }); 

// 	 Route::group(['prefix' => 'StuCertificate'], function() {
// 	     Route::get('Application', 'StudentCertificateController@index')->name('admin.student.CharacterCertificateApplication');
// 	     Route::get('showstudentdetail', 'StudentCertificateController@showStudent')->name('admin.student.showStudent');  
// 	     Route::post('character-certificate-store', 'StudentCertificateController@characterCcertificateStore')->name('admin.student.CharacterCertificateApplication.store');
// 	//------------BirthCertificateApplication-------------------------------------------// 
// 	     Route::get('BirthCertificateApplication', 'StudentCertificateController@BirthCertificateApplication')->name('admin.student.BirthCertificateApplication');
// 	     Route::get('BirthCertificateApplicationForm', 'StudentCertificateController@BirthCertificateApplicationForm')->name('admin.student.BirthCertificateApplicationForm');
// 	     Route::post('BirthCertificateApplicationStore', 'StudentCertificateController@BirthCertificateApplicationStore')->name('admin.student.BirthCertificateApplicationStore');
// 	//------------LeavingCertificateApplication-----------------------------------------// 
// 	     Route::get('LeavingCertificateApplication', 'StudentCertificateController@LeavingCertificateApplication')->name('admin.student.LeavingCertificateApplication');
// 	     Route::get('LeavingCertificateApplicationForm', 'StudentCertificateController@LeavingCertificateApplicationForm')->name('admin.student.LeavingCertificateApplicationForm');
// 	     Route::post('LeavingCertificateApplicationStore', 'StudentCertificateController@LeavingCertificateApplicationStore')->name('admin.student.LeavingCertificateApplicationStore');

//                    //------------Issue------//
//     //------------CharacterCertificateIssue----------------------------------------------//
// 	     Route::get('CharacterCertificateIssue', 'StudentCertificateController@CharacterCertificateIssue')->name('admin.student.CharacterCertificateIssue');
// 	     Route::get('CharacterCertificateIssueClick', 'StudentCertificateController@CharacterCertificateIssueClick')->name('admin.student.CharacterCertificateIssueClick');
// 	     Route::get('CharacterCertificateIssueTake/{id}', 'StudentCertificateController@CharacterCertificateIssueTake')->name('admin.student.CharacterCertificateIssueTake');
// 	     Route::post('CharacterCertificateIssueTakeStore/{id}', 'StudentCertificateController@CharacterCertificateIssueTakeStore')->name('admin.student.CharacterCertificateIssueTakeStore');

//    //-------------BirthCertificateIssue--------------------------------------------------//
// 	     Route::get('BirthCertificateIssue', 'StudentCertificateController@BirthCertificateIssue')->name('admin.student.BirthCertificateIssue');
// 	     Route::get('BirthCertificateIssueClick', 'StudentCertificateController@BirthCertificateIssueClick')->name('admin.student.BirthCertificateIssueClick');
// 	     Route::get('BirthCertificateIssueTake/{id}', 'StudentCertificateController@BirthCertificateIssueTake')->name('admin.student.BirthCertificateIssueTake');
// 	     Route::post('BirthCertificateIssueTakeStore/{id}', 'StudentCertificateController@BirthCertificateIssueTakeStore')->name('admin.student.BirthCertificateIssueTakeStore');
//    //-------------LeavingCertificateIssue--------------------------------------------------//
// 	     Route::get('LeavingCertificateIssue', 'StudentCertificateController@LeavingCertificateIssue')->name('admin.student.LeavingCertificateIssue');
// 	     Route::get('LeavingCertificateIssueClick', 'StudentCertificateController@LeavingCertificateIssueClick')->name('admin.student.LeavingCertificateIssueClick');
// 	     Route::get('LeavingCertificateIssueTake/{id}', 'StudentCertificateController@LeavingCertificateIssueTake')->name('admin.student.LeavingCertificateIssueTake');
// 	     Route::post('LeavingCertificateIssueTakeStore/{id}', 'StudentCertificateController@LeavingCertificateIssueTakeStore')->name('admin.student.LeavingCertificateIssueTakeStore');

// 	              //------------Approval------//
//     //------------CharacterCertificateApproval----------------------------------------------//
// 	     Route::get('CharacterCertificateApproval', 'StudentCertificateController@CharacterCertificateApproval')->name('admin.student.CharacterCertificateApproval');
// 	     Route::get('CharacterCertificateApprovalClick', 'StudentCertificateController@CharacterCertificateApprovalClick')->name('admin.student.CharacterCertificateApprovalClick');
// 	     Route::get('CharacterCertificateApprovalTake/{id}', 'StudentCertificateController@CharacterCertificateApprovalTake')->name('admin.student.CharacterCertificateApprovalTake');
// 	     Route::post('CharacterCertificateApprovalTakeStore/{id}', 'StudentCertificateController@CharacterCertificateApprovalTakeStore')->name('admin.student.CharacterCertificateApprovalTakeStore');
//    //-------------BirthCertificateApproval--------------------------------------------------//
// 	     Route::get('BirthCertificateApproval', 'StudentCertificateController@BirthCertificateApproval')->name('admin.student.BirthCertificateApproval');
// 	     Route::get('BirthCertificateApprovalClick', 'StudentCertificateController@BirthCertificateApprovalClick')->name('admin.student.BirthCertificateApprovalClick');
// 	     Route::get('BirthCertificateApprovalTake/{id}', 'StudentCertificateController@BirthCertificateApprovalTake')->name('admin.student.BirthCertificateApprovalTake');
// 	     Route::post('BirthCertificateApprovalTakeStore/{id}', 'StudentCertificateController@BirthCertificateApprovalTakeStore')->name('admin.student.BirthCertificateApprovalTakeStore');
//    //-------------LeavingCertificateApproval--------------------------------------------------//
// 	     Route::get('LeavingCertificateApproval', 'StudentCertificateController@LeavingCertificateApproval')->name('admin.student.LeavingCertificateApproval');
// 	     Route::get('LeavingCertificateApprovalClick', 'StudentCertificateController@LeavingCertificateApprovalClick')->name('admin.student.LeavingCertificateApprovalClick');
// 	     Route::get('LeavingCertificateApprovalTake/{id}', 'StudentCertificateController@LeavingCertificateApprovalTake')->name('admin.student.LeavingCertificateApprovalTake');
// 	     Route::post('LeavingCertificateApprovalTakeStore/{id}', 'StudentCertificateController@LeavingCertificateApprovalTakeStore')->name('admin.student.LeavingCertificateApprovalTakeStore');
// 	//------------------Download---------------------------------------------------------------//
// 	     Route::get('CertificateList', 'StudentCertificateController@CertificateList')->name('admin.student.CertificatePrint');
// 	     Route::get('CertificateDownload/{id}/{condition_id}', 'StudentCertificateController@CertificateDownload')->name('admin.student.CertificateDownload');
	     
// 	 });
// 	   // ---------------Certificate----------------------------------------
// 	 // Route::group(['prefix' => 'certificate'], function() {
// 	 //     Route::get('/', 'CertificateIssueDetailController@index')->name('admin.student.certificateIssu.list');	 	
// 	 //     Route::get('show', 'CertificateIssueDetailController@create')->name('admin.student.certificateIssu.apply');
// 	 //     Route::get('table-show', 'CertificateIssueDetailController@tableShow')->name('admin.student.certificateIssu.apply.table.show');
// 	 //     Route::get('print/{certificate}', 'CertificateIssueDetailController@print')->name('admin.student.certificateIssu.print');
// 	 //     Route::post('store', 'CertificateIssueDetailController@store')->name('admin.student.certificateIssu.post');
// 	 //     Route::get('edit/{id}', 'CertificateIssueDetailController@verifyStatus')->name('admin.student.certificateIssu.edit');
// 	 //     Route::get('show/{certificate}', 'CertificateIssueDetailController@show')->name('admin.student.certificateIssu.show'); 
// 	 //     Route::get('update/{id}', 'CertificateIssueDetailController@verifyRejectStatus')->name('admin.student.certificateIssu.update');
// 	 //     Route::get('download/{certificate}', 'CertificateIssueDetailController@download')->name('admin.student.attachment.download');
// 	 //     Route::get('attachdownload/{id?}', 'CertificateIssueDetailController@attachDownload')->name('admin.student.attachment.attachdownload');
// 	 //     Route::get('verify', 'CertificateIssueDetailController@verify')->name('admin.student.attachment.virify');
// 	 //     Route::get('approval', 'CertificateIssueDetailController@approval')->name('admin.student.attachment.approval');
// 	 //     Route::get('aproval-check/{id}', 'CertificateIssueDetailController@approvalCheck')->name('admin.student.attachment.approval.check');
// 	 //     Route::get('aproval/{id}', 'CertificateIssueDetailController@approvalReject')->name('admin.student.attachment.approval.status');
// 	 //     Route::get('check-status', 'CertificateIssueDetailController@checkStatus')->name('admin.student.certificate.check.status');
// 	 //     Route::post('check-status-show', 'CertificateIssueDetailController@checkStatusShow')->name('admin.student.certificate.check.status.show');
// 	 // });
// 	   // ---------------Tuition Fee Certificate----------------------------------------
// 	 Route::group(['prefix' => 'certificate-tuition'], function() {
// 	     Route::get('/', 'CertificateIssueDetailController@tuitionFeeShowForm')->name('admin.student.certificateIssu.tuition');	 
// 	     Route::get('result', 'CertificateIssueDetailController@tuitionFeeShowResult')->name('admin.student.certificateIssu.tuition.result');	 	
// 	     Route::get('show/{id}', 'CertificateIssueDetailController@tuitionPrint')->name('admin.student.certificateIssu.tuition.print');
// 	     Route::get('report-wise', 'CertificateIssueDetailController@reportWise')->name('admin.student.certificateIssu.report.wise');
// 	     Route::get('class-with-section', 'CertificateIssueDetailController@reportClassWithSection')->name('admin.student.certificateIssu.report.class.with.section');
// 	     Route::post('certificate-generate', 'CertificateIssueDetailController@reportCertificateGenerate')->name('admin.student.certificateIssu.report.certificate.generate');
// 	      Route::get('report-request-show', 'CertificateIssueDetailController@reportRequestShow')->name('admin.student.report.request.show');
// 	      Route::get('pendin-generate/{student_id}/{report_type_id}', 'CertificateIssueDetailController@reportRequestPendingGenerate')->name('admin.student.report.request.pending.generate');
// 	     // Route::get('show/{certificate}', 'CertificateIssueDetailController@show')->name('admin.student.certificateIssu.show');
// 	     // Route::get('delete', 'CertificateIssueDetailController@edit')->name('admin.student.certificateIssu.delete');
// 	     // Route::get('download/{certificate}', 'CertificateIssueDetailController@download')->name('admin.student.attachment.download');
// 	     // Route::get('verify/{certificate}', 'CertificateIssueDetailController@verify')->name('admin.student.attachment.virify');
// 	     // Route::get('approval/{certificate}', 'CertificateIssueDetailController@approval')->name('admin.student.attachment.approval');
// 	 });
// 	 	   // ---------------Remarks----------------------------------------
// 	Route::group(['prefix' => 'Remarks'], function() {
// 	     Route::get('/', 'CertificateIssueRemarkController@show')->name('admin.remark.show');	 	
// 	     Route::post('store', 'CertificateIssueRemarkController@store')->name('admin.remark.add');
	     
// 	 });
// 	// ---------------Homework----------------------------------------  
// 	Route::group(['prefix' => 'homework'], function() {
// 	    Route::get('/', 'HomeworkController@index')->name('admin.homework.list');	 	
// 	    Route::post('add', 'HomeworkController@store')->name('admin.homework.post');
// 	    Route::get('form', 'HomeworkController@form')->name('admin.homework.form');	
// 	    Route::get('view/{id}', 'HomeworkController@view')->name('admin.homework.view');
// 	    Route::get('delete/{id}', 'HomeworkController@destroy')->name('admin.homework.delete');
// 	    Route::get('search', 'HomeworkController@search')->name('admin.homework.search');
// 	    Route::get('download/{homework_doc}', 'HomeworkController@download')->name('admin.homework.download');
// 	    Route::post('send-homework', 'HomeworkController@sendHomework')->name('admin.homework.send.homework');
// 	    Route::get('homework-send/{id}', 'HomeworkController@HomeworkSend')->name('admin.homework.homework.send');
// 	 });
	
	 
// 	//  //------------------------- Academic Year --------------------------------- 
// 	// Route::group(['prefix' => 'academic-year'], function() {
// 	//     Route::get('/', 'AcademicYearController@index')->name('admin.academic.year.list');	 	
// 	//     Route::get('search', 'AcademicYearController@search')->name('admin.academic.year.search');	 	
// 	//     Route::post('add', 'AcademicYearController@store')->name('admin.academic.year.post');
// 	//     Route::delete('delete', 'AcademicYearController@destroy')->name('admin.academic.year.delete');
// 	//     Route::put('update', 'AcademicYearController@update')->name('admin.academic.year.update');
// 	//  });
// 	 //------------------------Attendace-------------------------------------------
// 	Route::group(['prefix' => 'attendance'], function() {
// 	    Route::group(['prefix' => 'student'], function() {
// 	        Route::get('/', 'StudentAttendanceController@index')->name('admin.attendance.student.form');
// 	        Route::post('search/{id}', 'StudentAttendanceController@search')->name('admin.attendance.student.search');
// 	        Route::post('store', 'StudentAttendanceController@store')->name('admin.attendance.student.save');
// 	        Route::get('verify', 'StudentAttendanceController@verify')->name('admin.attendance.student.verify');
// 	        Route::post('verify-store', 'StudentAttendanceController@verifyStore')->name('admin.attendance.student.verify.store');
// 	        Route::get('unlock/{id}', 'StudentAttendanceController@unlock')->name('admin.attendance.student.verify.unlock');
// 	        Route::get('{attendance}/delete', 'StudentAttendanceController@destroy')->name('admin.attendance.student.delete');
	        Route::get('attendance-continue', 'StudentAttendanceController@attendanceContinue')->name('admin.attendance.student.attendance.continue');
// 	    });
// 	});
// 	    Route::group(['prefix' => 'student-absent'], function() { 
// 	        Route::get('student-absent', 'StudentAttendanceController@studentAbsent')->name('admin.attendance.student.absent');
// 	        Route::get('student-absent-list', 'StudentAttendanceController@studentAbsentList')->name('admin.attendance.student.absent.list');
// 	        Route::post('student-absent-sms/{id}', 'StudentAttendanceController@studentAbsentSendSms')->name('admin.attendance.student.absent.send.sms');
	        
// 	    });
// 	    Route::group(['prefix' => 'attendance-barcode'], function() { 
// 	        Route::get('barcode', 'StudentAttendanceController@attendanceBarcode')->name('admin.attendance.barcode');
// 	        Route::get('click', 'StudentAttendanceController@btnClick')->name('admin.attendance.barcode.click');
// 	        Route::get('show', 'StudentAttendanceController@attendanceBarcodeshow')->name('admin.attendance.barcode.show');
// 	        Route::post('save', 'StudentAttendanceController@attendanceBarcodeSave')->name('admin.attendance.barcode.save');
	        
// 	    });
// 	    Route::group(['prefix' => 'student-leave-type'], function() { 
// 	        Route::get('list', 'StudentLeaveController@LeaveType')->name('admin.attendance.leave.type');
// 	        Route::get('add-form/{id?}', 'StudentLeaveController@AddForm')->name('admin.attendance.leave.addform');
// 	        Route::post('store/{id?}', 'StudentLeaveController@leaveTypeStore')->name('admin.attendance.leave.type.store');
// 	        Route::get('delete/{id?}', 'StudentLeaveController@leaveTypeDelete')->name('admin.attendance.leave.type.delete'); 
// 	    });
// 	    Route::group(['prefix' => 'student-leave'], function() { 
// 	        Route::get('/', 'StudentLeaveController@index')->name('admin.attendance.leave');
// 	        Route::get('list', 'StudentLeaveController@show')->name('admin.attendance.list');
// 	        Route::get('date', 'StudentLeaveController@date')->name('admin.attendance.date');
// 	        Route::get('leave-apply/{id?}', 'StudentLeaveController@leaveApply')->name('admin.attendance.leave.apply');
// 	        Route::post('store/{id?}', 'StudentLeaveController@store')->name('admin.attendance.leave.store');
// 	        Route::get('delete/{id?}', 'StudentLeaveController@destroy')->name('admin.attendance.leave.delete'); 
// 	    });
// 	    Route::group(['prefix' => 'leave-verify'], function() { 
// 	        Route::get('verify', 'StudentLeaveController@verify')->name('admin.attendance.leave.verify');
// 	        Route::get('approval/{id?}', 'StudentLeaveController@verifyForm')->name('admin.attendance.leave.verify.form');
// 	        Route::post('reject/{id?}', 'StudentLeaveController@LeaveverifyStore')->name('admin.attendance.leave.verify.store');
	       
// 	    });
// 	    //------------------------- attendance-report ---------------------------------
// 	    Route::group(['prefix' => 'attendance-report'], function() { 
// 	        Route::get('/', 'AttendanceReportController@index')->name('admin.attendance.report');
// 	        Route::post('show', 'AttendanceReportController@show')->name('admin.attendance.report.show');
	         
	       
// 	    });
// 	    Route::group(['prefix' => 'leave-report'], function() { 
// 	        Route::get('leave-report', 'AttendanceReportController@leaveReport')->name('admin.attendance.leave.report');
// 	        Route::get('leave-report-filter', 'AttendanceReportController@leaveReportFilter')->name('admin.attendance.leave.report.filter');
// 	        Route::post('leave-report-show', 'AttendanceReportController@leaveReportShow')->name('admin.attendance.leave.report.show'); 
// 	    });
// 	    Route::group(['prefix' => 'sms-send'], function() { 
// 	        Route::get('sms-send', 'AttendanceReportController@smsSend')->name('admin.attendance.sms.send');
// 	        Route::post('show', 'AttendanceReportController@SmsSendshow')->name('admin.attendance.sms.send.show');
// 	        Route::post('sent', 'AttendanceReportController@SmsSendFinal')->name('admin.attendance.sms.send.final');
// 	        Route::get('reminder', 'AttendanceReportController@reminder')->name('admin.attendance.sms.send.reminder');
	        
// 	    });
// 	//------------------------- Finance ---------------------------------
// 	Route::group(['prefix' => 'finance'], function() {
// 		//------------------------- fee acoout ---------------------------------
// 		Route::group(['prefix' => 'bank'], function() {
// 		    Route::get('details', 'FeeAccountController@bankDetails')->name('admin.finance.bank.detail');
// 		    Route::get('add-form/{id?}', 'FeeAccountController@bankDetailsAddForm')->name('admin.finance.bank.detail.add.form');
// 		    Route::post('store/{id?}', 'FeeAccountController@bankDetailsStore')->name('admin.finance.bank.detail.store');
// 		    Route::get('show', 'FeeAccountController@bankDetailsShow')->name('admin.finance.bank.detail.show');
// 		 });
// 		Route::group(['prefix' => 'mapping'], function() {
// 		    Route::get('bank-account', 'FeeAccountController@mappingBankAccount')->name('admin.finance.mapping.bank.account');
// 		    Route::post('bank-account-store/{id?}', 'FeeAccountController@mappingBankAccountStore')->name('admin.finance.mapping.store');
// 		 });
// 		Route::group(['prefix' => 'fee-account'], function() {
// 		    Route::get('/', 'FeeAccountController@index')->name('admin.feeAcount.list');	 	
// 		    Route::get('add/{id?}', 'FeeAccountController@addForm')->name('admin.feeAcount.add.form');
// 		    Route::post('store/{id?}', 'FeeAccountController@store')->name('admin.feeAcount.post');
// 		    Route::get('delete/{id}', 'FeeAccountController@destroy')->name('admin.feeAcount.delete');
// 		    Route::get('report', 'FeeAccountController@report')->name('admin.feeAcount.report');
// 		 });
// 		//------------------------- Fine scheme ---------------------------------
// 		Route::group(['prefix' => 'fine-scheme'], function() {
// 		    Route::get('/', 'FineSchemeController@index')->name('admin.fineScheme.list');	 	
// 		    Route::get('add/{id?}', 'FineSchemeController@AddForm')->name('admin.fineScheme.add.form');
// 		    Route::post('store/{id?}', 'FineSchemeController@store')->name('admin.fineScheme.post');
// 		    Route::get('delete/{id?}', 'FineSchemeController@destroy')->name('admin.fineScheme.delete');
// 		    Route::get('pdf-report', 'FineSchemeController@pdfReport')->name('admin.fineScheme.pdf.report');
// 		 });
// 		//------------------------- fee structure ---------------------------------
// 		Route::group(['prefix' => 'fee-structure'], function() {
// 		    Route::get('/', 'FeeStructureController@index')->name('admin.feeStructure.list');		     	 	
// 		    Route::get('add/{id?}', 'FeeStructureController@addForm')->name('admin.feeStructure.add.form');
// 		    Route::post('store/{id?}', 'FeeStructureController@store')->name('admin.feeStructure.post');
// 		    Route::get('delete/{id}', 'FeeStructureController@destroy')->name('admin.feeStructure.delete');
// 		    Route::get('report', 'FeeStructureController@report')->name('admin.feeStructure.report');
// 		 });
// 		//------------------------- fee structure amount ---------------------------------
// 		Route::group(['prefix' => 'fee-structure-amount'], function() {
// 		    Route::get('/', 'FeeStructureAmountController@index')->name('admin.feeStructureAmount.list');
// 		    Route::get('filter', 'FeeStructureAmountController@onchange')->name('admin.feeStructureAmount.onchange');
// 		    Route::get('search', 'FeeStructureAmountController@search')->name('admin.feeStructureAmount.search'); 	
// 		    Route::post('add', 'FeeStructureAmountController@store')->name('admin.feeStructureAmount.post');
// 		    Route::delete('delete', 'FeeStructureAmountController@destroy')->name('admin.feeStructureAmount.delete');
// 		    Route::put('update', 'FeeStructureAmountController@update')->name('admin.feeStructureAmount.update');
// 		    Route::get('clone/{condition_id}', 'FeeStructureAmountController@clone')->name('admin.feeStructureAmount.clone');
// 		    Route::post('clone-store/{condition_id}', 'FeeStructureAmountController@cloneStore')->name('admin.feeStructureAmount.clone.store');
// 		    Route::get('pdf-report/{id}', 'FeeStructureAmountController@pdfReport')->name('admin.feeStructureAmount.pdf.report');
// 		 });//------------------------- fee structure amount ---------------------------------
// 	    Route::group(['prefix' => 'fee-structure-last-date'], function() {
// 	        Route::get('/', 'FeeStructureLastDateController@index')->name('admin.feeStructureLastDate.list');	 	
// 	        Route::post('add', 'FeeStructureLastDateController@store')->name('admin.feeStructureLastDate.post');
// 	        Route::get('edit/{id}', 'FeeStructureLastDateController@edit')->name('admin.feeStructureLastDate.edit');
// 	        Route::post('update/{id?}', 'FeeStructureLastDateController@update')->name('admin.feeStructureLastDate.update');
// 	        Route::get('delete/{id?}', 'FeeStructureLastDateController@destroy')->name('admin.feeStructureLastDate.delete');
// 	        Route::get('report', 'FeeStructureLastDateController@report')->name('admin.feeStructureLastDate.report');
// 	        Route::post('report-generate', 'FeeStructureLastDateController@reportGenerate')->name('admin.feeStructureLastDate.report.generate');
// 	     });
// 	    //------------------------- class-fee-structure ---------------------------------
// 	    Route::group(['prefix' => 'class-fee-structure'], function() {
// 	        Route::get('/', 'ClassFeeStructureController@index')->name('admin.classFeeStructure.list');	 	
// 	        Route::get('form', 'ClassFeeStructureController@form')->name('admin.classFeeStructureForm');
// 	        Route::get('search', 'ClassFeeStructureController@search')->name('admin.classFeeStructure.search');
// 	        Route::get('save-show', 'ClassFeeStructureController@saveshow')->name('admin.classFeeStructure.saveShow');	        	 	
// 	        Route::post('stores', 'ClassFeeStructureController@stores')->name('admin.classFeeStructure.stores');	 	
// 	        Route::post('add', 'ClassFeeStructureController@store')->name('admin.classFeeStructure.post');
// 	        Route::post('isApplicable', 'ClassFeeStructureController@isApplicable')->name('admin.classFeeStructure.isApplicable');
// 	        Route::delete('delete', 'ClassFeeStructureController@destroy')->name('admin.classFeeStructure.delete');
// 	     });//------------------------- fee-group ---------------------------------
// 	    Route::group(['prefix' => 'fee-group'], function() {
// 		    Route::get('/', 'FeeGroupController@index')->name('admin.feeGroup.list');	 	
// 		    Route::get('add/{id?}', 'FeeGroupController@addForm')->name('admin.feeGroup.add.form');
// 		    Route::post('store/{id?}', 'FeeGroupController@store')->name('admin.feeGroup.post');
// 		    Route::get('delete/{id?}', 'FeeGroupController@destroy')->name('admin.feeGroup.delete');
// 		    Route::get('group/{id?}', 'FeeGroupController@group')->name('admin.feeGroup.group');
// 		 });//------------------------- fee-group-detailt ---------------------------------
//         Route::group(['prefix' => 'fee-group-detail'], function() {
//     	    Route::get('/', 'FeeGroupDetailController@index')->name('admin.feeGroupDetail.list');	 
// 	        Route::post('search', 'FeeGroupDetailController@search')->name('admin.feeGroupDetail.search'); 
//     	    Route::post('add/{id?}', 'FeeGroupDetailController@store')->name('admin.feeGroupDetail.post');
//     	    Route::delete('delete', 'FeeGroupDetailController@destroy')->name('admin.feeGroupDetail.delete');
//     	    Route::put('update', 'FeeGroupDetailController@update')->name('admin.feeGroupDetail.update');
//     	 });//------------------------- concession ---------------------------------
//         Route::group(['prefix' => 'concession'], function() {
//     	    Route::get('/', 'ConcessionController@index')->name('admin.concession.list');	 	
//     	    Route::get('add/{id?}', 'ConcessionController@addForm')->name('admin.concession.add.form');
//     	    Route::post('store/{id?}', 'ConcessionController@store')->name('admin.concession.post');
//     	    Route::get('delete/{id?}', 'ConcessionController@destroy')->name('admin.concession.delete');
//     	    Route::get('search', 'ConcessionController@search')->name('admin.concession.search');
//     	    Route::get('report', 'ConcessionController@report')->name('admin.concession.report');
//     	 });//------------------------- finance-year ---------------------------------
//         Route::group(['prefix' => 'finance-finance'], function() {
//     	    Route::get('/', 'FinanceYearController@index')->name('admin.finance.year');	 	
//     	    Route::get('add/{id?}', 'FinanceYearController@addForm')->name('admin.finance.year.add.form');
//     	    Route::post('store/{id?}', 'FinanceYearController@store')->name('admin.finance.year.store');
//     	    Route::get('delete/{id?}', 'FinanceYearController@destroy')->name('admin.finance.year.delete');
    	    
//     	 });//------------------------- student-fee-detail ---------------------------------
//         Route::group(['prefix' => 'student-fee-detail'], function() {
//     	    Route::get('/', 'StudentFeeDetailController@index')->name('admin.studentFeeDetail.list'); 
//     	    Route::get('filter/{condition_id?}', 'StudentFeeDetailController@filter')->name('admin.studentFeeDetail.filter'); 
//     	    Route::post('add', 'StudentFeeDetailController@store')->name('admin.studentFeeDetail.post');
//     	    Route::get('delete/{studentFeeDetail}', 'StudentFeeDetailController@destroy')->name('admin.studentFeeDetail.delete');
//     	    Route::put('update', 'StudentFeeDetailController@update')->name('admin.studentFeeDetail.update');
//     	    Route::get('assign', 'StudentFeeDetailController@feeassignlist')->name('admin.studentFeeAssign.list');
//     	    Route::post('assign/show/{menu_id}', 'StudentFeeDetailController@feeassignshow')->name('admin.studentFeeAssign.show');
//     	    Route::get('search', 'StudentFeeDetailController@feeassignSearch')->name('admin.studentFeeAssign.search');
//     	    Route::get('search-list', 'StudentFeeDetailController@feeassignSearchList')->name('admin.studentFeeAssign.search.list');
//     	    Route::get('search-list-select/{menu}', 'StudentFeeDetailController@feeassignSearchListSelect')->name('admin.studentFeeAssign.search.list.select');
//     	    Route::post('assign/store', 'StudentFeeDetailController@assignstore')->name('admin.studentFeeAssign.post');
//     	    Route::get('show-fee-struture-model/{id}', 'StudentFeeDetailController@showFeeStructureModel')->name('admin.studentFeeStructure.show.model');
//     	    Route::get('show-fee-struture-amount', 'StudentFeeDetailController@showFeeStructureAmount')->name('admin.studentFeeStructure.show.amount');
//     	    Route::post('show-fee-struture-store/{id}', 'StudentFeeDetailController@feeStructureStore')->name('admin.studentFeeStructure.details.store');
//     	     Route::get('show-fee-Concession-model/{id}', 'StudentFeeDetailController@showFeeDetailConcessionModel')->name('admin.studentFeeStructure.Concession.show.model');
//     	      Route::post('show-fee-struture-concession-store/{id}', 'StudentFeeDetailController@feeconcessioneStore')->name('admin.studentFee.details.concession.store');
//     	      Route::get('previous-reciept-model-show', 'StudentFeeDetailController@previousRecieptModel')->name('admin.privious.reciept.show.model');
//     	      Route::get('previous-reciept-search', 'StudentFeeDetailController@previousRecieptSearch')->name('admin.privious.reciept.search');
//     	      Route::get('previous-reciept-show', 'StudentFeeDetailController@previousRecieptShow')->name('admin.privious.reciept.show');
//     	      Route::get('previous-reciept-download/{id}', 'StudentFeeDetailController@previousRecieptDownload')->name('admin.privious.reciept.download');
//     	      Route::get('student-fee-assign-delete/{student_id}/{fee_structure_id}', 'StudentFeeDetailController@studentFeeAssignStructureDelete')->name('admin.student.fee.assign.structure.delete');
//     	 });
//     	 //------------------------- StudentFeeGroupDetail --------------------------------- 
//     	Route::group(['prefix' => 'fee-group-wise'], function() {
//     	    Route::get('/', 'StudentFeeGroupDetailController@index')->name('admin.studentFeeGroupDetail.list');	 	
//     	    Route::post('show', 'StudentFeeGroupDetailController@show')->name('admin.studentFeeGroupDetail.show');	 	
//     	    Route::post('add', 'StudentFeeGroupDetailController@store')->name('admin.studentFeeGroupDetail.post');
//     	    Route::post('search', 'StudentFeeGroupDetailController@search')->name('admin.studentFeeGroupDetail.search');
//     	    Route::delete('delete', 'StudentFeeGroupDetailController@destroy')->name('admin.studentFeeGroupDetail.delete');
//     	    Route::put('update', 'StudentFeeGroupDetailController@update')->name('admin.studentFeeGroupDetail.update');
//     	 });
//     	 //------------------------- Fee Collection --------------------------------- 
//     	Route::group(['prefix' => 'fee-collection'], function() {
//     	    Route::get('/', 'Fee\FeeCollectionController@index')->name('admin.studentFeeCollection.list');	 	
//     	    Route::get('student-search', 'Fee\FeeCollectionController@studentSearch')->name('admin.studentFeeCollection.student.serch');	 	
//     	    Route::post('show', 'Fee\FeeCollectionController@show')->name('admin.studentFeeCollection.show');
//     	    Route::get('show-fee-detail', 'Fee\FeeCollectionController@showfeedetail')->name('admin.studentFeeCollection.showFeeDetail');

//     	    Route::post('add', 'Fee\FeeCollectionController@store')->name('admin.studentFeeCollection.post');
//     	    Route::get('print', 'Fee\FeeCollectionController@print')->name('admin.studentFeeCollection.print');
//     	    Route::post('print2', 'Fee\FeeCollectionController@print')->name('admin.studentFeeCollection.print2');
//     	    Route::get('fee-detail', 'Fee\FeeCollectionController@feeDetail')->name('admin.studentFeeCollection.search');
//     	    Route::delete('delete', 'Fee\FeeCollectionController@destroy')->name('admin.studentFeeCollection.delete');
//     	    Route::put('update', 'Fee\FeeCollectionController@update')->name('admin.studentFeeCollection.update');
//     	    Route::get('fine', 'Fee\FeeCollectionController@fineScheme')->name('admin.studentFeeCollection.fine.scheme');
//     	    Route::get('previous-receipts', 'Fee\FeeCollectionController@PreviousReceipts')->name('admin.studentFeeCollection.previous.receipts');
//     	    Route::get('previous-receipts-remove', 'Fee\FeeCollectionController@PreviousReceiptsRemove')->name('admin.studentFeeCollection.previous.receipts.remove');
//     	 });
//     	 //------------------------- Fee Cashbook --------------------------------- 
//     	Route::group(['prefix' => 'cashbook'], function() {
//     	    Route::get('/', 'Fee\CashbookController@index')->name('admin.cashbook.list');	 	
//     	    Route::post('daterange', 'Fee\CashbookController@daterange')->name('admin.cashbook.daterange');	 	
//     	    Route::get('print/{student_id}', 'Fee\CashbookController@printReciept')->name('admin.cashbook.print'); 
//     	    Route::get('cancel/{cashbook}', 'Fee\CashbookController@cancelRecietp')->name('admin.cashbook.cancel'); 
//     	 });
//     	 //------------------------- Fee Due filder --------------------------------- 
//     	Route::group(['prefix' => 'fee-due'], function() {
//     	    Route::get('/', 'Fee\FeeDueController@index')->name('admin.feeDue.list');	 	
//     	    Route::post('filter', 'Fee\FeeDueController@filter')->name('admin.feeDue.filter');	 	
    	      
    	    
//     	 });
//     	Route::group(['prefix' => 'other-receipt'], function() {
//     	    Route::get('/', 'OtherReceiptController@index')->name('admin.other.receipt');	 	
//     	    Route::get('add-form/{id?}', 'OtherReceiptController@addForm')->name('admin.other.receipt.addform');	 	
//     	    Route::post('store/{id?}', 'OtherReceiptController@store')->name('admin.other.receipt.store');	 	
    	    
    	      
    	    
//     	 });
//     	Route::group(['prefix' => 'finance-report'], function() {
//     	    Route::get('/', 'FinanceReportController@index')->name('admin.finance.report');	 	
//     	    Route::get('fee-report', 'FinanceReportController@feeReport')->name('admin.finance.report.fee.report');	 	
//     	    Route::post('report-show', 'FinanceReportController@feeReportShow')->name('admin.finance.report.fee.report.show');	 	
    	    
    	      
    	    
//     	 });Route::group(['prefix' => 'date-range'], function() {
//     	    Route::get('date-range', 'FinanceReportController@dateRange')->name('admin.finance.report.date.range'); 
//     	 });
//     	Route::group(['prefix' => 'fee-due-report'], function() {
//     	    Route::get('fee-due', 'FinanceReportController@feeDueReport')->name('admin.finance.report.fee-due'); 
//     	    Route::post('fee-due-show', 'FinanceReportController@feeDueReportShow')->name('admin.finance.report.fee.due.show'); 
//     	    Route::get('fee-due-receipt/{id}', 'FinanceReportController@feeDueReportReceipt')->name('admin.finance.report.fee.due.receipt'); 
//     	  });
//     	Route::group(['prefix' => 'adminssion-report'], function() {
//     	    Route::get('admission', 'FinanceReportController@adminssionReport')->name('admin.finance.report.adminssion'); 
//     	    Route::post('admission-show', 'FinanceReportController@adminssionReportShow')->name('admin.finance.report.adminssion.show'); 
//     	  });
//     	Route::group(['prefix' => 'class-fee-structure-report'], function() {
//     	    Route::get('class-fee-structure-report/{id?}', 'FinanceReportController@classFeeStructureReport')->name('admin.finance.class.fee.structure.report'); 
//     	    Route::post('class-fee-structure-show/{id}', 'FinanceReportController@classFeeStructureReportShow')->name('admin.finance.class.fee.structure.report.show'); 
    	    
//     	  });
//     	Route::group(['prefix' => 'cloning-fee-all-details'], function() {
//     	  Route::get('cloning-fee-all-details', 'FinanceReportController@cloningFeeAllDetails')->name('admin.finance.cloning.fee.all.details'); 
//     	  Route::post('cloning-fee-all-details-show', 'FinanceReportController@cloningFeeAllDetailsShow')->name('admin.finance.cloning.fee.all.details.show'); 
//     	  Route::post('cloning-fee-all-details-store', 'FinanceReportController@cloningFeeAllDetailsStore')->name('admin.finance.cloning.fee.all.details.store'); 
    	    
    	    
//     	  });
//     	Route::group(['prefix' => 'fee-default-value'], function() {
//     	  Route::get('/', 'FeeDefaultValueController@index')->name('admin.finance.fee.default.value'); 
//     	  Route::get('form', 'FeeDefaultValueController@btnClickByForm')->name('admin.finance.fee.default.value.form'); 
//     	  Route::post('store', 'FeeDefaultValueController@store')->name('admin.finance.fee.default.value.store');

//     	  Route::get('admin', 'FeeDefaultValueController@admin')->name('admin.finance.fee.default.admin'); 
//     	  Route::get('admin-form', 'FeeDefaultValueController@adminBtnClickByForm')->name('admin.finance.fee.default.admin.form'); 
//     	  Route::post('admin-store', 'FeeDefaultValueController@adminStore')->name('admin.finance.fee.default.admin.store'); 
    	  
    	    
    	    
//     	  });
     

//     	 //------------------------- Student Search --------------------------------- 
//     	Route::group(['prefix' => 'search'], function() {
//     	    Route::get('/', 'StudentSearchController@index')->name('admin.student.search.form');	 	
//     	    Route::get('data', 'StudentSearchController@search')->name('admin.student.search');	 	
//     	    Route::get('find', 'StudentSearchController@find')->name('admin.student.find');	 	
    	    
//     	 });
//     	  //------------------------- online Form list --------------------------------- 
    	Route::group(['prefix' => 'registration-form'], function() {
    	    Route::get('/', 'Registration\RegistrationController@index')->name('admin.onlineForm.list');	 	
    	    // Route::get('cancel/{id}', 'Registration\RegistrationController@statusCancel')->name('registration.cancel');	 	
    	    // Route::get('rejcet/{id}', 'Registration\RegistrationController@statusReject')->name('registration.reject');	 	
    	    // Route::get('approved/{id}', 'Registration\RegistrationController@statusApproved')->name('registration.approved');
    	    // Route::get('approved-show', 'Registration\RegistrationController@approvedShow')->name('registration.approved.show');	 	
    	    // Route::post('/', 'Registration\RegistrationController@remarkAdd')->name('registration.remark.add');	 	
    	    // Route::get('show-remark', 'Registration\RegistrationController@remarkShow')->name('registration.remark.show');
    	    // Route::post('report', 'Registration\RegistrationController@report')->name('admin.registration.report.post'); 
    	    // Route::get('allowadmission/{id}', 'Registration\RegistrationController@allowadmission')->name('admin.registration.allowadmission'); 
         //    Route::post('copy-registration-data/{id}', 'Registration\RegistrationController@copyRegistrationData')->name('admin.registration.copyToStudent'); 
    	    
    	 	});
		 // });

// 		Route::group(['prefix' => 'transport'], function() {
// 			//------------------------- Transport ---------------------------------
// 			Route::group(['prefix' => 'transport'], function() {
// 			    Route::get('/', 'Transport\TransportController@index')->name('admin.transport.list');	 	
// 			    // Route::post('add', 'Transport\TransportController@store')->name('admin.transport.post');
// 			    Route::get('delete/{id}', 'Transport\TransportController@destroy')->name('admin.transport.delete');
// 			    Route::get('edit/{id?}', 'Transport\TransportController@edit')->name('admin.transport.edit');
// 			    Route::post('update/{id?}', 'Transport\TransportController@update')->name('admin.transport.update');
// 			 });
// 			 //------------------------- vehicle ---------------------------------
// 			Route::group(['prefix' => 'vehicle'], function() {
// 			    Route::get('/', 'Transport\VehicleController@index')->name('admin.vehicle.list');	 	
// 			    // Route::post('add', 'Transport\VehicleController@store')->name('admin.vehicle.post');
// 			    Route::get('delete/{id}', 'Transport\VehicleController@destroy')->name('admin.vehicle.delete');
// 			     Route::get('edit/{id?}', 'Transport\VehicleController@edit')->name('admin.vehicle.edit');
// 			    Route::post('update/{id?}', 'Transport\VehicleController@update')->name('admin.vehicle.update');
// 			 });
// 			 	 //------------------------- vehicle Type ---------------------------------
// 			Route::group(['prefix' => 'vehicle-type'], function() {
// 			    Route::get('/', 'Transport\VehicleController@list')->name('admin.vehicleType.list');	 	
// 			    Route::post('add', 'Transport\VehicleController@vehicleTypestore')->name('admin.vehicleType.post');
// 			    Route::get('delete/{id}', 'Transport\VehicleController@vehicleTypedestroy')->name('admin.vehicleType.delete');
// 			     Route::get('edit/{id?}', 'Transport\VehicleController@vehicleTypeedit')->name('admin.vehicleType.edit');
// 			      Route::post('update/{id?}', 'Transport\VehicleController@vehicleTypeupdate')->name('admin.vehicleType.update');
			    
// 			 });
// 			 	 //------------------------- Driver ---------------------------------
// 			Route::group(['prefix' => 'driver'], function() {
// 			    Route::get('/', 'Transport\DriverController@index')->name('admin.driver.list');	 	
// 			    // Route::post('add', 'Transport\DriverController@store')->name('admin.driver.post');
// 			    Route::get('delete/{id}', 'Transport\DriverController@destroy')->name('admin.driver.delete');
// 			    Route::get('edit/{id?}', 'Transport\DriverController@edit')->name('admin.driver.edit'); 
// 			     Route::post('update/{id?}', 'Transport\DriverController@update')->name('admin.driver.update'); 
// 			 });
// 			 //------------------------- Helper ---------------------------------
// 			Route::group(['prefix' => 'helper'], function() {
// 			    Route::get('/', 'Transport\HelperController@index')->name('admin.helper.list');	 	
// 			    // Route::post('add', 'Transport\HelperController@store')->name('admin.helper.post');
// 			    Route::get('delete/{id}', 'Transport\HelperController@destroy')->name('admin.helper.delete'); 
// 			    Route::get('edit/{id?}', 'Transport\HelperController@edit')->name('admin.helper.edit'); 
// 			     Route::post('update/{id?}', 'Transport\HelperController@update')->name('admin.helper.update'); 
// 			 });
// 			  //------------------------- Helper ---------------------------------
// 			Route::group(['prefix' => 'route'], function() {
// 			    Route::get('/', 'Transport\RouteController@index')->name('admin.route.list');	 	
// 			    Route::post('add', 'Transport\RouteController@store')->name('admin.route.post');
// 			    Route::get('delete/{id}', 'Transport\RouteController@destroy')->name('admin.route.delete'); 
// 			 });
// 			   //------------------------- Helper ---------------------------------
// 			Route::group(['prefix' => 'boarding-point'], function() {
// 			    Route::get('/', 'Transport\BoardingPointController@index')->name('admin.boardingPoint.list');	 	
// 			    // Route::post('add', 'Transport\BoardingPointController@store')->name('admin.boardingPoint.post');
// 			    Route::get('delete/{id}', 'Transport\BoardingPointController@destroy')->name('admin.boardingPoint.delete');
// 			      Route::get('edit/{id?}', 'Transport\BoardingPointController@edit')->name('admin.boardingPoint.edit');
// 			       Route::post('update/{id?}', 'Transport\BoardingPointController@update')->name('admin.boardingPoint.update'); 
// 			 });
// 			   //------------------------- Helper ---------------------------------
// 			Route::group(['prefix' => 'route-details'], function() {
// 			    Route::get('/', 'Transport\RouteDetailsController@index')->name('admin.routeDetails.list');	 	
// 			    Route::post('add', 'Transport\RouteDetailsController@store')->name('admin.routeDetails.post');
// 			    Route::get('get', 'Transport\RouteDetailsController@getBoardingPoint')->name('admin.routeDetails.get');
// 			     Route::get('show', 'Transport\RouteDetailsController@show')->name('admin.routeDetailsView.get');
// 			    Route::get('delete/{id}', 'Transport\RouteDetailsController@destroy')->name('admin.routesDetail.delete'); 
// 			 }); 
// 			    //------------------------- Helper ---------------------------------
// 			Route::group(['prefix' => 'route-vehicle'], function() {
// 			    Route::get('/', 'Transport\RouteVehicleController@index')->name('admin.routeVehicle.list');	 	
// 			    Route::post('add', 'Transport\RouteVehicleController@store')->name('admin.routeVehicle.post');
// 			    Route::get('get', 'Transport\RouteVehicleController@getVehicle')->name('admin.routeVehicle.get');
// 			    Route::get('delete/{id}', 'Transport\RouteVehicleController@destroy')->name('admin.routesVehicle.delete'); 
// 			 }); 
			 
// 			  //------------------------- Transport Registration ---------------------------------
// 			Route::group(['prefix' => 'transport-registration'], function() {
// 			    Route::get('/', 'Transport\TransportRegistrationController@index')->name('admin.transportRegistration.list');	 	
// 			    Route::post('add', 'Transport\TransportRegistrationController@store')->name('admin.transportRegistration.post');
// 			    Route::get('delete/{id}', 'Transport\TransportRegistrationController@destroy')->name('admin.transportRegistration.delete'); 
// 			     Route::get('edit/{id}', 'Transport\TransportRegistrationController@edit')->name('admin.transportRegistration.edit'); 
// 			 });
// 		});
// 		Route::group(['prefix' => 'exam'], function() {	
// 			  //------------------------- Exam Test ---------------------------------
// 			Route::group(['prefix' => 'class-test'], function() {
// 			    Route::get('/', 'Exam\ClassTestController@index')->name('admin.exam.test');	 	
// 			    Route::get('add-form', 'Exam\ClassTestController@addForm')->name('admin.exam.test.add.form');	 	
// 			    Route::get('edit-form/{id?}', 'Exam\ClassTestController@editForm')->name('admin.exam.test.edit.form');	 	
// 			    Route::post('store/{id?}', 'Exam\ClassTestController@store')->name('admin.exam.classtest.store');	 	
// 			    Route::get('class-section-subject', 'Exam\ClassTestController@classSectionSubject')->name('admin.exam.classtest.class.section.subject'); 
// 			    Route::post('table-show', 'Exam\ClassTestController@tableShow')->name('admin.exam.classtest.table.show'); 
// 			    Route::get('delete/{id}', 'Exam\ClassTestController@destroy')->name('admin.exam.classtest.delete'); 
// 			    Route::get('download-syllabus/{path}', 'Exam\ClassTestController@downloadSyllabus')->name('admin.exam.classtest.download.syllabus');	 	
// 			    Route::get('add-marks/{id}', 'Exam\ClassTestController@addMarks')->name('admin.exam.classtest.add.marks'); 
// 			    Route::get('attendance-import/{classtest_id}', 'Exam\ClassTestController@attendenceImport')->name('admin.exam.classtest.attendance.import'); 
// 			    Route::get('marks-verify/{classtest_id}', 'Exam\ClassTestController@marksVerify')->name('admin.exam.classtest.marks.verify'); 
// 			    Route::get('send-sms-test/{classtest_id}', 'Exam\ClassTestController@sendSmsTest')->name('admin.exam.classtest.sens.sms.test'); 
// 			    Route::get('test-date-wise-send-sms', 'Exam\ClassTestController@testDateWiseSendSMS')->name('admin.exam.classtest.test.date.wise.send.sms'); 
// 			    Route::post('test-date-wise-send-sms-show', 'Exam\ClassTestController@testDateWiseSendSMSShow')->name('admin.exam.classtest.test.date.wise.send.sms.show'); 
// 			    Route::get('status-change', 'Exam\ClassTestController@statusChange')->name('admin.exam.classtest.status.change'); 
// 			    Route::get('print/{class_test_id}', 'Exam\ClassTestController@print')->name('admin.exam.classtest.print'); 
// 			 });
// 			//------------------------- Exam marks details ---------------------------------
// 			Route::group(['prefix' => 'exam-marks-details'], function() {
// 			    Route::get('/', 'Exam\MarkDetailController@index')->name('admin.exam.mark.detail');	 	
// 			    Route::post('store/{id}', 'Exam\MarkDetailController@store')->name('admin.exam.mark.detail.store');
// 			    Route::post('marks-verify-store/{classtest_id}', 'Exam\MarkDetailController@marksVerifyStore')->name('admin.exam.classtest.marks.verify.store');	 	
// 			    Route::get('delete/{id}', 'Exam\MarkDetailController@destroy')->name('admin.exam.mark.detail.delete');
// 			    Route::get('search', 'Exam\MarkDetailController@searchStudent')->name('admin.mark.detail.studentSearch');
// 			    Route::get('send-sms-marks/{classtest_id}', 'Exam\MarkDetailController@sendSmsMarks')->name('admin.mark.detail.send.sms.marks.test'); 
// 			    Route::get('send-sms-marks-final', 'Exam\MarkDetailController@sendSmsMarksFinal')->name('admin.mark.detail.send.sms.marks.test.final'); 
// 			    Route::get('send-sms-marks-final-filter/{condition_id}', 'Exam\MarkDetailController@sendSmsMarksFilter')->name('admin.mark.detail.send.sms.marks.test.filter');
// 			    Route::post('send-sms-marks-final-filter-send', 'Exam\MarkDetailController@sendSmsMarksFilterSend')->name('admin.mark.detail.send.sms.marks.test.filter.send');
// 			    Route::get('compile/{classtest_id}', 'Exam\MarkDetailController@compile')->name('admin.mark.detail.compile');	 
// 			    Route::get('cancel-test/{classtest_id}', 'Exam\MarkDetailController@cancelTest')->name('admin.mark.detail.cancel.test');	 
// 			    Route::get('cancel-test-filter', 'Exam\MarkDetailController@cancelTestFilter')->name('admin.mark.detail.cancel.test.filter');
// 			    Route::post('cancel-test-filter-store', 'Exam\MarkDetailController@cancelTestFilterStore')->name('admin.mark.detail.cancel.test.filter.store');	 
// 			    Route::get('re-cancel-test/{classtest_id}', 'Exam\MarkDetailController@reCancelTest')->name('admin.mark.detail.re.cancel.test');	 
// 			 });
// 			   //------------------------- Exam Test Details ---------------------------------
// 			Route::group(['prefix' => 'class-detail'], function() {
// 			    Route::get('/', 'Exam\ClassTestDetailController@index')->name('admin.exam.test.details');	 	
// 			    Route::post('store', 'Exam\ClassTestDetailController@store')->name('admin.exam.classdetail.store');	
// 			    Route::get('delete/{id}', 'Exam\ClassTestDetailController@destroy')->name('admin.exam.classdetail.delete');	 	
// 			    Route::get('academic-year', 'Exam\ClassTestDetailController@academicYearWiseClassTest')->name('admin.academic.wise.class.test');
// 			    Route::get('search', 'Exam\ClassTestDetailController@searchStudent')->name('admin.classdetail.studentSearch');
			      	
			    Route::get('todays-class-test', 'Exam\ClassTestDetailController@todayClassTest')->name('admin.exam.today.class.test');	 	
			    Route::get('upcoming-class-test', 'Exam\ClassTestDetailController@upcomingClassTest')->name('admin.exam.upcoming.class.test');	 	
			    
// 			 });
// 			  //------------------------- Exam Term ---------------------------------
// 			Route::group(['prefix' => 'exam-term'], function() {
// 			    Route::get('/', 'Exam\ExamTermController@index')->name('admin.exam.term');	 	
// 			    Route::post('store', 'Exam\ExamTermController@store')->name('admin.exam.term.store');	 	
// 			    Route::get('delete/{id}', 'Exam\ExamTermController@destroy')->name('admin.exam.term.delete');
// 			 });
// 			  //------------------------- Exam Schedule ---------------------------------
// 			Route::group(['prefix' => 'exam-schedule'], function() {
// 			    Route::get('/', 'Exam\ExamScheduleController@index')->name('admin.exam.schedule');	 	
// 			    Route::post('store', 'Exam\ExamScheduleController@store')->name('admin.exam.schedule.store');	 	
// 			    Route::get('delete/{id}', 'Exam\ExamScheduleController@destroy')->name('admin.exam.schedule.delete');
// 			    Route::get('send-sms/{id}', 'Exam\ExamScheduleController@sendSms')->name('admin.exam.schedule.send.sms');
// 			    Route::get('send-email/{id}', 'Exam\ExamScheduleController@SendEmail')->name('admin.exam.schedule.send.email');
// 			 }); 
// 			//-------------------------------Student remark------------------------------------
// 			Route::group(['prefix' => 'student-remark'], function() {
// 			    Route::get('/', 'StudentRemarkController@index')->name('admin.student.remark.detail');	 	
// 			    Route::get('search', 'StudentRemarkController@search')->name('admin.student.remark.detail.search');
// 			    Route::get('add-remark/{id}', 'StudentRemarkController@addRemark')->name('admin.student.remark.detail.add.btn');
// 			    Route::post('remark-store/{id}', 'StudentRemarkController@remarkStore')->name('admin.student.remark.detail.store');	 	
			    
// 			 });
// 			  //------------------------- Exam marks details ---------------------------------
// 			Route::group(['prefix' => 'grade'], function() {
// 			    Route::get('grade', 'Exam\GradeDetailController@grade')->name('admin.exam.grade');	 	
// 			    Route::post('grade-store', 'Exam\GradeDetailController@gradeStore')->name('admin.exam.grade.detail.grade.store');	 	
			     	 	
			     
// 			 });
// 			Route::group(['prefix' => 'grade-details'], function() {
// 			    Route::get('/', 'Exam\GradeDetailController@index')->name('admin.exam.grade.detail');	 	
// 			    Route::post('store', 'Exam\GradeDetailController@store')->name('admin.exam.grade.detail.store');	 	
// 			    Route::get('delete/{id}', 'Exam\GradeDetailController@destroy')->name('admin.exam.mark.grade.delete');
// 			 });
// 			Route::group(['prefix' => 'class-test-report'], function() {
// 			   Route::get('/', 'Exam\ExamReportController@index')->name('admin.exam.report'); 
// 			   Route::post('filter', 'Exam\ExamReportController@filter')->name('admin.exam.report.filter');	 	
// 			   Route::get('print', 'Exam\ExamReportController@print')->name('admin.exam.report.print');	 	
			     
// 			 });
// 			Route::group(['prefix' => 'exam-report'], function() {
// 			   Route::get('exam-report', 'Exam\ExamReportController@examReport')->name('admin.exam.exam.report'); 
// 			   Route::post('exam-report-filter', 'Exam\ExamReportController@examReportFilter')->name('admin.exam.exam.report.filter'); 
// 			   Route::get('exam-report-print', 'Exam\ExamReportController@examReportPrint')->name('admin.exam.exam.report.print'); 
			    
			     
// 			 });
// 			Route::group(['prefix' => 'teacher-remark'], function() {
// 			    Route::get('/', 'Exam\TeacherRemarkController@index')->name('admin.exam.teacher.remark');	 	
// 			    Route::post('store', 'Exam\TeacherRemarkController@store')->name('admin.exam.teacher.remark.store');	 	
// 			    Route::get('table-show', 'Exam\TeacherRemarkController@tableShow')->name('admin.exam.teacher.remark.table.show');	 	
			     
// 			 });
// 			   //------------------------- Income ---------------------------------
			Route::group(['prefix' => 'incomeSlab'], function() {
			    Route::get('/', 'IncomeSlabController@index')->name('admin.incomeSlab.list');	//OK-----------

// 			    Route::post('store', 'IncomeSlabController@incomeSlabStore')->name('admin.incomeSlab.store'); });

			    Route::get('edit/{id?}', 'IncomeSlabController@edit')->name('admin.incomeSlab.edit');	//OK---------			
			    Route::post('update/{id?}', 'IncomeSlabController@update')->name('admin.incomeSlab.update');	//OK-----
			    Route::get('delete/{id}', 'IncomeSlabController@destroy')->name('admin.incomeSlab.delete');	//OK----
			    Route::get('report', 'IncomeSlabController@pdfGenerate')->name('admin.incomeSlab.report');	//OK-------

// 			});
// 			 Route::group(['prefix' => 'syllabus'], function() {
// 			    Route::get('syllabus', 'MasterController@syllabus')->name('admin.master.syllabus');	 	
// 			    Route::get('add-form', 'MasterController@syllabusAddForm')->name('admin.master.syllabus.add.form');
// 			    Route::get('class-subject', 'MasterController@syllabusClassSubject')->name('admin.master.syllabus.class.subject');	 	
// 			    Route::post('store', 'MasterController@syllabusStore')->name('admin.master.syllabus.store');
// 			    Route::post('show', 'MasterController@syllabusShow')->name('admin.master.syllabus.show');	 	
// 			    Route::get('view/{id}', 'MasterController@syllabusView')->name('admin.master.syllabus.view');	 	
			    

			}); 
		    Route::group(['prefix' => 'guardian'], function() {
			    Route::get('/', 'GuardianController@index')->name('admin.guardian.list');	 	//OK--------

// 			    Route::post('guardian-store', 'GuardianController@guardianStore')->name('admin.guardian.store');

			    Route::get('guardian-edit/{id?}', 'GuardianController@edit')->name('admin.guardian.edit');	//OK-------
			    Route::get('guardian-delete/{id}', 'GuardianController@destroy')->name('admin.guardian.delete');	 //OK-------
			    Route::post('guardian-update/{id?}', 'GuardianController@update')->name('admin.guardian.update');	//OK---	
			    Route::get('guardian-update-report', 'GuardianController@pdfGenerate')->name('admin.guardian.report');	//OK----- 	
			    	 	
			    

			});   
			
			//------------------------- Profession ---------------------------------
			Route::group(['prefix' => 'profession'], function() {
			    Route::get('/', 'ProfessionController@index')->name('admin.profession.list');		//OK----------

// 			    Route::post('store', 'ProfessionController@professionStore')->name('admin.profession.store');

			    Route::get('edit/{id?}', 'ProfessionController@edit')->name('admin.profession.edit');	//OK------
			    Route::post('update/{id?}', 'ProfessionController@update')->name('admin.profession.update');	//OK-------
			    Route::get('delete/{id}', 'ProfessionController@destroy')->name('admin.profession.delete');	//OK-----
			    Route::get('report', 'ProfessionController@pdfGenerate')->name('admin.profession.report');	//OK------

			});
			Route::group(['prefix' => 'religion'], function() {
			    Route::get('religion', 'ReligionController@index')->name('admin.religion.list');	//OK--------
			    Route::get('edit/{id?}', 'ReligionController@edit')->name('admin.religion.edit');	//OK-------	 	
			    Route::post('update/{id?}', 'ReligionController@update')->name('admin.religion.update'); 	//OK------
			   	Route::get('delete/{id?}', 'ReligionController@destroy')->name('admin.religion.delete');	//OK----
			   	Route::get('report', 'ReligionController@pdfGenerate')->name('admin.religion.report');		//OK-----
			});
			Route::group(['prefix' => 'category'], function() {
			    Route::get('/', 'CategoryController@index')->name('admin.category.list');	//OK------		 	
			    Route::get('edit/{id?}', 'CategoryController@edit')->name('admin.category.edit');	//OK------	 	
			    Route::post('update/{id?}', 'CategoryController@update')->name('admin.category.update'); 	//OK-------
			    Route::get('delete/{id}', 'CategoryController@destroy')->name('admin.category.delete');	 	//OK-------
			    Route::get('report', 'CategoryController@pdfGenerate')->name('admin.category.report');	 	//OK-------
			});

			Route::group(['prefix' => 'complexion'], function() {
			    Route::get('complexion', 'ComplexionController@index')->name('admin.complextion.list');		//OK-------	 	
			    Route::get('add/{id?}', 'ComplexionController@edit')->name('admin.complextion.edit');	 	//OK-------
			    Route::post('store/{id?}', 'ComplexionController@update')->name('admin.complextion.update'); //OK------
			    Route::get('delete/{id}', 'ComplexionController@destroy')->name('admin.complextion.delete'); //OK------
			    Route::get('report', 'ComplexionController@pdfGenerate')->name('admin.complextion.report'); //OK-------
			});
			Route::group(['prefix' => 'blood-group'], function() {
			    Route::get('bloodgroup', 'BloodGroupController@index')->name('admin.bloodgroup.list');		//OK------- 	
			    Route::get('add/{id?}', 'BloodGroupController@edit')->name('admin.bloodgroup.edit');	 	//OK-------
			    Route::post('store/{id?}', 'BloodGroupController@update')->name('admin.bloodgroup.update'); //OK-------
			    Route::get('delete/{id}', 'BloodGroupController@destroy')->name('admin.bloodgroup.delete'); //OK-------
			    Route::get('report', 'BloodGroupController@pdfGenerate')->name('admin.bloodgroup.report'); 	//OK-------
			});	
			Route::group(['prefix' => 'student-status'], function() {
			    Route::get('studentStatus', 'StudentStatusController@index')->name('admin.studentStatus.list');	//OK--------- 
			    Route::get('add/{id?}', 'StudentStatusController@edit')->name('admin.studentStatus.edit');	 	//OK--------
			    Route::post('store/{id?}', 'StudentStatusController@update')->name('admin.studentStatus.update'); 	//OK-------
			    Route::get('delete/{id}', 'StudentStatusController@destroy')->name('admin.studentStatus.delete'); 	//OK-------
			    Route::get('report', 'StudentStatusController@pdfGenerate')->name('admin.studentStatus.report'); 	//OK-------
			});
			Route::group(['prefix' => 'adminssion-schedule'], function() {
			    Route::get('adminssion-schedule', 'MasterController@formAdminssionSchedule')->name('admin.adminssion.seat'); //OK Pending---------
			    Route::get('adminssion-sch-showlist', 'MasterController@admSchShowList')->name('admin.adm.sch.showlist'); //OK Pending---------
			    Route::get('admschaddform/{id?}', 'MasterController@adminssionSchAddform')->name('admin.adminssion.sch.addform');	//OK Pending--------
			    Route::post('store/{id?}', 'MasterController@adminssionSeatStore')->name('admin.adminssion.seat.store'); //ok Pending-------

			    	 	
// 			    Route::get('add/{id?}', 'MasterController@addadminssionSeat')->name('admin.adminssion.seat.add');	 	
			     
			    Route::get('delete/{id}', 'MasterController@adminssionSeatDestroy')->name('admin.adminssion.seat.delete'); //ok Pending-----------------
			    Route::get('download/{id}', 'MasterController@adminssionSeatDownload')->name('admin.adminssion.seat.download'); //Pending-----
			});
			Route::group(['prefix' => 'adminssion'], function() {
			    Route::get('adminssion-incharge', 'MasterController@adminssionIncharge')->name('admin.adminssion.incharge.detail'); //OK 
			    Route::get('adminssion-incharge-addForm/{id?}', 'MasterController@adminssionInchargeAddForm')->name('admin.adminssion.incharge.addform'); //OK 
			    Route::post('adminssion-incharge-store/{id?}', 'MasterController@adminssionInchargeStore')->name('admin.adminssion.incharge.store'); //OK 
			});

			Route::group(['prefix' => 'report-template'], function() {
			    Route::get('report-template', 'ReportTemplateController@index')->name('admin.master.report.template'); 	//OK-----
			    Route::get('onChange', 'ReportTemplateController@reportTemplateOnChange')->name('admin.master.report.template.onchange'); //OK--
			    Route::get('status/{id}/{reports_type_id}', 'ReportTemplateController@reportTemplateStatus')->name('admin.master.report.template.status'); 	//OK----------
			    
			});	
// 			//------------------------- SMS ---------------------------------
// 			Route::group(['prefix' => 'sms'], function() {
// 			    Route::get('/', 'Sms\SmsController@index')->name('admin.sms.form');	 	
// 			    Route::get('form/{id}', 'Sms\SmsController@sendform')->name('admin.sms.send.form');	 	
// 			    Route::get('section', 'Sms\SmsController@sectionMultiple')->name('admin.sms.section.multiple');	 	
// 			    Route::post('send', 'Sms\SmsController@smsSend')->name('admin.sms.sendSms'); 
// 			    Route::post('quick-sms', 'Sms\SmsController@quickSms')->name('admin.quick.sms'); 
// 			    Route::get('sms-report', 'Sms\SmsController@smsReport')->name('admin.sms.smsReport'); 
// 			    Route::get('sms-report-type', 'Sms\SmsController@smsReportType')->name('admin.sms.smsReport.type'); 
// 			    Route::post('sms-report-filter', 'Sms\SmsController@smsReportFilter')->name('admin.sms.smsReport.filter'); 
// 			    Route::post('quick-email', 'Sms\SmsController@quickEmail')->name('admin.quick.email');
// 			    Route::get('sms-list', 'Sms\SmsController@smsTemplate')->name('admin.sms.template');
// 			    Route::get('sms-template', 'Sms\SmsController@smsTemplateOnchange')->name('admin.sms.template.onchange');
// 			    Route::get('sms-template-add/{id?}', 'Sms\SmsController@smsTemplateAdd')->name('admin.sms.template.add');
// 			    Route::post('sms-template-store', 'Sms\SmsController@smsTemplateStore')->name('admin.sms.template.store');
// 			    Route::get('sms-template-status/{id}', 'Sms\SmsController@smsTemplateStatus')->name('admin.sms.template.status'); 
// 			    Route::get('sms-template-edit/{id}', 'Sms\SmsController@smsTemplateEdit')->name('admin.sms.template.edit');
// 			    Route::get('sms-template-delete/{id}', 'Sms\SmsController@smsTemplateDestroy')->name('admin.sms.template.delete');
// 			    Route::get('sms-template-view/{id}', 'Sms\SmsController@smsTemplateView')->name('admin.sms.template.view');
// 			    Route::post('sms-template-update/{id}', 'Sms\SmsController@smsTemplateUpdate')->name('admin.sms.template.update');

// 			    Route::get('email-template', 'Sms\SmsController@emailTemplate')->name('admin.email.template');
// 			    Route::get('email-template-addform/{id}', 'Sms\SmsController@emailTemplateAddForm')->name('admin.email.template.addform');
// 			    Route::post('email-template-store/{id}', 'Sms\SmsController@emailTemplateStore')->name('admin.email.template.store');
// 			    Route::get('email-template-table/{id}', 'Sms\SmsController@emailTemplateTable')->name('admin.email.template.table');
// 			    Route::get('email-template-list', 'Sms\SmsController@emailTemplateOnchange')->name('admin.email.template.onchange');
// 			    Route::get('email-template-edit/{id}', 'Sms\SmsController@emailTemplateEdit')->name('admin.email.template.edit');
// 			    Route::get('email-template-delete/{id}', 'Sms\SmsController@emailTemplateDestroy')->name('admin.email.template.delete');
// 			    Route::post('email-template-update/{id}/{message_purpose_id}', 'Sms\SmsController@emailTemplateUpdate')->name('admin.email.template.update');
// 			    Route::get('email-template-view/{id}', 'Sms\SmsController@emailTemplateView')->name('admin.email.template.view');
// 			    Route::get('email-template-status/{id}', 'Sms\SmsController@emailTemplateStatus')->name('admin.email.template.status');
                
// 			});	

// 			Route::group(['prefix' => 'barcode'], function() {
// 			    Route::get('/', 'Barcode\BarcodeController@index')->name('admin.barcode.view');
// 			    Route::post('barcode-Generator', 'Barcode\BarcodeController@barcodeGenerator')->name('barcode.Generator');
// 			});
//                 //-----------------library menegment----------------
// 			Route::group(['prefix' => 'library-publisher'], function() {

// 			    Route::get('publisher-details', 'Library\LibraryController@index')->name('admin.library.publisher.details');
// 			    Route::get('add-form', 'Library\LibraryController@addForm')->name('admin.library.publisher.details.addform'); 
// 			    Route::post('store', 'Library\LibraryController@store')->name('admin.library.publisher.details.store');
// 			    Route::get('table-show', 'Library\LibraryController@tableShow')->name('admin.library.publisher.details.table.show'); 
// 			    Route::get('delete/{id}', 'Library\LibraryController@destroy')->name('admin.library.publisher.details.delete'); 
// 			    Route::get('edit/{id}', 'Library\LibraryController@edit')->name('admin.library.publisher.details.edit');

//                 Route::post('update/{id}', 'Library\LibraryController@update')->name('admin.library.publisher.details.update'); 
			    
// 			});
// 			//-----------------Author Details----------------------------------
// 			Route::group(['prefix' => 'author'], function() {
// 			    Route::get('/', 'Library\AuthorController@index')->name('admin.library.author.details');
// 			    Route::get('add-form', 'Library\AuthorController@addForm')->name('admin.library.author.details.addform');
// 			    Route::post('store', 'Library\AuthorController@store')->name('admin.library.author.details.store');
// 			    Route::get('table-show', 'Library\AuthorController@tableShow')->name('admin.library.author.details.table.show');
// 			    Route::get('delete/{id}', 'Library\AuthorController@destroy')->name('admin.library.author.details.delete');
// 			    Route::get('edit/{id}', 'Library\AuthorController@edit')->name('admin.library.author.details.edit');
// 			    Route::post('update/{id}', 'Library\AuthorController@update')->name('admin.library.author.details.update');
			    
// 			});
// 			//--------------------Books Details-----------------------------------

// 			Route::group(['prefix' => 'books'], function() {
// 			    Route::get('/', 'Library\BooksController@index')->name('admin.library.book.details');
// 			    Route::get('add-form', 'Library\BooksController@addForm')->name('admin.library.book.details.addform');
// 			    Route::post('store', 'Library\BooksController@store')->name('admin.library.book.details.store');
// 			    Route::get('table-show', 'Library\BooksController@tableShow')->name('admin.library.book.details.table.show');
// 			    Route::get('book-img/{image}', 'Library\BooksController@bookImageShow')->name('admin.library.book.image.show');
// 			    Route::get('delete/{id}', 'Library\BooksController@destroy')->name('admin.library.book.details.delete');
// 			    Route::get('edit/{id}', 'Library\BooksController@edit')->name('admin.library.book.details.edit');
// 			    Route::post('update/{id}', 'Library\BooksController@update')->name('admin.library.book.details.update');
			    
// 			});Route::group(['prefix' => 'book'], function() {
// 			    Route::get('category', 'Library\BooksController@bookCategory')->name('admin.library.book.category');
// 			    Route::get('category-add/{id?}', 'Library\BooksController@bookCategoryAddForm')->name('admin.library.book.category.add.form');
// 			    Route::post('category-store/{id?}', 'Library\BooksController@bookCategoryStore')->name('admin.library.book.category.store');
// 			    Route::get('category-delete/{id?}', 'Library\BooksController@bookCategoryDelete')->name('admin.library.book.category.delete');
			    
			    
// 			});
// 			Route::group(['prefix' => 'book-purchase-bill'], function() {
// 			    Route::get('/', 'Library\BookPurchaseBillController@index')->name('admin.library.book.book.purchase.bill');
// 			    Route::get('add-form', 'Library\BookPurchaseBillController@addForm')->name('admin.library.book.purchase.addform');
// 			    Route::post('store', 'Library\BookPurchaseBillController@store')->name('admin.library.book.book.purchase.bill.store');
//                 Route::get('table-show', 'Library\BookPurchaseBillController@tableShow')->name('admin.library.book.purchase.table.show');
//                 Route::get('edit/{id}', 'Library\BookPurchaseBillController@edit')->name('admin.library.purchase.details.edit');
//                 Route::get('delete/{id}', 'Library\BookPurchaseBillController@destroy')->name('admin.library.purchase.details.delete');
//                 Route::post('update/{id}', 'Library\BookPurchaseBillController@update')->name('admin.library.book.purchase.details.update');

// 		    });
// 		    Route::group(['prefix' => 'book-accession'], function() {
// 			 Route::get('/', 'Library\bookAccessionController@index')->name('admin.library.book.accession.details');
// 			  Route::get('add-form', 'Library\bookAccessionController@addForm')->name('admin.library.book.accession.addform'); 
// 			 Route::post('store', 'Library\bookAccessionController@store')->name('admin.library.book.accession.details.store');
// 			 Route::get('table-show', 'Library\bookAccessionController@tableShow')->name('admin.library.book.accession.table.show'); 
// 			 Route::get('edit/{id}', 'Library\bookAccessionController@edit')->name('admin.library.book.accession.edit');
// 			  Route::get('delete/{id}', 'Library\bookAccessionController@destroy')->name('admin.library.book.accession.delete');
//              Route::post('update/{id}', 'Library\bookAccessionController@update')->name('admin.library.book.accession.update');
//              Route::get('barcode', 'Library\bookAccessionController@accessionNoBarcode')->name('admin.library.book.accession.barcode');
//              Route::get('barcode-image/{image}', 'Library\bookAccessionController@accessionNoBarcodeImage')->name('admin.library.book.accession.barcode.image');

// 		    }); 
// 		    Route::group(['prefix' => 'library-member-type'], function() {
// 			    Route::get('/', 'Library\LibraryMemberTypeController@index')->name('admin.library.library.member.type'); 
// 			Route::get('add-form', 'Library\LibraryMemberTypeController@addForm')->name('admin.library.library.member.type.addform');
//             Route::post('store', 'Library\LibraryMemberTypeController@store')->name('admin.library.library.member.type.store');
//             Route::get('table-show', 'Library\LibraryMemberTypeController@tableShow')->name('admin.library.member.type.table.show');
//             Route::get('edit/{id}', 'Library\LibraryMemberTypeController@edit')->name('admin.library.member.type.edit');
//             Route::get('delete/{id}', 'Library\LibraryMemberTypeController@destroy')->name('admin.library.member.type.delete');
//             Route::post('update/{id}', 'Library\LibraryMemberTypeController@update')->name('admin.library.member.type.update');

// 		    });
// 		     // Route::group(['prefix' => 'ticket-details'], function() {
// 			    // Route::get('/', 'Library\TicketDetailsController@index')->name('admin.library.ticket.details');
// 			    // Route::get('search', 'Library\TicketDetailsController@search')->name('admin.library.ticket.issue.details.search');
// 			    // Route::post('store', 'Library\TicketDetailsController@store')->name('admin.library.ticket.details.store');
			   
// 			    // Route::get('ticket-add/{id}', 'Library\TicketDetailsController@ticketAdd')->name('admin.library.ticket.add');
// 			    // Route::get('delete/{id}', 'Library\TicketDetailsController@destroy')->name('admin.library.ticket.details.delete');
// 			    // Route::post('update/{id}', 'Library\TicketDetailsController@update')->name('admin.library.ticket.details.update');


// 			 // });  
// 		    Route::group(['prefix' => 'member-ship-facility'], function() {
// 			  Route::get('/', 'Library\MemberShipFacilityController@index')->name('admin.library.member.ship.facility');
// 			  Route::get('add-form', 'Library\MemberShipFacilityController@addForm')->name('admin.library.member.ship.facility.addform');
// 			  Route::get('onchange', 'Library\MemberShipFacilityController@onchange')->name('member.ship.facility.onchange');
// 			    Route::post('store', 'Library\MemberShipFacilityController@store')->name('admin.library.member.ship.facility.store'); 
// 			    Route::get('table-show', 'Library\MemberShipFacilityController@tableShow')->name('admin.library.member.ship.facility.table.show');
// 			    Route::get('edit/{id}', 'Library\MemberShipFacilityController@edit')->name('admin.library.member.ship.facility.edit');
// 			    Route::get('delete/{id}', 'Library\MemberShipFacilityController@destroy')->name('admin.library.member.ship.facility.delete');
// 			    Route::post('update/{id}', 'Library\MemberShipFacilityController@update')->name('admin.library.member.ship.facility.Update');

// 		    });
// 		     Route::group(['prefix' => 'member-ship-details'], function() {
// 			    Route::get('/', 'Library\MemberShipDetailsController@index')->name('admin.library.member.ship.details');
// 			    Route::post('store', 'Library\MemberShipDetailsController@store')->name('admin.library.member.ship.details.store'); 
// 			    Route::get('student-search', 'Library\MemberShipDetailsController@studentSearch')->name('admin.library.member.ship.details.student.search');
// 			    Route::get('stadmin.library.book.reserve.accession.wiseudent-show', 'Library\MemberShipDetailsController@studentShow')->name('admin.library.member.ship.details.student.show');
// 			     Route::get('ticket-show', 'Library\MemberShipDetailsController@ticketDetailsShow')->name('admin.library.ticket.details.show');
// 			     Route::post('ticket-store', 'Library\MemberShipDetailsController@ticketDetailsStore')->name('admin.library.member.registration.ticket.details.store'); 
// 		    });
// 		      Route::group(['prefix' => 'book-reserve-request'], function() {
// 			    Route::get('/', 'Library\BookReserveRequestController@index')->name('admin.library.book.reserve.request');
// 			    Route::get('add-form', 'Library\BookReserveRequestController@addForm')->name('admin.library.book.reserve.request.addform'); 
// 			    Route::get('book-accession', 'Library\BookReserveRequestController@bookAccession')->name('admin.library.book.reserve.accession.wise');

// 			    Route::get('gegistration-wise-history', 'Library\BookReserveRequestController@registrationWiseHistory')->name('admin.library.book.reserve.registration.wise.history');

// 			     Route::get('book-accession-wise-history', 'Library\BookReserveRequestController@bookAccessionWiseHistory')->name('admin.library.book.reserve.accession.wise.history');

// 			    Route::post('store', 'Library\BookReserveRequestController@store')->name('admin.library.book.request.date.store'); 
// 			    Route::get('table-show', 'Library\BookReserveRequestController@tableShow')->name('admin.library.book.reserve.table.show'); 
// 			    Route::get('cancel-upto-date', 'Library\BookReserveRequestController@cancelUpToDate')->name('admin.library.book.reserve.cancel.upto.date'); 
// 			    Route::get('cancel/{id}', 'Library\BookReserveRequestController@cancel')->name('admin.library.book.reserve.cancel');
			    
//             }); 

// 	      Route::group(['prefix' => 'book-issue-details'], function() {
// 		    Route::get('/', 'Library\BookIssueDetailsController@index')->name('admin.library.book.issue.details');
// 		    Route::post('store', 'Library\BookIssueDetailsController@store')->name('admin.library.book.issue.details.store'); 
// 		    Route::get('registration-onchange', 'Library\BookIssueDetailsController@registrationOnchange')->name('admin.library.book.issue.onchange.registration.details');
// 		    Route::get('accession-onchange', 'Library\BookIssueDetailsController@accessionOnchange')->name('admin.library.book.issue.onchange.accession.details');
// 		    Route::get('book-issue-history/{id}', 'Library\BookIssueDetailsController@bookIssueHistory')->name('admin.library.book.issue.history');

			     
//             });  Route::group(['prefix' => 'book-return'], function() {
// 		    Route::get('book-return', 'Library\BookIssueDetailsController@bookReturn')->name('admin.library.book.return'); 
// 		    Route::post('book-search', 'Library\BookIssueDetailsController@bookSearch')->name('admin.library.book.issue.details.search');
// 		    Route::get('return/{id}', 'Library\BookIssueDetailsController@returnUpdate')->name('admin.library.book.issue.return'); 
			     
//             }); 
//             Route::group(['prefix' => 'ticket-card'], function() {
// 		    Route::get('/', 'Library\TicketController@index')->name('admin.library.ticket.card'); 
// 		    Route::post('generate', 'Library\TicketController@generate')->name('admin.library.ticket.card.generate'); 
// 		    Route::get('barcode/{barcode}', 'Library\TicketController@barcode')->name('admin.library.ticket.card.barcode'); 
		     
			     
//             }); 
// 		      Route::group(['prefix' => 'event-type'], function() {
// 			    Route::get('/', 'Event\EventTypeController@index')->name('admin.event.type');
// 			    Route::post('store', 'Event\EventTypeController@store')->name('admin.event.type.store');
// 			    Route::get('event-add', 'Event\EventTypeController@addEventType')->name('admin.event.type.add.form');
// 			    Route::get('table-show', 'Event\EventTypeController@tableShow')->name('admin.event.type.table.show');
// 			    Route::get('edit/{id}', 'Event\EventTypeController@edit')->name('admin.event.type.edit');
// 			    Route::get('delete/{id}', 'Event\EventTypeController@destroy')->name('admin.event.type.delete');
// 			    Route::post('update/{id}', 'Event\EventTypeController@update')->name('admin.event.type.update'); 
			    
			     
//             });
//               Route::group(['prefix' => 'event-details'], function() {
// 			   Route::get('/', 'Event\EventDetailsController@index')->name('admin.event.details');
// 			    Route::get('add-form', 'Event\EventDetailsController@addForm')->name('admin.event.details.add.form'); 
// 			    Route::get('onchange', 'Event\EventDetailsController@onChange')->name('admin.event.details.onchange'); 
// 			    Route::post('store', 'Event\EventDetailsController@store')->name('admin.event.details.store'); 
// 			    Route::get('table-show', 'Event\EventDetailsController@tableShow')->name('admin.event.details.table.show');
// 			    Route::get('edit/{id}', 'Event\EventDetailsController@edit')->name('admin.event.details.edit');
// 			    Route::get('delete/{id}', 'Event\EventDetailsController@destroy')->name('admin.event.details.delete');
// 			    Route::post('update/{id}', 'Event\EventDetailsController@update')->name('admin.event.details.update');
			    Route::get('todays-event/{id}', 'Event\EventDetailsController@todayEventDashboard')->name('admin.event.today.event.dashboard');
			     
			     
//             });
    		Route::group(['prefix' => 'school-details'], function() {
			    Route::get('/', 'SchoolDetails\SchoolDetailsController@index')->name('admin.school.details');	//OK-------
			    Route::get('add-form', 'SchoolDetails\SchoolDetailsController@addForm')->name('admin.school.details.addForm');	//OK--------
			    Route::post('store', 'SchoolDetails\SchoolDetailsController@store')->name('admin.school.details.store');	//OK--------
			    Route::get('table-show', 'SchoolDetails\SchoolDetailsController@tableShow')->name('admin.school.details.table.show');	//OK----
			    Route::get('logo/{image}', 'SchoolDetails\SchoolDetailsController@showlogo')->name('admin.school.logo.show');	//OK----
			    Route::get('report-check', 'SchoolDetails\SchoolDetailsController@reportCheck')->name('admin.school.details.report.check');	//OK--
          	});
//            Route::group(['prefix' => 'school-dominos'], function() {
// 			    Route::get('/', 'SchoolDomainController@index')->name('admin.school.dominos');
// 			    Route::get('add-form', 'SchoolDomainController@addForm')->name('admin.school.dominos.add.form');
// 			    Route::post('store', 'SchoolDomainController@store')->name('admin.school.dominos.store');
// 			    Route::get('table-show', 'SchoolDomainController@tableShow')->name('admin.school.dominos.table.show');
// 			    Route::get('edit/{id}', 'SchoolDomainController@edit')->name('admin.school.dominos.edit');
// 			    Route::get('delete/{id}', 'SchoolDomainController@destroy')->name('admin.school.dominos.delete');
// 			    Route::post('update/{id}', 'SchoolDomainController@update')->name('admin.school.dominos.update');
			    

//           }); 
//            Route::group(['prefix' => 'quotes'], function() {
// 			    Route::get('quotes', 'SchoolDetails\SchoolDetailsController@quotesindex')->name('admin.school.details.quotes');
// 			    Route::get('quotes-add', 'SchoolDetails\SchoolDetailsController@quotesAddForm')->name('admin.school.details.quotes.addForm');
// 			    Route::post('quotes-store', 'SchoolDetails\SchoolDetailsController@quotesStore')->name('admin.school.details.quotes.store');
// 			    Route::get('quotes-table', 'SchoolDetails\SchoolDetailsController@quotesTableShow')->name('admin.school.details.quotes.table.show');
// 			    Route::get('quotes-edit/{id}', 'SchoolDetails\SchoolDetailsController@quotesEdit')->name('admin.school.details.quotes.edit');
// 			    Route::get('quotes-delete/{id}', 'SchoolDetails\SchoolDetailsController@quotesDestroy')->name('admin.school.details.quotes.delete');
// 			    Route::post('quotes-update/{id}', 'SchoolDetails\SchoolDetailsController@quotesUpdate')->name('admin.school.details.quotes.update');
			     

//           }); 
//                Route::group(['prefix' => 'student-id-card'], function() {
// 			    Route::get('/', 'StudentIDCard\StudentIDCardController@index')->name('admin.student.id.card');
// 			    Route::get('generate-class-wise', 'StudentIDCard\StudentIDCardController@generateClassWise')->name('admin.student.idcard.generate.classwise');
// 			    Route::get('store', 'StudentIDCard\StudentIDCardController@store')->name('admin.student.idcard.generate.store');
			    

//           });
//                Route::group(['prefix' => 'student-idcard'], function() {
// 			    Route::get('report', 'StudentIDCard\StudentIDCardController@report')->name('admin.student.idcard.report');
			    
			    

//           });
// //-------------------------------------Time-Table--------------------------------------------------------------             
//               Route::group(['prefix' => 'time-table-type'], function() {

// 			    Route::get('/', 'TimeTable\TimeTableTypeController@index')->name('admin.time.table.type');
// 			    Route::post('store', 'TimeTable\TimeTableTypeController@store')->name('admin.time.table.type.store');
// 			    Route::get('edit/{id}', 'TimeTable\TimeTableTypeController@edit')->name('admin.time.table.type.edit');
// 			   Route::get('delete/{id}', 'TimeTable\TimeTableTypeController@destroy')->name('admin.time.table.type.delete');
// 			   Route::post('update/{id}', 'TimeTable\TimeTableTypeController@update')->name('admin.time.table.type.update');
//           });
//               Route::group(['prefix' => 'preod-timing'], function() {

// 			    Route::get('/', 'TimeTable\PreodController@index')->name('admin.preod.timing');
// 			    Route::post('store', 'TimeTable\PreodController@store')->name('admin.preod.timing.store');
// 			    Route::get('table-show', 'TimeTable\PreodController@tableShow')->name('admin.preod.timing.table.show');
// 			    Route::get('edit/{id}', 'TimeTable\PreodController@edit')->name('admin.preod.timing.edit');
// 			    Route::get('delete/{id}', 'TimeTable\PreodController@destroy')->name('admin.preod.timing.delete');
// 			    Route::post('update/{id}', 'TimeTable\PreodController@update')->name('admin.preod.timing.update');
//           });

//               Route::group(['prefix' => 'class-period_schedule'], function() {

// 			    Route::get('/', 'TimeTable\ClassPeriodScheduleController@index')->name('admin.class.period.schedule');
// 			    Route::get('add-form', 'TimeTable\ClassPeriodScheduleController@addForm')->name('admin.class.period.schedule.addform');
// 			    Route::get('schedule-show', 'TimeTable\ClassPeriodScheduleController@scheduleShow')->name('admin.class.period.schedule.show');
// 			     Route::post('store', 'TimeTable\ClassPeriodScheduleController@store')->name('admin.class.period.schedule.store');
// 		  });    
// 			  Route::group(['prefix' => 'multiple-class-period_schedule'], function() {

// 			    Route::get('multiple-class-period_schedule', 'TimeTable\ClassPeriodScheduleController@multipleClassPeriodSchedule')->name('admin.multiple.class.period.schedule');
// 			    Route::post('multiple-store', 'TimeTable\ClassPeriodScheduleController@multipleClassPeriodScheduleStore')->name('admin.multiple.class.period.schedule.store');
			   
			    
//           });
//                Route::group(['prefix' => 'class-subject-period'], function() {
//                	 Route::get('/', 'TimeTable\ClassSubjectPeriodController@index')->name('admin.class.subject.period');
//                	 Route::get('section', 'TimeTable\ClassSubjectPeriodController@classWiseSection')->name('admin.class.subject.period.class.wise.section');
//                	 Route::post('store', 'TimeTable\ClassSubjectPeriodController@store')->name('admin.class.subject.period.store');
//                	 Route::get('delete/{id}', 'TimeTable\ClassSubjectPeriodController@destroy')->name('admin.class.subject.period.delete');
//           });
//                Route::group(['prefix' => 'option-subject-group'], function() {
//                	 Route::get('option-subject-group', 'TimeTable\ClassSubjectPeriodController@optionSubjectGroup')->name('admin.option.subject.group');
//                	 Route::get('subject-show', 'TimeTable\ClassSubjectPeriodController@subjectShow')->name('admin.option.subject.show');
//                	 Route::get('table-show', 'TimeTable\ClassSubjectPeriodController@tableShow')->name('admin.option.table.show');
//                	 Route::get('subject-delete/{id}', 'TimeTable\ClassSubjectPeriodController@destroySubjectSave')->name('admin.optional.subject.group.delete');
//                	 Route::post('subject-store', 'TimeTable\ClassSubjectPeriodController@subjectMoveStore')->name('admin.option.subject.move.store');
//           });
//                //------------------teacher-details-------------------------------------------------------------------
//                Route::group(['prefix' => 'staff'], function() {
//                	 Route::get('list', 'TimeTable\TeacherController@index')->name('admin.staff.details');
//                	 Route::get('add-form', 'TimeTable\TeacherController@addForm')->name('admin.staff.details.add.form');

//                	 Route::get('class-section', 'TimeTable\TeacherController@addclassWiseSection')->name('admin.teacher.class.wise.section.addForm');	               	 
//                	 Route::get('table-show', 'TimeTable\TeacherController@tableShow')->name('admin.staff.details.table.show'); 
//                	 Route::post('store', 'TimeTable\TeacherController@store')->name('admin.staff.details.store');
//                	 Route::get('mapping', 'TimeTable\TeacherController@mapping')->name('admin.staff.mapping');
//                	 Route::get('teacher-mapping', 'TimeTable\TeacherController@teacherMapping')->name('admin.staff.teacher.mapping');
//                	 Route::post('teacher-mapping-store', 'TimeTable\TeacherController@teacherMappingStore')->name('admin.staff.teacher.mapping.store');
//                	 Route::get('teacher-mapping-report', 'TimeTable\TeacherController@teacherMappingreport')->name('admin.staff.teacher.mapping.report');
//                	 Route::post('teacher-mapping-report-generate', 'TimeTable\TeacherController@teacherMappingreportGenerate')->name('admin.staff.teacher.mapping.report.generate');

//                	 Route::get('edit/{id}', 'TimeTable\TeacherController@edit')->name('admin.teacher.details.edit');
//                	 Route::get('delete/{id}', 'TimeTable\TeacherController@destroy')->name('admin.teacher.details.delete');
//                	 Route::post('update/{id}', 'TimeTable\TeacherController@update')->name('admin.teacher.details.update');
               	 
//           });
//                Route::group(['prefix' => 'teacher-working-days'], function() {
//                	 Route::get('working-days', 'TimeTable\TeacherController@workDays')->name('admin.teacher.working.days');
//                	 Route::get('show', 'TimeTable\TeacherController@workingDaysShow')->name('admin.teacher.working.schedule.show');
//                	 Route::post('store', 'TimeTable\TeacherController@teacherWorkingStore')->name('admin.teacher.working.schedule.store');
//           });
//                Route::group(['prefix' => 'multiple-teacher-working-days'], function() {
//                	 Route::get('multiple-working-days', 'TimeTable\TeacherController@multipleWorkingDays')->name('admin.teacher.multiple.working.days');
//                	 Route::post('multiple-store', 'TimeTable\TeacherController@multipleWorkingDaysStore')->name('admin.teacher.multiple.working.days.store');
//                	// Route::get('show', 'TimeTable\TeacherController@workingDaysShow')->name('admin.teacher.working.schedule.show');
//                	 // Route::post('store', 'TimeTable\TeacherController@teacherWorkingStore')->name('admin.teacher.working.schedule.store');
//           });
//                Route::group(['prefix' => 'teacher-subject-class'], function() {
//                	 Route::get('class-subject', 'TimeTable\TeacherController@teacherClassSubject')->name('admin.teacher.class.subject');
//                	 Route::get('section', 'TimeTable\TeacherController@ClassWiseSection')->name('admin.teacher.class.wise.section');
//                	 Route::get('teacher-wise-class', 'TimeTable\TeacherController@teacherWiseClass')->name('admin.teacher.wise.class');
//                	 Route::get('teacher-history', 'TimeTable\TeacherController@teacherWiseHistory')->name('admin.teacher.history.table.show');
//                	 Route::get('teacher-period', 'TimeTable\TeacherController@SubjectWisePeriod')->name('admin.teacher.subject.wise.period');
//                	 Route::get('total-period-lode', 'TimeTable\TeacherController@toTalSubjectWisePeriod')->name('admin.teacher.subject.wise.total.period.history');
//                	 Route::get('teacher-period-history', 'TimeTable\TeacherController@SubjectWisePeriodHistory')->name('admin.teacher.subject.wise.period.history');
//                	 Route::get('teacher-period-history.delete/{id}', 'TimeTable\TeacherController@SubjectWisePeriodHistoryDestroy')->name('admin.teacher.subject.wise.period.history.delete');
//                	 Route::post('teacher-subject-class-store', 'TimeTable\TeacherController@teacherSubjectClassStore')->name('admin.teacher.subject.class.store');

//           });
//                 Route::group(['prefix' => 'teacher-absent'], function() {
//                 	Route::get('teacher-absent', 'TimeTable\TeacherController@teacherAbsent')->name('admin.teacher.absent');
//                 	Route::post('teacher-absent-store', 'TimeTable\TeacherController@teacherAbsentStore')->name('admin.teacher.store');
//                 	Route::get('teacher-absent-delete/{id}', 'TimeTable\TeacherController@teacherAbsentDelete')->name('admin.teacher.absent.dalete');
//                 	Route::get('teacher-absent-send-sms/{id}', 'TimeTable\TeacherController@teacherAbsentSendSms')->name('admin.teacher.absent.send.sms');
//                 	Route::post('teacher-absent-sms-email', 'TimeTable\TeacherController@teacherAbsentSendSmsEmail')->name('admin.teacher.absent.send.sms.email');
//            });
//                 Route::group(['prefix' => 'teacher-adjustment'], function() { 
//                 	Route::get('adjustment', 'TimeTable\TeacherController@adjustment')->name('admin.teacher.adjustment');
//                 	Route::post('teacher-show', 'TimeTable\TeacherController@teacherAdjustmentShow')->name('admin.teacher.adjustment.show');
//                 	Route::post('teacher-adjustment', 'TimeTable\TeacherController@teacherAdjustment')->name('admin.teacher.adjustment.result');
//                 	Route::get('adjustment-teacher-edit/{id}', 'TimeTable\TeacherController@teacherAdjustmentEdit')->name('admin.teacher.adjustment.edit');
//                 	Route::get('adjustment-teacher-view/{id}', 'TimeTable\TeacherController@teacherAdjustmentView')->name('admin.teacher.adjustment.view');
//                 	Route::post('adjustment-teacher-update/{id}', 'TimeTable\TeacherController@teacherAdjustmentUpdate')->name('admin.teacher.adjustment.update');
//            });
        	Route::group(['prefix' => 'room-details'], function() {
               	Route::get('/', 'Room\RoomController@index')->name('admin.room.details');	//OK--------

//                	Route::post('store', 'Room\RoomController@store')->name('admin.room.details.store');
               	 
               	Route::get('edit/{id?}', 'Room\RoomController@edit')->name('admin.room.details.edit');	//OK--------
               	Route::get('delete/{id}', 'Room\RoomController@destroy')->name('admin.room.details.delete');	//OK------
               	Route::post('update/{id?}', 'Room\RoomController@update')->name('admin.room.details.update');	//OK----
               	Route::get('report', 'Room\RoomController@pdfGenerate')->name('admin.room.details.report');	//OK------
          	});
           	Route::group(['prefix' => 'class-wise-room'], function() {
               	Route::get('/', 'Room\ClassRoomController@index')->name('admin.class.wise.room.details');	//OK------
               	Route::get('refrash', 'Room\ClassRoomController@reFrash')->name('admin.class.wise.room.refrash');	//OK-------
               	Route::post('store', 'Room\ClassRoomController@store')->name('admin.class.wise.room.store');	//OK-------

//                	Route::get('edit/{id}', 'Room\ClassRoomController@edit')->name('admin.class.wise.room.details.edit');

               	Route::get('delete/{id}', 'Room\ClassRoomController@destroy')->name('admin.class.wise.room.details.delete');	//OK------
               	
//                	Route::post('update/{id}', 'Room\ClassRoomController@update')->name('admin.class.wise.room.details.update');

               	Route::get('report', 'Room\ClassRoomController@pdfGenerate')->name('admin.class.wise.room.details.report');	//OK--------
          	});
//            Route::group(['prefix' => 'subject-wise-room'], function() {
//                	 Route::get('subject-room', 'Room\ClassRoomController@subjectWiseRoom')->name('admin.subject.wise.room');
//                	 Route::post('subject-room-store', 'Room\ClassRoomController@subjectWiseRoomStore')->name('admin.subject.wise.room.store');
//                	 Route::get('edit/{id}', 'Room\ClassRoomController@edit')->name('admin.subject.wise.room.edit');
//                	 Route::get('delete/{id}', 'Room\ClassRoomController@Delete')->name('admin.subject.wise.room.delete');
//                	 Route::post('update/{id}', 'Room\ClassRoomController@update')->name('admin.subject.wise.room.update');
//           });
//            Route::group(['prefix' => 'combine-class-subject-group'], function() {
//                	 Route::get('/', 'Room\CombineClassSubjectGroupController@index')->name('admin.combine.class.subject.group');
//                	 Route::get('class', 'Room\CombineClassSubjectGroupController@subjectWiseClasss')->name('admin.combine.class.select.subject.wise.class');
//                	 Route::get('section', 'Room\CombineClassSubjectGroupController@classtWiseSection')->name('admin.combine.class.select.class.wise.section');
//                	 Route::get('table-show', 'Room\CombineClassSubjectGroupController@tableShow')->name('admin.combine.class.select.class.wise.table.show');
//                	 Route::post('store', 'Room\CombineClassSubjectGroupController@store')->name('admin.combine.class.subject.group.store');
//                	 Route::get('delete/{id}', 'Room\CombineClassSubjectGroupController@combineClassSubjectDetailsDestroy')->name('admin.combine.class.subject.details.delete');
//           });

//            Route::group(['prefix' => 'manual-time-table'], function() {
//                	 Route::get('/', 'TimeTable\TimeTablController@index')->name('admin.time.table.generate');
//                	 Route::get('manual', 'TimeTable\TimeTablController@manual')->name('admin.time.table.manual');
//                	 Route::get('manual-wise-show', 'TimeTable\TimeTablController@manualWiseShow')->name('admin.time.table.manual.subject.show');
//                	 Route::get('class-wise-section', 'TimeTable\TimeTablController@classWiseSection')->name('admin.time.table.manual.class.wise.section');
//                	 Route::get('subject-wise-teacher', 'TimeTable\TimeTablController@subjectWiseTeacher')->name('admin.time.table.manual.subject.wise.teacher');
//                	 Route::get('teacher-wise-period', 'TimeTable\TimeTablController@teacherWisePeriod')->name('admin.time.table.manual.teacher.wise.day.period');
//                	 Route::get('day-wise-period', 'TimeTable\TimeTablController@daysWisePeriod')->name('admin.time.table.manual.day.wise.period');
//                	 Route::get('show', 'TimeTable\TimeTablController@finalResult')->name('admin.time.table.manual.button.wise.final.result');
//                	 Route::post('manual-store', 'TimeTable\TimeTablController@store')->name('admin.time.table.manual.store');
//                	 Route::get('manual-outo-generate', 'TimeTable\TimeTablController@outoGenerateManual')->name('admin.time.table.manual.outo.generate');
//                	 Route::get('manual-delete/{id}', 'TimeTable\TimeTablController@manualDelete')->name('admin.time.table.manual.delete');

//        });
//            Route::group(['prefix' => 'time-table-report'], function() {
//                	 Route::get('/', 'TimeTable\TimeTableReportController@index')->name('admin.time.table.report');
//                	 Route::get('report', 'TimeTable\TimeTableReportController@reportFor')->name('admin.time.table.report.for');
//                	 Route::get('teacher-for', 'TimeTable\TimeTableReportController@teacherFor')->name('admin.time.table.teacher.for');
//                	 Route::post('show', 'TimeTable\TimeTableReportController@show')->name('admin.time.table.report.show');

//        });
//            Route::group(['prefix' => 'award'], function() {
//                	 Route::get('/', 'AwardController@index')->name('admin.award.list');
//                	 Route::get('add-form', 'AwardController@addForm')->name('admin.award.add.form');
//                	 Route::post('store', 'AwardController@store')->name('admin.award.store');
//                	 Route::get('table-show', 'AwardController@tableShow')->name('admin.award.table.show');
//                	 Route::get('edit/{id}', 'AwardController@edit')->name('admin.award.edit');
//                	 Route::get('delete/{id}', 'AwardController@destroy')->name('admin.award.delete');
//                	 Route::post('update/{id}', 'AwardController@update')->name('admin.award.update');
//                	 Route::get('image-show/{id}{image_id}', 'AwardController@imageShow')->name('admin.award.image.show');
               	 
//        });
        	Route::group(['prefix' => 'award-for'], function() {
//                	 Route::get('award-for', 'AwardController@awardFor')->name('admin.award.for.list');
//                	 Route::get('award-for-addform', 'AwardController@awardForAddForm')->name('admin.award.for.addform');
//                	 Route::post('store', 'AwardController@awardForStore')->name('admin.award.for.store');
               	Route::get('table-show/{student_id?}', 'AwardController@awardForTableShow')->name('admin.award.for.table.show');
//                	Route::get('edit/{id}', 'AwardController@awardForEdit')->name('admin.award.for.edit');
//                	 Route::get('delete/{id}', 'AwardController@awardForDelete')->name('admin.award.for.delete');
//                	 Route::post('update/{id}', 'AwardController@awardForUpdate')->name('admin.award.for.update');
               	 
       		});
//            Route::group(['prefix' => 'award-photo'], function() {
//                	 Route::get('photo', 'AwardController@awardPhotoIndex')->name('admin.award.photo.list');
//                	 Route::get('add-form', 'AwardController@awardPhotoAddForm')->name('admin.award.photo.add.form');
//                	 Route::post('store', 'AwardController@awardPhotoStore')->name('admin.award.photo.store');
//                	 Route::get('table-show', 'AwardController@awardPhotoTableShow')->name('admin.award.photo.table.show');
//                	 Route::get('edit/{id}', 'AwardController@awardPhotoEdit')->name('admin.award.photo.edit');
//                	 Route::post('update/{id}', 'AwardController@awardPhotoUpdate')->name('admin.award.photo.update');
//                	 Route::get('delete/{id}', 'AwardController@awardPhotoDelete')->name('admin.award.photo.delete');
               	 
//        });
//            Route::group(['prefix' => 'teacher-appoinment'], function() {
//                	 Route::get('/', 'AppointmentController@index')->name('admin.teacher.appointment');
//                	 Route::get('add-form', 'AppointmentController@addForm')->name('admin.teacher.appointment.addFprm');
//                	 Route::post('/', 'AppointmentController@store')->name('admin.teacher.appointment.store');
//                	 Route::get('table-show', 'AppointmentController@tableShow')->name('admin.teacher.appointment.table.show');
//                	 Route::get('edit/{id}', 'AppointmentController@edit')->name('admin.teacher.appointment.edit');
//                	 Route::get('delete/{id}', 'AppointmentController@destroy')->name('admin.teacher.appointment.delete');
//                	 Route::get('update/{id}', 'AppointmentController@update')->name('admin.teacher.appointment.update');
               	 
               	 
//        });
//            Route::group(['prefix' => 'lesson-plan'], function() {
//                	 Route::get('/', 'LessonPlanController@index')->name('admin.teacher.lesson.plan');
//                	 Route::get('add-form', 'LessonPlanController@addForm')->name('admin.teacher.lesson.plan.addFprm');
//                	 Route::post('/', 'LessonPlanController@store')->name('admin.teacher.lesson.plan.store');
//                	 Route::get('table-show', 'LessonPlanController@tableShow')->name('admin.teacher.lesson.plan.table.show');
//                	 Route::get('edit/{id}', 'LessonPlanController@edit')->name('admin.teacher.lesson.plan.edit');
//                	 Route::get('delete/{id}', 'LessonPlanController@destroy')->name('admin.teacher.lesson.plan.delete');
//                	 Route::post('update/{id}', 'LessonPlanController@update')->name('admin.teacher.lesson.plan.update');

// //--------------lesson-plan-follow---------------------------------------

//                	 Route::get('lesson-plan-follow', 'LessonPlanController@lessonPlanFollow')->name('admin.teacher.lesson.plan.follow');
//                	 Route::get('lesson-plan-follow-add', 'LessonPlanController@lessonPlanFollowAddForm')->name('admin.teacher.lesson.plan.follow.add.form');
//                	 Route::post('lesson-plan-follow-store', 'LessonPlanController@lessonPlanFollowStore')->name('admin.teacher.lesson.plan.follow.store');
//                	 Route::get('lesson-plan-follow-table', 'LessonPlanController@lessonPlanFollowTable')->name('admin.teacher.lesson.plan.follow.table');
//                	 Route::get('lesson-plan-follow-edit/{id}', 'LessonPlanController@lessonPlanFollowEdit')->name('admin.teacher.lesson.plan.follow.edit');
//                	 Route::post('lesson-plan-follow-update/{id}', 'LessonPlanController@lessonPlanFollowUpdate')->name('admin.teacher.lesson.plan.follow.update');
               	 
               	 
//        });   
//            Route::group(['prefix' => 'teacher-diary'], function() {
//                	 Route::get('/', 'TeacherDiaryController@index')->name('admin.teacher.diary');
//                	 Route::get('add-form', 'TeacherDiaryController@addForm')->name('admin.teacher.diary.add.form'); 
//                	 Route::post('diary-details', 'TeacherDiaryController@diaryDetails')->name('admin.teacher.diary.details'); 
//                	 Route::post('diary-details-store', 'TeacherDiaryController@diaryDetailsStore')->name('admin.teacher.diary.details.store'); 
               	 
//        });
        	Route::group(['prefix' => 'house'], function() {
               	Route::get('/', 'HouseController@index')->name('admin.house.details');		//OK---------

//                	Route::get('add-form', 'HouseController@addForm')->name('admin.house.add.form'); 
//                	Route::post('store', 'HouseController@store')->name('admin.house.store'); 
//                	Route::get('table-show', 'HouseController@tableShow')->name('admin.house.table.show'); 

               	Route::get('edit/{id?}', 'HouseController@edit')->name('admin.houses.edit');	//OK----------- 
               	Route::get('delete/{id}', 'HouseController@destroy')->name('admin.houses.delete'); 	//OK-------
               	Route::post('update/{id}', 'HouseController@update')->name('admin.houses.update');	//OK------ 
               	Route::get('report', 'HouseController@pdfGenerate')->name('admin.houses.report');  	//OK-----------
       		});


           	Route::group(['prefix' => 'genders'], function() {
               	Route::get('/', 'GenderController@index')->name('admin.gender.gender'); 	//OK---------
               	Route::get('add/{id?}', 'GenderController@edit')->name('admin.gender.edit');	//OK----- 
               	Route::post('store/{id?}', 'GenderController@update')->name('admin.gender.store'); 	//OK----------
               	Route::get('delete/{id}', 'GenderController@destroy')->name('admin.gender.delete'); 	//OK-------
               	Route::get('report', 'GenderController@pdfGenerate')->name('admin.gender.report'); 	//OK--------  	 
       		});

            Route::group(['prefix' => 'api-settings'], function() {
               	Route::get('/', 'ApiSetingController@index')->name('admin.api.seting'); 	//OK-----------
               	Route::get('sms-api-add/{id?}', 'ApiSetingController@smsApiAdd')->name('admin.api.smsApiAdd'); 	//OK--------
               	Route::post('sms-api-store/{id?}', 'ApiSetingController@smsApiStore')->name('admin.api.smsApiStore'); 	//OK--------
               	Route::get('sms-api-list', 'ApiSetingController@smsApiList')->name('admin.api.smsApilist'); 	//OK--------
               	Route::get('sms-api-delete/{id}', 'ApiSetingController@smsApiDestroy')->name('admin.api.smsApidelete');	//OK------
               	Route::get('email-api-add/{id?}', 'ApiSetingController@emailApiAdd')->name('admin.api.emailApiAdd');	//OK------
               	Route::post('email-api-store/{id?}', 'ApiSetingController@emailApiStore')->name('admin.api.emailApiStore');	//OK------- 
               	Route::get('email-api-list', 'ApiSetingController@emailApiList')->name('admin.api.emailApilist'); 	//OK----------
               	Route::get('email-api-delete/{id}', 'ApiSetingController@emailApiDestroy')->name('admin.api.emailApidelete');	//OK--- 
               	Route::get('status/{id}{condition_id}', 'ApiSetingController@setstatus')->name('admin.api.status');	//OK--------
               	Route::get('test-mwssage/{id}', 'ApiSetingController@testMessage')->name('admin.api.test.message'); 	//OK------
               	Route::post('message-send', 'ApiSetingController@MessageSend')->name('admin.api.test.message.send');	//OK-------  
       		});
//         Route::group(['prefix' => 'hr-payroll'], function() {
//         	      Route::group(['prefix' => 'department'], function() {
//         	         	 Route::get('/', 'Hr\HRMasterController@index')->name('admin.hr.master.department');  
//         	         	 Route::get('add-form/{id?}', 'Hr\HRMasterController@addForm')->name('admin.hr.master.department.add');  
//         	         	 Route::post('store/{id?}', 'Hr\HRMasterController@store')->name('admin.hr.master.department.store');  
//         	         	 Route::get('delete/{id?}', 'Hr\HRMasterController@delete')->name('admin.hr.master.department.delete');
//         			 });
//         	      Route::group(['prefix' => 'group'], function() {
//         	         	 Route::get('group', 'Hr\HRMasterController@group')->name('admin.hr.master.group');  
//         	         	 Route::get('group-add/{id?}', 'Hr\HRMasterController@groupAddForm')->name('admin.hr.master.group.add');  
//         	         	 Route::post('group-store/{id?}', 'Hr\HRMasterController@groupStore')->name('admin.hr.master.group.store');  
//         	         	 Route::get('group-delete/{id?}', 'Hr\HRMasterController@groupDelete')->name('admin.hr.master.group.delete');
//         	 		});
//         	      Route::group(['prefix' => 'bank'], function() {
//         	         	 Route::get('bank', 'Hr\HRMasterController@bank')->name('admin.hr.master.bank');  
//         	         	 Route::get('bank-add/{id?}', 'Hr\HRMasterController@bankAddForm')->name('admin.hr.master.bank.add');  
//         	         	 Route::post('bank-store/{id?}', 'Hr\HRMasterController@bankStore')->name('admin.hr.master.bank.store');  
//         	         	 Route::get('bank-delete/{id?}', 'Hr\HRMasterController@bankDelete')->name('admin.hr.master.bank.delete');
//         	 		});
//         	      Route::group(['prefix' => 'deduction'], function() {
//         	         	 Route::get('deduction', 'Hr\HRMasterController@deduction')->name('admin.hr.master.deduction');  
//         	         	 Route::get('deduction-add/{id?}', 'Hr\HRMasterController@deductionAddForm')->name('admin.hr.master.deduction.add');  
//         	         	 Route::post('deduction-store/{id?}', 'Hr\HRMasterController@deductionStore')->name('admin.hr.master.deduction.store');  
//         	         	 Route::get('deduction-delete/{id?}', 'Hr\HRMasterController@deductionDelete')->name('admin.hr.master.deduction.delete');
//         	 		});
//         	      Route::group(['prefix' => 'allowance'], function() {
//         	         	 Route::get('allowance', 'Hr\HRMasterController@allowance')->name('admin.hr.master.allowance');  
//         	         	 Route::get('allowance-add/{id?}', 'Hr\HRMasterController@allowanceAddForm')->name('admin.hr.master.allowance.add');  
//         	         	 Route::post('allowance-store/{id?}', 'Hr\HRMasterController@allowanceStore')->name('admin.hr.master.allowance.store');  
//         	         	 Route::get('allowance-delete/{id?}', 'Hr\HRMasterController@allowanceDelete')->name('admin.hr.master.allowance.delete');
//         	 		});
//         	      Route::group(['prefix' => 'it-slab'], function() {
//         	         	 Route::get('it-slab', 'Hr\HRMasterController@itSlab')->name('admin.hr.master.it.slab');  
//         	         	 Route::get('it-slab-add/{id?}', 'Hr\HRMasterController@itSlabAddForm')->name('admin.hr.master.it.slab.add');  
//         	         	 Route::post('it-slab-store/{id?}', 'Hr\HRMasterController@itSlabStore')->name('admin.hr.master.it.slab.store');  
//         	         	 Route::get('it-slab-delete/{id?}', 'Hr\HRMasterController@itSlabDelete')->name('admin.hr.master.it.slab.delete');
//         	 		});
//         	      Route::group(['prefix' => 'designation'], function() {
//         	         	 Route::get('designation', 'Hr\HRMasterController@designation')->name('admin.hr.master.designation');  
//         	         	 Route::get('designation-add/{id?}', 'Hr\HRMasterController@designationAddForm')->name('admin.hr.master.designation.add');  
//         	         	 Route::post('designation-store/{id?}', 'Hr\HRMasterController@designationStore')->name('admin.hr.master.designation.store');  
//         	         	 Route::get('designation-delete/{id?}', 'Hr\HRMasterController@designationDelete')->name('admin.hr.master.designation.delete');
//         	 		});
//         	      Route::group(['prefix' => 'pay-head'], function() {
//         	         	 Route::get('payhead', 'Hr\HRMasterController@payhead')->name('admin.hr.master.payhead');  
//         	         	 Route::get('payhead-add/{id?}', 'Hr\HRMasterController@payheadAddForm')->name('admin.hr.master.payhead.add');  
//         	         	 Route::post('payhead-store/{id?}', 'Hr\HRMasterController@payheadStore')->name('admin.hr.master.payhead.store');  
//         	         	 Route::get('payhead-delete/{id?}', 'Hr\HRMasterController@payheadDelete')->name('admin.hr.master.payhead.delete');
//         	 		});
//         	      Route::group(['prefix' => 'experience'], function() {
//         	         	 Route::get('experience', 'Hr\HRMasterController@experience')->name('admin.hr.master.experience');  
//         	         	 Route::get('experience-add/{id?}', 'Hr\HRMasterController@experienceAddForm')->name('admin.hr.master.experience.add');  
//         	         	 Route::post('experience-store/{id?}', 'Hr\HRMasterController@experienceStore')->name('admin.hr.master.experience.store');  
//         	         	 Route::get('experience-delete/{id?}', 'Hr\HRMasterController@experienceDelete')->name('admin.hr.master.experience.delete');
//         	 		});
//         	      Route::group(['prefix' => 'employee'], function() {
//         	         	 Route::get('/', 'Hr\HRController@index')->name('admin.hr.employee');  
//         	         	 Route::get('add-form/{id?}', 'Hr\HRController@addForm')->name('admin.hr.employee.addform');  
//         	         	 Route::post('store/{id?}', 'Hr\HRController@store')->name('admin.hr.employee.store');  
//         	         	 Route::get('table-show', 'Hr\HRController@tableShow')->name('admin.hr.employee.table.show');  
//         	         	 Route::get('delete/{id}', 'Hr\HRController@destroy')->name('admin.hr.employee.delete');  
        	         	 
//         	 		});
//         	      Route::group(['prefix' => 'employee-bank-details'], function() {
//         	         	 Route::get('employee-bank-details', 'Hr\HRController@employeeBankDetails')->name('admin.hr.employee.bank.details');  
//         	         	 Route::get('bank-details-add/{id?}', 'Hr\HRController@bankDetailsAddForm')->name('admin.hr.employee.bank.details.add');  
//         	         	 Route::get('desi-wise-emp', 'Hr\HRController@designationWiseEmployee')->name('admin.hr.designation.wise.employee');  
//         	         	 Route::post('bank-details-store/{id?}', 'Hr\HRController@bankDetailsStore')->name('admin.hr.bank.details.store');  
//         	         	 Route::post('employee-bank-details-show', 'Hr\HRController@employeeBankDetailsShow')->name('admin.hr.employee.bank.details.show');  
        	         	
        	         	 
//         	 		});
//         	      Route::group(['prefix' => 'salary-settings'], function() {
//         	         	 Route::get('salary-settings', 'Hr\HRController@salarySettings')->name('admin.hr.master.salary.settings');  
//         	         	 Route::get('salary-settings-add/{id?}', 'Hr\HRController@salarySettingsAddForm')->name('admin.hr.master.salary.settings.add');  
//         	         	 Route::post('salary-settings-store/{id?}', 'Hr\HRController@salarySettingsStore')->name('admin.hr.master.salary.settings.store');  
//         	         	 Route::get('salary-settings-delete/{id?}', 'Hr\HRController@salarySettingsDelete')->name('admin.hr.master.salary.settings.delete');
//         			 });
//         	      Route::group(['prefix' => 'employee-salary'], function() {
//         	         	 Route::get('employee-salary', 'Hr\HRController@employeeSalary')->name('admin.hr.master.employee.salary');  
//         	         	 Route::get('employee-salary-add/{id?}', 'Hr\HRController@employeeSalaryAddForm')->name('admin.hr.master.employee.salary.add');  
//         	         	 Route::post('employee-salary-store/{id?}', 'Hr\HRController@employeeSalaryStore')->name('admin.hr.master.employee.salary.store');  
//         	         	 Route::get('employee-salary-delete/{id?}', 'Hr\HRController@employeeSalaryDelete')->name('admin.hr.master.employee.salary.delete');
//         	 		});
//         	      Route::group(['prefix' => 'employee-basic-salary'], function() {
//         	         	 Route::get('employee-basic-salary', 'Hr\HRController@employeeBasicSalary')->name('admin.hr.master.employee.basic.salary');
//         	         	 Route::post('employee-basic-salary-store', 'Hr\HRController@employeeBasicSalaryStore')->name('admin.hr.master.employee.basic.salary.store');  
//         	         	 Route::get('employee-basic-salary-list', 'Hr\HRController@employeeBasicSalaryList')->name('admin.hr.master.employee.basic.salary.list');  
        	         	 
//         	 		});
//         	      Route::group(['prefix' => 'employee-salary-structure'], function() {
//         	         	 Route::get('employee-salary-structure', 'Hr\HRController@employeeSalaryStructure')->name('admin.hr.master.employee.salary.structure');
//         	         	 Route::post('employee-salary-structure-store', 'Hr\HRController@employeeSalaryStructureStore')->name('admin.hr.master.employee.salary.structure.store');  
//         	         	 Route::get('employee-salary-structure-list', 'Hr\HRController@employeeSalaryStructureList')->name('admin.hr.master.employee.salary.structure.list');
//         	 		});
//         });  
//         Route::group(['prefix' => 'video-and-pdf'], function() {
//          Route::get('/', 'VideoAndPdfController@index')->name('admin.video.and.pdf');
//          Route::get('pfd', 'VideoAndPdfController@pdf')->name('admin.video.and.pdf.onclick');
//          Route::post('upload', 'VideoAndPdfController@upload')->name('admin.video.and.pdf.upload');
//          Route::get('play/{path}', 'VideoAndPdfController@play')->name('admin.video.and.pdf.play');
//          Route::get('delete/{id}', 'VideoAndPdfController@destroy')->name('admin.video.and.pdf.destroy');
         	 
//  		});
 		 Route::group(['prefix' => 'notification'], function() {       
         	Route::get('next-page','Notification\NotificationController@nextPage')->name('notification.next.page');	//OK-----------
         	Route::get('show-notification','Notification\NotificationController@showNotification')->name('notification.show.notification'); 	//OK----------------
         	Route::get('mark-all','Notification\NotificationController@markAll')->name('notification.mark.all'); //OK------


//          	Route::get('clear-all','Notification\NotificationController@clearAll')->name('notification.clear.all');

//          	Route::get('clear/{id}','Notification\NotificationController@noficationClear')->name('notification.clear'); 	//OK--------------
//          	Route::get('read/{id}','Notification\NotificationController@readStatus')->name('notification.read.status'); 	//OK-------------------- 
 		});  

// });
//  Route::group(['prefix' => 'class-test-api'], function() {
// 		Route::get('/', 'Exam\ClassTestController@indexApi');
//  });    