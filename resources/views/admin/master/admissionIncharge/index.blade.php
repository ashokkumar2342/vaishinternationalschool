@extends('admin.layout.base')
@section('body')
<section class="content-header"> 
<a  onclick="callPopupLarge(this,'{{ route('admin.adminssion.incharge.addform') }}')" class="btn btn-primary btn-sm pull-right">Add Admission Incharge</a>
<h1>Admission Incharge</h1>
</section>

<section class="content">
    <div class="box"> 
        <div class="box-body"> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="admission_incharge_table">
                         <thead>
                           <tr> 
                            <th>Class</th>
                            <th>Incharge Name</th> 
                            <th>Principal Name</th> 
                            <th>Action</th>
                           </tr>
                         </thead>
                         <tbody>
                          @foreach ($result_rs as $value)
                            <tr>
                              <td>{{ $value->name}}</td>
                              <td>{{ $value->incharge_name}}</td>
                              <td>{{ $value->principal_name}}</td> 
                              <td> 
                                <a  onclick="callPopupLarge(this,'{{ route('admin.adminssion.incharge.addform',Crypt::encrypt($value->id)) }}')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                               
                                {{-- <a success-popup="true" select-triger="academic_year_select_box" onclick="if (confirm('Are you Sure delete')){callAjax(this,'{{ route('admin.adminssion.seat.delete',Crypt::encrypt($adminssionSeat->id)) }}') } else{console_Log('cancel') }" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> --}} 
                              </td>
                            </tr> 
                          @endforeach
                        </tbody>
                      </table>
                    </div>   
                </div> 
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
<script>
$(document).ready(function() {
    $('#admission_incharge_table').DataTable();
});  
   
  </script> 
@endpush

