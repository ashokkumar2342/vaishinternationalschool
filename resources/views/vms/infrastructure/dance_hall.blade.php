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
<li class="breadcrumb-item"><a href="{{route('vms.index')}}">Home</a></li>  
<li class="breadcrumb-item"><a href="#">Dance Hall</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>DANCE HALL</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Dance Hall</h3>
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
						<a href="{{route('vms.student.life.academic')}}">News & Calendar</a>
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
 
<p style="text-align:justify;">Art & Craft room in the school to cater to the needs of different departments. It is beautifully designed and tastefully decorated with drawings, paintings, artefacts where students can express and have their artistic abilities.</p>
<p><img src="{{asset('images/vis/dance/ACLB7384.JPG')}}" alt="danceroom1" width="450" height="253" style="display: block; margin-left: auto; margin-right: auto;" /></p>


				

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