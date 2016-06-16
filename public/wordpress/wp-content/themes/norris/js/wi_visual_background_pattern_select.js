jQuery(document).ready(function($){
								
	/* -------------------------------------------------------------------------------------------------- */ 
	/* ADD VISUALIZED BACKGROUND PATTERNS
	/* -------------------------------------------------------------------------------------------------- */								
								
	var bgpt = $('#_wi_predefined-pattern,#body-background-pattern,#footer-background-pattern,#portfolio-rollover-background-pattern');
	
	bgpt.each(function(){
		var $this = $(this);
		var $visual = $('<div id="' + bgpt.attr('id') +'-visual" />');
		
		var margin;
		if ( bgpt.attr('id') == '_wi_background-pattern' ) {
			margin = '20px 5%';
			width = '90%';
		} else {
			margin = '50px 0 20px';
			width = '100%';
			}
		
		$visual.insertAfter($this.parent()).css({width:width,height:'70px', opacity:'0.8', margin:margin, border:'2px solid #bbb', backgroundColor:'#fff', backgroundImage:'url('+$this.val()+')'});
		
		
		$this.on('change',function(){
			$visual.css({backgroundImage:'url('+$this.val()+')'});
							  }); // on change
		
					   }); // each bgpt


	function show_needed( prop, related_array ) {
		// check page to add prefix
		if ( $('body.appearance_page_optionsframework').length ) {
			prefix = 'section-'; // SMOF
		} else {
			prefix = 'rwmb-wrapper-'; // Posts, pages, portfolios options
		}
		
		var val = prop.val();
		for ( key in related_array ) {
			for (key2 in related_array[key] ) {
				$('#' + prefix + related_array[key][key2]).hide();
				}
		}
		
		for ( key in related_array ) {
			if ( key == val ) {
				
				for (key2 in related_array[key] ) {
					$('#' + prefix + related_array[key][key2]).show();
					}
				
				}
		}
	}// end function show_needed
	
	function execute_needed( prop, related_array ) {
		show_needed( prop, related_array )
		prop.on('change',function(){
			show_needed( $(this), related_array );
										 });
		}
	
	/* -------------------------------------------------------------------------------------------------- */ 
	/* PAGE OPTIONS
	/* -------------------------------------------------------------------------------------------------- */
	
	/* Background Types
	------------------------------------------------------------------------------ */
	var prop = $('#_wi_page-background-type');
	style_2 = Array('_wi_page-background-image','_wi_page-background-image-size','_wi_page-background-image-position');
	style_3 = Array('_wi_page-background-pattern','_wi_page-background-pattern-retina');
	related_array = new Array();
	related_array['image'] 		= style_2;
	related_array['pattern']	= style_3;
	
	execute_needed( prop, related_array );
	
	/* Separator Type
	------------------------------------------------------------------------------ */
	var prop = $('#_wi_background-image-or-pattern');
	style_1 = Array('_wi_background-image','_wi_enable-parallax-effect','_wi_clipmask-opacity','_wi_overlay-opacity');
	style_2 = Array('_wi_predefined-pattern','_wi_custom-pattern','_wi_retina-custom-pattern');
	
	related_array = new Array();
	related_array['background-image'] 		=	style_1;
	related_array['pattern'] 				=	style_2;
	
	execute_needed( prop, related_array );
	
	/* -------------------------------------------------------------------------------------------------- */ 
	/* THEME OPTIONS
	/* -------------------------------------------------------------------------------------------------- */
	
	/* Titlebar Style
	------------------------------------------------------------------------------ */
	var prop = $('#top-area-type');
	style_1 = Array(
					  'toparea-bg-background-image',
					  'top-area-parallax',
					  'toparea-bg-overlay-opacity'
					  );
	style_2 = Array(
					 'toparea-bg-background-image',
					 'top-area-parallax',
					 'toparea-bg-padding-top-bottom',
				     'toparea-bg-overlay-opacity'
						);
	style_3 = Array(
					 'toparea-bg-overlay-opacity',
					 'toparea-slider-slider',
					 'toparea-slider-fullscreen-effect',
					 'toparea-slider-auto',
					 'toparea-slider-time-interval',
					 'toparea-slider-navi',
					 'toparea-slider-pager',
					 'toparea-slider-fullscreen-progress'
						);
	style_4 = Array(
					 'toparea-bg-overlay-opacity',
					 'toparea-slider-slider',
					 'toparea-slider-not-fullscreen-effect',
					 'toparea-slider-auto',
					 'toparea-slider-time-interval',
					 'toparea-slider-navi',
					 'toparea-slider-pager'
					 
						);
	style_5 = Array();
	related_array = new Array();
	related_array['bg-fullscreen']			= 	style_1;
	related_array['bg-not-fullscreen']		= 	style_2;
	related_array['slider-fullscreen']		= 	style_3;
	related_array['slider-not-fullscreen']	= 	style_4;
	related_array['none']					= 	style_5;
	
	execute_needed( prop, related_array );
	
	/* -------------------------------------------------------------------------------------------------- */ 
	/* SHOW AND HIDE OPTIONS FOR PRODUCTs
	/* -------------------------------------------------------------------------------------------------- */
	
	/* Product
	------------------------------------------------------------------------------ */
	var prop = $('#_wi_product-layout');	
	style_1 = Array('');
	style_2 = Array('_wi_product-sidebar-position');
	
	related_array = new Array();
	related_array['full'] 			= 	style_1;
	related_array['sidebar']		= 	style_2;
	related_array['']				= 	style_2;
	
	execute_needed( prop, related_array );

}); // jquery