 
  @php
   $hotMenus =App\Helper\MyFuncs::hotMenu(); 
  @endphp
  @foreach($hotMenus as $hotMenu)
  <ul class="nav navbar-nav hidden-xs hidden-sm">
  	<li>
    	<a href="{{ route(''.$hotMenu->url) }}">{{ $hotMenu->name }}</a>
  	</li>
  </ul> 
   
  @endforeach 