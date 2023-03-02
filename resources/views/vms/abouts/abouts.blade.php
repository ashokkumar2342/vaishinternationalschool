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
<li class="breadcrumb-item"><a href="#">About Us</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>About Us</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">About Us</h3>
	<ul class="pg-links">  
		
		<li class="">
			<a href="{{route('vms.president.message')}}" class="item-link close-panel"><span> President's Message </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.general.secretary')}}" class="item-link close-panel"><span> General Secretary Message </span></a>
		</li>
		<li>
			<a href="{{route('vms.senior.wing')}}" class="item-link close-panel" rel="founders"><span>List of Member Committee</span></a>
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
<h4><strong><span style="font-size: 28pt;">Introduction</span></strong></h4>
	 
<p style="text-align: justify;"> 
The ambitious  Vaish International School, Bhiwani is the culmination of vision inspiration and zeal of worthy trustees of the Vaish Mahavidyalaya Trust, Bhiwani, Haryana. Vaish mahavidyalay Trust Bhiwani has taken one step forward by establishing Vaish International school as per international pattern having classes from Montessori (Nursery )to 8th during the academic session 2023-24. It would provide dynamic and flexible learning environment.
</p>

<h4><strong><span style="font-size: 28pt;">Concept &amp; Vision….</span></strong></h4>
<p style="text-align: justify;"><span style="line-height: 107%;">With a vision of cater to the needs of education for the global citizens and with the motto "Medium is English, While Culture is Indian." The school is determined to encourage our learners to discover their passion and decide their goal in life. The students of VIS (International Wing) will cherish their roots in the Indian value system and be global in their outlook and achievements</span></p>

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