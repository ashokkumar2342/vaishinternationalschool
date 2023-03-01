@extends('vms.main')
@section('main.container')
<main class="cd-main-content" id="fontSize"> 
	<!-- ========================= MAIN CONTENT ========================= -->
	<main class="cd-main-content" id="fontSize"> 
		<!-- Slider 1 Area Start Here -->
		<div class="slider1-area overlay-default">
			<div class="bend niceties preview-1">
				<div id="ensign-nivoslider-3" class="slides">
					<img src="{{asset('banner/vis/ACLB2372.JPG')}}" alt="BUILDING STRONG KNOWLEDGE ROOTS" title="#slider-direction-1" /> 
					<img src="{{asset('banner/vis/ACLB2454.JPG')}}" alt="Class Room" title="#slider-direction-2" /> 
					<img src="{{asset('banner/vis/ACLB2522.JPG')}}" alt="LEARNING EVERY MOMENT" title="#slider-direction-3" /> 
					<img src="{{asset('banner/vis/ACLB2532.JPG')}}" alt="DEDICATION" title="#slider-direction-4" /> 
					<img src="{{asset('banner/vis/ACLB2427.JPG')}}" alt="LEARNING WITH JOY" title="#slider-direction-5" /> 
				</div>
				<div id="slider-direction-1" class="t-cn slider-direction">
					<div class="slider-content s-tb slide-1">         
						<div class="title-container s-tb-c">
							<div class="slide-caption">
								<div class="title1">BUILDING STRONG KNOWLEDGE ROOTS</div>
								<p><p></p></p>
							</div>
						</div>
					</div>
				</div>
				<div id="slider-direction-2" class="t-cn slider-direction">
					<div class="slider-content s-tb slide-2">         
						<div class="title-container s-tb-c">
							<div class="slide-caption">
								<div class="title1">Class Room</div>
								<p><p></p></p>
							</div>
						</div>
					</div>
				</div>
				<div id="slider-direction-3" class="t-cn slider-direction">
					<div class="slider-content s-tb slide-3">         
						<div class="title-container s-tb-c">
							<div class="slide-caption">
								<div class="title1">LEARNING EVERY MOMENT</div>
								<p><p></p></p>
							</div>
						</div>
					</div>
				</div>
				<div id="slider-direction-4" class="t-cn slider-direction">
					<div class="slider-content s-tb slide-3">         
						<div class="title-container s-tb-c">
							<div class="slide-caption">
								<div class="title1">DEDICATION</div>
								<p><p></p></p>
							</div>
						</div>
					</div>
				</div>
				<div id="slider-direction-5" class="t-cn slider-direction">
					<div class="slider-content s-tb slide-3">         
						<div class="title-container s-tb-c">
							<div class="slide-caption">
								<div class="title1">Reception</div>
								<p><p></p></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center ms-pos"> 
				<a class="mouse-scroll scroll-to-anchor" style="color: #ffffff;" href="#overview">
					<div class="scroll-downs">
						<div class="mousey">
							<div class="scroller"></div>
						</div>
					</div>
				</a> 
			</div>
		</div>
<!-- Slider 1 Area End Here --> 
<!-- SECTION Overview ============================== -->
<section class="block-section overview" id="overview">
	<div class="container">
		<div class="row">
			<div class="col-md-9 abt-info pd-tb" >
				<div class="row">
					<div class="col-sm-12">
						<h2 class="wow fadeInDown"> About</h2>
						<h3 class="wow fadeInUp mb-4">Vaish Model Sr.Sec.School</h3>
					</div>
					<div class="col-sm-4"><div class="textwidget"><p class="wow fadeInUp fz16" style=" text-align: justify;visibility: visible; animation-name: fadeInUp;text-align: left;">Welcome to Vaish Model Sr.Sec.School. We are a school which specializes in all boys’ boarding education for pupils aged 12-18. The school is probably the only ‘All India’ school with applications from almost every state each year, as well as from Indian families overseas. Established in 1935, Vaish Model Sr.Sec.School is one of India’s finest schools, with a strong intellectual heartbeat.Vaish Model Sr.Sec.School is a full boarding school for boys only and not simply a school which welcomes boarders. The school’s beautiful seventy acre campus has a vast range of flora, fauna and bird life.</p>
						<p class="text-center" style="padding-top: 8%;"><a class="btn-ui btn-ui-ylw wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;" href="{{route('vms.abouts')}}"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
					</div>
				</div>
				<div class="col-sm-4 brdr-rt wow fadeInLeft">
					<div class="textwidget">
						<p>
							<a href="#" rel="noopener"><img class="img-full" src="{{asset('logo/logo.jpg')}}" alt="Boarding"></a>
						</p>
						<h5 class="mt-3 mb-3 txt-up">Vaish Model Sr.Sec.School United Nations Conference</h5>
						<p>Founded in 2007, Vaish Model Sr.Sec.School United Nations Conference is one of the largest student-run MUN in India, attracting students from across the nation and beyond. </p>
						<p class="text-center"><a class="btn-ui btn-ui-ylw wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;" href="#" rel="noopener noreferrer"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
					</div>
				</div>
				<div class="col-sm-4 wow fadeInRight">			
					<div class="textwidget"><p>
						<img class="img-full" src="{{asset('images/imagge.png')}}" alt="Leadership"></p>
						<h5 class="mt-3 mb-3 txt-up">So you want your son to study at Vaish Model Sr.Sec.School?</h5>
						<p>Here’s all you need to know…..</p>
						<p class="text-center" style="padding-top: 15%;"><a class="btn-ui btn-ui-ylw wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;" href="admissions/headmasters-presentation-for-prospective-parents/index.html"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
					</div>
				</div>            
			</div>
		</div>
		<div class="col-md-3 side-info pdlr0">
			<div class="textwidget">
				<ul class="stats-slider doon-home-stats-slider" style="width: auto; position: relative; transition-duration: 0s; transform: translate3d(0px, -597.167px, 0px);">
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
							</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
							</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
							</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
							</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
							</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
							</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
							</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
						</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
						</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
						</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
						</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
						</p>
						</div>
					</li>
					<li style="float: none; list-style: none; position: relative; width: 285px;" class="bx-clone">
						<div class="hvr-sweep-to-left">
							<h3>IBDP May 2022 Results</h3>
							<p>Approximately <span>77.5%</span> of the candidates have secured 36 points and above. </p>
							<p>Approximately <span>77.08%</span> of the total grades achieved by the candidates are 6 &#038; above.</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>IGCSE March 2022 Results</h3>
							<p><span>90%</span> of overall grades are A* to A</p>
						</p>
						</div>
						<div class="hvr-sweep-to-left">
							<h3>ISC 2021 Results</h3>
							<p><span>54%</span>  of the candidates scored <span>90%</span> and above</p>
							<p><span>96.5%</span> candidates scored <span>80%</span> and above</p>
						</p>
						</div>
					</li>
				</ul>
			</div> 
		</div>
	</div>
</div>
</section>  
<!-- End SECTION Overview ============================== --> 
<section class="block-section homepage-video-section vdo-co-wrap pd-tb blk-gray-bg" id="vdo-co">
	<div class="container">
		<div class="row">
			<div class="col-md-12 pd-tb custom-abt-info">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="wow fadeInUp mb-4">Life At Vaish</h3>
					</div>
				</div>
				<div class="video-carousel-home owl-carousel owl-theme popup-gallery">
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="https://www.youtube.com/watch?v=BnfplfHzHEQ">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/Academics-thumb.jpg')}}" alt="Card image" />
						</a>
						<div class="video-card-body">
							<h4 class="card-title">Academics</h4>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="video-card"><a class="video" title="This is a video" href="https://www.youtube.com/watch?v=GlwW1yW5CYM">
						<img class="card-img-top" style="width: 100%;" src="{{asset('images/Co-curriculars-thumb.jpg')}}" alt="Card image" /></a>
						<div class="video-card-body">
							<h4 class="card-title">Co-curriculars</h4>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="video-card"><a class="video" title="This is a video" href="https://www.youtube.com/watch?v=jWvyxuihUfU">
						<img class="card-img-top" style="width: 100%;" src="{{asset('images/Sports-thumb.jpg')}}" alt="Card image" /></a>
						<div class="video-card-body">
							<h4 class="card-title">Sports</h4>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="video-card"><a class="video" title="This is a video" href="https://www.youtube.com/watch?v=AMU9DD_nKNM">
						<img class="card-img-top" style="width: 100%;" src="{{asset('images/Main-Houses-thumb.jpg')}}" alt="Card image" /></a>
						<div class="video-card-body">
							<h4 class="card-title">Main houses</h4>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="video-card"><a class="video" title="This is a video" href="https://www.youtube.com/watch?v=IjDvnbqCJrk">
						<img class="card-img-top" style="width: 100%;" src="{{asset('images/Holding-Houses-thumb.jpg')}}" alt="Card image" /></a>
						<div class="video-card-body">
							<h4 class="card-title">Holding Houses</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<!-- SECTION News & Events ============================== -->
<section class="block-section news-wrap wht-bg pd-tb" id="news">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3 class="inr-hd txt-rd wow fadeInDown mb-3"> News <span>&amp;</span> Events</h3>
				<li id="text-14" class="widget widget_text">			<div class="textwidget"></div>
				</li>
			</div>
		</div>
		<div class="row lt-news mt-3">
			<article class="col-md-3 wow fadeInLeft hvr-sweep-to-top"  data-wow-delay=".6s">        
				<div class="nws-pic  nws-pic-tp">
					<img src="{{asset('images/latestphotos/DSC_3161.jpg')}}" alt="Welcome Dr. Jagpreet Singh" class="img-fluid">
				</div>
				<div class="nws-info hvr-sweep-to-top">
					<h5 class="m-tb-2"> 
						<a href="#">Vaish Model Sr.Sec.School Scholarship Entrance Exam- October 2nd, 2021</a>
					</h5>
					<p class="mb-3">
						Abhinandan.
					</p>
					<p class="text-center"><a href="#" class="btn-ui"  target="_blank">
						<span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
				</div>
			</article>

			<article class="col-md-3 wow fadeInLeft hvr-sweep-to-bottom" data-wow-delay=".3s">
				<div class="nws-info nws-info-tp">
					<h5 class="mb-3" style="padding-top: 40%"><a href="{{route('vms.news')}}" target="_blank">Annual Celebration</a></h5>
					<!--<p class="mb-3">Our boys and masters have been gainfully involved in many acitivites during the break from expeditions to summer schools, training camps and exchanges.</p>-->
					<p class="text-center"><a href="#" class="btn-ui" target="_blank"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
				</div>
				<div class="nws-pic"><img src="{{asset('images/latestphotos/DSC_3229.jpg')}} " alt="News" class="img-fluid"></div>
			</article>
			<article class="col-md-3 wow fadeInLeft hvr-sweep-to-top" data-wow-delay=".">        
				<div class="nws-pic  nws-pic-tp"><img src="{{asset('images/latestphotos/DSC_3250.jpg')}}" alt="Vaish Model Sr.Sec.School Weekly (Issue No. 2661)" class="img-fluid"></div>
				<div class="nws-info hvr-sweep-to-top">
					<h5 class="m-tb-2"> <a href="#">Celebrating Togetherness.
					<p class="text-center"><a href="#" class="btn-ui"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
				</div>
			</article>                        		           				   
			<article class="col-md-3 wow fadeInLeft hvr-sweep-to-bottom" data-wow-delay=".">
				<div class="nws-info nws-info-tp">
					<h5 class="mb-3" style="padding-top: 40%"><a href="#" target="_blank">Letest Event</a></h5>
					<p class="text-center"><a href="#" class="btn-ui" target="_blank"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
				</div>
				<div class="nws-pic"><img src="{{asset('images/latestphotos/DSC_3254.jpg')}}" alt="The Doon School Updates" class="img-fluid"></div>
			</article> 

			<article class="col-md-6 wow fadeInLeft hvr-sweep-to-left nws-art-left"  data-wow-delay=".6s">        
				<div class="nws-pic col-md-6  nws-pic-tp">
					<img src="{{asset('images/latestphotos/DSC_3266.jpg')}}" alt="University Destinations" class="img-fluid"></div>
					<div class="nws-info col-md-6 hvr-sweep-to-left">
						<h5 class="m-tb-2" style="padding-top: 40%; padding-left: 25px;"> <a href="#" target="_blank">University Destinations</a></h5>
						<!-- <p class="mb-3">The Doon School added yet another feather in its cap . The school was ranked as the number one  boy's boarding school in the country...</p> -->
						<p class="text-center"><a href="#" class="btn-ui"  target="_blank"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
					</div>
			</article>
			<article class="col-md-6 wow fadeInLeft hvr-sweep-to-left nws-art-left"  data-wow-delay=".6s">        
				<div class="nws-pic col-md-6  nws-pic-tp"><img src="{{asset('images/latestphotos/DSC_3278.jpg')}}" alt="Careers Bulletin" class="img-fluid"></div>
				<div class="nws-info col-md-6 hvr-sweep-to-left">

					<p class="mb-3 text-center" style="margin-top:110px;">Careers Bulletin</p>
					<p class="text-center"><a href="#" class="btn-ui"  target="_blank"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a></p>
				</div>
			</article>
		</div>
	</div>
</section>
<section class="block-section homepage-video-section vdo-co-wrap pd-tb blk-gray-bg" id="vdo-co">
	<div class="container">
		<div class="row">
			<div class="col-md-12 pd-tb custom-abt-info">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="wow fadeInUp mb-4">LATEST EVENT PHOTO'S</h3>
					</div>
				</div>
				<div class="video-carousel-home owl-carousel owl-theme popup-gallery">
					<div class="item">
						<div class="video-card">
							<a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3161.jpg')}}">
								<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3161.jpg')}}" alt="Card image" />
							</a>
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3229.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3229.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3250.jpg')}}" style="width: 100PX;">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3250.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3254.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3254.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3266.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3266.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3278.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3278.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3323.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3323.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3407.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3407.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3422.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3422.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3504.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3504.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3537.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3537.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3603.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3603.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3691.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3691.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3773.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3773.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3811.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3811.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3896.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3896.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3928.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3928.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_3972.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_3972.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
					<div class="item">
						<div class="video-card"><a class="video" title="This is a video" href="{{asset('images/latestphotos/DSC_4046.jpg')}}">
							<img class="card-img-top" style="width: 100%;" src="{{asset('images/latestphotos/DSC_4046.jpg')}}" alt="Card image" /></a>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End SECTION News & Events ============================== --> 
<!-- SECTION All School Videos and Co-curricular - Sense of community ============================== -->
<section class="block-section vdo-co-wrap pd-tb blk-bg" id="vdo-co">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h3 class="inr-hd wow fadeInDown">All School Video</h3>
					</div>
					<div class="col-sm-12 pos wow fadeInLeft vdo-poster">
						<img class="img-fluid" src="{{asset('images/vdo-poster.jpg')}}" alt="Poster"> 
						<div class="play-ico"><a href="#"><i class="fa fa-play"></i></a></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h3 class="inr-hd inr-hd-sm wow fadeInDown">From the Headmaster</h3>
						<p class="co-txt wow fadeInUp">Newsletters with updates and current information</p>
					</div>
					<div class="col-md-6 wht-bg txt-blk wow fadeInLeft"> 
						<p class="text-center " style="margin-top: 68%;">
							<a href="#" class="btn-ui wow fadeInUp"><span>Read Mor</span>e <i class="fa fa-angle-right"></i></a>
						</p> 
					</div>
					<div class="col-md-6 wow fadeInRightBig p-0">
						<img src="{{asset('images/newsletters.png')}}" alt="Sense of community" width="270px" height="400px">
					</div>
				</div>
			</div> 
		</div>
	</div>
</section>
<!-- End SECTION All School Videos and Co-curricular - Sense of community ============================== --> 
<!-- SECTION Partners ============================== -->
<section class="block-section partners-wrap pd-tb wht-bg" id="partners">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center" >
				<h3 class="inr-hd wow fadeInDown"> Our <span class="txt-rd">Partners</span></h3>
			</div>
		</div>
		<div class="speaker-wrap row m-tb-5">
			<div id="owl-speaker" class="owl-carousel">
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> 
							<img src="{{asset('logo/p1-1.jpg')}}" alt="CASE" /> 
						</div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> 
							<img src="{{asset('logo/p2-1.jpg')}}" alt="College Board" /> 
						</div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="{{asset('logo/p5-2.jpg')}}" alt="Indian Public School Conference" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="{{asset('logo/p9-2.jpg')}}" alt="HMC" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="{{asset('logo/p4-1.jpg')}}" alt="International Boys Schools Coalition" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="{{asset('logo/p6-1.jpg')}}" alt="BSA" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="{{asset('logo/p7-1.jpg')}}" alt="Round Square" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="{{asset('logo/p9-1.jpg')}}" alt="HMC Conference" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="{{asset('logo/p10-1.jpg')}}" alt="The International Award for Young People" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="wp-content/uploads/2019/03/oacaclogo.jpg" alt="OACAC" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="wp-content/uploads/2018/07/p8.jpg" alt="Cambridge IGCSE" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="wp-content/uploads/2018/07/p11.jpg" alt="WORLD SCHOOL" /> </div>
					</div>
				</div>
				<div class="item">
					<div class="feature_box">
						<div class="feature-icon"> <img src="wp-content/uploads/2018/07/p12.jpg" alt="FRSB" /> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End SECTION Partners ============================== --> 

<!-- FOOTER
===
===
=== === === === === === === === === === === === === === == -->
@endsection