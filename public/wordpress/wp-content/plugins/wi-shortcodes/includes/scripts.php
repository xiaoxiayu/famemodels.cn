<?php
/**
 * This file loads the CSS and JS necessary for your shortcodes display
 */
if( !function_exists ('wi_shortcodes_scripts') ) :
	function wi_shortcodes_scripts() {
	if( ! is_admin() ){
		wp_register_script ( 'wi-piechart', plugin_dir_url( __FILE__ ) . 'js/jquery.easy-pie-chart.js', array('jquery') , '1.4.0', true);
		wp_register_script ( 'wi-bigtext', plugin_dir_url( __FILE__ ) . 'js/jquery.slabtext.min.js', array('jquery'), '0.1.4', true);
		wp_enqueue_script ( 'wi-fitvids', plugin_dir_url( __FILE__ ) . 'js/jquery.fitvids.js', array('jquery'), '1.0', true );
		wp_enqueue_script ( 'wi-easing', plugin_dir_url( __FILE__ ) . 'js/jquery.easing.1.3.js', array('jquery'), '1.3', true );
		wp_enqueue_script ( 'wi-plugin-shortcodes', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'), '1.0', true );
		wp_register_script ( 'wi-flexslider', plugin_dir_url( __FILE__ ) . 'js/jquery.flexslider-min.js', array('jquery'), '2.1' , true);		
		wp_register_style ( 'wi-flexslider', plugin_dir_url( __FILE__ ) . 'css/flexslider.css' );
		wp_enqueue_style( 'wi-awesome-font', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css' );
		wp_enqueue_style( 'wi-icomoon-font', plugin_dir_url( __FILE__ ) . 'css/icomoon.css' );
		wp_enqueue_style ( 'wi-shortcodes-style', plugin_dir_url( __FILE__ ) . 'css/shortcodes.css');
		wp_enqueue_style ( 'wi-shortcodes-responsive', plugin_dir_url( __FILE__ ) . 'css/responsive.css');
	} // !is_admin
	}
	add_action('wp_enqueue_scripts', 'wi_shortcodes_scripts');
endif;