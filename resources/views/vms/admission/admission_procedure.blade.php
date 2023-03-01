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
		<li class="">
			<a href="{{route('vms.admission.help.desk')}}" class="item-link close-panel"><span> Admissions Help Desk </span></a>
		</li>
		<li class="">
			<a href="{{route('vms.admission.procedure')}}" class="item-link close-panel"><span> Admissions Procedure </span></a>
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
<h3 class="inr-hd-bg">ADMISSION HELP DESK</h3>
<p><img src="{{asset('images/principal_img.jpg')}}" alt="VMS, Bhiwani - Principal" width="250" vspace="0" hspace="10"></p>
<ul>
	<li style="text-align: justify;">Admission in all the classes is based purely on performance in the previous class as well as in the admission test, subsequent interview of the candidate and personal interview with the parents. Therefore, parents are required to accompany their wards at the time of test as well as the time of their admission.&nbsp;</li>
</ul>
<ul style="text-align: justify;">
	<li>If a parent/guardian decides not to send his ward to the school after the fee has been deposited or the student fails to report within six days after admission ,his/her admission will be declared cancelled.</li>
</ul>
<ul style="text-align: justify;">
	<li>If a student fails to deposit fee and relevant document within three days from the date of declaration of the list of successful candidates for admission, his/her admission may be treated as cancelled.&nbsp;</li>
</ul>
<ul>
	<li style="text-align: justify;">If a parent decides not to send his child to the school after the fee has been deposited, the above mentioned amount will not be refunded in any case except the tuition fees-deposited in advance for more than the current month.</li>
</ul>
<h4>&nbsp;</h4>
<h4 style="text-align: justify;"><span style="color: #800000;"><strong>WHO CAN APPLY?</strong></span></h4>
<p>&nbsp;</p>
<ul style="text-align: justify;">
	<li>The minimum age for admission to Nursery (L.K.G) is 3+ years and so on for classes till 11th.</li>
</ul>
<ul style="text-align: justify;">
	<li>No Admission is made in classes 10th &amp; 12th.</li>
</ul>
<ul style="text-align: justify;">
	<li>A student appearing for A.I.S.S.E. (10th class Board Exam)from this school will be granted provisional admission to class XI in April &amp; his/her stream [Medical, Non-Medical, Commerce or Humanities (Arts) ] will be decided as per percentage decided by the school to be drawn on the basis of the cumulative performance of the student throughout the previous academic year(X class) including Pre-Board Examination if the student has not obtained the required percentage, he/she will be given a chance (only once) like the outside to appear in the admission test .The student will be granted required stream only when he/she qualifies this admission test.</li>
</ul>
<ul style="text-align: justify;">
	<li>The provisional admission will be regularized provided the student clears class X Board exam in five /six Subjects.</li>
</ul>
<ul style="text-align: justify;">
	<li>In case, the provisional admission is not regularized, the school will return the fee realized under the given heads only viz: building fund, Security, Annual Charges.</li>
</ul>
<p style="text-align: justify;">&nbsp;</p>
<h4><span style="color: #800000;"><strong>SUBJECTS FOR ADMISSION</strong></span></h4>
<table border="0" style="width: 934px; height: 662px;">
	<tbody>
		<tr style="height: 0.25in;">
			<td colspan="3" style="padding: 0in; height: 0.25in;"><span style="font-family: times new roman,times;"><b><span style="font-size: 12pt; color: #3d3d3d;">C. <span style="color: #0000ff;">VI to X STANDRAD</span></span></b></span></td>
		</tr>
		<tr style="height: 11.25pt;">
			<td>&nbsp;</td>
			<td colspan="2"><span style="color: #800000;"><strong>ACADEMIC - A&nbsp;</strong></span></td>
		</tr>
		<tr style="height: 33.75pt;">
			<td colspan="2">1. Language I-English&nbsp;<br /> 3. Mathematics&nbsp;<br /> 5. Social Science</td>
			<td>2. Language II -Hindi&nbsp;<br /> 4. Science&nbsp;<br /> 6. Sanskrit as Third Language / FIT</td>
		</tr>
		<tr style="height: 9.75pt;">
			<td style="padding: 0in; height: 9.75pt;"><span style="font-family: times new roman,times;"></span></td>
			<td style="width: 231pt; padding: 0in; height: 9.75pt;"><span style="font-family: times new roman,times;"></span></td>
			<td style="padding: 0in; height: 9.75pt;"><span style="font-family: times new roman,times;"></span></td>
		</tr>
		<tr style="height: 10px;">
			<td style="padding: 0in; height: 19.5pt;"><span style="font-family: times new roman,times;"></span></td>
			<td colspan="2"><strong><span style="color: #800000;">ACADEMIC - B</span></strong></td>
		</tr>
		<tr style="height: 0.5in;">
			<td colspan="2">1. Health &amp; Physical Education&nbsp;<br /> 3. Art Education</td>
			<td>2. Work Experience&nbsp;<br /> 4. Co- Scholastic Areas</td>
		</tr>
		<tr style="height: 8.25pt;">
			<td style="padding: 0in; height: 8.25pt;"><span style="font-family: times new roman,times;"></span></td>
			<td style="padding: 0in; height: 8.25pt;"><span style="font-family: times new roman,times;"></span></td>
			<td style="padding: 0in; height: 8.25pt;"><span style="font-family: times new roman,times;"></span></td>
		</tr>
		<tr style="height: 0.25in;">
			<td colspan="3" style="padding: 0in; height: 0.25in;">
				<table border="0" style="width: 1025px; height: 295px;">
					<tbody>
						<tr style="height: 20px;">
							<td colspan="3"><span style="color: #800000;"><strong>D. XI to XII STANDRAD</strong></span></td>
						</tr>
						<tr style="height: 10px;">
							<td style="width: 0.25in; padding: 0in; height: 21.75pt;"><strong><span style="font-size: 12pt; font-family: times new roman,times; color: #0000ff;"></span></strong></td>
							<td><strong>Stream / Faculty</strong></td>
							<td><strong>Subject-Combination</strong></td>
						</tr>
						<tr style="height: 67.5pt;">
							<td style="width: 0.25in; padding: 0in; height: 67.5pt;"><span style="font-size: 12pt; font-family: times new roman,times; color: #3d3d3d;"></span></td>
							<td>
								<p>Medical :-&nbsp;</p>
								<p>Non Medical :-</p>
								<p>Commerce :-&nbsp;</p>
								<p>Humanities :-&nbsp;</p>
							</td>
							<td>
								<p>English , Physics , Chemistry , Biology , Maths/Hindi/ Sanskrit&nbsp;</p>
								<p>English , Physics , Chemistry ,Maths ,Comp. Sci./ Hindi / Sanskrit</p>
								<p>English , Business Studies, Accountancy, Economics ,</p>
								<p>Maths / Hindi / Sanskrit /Comp. Science .</p>
								<p>English , Economics , Political Science, Geography,</p>
								<p>Hindi / Sanskrit / Mathematics</p>
							</td>
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