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
<li class="breadcrumb-item"><a href="#">Contact Us</a></li>  

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
<h2 class="pg-hd text-center wow fadeInDown"><span>Contact Us</span></h2>
</div>

<div class="col-md-9 content-dtl flex-first flex-md-unordered">
<table border="0" class="fontsty1 font16" style="width: 100%;" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="34%">
<p class="title nobg" style="margin: 3px 0px 0px;">POSTAL ADDRESS</p>
</td>
<td valign="top" width="6%">:</td>
<td valign="top" width="60%">
<p>Vaish Internationl School, Bhiwani</p>
<p>Near Railway Over Bridge, Devsar Chungi</p>
<p>Circular Road Bhiwani (Haryana)</p>
</td>
</tr>
<tr>
<td colspan="3" valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="top">
<p class="title nobg" style="margin: 3px 0px 0px;">TELEPHONE</p>
</td>
<td valign="top">:</td>
<td valign="top">+91-8168006945</td>
</tr>
<tr>
<td colspan="3" valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="top">
<p class="title nobg" style="margin: 3px 0px 0px;">EMAIL</p>
</td>
<td valign="top">:</td>
<td valign="top">visbhiwani@gmail.com</td>

</tr>
</tbody>
</table>
<p>&nbsp;</p>
<div class="col-lg-12">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3496.776540862295!2d76.12880921501255!3d28.78592428235756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391261da37705f83%3A0xfcf2d2edc1f3d8f6!2sVaish%20International%20School!5e0!3m2!1sen!2sin!4v1677731761294!5m2!1sen!2sin" width="100%" height="470" frameborder="0" allowfullscreen="allowfullscreen"></iframe>

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