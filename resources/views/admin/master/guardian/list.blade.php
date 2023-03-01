@extends('admin.layout.base')
@push('links')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">    
@endpush

@section('body')
  <!-- Main content -->
  <section class="content-header">
    <button class="btn btn-info btn-sm pull-right" onclick="callPopupLarge(this,'{{ route('admin.guardian.edit') }}')">Add Guardian</button>
    <a href="{{ route('admin.guardian.report') }}" title="" target="blank" class="btn btn-sm btn-primary pull-right" style="margin-right: 5px">PDF</a>
    <h1>Guardians<small>List</small> </h1> 
    </section>  
    <section class="content"> 
          
          <div class="box"> 
            <div class="box-body"> 
            <div class="table-responsive"> 
              <table class="table table-bordered table-condensed" id="guardianRelationTypes">
                  <thead>
                    <tr>
                      <th>Sr.No.</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $arrayId=1;
                    @endphp
                    @foreach ($guardianRelationTypes as $guardianRelationType)
                            <tr>
                              <td>{{ $arrayId++ }}</td>
                              <td>{{ $guardianRelationType->name }}</td>
                              <td>{{ $guardianRelationType->code }}</td>
                              <td>
                                <button class="btn btn-info btn-xs" onclick="callPopupLarge(this,'{{ route('admin.guardian.edit',Crypt::encrypt($guardianRelationType->id)) }}')"><i class="fa fa-edit"></i></button>

                                <a href="{{ route('admin.guardian.delete',Crypt::encrypt($guardianRelationType->id)) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

                              </td>
                            </tr> 
                    @endforeach
                  </tbody>
                </table>
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
    $(document).ready(function() {
    $('#guardianRelationTypes').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel' 
        ],
        aLengthMenu: [
        
        [200, "All"]
    ]
    } );
    } );
     
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

 