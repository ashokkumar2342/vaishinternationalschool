<div class="row"> 
  <div class="col-lg-9"> 
    <div  class="col-lg-6 form-group">
      <label>Name</label> :: {{ @$student[0]->name }}
    </div>
    <div  class="col-lg-6 form-group">
      <label>Nick Name</label> :: {{@$student[0]->nick_name}}
    </div>
    <div  class="col-lg-6 form-group">
      <label>DOB</label> :: {{ @$student[0]->dob }}
    </div> 
    <div  class="col-lg-6 form-group">
      <label>Class</label> :: {{ @$student[0]->class }}
    </div>
    <div  class="col-lg-6 form-group">
      <label>Father's Name</label> :: {{@$student[0]->roll_no}}
    </div>
    <div  class="col-lg-6 form-group">
      <label>AADHAR No.</label> :: {{ @$student[0]->adhar_no }}
    </div>
  </div>  

  {{-- <div class="col-md-3" style="margin-top: 20px">
    @php
      $profile = route('admin.student.image',$student[0]->picture);
    @endphp
    <div class="col-md-12 center-block">
      <div id="showImg">
        <div style="width: 210px; height: 260px;  background-color: #eee; border: 2px solid #d1f7ec">
          <img  src="{{ ($student[0]->picture)? $profile : asset('profile-img/user.png') }}" style="width: 210px; height: 260px;  border: 2px solid #d1f7ec">
        </div>
        <div style="padding-left:0px; padding-top: 5px; padding-bottom: 15px;">
          <a class="btn_change_image btn btn-success btn-xs" crop-image="upload-demo" onclick="callPopupLarge(this,'{{ route('admin.student.image.upload',$student_id) }}')"><i class="fa fa-image"></i>&nbsp;Upload Image </a>
          <a class="btn_web btn btn-default btn-xs" my_camera="my_camera" onclick="callPopupLarge(this,'{{ route('admin.student.camera',$student_id) }}')"><i class="fa fa-camera" style="margin: 10px"></i></a>
        </div>
      </div>                                  
    </div>
    
  </div> --}}

  {{-- <div class="col-lg-10 text-center" style="margin-top: 10px">
    <button class="btn_medical_view btn btn-warning btn-sm" onclick="callPopupLarge(this,'{{ route('admin.student.info.edit',$student_id) }}')" data-id=""  ><i class="fa fa-edit"></i>&nbsp;Edit</button>
  </div> --}}  
</div>
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>



<script language="JavaScript">
        
      
      
</script>