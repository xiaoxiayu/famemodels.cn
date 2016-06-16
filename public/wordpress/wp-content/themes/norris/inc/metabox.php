<?php
/* --------------------------------------------------- */
/* Initial Setup
/* --------------------------------------------------- */

	$prefix = '_wi_';	// the first underscore is to protect custom field
	global $meta_boxes;
	$meta_boxes = array();

/* --------------------------------------------------- */
/* Post Options
/* --------------------------------------------------- */

	$meta_boxes[] = array (
		'id'			=>		'post-options',
		'title'			=>		__('Post Options','wi'),
		'pages'			=>		array ('post'),
		'context'		=>		'normal',
		'priority'		=>		'high',
		'fields'		=>		array (
		
				/* layout 
				---------------------------------- */
				array (
					'type'		=>	'heading',
					'name'		=>	__('Blog Display','wi'),
					'id'		=>	'heading-blog-display',
				),
						
				array (
					'name'		=>	__('Display excerpt or content?','wi'),
					'id'		=>	'display',
					'type'		=>	'select',
					'desc'		=>	__('Select display post content or excerpt of this post on the blog.','wi'),
					'options'	=>	array( 'excerpt' => __('Excerpt','wi'), 'content' => __('Content','wi'), ),
					'std'		=>	__('Select','wi'),
				),
								
				array (
					'name'		=>	__('Blog thumbnail crop?','wi'),
					'id'		=>	'blog-thumb-crop',
					'type'		=>	'select',
					'desc'		=>	__('Select <strong>Yes</strong> if you want to display featured image of this post in fixed width/height (600x400) on the blog. Select <strong>No</strong> otherwise.','wi'),
					'options'	=>	array('yes' => __('Yes','wi'), 'no' => __('No','wi')),
					'std'		=>	__('Select','wi'),
				),
				
				array (
					'name'		=>	__('Blog thumbnail link to post?','wi'),
					'id'		=>	'blog-thumb-link-to-post',
					'type'		=>	'select',
					'options'	=>	array('yes' => __('Yes','wi'), 'no' => __('No','wi')),
					'std'		=>	__('Select','wi'),
				),
				
				/* Featured Image
				---------------------------------- */
				array (
					'type'		=>	'heading',
					'name'		=>	__('Featured Image','wi'),
					'id'		=>	'heading-featured-image',
				),
				
				array (
					'name'		=>	__('Show featured Image?','wi'),
					'id'		=>	'show-featured-image',
					'type'		=>	'select',
					'desc'		=>	__('Select <strong>Yes</strong> if you want to display featured image at the top of your post. Select <strong>No</strong> otherwise.','wi'),
					'options'	=>	array('yes' => __('Yes','wi'), 'no' => __('No','wi')),
					'std'		=>	__('Select','wi'),
				),
				
				array (
					'name'		=>	__('Link to full image?','wi'),
					'id'		=>	'featured-image-link-to-full',
					'type'		=>	'select',
					'desc'		=>	__('Select <strong>Yes</strong> if you want to link your image to full-width image. Select <strong>No</strong> otherwise.','wi'),
					'options'	=>	array('yes' => __('Yes','wi'), 'no' => __('No','wi')),
					'std'		=>	__('Select','wi'),
				),
				
				array (
					'name'		=>	__('Featured Image Crop?','wi'),
					'id'		=>	'single-thumb-crop',
					'type'		=>	'select',
					'desc'		=>	__('If choose crop, featured image will be fixed in height (770x420px). If choose nocrop, featured image will be auto height (770px in width and height depends on each image proportion).','wi'),
					'options'	=>	array('yes' => __('Yes','wi'), 'no' => __('No','wi')),
					'std'		=>	__('Select','wi'),
				),
				
			),	// end fields	
	
	); // end metaboxes
	
/* --------------------------------------------------- */
/* Post Format Options
/* --------------------------------------------------- */				

	$meta_boxes[] = array (
		'id'			=>		'post-format-options',
		'title'			=>		__('Post Format Options','wi'),
		'pages'			=>		array ('post'),
		'context'		=>		'normal',
		'priority'		=>		'high',
		'fields'		=>		array (
				
				// video & audio
				array (
					'type'		=>	'heading',
					'name'		=>	__('Video & Audio format options','wi'),
					'id'		=>	'heading-video-audio-format',
				),
		
				array (
					'name'		=>	__('Video / Audio Code','wi'),
					'id'		=>	'media',
					'type'		=>	'textarea',
					'desc'		=>	__('YouTube, Vimeo, SoundCloud...','wi'),
				),
				
				array (
					'name'		=>	__('Self-hosted video / audio URL','wi'),
					'id'		=>	'self-hosted-media',
					'type'		=>	'textarea',
					'desc'		=>	__('If you have a self-hosted video/audio file, please paste the file URL here. Eg: <em>http://yourdomain.com/path/path/file.mp3</em>','wi'),
				),
				
				// link
				array (
					'type'		=>	'heading',
					'name'		=>	__('Link format options','wi'),
					'id'		=>	'heading-link-format',
				),
				
				array (
					'name'		=>	__('URL','wi'),
					'id'		=>	'url',
					'type'		=>	'url',
					'desc'		=>	__('Enter URL, start with http:// or https://','wi'),
				),
				
				array (
					'name'		=>	__('Link target','wi'),
					'id'		=>	'target',
					'type'		=>	'select',
					'options'	=>	array( '_self' => __('Same tab','wi'), '_blank' => __('New Tab','wi'), ),
					'std'		=>	__('Select','wi'),
				),
				
				// quote
				array (
					'type'		=>	'heading',
					'name'		=>	__('Quote format options','wi'),
					'id'		=>	'heading-quote-format',
				),
				
				array (
					'name'		=>	__('Quote content','wi'),
					'id'		=>	'quote-content',
					'type'		=>	'textarea',
				),
				
				array (
					'name'		=>	__('Quote author name','wi'),
					'id'		=>	'quote-author',
					'type'		=>	'text',
				),
				
				array (
					'name'		=>	__('Quote author URL?','wi'),
					'id'		=>	'quote-author-url',
					'type'		=>	'text',
				),
								
				// gallery
				array (
					'type'		=>	'heading',
					'name'		=>	__('Gallery options','wi'),
					'id'		=>	'heading-gallery',
				),
				
				array (
					'name'		=>	__('Upload Images','wi'),
					'id'		=>	'gallery-images',
					'type'		=>	'thickbox_image',
				),
				
				array (
					'name'		=>	__('Show navigation?','wi'),
					'id'		=>	'gallery-navi',
					'type'		=>	'checkbox',
					'std'		=>	true,
				),
								
				array (
					'name'		=>	__('Auto play','wi'),
					'id'		=>	'gallery-auto',
					'type'		=>	'checkbox',
					'std'		=>	true,
				),
				
				array (
					'name'		=>	__('Smooth Height?','wi'),
					'id'		=>	'smooth-height',
					'type'		=>	'checkbox',
					'std'		=>	false,
				),
				
				array (
					'name'		=>	__('Effect','wi'),
					'id'		=>	'gallery-effect',
					'type'		=>	'select',
					'options'	=>	array ( 'slide' => __('Slide','wi'), 'fade' => __('Fade','wi'), ),
					'std'		=>	__('Select','wi'),
				),
		
		),	// end fields	
	
	); // end metaboxes
	
/* --------------------------------------------------- */
/* Page Options
/* --------------------------------------------------- */

$patterns_path = get_stylesheet_directory(). '/images/sidrbg/';
$patterns_url = get_template_directory_uri().'/images/sidrbg/';
$pattern_arr = array();
if ( is_dir($patterns_path) ) {
	if ($patterns_dir = opendir($patterns_path) ) {
		while ( ($patterns_file = readdir($patterns_dir)) !== false ) {
			if( (stristr($patterns_file, ".png") !== false || stristr($patterns_file, ".jpg") !== false || stristr($patterns_file, ".gif") !== false ) && stristr( $patterns_file , '2X') === false ) {
				$pattern_arr[ $patterns_url . $patterns_file ] = $patterns_file;
			}
		}    
	}
}
asort( $pattern_arr );

	$meta_boxes[] = array (
		'id'			=>		'page-options',
		'title'			=>		__('Page Options','wi'),
		'pages'			=>		array ('page'),
		'context'		=>		'normal',
		'priority'		=>		'high',
		'fields'		=>		array (
		
				/* title options */
				array (
					'type'		=>	'heading',
					'name'		=>	__('Title Options','wi'),
					'id'		=>	'heading-title-options',
				),
		
				array (
					'name'		=>	__('Subtitle','wi'),
					'id'		=>	'subtitle',
					'type'		=>	'text',
					'desc'		=>	__('Subtitle appears below page title','wi'),
				),
				
				array (
					'name'		=>	__('Title image','wi'),
					'id'		=>	'title-image',
					'type'		=>	'thickbox_image',
					'desc'		=>	__('Title image appears above page title.','wi'),
				),
				
				array (
					'name'		=>	__('Hide title area','wi'),
					'id'		=>	'hide-title-area',
					'type'		=>	'checkbox',
					'desc'		=>	__('This option makes this page\'s title being disabled.','wi'),
				),
				
				
				/* background options */
				array (
					'type'		=>	'heading',
					'name'		=>	__('Background options','wi'),
					'id'		=>	'background-options',
				),
				
				array (
					'name'		=>	__('Background type','wi'),
					'id'		=>	'page-background-type',
					'type'		=>	'select',
					'options'	=>	array(
						''				=>	__('None','wi'),
						'image'			=>	__('Background Image','wi'),
						'pattern'		=>	__('Background Pattern','wi'),
					),
					'desc'		=>	__('Select page background type','wi'),
				),
				
				array (
					'name'		=>	__('Background color','wi'),
					'id'		=>	'page-background-color',
					'type'		=>	'color',
					'desc'		=>	__('Select page background color','wi'),
				),
				
				array (
					'name'		=>	__('Background image','wi'),
					'id'		=>	'page-background-image',
					'type'		=>	'thickbox_image',
					'desc'		=>	__('Select page background image','wi'),
				),
				
				array (
					'name'		=>	__('Background size','wi'),
					'id'		=>	'page-background-image-size',
					'type'		=>	'select',
					'options'	=>	array(
						'auto'			=>	__('Auto','wi'),
						'cover'			=>	__('Cover','wi'),
						'contain'		=>	__('Contain','wi'),
					),
					'std'		=>	'cover',
					'desc'		=>	__('Select page background image size','wi'),
				),
				
				array (
					'name'		=>	__('Background position','wi'),
					'id'		=>	'page-background-image-position',
					'type'		=>	'select',
					'options'	=>	array(
								'left top'			=>	__('Left Top','wi'),
								'left center'		=>	__('Left Center','wi'),
								'left bottom'		=>	__('Left Bottom','wi'),
								'right top'			=>	__('Right Top','wi'),
								'right center'		=>	__('Right Center','wi'),
								'right bottom'		=>	__('Right Bottom','wi'),
								'center top'		=>	__('Center Top','wi'),
								'center center'		=>	__('Center Center','wi'),
								'center bottom'		=>	__('Center Bottom','wi'),
					),
					'std'		=>	'center top',
					'desc'		=>	__('Select page background image size','wi'),
				),
				
				array (
					'name'		=>	__('Background pattern','wi'),
					'id'		=>	'page-background-pattern',
					'type'		=>	'thickbox_image',
					'desc'		=>	__('Select page background pattern','wi'),
				),
				
				array (
					'name'		=>	__('Retina background pattern','wi'),
					'id'		=>	'page-background-pattern-retina',
					'type'		=>	'thickbox_image',
					'desc'		=>	__('An image with double size (2x) of background pattern for retina display.','wi'),
				),
				
				
				/* separator area */
				array (
					'name'		=>	__('Separator Area','wi'),
					'id'		=>	'heading-separator-area',
					'type'		=>	'heading',
				),
				
				array (
					'name'		=>	__('Disable page separator?','wi'),
					'id'		=>	'disable-page-separator',
					'type'		=>	'checkbox',
					'desc'		=>	__('You may want to disable page separator for first page.','wi'),
					'std'		=>	false,
				),
				
				array (
					'name'		=>	__('Separator Content','wi'),
					'id'		=>	'separator-content',
					'type'		=>	'textarea',
					'desc'		=>	__('Use shortcodes to display content','wi'),
				),
				
				array (
					'name'		=>	__('Background image or Pattern?','wi'),
					'id'		=>	'background-image-or-pattern',
					'type'		=>	'select',
					'desc'		=>	__('Select to display background image or a pattern in this area.','wi'),
					'options'	=>	array('background-image' => __('Background image','wi'), 'pattern' => __('Pattern','wi')),
					'std'		=>	__('background-image','wi'),
				),
							
				array (
					'name'		=>	__('Background image?','wi'),
					'id'		=>	'background-image',
					'type'		=>	'thickbox_image',
					'desc'		=>	__('Any size works on Chrome, Firefox and Safari, but at least 1366px width to work on IE8','wi'),
				),
				
				array (
					'type'		=>	'select',
					'name'		=>	__('Select predefined pattern','wi'),
					'id'		=>	'predefined-pattern',
					'options'	=>	$pattern_arr,
					'std'		=>	__('Select','wi'),
				),
				
				array (
					'name'		=>	__('Custom pattern','wi'),
					'id'		=>	'custom-pattern',
					'type'		=>	'thickbox_image',
					'desc'		=>	__('Upload ','wi'),
				),
				
				array (
					'name'		=>	__('Retina custom pattern','wi'),
					'id'		=>	'retina-custom-pattern',
					'type'		=>	'thickbox_image',
					'desc'		=>	__('An image of custom pattern with double size for Retina display.','wi'),
				),
				
				array (
					'name'		=>	__('Overlay\'s Opacity','wi'),
					'id'		=>	'overlay-opacity',
					'type'		=>	'number',
					'desc'		=>	__('A number in the interval from 0 to 100%. Overlay is a layer that makes background more gentle.','wi'),
					'min'		=>	0,
					'max'		=>	100,
					'step'		=>	1,
					'std'		=>	5,
				),
				
				array (
					'name'		=>	__('Clipmask Opacity?','wi'),
					'id'		=>	'clipmask-opacity',
					'type'		=>	'number',
					'desc'		=>	__('Clipmask is a stripe layer that covers background image. If you do not want to show it, just set opacity to 0.','wi'),
					'min'		=>	0,
					'max'		=>	100,
					'step'		=>	1,
					'std'		=>	0,
				),
				
				array (
					'name'		=>	__('Enable parallax effect?','wi'),
					'id'		=>	'enable-parallax-effect',
					'type'		=>	'checkbox',
					'desc'		=>	__('Parallax Effect is the effect that looks like background image is moving.','wi'),
					'std'		=>	false,
				),
						
				array (
					'name'		=>	__('Padding top and bottom','wi'),
					'id'		=>	'padding-top-bottom',
					'type'		=>	'number',
					'min'		=>	20,
					'max'		=>	400,
					'step'		=>	10,
					'std'		=>	60,
					'desc'		=>	__('(px)','wi'),
				),
				
		),	// end fields	
	
	); // end metaboxes
	
	/* --------------------------------------------------- */
	/* Product Options
	/* --------------------------------------------------- */
	
	$meta_boxes[] = array (
		'id'			=>		'product-options',
		'title'			=>		__('Product Options','wi'),
		'pages'			=>		array ('product'),
		'context'		=>		'normal',
		'priority'		=>		'high',
		'fields'		=>		array (
		
				array (
					'name'		=>	__('Product Subtitle','wi'),
					'id'		=>	'product-subtitle',
					'type'		=>	'text',
					'std'		=>	'',
				),
				
				array (
					'name'		=>	__('Product Secondary Image','wi'),
					'id'		=>	'product-secondary-image',
					'type'		=>	'thickbox_image',
					'std'		=>	'',
					'desc'		=>	__('This is the image that appears if you hover the featured image.','wi'),
				),
				
				array (
					'name'		=>	__('Layout','wi'),
					'id'		=>	'product-layout',
					'type'		=>	'select',
					'std'		=>	'',
					'options'	=>	array(
						''			=>	__('Default','wi'), 
						'full' 		=>	__('Fullwidth','wi'),
						'sidebar' 	=>	__('Has sidebar','wi'), 
					),	
				),
				
				array (
					'name'		=>	__('Sidebar Position','wi'),
					'id'		=>	'product-sidebar-position',
					'type'		=>	'select',
					'std'		=>	'',
					'options'	=>	array(
						''			=>	__('Default','wi'),
						'left' 		=>	__('Left','wi'),
						'right' 	=>	__('Right','wi'), 
					),	
				),
				
				array (
					'name'		=>	__('Number of related products to show','wi'),
					'id'		=>	'product-related-number',
					'type'		=>	'select',
					'std'		=>	'',
					'options'	=>	array(
						''			=>	__('Default','wi'),
						'2' 		=>	2,
						'3' 		=>	3,
						'4' 		=>	4,
						'5' 		=>	5,
						'6' 		=>	6,
						'7' 		=>	7,
						'8' 		=>	8,
						'9' 		=>	9,
						'10' 		=>	10,
						'11' 		=>	11,
						'12' 		=>	12,
					),	
				),
				
				array (
					'name'		=>	__('Number of items per row','wi'),
					'id'		=>	'product-related-per-row',
					'type'		=>	'select',
					'std'		=>	'',
					'options'	=>	array(
						''			=>	__('Default','wi'),
						'2' 		=>	2,
						'3' 		=>	3,
						'4' 		=>	4,
						'5' 		=>	5,
						'6' 		=>	6,
					),
					'desc'		=>	__('This applies for up-sells as well.','wi'),	
				),
				
		),
		
	); // meta_boxes	

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