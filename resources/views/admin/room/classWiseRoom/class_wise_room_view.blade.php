@extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
@endpush

@section('body')
  <!-- Main content -->
  <section class="content-header">
    <a href="{{ route('admin.class.wise.room.details.report') }}" target="blank" class="btn btn-primary btn-sm pull-right" title="">PDF</a> 
    <h1>Assign Class Rooms<small>Details</small> </h1> 
    </section>  
    <section class="content"> 
      <div class="box"> 
        <div class="box-body">             
             <form action="{{ route('admin.class.wise.room.store') }}" method="post" class="add_form"  content-refresh="class_wise_room_table" button-click="btn_room_select_box">
              {{ csrf_field() }}
              <div class="row">
                <div class="form-group col-lg-4">
                  <label>Class</label>
                  <select name="class_id" class="form-control" onchange="callAjax(this,'{{ route('admin.class.wise.section') }}','section_id_div')">
                    <option selected disabled>Select Class</option>
                    @foreach($classTypes as $classType)
                    <option value="{{ $classType->id }}">{{ $classType->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-lg-4" id="section_id_div">
                  <label>Section</label>
                  <select  class="form-control">
                    <option selected disabled>Select Section</option> 
                  </select>
                </div>
                  <button type="button" id="btn_room_select_box" class="btn-default hidden" onclick="callAjax(this,'{{ route('admin.class.wise.room.refrash') }}','room_select_box')">btn</button>
                <div class="form-group col-lg-4" id="room_select_box">
                  
                </div> 
              </div>
               <div class="col-lg-12 text-center">
                <input type="submit" class="btn btn-success"> 
            </div>
                
             </form>
             <div class="table-responsive col-lg-12">
             <table class="table" id="class_wise_room_table"> 
               <thead>
                 <tr>
                   <th>Class - Section</th>
                   <th>Room No.</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                @foreach ($classWiseRooms as $classWiseRoom)
                  <tr>
                    <td>{{ $classWiseRoom->class_name }}</td>
                    <td>{{ $classWiseRoom->room_name}}</td>
                    <td> 
                      <a href="{{ route('admin.class.wise.room.details.delete',Crypt::encrypt($classWiseRoom->id)) }}" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></a>
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
  <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#class_wise_room_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel' 
        ],
        aLengthMenu: [
        
        [200, "All"]
    ]
    } );
    } );
    
    $('#btn_outhor_table_show').click();
    $('#btn_room_select_box').click();
    
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

 