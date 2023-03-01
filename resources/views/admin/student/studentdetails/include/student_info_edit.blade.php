<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Edit Student Detail</h4>
    </div>

    <div class="modal-body">
      <div class="row"> 
        <div class="col-md-12"> 
          <form action="{{ route('admin.student.view-update',$student_id) }}" method="post" accept-charset="utf-8" class="add_form" no-reset="true" button-click="btn_close,student_info_tab"> 
            {{ csrf_field() }}
            <div  class="col-lg-6 form-group">
              <label>Name</label> <span class="fa fa-asterisk"></span>
              <input type="text" value="{{ $student[0]->name }}" maxlength="50" name="student_name"  class="form-control">
            </div>
            <div  class="col-lg-6 form-group">
              <label>Nick Name</label>
              <input type="text" name="nick_name" value="{{$student[0]->nick_name}}"  class="form-control" > 
            </div>
            <div  class="col-lg-6 form-group">
              <label>Class</label> <span class="fa fa-asterisk"></span>
              <select class="form-control" name="class" onchange="callAjax(this,'{{ route('admin.class.wise.section') }}','section_div')">
                @foreach ($classes as $value)
                  <option value="{{ $value->id }}"{{ $student[0]->class_id==$value->id? 'selected' : ''}}>{{ $value->name }}</option> 
                @endforeach 
              </select>
            </div>
            <div  class="col-lg-6 form-group">
              <label>Section</label> <span class="fa fa-asterisk"></span>
              <select class="form-control" name="section" id="section_div" >
                @foreach ($sections as $section)
                  <option  value="{{ $section->id }}"{{ $student[0]->section_id==$section->id? 'selected' : '' }}>{{ $section->name }}</option> 
                @endforeach 
              </select> 
            </div>
            <input type="hidden" name="reg_length" value="{{ $reg_no_size }}">                     
            <div  class="col-lg-6 form-group">
              <label>Registration No.</label> <span class="fa fa-asterisk"></span>
              <input type="text" value="{{ $student[0]->registration_no or ''}}" name="registration_no" id="registration_no" maxlength="{{ $reg_no_size }}" class="form-control" min="{{ $reg_no_size }}"> 
            </div>
            <div  class="col-lg-6 form-group">
              <label>Admission No.</label> <span class="fa fa-asterisk"></span>
              <input type="text"  value="{{ $student[0]->admission_no }}" name="admission_no" class="form-control">
            </div>
            <div  class="col-lg-6 form-group">
              <label>Roll No.</label> <span class="fa fa-asterisk"></span>
              <input type="text"maxlength="4" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  value="{{ $student[0]->roll_no or ''}}" name="roll_no" class="form-control">
            </div>
            @php
              $date = date('Y-m-d');
            @endphp 
            <div  class="col-lg-6 form-group">
              <label>Date of Birth</label> <span class="fa fa-asterisk"></span>
              <input type="date" maxlength="10" value="{{ $student[0]->dob }}" name="date_of_birth" class="form-control" max="{{ date('Y-m-d',strtotime($date .'-730 days')) }}" min="{{ date('Y-m-d',strtotime($date .'-7300 days')) }}" >
            </div>
            <div class="col-lg-6 form-group">
              <label>Date of Admission</label> <span class="fa fa-asterisk"></span>
              <input type="date"  value="{{ $student[0]->date_of_admission }}" name="date_of_admission" class="form-control">
            </div>
            <div class="col-lg-6 form-group">
              <label>Date of Activation</label> <span class="fa fa-asterisk"></span>
              <input type="date"  value="{{$student[0]->date_of_activation}}" name="date_of_activation" class="form-control"> 
            </div>
            <div class="col-lg-6 form-group">
              <label>Aadhaar No.</label> <span class="fa fa-asterisk"></span>
              <input type="text" maxlength="12"  value="{{ $student[0]->adhar_no}}" name="aadhaar_no" class="form-control"> 
            </div>
            <div class="col-lg-6 form-group">
              <label>Gender</label> <span class="fa fa-asterisk"></span>
              <select name="gender" class="form-control" >
                @foreach ($genders as $gender)
                  <option value="{{ $gender->id }}"{{ $gender->id==$student[0]->gender_id?'selected' : '' }}>{{ $gender->genders }}</option> 
                @endforeach 
              </select> 
            </div>
            <div  class="col-lg-12 form-group">
              <label>House Name</label> <span class="fa fa-asterisk"></span>
              <select name="house" class="form-control" >
                @foreach ($houses as $house)
                  <option  value="{{ $house->id }}"{{ $student[0]->house_no==$house->id? 'selected' : '' }}>{{ $house->name }}</option> 
                @endforeach
              </select> 
            </div>
            <div class="col-lg-12 form-group text-center">
              <input type="submit" class="btn btn-success" name="">
            </div>
            
          </form>

        </div>   
      </div>
    </div>
  </div>
</div>