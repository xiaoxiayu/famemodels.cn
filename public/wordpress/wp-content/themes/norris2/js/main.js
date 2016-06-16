/* Table of Contents
--------------------------------------------------------------------------------------
1. Functions
2. Sticky Header
3. Twitter
4. Fitvids
5. Autosize
6. Scroll up
7. Mobile Nav
8. Scrollto
9. Blog Slider
10. Colorbox
11. Parallax
12. Header Slider
13. Fullscreen Slider

*/
(function($) {
"use strict";
var WITHEMES = WITHEMES || {};

/* 1 Functions
--------------------------------------------------------------------------------------------- */
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

/* 2 Sticky Header
--------------------------------------------------------------------------------------------- */
WITHEMES.sticky = function(){
	if ( $().sticky ) {
		var topSpacing;
		if ( $('body').hasClass('admin-bar') ) {
			topSpacing = 28;
		} else {
			topSpacing = 0;
			}
		$('.wi-onepage #wi-header, .header-always-stick #wi-header').sticky({topSpacing:topSpacing});
	}; // if sticky exists
};	// sticky

/* Superfish
--------------------------------------------------------------------------------------------- */
WITHEMES.superfish = function(){
	if ( $().superfish ) {
						
		var sf = $('#wi-mainnav > .menu');// alert( $('body').outerWidth() );
			sf.superfish({
				animation	:   {opacity:'show',height:'show'},
				speed		:   'fast',
				disableHI	:	false,
				cssArrows	:	true,
				onInit		:	function(){
									$(this).find('.sf-with-ul').append('<u class="indicator"><u></u></u>');
								},
											   });
		
		if (matchMedia('only screen and (max-width: 979px)').matches) {
			sf.superfish('destroy');
		}
		
		$(window).resize(function(){
			if (matchMedia('only screen and (max-width: 979px)').matches) {
				sf.superfish('destroy');
			} else {
				sf.superfish({
				animation	:   {opacity:'show',height:'show'},
				speed		:   'fast',
				disableHI	:	false,
				cssArrows	:	true
							 }); // superfish
				}				  
								  });
			
		
	} // if superfish	
} // function

/* 3 Twitter
--------------------------------------------------------------------------------------------- */
WITHEMES.twitter = function(){
	if ( $().tweet ) {
		$('.latest-tweets').each(function(){
			var $this = $(this);
			$this.tweet({
				username: $this.data('username'),
				join_text: "",
				avatar_size: 48,
				count: $this.data('number'),
				auto_join_text_default: "we said,", 
				auto_join_text_ed: "we",
				auto_join_text_ing: "we were",
				auto_join_text_reply: "we replied to",
				auto_join_text_url: "we were checking out",
				loading_text: "loading tweets...",
				modpath: $this.data('modpath'),			
			});	// tweet
		if ( $().flexslider )	{
		$this.flexslider({
			selector: ".tweet_list > li",
			animation		:	$this.data('effect'),
			pauseOnHover	:	true,
			useCSS			:	false,
			animationSpeed	:	600,
			slideshowSpeed	:	5000,
			controlNav		:	false,
			directionNav	:	$this.data('navi'),
			slideshow		:	$this.data('auto'),
			prevText		:	'<i class="icon-angle-left"></i>',
			nextText		:	'<i class="icon-angle-right"></i>',
			smoothHeight	:	true,
						 });
		}	// if flexslider
										  });	// each
	} // if
};	// twitter

/* 4 Fitvids
--------------------------------------------------------------------------------------------- */
WITHEMES.fitvids = function(){
	if ( $().fitVids ) {
		$('.media-container').fitVids();
	}
}; // fitvids

/* 5 Autosize
--------------------------------------------------------------------------------------------- */
WITHEMES.autosize = function(){
	if ( $().autosize )	{
		$('textarea').autosize();
	}
}; // autosize

/* 6 Scrollup
--------------------------------------------------------------------------------------------- */
WITHEMES.scrollup = function(){
	$(window).scroll(function(){
		if ($(this).scrollTop() > 600 ) {
			$('#scrollup').fadeIn();
		} else {
			$('#scrollup').fadeOut();
		}
	}); 
	
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo');
		return false;
	});
};	// scrollup

/* 7 Mobile Dropdown
--------------------------------------------------------------------------------------------- */
String.prototype.repeat = function( num ) {
	return new Array( num + 1 ).join( this );
}

WITHEMES.mobile_nav = function(){
		/* Option */
	$('<option />', {
	   "selected": "selected",
	   "value"   : "",
	   "text"    : 'Go to...'
	}).appendTo('#wi-mainnav-mobile');
		/* Populate dropdown */
	$("#wi-mainnav a").each(function() {
		var el = $(this);
		var option = $("<option />", {
			"value"   : el.attr("href"),
			"text"    : ('-'.repeat(el.parents("ul.children, ul.sub-menu").length)  + ' ' + el.text())
		}).appendTo('#wi-mainnav-mobile');
		if (el.parent().hasClass('current-menu-item') || el.parent().hasClass('active')) option.attr('selected','selected');
	});
	
	
	// if is mobile, add a mobile classs	
	if ( isMobile.any() != null ) {
		$('body').addClass('is-mobile');		
		}
	
}; // mobile_nav

/* 8 Scrollto
--------------------------------------------------------------------------------------------- */
WITHEMES.scrollto = function(){
	/* scroll to target */
	$('.wi-onepage #wi-mainnav li a,.btn-scroll').on('click',function(e){
		var href = $(this).attr('href');
		var hash;
		if (href) hash = href.split('#')[1];
		if(hash){
			if ( $('#'+hash).length > 0 ) {
				e.preventDefault();
				var header_height = 82; //$('#wi-header').outerHeight();
				var offset_top = $('#'+hash).offset().top - header_height + 1;
				if ( $('body').hasClass('admin-bar') ) offset_top = offset_top - 28;
				$('html,body').animate({ scrollTop: offset_top}, 1000, 'easeInOutExpo');
			}
		} // if hash
	});	// onepage menu li a click
	
	$('#wi-mainnav-mobile').on('change',function(e){
		var href = $(this).val();
		var hash; if (href) hash = href.split('#')[1];
		if(hash && $('body').hasClass('wi-onepage') ){
			if ( $('#'+hash).length > 0 ) {
				e.preventDefault();
				var header_height = $('#wi-header').outerHeight();
				var offset_top = $('#'+hash).offset().top - header_height + 1;
				if ( $('body').hasClass('admin-bar') ) offset_top = offset_top - 28;
				$('html,body').animate({ scrollTop: offset_top}, 1000, 'easeInOutExpo');
			}
		} else if ( href.length > 0 ) {
			self.location = href;
			}
												 }); // on mobile menu change
	
		/* change active class when click */
	$(".wi-onepage #wi-mainnav li").click(function () {
		$(".wi-onepage #wi-mainnav li").removeClass("active");
		$(this).addClass("active")
	});
	
		/* change active class when scroll */
	var lastid,	scroll_items = $(".wi-onepage #wi-mainnav").find('a').map(function () {
			var href = $(this).attr("href");
			var hash;
			if ( href ) hash = href.split('#')[1];
			if(hash){
				if ( $('#' + hash).length > 0 ) return $('#' + hash);
			}
		});
	$(window).scroll(function () {
		var from_top = $(this).scrollTop() + $(".wi-onepage #wi-mainnav").outerHeight() + 100;
		var cur = scroll_items.map(function () {
			if ($(this).offset().top < from_top ) return this
		});
		cur = cur[cur.length - 1];
		var id = ( cur && cur.length ) ? cur[0].id : '';
		if (lastid !== id) {
			lastid = id;			
			
			if ( $('body').hasClass('wi-onepage') ) {
			
				$('.wi-onepage #wi-mainnav li a').each(function(){
					var href = $(this).attr('href');
					var hash;
					if ( href ) hash = href.split('#')[1];
					if ( hash == id ) {
						$(this).parent().addClass("active");
					} else {
						$(this).parent().removeClass("active");
					}
				});	// each wi mainnav li a
				
				$('#wi-mainnav-mobile option').each(function(){
					var hash = $(this).attr('value').split('#')[1];
					if ( hash == id ) {
						$(this).attr('selected','selected');
					} else {
						$(this).removeAttr('selected');
					}	 
															 });
			} // if body has class wi-onepage
		}	// if lastid !== id
	});	// scroll

};	// scrollto

/* 9 Blog Slider
--------------------------------------------------------------------------------------------- */
WITHEMES.blogslider = function(){
	if ( $().flexslider ) {
	
		$('.slider-thumbnail').each(function(){
			var $this = $(this);
			var easing = ( $this.data('effect') == 'fade' ) ? 'linear' : 'easeInOutExpo';
			$this.find('.flexslider').flexslider({
				animation		:	$this.data('effect'),
				pauseOnHover	:	true,
				useCSS			:	false,
				easing			:	easing,
				animationSpeed	:	500,
				slideshowSpeed	:	5000,
				controlNav		:	false,
				directionNav	:	$this.data('navi'),
				slideshow		:	$this.data('auto'),
				prevText		:	'<i class="icon-angle-left"></i>',
				nextText		:	'<i class="icon-angle-right"></i>',
				smoothHeight	:	$this.data('smooth'),
								 });	// flexslider
										});	// each
				
	}	// if flexslider
}; // blogslider

/* 10 Colorbox
--------------------------------------------------------------------------------------------- */
WITHEMES.colorbox = function(){
	if ( $().colorbox ) {
		
		//	colorbox
		$('.wi-colorbox').colorbox({
				transition	:	'elastic',
				speed		:	300,
				maxWidth	:	'90%',
				maxHeight	:	'90%',
				returnFocus	:	false,
			});
		
		//	gallery
		$('.gallery').each(function(index){
			var id = (	$(this).attr('id')	) ? $(this).attr('id') : 'gallery-' + index;
			$(this).
			find('.gallery-item').
			find('a[href$=".gif"], a[href$=".jpg"], a[href$=".png"], a[href$=".bmp"]').
			has('img').
			colorbox({
				transition	:	'elastic',
				speed		:	300,
				maxWidth	:	'90%',
				maxHeight	:	'90%',
				rel			:	id,
				returnFocus	:	false,
								  });
									});	// each
		
		$('.wi-single .post-thumbnail a').has('img').colorbox({
				transition	:	'elastic',
				speed		:	300,
				maxWidth	:	'90%',
				maxHeight	:	'90%',
				returnFocus	:	false,
								  });
		
		$('.colorbox-video').each(function(){
			var $this = $(this);
			var innerWidth, innerHeight;
			if ( $this.data('width') ) innerWidth = $this.data('width'); else innerWidth = 640;
			if ( $this.data('height') ) innerHeight = $this.data('height'); else innerHeight = 390;
			
			$this.colorbox({
				iframe:true,
				innerWidth:innerWidth, 
				innerHeight:innerHeight,
					});
										   });
		
	} // endif colorbox
}; // colorbox

/* 11 Parallax
--------------------------------------------------------------------------------------------- */
WITHEMES.parallax = function(){
	
	var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
	/*
	 * Please note that background attachment fixed doesn't work on iOS
	 */ 
	if (!iOS) {
		$('#wi-top-area,.page-separator').css({backgroundAttachment:'fixed'});
	} else {
		$('#wi-top-area,.page-separator').css({backgroundAttachment:'scroll'});
		}
	
	if ( $().parallax && isMobile.any() == null ) { 
		$('#wi-top-area.parallax').parallax();
		$('.page-separator.parallax').each(function(){
			var $this = $(this);
			$this.parallax(); // vcd!!!
													});
	}	// if parallax	
};	// parallax

/* 12 Header Slider
--------------------------------------------------------------------------------------------- */
WITHEMES.header_slider = function(){
	
	/* set vertical middle for text element */
	var height = $('#wi-top-area.type-slider-not-fullscreen .top-content').outerHeight();
	$('#wi-top-area.type-slider-not-fullscreen .top-content').css({marginTop:- height/2 + 'px'});
	
	if ( $().flexslider ) {
	
		$('.header-slider').each(function(){
			var $this = $(this);
			var easing = ( $this.data('effect') == 'fade' ) ? 'linear' : 'easeInOutExpo';
			$this.find('.flexslider').flexslider({
				animation		:	$this.data('effect'),
				pauseOnHover	:	true,
				useCSS			:	false,
				easing			:	easing,
				animationSpeed	:	500,
				slideshowSpeed	:	$this.data('time'),
				controlNav		:	$this.data('pager'),
				directionNav	:	$this.data('navi'),
				slideshow		:	$this.data('auto'),
				prevText		:	'<i class="icon-angle-left"></i>',
				nextText		:	'<i class="icon-angle-right"></i>',
				smoothHeight	:	true,
								 });	// flexslider
										});	// each
		
		$('.text-slider').each(function(){
			var $this = $(this);
			$this.find('.flexslider').flexslider({
				animation		:	$this.data('effect'),
				direction		:	$this.data('direction'),
				pauseOnHover	:	true,
				animationSpeed	:	500,
				slideshowSpeed	:	5000,
				controlNav		:	$this.data('pager'),
				directionNav	:	false,
				slideshow		:	$this.data('auto'),
				prevText		:	'<i class="icon-angle-left"></i>',
				nextText		:	'<i class="icon-angle-right"></i>',
				smoothHeight	:	true,
								 });	// flexslider
										});	// each
				
	}	// endif flexslider
	
}; // header slider

/* 13 Fullscreen Slider
--------------------------------------------------------------------------------------------- */
WITHEMES.fullscreen_slider = function(){
	
	var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
	
	if ( $().supersized ) {
		
		$("#wi-top-area.type-slider-fullscreen .super").each(function(){
			var $this = $(this);
			var number = $this.data('number');
			number = parseInt(number);
			var i = 1;
			var slides = [];
			while( i <= number ) {
				slides.push({image:$this.data('image-'+i), thumb :$this.data('image-'+i) });
				i++;
				}
			if ( slides.length > 0 ) {
				$this.supersized({
					autoplay		:	$this.data('auto'),
					slide_interval	:	$this.data('time'),
					transition		:	$this.data('effect'),
					transition_speed:	700,
					slides			: 	slides,
					pause_hover		:	true,
					});	// supersized
			}	// if length > 0
		});		// each	
				
	}	// endif supersized	
	
}; // Fullscreen Background

/* Init functions
--------------------------------------------------------------------------------------------- */
$(document).ready(function() {
	WITHEMES.sticky();
	WITHEMES.superfish();
	WITHEMES.scrollto();
	WITHEMES.colorbox();
	WITHEMES.fitvids();
	WITHEMES.mobile_nav();
	WITHEMES.autosize();
	WITHEMES.scrollup();
	WITHEMES.header_slider();
	WITHEMES.blogslider();	
	WITHEMES.parallax();
	WITHEMES.fullscreen_slider();
	WITHEMES.twitter();
						   });
})(jQuery);	// EOF