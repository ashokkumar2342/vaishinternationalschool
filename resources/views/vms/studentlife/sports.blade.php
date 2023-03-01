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
<li class="breadcrumb-item"><a href="#">Sports</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>SPORTS</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Sports</h3>
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
<div class="col-md-9 content-dtl flex-first flex-md-unordered">
<h3 class="grid4 fLeft" style="text-align: center;"><strong><span style="color: #ff6600;">"If you train hard, you'll not only be hard, you'll be hard to 'beat'."</span></strong></h3>
<p>&nbsp;</p>
<table style="width: 1000px; height: 251px;">
	<tbody>
		<tr>
			<td><img src="{{asset('images/vis/sports/ACLB2399.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2400.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2401.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			
		</tr>
	</tbody>
</table>
<table style="width: 1000px; height: 251px;">
	<tbody>
		<tr>
			<td><img src="{{asset('images/vis/sports/ACLB2402.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2403.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2409.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			
		</tr>
	</tbody>
</table>
<table style="width: 1000px; height: 251px;">
	<tbody>
		<tr>
			<td><img src="{{asset('images/vis/sports/ACLB2405.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2406.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			<td><img src="{{asset('images/vis/sports/ACLB2407.JPG')}}" alt="SKPS2238" width="300" height="200" /></td>
			
		</tr>
	</tbody>
</table>
<table style="width: 100%; height: 325px;">
<tbody>
<tr>
<td style="text-align: justify;">
<p>Physical fitness is an essential element in the development of overall personality of a child. Sports provide an outlet to the development and experssion of the physical self of&nbsp; a students. The school provides a matrix of intra and inter-school sports activities. The students are encouraged to specialize in a sport, according to their inclination and also based on the suggestions of the expert physical Education Teacher. However, the boys are encouraged to play inter-house tournaments and participate in other sports, to promote all-rounder sportsmen. This emphasis also instills team spirit skills for life beyond the school days, and a wider appreciation of sport in general. <br class="blank" /><br class="blank" /> The students regularly represent The Vaish Model Sr. Sec. School teams at District, State, National and International Level and achieve top positions.</p>
<table style="width: 610px; height: 121px;">
<tbody>
<tr>
<td>&nbsp;Athletics</td>
<td>Cricket</td>
</tr>
<tr>
<td>Basketball</td>
<td>Football</td>
</tr>
<tr>
<td>Volleyball</td>
<td>Chess</td>
</tr>
<tr>
<td>Badminton</td>
<td>Carrom</td>
</tr>
<tr>
<td>Martial Arts</td>
<td>Table Tennis</td>
</tr>
</tbody>
</table>
</td>

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