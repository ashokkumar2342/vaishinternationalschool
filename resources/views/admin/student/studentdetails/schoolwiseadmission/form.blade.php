@extends('admin.layout.base')
@push('links')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('body')
<style>

</style>
<section class="content-header">
    <h1>Admission Application Form (Help Desk) </h1>

</section>      
<section class="content"> 
    <div class="box"> 
        <div class="box-body">

            <form action="{{ route('admin.helpdesk.school.admission.step1store') }}" call-back="redirectStudent" method="post" class="add_form">
                {{ csrf_field() }}
                <div class="row"> 
                <div class="col-lg-4">                         
                    <div class="form-group">
                        <label>Academic Year</label>
                        <span class="fa fa-asterisk"></span>
                         <select name="academic_year_id" id="academic_year_select_box" select-triger="select_class_box" class="form-control" onchange="callAjax(this,'{{ route('selbox.class.admission.yearwise') }}','select_class_box')">
                             <option selected disabled>Select Academic Year</option>
                             @foreach ($academicYears as $academicYear)
                               <option value="{{ $academicYear->academic_year_Id }}">{{ $academicYear->name }}</option> 
                             @endforeach
                         </select>
                    </div>
                </div>
                </div>                                            
                <div class="row">  
                    <div class="col-lg-4">                         
                        <div class="form-group">
                            {{ Form::label('sibling_registration','Sibling Ragistration',['class'=>' control-label']) }}
                            <span class="fa fa-asterisk"></span>
                            <select name="sibling_registration"  class="form-control" id="sibling_registration" onchange="if(this.value=='1'){
                                showHideDiv(1,'registration_div_yes');
                                showHideDiv(0,'registration_div_no');
                                showHideDiv(0,'application_div_yes');
                            }if(this.value=='0'){
                                showHideDiv(0,'registration_div_yes');
                                showHideDiv(0,'application_div_yes');
                                showHideDiv(1,'registration_div_no');
                                $('#sibling_registration_no').val('');

                            }if(this.value=='2'){
                                showHideDiv(0,'registration_div_yes');
                                showHideDiv(0,'registration_div_no');
                                showHideDiv(1,'application_div_yes');
                                $('#sibling_registration_no').val('');

                            }">
                            <option selected disabled>Select Sibling Information</option>
                            <option value="0">No Sibling</option>
                            <option value="1">Select Sibling From Registration No.</option>
                            <option value="2">Select Sibling From Application No.</option>

                        </select>
                    </div>
                </div>
                <div id="registration_div_yes" style="display: none;">
                    <div class="col-lg-4">                         
                        <div class="form-group">
                            {{ Form::label('sibling_register','Sibling Registration No.',['class'=>' control-label']) }}
                            <span class="fa fa-asterisk"></span>
                            <input type="text" maxlength="20" onblur="callAjax(this,'{{ route('admin.student.search.by.regsapp.details.show',1) }}','sibling_details')" name="sibling_registration_no" id="sibling_registration_no" class="form-control" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)'>
                        </div>
                    </div>  
                    <div class="col-lg-4">                         
                        <div class="form-group" id="sibling_details">

                        </div>
                    </div>  
                </div>
                <div id="application_div_yes" style="display: none;">
                    <div class="col-lg-4">                         
                        <div class="form-group">
                            {{ Form::label('sibling_register','Sibling Application No.',['class'=>' control-label']) }}
                            <span class="fa fa-asterisk"></span>
                            <input type="text" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="callAjax(this,'{{ route('admin.student.search.by.regsapp.details.show',2) }}','sibling_detail')" name="sibling_application_no" id="sibling_application_no" class="form-control">
                        </div>
                    </div>  
                    <div class="col-lg-4">                         
                        <div class="form-group" id="sibling_detail">

                        </div>
                    </div>  
                </div>
                <div id="registration_div_no" style="display: none;">
                    <div class="col-lg-4">                         
                        <div class="form-group">
                            {{ Form::label('sibling_mobile_no','Mobile No',['class'=>' control-label']) }}
                            <span class="fa fa-asterisk"></span>
                            <input type="text" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  name="mobileno" id="mobileno" class="form-control" minlength = "10">
                        </div>
                    </div>  
                    <div class="col-lg-4">                         
                        <div class="form-group" id="sibling_details">
                            <div class="form-group">
                                {{ Form::label('emailid','Email Id',['class'=>' control-label']) }}
                                <span class="fa fa-asterisk"></span>
                                <input type="email"  name="emailid" id="email" class="form-control">
                            </div>
                        </div>
                    </div>  
                </div>
             </div> 
            <div class="row">                         
                <div class="col-lg-4">                         
                    <div class="form-group">
                        {{ Form::label('class','Class',['class'=>' control-label']) }}
                        <span class="fa fa-asterisk"></span>
                        <select name="class" class="form-control" id="select_class_box" multiselect-form="true" onchange="callAjax(this,'{{route('selbox.subject.year.class.wise')}}'+'?academic_year_id='+$('#academic_year_select_box').val()+'&class_id='+$('#select_class_box').val(),'subject_class_box');callAjax(this,'{{route('admin.helpdesk.school.admission.test.div')}}'+'?academic_year_id='+$('#academic_year_select_box').val()+'&class_id='+$('#select_class_box').val(),'test_div_box')">
                            <option selected disabled>Select Class</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4" id="subject_class_box">                         
                    <div class="form-group">
                        <label>Subject</label>
                        <span class="fa fa-asterisk"></span><br>
                        <select class="multiselect form-control" multiple="multiple"  name="subject_id[]">
                            <option selected disabled>Select Subject</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">                         
                    <div class="form-group">
                        <label>Medium</label>
                        <span class="fa fa-asterisk"></span>
                        <select name="course_medium" class="form-control">
                            <option selected disabled>Select Course Medium</option>
                            @foreach ($course_medium as $rs_value)
                               <option value="{{ $rs_value->id }}">{{ $rs_value->medium_name }}</option> 
                             @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Student Details</div>
                        <div class="panel-body">
                            <div class="col-lg-4">                         
                                <div class="form-group">
                                    <label>Student Name</label>
                                    <span class="fa fa-asterisk"></span>
                                    <input type="text" name="student_name" class="form-control"  maxlength="50" placeholder="Enter Applicant Name" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)' required minlength = "2">
                                </div>
                            </div>  
                            <div class="col-lg-4">                         
                                <div class="form-group">
                                    <label>Nick Name (if any)</label>
                                    <input type="text" name="nick_name" class="form-control"  maxlength="20" placeholder="Enter Applicant Nick Name" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)'>
                                </div>
                            </div>
                            <div class="col-lg-4">                         
                                <div class="form-group">
                                    <label>Father Name</label>
                                    <span class="fa fa-asterisk"></span>
                                    <input type="text" name="father_name" class="form-control"  maxlength="50" placeholder="Enter Father Name" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)'>
                                </div>
                            </div> 
                            <div class="col-lg-4">                         
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <span class="fa fa-asterisk"></span>
                                    <input type="date" name="dob" class="form-control" max="{{date('Y-m-d',strtotime(date('Y-m-d') ."-730 days"))}}" min="{{date('Y-m-d',strtotime(date('Y-m-d') ."-7300 days"))}}" required="">
                                </div>
                            </div> 
                            <div class="col-lg-4"> 
                                <div class="form-group">
                                    <label>Gender</label>
                                    <span class="fa fa-asterisk"></span>
                                     <select name="gender" class="form-control" required>
                                         <option selected disabled>Select Gender</option>
                                         @foreach ($genders as $gender)
                                           <option value="{{ $gender->id }}">{{ $gender->genders }}</option> 
                                         @endforeach
                                          
                                     </select>
                                </div>                        
                                
                            </div>
                            <div class="col-lg-4">                         
                                <div class="form-group">
                                    <label>Aadhaar No.</label>
                                    <span class="fa fa-asterisk"></span>
                                    <input type="text" name="aadhaar_no" class="form-control"  maxlength="12" placeholder="Enter Adhaar No." onkeypress='return event.charCode >= 48 && event.charCode <= 57' required minlength = "12">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Test Details</div>
                        <div class="panel-body" id="test_div_box"> 
                            <div class="col-lg-6 form-group">
                              <label>Test Date</label>
                              <span class="fa fa-asterisk"></span>
                              <input type="date" name="test_date" class="form-control"> 
                            </div>
                            <div class="col-lg-6 form-group">
                              <label>Test Time</label>
                              <span class="fa fa-asterisk"></span>
                              <input type="text" name="test_time" class="form-control" maxlength="10"> 
                            </div>
                            <div class="col-lg-6 form-group">
                              <label>Result Date</label>
                              <span class="fa fa-asterisk"></span>
                              <input type="date" name="result_date" class="form-control"> 
                            </div>
                            <div class="col-lg-6 form-group">
                              <label>Result Time</label>
                              <span class="fa fa-asterisk"></span>
                              <input type="text" name="result_time" class="form-control" maxlength="10"> 
                            </div>
                            <div class="col-lg-6 form-group">
                              <label>Test Duration</label>
                              <span class="fa fa-asterisk"></span>
                              <input type="text" name="test_duration" class="form-control" maxlength="100"> 
                            </div>
                            <div class="col-lg-6 form-group">
                              <label>Prospectus Fee</label>
                              <span class="fa fa-asterisk"></span>
                              <input type="text" name="form_fee" class="form-control" placeholder="Enter Prospectus Fee"  maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Previous School Details</div>
                        <div class="panel-body"> 
                            <div class="col-lg-3 form-group">
                               <label>Previous School Name (if any)</label>
                                <input type="text" name="last_school_name" maxlength="100" class="form-control" placeholder="Enter Last School Name" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 46)'> 
                            </div>
                            <div class="col-lg-3 form-group">
                                <label>Max Marks</label>
                                <input type="text" name="max_marks" maxlength="6" class="form-control" placeholder="Enter Max Marks" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                            </div>
                            <div class="col-lg-3 form-group">
                               <label>Marks OBT</label>
                                <input type="text" name="marks_obt" maxlength="6" class="form-control" placeholder="Enter Marks OBT" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                            </div>
                            <div class="col-lg-3 form-group">
                                <label>Marks Percent</label>
                                <input type="text" name="marks_percent" maxlength="6" class="form-control" placeholder="Enter Marks Percent" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46'> 
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Upload Image</div>
                        <div class="panel-body">
                            <div class="col-lg-3">
                                <label>Image (Only Jpeg)</label>
                                <input type="file" name="image" class="form-control" accept="image/jpeg" /> 
                            </div>
                            <div class="col-lg-1" style="margin-top:25px">
                                <a class="btn_web btn btn-default btn-xs" my_camera="my_camera" onclick="callAjax(this,'{{ route('admin.helpdesk.school.admission.image') }}','image_div')"><i class="fa fa-camera" style="margin: 10px"></i></a>
                            </div>
                            <div class="col-lg-8" id="image_div">
                                
                            </div>
                        </div> 
                    </div>
                </div> 
                <div class="col-md-12 text-center">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </div> 
        </form>
    </div>
</div>
</section>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script language="JavaScript">
        Webcam.set({
            width: 150,
            height: 150,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
      takeSnapShot = function () {
            Webcam.snap(function (data_uri) {
                document.getElementById('snapShot').innerHTML = 
                    '<img src="' + data_uri + '" width="70px" height="50px" />';
            });
        }
         function take_snapshot() { 
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'" width="150px" height="130px" />';
                

            } );
        } 
</script>
<script type="text/javascript"> 

    function redirectStudent() {
        $(document).ajaxSuccess(function(event, xhr, settings) {   
            var json = xhr.responseText;
            var obj = JSON.parse(json); 
            window.location.replace(" {{ url('admin/student/school-helpdesk-admission-view') }}/"+obj.student_id+"/"+obj.source); 
        });
    }

</script>

@endpush