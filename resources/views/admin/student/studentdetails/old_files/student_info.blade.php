@php
  $hidden='';
@endphp
<div class="row"> 
                  <div class="col-lg-9">
                    <form action="{{ route('admin.student.view-update',$student[0]->id) }}" method="post" accept-charset="utf-8" class="add_form" no-reset="true"> 
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
                      <div  class="col-lg-6 form-group {{ $hidden }}">
                        <label>Section</label> <span class="fa fa-asterisk"></span>
                        <select class="form-control" name="section" id="section_div" >
                          @foreach ($sections as $section)
                            <option  value="{{ $section->id }}"{{ $student[0]->section_id==$section->id? 'selected' : '' }}>{{ $section->name }}</option> 
                          @endforeach 
                        </select> 
                      </div>
                      <input type="hidden" name="reg_length" value="{{ $schoolinfo[0]->reg_length }}">                     
                      <div  class="col-lg-6 form-group {{ $hidden }}">
                        <label>Registration No.</label> <span class="fa fa-asterisk"></span>
                        <input type="text" value="{{ $student[0]->registration_no or ''}}" name="registration_no" id="registration_no" maxlength="{{ $schoolinfo[0]->reg_length }}" class="form-control" min="{{ $schoolinfo[0]->reg_length }}"> 
                      </div>
                      <div  class="col-lg-6 form-group {{ $hidden }}">
                        <label>Admission No.</label> <span class="fa fa-asterisk"></span>
                        <input type="text"  value="{{ $student[0]->admission_no }}" name="admission_no" class="form-control">
                      </div>
                      <div  class="col-lg-6 form-group {{ $hidden }}">
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
                      <div class="col-lg-6 form-group {{ $hidden }}">
                        <label>Date of Admission</label> <span class="fa fa-asterisk"></span>
                        <input type="date"  value="{{ $student[0]->date_of_admission }}" name="date_of_admission" class="form-control">
                      </div>
                      <div class="col-lg-6 form-group {{ $hidden }}">
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
                      <div  class="col-lg-12 form-group {{ $hidden }}">
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
                  {{-- <div class="col-md-3" style="margin-top: 20px">
                    @php
                      $profile = route('admin.student.image',$student->picture);
                    @endphp
                    <div class="col-md-12 center-block">
                      <div id="showImg">
                        <div style="width: 210px; height: 260px;  background-color: #eee; border: 2px solid #d1f7ec">
                          <img  src="{{ ($student->picture)? $profile : asset('profile-img/user.png') }}" style="width: 210px; height: 260px;  border: 2px solid #d1f7ec">
                        </div>
                        <div style="padding-left:20px; padding-top: 5px; padding-bottom: 15px">
                          <a class="btn_change_image btn btn-success btn-xs" href="javascript:;"><i class="fa fa-image"></i>Upload Image </a>
                          <a class="btn_web btn btn-default btn-xs" onclick="callPopupMd(this,'{{ route('admin.student.camera',$student->id) }}')" href="javascript:;"><i class="fa fa-camera" style="margin: 10px"></i></a>                              
                        </div>
                      </div>                                  
                    </div>
                    <div id="crop-show" > 
                      <div id="upload-demo"></div> 
                      <div>
                        <strong>Select Image:</strong><br/>
                        <input type="file" id="upload" accept="image/x-png,image/jpeg"><br/>
                        <button class="btn btn-success upload-result">Upload Image</button>
                        <button class="btn btn-danger" id="crop-hide">Hide</button>
                      </div>    
                    </div>
                    <div id="camera_div">
                      @include('admin.student.studentdetails.include.webcam')
                    </div> 
                  </div> --}}                        
                </div>