@extends('admin.layout.base')
@section('body')
  <!-- Main content -->
  <section class="content-header"> 
    <h1>Application Status<small></small></h1>
    </section>  
    <section class="content"> 
      <div class="box"> 
        <div class="box-body">
        <div class="row"> 
          <div class="table-responsive col-lg-12" style="margin-top: 20px"> 
              <table class="table table-bordered" id="student_list_filter">
                <thead>
                  <tr>
                    <th>Year Name</th>
                    <th>Class Name</th>
                    <th>Student Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($applicationStatus as $application)
                    
                  <tr>
                    <td>{{$application->year_name}}</td>
                    <td>{{$application->class_name}}</td>
                    <td>{{$application->student_name}}</td>
                    <td>{{$application->adm_app_status}}</td>
                    <td>
                      <a href="{{ route($application->route_link,Crypt::encrypt($application->stu_id)) }}" class="btn-sm btn-warning">{{$application->button_caption}}</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
           </div> 
        </div>
      </div>
      </div>
    </section> 
 @endsection
 @push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript">
    $(document).ready(function(){
        $('#student_list_filter').DataTable();
    });
 </script>
  @endpush
