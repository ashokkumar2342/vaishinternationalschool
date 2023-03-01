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
<li class="breadcrumb-item"><a href="#">Admissions Procedure</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>ADMISSION PROCEDURE</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Admissions Procedure</h3>
	<ul class="pg-links">  
		{{-- <li class="">
			<a href="{{route('vms.admission.help.desk')}}" class="item-link close-panel"><span> Admissions Help Desk </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.admission.procedure')}}" class="item-link close-panel"><span> Admissions Procedure </span></a>
		</li> --}}
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
<h3 class="inr-hd-bg">Registration Form</h3>
<p><img src="{{asset('images/principal_img.jpg')}}" alt="VMS, Bhiwani - Principal" width="250" vspace="0" hspace="10"></p>

<p>Note :: Prospectus/Registration Fee Will Be Deposit ₹1000 At The Time Of Submission of This Form.</p>
<p><span><strong><a href="{{asset('registration_form/vis_regis_form.pdf')}}" class="btn btn-primary" target="_blank" style="color: #fff;">Download Registration Form</a></strong></span></p>
<p><strong>Fee Structure for Session</strong></p>
<p>&nbsp;</p>
<p><strong>Monthly Fee</strong></p>
<table style="width:100%" border="1">
<tbody>
<tr>
<td width="150">
<p><strong>Class</strong></p>
</td>
<td width="114">
<p><strong>Tuition Fee</strong></p>
</td>
<td width="227">
<p><strong>Charges for Amenities &amp; Facilities</strong></p>
</td>
<td width="110">
<p><strong>Total</strong></p>
</td>
</tr>
<tr>
<td width="150">
<p>Nur &amp; K.G.</p>
</td>
<td width="114">
<p>1030</p>
</td>
<td width="227">
<p>420</p>
</td>
<td width="110">
<p>1450</p>
</td>
</tr>
<tr>
<td width="150">
<p>I to V</p>
</td>
<td width="114">
<p>1430</p>
</td>
<td width="227">
<p>470</p>
</td>
<td width="110">
<p>1900</p>
</td>
</tr>
<tr>
<td width="150">
<p>VI to VIII</p>
</td>
<td width="114">
<p>1580</p>
</td>
<td width="227">
<p>520</p>
</td>
<td width="110">
<p>2100</p>
</td>
</tr>
<tr>
<td width="150">
<p>IX onward</p>
</td>
<td width="114">
<p>1820</p>
</td>
<td width="227">
<p>480</p>
</td>
<td width="110">
<p>2300</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><strong>At the time of Admission</strong></p>
<table style="width:100%" border="1">
<tbody>
<tr>
<td width="200">
<p>Registration Fee</p>
</td>
<td width="200">
<p>300</p>
</td>
<td width="200">
<p>(For new Student)</p>
</td>
</tr>
<tr>
<td width="200">
<p>Admission Fee</p>
</td>
<td width="200">
<p>1200</p>
</td>
<td width="200">
<p>(For new Student)</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><strong>Annual Charges</strong></p>
<table style="width:100%" border="1">
<tbody>
<tr>
<td width="200">
<p>Nur &amp; K.G.</p>
</td>
<td width="200">
<p>6500</p>
</td>
<td rowspan="4" width="200">
<p>&nbsp;</p>
<p>(For new Student)</p>
</td>
</tr>
<tr>
<td width="200">
<p>I to V</p>
</td>
<td width="200">
<p>7500</p>
</td>
</tr>
<tr>
<td width="200">
<p>VI to VIII</p>
</td>
<td width="200">
<p>9000</p>
</td>
</tr>
<tr>
<td width="200">
<p>IX onward</p>
</td>
<td width="200">
<p>10000</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="width:100%" border="1">
<tbody>
<tr>
<td width="236">
<p>Building Fund</p>
</td>
<td width="85">
<p>1200</p>
</td>
<td width="280">
<p>[(For New Student (Refundable)]</p>
</td>
</tr>
<tr>
<td width="236">
<p>Security</p>
</td>
<td width="85">
<p>500</p>
</td>
<td width="280">
<p>[(For New Student (Refundable)]</p>
</td>
</tr>
<tr>
<td width="236">
<p>Van Charges</p>
</td>
<td width="85">
<p>800</p>
</td>
<td width="280">
<p>(Per Month)</p>
</td>
</tr>
<tr>
<td width="236">
<p>Brother / Sister Concession</p>
</td>
<td width="85">
<p>150</p>
</td>
<td width="280">
<p>(Per Exam for All Students)</p>
</td>
</tr>
<tr>
<td width="236">
<p>Exam (Nur. &ndash; K.G.)</p>
</td>
<td width="85">
<p>100</p>
</td>
<td width="280">
<p>(Per Exam for All Students)</p>
</td>
</tr>
<tr>
<td width="236">
<p>I to VIII</p>
</td>
<td width="85">
<p>150</p>
</td>
<td width="280">
<p>(Per Exam for All Students)</p>
</td>
</tr>
<tr>
<td width="236">
<p>(IX)</p>
</td>
<td width="85">
<p>200</p>
</td>
<td width="280">
<p>(Per Exam for All Students)</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><strong>Summary</strong></p>
<table style="width:100%" border="1">
<tbody>
<tr>
<td width="200">
<p><strong>Class</strong></p>
</td>
<td width="200">
<p><strong>For New Student</strong></p>
</td>
<td width="200">
<p><strong>For Our Own Students</strong></p>
</td>
</tr>
<tr>
<td width="200">
<p>Nur &amp; K.G.</p>
</td>
<td width="200">
<p>11150</p>
</td>
<td width="200">
<p>9150</p>
</td>
</tr>
<tr>
<td width="200">
<p>I to V</p>
</td>
<td width="200">
<p>12600</p>
</td>
<td width="200">
<p>10600</p>
</td>
</tr>
<tr>
<td width="200">
<p>VI to VIII</p>
</td>
<td width="200">
<p>14300</p>
</td>
<td width="200">
<p>12300</p>
</td>
</tr>
<tr>
<td width="200">
<p>IX</p>
</td>
<td width="200">
<p>15500</p>
</td>
<td width="200">
<p>13500</p>
</td>
</tr>
</tbody>
</table>
<p><strong>&nbsp;</strong></p>
<p><strong>Note: 5% Concession will be granted to the parents paying annual fees instead of monthly fees. </strong></p>





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