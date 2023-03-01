@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <h1>Homework  <small>List</small> </h1>
      <ol class="breadcrumb">
      </ol>
</section>
    <section class="content">
        <div class="box"> 
            <div class="box-body">
              <button type="hidden" class="btn btn-default hidden" id="btn_homework_form" text-editor="summernote" onclick="callAjax(this,'{{ route('admin.homework.form') }}','page_homework_form')">show</button>
          </div>
          <div id="page_homework_form">
            
          </div>
        </div>

            <div class="box">             
              <!-- /.box-header -->
                <div class="box-body">
                  <form action="{{ route('admin.homework.send.homework') }}" method="post" class="add_form">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-lg-3">
                      <label>Date</label>
                      <input type="date" name="date" id="search_date" class="form-control">
                      </div>
                      <div class="col-lg-3" style="margin-top: 26px">
                      <button type="button" class="btn btn-success btn-sm" onclick="callAjax(this,'{{ route('admin.homework.search') }}'+'?date='+$('#search_date').val(),'homework_table')">Search Homework</button>
                      </div> 
                    </div>
                    
                  <button type="submit" class="btn btn-primary btn-sm" style="margin: 5px;float: right;">Send Homework <i class="fa fa-send"></i></button>
                  <a href="#" title="" onclick="callPopupLevel2(this,'{{ route('admin.medical.template.view',2) }}')" style="float: right; margin-top:10px">Template View</a>
                    <table id="homework_table" class="display table">                     
                        <thead>
                            <tr>
                                <th class="text-nowrap">Sr.No</th>
                                <th class="text-nowrap">Date</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Section</th>
                                <th class="text-nowrap">Homework</th>
                                <th class="text-nowrap">Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($homeworks as $homework)
                                <tr>
                                    <td class="text-nowrap">{{ ++$loop->index}}</td>
                                    <td class="text-nowrap">{{ date('d-m-Y',strtotime($homework->created_at)) }}</td>
                                    <td class="text-nowrap">{{ $homework->classes->name }}</td>
                                    <input type="text" hidden="" name="class_id[]" value="{{ $homework->class_id }}">
                                    <td class="text-nowrap">{{ $homework->sectionTypes->name }}</td>
                                    <input type="text" hidden name="section_id[]" value="{{ $homework->section_id }}">
                                    <td>{!! $homework->homework !!}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.homework.download',$homework->homework_doc) }}" target="blank" title="Download" class="btn_parents_image btn btn-success btn-xs {{ $homework->homework_doc==null?'disabled':'' }}">
                                           <i class="fa fa-download "></i>
                                        </a> 

                                        <a href="#" onclick="callPopupLarge(this,'{{ route('admin.homework.view',$homework->id) }}')"  title="View" class="btn_parents_image btn btn-info btn-xs" ><i class="fa fa-eye"></i></button></a>

                                        {{--  @if(App\Helper\MyFuncs::menuPermission()->r_status == 1)
                                        <button type="button" class="btn_parents_image btn btn-info btn-xs" data-toggle="modal" data-id="{{ $homework->id }}" data-target="#image_parent"><i class="fa fa-eye"></i> </button>
                                        @endif --}}

                                        {{--  @if(App\Helper\MyFuncs::menuPermission()->w_status == 1) 
                                        <button type="button" class="homework_edit btn btn-warning btn-xs" data-toggle="modal" data-id="{{ $homework->id }}" data-target="#add_parent"><i class="fa fa-edit"></i> </button>
                                        @endif --}}

                                         @if(App\Helper\MyFuncs::menuPermission()->d_status == 1)
                                          <a href="{{ route('admin.homework.delete',Crypt::encrypt($homework->id)) }}"  class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure to delete this data ?');" title="Delete"><i class="fa fa-trash"></i></a> 
                                       
                                        @endif
                                        <a href="{{ route('admin.homework.homework.send',$homework->id) }}" title="Send Homework" class="btn btn-primary btn-xs"><i class="btn btn-primary btn-xs fa fa-send"></i></a>
                                    </td>
                                
                                </tr>

                            @endforeach
                        </tbody>
                             {{ $homeworks->links() }} 

                    </table>
                    </form>
                </div>
            </div>    

          <!-- Trigger the modal with a button --> 
 
    </section>
    <!-- /.content -->
@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush 

 @push('scripts')
 <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script type="text/javascript"> 
   
     $('#btn_homework_form').click();
       
 
    $("#classes").change(function(){ 
        $('#section').html('<option value="">Searching ...</option>');
        $.ajax({
          method: "get",
          url: "{{ route('admin.manageSection.search') }}",
          data: { id: $(this).val() }
        })
        .done(function( response ) {            
            if(response.length>0){
                $('#section').html('<option value="">Select Section</option>');
                for (var i = 0; i < response.length; i++) {
                    $('#section').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
                } 
            }
            else{
                $('#section').html('<option value="">Not found</option>');
            }            
        });
    }); 
    

   
    
</script>


@endpush