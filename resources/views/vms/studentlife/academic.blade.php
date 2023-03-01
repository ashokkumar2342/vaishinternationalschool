@extends('vms.main')
@section('main.container')
<main class="cd-main-content" id="fontSize"> 
<!-- MAIN CONTENT
================================================== -->
<div class="top-banner wow fadeInDown"> 
<img src="{{asset('images/vis/academic/ACLB2456.JPG')}}" alt="Top banner" class="img-fluid"> 	
</div>
<!-- Breadcrumb ============================== -->
<section class="breadcrumb-wrap wht-bg" >
<div class="container">
<div class="row">
<div class="col-sm-12">
<ol class="breadcrumb bg-nn wow fadeInLeft">
<li class="breadcrumb-item"><a href="{{route('vms.index')}}">Home</a></li>  
<li class="breadcrumb-item"><a href="#">Academics</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>ACADEMICS</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Academics</h3>
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
<p><img src="{{asset('images/vis/academic/ACLB2460.JPG')}}" alt="SKPS2188" width="450" height="300" style="display: block; margin-left: auto; margin-right: auto;" /></p>
<p><strong>Foundation Begins (Montessori Classes)</strong></p>
<p><strong>&nbsp;</strong></p>
<p>We are introducing Montessori Classes first time in Bhiwani at the Pre-Primery Level, educational programme based on Montessori philosophy and methods are being followed. We have well-equipped Training Halls, where the tiny tots learn in our informal way with the help of specially designed apparatus under the supervision and guidance of trained and experienced teachers.</p>
<p>&nbsp;</p>
<p><strong>Optimism Nurtured (Class I to V)</strong></p>
<p><strong>&nbsp;</strong></p>
<p>Students of classes I to V are introduced to a viable academics and the vibrant world learning beyond the classroom. They will be provided the basics of the academics without even making them realize that they are being taught. Here, they will just love the process of learning.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>Aspirations to Learn (Classes VI to IX)</strong></p>
<p>&nbsp;</p>
<p>With the love for extensive learning in primary classes, the students in classes VI to IX are exposed to a variety of dreams. besides the academic subjects students will be encouraged to participate in creative arts such as dance, music and craft.</p>





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