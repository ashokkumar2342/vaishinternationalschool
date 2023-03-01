@extends('admin.layout.base')
@push('links')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">    
@endpush

@section('body')
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">          
            <!-- /.box-header -->            
          <div class="box">
            <div class="box-header">
              <?php $url = route('admin.document.type.edit') ?>
              <a class="btn btn-info btn-sm pull-right"  onclick="callPopupMd(this,'{{$url}}')">Add Document</a>
              <a href="{{ route('admin.document.type.report') }}" target="blank" class="btn btn-primary pull-right btn-sm" style="margin-right: 5px" title="">PDF</a>
              <h3 class="box-title">Document Type List</h3>
            </div>
              

            <!-- /.box-header -->
            <div class="box-body"> 
                <div class="table-responsive col-lg-12" style="margin-top: 20px">
                    <table id="dataTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>SR.No.</th>
                         
                        <th>Document Type   Name</th>
                        <th>Document code</th>
                        <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                        @php
                           
                        $documentId=1;
                        @endphp
                      @foreach($documentTypes as $document)
                      <tr>
                        <td>{{ $documentId++ }}</td>
                        
                        <td>{{ $document->name }} </td>
                        <td>{{ $document->code }} </td>
                        <td>
                            <?php $url = route('admin.document.type.edit',Crypt::encrypt($document->id)) ?>
                            <a class="btn btn-info btn-xs"  onclick="callPopupMd(this,'{{$url}}')"><i class="fa fa-edit"></i></a> 
                          
                            <a href="{{ route('admin.document.type.delete',Crypt::encrypt($document->id)) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                          
                        </td>
                       
                      </tr> 
                      @endforeach
                    </table>  
                </div>
              </div>
              
                  
            </div>
              
            <!-- /.box-body -->
            
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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

