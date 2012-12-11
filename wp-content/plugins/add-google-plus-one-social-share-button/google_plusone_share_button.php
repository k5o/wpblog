<?php
/*
Plugin Name: Add Google Plus one Social Share Button
Description: WordPress plugin for Google +1 (plus one) social share button. Can add the it before post contents, after and also floating on left hand side of the post.
Author: Rohan Pawale
Author URI: http://www.techlunatic.com
Plugin URI: http://www.techlunatic.com
Version: 1.0.0
License: GPL
*/
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2, 
    as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

require_once('gp_admin_page.php');
require_once('gp_display.php');


if (!function_exists('is_admin')) 
{
header('Status: 403 Forbidden');
header('HTTP/1.1 403 Forbidden');
exit();
}

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'google_plus_one_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'google_plus_one_remove' );

function google_plus_one_install() 
{
/* Do Nothing */
	add_option("rp_gpo_button_size", 'standard', '', 'yes');
	add_option("rp_gpo_include_count", 'false', '', 'yes');
	add_option("rp_gpo_button_location", 'top', '', 'yes');
	add_option("rp_gpo_script_load", 'true', '', 'yes');
	add_option("rp_gpo_top_space", '', '', 'yes');
	add_option("rp_gpo_left_space", '', '', 'yes');
	add_option("rp_gpo_position",'fixed','','yes');
}

function google_plus_one_remove() {
/* Deletes the database field */
//delete_option('google_share');
	delete_option('rp_gpo_button_size');
	delete_option('rp_gpo_include_count');
	delete_option('rp_gpo_button_location');
	delete_option('rp_gpo_script_load');
	delete_option('rp_gpo_top_space');
	delete_option('rp_gpo_left_space');
	delete_option('rp_gpo_position');
}

// Add the google plus one js library


function enqueue_rp_gpo_scripts(){

	wp_enqueue_script( 'googleplusone', 'https://apis.google.com/js/plusone.js' );
	
}

if(is_admin())
{
add_action('admin_menu', 'google_plus_one_admin_menu');
add_action( 'wp_print_scripts', 'enqueue_rp_gpo_scripts' );
}
else
{
 add_action('init', 'google_plus_one_share_init');
 $auto = get_option('rp_gpo_button_location');
// if ($auto != 'manual')
	 add_filter('the_content', 'google_plus_one_contents');
}
?>