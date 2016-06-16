<?php
/**
 * This file has all the main shortcode functions
 */
if ( !function_exists('wi_refresh_mce') ){
function wi_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}
}
// init process for button control
add_filter( 'tiny_mce_version', 'wi_refresh_mce');

add_action('init', 'wi_add_shortcode_buttons');
if ( !function_exists('wi_add_shortcode_buttons') ) {
function wi_add_shortcode_buttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )		return;
 
   // Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "wi_add_shortcodes_tinymce_plugin");
		add_filter('mce_buttons', 'wi_register_shortcode_buttons');
	}
}
}
if ( !function_exists('wi_register_shortcode_buttons') ) {
function wi_register_shortcode_buttons($buttons) {	
	array_push($buttons,'wi_shortcodes_button');
	return $buttons;
}
}
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
if ( !function_exists('wi_add_shortcodes_tinymce_plugin') ) {
function wi_add_shortcodes_tinymce_plugin($plugin_array) {
	$plugin_array['wi_shortcodes_button'] = plugin_dir_url( __FILE__ ) .'js/wi_shortcodes_tinymce.js';
	return $plugin_array;
}
}