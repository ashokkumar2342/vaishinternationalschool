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
              <h3 class="box-title">Subjects List</h3>
              <span style="float: right"><button type="button" class="btn btn-info btn-sm"  onclick="callPopupMd(this,'{{ route('admin.subjectType.edit') }}')"  >Add Subject</button></span>

              <a style="float: right;margin-right: 10px" href="{{ route('admin.subjectType.pdf.generate') }}" class="btn btn-primary btn-sm" title="Download PDF" target="blank">PDF</a> 
            </div>
            
            <div class="box-body">
             <div class="table-responsive">
              <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>Sr.No.</th>                
                  <th>Subject Name</th>
                  <th>Subject Code</th>
                  <th>Sorting Order No.</th>
                  <th width="100px">Action</th>                  
                </tr>
                </thead>
                <tbody>
                  @php
                     
                  $subjectId=1;
                  @endphp
                @foreach($subjects as $subject)
                <tr>
                  <td>{{$subjectId++}}</td>
                  <td>{{ $subject->name }}</td>
                  <td>{{ $subject->code }}</td>
                  <td>{{ $subject->sorting_order_id }}</td>
                  <td > 
                    <button class="btn btn-info btn-xs" onclick="callPopupMd(this,'{{ route('admin.subjectType.edit',Crypt::encrypt($subject->id)) }}')" ><i class="fa fa-edit"></i></button>

                    <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this data ?')" href="{{ route('admin.subjectType.delete',Crypt::encrypt($subject->id)) }}"><i class="fa fa-trash"></i></a>
                    
                    
                  </td>
                 
                </tr>
                @endforeach
                </tbody>
                 
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- Trigger the modal with a button -->


    </section>
    <!-- /.content -->
@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
 @push('scripts')
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript">
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
     @if(@$subjectType || $errors->first())
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
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"> 

@endpush