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
<li class="breadcrumb-item"><a href="#">Managing Committee</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>Managing Committee</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Managing Committee</h3>
	<ul class="pg-links">  
		<li class="">
			<a href="{{route('vms.president.message')}}" class="item-link close-panel"><span> President's Message </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.general.secretary')}}" class="item-link close-panel"><span> General Secretary Message </span></a>
		</li>
		<li>
			<a href="{{route('vms.senior.wing')}}" class="item-link close-panel" rel="founders"><span>Managing Committee</span></a>
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
	<p><strong>List of Member Committee</strong></p>
<table style="width: 100%;" border="1">
<tbody>
<tr>
<td width="226">
<p><strong>Name</strong></p>
</td>
<td width="135">
<p><strong>Qualification</strong></p>
</td>
<td width="112">
<p><strong>Profession</strong></p>
</td>
<td width="127">
<p><strong>Designation</strong></p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. SHIVRATTAN GUPTA</p>
</td>
<td width="135">
<p>B.COM, LLB</p>
</td>
<td width="112">
<p>ADVOCATE</p>
</td>
<td width="127">
<p>PRESIDENT</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. AJAY GUPTA</p>
</td>
<td width="135">
<p>B.COM</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>VICE PRESIDENT</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. PAWAN KUMAR GUPTA</p>
</td>
<td width="135">
<p>B.COM</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>GEN. SECRETARY</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. PURSHTOM DAS AGGARWAL</p>
</td>
<td width="135">
<p>UNER GRADUATE</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TREASURER</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. HARICHARAN GARG</p>
</td>
<td width="135">
<p>GRADUATE</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. BHOLA SHANKAR MUKIM</p>
</td>
<td width="135">
<p>B.COM</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. RISHI KUMAR GOEL</p>
</td>
<td width="135">
<p>B.A.</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. VIJAY KISHAN AGGARWAL</p>
</td>
<td width="135">
<p>UNDER GRADUATE</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. DHARAM CHAND AGGARWAL</p>
</td>
<td width="135">
<p>B.COM</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. RAJENDER AGGARWAL</p>
</td>
<td width="135">
<p>GRADUATE</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. RAVI BHUSHAN SUGLA</p>
</td>
<td width="135">
<p>GRADUATE</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. SURESH KUMAR GUPTA</p>
</td>
<td width="135">
<p>B.COM, LLB</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. BRIJ LAL SARAF</p>
</td>
<td width="135">
<p>MATRIC</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. GHANSHYAM DASS GARG</p>
</td>
<td width="135">
<p>BA</p>
</td>
<td width="112">
<p>SOCIAL SERVICE</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SH. ANURAG GOYAL</p>
</td>
<td width="135">
<p>B.COM</p>
</td>
<td width="112">
<p>BUSINESS</p>
</td>
<td width="127">
<p>TRUSTEE</p>
</td>
</tr>
<tr>
<td width="226">
<p>SMT. KAMLA GUREJA</p>
</td>
<td width="135">
<p>M.A., B.ED</p>
</td>
<td width="112">
<p>EDUCATIONIST</p>
</td>
<td width="127">
<p>MEMBER</p>
</td>
</tr>
<tr>
<td width="226">
<p>SMT. MAMTA GARG</p>
</td>
<td width="135">
<p>M.A., B.ED</p>
</td>
<td width="112">
<p>EDUCATIONIST</p>
</td>
<td width="127">
<p>MEMBER</p>
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