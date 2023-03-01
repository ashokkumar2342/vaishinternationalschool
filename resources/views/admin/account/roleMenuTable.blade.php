<div class="col-lg-3"> 
 {{ Form::label('sub_menu','Menu',['class'=>' control-label']) }} <br>
<select class="multiselect" multiple="multiple"  name="sub_menu[]" id="role_id"> 
  @php
    $menu_name = '';
  @endphp
  @foreach ($rs_result as $menu)
    @if ($menu->menu_name!=$menu_name )
      @if ($menu_name!='')
        </optgroup>   
      @endif  
      <optgroup label="{{ $menu->menu_name }}">
      {{$menu_name = $menu->menu_name}}
    @endif
      <option value="{{ $menu->id }}" {{ $menu->status?'selected':'' }} >{{ $menu->sub_menu_name }}</option>
      
  @endforeach  
  </optgroup>
</select>
</div>
 <div class="col-md-1" style="margin-top: 24px"> 
  <button type="submit"  class="btn btn-success">Save</button> 
  
   
 </div>
</form>
 <form action="{{ route('admin.account.default.user.role.report.generate',[Crypt::encrypt($role_id),Crypt::encrypt($report_type)]) }}" method="post" target="blank">
  {{ csrf_field() }}
     
     
 <div class="col-md-4" style="margin-top: 12px;">
 <div class="panel panel-default">
  <div class="panel-body">
    <label class="radio-inline"><input type="radio" name="optradio" value="selected">Only Selected</label>
    <label class="radio-inline"><input type="radio" name="optradio" checked value="all">All</label>
  
   <input type="submit" value="PDF" class="btn btn-primary pull-right">
  </div>
</div>  
 </div> 
  </form>  
 
 
 @include('admin.account.report.result')

 
        

</div> 