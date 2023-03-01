@extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    
@endpush
@section('body')
    <section class="content">
      	<div class="box">
            <div class="box-header">
              <h3 class="box-title">Class List</h3>
              <span style="float: right"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_class" onclick="callPopupLarge(this,'{{ route('admin.class.edit') }}')">Add Class</button></span>
              <a href="{{ route('admin.class.pdf.generate') }}" style="float: right;margin-right: 10px" class="btn btn-primary btn-sm" title="Download PDF" target="blank">PDF</a>


            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
               
              </body>
              </html>
              <div class="table-responsive">
              <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>Sr.No.</th>                
                  <th>Class Name</th>
                  <th>Class Code</th>
                  <th>Sorting Order No</th>
                  <th width="80px">Action</th>                  
                </tr>
                </thead>
                <tbody>
                  @php 
                   $srno=1;
                  @endphp
                @foreach($classes as $class)
                <tr>
                  <td>{{ $srno++ }}</td>
                  <td>{{ $class->name }}</td>
                  <td>{{ $class->alias }}</td>
                  <td>{{ $class->shorting_id }}</td>
                  <td align="center">
                    <a class="btn btn-info btn-xs" href="#" onclick="callPopupLarge(this,'{{ route('admin.class.edit',Crypt::encrypt($class->id)) }}')"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('admin.class.deleteclass',Crypt::encrypt($class->id)) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                    
                  </td>
                 
                </tr>
                @endforeach
                </tbody>
                 
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>

    </section>
    <!-- /.content -->
@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
 @push('scripts')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript">
  // $(document).ready(function(){
  //       $('#dataTable').DataTable();
  //   });
  $(document).ready(function() {
    $('#dataTable').DataTable( {
         
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
        aLengthMenu: [
        
        [200, "All"]
    ]
    } );
} );
    
     @if(@$classType || $errors->first())
     $('#add_class').modal('show'); 
     @endif
 </script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
@endpush