@if ($reportType==1)
<label>Role</label> 
<select name="role_id" class="form-control form-group">
	<option value="0">All</option>
	@foreach ($datas as $data)
  <option value="{{ $data->id }}">{{ $data->name }}</option>
	@endforeach 
</select> 
@endif

@if ($reportType==3)
 {{ Form::label('sub_menu','Menu',['class'=>' control-label']) }} <br>
<select class="form-control"  name="sub_menu_id" > 
  {{$menu_name = ''}}
  @foreach ($datas as $menu) 
    @if($menu->menu_name != $menu_name)
      @if($menu_name != '')
        </optgroup>    
      @endif
      <optgroup label="{{ $menu->menu_name }}"> 
      {{$menu_name = $menu->menu_name}}
    @endif
    <option value="{{ $menu->id }}">{{ $menu->sub_menu_name }}</option>   
  @endforeach  
     </optgroup>
</select>
 
@endif