
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" style="height:1030px;overflow: auto">
      <li ><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      @php
        $menuTypes=App\Helper\MyFuncs::userHasMinu(); 
      @endphp
      @foreach ($menuTypes as $menuType)
        @php
          $subMenus = App\Helper\MyFuncs::mainMenu($menuType->id);
        @endphp 
        <li class="treeview">
          <a href="#"><i class="fa {{ $menuType->icon }}"></i><span>{{ $menuType->name }}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
            @foreach ($subMenus as $subMenu)
              <li><a href="{{ route(''.$subMenu->url) }}"><i class="fa fa-circle-o"></i>{{ $subMenu->name }} </a></li>               
            @endforeach               
          </ul> 
        </li>     
      @endforeach
    </ul>
  </section>
</aside>
