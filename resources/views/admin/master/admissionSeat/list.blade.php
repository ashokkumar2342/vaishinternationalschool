@extends('admin.layout.base')
@section('body')
<style type="text/css">
.btn-primary:hover {
    background-color: black;
}
</style>
<section class="content-header">
      
      <a  onclick="callPopupLarge(this,'{{ route('admin.adminssion.sch.addform') }}')" multi-select-popup="true" class="btn btn-primary btn-sm pull-right">Add Admission Schedule</a>
    <h1>Admission Schedule</h1>
</section>

<section class="content">
  <div class="box"> 
    <div class="box-body">
      
      <div class="row"> 
        <div class="col-lg-12">                         
          <div class="form-group">
            <label>Select Academic Year</label>
            <span class="fa fa-asterisk"></span>
            <select name="academic_year_id" class="form-control" id="academic_year_select_box" data-table="admission_seat_table" onchange="callAjax(this,'{{ route('admin.adm.sch.showlist') }}','adm_sch_list')">
              <option selected disabled>Select Academic Year</option>
              @foreach ($ac_year as $academicYear)
                <option value="{{ $academicYear->id }}">{{ $academicYear->name }}</option> 
              @endforeach            
            </select>
          </div>
        </div>
      </div>                                            
      
      <div id="adm_sch_list">
        
      </div>          

    </div>
  </div>
</section>
    




@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">

@endpush
 @push('scripts')
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  
  <script>
     $(document).ready(function() {
       $('#admission_seat_table').DataTable( {
            
       } );
   } );  
   
  </script>
  
@endpush
