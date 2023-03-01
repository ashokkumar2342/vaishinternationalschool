@extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    
@endpush
@section('body')
  <!-- Main content -->
  <section class="content-header"> 
      <button class="btn btn-info btn-sm pull-right" onclick="callPopupLarge(this,'{{ route('admin.room.details.edit')}}')">Add Room</button> 
      <a class="btn btn-primary btn-sm pull-right" target="blank" href="{{ route('admin.room.details.report') }}" style="margin-right: 5px">PDF</a> 
    <h1>Rooms<small>Details</small></h1>
    </section>  
    <section class="content"> 
      <div class="box"> 
        <div class="box-body">
          <div class="table-responsive">
             <table class="table" id="room_table"> 
              <thead>
                <tr>
                  <th class="text-nowrap">Sr.No.</th>
                  <th class="text-nowrap">Room Name/No.</th>
                  <th class="text-nowrap">Room Location</th>
                  <th class="text-nowrap">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roomTypes as $roomType)
                    <tr>
                      <td>{{ ++$loop->index }}</td>
                      <td>{{ $roomType->name }}</td>
                      <td>{{ $roomType->location }}</td>
                      <td>
                        <button class="btn btn-info btn-xs" title="Edit" onclick="callPopupLarge(this,'{{ route('admin.room.details.edit',Crypt::encrypt($roomType->id)) }}')"><i class="fa fa-edit"></i></button>

                        <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this data ?')" href="{{ route('admin.room.details.delete',Crypt::encrypt($roomType->id)) }}"><i class="fa fa-trash"></i></a>

                      </td>
                    </tr> 
                @endforeach
              </tbody>
             </table>
            </div> 
        </div>
      </div>
    </section> 
 @endsection


@push('links')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
     $(document).ready(function() {
    $('#room_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
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
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
@endpush


