<form action="{{ route('admin.student.view-update',$student[0]->id) }}" method="post" accept-charset="utf-8" class="add_form" no-reset="true" call-back="redirectStudent"> 
{{ csrf_field() }}
<div class="row">
    <div class="col-lg-9"> 
        <div  class="col-lg-6 form-group">
          <label>Academic Year</label>
            <span class="fa fa-asterisk"></span>
            <select name="academic_year_id" class="form-control" id="academic_year_select_box" onchange="callAjax(this,'{{ route('selbox.class.admission.yearwise',$student[0]->id) }}','select_class_box')">
                 <option selected disabled>Select Academic Year</option>
                 @foreach ($academicYears as $academicYear)
                   <option value="{{ $academicYear->academic_year_Id }}"{{ $adm_app_rs[0]->for_academic_year ==$academicYear->academic_year_Id?'selected':''}}>{{ $academicYear->name }}</option> 
                 @endforeach 
            </select>
        </div>
        <div  class="col-lg-6 form-group">
          <label>Class</label>
          <span class="fa fa-asterisk"></span>
          <select name="class" class="form-control" id="select_class_box" required>
            <option selected disabled>Select Class</option>
          </select> 
        </div>
        <div  class="col-lg-6 form-group">
          <label>Name</label> <span class="fa fa-asterisk"></span>
          <input type="text" value="{{ $student[0]->name }}" maxlength="50" name="student_name"  class="form-control">
        </div>
        <div  class="col-lg-6 form-group">
          <label>Nick Name</label>
          <input type="text" name="nick_name" value="{{$student[0]->nick_name}}"  class="form-control" > 
        </div>
        @php
        $date = date('Y-m-d');
        @endphp 
        <div  class="col-lg-6 form-group">
          <label>Date of Birth</label> <span class="fa fa-asterisk"></span>
          <input type="date" maxlength="10" value="{{ $student[0]->dob }}" name="date_of_birth" class="form-control" max="{{ date('Y-m-d',strtotime($date .'-730 days')) }}" min="{{ date('Y-m-d',strtotime($date .'-7300 days')) }}" >
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
        <div class="col-lg-12 form-group text-center">
          <input type="submit" class="btn btn-success" value="Save As Draft">
        </div> 
    </div>
    <div class="col-md-3" style="margin-top: 20px">
        @php
        $profile = route('admin.student.image',$student[0]->id);
        @endphp
        <div class="col-md-12 center-block">
            <div id="showImg">
                <div id="results">
                <img  src="{{ ($student[0]->profile_pic)? $profile : asset('profile-img/user.png') }}" style="width: 190px; height: 190px;  border: 5px solid #d1f7ec">
                </div> 
            </div>  
            <div id="camera_div"> 
            <div id="my_camera"></div>
            <br/>
            <input type=button value="Take Snapshot" onClick="take_snapshot()">
            <input type="hidden" name="image" class="image-tag">
            <button type="submit" class="btn-xs btn-primary" style="width:100px;height:30px">Save Image</button> 
            </div>  
        </div> 
    </div>
 </div>
</form>