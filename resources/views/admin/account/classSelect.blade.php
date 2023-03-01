 {{ Form::label('sub_menu','Section Assign',['class'=>' control-label']) }} <br>
<select class="multiselect" multiple="multiple"  name="section[]" > 
  	@foreach ($usersSections as $section)
    	<option value="{{ $section->id }}" {{ $section->status == 1?'selected':'' }}>{{ $section->name }}</option> 
    @endforeach   
</select>

<input type="submit" value="Save" class="btn btn-success btn-sm" style="float: right;">
