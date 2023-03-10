 @extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    
@endpush
@section('body')

<section class="content-header">
     <button type="button" class="pull-right btn btn-info btn-sm" onclick="callPopupLarge(this,'{{ route('admin.fineScheme.add.form') }}')">Add Fine Scheme</button>
     <a href="{{ route('admin.fineScheme.pdf.report') }}" class="pull-right btn btn-primary btn-sm" style="margin-right: 5px" target="blank">PDF Report</a>
    <h1>Fine Schemes <small>List</small></h1>
</section>
    <section class="content">
        <div class="box">             
            <!-- /.box-header -->
            <div class="box-body">             
            <div class="table-responsive">             
             <table id="fine_scheme_table" class="display table table-bordered">                     
                        <thead>
                            <tr>
                                <th class="text-nowrap">Sr.No.</th>
                                <th class="text-nowrap">Code</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Amount 1</th>
                                <th class="text-nowrap">Amount 2</th>
                                <th class="text-nowrap">Amount 3</th>
                                <th class="text-nowrap">Days After 1</th>
                                <th class="text-nowrap">Days After 2</th>
                                <th class="text-nowrap">Fine Period</th> 
                                <th class="text-nowrap">Action</th>                                                            
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($fineSchemes as $fineScheme)
                          <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $fineScheme->code }}</td>
                            <td>{{ $fineScheme->name }}</td>
                                <td>{{ $fineScheme->fine_amount1 }}</td>
                                <td>{{ $fineScheme->fine_amount2 }}</td>
                                <td>{{ $fineScheme->fine_amount2 }}</td>
                                <td>{{ $fineScheme->day_after1 }}</td>
                                <td>{{ $fineScheme->day_after2 }}</td>
                            <td>{{ $fineScheme->finePeriods->name }}</td>
                            <td>
                             @if(App\Helper\MyFuncs::menuPermission()->w_status == 1) 
                              <button type="button" class="btn btn-info btn-xs" onclick="callPopupLarge(this,'{{ route('admin.fineScheme.add.form',Crypt::encrypt($fineScheme->id)) }}')"><i class="fa fa-edit"></i> </button>
                              @endif
                               @if(App\Helper\MyFuncs::menuPermission()->d_status == 1)
                              <a href="{{ route('admin.fineScheme.delete',Crypt::encrypt($fineScheme->id)) }}" class="btn_delete btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                              @endif
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
     $(document).ready(function(){
        $('#fine_scheme_table').DataTable( {
        paging: false,
        dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ]
    });
      }); 
  </script>
  </script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
  @endpush 