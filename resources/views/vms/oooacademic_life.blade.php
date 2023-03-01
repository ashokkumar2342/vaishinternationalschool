@extends('vms.main')
@section('main.container')

<main class="cd-main-content" id="fontSize"> 
<!-- MAIN CONTENT
================================================== -->
<div class="top-banner wow fadeInDown"> 
<img src="{{asset('images/academic-ethos-1.jpg')}}" alt="Top banner" class="img-fluid"> 	
</div>
<!-- Breadcrumb ============================== -->
<section class="breadcrumb-wrap wht-bg" >
<div class="container">
<div class="row">
<div class="col-sm-12">
<ol class="breadcrumb bg-nn wow fadeInLeft">
<li class="breadcrumb-item"><a href="../../index.html">Home</a></li>  
<li class="breadcrumb-item"><a href="../index.html">Academic Life</a></li>  
<li class="breadcrumb-item active">Academic Ethos</li>
</ol>
</div>
</div>
</div>
</section>  
<!-- End Breadcrumb============================== --> 
<!-- Content section ============================== -->
<section class="content-wrap mb-4 mt-4">
<div class="container">
<div class="row">
<div class="col-md-12 flex-first flex-md-unordered">
<h2 class="pg-hd text-center wow fadeInDown"><span>Academic Ethos</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Academic Life</h3>
<ul class="pg-links">  
<li class=" active "><a href="index.html" class="item-link close-panel"><span> Academic Ethos </span></a>
</li>
<li class=""><a href="../reporting-and-progress/index.html" class="item-link close-panel"><span> Reporting and Progress </span></a>
</li>
<li class=""><a href="../ib-and-icse-isc-results-2018/index.html" class="item-link close-panel"><span> Results </span></a>
</li>
<li class=""><a href="../library/index.html" class="item-link close-panel"><span> Library </span></a>
</li>
<li class=""><a href="../leadership/index.html" class="item-link close-panel"><span> Leadership </span></a>
</li>
<li class=""><a href="../prize-giving/index.html" class="item-link close-panel"><span> Prize Giving </span></a>
</li>
<li class="dropdown "><a href="../curriculum/index.html" class="item-link close-panel"><span> Curriculum </span></a>
<i class="fa fa-minus"></i>
<ul class="sub-menu">
<li ><a href="../curriculum/d-and-c/index.html" class="item-link close-panel" rel="d-and-c"><span> D and C </span></a></li> 
<li ><a href="../curriculum/b-and-a/index.html" class="item-link close-panel" rel="b-and-a"><span> B and A </span></a></li> 
<li ><a href="../curriculum/s-and-sc/index.html" class="item-link close-panel" rel="s-and-sc"><span> S and SC </span></a></li> 
<li ><a href="../curriculum/isc/index.html" class="item-link close-panel" rel="isc"><span> ISC </span></a></li> 
<li ><a href="../curriculum/ibdp/index.html" class="item-link close-panel" rel="ibdp"><span> IBDP </span></a></li> 
</ul>
</li>
<li class="dropdown "><a href="../departments/index.html" class="item-link close-panel"><span> Departments </span></a>
<i class="fa fa-minus"></i>
<ul class="sub-menu">
<li ><a href="../departments/art/index.html" class="item-link close-panel" rel="art"><span> Art </span></a></li> 
<li ><a href="../departments/accounts-commerce-and-economics/index.html" class="item-link close-panel" rel="accounts-commerce-and-economics"><span> Accounts, Commerce and Economics </span></a></li> 
<li ><a href="../departments/biology/index.html" class="item-link close-panel" rel="biology"><span> Biology </span></a></li> 
<li ><a href="../departments/careers-information-education-and-guidance-department/index.html" class="item-link close-panel" rel="careers-information-education-and-guidance-department"><span> Careers Information, Education and Guidance Department </span></a></li> 
<li ><a href="../departments/computer-science/index.html" class="item-link close-panel" rel="computer-science"><span> Computer Science </span></a></li> 
<li ><a href="../departments/chemistry/index.html" class="item-link close-panel" rel="chemistry"><span> Chemistry </span></a></li> 
<li ><a href="../departments/design-and-technology/index.html" class="item-link close-panel" rel="design-and-technology"><span> Design and Technology </span></a></li> 
<li ><a href="../departments/english/index.html" class="item-link close-panel" rel="english"><span> English </span></a></li> 
<li ><a href="../departments/environmental-systems/index.html" class="item-link close-panel" rel="environmental-systems"><span> Environmental Systems </span></a></li> 
<li ><a href="../departments/french/index.html" class="item-link close-panel" rel="french"><span> French </span></a></li> 
<li ><a href="../departments/geography/index.html" class="item-link close-panel" rel="geography"><span> Geography </span></a></li> 
<li ><a href="../departments/german/index.html" class="item-link close-panel" rel="german"><span> German </span></a></li> 
<li ><a href="../departments/hindi/index.html" class="item-link close-panel" rel="hindi"><span> Hindi </span></a></li> 
<li ><a href="../departments/history/index.html" class="item-link close-panel" rel="history"><span> History </span></a></li> 
<li ><a href="../departments/life-skills/index.html" class="item-link close-panel" rel="life-skills"><span> Life Skills </span></a></li> 
<li ><a href="../departments/mathematics/index.html" class="item-link close-panel" rel="mathematics"><span> Mathematics </span></a></li> 
<li ><a href="../departments/music/index.html" class="item-link close-panel" rel="music"><span> Music </span></a></li> 
<li ><a href="../departments/physics/index.html" class="item-link close-panel" rel="physics"><span> Physics </span></a></li> 
<li ><a href="../departments/political-science/index.html" class="item-link close-panel" rel="political-science"><span> Political Science </span></a></li> 
<li ><a href="../departments/psychology/index.html" class="item-link close-panel" rel="psychology"><span> Psychology </span></a></li> 
<li ><a href="../departments/physical-education/index.html" class="item-link close-panel" rel="physical-education"><span> Physical Education </span></a></li> 
<li ><a href="../departments/sports/index.html" class="item-link close-panel" rel="sports"><span> Sports </span></a></li> 
<li ><a href="../departments/support-for-learning/index.html" class="item-link close-panel" rel="support-for-learning"><span> Support For Learning </span></a></li> 
<li ><a href="../departments/yoga/index.html" class="item-link close-panel" rel="yoga"><span> Yoga </span></a></li> 
</ul>
</li>
<li class=""><a href="../artsdoon/index.html" class="item-link close-panel"><span> <span class="__cf_email__" data-cfemail="531221272013173c3c3d">[email&#160;protected]</span> </span></a>
</li>
<li class=""><a href="../university-destinations/index.html" class="item-link close-panel"><span> University Destinations </span></a>
</li>
</ul>
<div class="category-sidebar">			<div class="textwidget"><div class="category-sidebar">
<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">News Categories</h3>
<ul>
<li class="cat-item cat-item-5 current-cat"><a href="{{route('vms.news')}}">All</a></li>
<li class="cat-item cat-item-27"><a href="{{route('vms.academic.life')}}">Academic</a></li>
<li class="cat-item cat-item-90"><a href="{{route('vms.alumni')}}">Alumni</a></li>
<li class="cat-item cat-item-99"><a href="{{route('vms.clubs.and.societies')}}">Clubs and Societies</a></li>
<li class="cat-item cat-item-23"><a href="{{route('vms.co.curricular')}}">Co-curricular</a></li>
<li class="cat-item cat-item-53"><a href="{{route('vms.events')}}">Events</a></li>
<li class="cat-item cat-item-94"><a href="{{route('vms.media')}}">Media</a></li>
<li class="cat-item cat-item-19"><a href="{{route('vms.sports')}}">Sport</a></li>
</ul>
</div>
</div>
</div></div>
<div class="col-md-9 content-dtl flex-first flex-md-unordered">
<p>The Doon School’s academic ethos focuses on encouraging the boys to utilise their talents, and develop their intellectual and creative interests so that they remain interesting and interested young men for the rest of their professional and personal lives. The boys need to understand their own culture and history, as well as their own geographical, scientific and spiritual theory and language. The school’s academic environment is constructed such that the boys are able to develop their knowledge and interest in these areas in an international context and around the global world in which they are born and will live.</p>
<p>Boys at The Doon School are expected to be independent thinkers, develop first class critical reading, writing and analysis skills, learn to understand the value of research across all areas of the curriculum and be self-motivated and self-driven through a genuine love of the subject and not only by intrinsic rewards. Boys should be aware of other boys’ weaknesses and strengths and be able to develop an understanding for them. Service and an understanding of each other’s cultural backgrounds and religions is a crucial aspect of academic and wider life at The Doon School.</p>
<div class="clear"></div>
<hr style="margin: 50px 0;"/>
<div class="text-center">
<ul class="abt-links">  
<li><a href="index.html"><i class="fa fa-mortar-board"></i> <span> Academic Ethos </span></a></li>
<li><a href="../reporting-and-progress/index.html"><i class="fa fa-area-chart"></i> <span> Reporting and Progress </span></a></li>
<li><a href="../ib-and-icse-isc-results-2018/index.html"><i class="fa fa-bullhorn"></i> <span> Results </span></a></li>
<li><a href="../library/index.html"><i class="fa fa-book"></i> <span> Library </span></a></li>
<li><a href="../leadership/index.html"><i class="fa fa-location-arrow"></i> <span> Leadership </span></a></li>
<li><a href="../prize-giving/index.html"><i class="fa fa-trophy"></i> <span> Prize Giving </span></a></li>
<li><a href="../curriculum/index.html"><i class="fa fa-map-o"></i> <span> Curriculum </span></a></li>
<li><a href="../departments/index.html"><i class="fa fa-map-signs"></i> <span> Departments </span></a></li>
<li><a href="../artsdoon/index.html"><i class="fa fa-paint-brush"></i> <span> <span class="__cf_email__" data-cfemail="8dccfff9fecdc9e2e2e3">[email&#160;protected]</span> </span></a></li>
<li><a href="../university-destinations/index.html"><i class="fa fa-university"></i> <span> University Destinations </span></a></li>
</ul>
</div>
</div>
</div>
</div>
</section>
<!-- End Content section ============================== -->

<!-- FOOTER
===
===
=== === === === === === === === === === === === === === == -->
@endsection