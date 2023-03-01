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
<li class="breadcrumb-item"><a href="#">Senior Wing</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>Senior Wing</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
	<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Senior Wing</h3>
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
	<table border="0" style="width: 1000px;"><colgroup><col style="width: 117pt;" /> <col style="width: 230pt;" /> <col style="width: 242pt;" /> <col style="width: 174pt;" /> <col style="width: 129pt;" /> </colgroup>
		<tbody>
			<tr style="height: 15.75pt;">
				<td class="xl67" style="height: 15.75pt; width: 117pt; text-align: center;">
					<h4><strong>Sr. No.</strong></h4>
				</td>
				<td class="xl71" style="border-left: medium none; width: 230pt;">
					<h4><strong>Teacher Name</strong></h4>
				</td>
				<td class="xl71" style="border-left: medium none; width: 242pt;">
					<h4><strong>Qualifications</strong></h4>
				</td>
				<td class="xl71" style="border-left: medium none; width: 174pt;">
					<h4><strong>Designation</strong></h4>
				</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">1</td>
				<td class="xl64" style="border-top: medium none; border-left: medium none; width: 230pt;">SH.SHIV</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PRINCIPAL</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">2</td>
				<td class="xl64" style="border-top: medium none; border-left: medium none; width: 230pt;">Mrs. Promila Garg</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Com, B.Ed., M.Phil</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">3</td>
				<td class="xl64" style="border-top: medium none; border-left: medium none; width: 230pt;">Mrs. Mamta Singla</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">4</td>
				<td class="xl64" style="border-top: medium none; border-left: medium none; width: 230pt;">Mr. Manoj Bharatwal</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed., M.Phil</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">5</td>
				<td class="xl64" style="border-top: medium none; border-left: medium none; width: 230pt;">Mr. D.N. Sahu</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed., M.Phil</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">6</td>
				<td class="xl64" style="border-top: medium none; border-left: medium none; width: 230pt;">Mrs. Usha Garg</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed., M.Phil</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">7</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Sanju Vaidya</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed., M.Phil</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">8</td>
				<td class="xl64" style="border-top: medium none; border-left: medium none; width: 230pt;">Mrs. Urmila Aggarwal</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">9</td>
				<td class="xl64" style="border-top: medium none; border-left: medium none; width: 230pt;">Mr. Tarun Kumar</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., S.L.E.T.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">10</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Sunil Kumar</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">MCA, M.Phil</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">11</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Hari Prakash</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">12</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Poonam Tanwar</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">13</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Shobha Kumawat</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">14</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Naresh Kumar Sharma</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">15</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Deepak Jain</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">16</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Sanjay Chawla</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">17</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Rajesh Mittal</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">18</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Deepika</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A. B.Ed</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">19</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Ram Avtar Kaushik</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">20</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Neetu Jain</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">21</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Monika Sharma</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">B.Sc., MCA, MCS, PGDCA</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">22</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Jai Bhagwan</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">23</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Swati Dhingra</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">24</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Vinod Kumar&nbsp;</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">25</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Ashutosh Pant</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">26</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Nisha Bidani</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">MCA, MCS, B.Com.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">27</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Sushma Satti</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Com, B.Ed.</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">28</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Neetu</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc.,MCA</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">29</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Sarita Rani</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">30</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Manjeet Kumar</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">31</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Sombir</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., M.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">32</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Manju Acharya</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Com, M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">33</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Manju Bala</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">34</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs. Poonam Yadav</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">35</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Gaurav Kumar</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">36</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Shashi Bala</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A (Eng.), B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">37</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs Rekha Rani</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A (Hindi.), B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">38</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Ravita</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A, B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">39</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Poonam Rani</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">40</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Anita Devi</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">41</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Sunita Arora</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A, B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">42</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr Pawan Suman</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A, M.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">43</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr Bajrang Sharma</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">B.Sc., B.E.d</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">44</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Pushpa Rani</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc.,B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">45</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr Anant Kr</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">46</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr Mukesh Kr Chaubey</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A, B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">47</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Kumari Punam</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">B.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">48</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr Pawan Kr Arya</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">B.Sc.,B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">49</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Saroj Bala</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A, B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">50</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs Uma Kumari</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">51</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Renu Tayal</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">B.Sc.,B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">52</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Babli</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A, B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">53</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Manoj Kumar</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc.,B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">54</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr Sanjay Kumar</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">55</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Meenakshi</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A, B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">56</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms Niharika</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">57</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Sharma Jayshree</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A, B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">58</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Raj Bala</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">59</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Kamal Rani</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">TGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">60</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Rakesh Singh</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">PTI</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">61</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr Vikram</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Prabhakar in KATHAK Dance</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Dance Teacher</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">62</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs Chonika</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Tech.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">63</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs Harsh</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">64</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Kusum Lata</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A. B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">65</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mr. Ankur Malhan</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc. B.Ed</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">66</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Mrs.Vimla Sharma</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">67</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Manisha Shishodia</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">68</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Veena Darak</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">69</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Nirmal Devi</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., M.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">70</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Asha Mudgal</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">71</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Babli</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc. B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">72</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Sapna</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">73</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Mahak</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">B.A., D.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">74</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Suchitra</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">75</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Suman</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.A., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">76</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Sonia Valecha</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">M.Sc., B.Ed.</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">PGT</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">77</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Hema Vadhwa</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Others</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
			</tr>
			<tr style="height: 15.75pt;">
				<td class="xl68" style="height: 15.75pt; border-top: medium none; text-align: center;">78</td>
				<td class="xl65" style="border-top: medium none; border-left: medium none;">Ms. Kamlesh</td>
				<td class="xl69" style="border-top: medium none; border-left: medium none;">Wellness</td>
				<td class="xl66" style="border-top: medium none; border-left: medium none;">Wellness Teacher</td>
				<td class="xl70" style="border-top: medium none; border-left: medium none;">Senior</td>
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