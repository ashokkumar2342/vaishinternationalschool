@extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    
@endpush
@section('body')

<section class="content-header">
     <button type="button" class="pull-right btn btn-info btn-sm" onclick="callPopupLarge(this,'{{ route('admin.feeAcount.add.form') }}')">Add Fee Account</button>
     <a href="{{ route('admin.feeAcount.report') }}" class="pull-right btn btn-primary btn-sm" title="Download PDF" style="margin-right: 10px" target="blank">PDF Report</a>
    <h1>Fee Accounts <small>List</small> </h1>
</section>
    <section class="content">
        <div class="box">             
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive"> 
             <table id="fee_account_table" class="table table-responsive table-striped table-bordered">                     
                        <thead>
                            <tr>
                                <th class="text-nowrap">Sr.No.</th>
                                <th class="text-nowrap">Fee Account Code</th>
                                <th class="text-nowrap">Fee Account Name</th>
                                <th class="text-nowrap">Sorting Order No.</th>
                                <th class="text-nowrap">Description</th>
                                <th class="text-nowrap">Action</th>                                                            
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($feeAccounts as $feeAccount)
                          <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $feeAccount->code }}</td>
                            <td>{{ $feeAccount->name }}</td>
                            <td>{{ $feeAccount->sorting_order_no }}</td>
                            <td>{{ $feeAccount->description }}</td>
                            <td> 
                               @if(App\Helper\MyFuncs::menuPermission()->w_status == 1)
                              <button type="button" class="btn_edit btn btn-info btn-xs" onclick="callPopupLarge(this,'{{ route('admin.feeAcount.add.form',Crypt::encrypt($feeAccount->id)) }}')"><i class="fa fa-edit"></i> </button>
                              @endif

                               @if(App\Helper\MyFuncs::menuPermission()->d_status == 1) 
                              <a href="{{ route('admin.feeAcount.delete',Crypt::encrypt($feeAccount->id)) }}" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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
        $('#fee_account_table').DataTable( {
        paging: false,
        dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ]
    });
      });

     $('#btn_event_type_table_show').click();
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