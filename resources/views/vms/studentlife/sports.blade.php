@extends('vms.main')
@section('main.container')
<main class="cd-main-content" id="fontSize"> 
<!-- MAIN CONTENT
================================================== -->
<div class="top-banner wow fadeInDown"> 
<img src="{{asset('images/vis/ACLB2372.JPG')}}" alt="Top banner" class="img-fluid"> 
</div>
<!-- Breadcrumb ============================== -->
<section class="breadcrumb-wrap wht-bg" >
<div class="container">
<div class="row">
<div class="col-sm-12">
<ol class="breadcrumb bg-nn wow fadeInLeft">
<li class="breadcrumb-item"><a href="{{route('vms.index')}}">Home</a></li>  
<li class="breadcrumb-item"><a href="#">Sports</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>SPORTS</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Sports</h3>
	<ul class="pg-links">  
		<li class="">
			<a href="{{route('vms.student.life.academic')}}" class="item-link close-panel"><span> Academics </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.student.life.sports')}}" class="item-link close-panel"><span> Sports </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.co.curricular')}}" class="item-link close-panel"><span> Co-Curricular Activities </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.yoga.life.science')}}" class="item-link close-panel"><span> Yoga & Life Science </span></a>
		</li>
		
	</ul>
	<div class="category-sidebar">
		<div class="textwidget">
			<div class="category-sidebar"> 
				<ul>
					<li>
						<a href="{{route('vms.abouts')}}"><i class="fa fa-microphone"></i> <span> About Us </span></a>
					</li>
					<li>
						<a href="{{route('vms.infrastructure.lab')}}"><i class="fa fa-paper-plane-o"></i> <span> Infrastructure </span></a>
					</li>
					<li>
						<a href="{{route('vms.student.life.academic')}}"><i class="fa fa-info-circle"></i> <span> Student Life </span></a>
					</li>
					<li>
						<a href="{{route('vms.student.life.academic')}}"><i class="fa fa-trophy"></i> <span> News & Calendar </span></a>
					</li>
					{{-- <li>
						<a href="{{route('vms.alumni')}}"><i class="fa fa-user"></i> <span> Alumni </span></a>
					</li> --}}
					<li>
						<a href="{{route('vms.contacts')}}"><i class="fa fa-info"></i> <span> Contact Us </span></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="col-md-9 content-dtl flex-first flex-md-unordered">

<table style="width: 1000px; height: 251px;">
	<tbody>
		<tr>
			<td><img src="{{asset('images/vis/sports/ACLB2399.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2400.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2401.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			
		</tr>
	</tbody>
</table>
<table style="width: 1000px; height: 251px;">
	<tbody>
		<tr>
			<td><img src="{{asset('images/vis/sports/ACLB2402.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2403.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2409.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			
		</tr>
	</tbody>
</table>
<table style="width: 1000px; height: 251px;">
	<tbody>
		<tr>
			<td><img src="{{asset('images/vis/sports/ACLB2405.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2406.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2407.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			
		</tr>
	</tbody>
</table>
<p>We believe in the propagation of the all- around development of a child. Sports provide an outlet to the development and expression of the physical self of a student. With our vast sprawling green grounds, the students get an exposure to play their optimal limits for the physical exercise which is a must as 'Sound mind dwells in a sound body' under the guidance of expert PTI &amp; Coaches students enthusiastically participate in different sports at different levels i.e. District, State and National Levels. In order to spot the talent in the field of sports Inter House Games and Sports competition will be held during the session.</p>



<div class="clear"></div>
<hr style="margin: 50px 0;"/>
<div class="text-center">
	<ul class="abt-links">
		<li>
			<a href="{{route('vms.abouts')}}"><i class="fa fa-microphone"></i> <span> About Us </span></a>
		</li>
		<li>
			<a href="{{route('vms.infrastructure.lab')}}"><i class="fa fa-paper-plane-o"></i> <span> Infrastructure </span></a>
		</li>
		<li>
			<a href="{{route('vms.student.life.academic')}}"><i class="fa fa-info-circle"></i> <span> Student Life </span></a>
		</li>
		<li>
			<a href="{{route('vms.student.life.academic')}}"><i class="fa fa-trophy"></i> <span> News & Calendar </span></a>
		</li>
		{{-- <li>
			<a href="{{route('vms.alumni')}}"><i class="fa fa-user"></i> <span> Alumni </span></a>
		</li> --}}
		<li>
			<a href="{{route('vms.contacts')}}"><i class="fa fa-info"></i> <span> Contact Us </span></a>
		</li>
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