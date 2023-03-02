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
<li class="breadcrumb-item"><a href="#">General Secretary Message</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>GENERAL SECRETARY'S</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Message from the Desk of General Secretary </h3>
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
<p><img src="{{asset('images/vis/PawanBuwaniwalaji.jpg')}}" alt="brij lal saraf" width="300" height="300" style="display: block; margin-left: auto; margin-right: auto;" />&nbsp;</p>
<p style="text-align: justify;"><b>"Success comes to those who <br> work hard and stays with those <br> who don't rest on the laurels of the past."
</b></p>
<p style="text-indent: 0in; text-align: justify;">I am immensely pleased to announce the opening of a new school at par with International Standards. Today, children of India are going in a more challenging and demanding environment. We thus have to recognize the need for a globally relevant education. In all our endeavours the focus is to strengthen competencies needed to be autonomous and responsible global citizens.</p>
<p style="text-indent: 0in; text-align: justify;">We make concerted efforts for the holistic development of the students who enter the school portals by providing a platform to showcase their inborn talents. We emphasize art, music, dance, drama, sports and numerous other aspects of experiential education to help young people develop their true potential and pursue their inclinations and interests. The school offers state-of-the-art laboratories, classrooms with multimedia projectors, spacious and updated library, spacious playgrounds, reception halls, lush green lawns and much more. We endeavour to provide conducive environment to inculcate the values of life in students and to motivate them to achieve higher peaks of excellence. We are committed in taking constructive and purposeful actions to produce optimistic, independent, compassionate life-long learners and leaders who will bring glory to the school, state and the Nation.</p>
<p style="text-indent: 0in; text-align: justify;">I believe that with active participation and sincere involvement of the parents along with the faculty of school will, surely be able to carry out its mission with commitment and bring forth a brighter and more vibrant tomorrow, in the years to come.</p>
<p style="text-align: justify;">&nbsp;</p>
<h5 style="text-indent: 0in;"><strong>- Pawan Buwaniwala</strong></h5>

	

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