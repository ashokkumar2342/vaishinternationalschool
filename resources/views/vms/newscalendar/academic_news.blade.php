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
<li class="breadcrumb-item"><a href="#">Academic News</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>ACADEMIC NEWS</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Academic News</h3>
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

	<h4>&nbsp; <strong><span style="color: #000000;"><a href="{{asset('images/Datesheet/DateSheet-July2017.jpg')}}" target="_blank" style="color: #000000;"><img src="{{asset('images/new-icon-animation.gif')}}" alt="new icon animation" width="48" height="48" /></a></span></strong><span style="text-decoration: underline;"><strong><span style="color: #800000;">POSITION HOLDERS OF SESSION 2017-18 </span></strong></span></h4>
	<p><span style="color: #0000ff;"><strong><span style="color: #000000;"><a href="{{asset('images/Datesheet/AnnualResultPossitionHolders-XI.pdf')}}" target="_blank" style="color: #0000ff;">STD. XI POSITION HOLDERS</a></span></strong></span></p>
	<p><span style="color: #800080;"><strong><a href="{{asset('images/Datesheet/AnnualResultPossitionHolders-IX.pdf')}}" target="_blank" style="color: #800080;">STD. IX POSITION HOLDERS</a></strong></span></p>
	<p><strong><span style="color: #800000;"><a href="{{asset('images/Datesheet/AnnualResultPossitionHolders-VIII.pdf')}}" target="_blank" style="color: #800000;">STD. VIII POSITION HOLDERS</a></span></strong></p>
	<p><strong><span style="color: #000000;"><a href="{{asset('images/Datesheet/AnnualResultPossitionHolders-VII.pdf')}}" target="_blank" style="color: #000000;">STD. VII POSITION HOLDERS</a></span></strong></p>
	<p><strong><span style="color: #000080;"><a href="{{asset('images/Datesheet/AnnualResultPossitionHolders-VI.pdf')}}" target="_blank" style="color: #000080;">STD. VI POSITION HOLDERS</a></span></strong></p>
	<p><strong><span style="color: #003300;"><a href="{{asset('images/Datesheet/AnnualResultPossitionHolderPrimaryWing.pdf')}}" target="_blank" style="color: #003300;">LIST OF POSITION HOLDERS - PRIMARY</a></span></strong></p>
	<p>&nbsp;</p>
	<ul>
		<li><strong>Gul Saneja and Sahil Gupta of 12th won IIIrd position at State Level Debate Competition held at Kaithal on 23rd April, 2019.</strong></li>
		<li><strong><span style="color: maroon;">Purti Mittal grabbed 1st position at State Level in Power Point Presentation held at Kaithal on 23rd April, 2019.</span></strong></li>
		<li><strong>II position at National Level ISFO Mathematics Olympaid was grabbed by Jayant Raghav of VI. Participated in International Olympiad at Singapore from 4th April to 7th April 2019.</strong></li>
		<li><strong><span style="color: maroon;">II Position at National Level English Debate Competition held at S.S Mody Vidya Vihar Jhunjhunu by winning a prize money of Rs. 11000/- by the students Gul Saneja and Mahak Shandilya.</span></strong></li>
		<li><strong>Four students got selected for National Level Katha Writers’ Workshop took place from 26-28th Dec, 2018 at Gurugram. </strong></li>
		<li><strong><span style="color: maroon;">Our students bagged first position at Senior and Junior State Levels Geet Gayan Partiyogita year 2018.</span></strong></li>
		<li><strong>Our team of Mohit and Sahil won All India Suryakaran Parikha Hindi Debate Competition held on 16th November 2018 at Birla School Pilani.</strong></li>
		<li><strong><span style="color: maroon;">In Junior group our team stood 1st at National Level in Anuvrat quiz and got 3rd position in group song competition in Chennai.</span></strong></li>
	</ul>
	<ul>
		<li style="text-align: justify;"><strong>Jubliliant Success of Vaish Model Shool at A.I.S.S.C.E - 2017</strong></li>
		<li style="text-align: justify;"><span style="color: #800000;"><strong>Nilesh Gupta Got First Position at National Level Commerce Talent Search Examination (CTSE 2016-17)</strong></span></li>
		<li style="text-align: justify;"><strong>20 Students got selected in JEE (Mains)-2017</strong></li>
		<li style="text-align: justify;"><span style="color: #800000;"><strong>Second Position at Padampat Singhania Memorial All India Science Quiz</strong></span></li>
		<li style="text-align: justify;"><strong>Second Position at All India Inter School Science Quiz at B.R.C.M. Bahal</strong></li>
		<li style="text-align: justify;"><strong><span style="color: #800000;">Junior Childern Science Congress Team represented Haryana at&nbsp; National level at Baranati Maharastra</span></strong></li>
	</ul>
	
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