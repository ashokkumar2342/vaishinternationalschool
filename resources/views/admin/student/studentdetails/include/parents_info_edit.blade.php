<div class="modal-dialog"> 
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Perent Info Edit</h4>
        </div>
        <div class="modal-body">
            <div class="row"> 
                <div class="col-md-12">
                    <form id="parents-form" action="{{ route('admin.parents.update',Crypt::encrypt($parentsInfo[0]->id)) }}" class="add_form" method="post" button-click="btn_close,parent_info_tab"> 
                        <div class="form-group col-md-4">
                            {{ Form::label('name','Name',['class'=>' control-label','maxlength'=>'50']) }}
                            <span class="fa fa-asterisk"></span>                       
                            {{ Form::text('name',$parentsInfo[0]->name ,['class'=>'form-control','maxlength'=>'50']) }}

                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('education','Education',['class'=>' control-label','maxlength'=>'50']) }}

                            {{ Form::text('education',$parentsInfo[0]->education ,['class'=>'form-control','maxlength'=>'50']) }}

                        </div>
                        <div class="form-group col-md-4">
                          {{ Form::label('profession','Profession',['class'=>' control-label']) }}
                           <span class="fa fa-asterisk"></span>
                           <select name="profession" id="profession" class="form-control">
                                <option disabled selected>Select Profession</option>
                                @foreach ($professions as $profession)
                                    <option value="{{ $profession->id }}"{{$parentsInfo[0]->occupation==$profession->id?'selected':''}}>{{ $profession->name }}</option>
                                @endforeach 
                            </select>
                        </div> 

                        <div class="form-group col-md-4">
                            {{ Form::label('income','Annual Income',['class'=>' control-label']) }}
                            <span class="fa fa-asterisk"></span>
                            <select name="income" id="income" class="form-control">
                                <option disabled selected>Select Income</option>
                                @foreach ($incomes as $income)
                                    <option value="{{ $income->id }}"{{$parentsInfo[0]->income_id==$income->id?'selected':''}}>{{ $income->range }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('mobile','Mobile',['class'=>' control-label']) }}                         
                            {{ Form::text('mobile',$parentsInfo[0]->mobile ,['class'=>'form-control','maxlength'=>'10','onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57']) }}
                            <p class="text-danger">{{ $errors->first('mobile') }}</p>
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('email','email',['class'=>' control-label']) }}                         
                            {{ Form::email('email',$parentsInfo[0]->email ,['class'=>'form-control','maxlength'=>'100']) }}
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('dob','Date of Birth',['class'=>' control-label']) }}                         
                            {{ Form::date('dob',$parentsInfo[0]->dob ,['class'=>'form-control datepicker']) }}
                            <p class="text-danger">{{ $errors->first('dob') }}</p>
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('doa','Date of Anniversary',['class'=>' control-label ']) }}                         
                            {{ Form::date('doa',$parentsInfo[0]->doa ,['class'=>'form-control datepicker']) }}
                            <p class="text-danger">{{ $errors->first('doa') }}</p>
                        </div>                  
                        <div class="form-group col-md-4">
                            {{ Form::label('islive','Alive',['class'=>' control-label']) }}
                            <span class="fa fa-asterisk"></span>

                            {!! Form::select('islive',[
                                '1'=>'Yes',                                                    
                                '0'=>'No'
                                ], null, ['class'=>'form-control']) !!}
                                <p class="text-danger">{{ $errors->first('Alive') }}</p>
                            </div> 
                            <div class="form-group col-md-12">
                                {{ Form::label('office_address','Office Address',['class'=>' control-label']) }}                         
                                {{ Form::textarea('office_address',$parentsInfo[0]->office_address,['class'=>'form-control','rows'=>2,'maxlength'=>'200' ]) }}
                                <p class="text-danger">{{ $errors->first('organization_address') }}</p>
                            </div>
                            <div class="form-group col-md-12">
                                {{ Form::label('organization_address','Organization Name',['class'=>' control-label']) }}                         
                                {{ Form::textarea('organization_address',$parentsInfo[0]->organization_address,['class'=>'form-control','rows'=>2 ,'maxlength'=>'200']) }}
                                <p class="text-danger">{{ $errors->first('organization_address') }}</p>
                            </div>
                            <div class="form-group col-md-12">
                                {{ Form::label('f_designation','Designation',['class'=>' control-label']) }}                         
                                {{ Form::textarea('f_designation',$parentsInfo[0]->f_designation,['class'=>'form-control','rows'=>2 ,'maxlength'=>'50']) }}
                                <p class="text-danger">{{ $errors->first('organization_address') }}</p>
                            </div>
                            <div class="col-lg-12 text-center">

                                <input type="submit" class="btn btn-success" value="Update">
                            </div> 
                        </form>  
                    </div> 
                </div>
            </div>
        </div>   
    </div> 
