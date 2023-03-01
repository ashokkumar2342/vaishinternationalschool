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
<li class="breadcrumb-item"><a href="#">Laboratories</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>Laboratories</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Laboratories</h3>
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
			<a href="{{route('vms.audio.visual.room')}}" class="item-link close-panel"><span> Auditorium </span></a>
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
	<h4 style="text-align: center;"><span style="color: #0000ff;"><strong>"Learning is a continuous process of trials, experimentation, observation, evaluation and deriving conclusions"</strong></span></h4>
	<p>&nbsp;</p>
	<p style="text-align: justify;">Science labs for physics, chemistry, biology and mathematics fully equipped with model charts, instruments, chemicals and apparatus required by students in senior secondary school, maintained by efficient lab staff members." Learning by doing" opportunities help students in reviewing and reinforcing scientific &amp; experimental concepts and developing investigative skills.</p>
	<h4>&nbsp;</h4>
	<h4><span style="color: #000000;"><strong>Bilogoy Lab</strong></span></h4>
	<table style="width: 1000px; height: 251px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/laboratories/ACLB2489.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB2492.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB2499.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
				
			</tr>
		</tbody>
	</table>
	<h4><span style="color: #000000;"><strong>Chemistry Lab<br /></strong></span></h4>
	<table style="width: 1000px; height: 241px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/laboratories/ACLB2496.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB2505.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB2511.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				
			</tr>
		</tbody>
	</table>
	<h4><span style="color: #000000;"><strong>&nbsp;Physics Lab</strong></span></h4>
	<table style="width: 1000px; height: 242px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/laboratories/ACLB2518.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB2522.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB2532.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
			</tr>
		</tbody>
	</table>
	<h4><span style="color: #000000;"><strong>&nbsp;Computer Lab</strong></span></h4>
	<table style="width: 1000px; height: 242px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/laboratories/ACLB7361.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB7363.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB7376.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				
			</tr>
		</tbody>
	</table>
	<table style="width: 1000px; height: 242px;">
		<tbody>
			<tr>
				<td><img src="{{asset('images/vis/laboratories/ACLB7370.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB7372.JPG')}}" alt="DSC 9258" width="300" height="200" /></td>
				<td><img src="{{asset('images/vis/laboratories/ACLB7378.JPG')}}" alt="DSC 9258" width="300" height="200" /></td> 
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