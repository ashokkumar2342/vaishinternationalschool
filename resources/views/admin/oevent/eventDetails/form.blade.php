@extends('admin.layout.base')
@section('body')
  <!-- Main content -->
  <section class="content-header">
    <button type="button" class="btn btn-info pull-right" onclick="callPopupLarge(this,'{{ route('admin.event.details.add.form')}}')" style="margin:10px">Add Form</button>
    <h1>Event Details<small>List</small> </h1>
       
    </section>  
    <section class="content">
      <div class="row">
        <div class="col-xs-12">          
            <!-- /.box-header -->            
          
          <button id="btn_event_details_table_show" hidden data-table="event_details_data_table" onclick="callAjax(this,'{{ route('admin.event.details.table.show') }}','event_details_table_show_div')">show </button>
          <div class="box"> 
            <div class="box-body" id="event_details_table_show_div">
           
            </div>
          </div>
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
        $('#event_details_data_table').DataTable();
    });

     $('#btn_event_details_table_show').click();
  </script>
  @endpush
     
 
 