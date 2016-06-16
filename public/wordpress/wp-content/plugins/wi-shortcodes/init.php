<?php
/*
Plugin Name: Wi:Shortcodes
Plugin URI: http://withemes.com
Description: Shortcode plugin from <a href="http://themeforest.net/user/withemes?ref=withemes" target="_blank">Withemes</a>
Version: 1.7
Author: Withemes
Author URI: http://withemes.com
*/

/* Include functions */
require_once( dirname(__FILE__) . '/includes/functions.php' ); // Adds required functions
require_once( dirname(__FILE__) . '/includes/scripts.php' ); // Adds plugin JS and CSS
require_once( dirname(__FILE__) . '/includes/shortcode-functions.php'); // Main shortcode functions
require_once( dirname(__FILE__) . '/includes/mce/wi_shortcodes_tinymce.php'); // Add mce buttons to post editor