// JavaScript Document
$(document).ready(function (e) {

//Navigation Menu Slider
	$('#nav-expander').on('click', function (e) {
		e.preventDefault();
		$('body').toggleClass('nav-expanded');
	});
	$('#nav-close').on('click', function (e) {
		e.preventDefault();
		$('body').removeClass('nav-expanded');
	});	
	/**** Top to bottom link script ****/
	$('.top-nav li a, .mouse-scroll, .skipContent').on('click', function (event) {
		var $anchor = $(this);
		$('html, body').animate({
			scrollTop: $($anchor.attr('href')).offset().top + "px"
		}, 1000);
		event.preventDefault();
	});	
	
	$(".modal").on("hidden.bs.modal", function () {
		$iframe = $(this).find("iframe"), $iframe.attr("src", $iframe.attr("src"));
		$('body').css('padding-right', '0');
	});
	
	$('#nav-expander').click(function(){
		$('.home-nav-2 .main-nav').slideToggle();
	});
	

	/**** Top to bottom arrow ****/
	$('.up').click(function () {
		$('html, body').animate({
			scrollTop: '0px'
		}, 1000);
	});
	
	/*** Book validation ***/
	if($("form#applicationform").length > 0) {
		//alert('helo');
	$.validator.addMethod("alphaRegex", function(value, element) {
		return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
	}, "It must contain only letters");
	
 	$.validator.addMethod('filesize', function(value, element, param) {
		return this.optional(element) || (element.files[0].size <= param) 
	}); 
	
	$.validator.addMethod("myEmail", function(value, element) {
		return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
	}, 'Please enter valid email address.');
		
		$("#applicationform").validate({ 
			/* ignore: [], */
			rules: {
				'firstname': {
					required: true,
					alphaRegex: true
				},'middlename': {
						alphaRegex: true
				},
				'familyname': {
					required: true,
					alphaRegex: true
				},
				'dateofbirth': {
					required: true
				},
				'presentschool': {
					required: true
				},
				'academicstrength': {
					required: true
				},
				'fathername': {
					required: true,
					alphaRegex: true
				},
				'fathermob': {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 13
				},
				'fatheremail': {
					myEmail: true,
				},
				'mothername': {
					required: true,
					alphaRegex: true
				},
				'mothermob': {
					digits: true,
					minlength: 10,
					maxlength: 13
				},
				'motheremail': {
					myEmail: true
				},
				'permanentaddress': {
					required: true
				},
				'permtelephone': {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 13
				},
				'refer1': {
					required: true
				},
				'refer2': {
					required: true
				},
				'studentname1': {
					alphaRegex: true
				},
				'studentname2': {
					alphaRegex: true
				},
				'parent_signature': {
					required: true,
					filesize:300000
				}, 
				'signame': {
					required: true,
					alphaRegex: true
				},
				'boyrelation': {
					required: true
				},
				'formdate': {
					required: true
				},
				'doc_birth': {
					required: true
					//filesize:300000
				},'doc_payment': {
					required: true
					//filesize:300000
				}
			},
			messages: {
				'firstname': {
					required: "Please enter first name."
				},
				'familyname': {
					required: "Please enter family name."
				},
				'dateofbirth': {
					required: "Please select date of birth."
				},
				'presentschool': {
					required: "Please enter present school details."
				},
				'academicstrength': {
					required: "Please enter academic strength."
				},
				'fathername': {
					required: "Please enter father's name."
				},
				'fathermob': {
					required: "Please enter father's mobile."
				},
				'mothername': {
					required: "Please enter mother's name."
				},
				'permanentaddress': {
					required: "Please enter permanent address."
				},
				'permtelephone': {
					required: "Please enter permanent telephone."
				},
				'refer1': {
					required: "Please enter referees 1 details."
				},
				'refer2': {
					required: "Please enter referees 2 details."
				},
			 'parent_signature': {
					required: "Please upload signature.",
					filesize: 'Size must be smaller than 300 KB'
			}, 
				'signame': {
					required: "Please enter name."
				},
				'boyrelation': {
					required: "Please enter relationship to boy."
				},
				'formdate': {
					required: "Please enter date."
				}, 
				'doc_birth': {
					required: "Please upload child\'s birth certificate."
					//filesize: 'Size must be smaller than 300 KB'
			} ,'doc_payment': {
					required: "Please upload payment receipt."
					//filesize: 'Size must be smaller than 300 KB'
			}
			}
		});
	}
});

$(window).scroll(function () {
	var scrollTop = $(window).scrollTop();
	if (scrollTop > 30) {
		$('.up').fadeIn(400);		
	} else {
		$('.up').fadeOut(400);		
	}
	
	if (scrollTop > 10) {		
		$(".pg-progressbarcontainer").addClass("fixed");
	} else {		
		$(".pg-progressbarcontainer").removeClass("fixed");
	}
	
});

// Dtae time on header
/*     var d = new Date();
    var n = d.toUTCString();
    document.getElementById("dts").innerHTML = n; */


$('#tabContents h5 a').click(function(){
	$("#tabContents h5").addClass('active').siblings().removeClass('active')	
});

function offerStrip(){
	
	// $('.doon-offerStrip a').each(function(){
		// console.log($(this));
		if($('.curr-offer').hasClass('curr-offer')){
			var currOffer = $('.curr-offer');
			// console.log($('.curr-offer'));
			if(currOffer.next().length > 0){
				
				currOffer.next().addClass('curr-offer');
				currOffer.removeClass('curr-offer');
			}
			else{
				
				currOffer.removeClass('curr-offer');
				$('.doon-offerStrip a:first').addClass('curr-offer');
			}
		}
	// });
}

setInterval(function(){ offerStrip(); }, 4000);
