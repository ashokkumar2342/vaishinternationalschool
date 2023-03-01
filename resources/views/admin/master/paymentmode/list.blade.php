@extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">    
@endpush

@section('body')
<section class="content-header">
         <?php $url = route('admin.paymentMode.edit') ?>
         <a class="btn btn-info btn-sm pull-right"  onclick="callPopupMd(this,'{{$url}}')">Add Payment Mode</a>
         <a href="{{ route('admin.paymentMode.pdf.generate') }}" class="btn btn-sm btn-primary pull-right" target="blank"  title="Download PDF" style="margin-right: 10px">PDF</a>
    <h1>Payment Mode List</h1>
     
</section>
    <section class="content"> 
            <div class="box"> 
                <div class="box-body">
                  <div class="row">
                  <div class="table-responsive col-lg-12"> 
                    <table class="table" id="table_payment_mode">
                         
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Payment Mode</th>
                                <th>Code</th>
                                <th>Sorting Order No</th>
                                <th class="text-nowrap">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                          @php
                            $arrayId=1;
                          @endphp
                            @foreach ($paymentmodes as $paymentmode) 
                                <tr>
                                    <td>{{ $arrayId++ }}</td>
                                    <td>{{ $paymentmode->name }}</td>
                                    <td>{{ $paymentmode->code }}</td>
                                    <td>{{ $paymentmode->sorting_order_id}}</td>
                                    <td class="text-nowrap"> 
                                        <?php $url = route('admin.paymentMode.edit',Crypt::encrypt($paymentmode->id)) ?>
                                        <a class="btn btn-info btn-xs"  onclick="callPopupMd(this,'{{$url}}')"><i class="fa fa-edit"></i></a> 
                                        
                                        <a href="{{ route('admin.paymentMode.delete',Crypt::encrypt($paymentmode->id)) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                      
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
    <!-- /.content -->
@endsection

@push('links')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
  <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#table_payment_mode').DataTable( {
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
