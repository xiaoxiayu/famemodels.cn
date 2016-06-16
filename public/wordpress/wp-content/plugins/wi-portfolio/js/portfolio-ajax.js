/* version 1.6.2 */
jQuery(document).ready(function($) {

	/* Declare variables
	------------------------------------------------- */
	var big_wrap = $('.wi-portfolio-wrapper');
	var wrapper = $('#portfolio-ajax-wrapper');
	var portfolio_container = $('.portfolio-ajax');
	var ajax_content = $('#portfolio-ajax-content');
	var isShowing = false;
	var ajax_height = 0;
	var portfolio_navi = big_wrap.find('.portfolio-navi');
	var close_button = big_wrap.find('.close-portfolio').find('a');
	var loader = big_wrap.find('.ajax-loader');
	var isLoading = false;
	var scrollPostition = 0;

	var currPort, nextPort, prevPort;

	/* Preload portfolio
	------------------------------------------------- */
	function preload_portfolio_ajax() {

		var header_height = jQuery('#wi-header').outerHeight() + 20;
		var scrollTop = ajax_content.offset().top - header_height;
		if ($('body').hasClass('admin-bar')) scrollTop = scrollTop - 28;

		portfolio_container.find('.portfolio-item').removeClass('current');

		jQuery('html,body').stop().animate({
			scrollTop: scrollTop + 'px'
		}, 600, 'easeInOutExpo', function() {
			/* If ajax content is showing, fade it out and set height for the container */
			if (isShowing) {
				ajax_content.animate({
					opacity: 0,
					height: ajax_height
				}, function() {
					load_portfolio_ajax();
				}); // animate	
			} else {
				load_portfolio_ajax();
			} // is showing or not

			// ?
			portfolio_navi.fadeOut();
			close_button.fadeOut();
		}); // animate body, html scroll top

		currPort.addClass('current');

	}

	/* Ajax load project
	------------------------------------------------- */
	function load_portfolio_ajax() {
		loader.fadeIn().removeClass('project-error').html('');

		if (isLoading) return false;

		var url = (typeof(PortfolioAjax) != undefined) ? PortfolioAjax.ajaxurl : '';
		var id = currPort.attr('id');
		id = id.replace('portfolio-', '');

		ajax_content.load(url, {
			'action': 'wi_load_portfolio',
			id: id
		}, function(response, status, xhr) {

			/* Success */
			if (status == 'success') {
				isLoading = false;
				after_portfolio_ajax();
				$('#portfolio-content').waitForImages(function() {
					alert('wait for images');
					loader.delay(300).fadeOut('fast', function() {
						show_portfolio();
					});
				});
			}

			/* Error */
			if (status == 'error') {}

		});

	} // load portfolio ajax

	function after_portfolio_ajax() {

		$('.btn-scroll').on('click', function(e) {
			alert('btn scroll');
			var href = $(this).attr('href');
			var hash;
			if (href) hash = href.split('#')[1];
			if (hash) {
				if ($('#' + hash).length > 0) {
					e.preventDefault();
					var header_height = 82; //$('#wi-header').outerHeight();
					var offset_top = $('#' + hash).offset().top - header_height + 1;
					if ($('body').hasClass('admin-bar')) offset_top = offset_top - 28;
					$('html,body').animate({
						scrollTop: offset_top
					}, 1000, 'easeInOutExpo');
				}
			} // if hash
		}); // onepage menu li a click

		/* Flexslider
		------------------------------------ */
		if ($().flexslider) {
			alert('flexslider');
			$('.portfolio-thumb-slider').each(function() {
				var $this = $(this);
				$this.find('.flexslider').flexslider({
					animation: 'fade',
					slideDirection: 'horizontal',
					pauseOnHover: true,
					animationSpeed: 600,
					slideshowSpeed: 5000,
					controlNav: false,
					directionNav: $this.data('navi'),
					slideshow: $this.data('auto'),
					prevText: '<i class="icon-angle-left"></i>',
					nextText: '<i class="icon-angle-right"></i>',
					smoothHeight: false,

				}); // flexslider
			}); // each
		} // if flexslider

		/* Fitvids
		------------------------------------ */
		if ($().fitVids) {
			$('.media-container').fitVids();
		}

		$('.wi-tab').each(function() {
			alert('wi-tab');
			var tab = $(this);
			$(this).find('.tabnav').find('a').click(function() {
				tab.find('.tabnav').find('li').removeClass('active');
				$(this).parent().addClass('active');
				var currentTab = $(this).attr('data-href');
				tab.find('.tab-content').removeClass('active');
				tab.find(currentTab).addClass('active');
				return false;
			}); // click
		}); // each

		/* Colorbox
		------------------------------------ */
		if ($().colorbox) {
			alert('colorbox');
			$('.wi-colorbox').colorbox({
				transition: 'elastic',
				speed: 300,
				maxWidth: '90%',
				maxHeight: '90%',
				returnFocus: false,
			}); // colorbox			
alert('as');
			//	gallery
			$('.gallery').each(function(index) {
				alert('gallery');
				var id = ($(this).attr('id')) ? $(this).attr('id') : 'gallery-' + index;
				$(this).
				find('.gallery-item').
				find('a[href$=".gif"], a[href$=".jpg"], a[href$=".png"], a[href$=".bmp"]').
				has('img').
				colorbox({
					transition: 'elastic',
					speed: 300,
					maxWidth: '90%',
					maxHeight: '90%',
					rel: id,
					returnFocus: false,
				});
			}); // each

		} // if colorbox

	} // after portfolio ajax

	/* Show projecte loaded
	------------------------------------------------- */
	function show_portfolio() {
		alert('show portfolio');
		if (isShowing == false) {
			ajax_height = ajax_content.children('#portfolio-content').outerHeight() + 'px';
			ajax_content.animate({
				opacity: 1,
				height: ajax_height
			}, function() {
				scrollPostition = jQuery('html,body').scrollTop();
				portfolio_navi.fadeIn();
				close_button.fadeIn();
				isShowing = true;

			});

		} else {
			ajax_height = ajax_content.children('#portfolio-content').outerHeight() + 'px';
			ajax_content.animate({
				opacity: 1,
				height: ajax_height
			}, function() {
				scrollPostition = jQuery('html,body').scrollTop();
				portfolio_navi.fadeIn();
				close_button.fadeIn();

			});
		}

		var next = currPort.next('.portfolio-item');
		if (next.length === 0) {
			portfolio_navi.find('.next').addClass('disabled');
		} else {
			portfolio_navi.find('.next').removeClass('disabled');
		}

		var prev = currPort.prev('.portfolio-item');
		if (prev.length === 0) {
			portfolio_navi.find('.prev').addClass('disabled');
		} else {
			portfolio_navi.find('.prev').removeClass('disabled');
		}

	} // show portfolio

	/* On click portfolio item
	------------------------------------------------- */
	$(document).on('click', '.portfolio-item .thumb-content', function() {

		currPort = $(this).closest('.portfolio-item');
		if (currPort.hasClass('current')) return false;

		big_wrap = $(this).closest('.wi-portfolio-wrapper');
		wrapper = big_wrap.find('#portfolio-ajax-wrapper');
		portfolio_container = big_wrap.find('.portfolio-ajax');
		ajax_content = big_wrap.find('#portfolio-ajax-content');
		portfolio_navi = wrapper.find('.portfolio-navi');
		close_button = wrapper.find('.close-portfolio').find('a');
		loader = wrapper.find('.ajax-loader');

		preload_portfolio_ajax();

	}); // onclick portfolio item


	/* next project
	------------------------------------------------- */
	portfolio_navi.find('.next').find('a').on('click', function() {

		var next = currPort.next('.portfolio-item');
		if (next.length === 0) {
			return false;
		} else {
			currPort = next;

			big_wrap = $(this).closest('.wi-portfolio-wrapper');
			wrapper = big_wrap.find('#portfolio-ajax-wrapper');
			portfolio_container = big_wrap.find('.portfolio-ajax');
			ajax_content = big_wrap.find('#portfolio-ajax-content');
			portfolio_navi = wrapper.find('.portfolio-navi');
			close_button = wrapper.find('.close-portfolio').find('a');
			loader = wrapper.find('.ajax-loader');

			preload_portfolio_ajax();
		}
		return false;

	});

	/* prev project
	------------------------------------------------- */
	portfolio_navi.find('.prev').find('a').on('click', function() {

		var prev = currPort.prev('.portfolio-item');
		if (prev.length === 0) {
			return false;
		} else {
			currPort = prev;

			big_wrap = $(this).closest('.wi-portfolio-wrapper');
			wrapper = big_wrap.find('#portfolio-ajax-wrapper');
			portfolio_container = big_wrap.find('.portfolio-ajax');
			ajax_content = big_wrap.find('#portfolio-ajax-content');
			portfolio_navi = wrapper.find('.portfolio-navi');
			close_button = wrapper.find('.close-portfolio').find('a');
			loader = wrapper.find('.ajax-loader');

			preload_portfolio_ajax();
		}
		return false;

	});

	/* Close portfolio
	------------------------------------------------- */
	close_button.on('click', function() {

		big_wrap = $(this).closest('.wi-portfolio-wrapper');
		wrapper = big_wrap.find('#portfolio-ajax-wrapper');
		portfolio_container = big_wrap.find('.portfolio-ajax');
		ajax_content = big_wrap.find('#portfolio-ajax-content');
		portfolio_navi = wrapper.find('.portfolio-navi');
		close_button = wrapper.find('.close-portfolio').find('a');
		loader = wrapper.find('.ajax-loader');

		portfolio_navi.fadeOut(100);
		close_button.fadeOut(100);
		ajax_content.animate({
			opacity: 0,
			height: '0px'
		}, 1000, 'easeOutExpo', function() {
			ajax_content.empty();
		});
		portfolio_container.find('.portfolio-item').removeClass('current');
		loader.fadeOut();
		ajax_height = 0;
		return false;

	});
});