@extends('admin.layout.base')
@section('body') 
<section class="content-header">
<h1>  Student Attendence  </h1>
     
</section>
    <section class="content">
      	<div class="box">  
            <div class="box-body">
            <form action="{{ route('admin.attendance.student.search',1) }}" method="post" class="add_form" success-content-id="attendance_table" no-reset="true">
              {{ csrf_field() }} 
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Class</label>
                    <select name="class_id" id="class_id" class="form-control" button-click="btn_attendance_list_show" onchange="callAjax(this,'{{ route('admin.teacher.class.wise.section.addForm') }}','section_id')">
                      <option selected disabled>Select Class</option>}
                      option
                      @foreach ($classes as $class)
                          <option value="{{ $class->id }}">{{ $class->name }}</option>  
                      @endforeach
                    </select> 
                  </div> 
                </div> 
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Section</label>
                    <select name="section_id" class="form-control" id="section_id" onchange="$('#btn_attendance_list_show').click()"> 
                    </select> 
                  </div> 
                </div> 
                @php
                  $date=date('Y-m-d');
                @endphp
                <div class="col-lg-4">                         
                  <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" value="{{ $date }}" class="form-control" onchange="$('#btn_attendance_list_show').click()">
                  </div>
                </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <input type="submit" id="btn_attendance_list_show" value="Show" class="btn btn-success form-control hidden" style="margin-top: 24px">
                  
                </div>
            </form> 
                
              </div>
              </div>
             <form action="{{ route('admin.attendance.student.save') }}" method="post" button-click="btn_attendance_list_show" class="add_form" no-reset="true">
                {{ csrf_field() }}
                <div class="table-responsive" id="attendance_table">
                  
                </div> 
             </form>
            </div> 
        </div> 
    </section>
@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush 

 @push('scripts')
 <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script type="text/javascript"> 
  $( ".datepicker" ).datepicker({dateFormat:'dd-mm-yy'});
   
     $(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ]
    } );
} );     
 </script>

 
<script>
  function callChecked(obj) {
     $('[color-change="true"]').removeClass('lebel label-danger')
     $('[color-change="true"]').removeClass('lebel label-success')
     $('[color-change="true"]').removeClass('lebel label-warning')
    var value =obj.getAttribute('data-click');
     if(value=='Present'){
        $('.present').prop('checked', true);  
        $('[color-change="true"]').addClass('lebel label-success'); 
     }else if(value=='Absent'){
        $('.absent').prop('checked', true);
         $('[color-change="true"]').addClass('lebel label-danger');
     }else if(value=='Leave'){
        $('.leave').prop('checked', true);
        $('[color-change="true"]').addClass('lebel label-warning');

     }
  }    
 
   
   
 </script>
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"> 
@endpush