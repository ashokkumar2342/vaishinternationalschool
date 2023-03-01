 @php
    $academicYear = App\Helper\MyFuncs::getDefaultAcademicYearName();
    $notification_count = App\Helper\MyFuncs::countNotification();
 @endphp
  <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-lg">{{ $academicYear}}</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                @includeIf('admin.include.hot_menu_top')
                <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <li><a href="#" title="">{{ date('d-M-Y') }}</a></li>
 
            <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="fetchNotifications()">
              <i class="fa fa-envelope-o"></i>
              
               
                 <span class="label label-success" >{{ $notification_count }}</span> 
               
            </a>
            <ul class="dropdown-menu">
              <li class="header text-right cursor" success-popup="true" redirect-to="{{ url()->current() }}" onclick="callAjax(this,'{{ route('notification.mark.all') }}')"> {{ App\Helper\MyFuncs::countNotification()!==0?'Mark all as Read':'' }}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu notifications endless-pagination" id="notification_list"   onscroll="fetchNotifications()"  data-next-page="{{ route('notification.next.page') }}">
                   
                  
                   
                  
                  <li id="notification_wait" style="display: none"> </li>
                   
                </ul>
              </li>
              <li class="footer"><a href="{{ route('notification.show.notification') }}">See All Messages</a></li>
            </ul>
          </li>
 
            
            <button type="hidden" class="hidden" id="admin_photo_refrash" onclick="callAjax(this,'{{ route('admin.profile.photo.refrash') }}','photo_refrash')">Show Photo</button>
            <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
              @php
              $admins=Auth::guard('admin')->user();
              $profile = route('admin.profile.photo.show',$admins->profile_pic);
              @endphp
               
              <img  src="{{ ($admins->profile_pic)? $profile : asset('profile-img/user.png') }}" class="user-image">
              <span class="hidden-xs">{{ Auth::guard('admin')->user()->first_name }}</span>
             
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                 <img  src="{{ ($admins->profile_pic)? $profile : asset('profile-img/user.png') }}" class="profile-user-img img-responsive img-circle">
                <p>
                  {{ Auth::guard('admin')->user()->first_name }}
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('admin.logout.get') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
            </nav>
        </header>
