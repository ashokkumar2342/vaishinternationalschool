@extends('admin.layout.base')
@section('body')
  <!-- Main content -->
  <section class="content-header">
    {{-- <button type="button" class="btn btn-info pull-right" multi-select="true" onclick="callPopupLarge(this,'{{ route('admin.class.period.schedule.addform')}}')" style="margin:10px">Create New</button> --}}
    <h1>Optional Subject Group<small></small> </h1>
       
    </section>  
    <section class="content">
      <div class="row">
        <div class="col-xs-12">  
        <form action="{{ route('admin.option.subject.move.store') }}" method="post" no-reset="true" class="add_form" button-click="btn_table_show">
              {{ csrf_field() }}         
          <div class="box"> 
            <div class="box-body"> 
              <div class="row">
                <div class="col-lg-4">
                  <label>Class</label>
                  <select name="class_id" class="form-control" id="class_id" multiselect="true" onchange="callAjax(this,'{{ route('admin.option.subject.show') }}'+'?class_id='+$('#class_id').val()+'&group_id='+$('#group_id').val(),'subject_show')">
                    <option  selected disabled>Select Type</option>
                    @foreach ($classTypes as $classType) 
                    <option value="{{ $classType->id }}">{{ $classType->name }}</option> 
                     @endforeach 
                  </select> 
                </div> 
                 <div class="col-lg-4">
                  <label>Group No</label>
                  <select name="group_no" class="form-control" id="group_id" multiselect="true">
                    <option selected disabled>Select Group</option>
                     
                    <option value="1">Group No 1</option>
                    <option value="2">Group No 2</option>
                    <option value="3">Group No 3</option>
                    
                  </select>
                  
                </div>
                
                
          </div>
        </div>
        <div class="box"> 
          <div class="box-body">
            <div class="table-responsive" id="subject_show">
              
            </div>
          </div>
       </div>
       </form> 
      </div>
    </div>
  </section>
    <!-- /.content -->

@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript">
     $(document).ready(function(){
        $('#author_table').DataTable();
    });

     $('#btn_table_show').click();
  </script>
  @endpush
     
 
 