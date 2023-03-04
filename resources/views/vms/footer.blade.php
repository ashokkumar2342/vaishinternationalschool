<footer class="page-section footer blk-bg">
<div class="container">
<div class="row">
<div class="textwidget"><div class="col-md-2"> <a href="{{route('vms.index')}}" title="The Doon School"><img src="{{asset('logo/logo1.jpeg')}}" alt="Logo"></a> </div>
</div>
<div class="col-md-4">			<div class="textwidget"><h5>Address</h5>
<address>Vaish Internationl School, Bhiwani Near Railway Over Bridge, Devsar Chungi, Circular Road Bhiwani (Haryana)</p>

<p>Email: <a href="cdn-cgi/l/email-protection.html#670e090108270308080914040f08080b4904080a"><span class="__cf_email__" data-cfemail="5831363e37183c3737362b3b30373734763b3735">[ visbhiwani@gmail.com ]</span></a></p>
<p>For all admissions enquiries,</p>
<p>Please contact <a href="cdn-cgi/l/email-protection.html#6a0b0e07031919030504192a0e05050419090205050644090507"><span class="__cf_email__" data-cfemail="4726232a2e34342e282934072328282934242f28282b6924282a">[ visbhiwani@gmail.com ]</span></a> or</p>
<p>Telephone – <a href="tel:1352526406">+91-8168006945</a> </p>
<p><!--or
<p>Mobile: <a href="tel:9719638840">+91 9719638840</a></p>
--></p>
<div></div>
</address>
</div>
</div>			
<div class="col-md-6">
<h5>Useful Links</h5>
<div class="menu-footer-menu-container">
	<ul id="footer" class="inr-links">
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
<div class="row text-center">
<p class="divider"></p>
<div class="col-sm-12 text-center">			<div class="textwidget"><div class="textwidget">
<div>
<ul class="inr-links">
<li class="brdr-nn">© Vaish International School, Bhiwani {{date('Y')}}. All rights reserved.</li>
<li><a href="#">Disclaimer</a></li>
<li><a href="#">Privacy policy</a></li>
<li><a href="#">Sitemap</a></li>
<li><a href="#">Jobs at Vaish</a></li>
</ul>
</div>
<div class="ftr-btm">
<p>The Vaish International School website has been designed by Vaish Internationl School in conjunction with 
<p><b>Disclaimer :</b> Vaish Internationl School, bhiwani is not affiliated and/or associated, directly or indirectly with any other school and/or educational institute using the word Vaish as a part of its name.</p>

</div>
</div>
</div>
</div>		</div>
</div>
</footer>
<!-- ACROLL TO TOP
===
===
=== === === === === === === === === === === === === === == -->
<a href = "javascript:;" class = "up hvr-icon-bob"> </a> </main>
</div>
<!-- JAVASCRIPT
===
===
=== === === === === === === === === === === === === === == -->
<script src="{{asset('vms/wp-content/themes/doon/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/bootstrap.min.js')}}"></script>
<!-- Animation SCRIPTS  --> 
<script src="{{asset('vms/wp-content/themes/doon/assets/js/wow.js')}}"></script>
<script>
wow = new WOW( {
animateClass: 'animated',
offset: 100,
callback: function ( box ) {
console.log( "WOW: animating <" + box.tagName.toLowerCase() + ">" )
}
} );
wow.init();
</script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/jquery.bxslider.js')}}"></script>
<script>
$( document ).ready( function ( e ) {
$( '#ensign-nivoslider-3' ).nivoSlider( {
effect: 'fade',
slices: 15,
boxCols: 8,
boxRows: 4,
animSpeed: 500,
pauseTime: 5000,
startSlide: 0,
directionNav: true,
controlNavThumbs: true,
pauseOnHover: true,
manualAdvance: false
} );
$(".stats-slider").bxSlider({
auto: !1,
pager: !1,
controls: !0,
mode: "vertical"
});
$(".stats-slider-mb").bxSlider({
auto: !1,
pager: !1,
controls: !1,
mode: "horizontal"		
});
$( "#owl-speaker" ).owlCarousel( {
navigation: true,
pagination: false,
autoPlay: 5000,
items: 4,
itemsDesktop: [ 1199, 3 ],
itemsTabletSmall: [ 768, 2 ],
itemsMobile: [ 480, 1 ],
navigationText: [ "<i class='fa fa-2x fa-long-arrow-left'></i>", "<i class='fa fa-2x fa-long-arrow-right'></i>" ]
} );
// pawan rana code start
var videosli = $('.video-carousel');  
videosli.owlCarousel({
autoplay:true,
autoplayTimeout:5000,
navigation: true,
loop:true,
pagination: false,
items: 3,
margin: 20,
itemsDesktop: [ 1199, 3 ],
itemsTabletSmall: [ 768, 2 ],
itemsMobile: [ 480, 1 ],
navigationText: [ "<i class='fa fa-2x fa-long-arrow-left'></i>", "<i class='fa fa-2x fa-long-arrow-right'></i>" ]
} );
var videosli = $('.video-carousel-home');  
videosli.owlCarousel({
autoplay:true,
autoplayTimeout:5000,
navigation: true,
loop:true,
pagination: false,
items: 4,
margin: 20,
itemsDesktop: [ 1199, 3 ],
itemsTabletSmall: [ 768, 2 ],
itemsMobile: [ 480, 1 ],
navigationText: [ "<i class='fa fa-2x fa-long-arrow-left'></i>", "<i class='fa fa-2x fa-long-arrow-right'></i>" ]
} );		
jQuery(document).ready(function() {
jQuery('.popup-gallery').magnificPopup({
delegate: 'a',
type: 'image',
callbacks: {
elementParse: function(item) {
// Function will fire for each target element
// "item.el" is a target DOM element (if present)
// "item.src" is a source that you may modify
console.log(item.el.context.className);
if(item.el.context.className == 'video') {
item.type = 'iframe',
item.iframe = {
patterns: {
youtube: {
index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
id: 'v=', // String that splits URL in a two parts, second part should be %id%
// Or null - full URL will be returned
// Or a function that should return %id%, for example:
// id: function(url) { return 'parsed id'; } 
src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
},
vimeo: {
index: 'vimeo.com/',
id: '/',
src: '//player.vimeo.com/video/%id%?autoplay=1'
},
gmaps: {
index: '//maps.google.',
src: '%id%&output=embed'
}
}
}
} else {
item.type = 'image',
item.tLoading = 'Loading image #%curr%...',
item.mainClass = 'mfp-img-mobile',
item.image = {
tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
}
}
}
},
gallery: {
enabled: true,
navigateByImgClick: true,
preload: [0,1] // Will preload 0 - before current, and 1 after the current image
}
});
});
// pawan rana code end	
$( ".pg-links > li.dropdown" ).click( function () {
$(this).toggleClass('active').siblings().removeClass('active');			
} );
$( ".pg-links li.dropdown > i" ).click( function ( e ) {
e.preventDefault();
if ( !$( this ).hasClass( "selected" ) ) {
$( '.pg-links li.dropdown i' ).removeClass( "selected" );
$( this ).addClass( "selected" );
$( ".pg-links .sub-menu" ).hide( 'slow' );
$( this ).parent().find( "ul" ).stop().slideToggle( 'slow' );			
} else {
$( this ).parent().find( "ul" ).stop().slideToggle( 'slow' );
}
});
$( ".pg-links li li.active" ).each( function () {				
$(this).parent().parent().addClass('active').siblings().removeClass('active');
$(this).parent().stop().slideToggle( 'slow' );			
});
$( '.country-accord' ).on( 'show.bs.collapse', function () {
$( '.country-accord .in' ).collapse( 'hide' );
});		
var $active = $('.country-accord .card-body.in').prev().addClass('active');
$active.find('a').prepend('<i class="fa fa-minus"></i>');
$('.country-accord .card-header').not($active).find('a').prepend('<i class="fa fa-plus"></i>');
$('.country-accord').on('show.bs.collapse', function (e) {
$('.country-accord .card-header.active').removeClass('active').find('.fa').toggleClass('fa-plus fa-minus');
$(e.target).prev().addClass('active').find('.fa').toggleClass('fa-plus fa-minus');
});
});
// Page progress bar
$(window).load(function(){
$(window).scroll(function() {
var wintop = $(window).scrollTop(), docheight = $(".page-wrap-full").height(), winheight = $(window).height();
// console.log(wintop);
var totalScroll = (wintop/(docheight-winheight))*100;
console.log("total scroll" + totalScroll);
$(".pg-progressbar").css("width",totalScroll+"%");
});
});
</script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/nivo.js')}}"></script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/font-size.js')}}"></script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/custom.js')}}"></script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/isotope.pkgd.js')}}"></script>
<script src="{{asset('vms/wp-content/themes/doon/assets/js/jquery.magnific-popup.js')}}"></script>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
location = 'dsse-next-steps/index.html';
}, false );
</script>


<link rel="stylesheet" type="text/css" href="{{asset('vms/wp-content/cache/wpfc-minified/9j1calj4/2roez.css')}}" media="all"/>
<script type='text/javascript' src='{{asset('vms/wp-includes/js/dist/vendor/wp-polyfill.min89b1.js?ver=7.4.4')}}' id='wp-polyfill-js'></script>
<script type='text/javascript' id='wp-polyfill-js-after'>
( 'fetch' in window ) || document.write( '<script src="wp-includes/js/dist/vendor/wp-polyfill-fetch.min6e0e.js?ver=3.0.0"></scr' + 'ipt>' );( document.contains ) || document.write( '<script src="wp-includes/js/dist/vendor/wp-polyfill-node-contains.min2e00.js?ver=3.42.0"></scr' + 'ipt>' );( window.DOMRect ) || document.write( '<script src="wp-includes/js/dist/vendor/wp-polyfill-dom-rect.min2e00.js?ver=3.42.0"></scr' + 'ipt>' );( window.URL && window.URL.prototype && window.URLSearchParams ) || document.write( '<script src="wp-includes/js/dist/vendor/wp-polyfill-url.min5aed.js?ver=3.6.4"></scr' + 'ipt>' );( window.FormData && window.FormData.prototype.keys ) || document.write( '<script src="wp-includes/js/dist/vendor/wp-polyfill-formdata.mine9bd.js?ver=3.0.12"></scr' + 'ipt>' );( Element.prototype.matches && Element.prototype.closest ) || document.write( '<script src="wp-includes/js/dist/vendor/wp-polyfill-element-closest.min4c56.js?ver=2.0.2"></scr' + 'ipt>' );( 'objectFit' in document.documentElement.style ) || document.write( '<script src="wp-includes/js/dist/vendor/wp-polyfill-object-fit.min531b.js?ver=2.3.4"></scr' + 'ipt>' );
</script>
<script type='text/javascript' id='contact-form-7-js-extra'>
/* <![CDATA[ */
var wpcf7 = {"api":{"root":"https:\/\/www.doonschool.com\/wp-json\/","namespace":"contact-form-7\/v1"}};
/* ]]> */
</script>
<script type='text/javascript' src='{{asset('vms/wp-content/plugins/contact-form-7/includes/js/index5406.js?ver=5.5.6')}}' id='contact-form-7-js'></script>
<script type='text/javascript' id='twentyseventeen-skip-link-focus-fix-js-extra'>
/* <![CDATA[ */
var twentyseventeenScreenReaderText = {"quote":"<svg class=\"icon icon-quote-right\" aria-hidden=\"true\" role=\"img\"> <use href=\"#icon-quote-right\" xlink:href=\"#icon-quote-right\"><\/use> <\/svg>","expand":"Expand child menu","collapse":"Collapse child menu","icon":"<svg class=\"icon icon-angle-down\" aria-hidden=\"true\" role=\"img\"> <use href=\"#icon-angle-down\" xlink:href=\"#icon-angle-down\"><\/use> <span class=\"svg-fallback icon-angle-down\"><\/span><\/svg>"};
/* ]]> */
</script>
<script type='text/javascript' src="{{asset('vms/wp-content/themes/doon/assets/js/skip-link-focus-fix5152.js?ver=1.0')}}" id='twentyseventeen-skip-link-focus-fix-js'></script>
<script type='text/javascript' src="{{asset('vms/wp-content/themes/doon/assets/js/navigation5152.js?ver=1.0')}}" id='twentyseventeen-navigation-js'></script>
<script type='text/javascript' src="{{asset('vms/wp-content/themes/doon/assets/js/global5152.js?ver=1.0')}}" id='twentyseventeen-global-js'></script>
<script type='text/javascript' src="{{asset('vms/wp-content/themes/doon/assets/js/jquery.scrollTo431f.js?ver=2.1.2')}}" id='jquery-scrollto-js'></script>

<script type='text/javascript' src="{{asset('vms/wp-content/plugins/gallery-plugin/js/frontend_scriptd988.js')}}" id='jquery-scrollto-js'></script>
<script type='text/javascript' src="{{asset('vms/wp-content/plugins/gallery-plugin/fancybox/jquery.fancybox.min68b3.js')}}" id='jquery-scrollto-js'></script>

{{-- <script type='text/javascript' src='https://www.doonschool.com/wp-content/plugins/gallery-plugin/js/frontend_script.js?ver=5.7.8' id='gllr_js-js'></script>
<script type='text/javascript' src='https://www.doonschool.com/wp-content/plugins/gallery-plugin/fancybox/jquery.fancybox.min.js?ver=1' id='bws_fancybox-js'></script> --}}


<script type='text/javascript' src="{{asset('vms/wp-content/plugins/cf7-conditional-fields/js/scriptsde92.js?ver=2.2.9')}}" id='wpcf7cf-scripts-js'></script>
<script type='text/javascript' src="{{asset('vms/wp-includes/js/wp-embed.mind988.js?ver=5.7.8')}}" id='wp-embed-js'></script>
<script type='text/javascript' id='gllr_enable_lightbox_ios-js-after'>
( function( $ ){
$( document ).ready( function() {
$( '#fancybox-overlay' ).css( {
'width' : $( document ).width()
} );
} );
} )( jQuery );
</script>
<!-- End Document
===
===
=== === === === === === === === === === === === === === == -->
<script>
jQuery(document).ready(function(){
jQuery(function () {
jQuery('.panel-group').on('shown.bs.collapse', function (e) {
var offset = jQuery(this).find('.collapse.in').prev('.panel-heading');
if(offset) {
jQuery('html,body').animate({
scrollTop: jQuery(offset).offset().top -6
}, 500);
e.stopPropagation();
}
});
jQuery('.panel-collapse').on('hidden.bs.collapse', function () {
// find the children and close them
jQuery(this).find('.collapse.in').collapse('hide');
});
});
});
</script>     
</body> 
<!-- Mirrored from www.doonschool.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Dec 2022 12:07:59 GMT -->
</html><!-- WP Fastest Cache file was created in 1.2104461193085 seconds, on 26-12-22 12:13:12 --><!-- via php -->