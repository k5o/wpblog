<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

// WooFramework
require_once ($functions_path . 'admin-init.php');			// Framework Init

if (get_option('woo_woo_tumblog_switch') == 'true') {
	//Enable Tumblog Functionality and theme is upgraded
	update_option('woo_needs_tumblog_upgrade', 'false');
	update_option('tumblog_woo_tumblog_upgraded', 'true');
	update_option('tumblog_woo_tumblog_upgraded_posts_done', 'true');
	require_once ($functions_path . 'admin-tumblog-quickpress.php');	// Tumblog Dashboard Functionality
}

// Theme specific functionality
require_once ($includes_path . 'theme-options.php'); 		// Options panel settings and custom settings
require_once ($includes_path . 'theme-functions.php'); 		// Custom theme functions
require_once ($includes_path . 'theme-plugins.php');		// Theme specific plugins integrated in a theme
require_once ($includes_path . 'theme-actions.php');		// Theme actions & user defined hooks
require_once ($includes_path . 'theme-comments.php'); 		// Custom comments/pingback loop
require_once ($includes_path . 'theme-js.php');				// Load javascript in wp_head
require_once ($includes_path . 'sidebar-init.php');			// Initialize widgetized areas
require_once ($includes_path . 'theme-widgets.php');		// Theme widgets

if (get_option('woo_woo_tumblog_switch') == 'true') {
	require_once ($includes_path . 'tumblog/theme-tumblog.php');			// Tumblog Output Functions
	require_once ($includes_path . 'tumblog/theme-custom-post-types.php');	// Custom Post Types and Taxonomies
}

// Output stylesheet and custom.css after Canvas custom styling
remove_action('wp_head', 'woothemes_wp_head');
add_action('woo_head', 'woothemes_wp_head');
if (get_option('woo_woo_tumblog_switch') == 'true' && get_option('woo_custom_rss') == 'true') {
	add_filter('the_excerpt_rss', 'woo_custom_tumblog_rss_output');
	add_filter('the_content_rss', 'woo_custom_tumblog_rss_output');
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/











/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>