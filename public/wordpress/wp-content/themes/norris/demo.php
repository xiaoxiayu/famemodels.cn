<?php
add_action( 'after_setup_theme', 'wi_setup_demo' );
if ( !function_exists('wi_setup_demo') ){
function wi_setup_demo(){
global $smof_data;
$demo_style = isset($_GET['demo']) ? $_GET['demo'] : '';
$demo_style = absint($demo_style);

	/* 1 Slider fullscreen
	-------------------------------------------- */
if ( $demo_style == 1 ):

	/* 2 Slider not fullscreen
	-------------------------------------------- */
elseif ( $demo_style == 2 ):
	$smof_data['top-area-type'] = 'slider-not-fullscreen';
	$sliders = array();
	$sliders[0] = array('url'=>'http://norris.withemes.com/wp-content/uploads/2013/10/059.jpg');
	$sliders[1] = array('url'=>'http://norris.withemes.com/wp-content/uploads/2013/10/0993-1024x682.jpg');
	$sliders[2] = array('url'=>'http://norris.withemes.com/wp-content/uploads/2013/10/0242.jpg');
	
	$smof_data['toparea-slider-pager'] = false;
	$smof_data['toparea-slider-slider'] = $sliders;

	/* 3 Parallax Fullscreen
	-------------------------------------------- */
elseif ( $demo_style == 3 ):
	$smof_data['top-area-type'] = 'bg-fullscreen';

	/* 4 Parallax Not fullscreen
	-------------------------------------------- */
elseif ( $demo_style == 4 ):
	$smof_data['top-area-type'] = 'bg-not-fullscreen';

	/* 5 Big Text
	-------------------------------------------- */
elseif ( $demo_style == 5 ):
	$smof_data['top-area-type'] = 'bg-fullscreen';
	$smof_data['top-area-content'] = '[bigtext]Founded February 20, 2013[/bigtext][bigtext bg="true"]We are Withemes[/bigtext][bigtext]We create awesome Wordpress Themes[/bigtext][spacer][button scroll="true" link="#about-us" icon="angle-right"]Get Started[/button]';
	
	/* 6 Big Text II
	-------------------------------------------- */
elseif ( $demo_style == 6 ):
	$smof_data['top-area-type'] = 'bg-fullscreen';
	$smof_data['top-area-content'] = '[separator /][bigtext bg="true"]We are Withemes[/bigtext][spacer height="15" /][separator /][bigtext]We create awesome Wordpress Themes[/bigtext][spacer][button scroll="true" link="#about-us" icon="angle-right"]Get Started[/button]';
	
	/* 7 Social icons
	-------------------------------------------- */
elseif ( $demo_style == 7 ):
	$smof_data['top-area-type'] = 'bg-fullscreen';
	$smof_data['top-area-content'] = '[toparea_small]Founded February 20, 2013[/toparea_small]
[toparea_big]Withemes[/toparea_big]
[toparea_small]We create elegant Wordpress themes[/toparea_small]
[spacer]
[icon icon="facebook" link="#" target="_blank" title="Find us on Facebook" size="44" /]
[icon icon="twitter" link="#" target="_blank" title="Follow us on Twitter" size="44" /]
[icon icon="google-plus" link="#" target="_blank" title="Google+ Profile" size="44" /]
[icon icon="linkedin" link="#" target="_blank" title="Linkedin" size="44" /]
[spacer height="40"]
[button scroll="true" link="#about-us" icon="angle-right"]Get Started[/button]';
	
	/* 8 Image Logo Top area
	-------------------------------------------- */
elseif ( $demo_style == 8 ):
	$smof_data['top-area-type'] = 'bg-fullscreen';
	$smof_data['toparea-bg-overlay-opacity'] = 80;
	$smof_data['top-area-content'] = '<img src="http://norris.withemes.com/wp-content/uploads/2013/10/top-area-logo.png" width="240" alt="Top area Logo" />[spacer height="40"][toparea_small]We are Withemes[/toparea_small][toparea_small]We create awesome Wordpress themes[/toparea_small][spacer][button scroll="true" link="#about-us" icon="angle-right"]Get Started[/button]';

	/* 9 Text Slider
	-------------------------------------------- */
elseif ( $demo_style == 9 ):
	$smof_data['top-area-type'] = 'bg-fullscreen';
	$smof_data['top-area-content'] = '[text_slider pager="true" auto="true" direction="vertical"]<br>[slide]We are Withemes[/slide]<br>[slide]We are designers[/slide]<br>[slide]Founded 2013[/slide]<br>[slide]We love Wordpress[/slide]<br>[/text_slider][spacer][button scroll="true" link="#about-us" icon="angle-right"]Get Started[/button]';

	/* 10 Video
	-------------------------------------------- */
elseif ( $demo_style == 10 ):
	$smof_data['top-area-type'] = 'fullwidth-content';
	$smof_data['top-area-content'] = '[wi_video]http://vimeo.com/75177597[/wi_video]';

	/* 11 Testimonials
	-------------------------------------------- */
elseif ( $demo_style == 11 ):
	$smof_data['top-area-type'] = 'bg-fullscreen';
	$smof_data['top-area-content'] = '[testimonials]
[testimonial name="Chris Ames" from="California, USA"]
Not only it has a super clean & an eye-catching design, but also very easy to customize<br>because the admin panel is full of options.
[/testimonial]
[testimonial name="Michael Novotny" from="EXD Technologies"]
Super clean and awesome template. I\'ve never seen anything else like this. I\'m sure<br>this will be one of the best selling template on Themeforest.
[/testimonial]
[testimonial name="John Saddington" from="MNP Department"]
Super fast support. I have a question and post to support forum.<br>I got the answer after 10 minutes! Incredible!!!
[/testimonial]
[/testimonials]';

	$smof_data['toparea-bg-overlay-opacity'] = 70;
	
	/* 12 Google Map
	-------------------------------------------- */
elseif ( $demo_style == 12 ):
	$smof_data['top-area-type'] = 'fullwidth-content';
	$smof_data['top-area-content'] = '[gmap height="600" src="https://maps.google.com/maps?q=13%2F2+Elizabeth+Street+Melbourne+VIC+3000&amp;hl=en&amp;ll=-37.813886,144.9649&amp;spn=0.029665,0.038581&amp;sll=37.0625,-95.677068&amp;sspn=59.898929,79.013672&amp;hq=13%2F2+Elizabeth+Street+Melbourne+VIC+3000&amp;radius=15000&amp;t=m&amp;z=15&amp;iwloc=A"]';
	$smof_data['header-top-black-line'] = false;
	
	/* 13 Twitter
	-------------------------------------------- */
elseif ( $demo_style == 13 ):
	$smof_data['top-area-type'] = 'bg-fullscreen';
	$smof_data['top-area-content'] = '[latest_tweets username="envato" number="10" navi="true" pager="false" auto="false"]';

	/* 14 Dark Navigation
	-------------------------------------------- */
elseif ( $demo_style == 14 ):
	$smof_data['header-theme'] = 'dark';
	$smof_data['logo'] = 'http://norris.withemes.com/wp-content/uploads/2013/10/white-logo.png';
	$smof_data['retina-logo'] = 'http://norris.withemes.com/wp-content/uploads/2013/10/white-logo@2x.png';

endif;	// demo style

}} // wi setup demo
?>