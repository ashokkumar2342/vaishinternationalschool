@extends('admin.layout.base')
@push('links')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('body')
<section class="content"> 
  <div class="box"> 
    <div class="box-body">
      <div class="row">
        <div class="col-lg-8">
          <div class="panel panel-default" style="background-color:#c0b2b5">
            <div class="panel-heading">
              <div class="btn-group">
                <a  id="student_info_tab" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.student.table.show',Crypt::encrypt($studentId)) }}','tab_info_detail')"><i class="fa fa-user"></i> Student</a>

                <a  id="sibling_info_tab" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.sibling.table.show',Crypt::encrypt($studentId)) }}','tab_info_detail')"><i class="fa fa-users"></i> Sibling</a>

                <a id="parent_info_tab" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.parents.list',Crypt::encrypt($studentId)) }}','tab_info_detail')"><i class="fa fa-user-circle"></i> Parent</a>

                <a  id="address_info" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.parents.address',$studentId) }}','tab_info_detail')"><i class="fa fa-home"></i> Address</a>

                <a id="medical_info_tab" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.medical.info.list',Crypt::encrypt($studentId)) }}','tab_info_detail')"><i class="fa fa-user-md" id="medical_info"></i> Medical</a>

                <a id="subject_tab" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.studentSubject.list',Crypt::encrypt($studentId)) }}','tab_info_detail')"><i class="fa fa-book"></i>  Subjects</a>

                <a  id="sport_hobbies_tab" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.student.sports.list',Crypt::encrypt($studentId)) }}','tab_info_detail')"><i class="fa fa-life-ring" ></i> Sports</a>

                <a id="documrnt_tab" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.student.document.list',Crypt::encrypt($studentId)) }}','tab_info_detail')"><i class="fa fa-file"></i> Document</a>
                
                <a id="award_list_tab" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callAjax(this,'{{ route('admin.award.for.table.show',Crypt::encrypt($studentId)) }}','tab_info_detail')"><i class="fa fa-file"></i> Award</a>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 text-center">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="btn-group">
                <a class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" onclick="callPopupLarge(this,'{{ route('admin.student.preview',Crypt::encrypt($studentId)) }}')"><i class="fa fa-eye"></i> Preview</a>

                <a href="{{ route('admin.student.profile.download',Crypt::encrypt($studentId)) }}" class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" title="Download Profile " target="_blank" ><i class="fa fa-download"></i> Download Profile</a>

                <a href="{{ route('admin.student.registration.profile.view',Crypt::encrypt($studentId)) }}"  class="btn btn-primary" style="border-color: #da110d;background-color: #4e6877;" title="View Details" target="_blank"><i class="fa fa-eye"></i> View Details</a>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
          <div class="table-responsive" id="tab_info_detail">
          </div>  
        </div> 
      </div>
    </div>
  </div>
</section> 
@endsection
@push('scripts')
<script type="text/javascript">
  $("#student_info_tab").click(); 
</script>

@endpush
