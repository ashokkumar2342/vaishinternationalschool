@extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">    
@endpush

@section('body')
  <!-- Main content -->
    <section class="content"> 
          <div class="box">
            <div class="box-header">
              <a href="{{ route('admin.account.list.user.generate') }}" title="" target="blank" class="btn btn-sm btn-primary pull-right" style="margin-right: 5px">PDF</a>
              <h3 class="box-title">Users List</h3>
            </div> 
            <div class="box-body">
              <div class="row"> 
                <div class="table-responsive col-lg-12">
                    <table id="dataTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Sr.No.</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email Id</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                        @php
                           $counter=1;
                        @endphp
                      @foreach($accounts as $value)
                      <tr style="{{ $value->status==1?'background-color: #95e49b':'' }}">
                        <td>{{ $counter++ }}</td>
                        <td>{{ $value->user_name }} </td>
                        <td>{{ $value->mobile }} </td>
                        <td>{{ $value->email }} </td>
                        <td>{{ $value->role }} </td>
                        <td>{{ ($value->status == 1)? 'Active' : 'Deactivated' }} </td>
                        <td>
                          

                          <a href="#" onclick="callPopupLarge(this,'{{ route('admin.account.edit',[Crypt::encrypt($value->id)]) }}')" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                  
                          <a href="{{ route('admin.account.toggle.status',Crypt::encrypt($value->id)) }}" data-parent="tr" class="label {{ ($value->status == 1) ?'btn-danger':'btn-success'}} btn btn-xs">{{ ($value->status == 1)? 'Deactivate' : 'Activate' }}</a>
                        </td>
                       
                      </tr> 
                      @endforeach
                    </tbody>
                    </table>  
                </div>
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

