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
<li class="breadcrumb-item"><a href="#">alumni</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>WELCOME VMS ALUMNI</span></h2>
</div>

<div class="col-md-9 content-dtl flex-first flex-md-unordered">
	<table style="margin-left: auto; margin-right: auto; width: 1085px; height: 778px;">
		<tbody>
			<tr style="text-align: center;">
				<td><img src="{{asset('images/alumni/rashmikedia.jpg')}}" alt="rashmikedia" width="150" height="146" /></td>
				<td>
					<h5><strong><span style="color: #800000;">Rashmi Kedia</span></strong></h5>
					<p>CA</p>
					<p>Reina Consulting Llp</p>
				</td>
				<td><img src="{{asset('images/alumni/dr._vibha_bhardwaj.jpg')}}" alt="dr. vibha bhardwaj" width="150" height="150" /></td>
				<td>
					<h5><strong><span style="color: #800000;">Dr Vibha Bhardwaj</span></strong></h5>
					<p>Additional Director</p>
					<p>Genetic Engg. &amp; Biotechnolog</p>
					<p>Argentina</p>
				</td>
				<td><img src="{{asset('images/alumni/Devashish.jpg')}}" alt="Devashish" width="150" height="150" /></td>
				<td>
					<h5><strong><span style="color: #800000;">Devashish</span></strong></h5>
					<p>IIT Bombay</p>
					<p>General Manager</p>
					<p>Task bob</p>
				</td>
			</tr>
			<tr>
				<td><img src="{{asset('images/alumni/ankit.jpg')}}" alt="ankit" width="150" height="150" /></td>
				<td>
					<h5><span style="color: #800000;"><strong>Dr Ankit Aggarwal</strong></span></h5>
					<p>IAS</p>
					<p>Asstt. Commissioner</p>
					<p>Income Tax</p>
					<p>Min. of Finance</p>
				</td>
				<td><img src="{{asset('images/alumni/pooja_mbbs_rohtak.jpg')}}" alt="pooja mbbs rohtak" width="150" height="150" /></td>
				<td>
					<h5><strong><span style="color: #800000;">Dr Pooja</span></strong></h5>
					<p>MBBS</p>
					<p>PGIMS, Rohtak</p>
					<p>PG (Radiology)</p>
					<p>RM Lohia Hospital</p>
				</td>
				<td><img src="{{asset('images/alumni/Sachin.jpg')}}" alt="Sachin" width="150" height="150" /></td>
				<td>
					<h5><strong><span style="color: #800000;">Dr Sachin Bansal</span></strong></h5>
					<p>MBBS, MD</p>
					<p>Guru Teg Bahadur Hospital</p>
					<p>Delhi</p>
				</td>
			</tr>
			<tr>
				<td><img src="{{asset('images/alumni/n_k_gupta.jpg')}}" alt="n k gupta" width="150" height="150" /></td>
				<td>
					<h5><strong><span style="color: #800000;">Manish Gupta</span></strong></h5>
					<p>IAS</p>
					<p>Asstt. Commissioner</p>
					<p>Deptt. of Revenue</p>
					<p>Ministry of Finance</p>
				</td>
				<td><img src="{{asset('images/alumni/bhawna.jpg')}}" alt="bhawna" width="150" height="150" /></td>
				<td>
					<h5><span style="color: #800000;"><strong>Dr Bhawna</strong></span></h5>
					<p>MBBS</p>
					<p>PGIMS</p>
				</td>
				<td><img src="{{asset('images/alumni/Ruby_Mittal.jpg')}}" alt="Ruby Mittal" width="150" height="150" /></td>
				<td>
					<h5><span style="color: #800000;"><strong>Rubby Mittal</strong></span></h5>
					<p>Pursuing M.Sc.(Economics)</p>
					<p>Oxford University</p>
					<p>England</p>
				</td>
			</tr>
			<tr>
				<td><img src="{{asset('images/alumni/sudeep.jpg')}}" alt="sudeep" width="200" height="100" /></td>
				<td>
					<h5><span style="color: #800000;"><strong>Sandeep Pilpia</strong></span></h5>
					<p>Sub. Lieutenant</p>
					<p>Merchant Navy</p>
					<p>Pune</p>
				</td>
				<td><img src="{{asset('images/alumni/Yash_Mittal.jpg')}}" alt="Yash Mittal" width="150" height="150" /></td>
				<td>
					<h5><span style="color: #800000;"><strong>Yash Mittal</strong></span></h5>
					<p>Pursuing BS</p>
					<p>Bucknell University</p>
					<p>USA</p>
				</td>
				<td><img src="{{asset('images/alumni/vivek.jpg')}}" alt="vivek" width="150" height="150" /></td>
				<td>
					<h5><span style="color: #800000;"><strong>Vivek Sharma</strong></span></h5>
					<p>CA</p>
					<p>Investment Banking Analyst</p>
				</td>
			</tr>
		</tbody>
	</table> 
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