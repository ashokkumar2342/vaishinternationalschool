@extends('admin.layout.base')
@push('links')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('body')
<style>

</style>
@php
$classid = 0;
$gender_id =0;
$house_id = 0;
$date_of_admission = date('d-m-Y');
$date_of_activation = Date('dd-mm-yy');
$reg_length = 20;
if (!empty($default)){
    $classid = $default[0]->class_id;
    $gender_id = $default[0]->gender_id;
    $house_id = $default[0]->house_id;
    $date_of_admission = $default[0]->admission_date;
    $date_of_activation = $default[0]->activation_date;
}
$reg_length = $reg_no_size;
@endphp
<section class="content-header">
    <h1>Add New Student</h1> 
</section>      
<section class="content">  
    <div class="box">   
        <div class="box-body">
            <div class="row"> 
                <div class="col-lg-12 "> 
                    <form action="{{ route('admin.student.addnew.step1store') }}" call-back="redirectStudent" method="post" class="add_form">
                        {{ csrf_field() }}                                            
                        <div class="row">{{--row start --}}
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <div class="col-lg-3">                         
                                        <div class="form-group">
                                            {{ Form::label('sibling_registration','Sibling Information',['class'=>' control-label']) }}
                                            <span class="fa fa-asterisk"></span>
                                            <select name="sibling_registration"  class="form-control" id="sibling_registration" onchange="if(this.value==='1'){
                                                showHideDiv(1,'registration_div_yes');
                                                showHideDiv(0,'registration_div_no');
                                            }else{
                                                showHideDiv(0,'registration_div_yes');
                                                showHideDiv(1,'registration_div_no');
                                                $('#sibling_registration_no').val(''); 
                                            }">
                                            <option selected disabled>Select Sibling Information</option>
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option> 
                                        </select>
                                    </div>
                                </div>
                                <div id="registration_div_yes" style="display: none;">
                                    <div class="col-lg-3">                         
                                        <div class="form-group">
                                            {{ Form::label('sibling_register','Sibling Registration No.',['class'=>' control-label']) }}
                                            <span class="fa fa-asterisk"></span>
                                            <input type="text" onblur="callAjax(this,'{{ route('admin.student.search.by.regsapp.details.show',1) }}','sibling_details')" name="sibling_registration_no" id="sibling_registration_no" class="form-control" maxlength="{{$reg_length}}" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)'>
                                        </div>
                                    </div>  
                                    <div class="col-lg-6">                         
                                        <div class="form-group" id="sibling_details"> 
                                        </div>
                                    </div>  
                                </div>
                                <div id="registration_div_no" style="display: none;">
                                    <div class="col-lg-3">                         
                                        <div class="form-group">
                                            {{ Form::label('sibling_mobile_no','Mobile No',['class'=>' control-label']) }}
                                            <span class="fa fa-asterisk"></span>
                                            <input type="text" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  name="mobileno" id="mobileno" class="form-control" minlength = "10">
                                        </div>
                                    </div>  
                                    <div class="col-lg-6">                         
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
                        </div>                      
                        <div class="form-group">
                            <div class="col-md-12">  
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Class</label>
                                        <select name="class" class="form-control" id="select_class_box" onchange="callAjax(this,'{{ route('admin.selbox.getsection.byclass') }}','select_section_box')">
                                            <option selected disabled>Select Class</option>
                                            @foreach ($classes as $classe)
                                            <option value="{{$classe->id}}" {{$classe->id==$classid?'selected':''}}>{{$classe->name}}</option>  
                                            @endforeach 
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        {{ Form::label('section','section',['class'=>' control-label']) }}
                                        <span class="fa fa-asterisk"></span>
                                        <select name="section" class="form-control" id="select_section_box">
                                            <option selected disabled>Select Section</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Registration No.</label>
                                        <span class="fa fa-asterisk"></span> 
                                        <input type="text" class="form-control" name="registration_no" maxlength="{{ $reg_length }}" min="{{ $reg_length }}" placeholder="Enter Registration No." id="registration_no" required> 
                                    </div>
                                </div>
                                <input type="hidden" name="reg_length" value="{{ $reg_no_size }}">
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Admission No.</label>
                                        <span class="fa fa-asterisk"></span> 
                                        <input type="text" class="form-control" name="admission_no" maxlength="{{ $reg_no_size }}" min="{{ $reg_no_size }}" placeholder="Enter Admission No." id="registration_no" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Roll No.</label>
                                        <input type="text" name="roll_no" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                    </div>
                                </div> 
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Admission Date</label> 
                                        <span class="fa fa-asterisk"></span>   
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" name="date_of_admission" class="form-control" value="" required>  
                                        </div> 
                                    </div>
                                </div> 
                                <div class="col-lg-6">                         
                                    <div class="form-group">
                                        <label>Activation Date</label> 
                                        <span class="fa fa-asterisk"></span>   
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" name="date_of_activation" class="form-control" value="" required>  
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div> {{--row end --}}
                <div class="row">{{--row start --}}
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="student_name" class="form-control"  maxlength="50" placeholder="Enter Applicant Name" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)' required minlength = "2" required>
                                    </div>
                                </div>  
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Nick Name (if any)</label>
                                        <input type="text" name="nick_name" class="form-control"  maxlength="20" placeholder="Enter Applicant Nick Name" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)'>
                                    </div>
                                </div> 
                                <div class="col-lg-6">                         
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" max="{{date('Y-m-d',strtotime(date('Y-m-d') ."-730 days"))}}" min="{{date('Y-m-d',strtotime(date('Y-m-d') ."-7300 days"))}}" required>
                                    </div>
                                </div> 
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control" required>
                                            <option selected disabled>Select Gender</option>
                                            @foreach ($genders as $gender)
                                            <option value="{{$gender->id}}" {{$gender->id==$gender_id?'selected':''}}>{{$gender->genders}}</option>  
                                            @endforeach 
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-lg-3">                         
                                    <div class="form-group">
                                        <label>Aadhaar No.</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="aadhaar_no" class="form-control"  maxlength="12" placeholder="Enter Adhaar No." onkeypress='return event.charCode >= 48 && event.charCode <= 57' required minlength = "12">
                                    </div>
                                </div>
                                <div class="col-lg-6">                         
                                    <div class="form-group">
                                        <label>School House Name</label>
                                        <span class="fa fa-asterisk"></span>
                                        <select name="house_name" class="form-control" required>
                                            <option selected disabled>Select House</option>
                                            @foreach ($houses as $house)
                                            <option value="{{ $house->id }}"{{ $house_id==$house->id? 'selected' : '' }}>{{ $house->name }}</option> 
                                            @endforeach 
                                        </select> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div> {{--row end --}}               

                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </div>  
                
            </form>
            </div>
        </div>
    </div>
</div>
<!-- /.box-body -->
</div>
<!-- /.box --> 
</section>
<!-- /.content -->
@endsection
@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $("#select_class_box").trigger('change'); 
    $("#sibling_registration").trigger('change'); 
    $("#registration_no").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);     
    });

    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\_[\]\\';,./{}|\\":<>\?]/g.test(str);
    }
    $( ".datepicker" ).datepicker({dateFormat:'dd-mm-yy'});

    
    function redirectStudent() {
        $(document).ajaxSuccess(function(event, xhr, settings) {   
            var json = xhr.responseText;
            var obj = JSON.parse(json); 
            window.location.replace(" {{ url('admin/student/view') }}/"+obj.student_id+"/"+obj.source); 
        });
    }

</script>

@endpush