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
<p style="text-align: justify;"><span style="line-height: 107%;">The ambitious VMS is the culmination of visio</span><span style="line-height: 107%;">n, inspiration and zeal of worthy trustees of the Vaish Mahavidyalaya Trust, Bhiwani. The idea of setting up such a model institution was first co</span><span style="line-height: 107%;">nceived in 1976. <b>Late Sh. Bhagirath Mal Buwaniwala Ji</b> acted like a beacon of light in collecting funds to start this institution. He, along with <b>Late Sh. Gauri Shankar Ji Bajaj</b></span><span style="line-height: 107%;">, who proved himself life and soul of the school, did a lot of spadework. As a result, it finally took concrete shape in 1980 when it made a modest debut in the educational sphere.</span><span style="line-height: 107%;"> </span></p>
<p style="text-align: justify;"><span style="line-height: 107%;">The foundation stone of the ambitious VMS was laid down in 1980 by the benevolent hands of prominent social worker, veteran leader, renowned freedom fighter, Member of Parliament and former Chief Minister of Haryana Late <b>Sh. BanarasiDass Ji Gupta</b>. </span></p>
<p style="text-align: justify;"><span style="line-height: 107%;">The school received its first affiliation to the Central Board of Secondary Education, New Delhi on April 01, 1991 and was further upgraded to the Senior Secondary level in April 1994. At present the caters to the need of approximately 4200 students in classes nursery to XII. The School has an exemplary record in academics with 27 batches of AISSE(X) and 24 batches of AISSCE (XII) passing out by 2019. During its journey of 39 years the school has established many milestones in all the academic, literary, co-scholastic areas and co-scholastic activities which have placed the institution at a prominent position in the entire region.</span></p>
<h4><strong><span style="font-size: 28pt; line-height: 107%; font-family: 'Brush Script MT';">Concept &amp; Vision….</span></strong></h4>
<p style="text-align: justify;"><span style="line-height: 107%;">The fundamental idea behind the establishment of the institute has been to build a sound system of human resource development by training and inculcating right values and skills in our children and provide a base for the entire gamut of educational system which the nation desires to evolve.</span></p>
<p style="text-align: justify;"><span style="line-height: 107%;">Here the modern concept of education blends smoothly with the ancient and the traditional. The integral values in physical, emotional, rational, aesthetic, ethical and spiritual education are developed apart from regular teaching.</span></p>
<p style="text-align: justify;"><span style="line-height: 107%;">Quality education, moral inheritance, mental stability, cool temperament and self discipline are stressed upon. An institution where the teacher and the student work together towards excellence in all spheres of life and the outlook is beyond examination with almost unlimited inputs aimed at the development of the total personality of the students. An open sky is provided to each and every student keeping in view that every child is a star waiting to shine and rise.</span></p>

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