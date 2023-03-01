@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <h1>Exam Schedule</h1>
      <ol class="breadcrumb">
      </ol>
</section>
    <section class="content">
        <div class="box">             
            <!-- /.box-header -->
            <div class="box-body">             
                <div class="col-md-12"> 
	                <form class="add_form" content-refresh="route_table" action="{{ route('admin.exam.schedule.store') }}" method="post">              
                  {{ csrf_field() }}
                  <div class="col-lg-3">                         
                      <div class="form-group">
                        <label>Academic Year</label>
                           <select name="academic_year_id" id="academic_year_id" class="form-control" onchange="callAjax(this,'{{ route('admin.mark.detail.studentSearch') }}'+'?academic_year_id='+$('#academic_year_id').val(),'exam_term_id')">
                             <option selected disabled>Select Academic Year</option>
                             @foreach ($academicYears as $academicYear)
                                <option value="{{ $academicYear->id }}">{{ $academicYear->name }}</option> 
                             @endforeach 
                           </select>
                      </div>
                  </div>                   
                   <div class="col-lg-3" >                         
                      <div class="form-group">
                          {{ Form::label('class','Exam Term',['class'=>' control-label']) }}
                           <select name="exam_term" class="form-control" id="exam_term_id">
                            {{-- <option value="" selected  disabled>Select Exam Term</option> 
                            @foreach ($examTerms as $examTerm)
                              <option value="{{ $examTerm->id }}">From Date:{{ date('d-m-Y', strtotime($examTerm->from_date)) }} &nbsp; To Date: {{ date('d-m-Y', strtotime($examTerm->to_date)) }}</option>
                            @endforeach --}} 
                           </select> 
                      </div>
                  </div> 
                  <div class="col-lg-3">                         
                      <div class="form-group">
                          {{ Form::label('class','Class',['class'=>' control-label']) }}
                          {!! Form::select('class',$classes, null, ['class'=>'form-control','placeholder'=>'Select Class','required']) !!}
                          <p class="text-danger">{{ $errors->first('session') }}</p>
                      </div>
                  </div> 
                  <div class="col-lg-3">                         
                      <div class="form-group">
                          {{ Form::label('subject','Subject',['class'=>' control-label']) }}
                          {!! Form::select('subject',$subjects, null, ['class'=>'form-control','placeholder'=>'Select Section','required']) !!}
                           
                      </div>
                  </div>                  
	                   <div class="col-lg-3">                                             
                         <div class="form-group">
                          {{ Form::label('test_date','On Date',['class'=>' control-label']) }}
                           {{ Form::date('on_date','',['class'=>'form-control', 'placeholder'=>'  On Date']) }} 
                         </div>                                         
                      </div>
                      <div class="col-lg-3">                                             
                         <div class="form-group">
                          {{ Form::label('max_marks','Max Marks',['class'=>' control-label']) }}
                           {{ Form::text('max_marks','',['class'=>'form-control', 'placeholder'=>'  Max Marks','maxlength'=>'4','onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57','required']) }} 
                         </div>                                         
                      </div> 
                      <div class="col-lg-3">                                             
                         <div class="form-group">
                          {{ Form::label('pass_marks','Pass Marks',['class'=>' control-label']) }}
                           {{ Form::text('pass_marks','',['class'=>'form-control', 'placeholder'=>'  Pass Marks','maxlength'=>'3','onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57','required']) }} 
                         </div>                                         
                      </div>
                      <div class="col-lg-3">                                             
                         <div class="form-group">
                          {{ Form::label('fail_marks','Fail Marks',['class'=>' control-label']) }}
                           {{ Form::text('fail_marks','',['class'=>'form-control', 'placeholder'=>'  Fail Marks','maxlength'=>'3','onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57',]) }} 
                         </div>                                         
                      </div> 
                   
                      
	                 
                       
	                     <div class="col-lg-12 text-center">                                             
	                     <button class="btn btn-success" type="submit" id="btn_fee_account_create">Submit</button> 
	                    </div>                     
	                </form> 
                </div> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

            <div class="box">             
              <!-- /.box-header -->
                <div class="box-body">
                    <table id="route_table" class="display table">                     
                        <thead>
                            <tr>
                                <th>Sr.No.</th>                               
                                <th>Academic Year</th> 
                                <th>Exam Term</th> 
                                <th>Class</th>  
                                <th>Subject</th>                                                            
                                <th>On Date</th>                                                            
                                <th>Max marks</th>                                                             
                                <th>Pass marks</th>                                                             
                                <th>Fail marks</th>                                          
                                <th><span class="text-nowrap"  style="margin :83px">Action </span></th>                                                            
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($examSchedules as $examSchedule)
                        	<tr>
                        		<td>{{ ++$loop->index }}</td>
                            <td>{{ $examSchedule->academicYear->name or ''}}</td>
                            <td>{{ $examSchedule->examTerms->from_date or ''}}</td>
                            <td>{{ $examSchedule->classes->name or ''}}</td> 
                            <td>{{ $examSchedule->subjects->name }}</td>
                            <td>{{ $examSchedule->on_date }}</td>
                            <td>{{ $examSchedule->max_marks }}</td> 
                            <td>{{ $examSchedule->pass_marks }}</td> 
                            <td>{{ $examSchedule->fail_marks }}</td> 
                            
                        		<td style="width:50px"> 
                             @if(App\Helper\MyFuncs::menuPermission()->d_status == 1) 
                        			<a href="{{ route('admin.exam.schedule.delete',Crypt::encrypt($examSchedule->id)) }}"  onclick="return confirm('Are you sure you want to delete this item?');" class="btn_delete btn btn-danger btn-xs"    ><i class="fa fa-trash"></i></a>
                              @endif

                              <a href="{{ url('storage/class_test/'.$examSchedule->sylabus) }}" {{ $examSchedule->sylabus==null?'disabled':'' }} target="_blank"  class="btn btn-info btn-xs"    ><i class="fa fa-download"></i></a>
                              <a href="{{ route('admin.exam.schedule.send.sms',$examSchedule->id) }}" class="btn btn-primary btn-xs" title="">SMS<i class="fa fa-send"></i></a>
                              <a href="{{ route('admin.exam.schedule.send.email',$examSchedule->id) }}" class="btn btn-danger btn-xs" title="">Email<i class="fa fa-envelope"></i></a>
                              <button type="button" class="btn btn-warning btn-xs">Compile</button>
                        		</td>
                        	</tr>  	 
                        @endforeach	
                           
                        </tbody>
                             

                    </table>
                </div>
            </div>    

           
 
    </section>
    <!-- /.content -->
@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> 
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
 
@endpush
@push('scripts')
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
  <script type="text/javascript">
     $( ".datepicker" ).datepicker({dateFormat:'dd-mm-yy'});
     $("#class").change(function(){
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

     $("#class").change(function(){
         sectionSearch($(this).val());
     });     
     
     if ($("#class").val() > 0) {
      
     }
     
      
     function sectionSearch (value,selectVal=null){
         var selected = null;
         $('#section').html('<option value="">Searching ...</option>'); 
       
         $.ajax({
           method: "get",
           url: "{{ route('admin.manageSection.search2') }}",
           data: { id: value }
         })
         .done(function(response ) {            
              if(response.section.length>0){
                 $('#section').html('<option value="">Select section</option>');
                for (var i = 0; i < response.section.length; i++) {
                     if(selectVal>0){
                         selected = (selectVal==response.section[i].id)?'selected':''; 
                     }
                     $('#section').append('<option value="'+response.section[i].id+'"'+selected+'>'+response.section[i].name+'</option>'); 
                 }
             }
             else{
                 $('#section').html('<option value="">Not found</option>');
             } 
                    
         });
     }
     
 </script>
    
@endpush