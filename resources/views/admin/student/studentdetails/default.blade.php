@extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('body')
<section class="content-header">
    <h1> Student Default <small>Value</small> </h1>
       
       </section>
    <section class="content">        
        {{Form::close()}}
      	<div class="box">        
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12 ">                  
                        {{ Form::open(['route'=>'admin.defaultValue.post']) }}                            
                             <div class="row">{{--row start --}}
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <div class="col-md-12">                                         
                                          <div class="panel panel-default">
                                            <div class="panel-heading">School Details</div> 
                                              <div class="panel-body">   
                                            <div class="col-lg-2">
                                                <label>Class</label>                         
                                                <div class="form-group">
                                                    <select class="form-control" name="class">
                                                        @foreach ($classes as $classe)
                                                            <option value="{{$classe->id}}" {{$classe->id == @$default->class_id ?'selected':''}}>{{$classe->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('Class') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">                         
                                                <label>Sections</label>                         
                                                <div class="form-group">
                                                    <select class="form-control" name="section">
                                                        @foreach ($rs_sections as $values)
                                                            <option value="{{$values->id}}" {{$values->id == @$default->section_id ?'selected':''}}>{{$values->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('admission_date','Date of Admission',['class'=>' control-label']) }}
                                                    {!! Form::date('admission_date', @$default->admission_date, ['class'=>'form-control']) !!}
                                                    <p class="text-danger">{{ $errors->first('admission_date') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('activation_date ','Date of Activation',['class'=>' control-label']) }}
                                                    {!! Form::date('activation_date ', @$default->activation_date , ['class'=>'form-control']) !!}
                                                    <p class="text-danger">{{ $errors->first('activation_date ') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>House Name</label>                         
                                                <div class="form-group">
                                                    <select class="form-control" name="house">
                                                        @foreach ($houses as $value)
                                                            <option value="{{$value->id}}" {{$value->id == @$default->house_id ?'selected':''}}>{{$value->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    
                                    <div class="panel panel-default">
                                      <div class="panel-heading">Person Details </div> 
                                        <div class="panel-body">
                                            <div class="col-lg-3">   
                                                <label>Religion</label>                         
                                                <div class="form-group">
                                                    <select class="form-control" name="religion">
                                                        @foreach ($religions as $value)
                                                            <option value="{{$value->id}}" {{$value->id == @$default->religion_id ?'selected':''}}>{{$value->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    
                                                </div>

                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Gender</label>                         
                                                <div class="form-group">
                                                    <select class="form-control" name="gender">
                                                        @foreach ($genders as $value)
                                                            <option value="{{$value->id}}" {{$value->id == @$default->gender_id ?'selected':''}}>{{$value->genders}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    
                                                </div>                         
                                                
                                            </div>
                                            <div class="col-lg-3">   
                                                <label>Category</label>                         
                                                <div class="form-group">
                                                    <select class="form-control" name="category">
                                                        @foreach ($categories as $value)
                                                            <option value="{{$value->id}}" {{$value->id == @$default->category_id ?'selected':''}}>{{$value->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    
                                                </div> 
                                                
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('alive','Parent Alive',['class'=>' control-label']) }}
                                                     <select name="alive" class="form-control" >
                                                       <option value="1" {{ @$default->alive==1? 'selected' :'' }}>Yes</option> 
                                                       <option value="2" {{ @$default->alive==2? 'selected' :'' }}>No</option> 
                                                     </select>                       
                                                </div>
                                            </div>
                                           </div>
                                           </div>
                                           <div class="panel panel-default">
                                             <div class="panel-heading">Address Details </div> 
                                               <div class="panel-body">
                                             <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('state','State',['class'=>' control-label']) }}
                                                    {!! Form::text('state', @$default->state, ['class'=>'form-control']) !!}
                                                    <p class="text-danger">{{ $errors->first('state') }}</p>
                                                </div>
                                            </div>
                                              <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('city','City',['class'=>' control-label']) }}
                                                    {!! Form::text('city', @$default->city, ['class'=>'form-control']) !!}
                                                    <p class="text-danger">{{ $errors->first('city') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('pincode','Pincode',['class'=>' control-label']) }}                         
                                                    {{ Form::text('pincode',@$default->pincode,array('class' => 'form-control' )) }}
                                                    <p class="text-danger">{{ $errors->first('pincode') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('nationality','Nationality',['class'=>' control-label']) }}
                                                     <select name="nationality" class="form-control" >
                                                       <option value="1" {{ @$default->nationality==1? 'selected' :'' }}>Indian</option> 
                                                       <option value="2" {{ @$default->nationality==2? 'selected' :'' }}>Other Country</option> 
                                                     </select>                       
                                                     
                                                    <p class="text-danger">{{ $errors->first('nationality') }}</p>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                      <div class="panel-heading">Medical Details </div> 
                                        <div class="panel-body"> 
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('m_ondate','Medical On Date',['class'=>' control-label']) }}                         
                                                    {{ Form::date('m_ondate',@$default->m_ondate,array('class' => 'form-control' )) }}
                                                    <p class="text-danger">{{ $errors->first('m_ondate') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('m_hb','HB',['class'=>' control-label']) }}                         
                                                    {{ Form::text('m_hb',@$default->m_hb,array('class' => 'form-control' )) }}
                                                    <p class="text-danger">{{ $errors->first('m_hb') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('m_bp_l','BP Lower',['class'=>' control-label']) }}                         
                                                    {{ Form::text('m_bp_l',@$default->m_bp_l,array('class' => 'form-control' )) }}
                                                    <p class="text-danger">{{ $errors->first('m_bp_l') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('m_bp_u','BP Upper',['class'=>' control-label']) }}                         
                                                    {{ Form::text('m_bp_u',@$default->m_bp_u,array('class' => 'form-control' )) }}
                                                    <p class="text-danger">{{ $errors->first('m_bp_u') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('m_weight','Weight(In Kg.)',['class'=>' control-label']) }}                         
                                                    {{ Form::text('m_weight',@$default->m_weight,array('class' => 'form-control' )) }}
                                                    <p class="text-danger">{{ $errors->first('m_weight') }}</p>
                                                </div>
                                            </div>
                                             
                                            <div class="col-lg-3">                         
                                                <div class="form-group">
                                                    {{ Form::label('m_height','Height(In Cm.)',['class'=>' control-label']) }}                         
                                                    {{ Form::text('m_height',@$default->m_height,array('class' => 'form-control' )) }}
                                                    <p class="text-danger">{{ $errors->first('m_height') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div> 
                                       
                             
                        
                             <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                            
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
 @push('scripts')
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
        sectionSearch($("#class").val(),{{ @$default->section_id }}); 
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