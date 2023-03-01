@extends('admin.layout.base')
@push('links')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('body')
<style>

</style>
<section class="content-header">
    <h1> Admission Application Form</h1>

</section>      
<section class="content"> 
    <div class="box"> 
        <div class="box-body"> 
            <form action="{{ route('admin.student.adm.appform.step1store') }}" call-back="redirectStudent" method="post" class="add_form">
                {{ csrf_field() }}
                <div class="row"> 
                <div class="col-lg-4">                         
                    <div class="form-group">
                        <label>Academic Year</label>
                        <span class="fa fa-asterisk"></span>
                         <select name="academic_year_id" class="form-control" onchange="callAjax(this,'{{ route('selbox.class.admission.yearwise') }}','select_class_box')">
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
                        {{ Form::label('class','Class',['class'=>' control-label']) }}
                        <span class="fa fa-asterisk"></span>
                        <select name="class" class="form-control" id="select_class_box" required>
                            <option selected disabled>Select Class</option>
                        </select>
                    </div>
                </div> 
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
                        <label>Date of Birth</label>
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

                <div class="col-md-12 text-center">
                    <button class="btn btn-success" type="submit">Submit & Next</button>
                </div>
            </div>  
            
        </form>


    
</section>
<!-- /.content -->
@endsection
@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript"> 
    $( ".datepicker" ).datepicker({dateFormat:'dd-mm-yy'});
    $('#date_of_birth').datepicker({
        dateFormat: "dd-mm-yy",
        maxDate: new Date('{{ date('Y')-2 }}')
    });
    
    function redirectStudent() {
        $(document).ajaxSuccess(function(event, xhr, settings) {   
            var json = xhr.responseText;
            var obj = JSON.parse(json); 
            window.location.replace(" {{ url('admin/student/editadmapp') }}/"+obj.student_id); 
        });
    }

</script>

@endpush