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
<li class="breadcrumb-item"><a href="../../index.html">Home</a></li>  
<li class="breadcrumb-item"><a href="../index.html">Co-curricular</a></li>  
<li class="breadcrumb-item active">Ethos</li>
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
<h2 class="pg-hd text-center wow fadeInDown"><span>Ethos</span></h2>
</div>
<div class="col-md-3 pg-sidebar wht-bg p-0">
<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown">Co-curricular</h3>
<ul class="pg-links">  
<li class=" active "><a href="index.html" class="item-link close-panel"><span> Ethos </span></a>
</li>
<li class="dropdown "><a href="../clubs-societies/index.html" class="item-link close-panel"><span> Clubs & Societies </span></a>
<i class="fa fa-minus"></i>
<ul class="sub-menu">
<li ><a href="../clubs-societies/the-astronomy-society/index.html" class="item-link close-panel" rel="the-astronomy-society"><span> The Astronomy Society </span></a></li> 
<li ><a href="../clubs-societies/hindi-debating-sr-bharat-bani/index.html" class="item-link close-panel" rel="hindi-debating-sr-bharat-bani"><span> Hindi Debating Sr (Bharat Bani) </span></a></li> 
<li ><a href="../clubs-societies/the-business-club/index.html" class="item-link close-panel" rel="the-business-club"><span> The Business Club </span></a></li> 
<li ><a href="../clubs-societies/english-debating-society-senior-and-junior/index.html" class="item-link close-panel" rel="english-debating-society-senior-and-junior"><span> English Debating Society (Senior and Junior) </span></a></li> 
<li ><a href="../clubs-societies/economics-society/index.html" class="item-link close-panel" rel="economics-society"><span> Economics Society </span></a></li> 
<li ><a href="../clubs-societies/scholars-cup/index.html" class="item-link close-panel" rel="scholars-cup"><span> Scholar's Cup </span></a></li> 
<li ><a href="../clubs-societies/the-final-cut-film-society/index.html" class="item-link close-panel" rel="the-final-cut-film-society"><span> The Final Cut (Film Society) </span></a></li> 
<li ><a href="../clubs-societies/history-society/index.html" class="item-link close-panel" rel="history-society"><span> The Historical Circle Association </span></a></li> 
<li ><a href="../clubs-societies/i-t-society/index.html" class="item-link close-panel" rel="i-t-society"><span> I. T. Society </span></a></li> 
<li ><a href="../clubs-societies/maths-colloquium-society-junior/index.html" class="item-link close-panel" rel="maths-colloquium-society-junior"><span> Maths Colloquium Society (Junior) </span></a></li> 
<li ><a href="../clubs-societies/maths-colloquium-society-senior/index.html" class="item-link close-panel" rel="maths-colloquium-society-senior"><span> Maths Colloquium Society (Senior) </span></a></li> 
<li ><a href="../clubs-societies/nature-club/index.html" class="item-link close-panel" rel="nature-club"><span> Nature Club </span></a></li> 
<li ><a href="../clubs-societies/the-doon-school-poetry-society/index.html" class="item-link close-panel" rel="the-doon-school-poetry-society"><span> The Doon School Poetry Society </span></a></li> 
<li ><a href="../clubs-societies/science-society/index.html" class="item-link close-panel" rel="science-society"><span> Science Society </span></a></li> 
<li ><a href="../clubs-societies/yuv-bharati/index.html" class="item-link close-panel" rel="yuv-bharati"><span> Yuv Bharati </span></a></li> 
<li ><a href="../clubs-societies/publications/index.html" class="item-link close-panel" rel="publications"><span> Publications </span></a></li> 
<li ><a href="../clubs-societies/infinity/index.html" class="item-link close-panel" rel="infinity"><span> Infinity </span></a></li> 
<li ><a href="../clubs-societies/srijan-prayas/index.html" class="item-link close-panel" rel="srijan-prayas"><span> Srijan Prayas </span></a></li> 
<li ><a href="../clubs-societies/the-echo/index.html" class="item-link close-panel" rel="the-echo"><span> The Echo </span></a></li> 
<li ><a href="../clubs-societies/the-econocrat/index.html" class="item-link close-panel" rel="the-econocrat"><span> The Econocrat </span></a></li> 
<li ><a href="../clubs-societies/the-circle/index.html" class="item-link close-panel" rel="the-circle"><span> The Circle </span></a></li> 
<li ><a href="../clubs-societies/the-doon-school-information-review/index.html" class="item-link close-panel" rel="the-doon-school-information-review"><span> The Doon School Information Review </span></a></li> 
<li ><a href="../clubs-societies/the-year-book/index.html" class="item-link close-panel" rel="the-year-book"><span> The Year Book </span></a></li> 
<li ><a href="../clubs-societies/quiz-society/index.html" class="item-link close-panel" rel="quiz-society"><span> Quiz Society </span></a></li> 
</ul>
</li>
<li class="dropdown "><a href="../stas-and-activities/index.html" class="item-link close-panel"><span> STA's and Activities </span></a>
<i class="fa fa-minus"></i>
<ul class="sub-menu">
<li ><a href="../stas-and-activities/adventure/index.html" class="item-link close-panel" rel="adventure"><span> Adventure </span></a></li> 
<li ><a href="../stas-and-activities/aero-modelling/index.html" class="item-link close-panel" rel="aero-modelling"><span> Aero Modelling </span></a></li> 
<li ><a href="../stas-and-activities/archive-management/index.html" class="item-link close-panel" rel="archive-management"><span> Archive Management </span></a></li> 
<li ><a href="../stas-and-activities/art/index.html" class="item-link close-panel" rel="art"><span> Art </span></a></li> 
<li ><a href="../stas-and-activities/audio-visual-squad/index.html" class="item-link close-panel" rel="audio-visual-squad"><span> Audio-Visual Squad </span></a></li> 
<li ><a href="../stas-and-activities/boys-bank-and-tuck-shop/index.html" class="item-link close-panel" rel="boys-bank-and-tuck-shop"><span> Boys Bank And Tuck Shop </span></a></li> 
<li ><a href="../stas-and-activities/computers/index.html" class="item-link close-panel" rel="computers"><span> Computers </span></a></li> 
<li ><a href="../stas-and-activities/chess/index.html" class="item-link close-panel" rel="chess"><span> Chess </span></a></li> 
<li ><a href="../stas-and-activities/cooking/index.html" class="item-link close-panel" rel="cooking"><span> Cooking </span></a></li> 
<li ><a href="../stas-and-activities/cycling/index.html" class="item-link close-panel" rel="cycling"><span> Cycling </span></a></li> 
<li ><a href="../stas-and-activities/design-and-technology/index.html" class="item-link close-panel" rel="design-and-technology"><span> Design and Technology </span></a></li> 
<li ><a href="../stas-and-activities/doon-stock-exchange/index.html" class="item-link close-panel" rel="doon-stock-exchange"><span> Doon Stock Exchange </span></a></li> 
<li ><a href="../stas-and-activities/electronics-and-robotics/index.html" class="item-link close-panel" rel="electronics-and-robotics"><span> Robotics </span></a></li> 
<li ><a href="../stas-and-activities/drama/index.html" class="item-link close-panel" rel="drama"><span> English Drama (Senior) </span></a></li> 
<li ><a href="../stas-and-activities/english-drama-junior/index.html" class="item-link close-panel" rel="english-drama-junior"><span> English Drama (Junior) </span></a></li> 
<li ><a href="../stas-and-activities/entertainment-committee/index.html" class="item-link close-panel" rel="entertainment-committee"><span> Entertainment Committee </span></a></li> 
<li ><a href="../stas-and-activities/ham-radio/index.html" class="item-link close-panel" rel="ham-radio"><span> HAM Radio </span></a></li> 
<li ><a href="../stas-and-activities/hindi-dramatics-senior/index.html" class="item-link close-panel" rel="hindi-dramatics-senior"><span> Hindi Dramatics (Senior) </span></a></li> 
<li ><a href="../stas-and-activities/hindi-dramatics-junior/index.html" class="item-link close-panel" rel="hindi-dramatics-junior"><span> Hindi Dramatics (Junior) </span></a></li> 
<li ><a href="../stas-and-activities/jr-chemist/index.html" class="item-link close-panel" rel="jr-chemist"><span> Jr. Chemist </span></a></li> 
<li ><a href="../stas-and-activities/motor-mechanics/index.html" class="item-link close-panel" rel="motor-mechanics"><span> Motor Mechanics </span></a></li> 
<li ><a href="../stas-and-activities/mun/index.html" class="item-link close-panel" rel="mun"><span> MUN </span></a></li> 
<li ><a href="../stas-and-activities/music/index.html" class="item-link close-panel" rel="music"><span> Music </span></a></li> 
<li ><a href="../stas-and-activities/iayp/index.html" class="item-link close-panel" rel="iayp"><span> IAYP </span></a></li> 
<li ><a href="../stas-and-activities/lamda/index.html" class="item-link close-panel" rel="lamda"><span> LAMDA </span></a></li> 
<li ><a href="../stas-and-activities/lost-property/index.html" class="item-link close-panel" rel="lost-property"><span> Lost Property </span></a></li> 
<li ><a href="../stas-and-activities/paper-recycling/index.html" class="item-link close-panel" rel="paper-recycling"><span> Paper Recycling </span></a></li> 
<li ><a href="../stas-and-activities/photography/index.html" class="item-link close-panel" rel="photography"><span> Photography </span></a></li> 
<li ><a href="../stas-and-activities/public-speakinghindi/index.html" class="item-link close-panel" rel="public-speakinghindi"><span> Public Speaking(Hindi) </span></a></li> 
<li ><a href="../stas-and-activities/rashtriya-life-saving-society-rlss/index.html" class="item-link close-panel" rel="rashtriya-life-saving-society-rlss"><span> Rashtriya Life Saving Society (RLSS) </span></a></li> 
<li ><a href="../stas-and-activities/student-exchange/index.html" class="item-link close-panel" rel="student-exchange"><span> Student Exchange </span></a></li> 
<li ><a href="../stas-and-activities/summer-schools/index.html" class="item-link close-panel" rel="summer-schools"><span> Summer Schools </span></a></li> 
<li ><a href="../stas-and-activities/stage-committee/index.html" class="item-link close-panel" rel="stage-committee"><span> Stage Committee </span></a></li> 
<li ><a href="../stas-and-activities/trophy-squad/index.html" class="item-link close-panel" rel="trophy-squad"><span> Trophy Squad </span></a></li> 
<li ><a href="../stas-and-activities/video-club/index.html" class="item-link close-panel" rel="video-club"><span> Video Club </span></a></li> 
<li ><a href="../stas-and-activities/weather-reporting/index.html" class="item-link close-panel" rel="weather-reporting"><span> Weather Reporting </span></a></li> 
<li ><a href="../stas-and-activities/yoga/index.html" class="item-link close-panel" rel="yoga"><span> Yoga </span></a></li> 
</ul>
</li>
<li class=""><a href="../leadership-training-at-the-doon-school/index.html" class="item-link close-panel"><span> Leadership Training at The Doon School </span></a>
</li>
<li class=""><a href="../social-service/index.html" class="item-link close-panel"><span> Social Service </span></a>
</li>
<li class=""><a href="../sport/index.html" class="item-link close-panel"><span> Sport </span></a>
</li>
<li class=""><a href="../trips-and-tours/index.html" class="item-link close-panel"><span> Trips and Tours </span></a>
</li>
</ul>
<div class="category-sidebar">			<div class="textwidget"><div class="category-sidebar">
<h3 class="pg-sb-hd text-center mb-3 pt-3 wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">News Categories</h3>
<ul>
<li class="cat-item cat-item-5 current-cat"><a href="{{route('vms.news')}}">All</a></li>
<li class="cat-item cat-item-27"><a href="{{route('vms.academic.life')}}">Academic</a></li>
<li class="cat-item cat-item-90"><a href="{{route('vms.alumni')}}">Alumni</a></li>
<li class="cat-item cat-item-99"><a href="{{route('vms.clubs.and.societies')}}">Clubs and Societies</a></li>
<li class="cat-item cat-item-23"><a href="{{route('vms.co.curricular')}}">Co-curricular</a></li>
<li class="cat-item cat-item-53"><a href="{{route('vms.events')}}">Events</a></li>
<li class="cat-item cat-item-94"><a href="{{route('vms.media')}}">Media</a></li>
<li class="cat-item cat-item-19"><a href="{{route('vms.sports')}}">Sport</a></li>
</ul>
</div>
</div>
</div></div>
<div class="col-md-9 content-dtl flex-first flex-md-unordered">
<p>Welcome to the The co-curricular part of the website. It has been prepared to show boys and parents what is offered as part of the curriculum at The Doon School. The co-curriculum programme is a wide and critically important part of the education offered to each boy at school. In the words of the Headmaster ‘It is all curriculum’. He uses this phrase to explain why there is as much learning out of the classroom as in it and that learning in and out of the classroom are infact, mutually dependent upon the other.</p>
<p>The school encourages boys joining in the D and C forms to develop their genuine interests and talents by getting involved with a wide range of activities and clubs on offer. By participating in these activities boys will be able to discover their interests, enjoy learning more about the activities and the skills required for these activities and, at the same time, they will make friends and have fun.</p>
<p>Once the boys realize where their interests lie, the school will support them to develop their interests and pursue their talents. Tutors and Housemasters guide the boys in making choices and also in managing time, which is an important factor to keep in mind while making decisions about what to focus upon. The vast majority of boys have never had the opportunity to experience the full education that is on offer at The Doon School. All new D and new C form boys and their parents will be able to attend the Co-Curricular Fair to be held each year so that they get a better idea of the co-curricular programme on offer and are able to make suitable decisions for their boys.</p>
<div class="clear"></div>
<hr style="margin: 50px 0;"/>
<div class="text-center">
<ul class="abt-links">  
<li><a href="index.html"><i class="fa fa-mortar-board"></i> <span> Ethos </span></a></li>
<li><a href="../clubs-societies/index.html"><i class="fa fa-building-o"></i> <span> Clubs & Societies </span></a></li>
<li><a href="../stas-and-activities/index.html"><i class="fa fa-bicycle"></i> <span> STA's and Activities </span></a></li>
<li><a href="../leadership-training-at-the-doon-school/index.html"><i class="fa fa-paper-plane-o"></i> <span> Leadership Training at The Doon School </span></a></li>
<li><a href="../social-service/index.html"><i class="fa fa-puzzle-piece"></i> <span> Social Service </span></a></li>
<li><a href="../sport/index.html"><i class="fa fa-soccer-ball-o"></i> <span> Sport </span></a></li>
<li><a href="../trips-and-tours/index.html"><i class="fa fa-bus"></i> <span> Trips and Tours </span></a></li>
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