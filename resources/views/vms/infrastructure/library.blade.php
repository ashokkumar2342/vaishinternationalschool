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
<li class="breadcrumb-item"><a href="#">Library</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>LIBRARY The Nerve Centre of the School</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Library</h3>
	<ul class="pg-links">  
		<li class="">
			<a href="{{route('vms.infrastructure.lab')}}" class="item-link close-panel"><span> Laboratories </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.art.craft.room')}}" class="item-link close-panel"><span> Art Craft Room </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.music.room')}}" class="item-link close-panel"><span> Music Room </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.audio.visual.room')}}" class="item-link close-panel"><span> Audio Visual Room </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.infrastructure.library')}}" class="item-link close-panel"><span> Library </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.activity.hall')}}" class="item-link close-panel"><span> Activity Hall </span></a>
		</li>
		
		<li class="">
			<a href="{{route('vms.transportation')}}" class="item-link close-panel"><span> Transportation </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.dance.hall')}}" class="item-link close-panel"><span> Dance Hall </span></a>
		</li>
	</ul>
	<div class="category-sidebar">
		<div class="textwidget">
			<div class="category-sidebar"> 
				<ul>
					<li class="cat-item cat-item-5 current-cat">
						<a href="{{route('vms.abouts')}}">About Us</a>
					</li>
					<li class="cat-item cat-item-27">
						<a href="{{route('vms.infrastructure.lab')}}">Infrastructure</a>
					</li>
					<li class="cat-item cat-item-90">
						<a href="{{route('vms.student.life.academic')}}">Student Life</a>
					</li>
					<li class="cat-item cat-item-99">
						<a href="{{route('vms.academic.news')}}">News & Calendar</a>
					</li>
					{{-- <li class="cat-item cat-item-23">
						<a href="{{route('vms.alumni')}}">Alumni</a>
					</li> --}}
					<li class="cat-item cat-item-53">
						<a href="{{route('vms.contacts')}}">Contact Us</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="col-md-9 content-dtl flex-first flex-md-unordered">
	<h4 style="text-align: center;"><span style="color: #0000ff; font-family: arial black,avant garde;"><strong>"Whenever you read a good book, somewhere in the world a door opens to allow in more light"</strong></span></h4>
	<h4>&nbsp;</h4>
	
	<table style="width: 1000px; height: 251px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/library/ACLB7435.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/library/ACLB7438.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/library/ACLB7440.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				
			</tr>
		</tbody>
	</table>
	<table style="width: 1000px; height: 251px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/library/ACLB7441.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/library/ACLB7442.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/library/ACLB7446.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				
			</tr>
		</tbody>
	</table>
	<table style="width: 1000px; height: 251px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/library/ACLB7447.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/library/ACLB7449.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/library/ACLB7450.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				
			</tr>
		</tbody>
	</table>
	<table style="width: 1000px; height: 251px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/library/ACLB7451.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/library/ACLB7452.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/library/ACLB7453.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				
			</tr>
		</tbody>
	</table>


				

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
			<a href="{{route('vms.academic.news')}}"><i class="fa fa-trophy"></i> <span> News & Calendar </span></a>
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