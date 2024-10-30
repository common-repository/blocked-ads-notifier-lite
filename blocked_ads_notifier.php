<?php

/*
Plugin Name: BAN - Blocked Ads Notifier Lite
Plugin URI: http://www.plugarized.com/ban-blocked-ads-notifier-lite
Description: Display notices upon ad block detection
Version: 1.0
Author: Plugarized
Author URI: http://www.plugarized.com
License: GPL2
Copyright 2013  Plugarized http://www.plugarized.com
*/

/*  Copyright 2013  PLUGARIZED  (email : lite@plugarized.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Avoid direct calls to this file
if (!function_exists('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/***************************
* Plugin globals
***************************/
if (!defined('banl_VERSION'))
    define('banl_VERSION', '1.0');
if (!defined('banl_NAME')) 
	define('banl_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));
if (!defined('banl_DIR')) 
	define('banl_DIR', WP_PLUGIN_DIR . '/' . banl_NAME);
if (!defined('banl_URL')) 
	define('banl_URL', WP_PLUGIN_URL . '/' . banl_NAME);

/***************
* Register hooks 
***************/
register_activation_hook(__FILE__,'banl_install'); 
register_deactivation_hook( __FILE__, 'banl_deactivation' );
register_uninstall_hook( __FILE__, 'banl_uninstall' );

/******************************************************
* Create options with default settings upon installation 
******************************************************/
function banl_install() {

if(!get_option('banl_VERSION')) {
add_option('banl_VERSION', '1.0');
    } // end if

//configurable data option
add_option("banl_data", array (
							'loggedU' => 'loggedYes',
							'noticeType' => 'multi',
							'method' => '.wrap',
							'title' => 'Blocked Ads',
							'msg'	=> 'Notice that advertising helps us to pay towards hosting, please whitelist this domain on your ad blocker software.',
							'image' => 'http://i.imgur.com/QrLlW9q.png',
							'containerbg' => '#dd3333',
							'bRadius' =>  5,
							'divClass' => 'advert'
							), '', 'yes');
}

/**********************
* Deactivation function
**********************/
function banl_deactivation() {
//nothing for now					
}

/*******************
* Uninstall function
********************/
function banl_uninstall() {

//delete options upon uninstall
	delete_option('banl_VERSION');
	delete_option('banl_data');
}

/********************
* Create options menu 
********************/
if ( is_admin() ){
add_action('admin_init', 'banl_plugin_init');
add_action('admin_menu', 'banl_plugin_menu');

	function banl_plugin_init() {
    //Register admin scripts
        wp_register_script( 'banl_admin_js', plugins_url('assets/js/banl_admin.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		wp_register_style('banl_admin_styles', plugins_url('assets/css/banl_admin_styles.css', __FILE__));
    }

	function banl_plugin_menu() {
	//Register admin menu
	$page_hook_suffix =	add_menu_page('BAN - Blocked Ads Notifier lite', 
						'Blocked Ads Notifier Lite', 
						'manage_options', 
						'banl_options', 
						'banl_display_menu',
						banl_URL . '/assets/css/images/icon.png'
						);
	add_action('admin_print_scripts-' . $page_hook_suffix, 'banl_admin_scripts');
	add_action( 'admin_head-' . $page_hook_suffix, 'banl_radius_slider' );
	}
	
	//Admin scripts
	function banl_admin_scripts() {
        wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script('banl_admin_js');
		wp_enqueue_style('banl_admin_styles');
	}
	
	//Radius slider
	function banl_radius_slider() {
	$options = get_option('banl_data');
	?>
	<script type="text/javascript">
	jQuery(function($) {
		if($("#slider-range-min").length){
			$( "#slider-range-min" ).slider({
			  range: "min",
			  value: <?php echo $options['bRadius']; ?>,
			  min: 0,
			  max: 25,
			  slide: function( event, ui ) {
				$( "#pixels" ).val( ui.value );
			  }
			});
			$( "#pixels" ).val( $( "#slider-range-min" ).slider( "value" ) );
		}
	});
	</script>
	<?php
	}
	
}

/*****************************
* Front end scripts and styles 
*****************************/
add_action('wp_enqueue_scripts', 'banl_scripts');
function banl_scripts() {
	//Scripts
	wp_register_script('banl_advertisement', plugins_url('assets/js/advertisement.js', __FILE__), true );
	wp_enqueue_script('banl_advertisement');
		
	//Styles
	wp_register_style('banl_styles', plugins_url('assets/css/banl_styles.css', __FILE__));
	wp_enqueue_style('banl_styles');
}
	

	
/********************
* Require other files 
********************/
require_once('inc/banl.php');
require_once('inc/options.php');

?>