<?php
/*
Plugin Name: Wi:Portfolio
Plugin URI: http://withemes.com
Description: Portfolio Plugin.
Version: 1.7
Author: Withemes
Author URI: http://themeforest.net/user/withemes?ref=withemes
*/
if ( !class_exists('WI_Portfolio') ) {
	
class WI_Portfolio {
	
	function __construct() {
	
		if ( !class_exists( 'RW_Meta_Box' ) && !defined('RWMB_URL') && !defined('RWMB_DIR') ) {

			/* If theme doesn't support Metabox, we need to include it */		
			define( 'RWMB_URL', plugin_dir_url( __FILE__ ) . 'meta-box/' );
			define( 'RWMB_DIR', plugin_dir_path( __FILE__ ) . 'meta-box/' );
			include_once( plugin_dir_path( __FILE__ ) . 'meta-box/meta-box.php');
			
			global $prefix;
			$prefix = '_wi_';	// the first underscore is to protect custom field
			global $meta_boxes;
			$meta_boxes = array();
			
			/* --------------------------------------------------- */
			/* Register Metaboxes
			/* --------------------------------------------------- */
			
			add_action( 'admin_init', 'wi_register_meta_boxes' );
			if (!function_exists('wi_register_meta_boxes')){
			function wi_register_meta_boxes()
			{
				// Make sure there's no errors when the plugin is deactivated or during upgrade
				if ( !class_exists( 'RW_Meta_Box' ) )
					return;	
				global $meta_boxes, $prefix;
				
				/* Add prefix to all id in metaboxes. This is only a featured of withemes to protect all meta keys & values */
				foreach ($meta_boxes as $key1 => $meta_box){
					if (	isset ( $meta_box['fields'] ) && is_array( $meta_box['fields'] )	) {
						foreach ( $meta_box['fields'] as $key2 => $field) {
							if(	is_array($field) && isset($field ['id']) ) {
								if(	strpos(	$field ['id'] , $prefix	) === false )	// do not have prefix
								$meta_boxes[$key1]['fields'][$key2]['id'] = $prefix . $field ['id'];
							}				
						}
					}	
				}
				
				foreach ( $meta_boxes as $meta_box )
				{
					new RW_Meta_Box( $meta_box );
				}
			}
			}
			
		}
		
		include_once( plugin_dir_path( __FILE__ ) . 'portfolio.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'functions.php' );

    	add_action( 'init', array(&$this,'init') );
		
		add_image_size('thumb-480',480,9999,false);	// small portfolio thumbnail
		add_image_size('thumb-480-crop',480,320,true);	// small portfolio thumbnail crop
		add_image_size('thumb-600',600,9999,false);	// large portfolio thumbnail
		add_image_size('thumb-600-crop',600,400,true);	// large portfolio thumbnail crop
		add_image_size('thumb-940',940,9999,false);	// fullwidth image no crop
		add_image_size('thumb-940-crop',940,400,true);	// fullwidth image crop

		load_plugin_textdomain( 'wi', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
		
    }
	
    function init() {
		
		/* Front-End scripts & Styles
		-------------------------------------------- */
		if( ! is_admin() ){
			wp_register_script( 'wi-isotope', plugin_dir_url( __FILE__ ) . 'js/jquery.isotope.min.js', 'jquery', '1.5.23', true );
			wp_register_script( 'wi-wait-for-images', plugin_dir_url( __FILE__ ) . 'js/jquery.waitforimages.js', 'jquery', '1.0', true );
			wp_register_script( 'wi-portfolio-ajax', plugin_dir_url( __FILE__ ) . 'js/portfolio-ajax.js', array('jquery','wi-wait-for-images'), '1.0', true );
			wp_localize_script( 'wi-portfolio-ajax', 'PortfolioAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

			
			wp_register_script( 'wi-flexslider', plugin_dir_url( __FILE__ ) . 'js/jquery.flexslider-min.js', 'jquery', '2.1', true );
			wp_register_style( 'wi-flexslider', plugin_dir_url( __FILE__ ) . 'css/flexslider.css' );
			wp_enqueue_script( 'wi-easing', plugin_dir_url( __FILE__ ) . 'js/jquery.easing.1.3.js', 'jquery', '1.3', true );
			wp_enqueue_style('wi-portfolio', plugin_dir_url( __FILE__ ) . 'css/portfolio.css');
			wp_enqueue_style('wi-portfolio-responsive', plugin_dir_url( __FILE__ ) . 'css/responsive.css');
			
			wp_enqueue_script( 'wi-colorbox', plugin_dir_url( __FILE__ ) . 'js/jquery.colorbox-min.js', 'jquery', '1.4.26', true );
			wp_enqueue_style('wi-colorbox', plugin_dir_url( __FILE__ ) . 'css/colorbox.css');
			
			add_action('wp_head', array(&$this,'wi_execute_isotope') );
		}
		
		/* Register Options */		
		global $meta_boxes;
		if ( !isset($meta_boxes) || !is_array($meta_boxes) ) $meta_boxes = array();
		$meta_boxes[] =  array (
				'id'			=>		'portfolio-options',
				'title'			=>		__('Portfolio Options','wi'),
				'pages'			=>		array ('portfolio'),
				'context'		=>		'normal',
				'priority'		=>		'high',
				'fields'		=>		array (
				
						array (
							'type'		=>	'text',
							'name'		=>	__('Subtitle','wi'),
							'id'		=>	'subtitle',
						),
						
						/* project description
						--------------------------------------- */
						array (
							'type'		=>	'heading',
							'name'		=>	__('Project Description','wi'),
							'id'		=>	'heading-project-description',
						),
						
						array (
							'type'		=>	'text',
							'name'		=>	__('Client Name','wi'),
							'id'		=>	'client',
						),
						
						array (
							'type'		=>	'date',
							'name'		=>	__('Date','wi'),
							'id'		=>	'date',
						),
						
						array (
							'type'		=>	'text',
							'name'		=>	__('Location','wi'),
							'id'		=>	'location',
						),
						
						array (
							'type'		=>	'text',
							'name'		=>	__('Project URL','wi'),
							'id'		=>	'url',
						),
						
						array (
							'type'		=>	'select',
							'name'		=>	__('URL Target','wi'),
							'id'		=>	'url-target',
							'options'	=>	array('_self' => __('Same tab','wi'), '_blank'=> __('New Tab','wi')),
							'std'		=>	__('Select','wi'),
							'desc'		=>	__('Default is "same tab".','wi'),
						),
						
						array (
							'type'		=>	'checkbox',
							'name'		=>	__('Hide Portfolio Categories?','wi'),
							'id'		=>	'hide-portfolio-categories',
							'std'		=>	false,
							'desc'		=>	__('Check this to hide Portfolio Categories in the detail page.','wi'),
						),
						
						/* video/audio
						--------------------------------------- */
						array (
							'type'		=>	'heading',
							'name'		=>	__('Video / Soundcloud','wi'),
							'id'		=>	'heading-media-options',
						),
						
						array (
							'type'		=>	'textarea',
							'name'		=>	__('Video / Soundcloud code?','wi'),
							'id'		=>	'media',
							'desc'		=>	__('Insert YouTube, Vimeo or SoundCloud URL.','wi'),
						),
						
						array (
							'type'		=>	'textarea',
							'name'		=>	__('Self-hosted video URL','wi'),
							'id'		=>	'self-hosted-video',
						),
						
						array (
							'type'		=>	'textarea',
							'name'		=>	__('Self-hosted audio URL','wi'),
							'id'		=>	'self-hosted-audio',
						),
						
						/* display
						--------------------------------------- */
						array (
							'type'		=>	'heading',
							'name'		=>	__('Displaying Options','wi'),
							'id'		=>	'heading-displaying-options',
						),
						array (
							'type'		=>	'select',
							'name'		=>	__('Layout','wi'),
							'id'		=>	'layout',
							'options'	=>	array('half' => __('Half-width','wi'), 'full'=> __('Fullwidth','wi')),
							'std'		=>	__('Select','wi'),
							'desc'		=>	__('Default is "half-width".','wi'),
						),
						
						array (
							'type'		=>	'checkbox',
							'name'		=>	__('Crop thumbnail?','wi'),
							'id'		=>	'crop-thumbnail',	
							'std'		=>	true,
						),
						
						array (
							'type'		=>	'checkbox',
							'name'		=>	__('Thumbnail link to fullwidth image?','wi'),
							'id'		=>	'thumbnail-link-to-full',
							'std'		=>	false,
							'desc'		=>	__('It will open lightbox','wi'),
						),						
						
						/* slideshow
						--------------------------------------- */
						array (
							'type'		=>	'heading',
							'name'		=>	__('Slideshow Options','wi'),
							'id'		=>	'heading-slideshow-options',
						),
						
						array (
							'type'		=>	'thickbox_image',
							'name'		=>	__('Images','wi'),
							'id'		=>	'slideshow-images',
						),
						
						array (
							'type'		=>	'checkbox',
							'name'		=>	__('Auto play?','wi'),
							'id'		=>	'slideshow-auto',
							'std'		=>	false,
						),
						
						array (
							'type'		=>	'checkbox',
							'name'		=>	__('Show navigation?','wi'),
							'id'		=>	'slideshow-navi',
							'std'		=>	true,
						),
						
					),
		); // meta_boxes
		
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
			 
    }
	
	function wi_execute_isotope(){
	?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
			var $container = $('.wi-portfolio');
			var $items  = $('.portfolio-item');
			// initialize isotope
			if( $().isotope ) {
				$('.wi-portfolio').each(function(){
					var $this = $(this);
					$(window).load(function(){
						$this.isotope({
						itemSelector: '.portfolio-item',
						animationEngine: 'best-available',
						animationOptions: {
								duration: 250,
								easing: 'easeInOutSine',
								queue: false
					   },
									   }); // isotope
						
						// default category
						$this.parent().find('.wi-portfolio-filter').find('li').each(function(){
							if ( $(this).find('a').attr('data-filter') == ('.wi-' + $this.data('default'))  ) {
								$this.parent().find('.wi-portfolio-filter').find('li').removeClass('active');
								$(this).addClass('active');
								var selector = $(this).find("a").attr('data-filter');
								$this.isotope({ filter: selector });
								return false;
							}	
						}); // each
										   
									}); // load
					$(window).resize(function() {
						$this.isotope('reLayout');
					});			
				
					// filter items when filter link is clicked
					$this.parent().find('.wi-portfolio-filter').find('li').click(function(){
						$this.parent().find('.wi-portfolio-filter').find('li').removeClass('active');
						$(this).addClass('active');
						var selector = $(this).find("a").attr('data-filter');
						$this.isotope({ filter: selector });
						return false;
					});
					
					
					
				}); // each wi-portfolio
			
			}	// end if isotope
			
				// COLORBOX
				if ( $().colorbox ) {
					//	colorbox
					$('.wi-colorbox').colorbox({
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
					
				}	// if colorbox
			
			}); // jQuery
		</script>
	<?php
	}
	
}	// class
}	// class exists

$WI_Portfolio = new WI_Portfolio;