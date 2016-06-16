/* version 1.5.1 */
(function($) {
"use strict";
/* --------------------------------------------------------------------------------------------- */
/* Useful functions
/* --------------------------------------------------------------------------------------------- */
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

function counter( ele, number ){

	if ( typeof(ele)!='object' ) return;
	
	ele.find('.number').empty();

	if ( !number ) number = 0;
	var number = number.toString();
	var numArray = number.split("");

	for(var i=0; i<numArray.length; i++) { 
		numArray[i] = parseInt(numArray[i], 10);
		ele.find('.number').append('<span class="digit-con"><span class="digit'+i+'">0<br>1<br>2<br>3<br>4<br>5<br>6<br>7<br>8<br>9<br></span></span>');	
	}

	var increment = ele.find('.digit-con').outerHeight();
	var speed = 1000;

	for(var i=0; i<numArray.length; i++) {
		ele.find('.digit'+i).animate({top: -(increment * numArray[i])}, speed);
	}

	ele.find(".digit-con:nth-last-child(3n+4)").after("<span class='comma'>,</a>");
	
	$(window).resize(function(){
		counter( ele, number );
							  });
	
}

var WITHEMES = WITHEMES || {};
/* Toogle & Accordion
--------------------------------------------------------------------------------------------- */
WITHEMES.toggle = function(){
	$('.wi-toggle.toggle-mode .toggle-title').click(function(){
		$(this).closest('.wi-toggle').find('.toggle-content').slideToggle({
				easing		:		'easeOutExpo',
				duration	:		400,
															 });
		$(this).toggleClass('active');
									   });	//	toggle 
	
	$('.wi-accordion .toggle-title').click(function () {
		var slideargs = {duration:400, easing: 'easeInOutExpo'};
		if( !$(this).is('.active') ) {
			$(this).closest('.wi-accordion').find('.toggle-title.active').toggleClass('active').next().slideToggle(slideargs);
			$(this).toggleClass('active');
			$(this).next().slideToggle(slideargs);
		} else {
			$(this).toggleClass('active');
			$(this).next().slideToggle(slideargs);
		}		
	});	// accordion
	
};	// toggle & accordion

/* Tab
--------------------------------------------------------------------------------------------- */
WITHEMES.tab = function(){
	$('.wi-tab').each(function(){
		var tab = $(this);		
		$(this).find('.tabnav').find('a').click(function(){
			tab.find('.tabnav').find('li').removeClass('active');
			$(this).parent().addClass('active');
			var currentTab = $(this).attr('data-href');
			tab.find('.tab-content').removeClass('active');
			tab.find(currentTab).addClass('active');
			return false;
		});	// click
						 });	// each
};	// tab

/* Fitvids
--------------------------------------------------------------------------------------------- */
WITHEMES.fitvids = function(){
	if ( $().fitVids ) {
		$('.media-container').fitVids();
	}
}; // fitvids

/* BigText
--------------------------------------------------------------------------------------------- */
WITHEMES.bigtext = function(){
	if ( $().slabText ) {
		$('.bigtext').slabText({
							   
							   });
		}
};	// bigtext

/* Flexslider
--------------------------------------------------------------------------------------------- */
WITHEMES.flexslider = function(){
	
	if ( $().flexslider ) {
	
		$('.wi-flexslider').each(function(){
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
				smoothHeight	:	true,
								 });	// flexslider
										});	// each
				
	}	// endif flexslider
	
}; // flexslider

/* Testimonial
--------------------------------------------------------------------------------------------- */
WITHEMES.testimonial_slider = function(){
	if ( $().flexslider ) {
		$('.testimonial-slider').each(function(){
		var $this = $(this);
		$this.find('.flexslider').flexslider({
			animation		:	$this.data('effect'),
			pauseOnHover	:	true,
			useCSS			:	false,
			animationSpeed	:	600,
			slideshowSpeed	:	$this.data('time'),
			controlNav		:	$this.data('pager'),
			directionNav	:	true,
			slideshow		:	$this.data('auto'),
			prevText		:	'<i class="icon-angle-left"></i>',
			nextText		:	'<i class="icon-angle-right"></i>',
			smoothHeight	:	true,
			start: function(slider) {
				/* auto-restart player if paused after action */
				if ( $this.data('auto') ) {
					slider.play();
				}
				$this.find('li').click(function(){$this.closest('.testimonial-slider').find('.flex-next').trigger('click');});
			},
			after: function(slider) {
				/* auto-restart player if paused after action */
				if (!slider.playing && $this.data('auto') ) {
//					slider.play();
				}
			}
							 });	// flexslider
		
										   }); // each testimonial-slider
	}; // if flexslider exists
};	// testimonial slider

/* Animations
--------------------------------------------------------------------------------------------- */
WITHEMES.animations = function(){
	function wi_inview(ele) {
		var	window_top = $(window).scrollTop(),
			offset_top = $(ele).offset().top;
		if ( $(ele).length > 0 ) {
			if (	offset_top + $(ele).height() - 100 >= window_top &&
					offset_top <= ( window_top + 0.85 * $(window).height() ) ) {
					return true;
			} else {
				return false;
			}
		}
	}
	
	/* setting intervals to prevent animations run out of control */
	function run_animations() {
		var did_scroll = false;
		$(window).on('scroll',function () {
			did_scroll = true;
		});
		setInterval(function () {
			if (did_scroll) {
				did_scroll = false;
				
				/* number 
				----------------------------- */
				if ( !$('html').hasClass('ie8') && isMobile.any() == null ) {
				$('.wi-count').each(function() {
					var $this = $(this);
					
					if ( !$this.data('complete') ) {
						$this.find('.number').text('').css({opacity:0});
					}
					if ( wi_inview($this) && !$this.data('complete') ) {
						$this.data('complete',true);
						var delay = parseInt($this.data('delay'));
						setTimeout(function(){
							$this.find('.number').animate({opacity:1});
							counter( $this, $this.data('number') );
											}, delay );
					}	// if wi_inview
				});	// each wi count
				}	// endif not IE or mobile view
				else {
					$('.wi-count .number').css({opacity:1});
					}
				
				/* piechart
				----------------------------- */
				if ( $().easyPieChart )	{
					$('.wi-piechart').each(function(){
						var $this = $(this);						
						if ( wi_inview($this) ) {
							var delay = parseInt($this.data('delay'));
							var trackColor = $(this).data('forecolor');
							if ( !trackColor ) trackColor = '#aaa';
							setTimeout(function(){												
								$this.easyPieChart({
									'trackColor':	trackColor,
									'barColor'	:	$this.data('color'),
									'scaleColor':	false,
									'lineCap'	:	'round',
									'lineWidth'	:	$this.data('thickness'),
									'size'		:	$this.data('size'),
									'animate'	:	1200,
									onStep		:	function(value) {
														this.$el.find('span').text(~~value);
														this.$el.find('canvas').css({opacity:~~value/100});
													},
									onStop		:	function() {
														var percent = this.$el.data('percent');
														this.$el.find('span').text(percent);
													}				
								});	// pieChart
												}, delay );	// setTimeout
						}	// if wi_inview
											 });	// each wi-piechart
				}	// if easyPieChart
			} // did scroll
		}, 200); // setInterval
	}	// run animations
	run_animations();
	
};

/* Init functions
--------------------------------------------------------------------------------------------- */
$(document).ready(function() {
	WITHEMES.toggle();
	WITHEMES.tab();
	WITHEMES.fitvids();
	WITHEMES.flexslider();	
	$(window).load(function() {		
		WITHEMES.animations();
		WITHEMES.bigtext();
		WITHEMES.testimonial_slider();
	});

						   });
})(jQuery);	// EOF