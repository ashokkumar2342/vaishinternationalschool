@extends('vms.main')
@section('main.container')
<main class="cd-main-content" id="fontSize"> 
<!-- MAIN CONTENT
================================================== -->
<div class="top-banner wow fadeInDown"> 
<img src="{{asset('images/vis/cocurriculer/ACLB7401.JPG')}}" alt="Top banner" class="img-fluid"> 	
</div>
<!-- Breadcrumb ============================== -->
<section class="breadcrumb-wrap wht-bg" >
<div class="container">
<div class="row">
<div class="col-sm-12">
<ol class="breadcrumb bg-nn wow fadeInLeft">
<li class="breadcrumb-item"><a href="{{route('vms.index')}}">Home</a></li>  
<li class="breadcrumb-item"><a href="#">Co-Curricular Activities</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>CO-CURRICULAR ACTIVITIES</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Co-Curricular Activities</h3>
	<ul class="pg-links">  
		<li class="">
			<a href="{{route('vms.admission.help.desk')}}" class="item-link close-panel"><span> Academics </span></a>
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
<p><img src="{{asset('images/vis/cocurriculer/ACLB7402.JPG')}}" alt="SKPS2095" width="450" height="300" style="display: block; margin-left: auto; margin-right: auto;" /></p>
<p style="text-align: justify;">The school stresses to inculcate in young minds a sense of self-respect, pride, love and dedication to country. It tries to develop a tripolar process of&nbsp;3Hs, i.e. Head, Heart and Hand, <strong>among students, teachers and parents</strong>. The citizens of tomorrow are taught the ordinary traits of character&nbsp;like<strong> honesty, self confidence, co-operation, diligence, leadership and responsibility through Co-curricular activities.</strong></p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">Debates, quiz contests and useful excursions are some of the&nbsp;<strong>cultural as well as educational activities organized by school time to time</strong>.&nbsp;The school also promotes hobbies like&nbsp;<strong>Yoga, Music, Dancing, Drawing,&nbsp;Craft, Painting etc</strong>.</p>
<p style="text-align: justify;">The school provides facilities for both indoor and outdoor games to promote healthy spirit of competition.</p>



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