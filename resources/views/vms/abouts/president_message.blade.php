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
<li class="breadcrumb-item"><a href="#">PRESIDENT'S MESSAGE</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>PRESIDENT'S MESSAGE</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">PRESIDENT'S MESSAGE</h3>
	<ul class="pg-links">  
		<li class="">
			<a href="{{route('vms.president.message')}}" class="item-link close-panel"><span> President's Message </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.general.secretary')}}" class="item-link close-panel"><span> General secretary's Message </span></a>
		</li> 
		<li>
			<a href="{{route('vms.senior.wing')}}" class="item-link close-panel" rel="founders"><span>List of Member in Managing Commitee</span></a>
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
<p><img src="{{asset('images/vis/Shivrattanji.jpg')}}" alt="Shiv Rattan g" width="300" height="300" style="display: block; margin-left: auto; margin-right: auto;" /></p>
<p style="text-align: justify;">It fills me with great thrill to announce the opening of our brand new school! This state-of-the-art facility will provide our students with a modern and stimulating learning environment that will help them reach their full potential. With cutting-edge technology, spacious classrooms, and a dedicated team of educators, our students will have access to the best resources available. The only motive behind opening the new institute is to work together to give our children the education they deserve and build a brighter future for all.” </p>
<p style="text-align: justify;">I strongly believe in Marshal Goldsmith’s ideology:</p>
<p style="text-align: justify;">“What brought you here wont’ get you there”. It suggests that the skills or strategies that have led to one’s current success may not be sufficient for achieving future goals or reaching new levels of success. It is a reminder that in order to continue to grow and evolve one must be open to learning new skills and adapting to new ways of thinking. It is also a call to action, to not become complacent with the current success and always strive to improve and evolve.</p>
<p style="text-align: justify;">Today I am filled with hope for the future of education in our community. We are facing unprecedented challenges in our world today and it more important now than ever that we provide our children with the best possible education. I am confident that by working together, we can create a brighter future for our children. We must strive to provide an education that not only focuses on academic achievement, but also nurtures, cultural values, creativity, critical thinking and a sense of social responsibility. We must also work to bridge the gap between the education that is provided in the classroom and the skills that are required in the real world. </p>
<p style="text-align: justify;">My heartfelt wishes to all for a better and enlightening future. </p>
<h4>&nbsp;</h4>
<h4><strong><span style="font-size: 11pt; line-height: 107%; font-family: 'Calibri', 'sans-serif';">-Shiv Rattan Gupta</span> <br /></strong></h4>

	

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