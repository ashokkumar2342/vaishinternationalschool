@extends('admin.layout.base')
@section('body')

<section class="content-header">
    <h1>Add New Student</h1> 
</section>      
<section class="content">  
    <div class="box">   
        <div class="box-body">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Class/Section</a></li>
              <li><a data-toggle="tab" href="#menu1">Registration No.</a></li>
              <li><a data-toggle="tab" href="#menu2">Application No.</a></li>
              {{-- <li><a data-toggle="tab" href="#menu3">Search</a></li> --}}
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <form action="{{ route('admin.student.show.list',1) }}" success-content-id="student_list" method="post" class="add_form" no-reset="true">
                    {{ csrf_field() }}                                            
                        <div class="row" style="margin-top: 20px">
                            <div class="col-lg-3">                         
                                <div class="form-group">
                                    <label>Class</label>
                                    <select name="class" class="form-control" id="select_class_box" onchange="callAjax(this,'{{ route('admin.selbox.getsection.byclass') }}','select_section_box')">
                                        @foreach ($classes as $classe)
                                        <option value="{{$classe->id}}">{{$classe->name}}</option>  
                                        @endforeach 
                                    </select> 
                                </div>
                            </div>
                            <div class="col-lg-3">                         
                                <div class="form-group">
                                    {{ Form::label('section','section',['class'=>' control-label']) }}
                                    <span class="fa fa-asterisk"></span>
                                    <select name="section" class="form-control" id="select_section_box">
                                        <option selected disabled>Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" style="padding-top: 24px;">                         
                                <div class="form-group">
                                  <button type="submit" class="btn btn-success">Show</button>
                                    
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col-lg-12"  id="student_list"> 
                            </div> 
                        </div>
                    </form>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <form action="{{ route('admin.student.show.list',2) }}" success-content-id="student_list1" method="post" class="add_form" no-reset="true"> 
                    {{ csrf_field() }}                            
                         <div class="row" style="margin-top: 20px">                            
                             <div class="col-lg-4">                         
                                <div class="form-group">
                                    {{ Form::label('class','Registration No',['class'=>' control-label']) }}
                                    <input type="text" name="student_id" class="form-control" placeholder="Enter Registration No">
                                    <p class="text-danger">{{ $errors->first('session') }}</p>
                                </div>
                            </div> 
                            <div class="col-lg-3" style="padding-top: 24px;">                         
                                <div class="form-group">
                                  <button type="submit" class="btn btn-success">Show</button>
                                    
                                </div>
                            </div>    
                          </div> 
                    </form>
                      <div class="row">
                       <div class="col-lg-12"  id="student_list1"> 
                        </div> 
                     </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <form action="{{ route('admin.student.show.list',3) }}" success-content-id="student_list2" method="post" class="add_form" no-reset="true"> 
                    {{ csrf_field() }}                            
                         <div class="row" style="margin-top: 20px">                            
                             <div class="col-lg-4">                         
                                <div class="form-group">
                                    {{ Form::label('class','Application No',['class'=>' control-label']) }}
                                    <input type="text" name="application_no" class="form-control" placeholder="Enter Application No.">
                                    <p class="text-danger">{{ $errors->first('session') }}</p>
                                </div>
                            </div> 
                             <div class="col-lg-3" style="padding-top: 24px;">                         
                                <div class="form-group">
                                  <button type="submit" class="btn btn-success">Show</button>
                                    
                                </div>
                            </div>    
                          </div> 
                    </form>
                      <div class="row">
                       <div class="col-lg-12"  id="student_list2"> 
                        </div> 
                     </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
@push('scripts')
<script>
    $('#select_class_box').trigger('change')
</script>
@endpush