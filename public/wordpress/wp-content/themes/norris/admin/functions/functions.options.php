<?php
add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

/*-----------------------------------------------------------------------------------*/
/* General */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> __('General','wi'),
						"type" 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "icon-settings.png"
				);
				
$of_options[] = array( 	'name' 		=> __('General','wi'),
						'type' 		=> 'info',
						'std'		=>	__('General','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Disable onepage mode?','wi'),
						'type' 		=> 'switch',
						'std'		=>	false,
						'id'		=>	'disable-onepage',
						'desc'		=>	__('Turn it ON to disable <strong>Onepage</strong> mode and turn into <strong>Multi-pages</strong>.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Enable responsive layout?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'responsive',
						'desc'		=>	__('If turned OFF, your site on mobile devices will look the same as on the desktop screen','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Enable Scroll to top button?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'scrollup',
						'desc'		=>	__('Scroll top button is the small square button at the bottom right.','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Enable theme colorbox?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'colorbox',
						'desc'		=>	__('Norris has included Colorbox plugin. Turn it OFF if you don\'t want to use it or you want to use your own plugin.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Header Code','wi'),
						'type' 		=> 'textarea',
						'std'		=>	'',
						'id'		=>	'header-code',
						'desc'		=>	__('You can load Google fonts here.','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Footer Code','wi'),
						'type' 		=> 'textarea',
						'std'		=>	'',
						'id'		=>	'footer-code',
						'desc'		=>	__('You can Google Analytics tracking code or something here.','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Custom CSS','wi'),
						'type' 		=> 'textarea',
						'std'		=>	'',
						'id'		=>	'custom-css',
						'desc'		=>	__('If you know a little about CSS, you can write your custom CSS here. Do not edit CSS files (will be lost when you update this theme).','wi'),
				);

	/* Icons */
$of_options[] = array( 	'name' 		=> __('Icons','wi'),
						'type' 		=> 'info',
						'std'		=>	__('Icons','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Favicon','wi'),
						'type' 		=> 'media',
						'id'		=>	'favicon',
						'desc'		=>	__('Favicon is a small icon image at the topbar of your browser. Should be 16x16px or 32x32px image (png, ico...)','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Apple iPhone icon (57x57px)','wi'),
						'type' 		=> 'media',
						'id'		=>	'apple-iphone-icon',
						'desc'		=>	__('Similar to the Favicon, the <strong>Apple iPhone icon</strong> is a file used for a web page icon on the Apple iPhone. When someone bookmarks your web page or adds your web page to their home screen this icon is used. If this file is not found these Apple products will use the screen shot of the web page, which often looks like no more than a white square.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Apple iPhone retina icon (114x114px)','wi'),
						'type' 		=> 'media',
						'id'		=>	'apple-iphone-retina-icon',
						'desc'		=>	__('The same as Apple iPhone icon but for Retina iPhone.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Apple iPad icon (72x72px)','wi'),
						'type' 		=> 'media',
						'id'		=>	'apple-ipad-icon',
						'desc'		=>	__('The same as Apple iPhone icon but for iPad.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Apple iPad Retina icon (144x144px)','wi'),
						'type' 		=> 'media',
						'id'		=>	'apple-ipad-retina-icon',
						'desc'		=>	__('The same as Apple iPhone icon but for Retina iPad.','wi'),
				);
				
/*-----------------------------------------------------------------------------------*/
/* Toparea
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Top area','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "icon-home.png",
				);
				
$of_options[] = array( 	'name' 		=>	__('Top area content','wi'),
						'type' 		=>	'textarea',
						'std'		=>	'[toparea_small]Founded February 20, 2013[/toparea_small]
[toparea_big]Withemes[/toparea_big]
[toparea_small]We create elegant and clean Wordpress themes[/toparea_small]
[spacer]
[button color="none" scroll="true" icon="angle-right" icon_position="right" link="#about-us"]Get Started[/button]',
						'id'		=>	'top-area-content',
						'desc'		=>	__('You can use both shortcodes and HTML for this field.','wi'),
				);				

$of_options[] = array( 	'name' 		=> __('Top area type','wi'),
						'type' 		=> 'select',
						'std'		=>	'bg-fullscreen',
						'id'		=>	'top-area-type',
						'options'	=>	array(
										'bg-fullscreen'			=>	__('Fullscreen background image','wi'),
										'bg-not-fullscreen'		=>	__('Not fullscreen background image','wi'),
										'slider-fullscreen'		=>	__('Fullscreen background slideshow','wi'),
										'slider-not-fullscreen'	=>	__('Not fullscreen background slideshow','wi'),
										'fullwidth-content'		=>	__('Fullwidth Content','wi'),
										'none'					=>	__('Do not display top area.','wi'),
										),
						'desc'		=>	__('Select a type and scroll to respective option area below.','wi'),
				);
								
$of_options[] = array( 	'name' 		=> __('Background image','wi'),
						'type' 		=> 'media',
						'std'		=>	get_template_directory_uri() . '/images/wooden.jpg',
						'id'		=>	'toparea-bg-background-image',
						'desc'		=>	__('Any size works well on Chrome/Firefox/Safari but at least 1366px in width to work on IE8.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Padding top & bottom (px)','wi'),
						'type' 		=> 'sliderui',
						'id'		=>	'toparea-bg-padding-top-bottom',
						'std'		=>	100,
						'min'		=>	10,
						'max'		=>	400,
						'step'		=>	10,
						'desc'		=>	__('This option is used for not-fullscreen mode.','wi'),
				);				
			
$of_options[] = array( 	'name' 		=> __('Slides','wi'),
						'type' 		=> 'slider',
						'std'		=>	'',
						'id'		=>	'toparea-slider-slider',
				);
				
$of_options[] = array( 	'name' 		=>	__('Slideshow effect','wi'),
						'type' 		=> 'select',
						'std'		=>	'slideRight',
						'options'	=>	array(										
										'fade'			=>	__('Fade','wi'),
										'slideTop'		=>	__('Slide top','wi'),
										'slideBottom'	=>	__('Slide bottom','wi'),
										'slideRight'	=>	__('Slide right','wi'),
										'slideLeft'		=>	__('Slide left','wi'),
										'carouselRight'	=>	__('Carousel right','wi'),
										'carouselLeft'	=>	__('Carousel left','wi'),
										'none'			=>	__('None','wi'),
										),
						'id'		=>	'toparea-slider-fullscreen-effect',
						'desc'		=>	__('This option is used only for fullscreen slideshow.','wi'),
				);
				
$of_options[] = array( 	'name' 		=>	__('Not fullscreen slideshow effect','wi'),
						'type' 		=> 'select',
						'std'		=>	'slide',
						'options'	=>	array(										
										'fade'			=>	__('Fade','wi'),
										'slide'			=>	__('Slide','wi'),
										),
						'id'		=>	'toparea-slider-not-fullscreen-effect',
						'desc'		=>	__('This option is used only for not-fullscreen slideshow.','wi'),
				);
				
$of_options[] = array( 	'name' 		=>	__('Parallax Effect?','wi'),
						'type' 		=>	'switch',
						'std'		=>	false,
						'id'		=>	'top-area-parallax',
						'desc'		=>	__('Enable parallax effect for top area','wi'),
				);								

$of_options[] = array( 	'name' 		=> __('Overlay opacity','wi'),
						'type' 		=> 'sliderui',
						'id'		=>	'toparea-bg-overlay-opacity',
						'std'		=>	60,
						'min'		=>	1,
						'max'		=>	100,
						'step'		=>	1,
						'desc'		=>	__('The bigger number is, the darker background should be.','wi'),
				);																							

$of_options[] = array( 	'name' 		=> __('Auto play?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'toparea-slider-auto',
				);
				
$of_options[] = array( 	'name' 		=>	__('Time between 2 slides (in seconds)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	5,
						'min'		=>	1,
						'max'		=>	20,
						'step'		=>	1,
						'id'		=>	'toparea-slider-time-interval',
						'desc'		=>	__('The time interval between 2 slides (if auto play is enabled).','wi'),
				);
				
$of_options[] = array( 	'name' 		=>	__('Show navigation?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'toparea-slider-navi',
				);				

$of_options[] = array( 	'name' 		=>	__('Show pager?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'toparea-slider-pager',
				);
				

$of_options[] = array( 	'name' 		=>	__('Show progress bar for fullscreen slideshow?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'toparea-slider-fullscreen-progress',
				);
				
/*-----------------------------------------------------------------------------------*/
/* Header
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Header','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "header.png",
				);

	/* Header */
$of_options[] = array( 	'name' 		=>	__('Header','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Header','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Header layout','wi'),
						'type' 		=> 'select',
						'std'		=>	'span3',
						'id'		=>	'header-proportion',
						'options'	=>	array(
										'span2'	=>	__('2:10','wi'),
										'span3'	=>	__('3:9','wi'),
										'span4'	=>	__('4:8','wi'),
										'span5'	=>	__('5:7','wi'),
										'span6'	=>	__('6:6','wi'),
										),
						'desc'		=>	__('These proportions are proportion between logo area and navigation area. If you have a big logo, you should choose 4:8 or 5:7 for example.','wi'),
				);
				
$of_options[] = array( 	'name' 		=>	__('Header always stick?','wi'),
						'type' 		=>	'switch',
						'std'		=>	false,
						'id'		=>	'header-always-stick',
						'desc'		=>	__('Turn it ON to make header is always stick at the top, on all pages (by default, it\'s stuck only on Onepage for navigation purpose).','wi'),
				);
				
$of_options[] = array( 	'name' 		=>	__('Header at very top?','wi'),
						'type' 		=>	'switch',
						'std'		=>	false,
						'id'		=>	'header-at-top',
						'desc'		=>	__('Turn it ON if you want to display header at very top of your site.','wi'),
				);				
				
$of_options[] = array( 	'name' 		=>	__('Header top black line?','wi'),
						'type' 		=>	'switch',
						'std'		=>	true,
						'id'		=>	'header-top-black-line',
						'desc'		=>	__('Turn it OFF if you do not want to show header top black line.','wi'),
				);				
				
	/* Logo */
$of_options[] = array( 	'name' 		=>	__('Logo','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Logo','wi'),
				);
				
				

$of_options[] = array( 	'name' 		=> __('Use text logo','wi'),
						'type' 		=> 'switch',
						'std'		=>	false,
						'id'		=>	'text-logo',
						'desc'		=>	__('Turn it ON if you want to use text logo instead of image logo.','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Logo','wi'),
						'type' 		=> 'media',
						'id'		=>	'logo',
						'std'		=>	get_template_directory_uri() . '/images/logo.png',
						'desc'		=>	__('The best size is 200x50px','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Retina logo','wi'),
						'type' 		=> 'media',
						'id'		=>	'retina-logo',
						'std'		=>	get_template_directory_uri() . '/images/logo@2x.png',
						'desc'		=>	__('2x times your logo dimension.','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Logo width (px)','wi'),
						'type' 		=> 'text',
						'id'		=>	'logo-width',
						'std'		=>	'122',
						'desc'		=>	__('Width of your normal logo (not Retina). If you leave this field blank, the Retina logo won\'t work.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Logo height (px)','wi'),
						'type' 		=> 'text',
						'id'		=>	'logo-height',
						'std'		=>	'37',
						'desc'		=>	__('Height of your normal logo (not Retina). If you leave this field blank, the Retina logo won\'t work.','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Logo margin top (px)','wi'),
						'type' 		=> 'sliderui',
						'id'		=> 'logo-margin-top',
						'min'		=>	0,
						'max'		=>	50,
						'step'		=>	1,
						'std'		=>	10,
				);

$of_options[] = array( 	'name' 		=> __('Logo margin left (px)','wi'),
						'type' 		=> 'sliderui',
						'id'		=> 'logo-margin-left',
						'min'		=>	0,
						'max'		=>	200,
						'step'		=>	1,
						'std'		=>	0,
				);

	/* Header style */
$of_options[] = array( 	'name' 		=>	__('Header theme','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Header theme','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Header theme','wi'),
						'type' 		=> 'select',
						'options'	=>	array('light' => __('Light','wi'), 'dark' => __('Dark','wi'),),
						'id'		=>	'header-theme',
						'std'		=>	'light',
				);

/*-----------------------------------------------------------------------------------*/
/* Footer
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Footer','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "footer.png"
				);

$of_options[] = array( 	'name' 		=>	__('Footer text','wi'),
						'type' 		=>	'textarea',
						'id'		=>	'footer-text',
						'std'		=>	'&copy; 2013 '. get_bloginfo('name') .'. All rights reserved. Designed by <a href="http://withemes.com" target="_blank">WiThemes</a>',
						'desc'		=>	__('HTML is allowed.','wi'),
				);

$of_options[] = array( 	'name' 		=>	__('Show social icons on footer','wi'),
						'type' 		=>	'switch',
						'id'		=>	'footer-social',
						'std'		=>	true,
						'desc'		=>	__('If turned ON, social icons will be taken from the social option area.','wi'),
				);
				
$of_options[] = array( 	'name' 		=>	__('Social icon link target?','wi'),
						'type' 		=>	'select',
						'id'		=>	'footer-social-target',
						'std'		=>	'_blank',
						'options'	=>	array('_blank' => __('New Tab','wi') , '_self' => __('Current Tab','wi')),
						'desc'		=>	__('Open social links in current tab/window or new tab/window?','wi'),
				);
				
$of_options[] = array( 	'name' 		=>	__('Display social icon title','wi'),
						'type' 		=>	'switch',
						'id'		=>	'footer-social-title',
						'std'		=>	true,
						'desc'		=>	__('Title is a small text appears when you hover the icon','wi'),
				);								

$of_options[] = array( 	'name' 		=> __('Footer logo','wi'),
						'type' 		=> 'media',
						'id'		=>	'footer-logo',
						'std'		=>	get_template_directory_uri() . '/images/footer-logo.png',
						'desc'		=>	__('The best size should be 100x27px','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Retina footer logo','wi'),
						'type' 		=> 'media',
						'id'		=>	'retina-footer-logo',
						'std'		=>	get_template_directory_uri() . '/images/footer-logo@2x.png',
						'desc'		=>	__('2x times your footer logo dimension.','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Footer logo width (px)','wi'),
						'type' 		=> 'text',
						'id'		=>	'footer-logo-width',
						'std'		=>	'161',
						'desc'		=>	__('Width of your normal footer logo (not Retina). If you leave this field blank, the Retina footer logo won\'t work.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Footer logo height (px)','wi'),
						'type' 		=> 'text',
						'id'		=>	'footer-logo-height',
						'std'		=>	'49',
						'desc'		=>	__('Height of your normal footer logo (not Retina). If you leave this field blank, the Retina footer logo won\'t work.','wi'),
				);

$bg_images_path = get_template_directory(). '/images/sidrbg/'; // change this to where you store your bg images
$bg_images_url = get_template_directory_uri().'/images/sidrbg/'; // change this to where you store your bg images
$bg_images = array();
if ( is_dir($bg_images_path) ) {
	if ($bg_images_dir = opendir($bg_images_path) ) { 
		while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
			if( (stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false || stristr($bg_images_file, ".gif") !== false ) && stristr( $bg_images_file , '2X') === false ) {
				$bg_images[] = $bg_images_url . $bg_images_file;
			}
		}    
	}
}

$of_options[] = array( 	"name" 		=> __('Footer background pattern','wi'),
						"desc" 		=> __('Select footer background pattern','wi'),
						"id" 		=> "footerbg",
						"type" 		=> "tiles",
						"options" 	=> $bg_images,
				);
				
$of_options[] = array( 	"name" 		=> __('Footer custom background pattern','wi'),
						"desc" 		=> __('Upload your own footer background pattern','wi'),
						"id" 		=> "footer-custom-bg",
						"type" 		=> "media",
				);
				
$of_options[] = array( 	"name" 		=> __('Footer custom background pattern (Retina @2x version)','wi'),
						"desc" 		=> __('Upload your own footer background pattern with double sizes.','wi'),
						"id" 		=> "footer-custom-bg-retina",
						"type" 		=> "media",
				);
				
$of_options[] = array( 	"name" 		=> __('Use background color instead of patterns?','wi'),
						"desc" 		=> __('Turn it ON if you want to use color instead of patterns.','wi'),
						"id" 		=> "use-footer-background-color",
						"type" 		=> "switch",
				);
				
$of_options[] = array( 	"name" 		=> __('Footer background color','wi'),
						"desc" 		=> __('Turn it ON if you want to use color instead of patterns.','wi'),
						"id" 		=> "footer-background-color",
						"type" 		=> "color",
				);

/*-----------------------------------------------------------------------------------*/
/* Styling
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Style','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "icon-paint.png"
				);

								
$of_options[] = array( 	'name' 		=>	__('Color','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Color','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Body background color','wi'),
						'type' 		=> 'color',
						'std'		=>	'#fff',
						'id'		=>	'body-background-color',
				);				
				
$of_options[] = array( 	'name' 		=> __('Primary color','wi'),
						'type' 		=> 'color',
						'std'		=>	'#b40606',
						'id'		=>	'primary-color',
						'desc'		=>	__('Primary color is the main color of site.','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Link color','wi'),
						'type' 		=> 'color',
						'std'		=>	'#b40606',
						'id'		=>	'link-color',
				);

$of_options[] = array( 	'name' 		=> __('Selection Color','wi'),
						'type' 		=> 'color',
						'std'		=>	'',
						'id'		=>	'selection-color',
						'desc'		=>	__('Selection color is the background color when you use mouse to select text, elements...','wi'),
				);

				
$of_options[] = array( 	'name' 		=>	__('Options for Dark skin','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Options for Dark skin','wi'),
				);				
				
$of_options[] = array( 	'name' 		=> __('Enable dark skin?','wi'),
						'type' 		=> 'switch',
						'std'		=>	false,
						'id'		=>	'dark-skin',
						'desc'		=>	__('Turn it ON to enable dark skin. Please Note: If you enable dark skin, please go to <strong>Theme Options &raquo; Style</strong> and change body background color to a dark color and go to <strong>Theme Options &raquo; Header</strong>.','wi'),
				);

$of_options[] = array( 	'name' 		=>	__('Header background color?','wi'),
						'type' 		=>	'color',
						'id'		=>	'header-bg-color',
						'desc'		=>	__('Select header background color for dark skin.','wi'),
				);
			
/*-----------------------------------------------------------------------------------*/
/* Typography
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Typography','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "mac-smz-icon.gif"
				);

$of_options[] = array( 	'name' 		=> __('Upercase/Lowercase','wi'),
						'type' 		=> 'info',
						'std'		=>	__('Upercase/Lowercase','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Enable uppercase mode','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'uppercase',
				);
				
$of_options[] = array( 	'name' 		=> __('Font family','wi'),
						'type' 		=> 'info',
						'std'		=>	__('Font family','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Body font','wi'),
						'desc' 		=> __('You can choose a normal font or Google font','wi'),
						'id' 		=> 'body-font',
						'std' 		=> 'Georgia, serif',
						'type' 		=> 'select_google_font',
						'preview' 	=> array(
										'text' => 'This is the preview!', //this is the text from preview box
										'size' => '30px' //this is the text size from preview box
						),
						'options'	=>	wi_fonts_array(),
				);
				
$of_options[] = array( 	'name' 		=> __('Heading font','wi'),
						'desc' 		=> __('You can choose a normal font or Google font','wi'),
						'id' 		=> 'heading-font',
						'std' 		=> 'Oswald',
						'type' 		=> 'select_google_font',
						'preview' 	=> array(
										'text' => 'This is the preview!', //this is the text from preview box
										'size' => '30px' //this is the text size from preview box
						),
						'options'	=>	wi_fonts_array(),
				);
				
$of_options[] = array( 	'name' 		=> __('Navigation font','wi'),
						'desc' 		=> __('You can choose a normal font or Google font','wi'),
						'id' 		=> 'mainnav-font',
						'std' 		=> 'Oswald',
						'type' 		=> 'select_google_font',
						'preview' 	=> array(
										'text' => 'This is the preview!', //this is the text from preview box
										'size' => '30px' //this is the text size from preview box
						),
						'options'	=>	wi_fonts_array(),
				);				
				
$of_options[] = array( 	'name' 		=> __('General font size','wi'),
						'type' 		=> 'info',
						'std'		=>	__('General font size','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Body font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	14,
						'min'		=>	8,
						'max'		=>	28,
						'step'		=>	1,
						'id'		=>	'body-size',
				);

$of_options[] = array( 	'name' 		=> __('H1 font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	36,
						'min'		=>	20,
						'max'		=>	80,
						'step'		=>	1,
						'id'		=>	'h1-size',
				);

$of_options[] = array( 	'name' 		=> __('H2 font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	28,
						'min'		=>	16,
						'max'		=>	64,
						'step'		=>	1,
						'id'		=>	'h2-size',
				);

$of_options[] = array( 	'name' 		=> __('H3 font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	22,
						'min'		=>	12,
						'max'		=>	48,
						'step'		=>	1,
						'id'		=>	'h3-size',
				);
				
$of_options[] = array( 	'name' 		=> __('H4 font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	16,
						'min'		=>	8,
						'max'		=>	32,
						'step'		=>	1,
						'id'		=>	'h4-size',
				);

$of_options[] = array( 	'name' 		=> __('H5 font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	13,
						'min'		=>	8,
						'max'		=>	30,
						'step'		=>	1,
						'id'		=>	'h5-size',
				);

$of_options[] = array( 	'name' 		=> __('H6 font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	13,
						'min'		=>	8,
						'max'		=>	30,
						'step'		=>	1,
						'id'		=>	'h6-size',
				);
				
$of_options[] = array( 	'name' 		=> __('Element font size','wi'),
						'type' 		=> 'info',
						'std'		=>	__('Element font size','wi'),
				);				
				
$of_options[] = array( 	'name' 		=> __('Blog post title font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	28,
						'min'		=>	14,
						'max'		=>	60,
						'step'		=>	1,
						'id'		=>	'blog-title-size',
				);
				
$of_options[] = array( 	'name' 		=> __('Single post title font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	45,
						'min'		=>	20,
						'max'		=>	80,
						'step'		=>	1,
						'id'		=>	'single-post-size',
				);				

$of_options[] = array( 	'name' 		=> __('Page title font size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	65,
						'min'		=>	30,
						'max'		=>	100,
						'step'		=>	1,
						'id'		=>	'page-title-size',
				);
				
$of_options[] = array( 	'name' 		=> __('Top area Big heading size (px)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	100,
						'min'		=>	50,
						'max'		=>	200,
						'step'		=>	2,
						'id'		=>	'toparea-big-heading-size',
				);				
				
/*-----------------------------------------------------------------------------------*/
/* Blog
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Blog','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "icon-docs.png"
				);
				
$of_options[] = array( 	'name' 		=> __('Blog title','wi'),
						'type' 		=> 'text',
						'id'		=>	'blog-title',
						'std'		=> __('Blog','wi'),
						'desc'		=>	__('Blog title','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Blog subtitle','wi'),
						'type' 		=> 'text',
						'id'		=>	'blog-subtitle',
						'std'		=> __('Just tell your stories','wi'),
						'desc'		=>	__('Blog subtitle','wi'),
				);								

$of_options[] = array( 	'name' 		=> __('Display content or excerpt','wi'),
						'type' 		=> 'select',
						'id'		=>	'blog-display',
						'options'	=>	array ( 'excerpt' => __('Excerpt','wi'), 'content' => __('Content','wi') ),
						'std'		=> 'excerpt',
						'desc'		=>	__('Select display post content or excerpt on the blog.','wi'),
				);
			
$of_options[] = array( 	'name' 		=> __('Featured image crop?','wi'),
						'type' 		=> 'switch',
						'id'		=>	'blog-thumb-crop',
						'std'		=>	true,
						'desc'		=>	__('If turned ON, featured images will be fixed in width/height (600x400px). If turned OFF, featured images will be fixed in width and unlimited in height (auto height, suit for portrait images).','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Thumbnail link to post?','wi'),
						'type' 		=> 'switch',
						'id'		=>	'blog-thumb-link-to-post',
						'std'		=>	true,
						'desc'		=>	__('Turn it ON if you want the post thumbnail link to the article. Turn it OFF if you do not want so.','wi'),
				);
				
	/* Meta Options */
$of_options[] = array( 	'name' 		=> __('Blog meta options','wi'),
						'type' 		=> 'info',
						'std'		=>	__('Blog meta options','wi'),
				);				

$of_options[] = array( 	'name' 		=> __('Display post date?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'blog-date',
				);

$of_options[] = array( 	'name' 		=> __('Display comments link in post meta','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'blog-comments-link',
				);

$of_options[] = array( 	'name' 		=> __('Display categories in post meta','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'blog-categories',
				);
				
$of_options[] = array( 	'name' 		=> __('Display author in post meta','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'blog-author',
				);				

$of_options[] = array( 	'name' 		=> __('Excerpt length (words)','wi'),
						'type' 		=> 'sliderui',
						'std'		=>	40,
						'step'		=>	1,
						'min'		=>	10,
						'max'		=>	200,
						'id'		=>	'excerpt-length',
				);

$of_options[] = array( 	'name' 		=> __('Display "Reamore" link','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'blog-readmore',
				);

	/* 404 */
$of_options[] = array( 	'name' 		=> __('404 page','wi'),
						'type' 		=> 'info',
						'std'		=>	__('404 page','wi'),
				);				

$of_options[] = array( 	'name' 		=> __('404 Custom Text','wi'),
						'type' 		=> 'textarea',
						'id'		=>	'404-text',
						'std'		=>	__('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help or go back to <a href="' . esc_url ( home_url() ) . '" rel="home">Homepage</a>.','wi'),
						'desc'		=>	__('The message you want to say to your audiences when they got to 404 page. HTML is allowed.','wi'),
				);

/*-----------------------------------------------------------------------------------*/
/* Single
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Single','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "icon-edit.png"
				);

	/* Featured Image */
$of_options[] = array( 	'name' 		=>	__('Featured Image','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Featured Image','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Display featured image on single post','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'single-featured-image',
						'desc'		=>	__('Turn OFF if you don\'t want to display featured image on single post','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Featured image thumbnail crop?','wi'),
						'type' 		=> 'select',
						'options'	=>	array('yes' => __('Yes','wi'), 'no' => __('No','wi')),
						'std'		=>	'nocrop',
						'id'		=>	'single-thumb-crop',
						'desc'		=>	__('If choose yes, featured image will be fixed in height (600x400px). Otherwise, featured image will be auto height (600px in width and height depends on each image proportion).','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Featured image link to full image?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'single-featured-image-link-to-full',
						'desc'		=>	__('Turn OFF if you don\'t want to link featured image thumbnail to fullwidth image.','wi'),
				);

	/* Meta */
$of_options[] = array( 	'name' 		=>	__('Meta','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Meta','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Display Next / Previous links?','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'single-nav',
						'desc'		=>	__('Turn OFF if you don\'t want to display post navigation links on single post','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Display tags','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'single-tags',
						'desc'		=>	__('Turn OFF if you don\'t want to display post tags on single post','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Display authorbox','wi'),
						'type' 		=> 'switch',
						'std'		=>	true,
						'id'		=>	'single-authorbox',
						'desc'		=>	__('Turn OFF if you don\'t want to display author box on single post','wi'),
				);

/*-----------------------------------------------------------------------------------*/
/* Portfolio
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Portfolio','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "work.png"
				);

	/* Loading Image */
$of_options[] = array( 	'name' 		=>	__('Loading Image','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Loading Image','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Ajax loader image','wi'),
						'type' 		=> 'media',						
						'id'		=>	'portfolio-ajax-loader-image',
						'desc'		=>	__('Select a custom ajax loader image for your portfolio','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Retina ajax loader image','wi'),
						'type' 		=> 'media',
						'id'		=>	'portfolio-retina-ajax-loader-image',
						'desc'		=>	__('Select ajax loader image with double size.','wi'),
				);
				
	/* Labels */			
$of_options[] = array( 	'name' 		=>	__('Custom labels','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Custom labels','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Client label','wi'),
						'type' 		=> 'text',
						'std'		=> __('Client:','wi'),
						'id'		=>	'portfolio-client-label',
						'desc'		=>	__('Select custom text for the word "Client:"','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Location label','wi'),
						'type' 		=> 'text',
						'std'		=> __('Location:','wi'),
						'id'		=>	'portfolio-location-label',
						'desc'		=>	__('Select custom text for the word "Location:"','wi'),
				);				

$of_options[] = array( 	'name' 		=> __('Date label','wi'),
						'type' 		=> 'text',
						'std'		=> __('Date:','wi'),
						'id'		=>	'portfolio-date-label',
						'desc'		=>	__('Select custom text for the word "Date:"','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('URL label','wi'),
						'type' 		=> 'text',
						'std'		=> __('Launch Project:','wi'),
						'id'		=>	'portfolio-url-label',
						'desc'		=>	__('Select custom text for the word "URL:"','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Categories label','wi'),
						'type' 		=> 'text',
						'std'		=> __('Categories:','wi'),
						'id'		=>	'portfolio-cat-label',
						'desc'		=>	__('Select custom text for the word "Categories:"','wi'),
				);
				
/*-----------------------------------------------------------------------------------*/
/* WooCommerce
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('WooCommerce','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "cart.png"
				);
				
	/* Menu */
$of_options[] = array( 	'name' 		=>	__('Cart menu icon','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Cart menu icon','wi'),
				);
				
$of_options[] = array( 	'name' 		=>	__('Display a cart icon on the "Primary menu"','wi'),
						'type' 		=>	'switch',
						'std'		=>	false,
						'id'		=>	'shop-cart-icon',
						'desc' 		=>	__('Display a cart icon next to all menu items.','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Empty cart should?','wi'),
						'type' 		=> 'select',
						'std'		=>	'sidebar',
						'options'	=>	array(
							'cart'	=>	__('Link to Cart page','wi'),
							'shop'	=>	__('Link to Shop page','wi'),
							'custom'=>	__('Link to a custom URL','wi'),
							'hide'	=>	__('Not display','wi'),
						),
						'id'		=>	'shop-cart-menu-empty',
				);				
				
$of_options[] = array( 	'name' 		=>	__('Custom link when empty cart','wi'),
						'type' 		=>	'text',
						'std'		=>	'',
						'id'		=>	'shop-cart-menu-empty-link',
						'desc' 		=>	__('If left blank, it\'ll link to the shop page. If the cart is not empty, it\'ll link to the Cart page.','wi'),
				);										

	/* Shop Archive Page */
$of_options[] = array( 	'name' 		=>	__('Shop Archive','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Shop Archive','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Shop Archive Template','wi'),
						'type' 		=> 'select',
						'std'		=>	'sidebar',
						'options'	=>	array(
							'sidebar'	=>	__('With Sidebar','wi'),
							'fullwidth'	=>	__('Fullwidth','wi'),
						),
						'id'		=>	'shop-template',
				);

$of_options[] = array( 	'name' 		=> __('Sidebar Position','wi'),
						'type' 		=> 'select',
						'std'		=>	'right',
						'options'	=>	array(
							'right'		=>	__('Right','wi'),
							'left'		=>	__('Left','wi'),
						),
						'id'		=>	'shop-sidebar-position',
				);
				
$of_options[] = array( 	'name' 		=>	__('Display WooCommerce Breadcrumb','wi'),
						'type' 		=>	'switch',
						'std'		=>	false,
						'id'		=>	'shop-breadcrumb',
				);
				
$of_options[] = array( 	'name' 		=>	__('Show "sorting"?','wi'),
						'type' 		=>	'switch',
						'std'		=>	true,
						'id'		=>	'shop-display-sorting',
				);
				
$of_options[] = array( 	'name' 		=>	__('Show "result count"?','wi'),
						'type' 		=>	'switch',
						'std'		=>	true,
						'id'		=>	'shop-display-result-count',
				);								

$of_options[] = array( 	'name' 		=>	__('Number of columns (default)','wi'),
						'type' 		=>	'sliderui',
						'std'		=>	4,
						'min'		=>	2,
						'max'		=>	6,
						'id'		=>	'shop-products-column',
				);
				
$of_options[] = array( 	'name' 		=>	__('Number of products per page','wi'),
						'type' 		=>	'text',
						'std'		=>	'',
						'id'		=>	'shop-products-per-page',
						'desc' 		=>	__('Fill it -1 if you want to display all products.','wi'),
				);

	/* Single Product */
$of_options[] = array( 	'name' 		=>	__('Single Product','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Single Product','wi'),
				);
				
$of_options[] = array( 	'name' 		=> __('Template','wi'),
						'type' 		=> 'select',
						'std'		=>	'sidebar',
						'options'	=>	array(
							'sidebar'	=>	__('With Sidebar','wi'),
							'fullwidth'	=>	__('Fullwidth','wi'),
						),
						'id'		=>	'shop-single-template',
				);

$of_options[] = array( 	'name' 		=> __('Sidebar Position','wi'),
						'type' 		=> 'select',
						'std'		=>	'right',
						'options'	=>	array(
							'right'		=>	__('Right','wi'),
							'left'		=>	__('Left','wi'),
						),
						'id'		=>	'shop-single-sidebar-position',
				);				

$of_options[] = array( 	'name' 		=>	__('Display related products?','wi'),
						'type' 		=>	'switch',
						'std'		=>	true,
						'id'		=>	'shop-single-display-related-products',
				);
				
$of_options[] = array( 	'name' 		=>	__('Number of related products to show','wi'),
						'type' 		=>	'sliderui',
						'min'		=>	0,
						'max'		=>	12,
						'std'		=>	4,
						'step'		=>	1,
						'id'		=>	'shop-related-products-number',
				);
				
$of_options[] = array( 	'name' 		=>	__('Number of items per row','wi'),
						'type' 		=>	'sliderui',
						'min'		=>	2,
						'max'		=>	6,
						'std'		=>	4,
						'step'		=>	1,
						'id'		=>	'shop-related-products-column',
				);								
				
/*-----------------------------------------------------------------------------------*/
/* Social Icons
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	'name' 		=> __('Social','wi'),
						'type' 		=> 'heading',
						"icon"		=> ADMIN_IMAGES . "twitter.png"
				);

foreach ( wi_social_array() as $s => $c ):
	
$of_options[] = array( 	'name' 		=>	$c,
						'type' 		=>	'text',
						'std'		=>	'',
						'id'		=>	'social-' . $s,
				);
	
endforeach;

$of_options[] = array( 	'name' 		=>	__('Custom social icon','wi'),
						'type' 		=>	'info',
						'std'		=>	__('Custom social icon','wi'),
				);

$of_options[] = array( 	'name' 		=> __('Custom Social Icon','wi'),
						'type' 		=> 'media',
						'std'		=>	'',
						'id'		=>	'custom-social-icon',
						'desc'		=>	__('Upload your own social icon (40x40 png image)','wi'),
				);
							
$of_options[] = array( 	'name' 		=> __('Custom Social Icon URL','wi'),
						'type' 		=> 'text',
						'std'		=>	'',
						'id'		=>	'custom-social-icon-url',
				);
				
$of_options[] = array( 	'name' 		=> __('Custom Social Icon Title','wi'),
						'type' 		=> 'text',
						'std'		=>	'',
						'id'		=>	'custom-social-icon-title',
				);

/*-----------------------------------------------------------------------------------*/
/* Backup Options */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> __("Backup Options",'wi'),
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> __("Backup and Restore Options",'wi'),
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.','wi'),
				);
				
$of_options[] = array( 	"name" 		=> __("Transfer Theme Options Data",'wi'),
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".','wi'),
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
