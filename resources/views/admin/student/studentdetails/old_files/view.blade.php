@php
  $hidden='';
  // if(0 == 0){
  //   $hidden='hidden';
  // }
  
  $testshow = 1;
@endphp
@if ($testshow == 1)

@extends('admin.layout.base')
  @push('links')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  @endpush
  @section('body')
    <section class="content">
      <div class="box">
        <a href="{{ route('admin.student.registration.profile.view',Crypt::encrypt($student[0]->id)) }}" class="btn btn-xs btn-primary pull-right" title="Download Profile " target="_blank" style="margin:5px">View Details</a> 

        <ul class="nav nav-tabs">
          <li><a data-toggle="tab" data-table="student_info" class="{{ $hidden }}" href="#student" id="student_info_tab"  onclick="callAjax(this,'{{ route('admin.student.table.show',Crypt::encrypt($student[0]->id)) }}','tab_info_detail')"><i class="fa fa-users" id="student_info"></i> Student</a></li>

          <li><a data-toggle="tab" data-table="sibling_items" class="{{ $hidden }}" href="#sibling" id="sibling_info_tab"  onclick="callAjax(this,'{{ route('admin.sibling.table.show',$student[0]->id) }}','tab_info_detail')"><i class="fa fa-users" id="sibling_info"></i> Sibling</a></li>

          <li><a data-toggle="tab" data-table="parents_items" href="#parent" id="parent_info_tab" class="{{ $hidden }}" onclick="callAjax(this,'{{ route('admin.parents.list',$student[0]->id) }}','tab_info_detail')"><i class="fa fa-user-circle"></i> Parent</a></li>

          <li><a data-toggle="tab" href="#address" data-table="address_info_table" id="address_info" class="{{ $hidden }}" onclick="callAjax(this,'{{ route('admin.parents.address',$student[0]->id) }}','tab_info_detail')"><i class="fa fa-home"></i> Address</a></li>

          <li><a data-toggle="tab" data-table="medical_info_table" href="#medical" id="medical_info_tab" onclick="callAjax(this,'{{ route('admin.medical.info.list',$student[0]->id) }}','tab_info_detail')"><i class="fa fa-user-md" id="medical_info"></i> Medical</a></li>

          <li><a data-toggle="tab" href="#subjects" id="subject_tab" onclick="callAjax(this,'{{ route('admin.studentSubject.list',$student[0]->id) }}','tab_info_detail')"><i class="fa fa-book" id="subjects"></i>  Subjects</a></li>

          <li><a data-toggle="tab" href="#sport" id="sport_hobbies_tab" data-table="sport_hobby_items" onclick="callAjax(this,'{{ route('admin.hobby.show',$student[0]->id) }}','tab_info_detail')"><i class="fa fa-life-ring" id="sport_tab"></i> Sports</a></li>

          <li><a data-toggle="tab" href="#document"><i class="fa fa-file" id="document_tab"></i> Document</a></li>

          <li><a data-toggle="tab" href="#award_list"><i class="fa fa-angellist" id="award_list_tab"></i> Award</a></li>

          <button type="button" class="btn btn-xs btn-info pull-right" onclick="callPopupLarge(this,'{{ route('admin.student.preview',$student[0]->id) }}')" style="margin:5px">Preview</button>
          <a href="{{ route('admin.student.pdf.generate',Crypt::encrypt($student[0]->id)) }}" class="btn btn-xs btn-success pull-right" title="Download Profile " target="_blank" style="margin:5px">PDF</a>
        </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <div class="panel panel-default">
              <div class="panel-heading" style="height: 20px;"></div>
              <div class="panel-body">
                <div class="table-responsive" id="tab_info_detail">
                </div>  
              </div> 
            </div>

          </div>
        </div>

      </div>


      
    </section>
  @endsection

@else



       
        @php
          $admissionApplication=App\Model\AdmissionApplication::where('student_id',$student[0]->id)->first();
        @endphp 
      
        @if (!empty($admissionApplication))  
          @if ($admissionApplication->status>=2) 
            <a href="{{ route('admin.student.registration.profile.view',Crypt::encrypt($student->id)) }}" class="btn btn-xs btn-primary pull-right" title="Download Profile " target="_blank" style="margin:5px">View Details</a> 
          @endif
        @endif

        {{-- @php
          if ($userId->role_id==12){$hidden='hidden';}
          else{$hidden='';}
        @endphp --}}

        
        {{-- @if ($student->student_status_id==1)
        @endif --}}
        
        
           
            @php
              if(!empty($admissionApplication)){   
                $status='';
                if($admissionApplication->status==1){
                  $status='New Application';
                }else if($admissionApplication->status==2){
                  $status='Form Submited';
                }else if($admissionApplication->status==3){
                  $status='Application Form Received';
                }else if($admissionApplication->status==4){
                  $status='Accepted';
                }else if($admissionApplication->status==5){
                  $status='Rejected';
                }else if($admissionApplication->status==6){
                  $status='Pass';
                }else if($admissionApplication->status==7){
                  $status='Retest';
                }else if($admissionApplication->status==8){
                  $status='Fail';
                }else if($admissionApplication->status==9){
                  $status='Admitted';
                }else if($admissionApplication->status==10){
                  $status='Admission Close';
                }
              }
            @endphp
                              
            @if(!empty($admissionApplication))     
              @if ($userId->role_id==12) 
                <span style="margin-left: 10px">Application No. <b>{{ $admissionApplication->id }}</b></span>
              @endif  
            @endif
            
            
          </div>
          <div id="parent" class="tab-pane fade"> 
            <span ><button type="button" class="add_btn_parets btn btn-info btn-sm" onclick="callPopupLarge(this,'{{ route('admin.parents.add.form',$student[0]->id) }}')" style="margin: 10px">Add Parent Detail</button> 
              <div class="table-responsive" id="parent_info_list">
              </div> 
          </div>
          <div id="address" class="tab-pane fade">     
            <div class="table-responsive" id="address_list">
            </div> 
          </div>
          <div id="medical" class="tab-pane fade">
            <button type="button" class="btn btn-info btn-sm btn_add_medical_info" onclick="callPopupLarge(this,'{{ route('admin.medical.info.add.form',$student[0]->id) }}')" style="margin: 10px">Add Medical Detail</button>   
            <div class="table-responsive" id="medical_info_page">
            </div>
          </div>   
          <div id="sibling" class="tab-pane fade">
            <button type="button" class="btn btn-info btn-sm btn_add_sibling_info"  onclick="callPopupLarge(this,'{{ route('admin.sibling.add.form',$student[0]->id) }}')" style="margin: 10px">Add Sibling Detail</button>
           
            <div class="table-responsive" id="sibling_info_list">
            </div> 
          </div>
          <div id="subjects" class="tab-pane fade">
            <button type="button" class="btn btn-info btn-sm add_subject" style="margin: 10px" onclick="callPopupLarge(this,'{{ route('admin.studentSubject.add',$student[0]->id) }}')" >Add Subject</button>
            <div class="table-responsive" id="subject_list">
            </div> 
            <div class="text-center">
                {{-- <button type="button" onclick="$('#medical_info_tab').click()" class="btn btn-success btn-sm">Previous</button>  --}}
                {{-- <button type="button" onclick="$('#sport_tab').click()" class="btn btn-success btn-sm">Next</button> --}} 
            </div>
          </div>
          <div id="sport" class="tab-pane fade">
            <button type="button" class="btn btn-info btn-sm btn_add_sport_hobby" style="margin: 10px" onclick="callPopupLarge(this,'{{ route('admin.hobby.add',$student[0]->id) }}')">Add Sport/Hobbies</button>
            <div id="sport_hobbies_list">   
            </div> 
            <div class="text-center">
               {{-- <button type="button" onclick="$('#subject_tab').click()" class="btn btn-success btn-sm">Previous</button>  --}}
               {{-- <button type="button" onclick="$('#document_tab').click()" class="btn btn-success btn-sm">Next</button>  --}}
            </div>
          </div>
          <div id="document" class="tab-pane fade">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="margin: 10px" data-target="#add_document">Add Document</button>
            <button id="btn_student_document_list" hidden data-table="document_items" onclick="callAjax(this,'{{ route('admin.document.list',$student[0]->id) }}','student_document_list')"></button>
            <div id="student_document_list">      
            </div>
            <div class="text-center">
               {{-- <button type="button" onclick="$('#sport_tab').click()" class="btn btn-success btn-sm">Previous</button>  --}}
               {{-- <button type="button" onclick="$('#award_list_tab').click()" class="btn btn-success btn-sm">Next</button>  --}}
            </div>
          </div>
          <div id="award_list" class="tab-pane fade">
            <button id="btn_event_type_table_show" hidden data-table="event_type_data_table" onclick="callAjax(this,'{{ route('admin.award.for.table.show',$student[0]->id) }}','event_type_table_show_div')">show </button> 
            <div class="" id="event_type_table_show_div"> 
            </div>
            <div class="text-center">
                 <button type="button" onclick="$('#document_tab').click()" class="btn btn-success btn-sm">Previous</button> 
                   <button type="button" onclick="$('#student_tab').click()" class="btn btn-success btn-sm">Student Details</button> 
            </div>
          </div>
        </div>
      </div>
      <!-- /.box -->
      <!-- Trigger the modal with a button -->
           
      <div class="col-lg-4 text-center">
        @if (!empty($admissionApplication)) 
          @if ($admissionApplication->status==1)
            <a href="{{ route('admin.student.registration.final.submit',$student[0]->id) }}" title="Final Submit" class="btn btn-primary">Final Submit</a>
          @else
          @endif
        @endif   
      </div>
    </section>

   
 

{{-- @include('admin.student.studentdetails.include.add_parents_info') --}}
{{-- @include('admin.student.studentdetails.include.add_parents_image') --}}
{{-- @include('admin.student.studentdetails.include.add_medical_info') --}}
{{-- @include('admin.student.studentdetails.include.add_sibling_info') --}}
{{-- @include('admin.student.studentdetails.include.add_subject')
 --}}
    @include('admin.student.studentdetails.include.add_document')
  @endsection

  @push('links')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
 
 {{-- <link href="https://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet"> --}}
 
    <style type="text/css" media="screen">
      #camera {
      width: 100%;
      height: 350px;
      }
    </style>
  @endpush
  
  @push('scripts')
    <script src="{{ asset('jpeg_camera/jpeg_camera_with_dependencies.min.js') }}" type="text/javascript"></script> 
    <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $("#registration_no").keypress(function(event) {
      var character = String.fromCharCode(event.keyCode);
      return isValid(character);     
      });

      function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\_[\]\\';,./{}|\\":<>\?]/g.test(str);
      }
      $(document).ready(function(){  
        $('#show_webcam').hide('400')
        $( ".datepicker" ).datepicker({dateFormat:'dd-mm-yy'});
        $('#medical_items').DataTable();
        $('#parents_items').DataTable();
        $('#sibling_items').DataTable();
        $('#address_items').DataTable();
        $('#sport_hobby_items').DataTable();
        $('#btn_event_type_table_show').click();
        $('#btn_student_document_list').click();
        $('#btn_image_refrash').click();
      });
      var errors = '{{ $errors->first() }}';
      if (errors) {
        $("#addfee").modal('show');
      }
    </script>
    <script type="text/javascript"> 
      $(document).ready(function(){
        $("#crop-show").hide();
        $('#showImg').on('click','.btn_change_image',function(){
        $('#crop-show').show(); 
        $('#show_webcam').hide();           
        });
    
        $('#crop-hide').on('click',function(){
          $('#crop-show').hide();           
        });
      });
    </script>
    <script type="text/javascript">
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });

$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 250,         
    },
    boundary: {
        width: 210,
        height: 260
    }
});

$('#upload').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result').on('click', function (ev) {
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {
    $.ajax({
      url: "{{ route('admin.student.profilepic.update',$student[0]->id) }}",
      type: "POST",
      data: {"image":resp},
      success: function (data) {        
        $("#showImg").load(location.href + ' #showImg');
         $('#crop-show').hide(); 
      }
    });
  });
});

</script>

 

@endpush
@endif
