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
<li class="breadcrumb-item"><a href="#">Celebration News</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>CELEBRATION NEWS</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Celebration News</h3>
	<ul class="pg-links">  
		<li class="">
			<a href="{{route('vms.academic.news')}}" class="item-link close-panel"><span> Academic News </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.celebration.news')}}" class="item-link close-panel"><span> Celebration News </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.sports.news')}}" class="item-link close-panel"><span> Sports News </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.co.curricular.news')}}" class="item-link close-panel"><span> Co-Curricular News </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.news.letters.magazines')}}" class="item-link close-panel"><span> News Letters & Magazines </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.calendar.events')}}" class="item-link close-panel"><span> Calendar & Events </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.archives')}}" class="item-link close-panel"><span> Archives </span></a>
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
					<li class="cat-item cat-item-23">
						<a href="{{route('vms.alumni')}}">Alumni</a>
					</li>
					<li class="cat-item cat-item-53">
						<a href="{{route('vms.contacts')}}">Contact Us</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="col-md-9 content-dtl flex-first flex-md-unordered">
<p>INFORMATION AND PHOTOS OF CELEBRATION NEWS</p>
	
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
		<li>
			<a href="{{route('vms.alumni')}}"><i class="fa fa-user"></i> <span> Alumni </span></a>
		</li>
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