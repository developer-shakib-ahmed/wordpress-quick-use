<?php

/*
Plugin Name: About Me Widget Plugin
Plugin URI: http://www.shakibahmed.com/plugins/about-me-widget
Author: Shakib Ahmed
Author URI: http://www.shakibahmed.com
Description: This plugin for you. You can able to set your or your company details by "About Me Widget Plugin".
Version: 1.0
Text Domain: about_me_widget
License: GPL2
*/

#--------------- PHP output buffering ------------------#
ob_start();
#--------------- PHP output buffering ------------------#



#--------------- Report all PHP errors -----------------#
// error_reporting(E_ALL);
#--------------- Report all PHP errors -----------------#



#--------------- Exit if accessed directly -------------#
if( !defined( 'ABSPATH' ) ) {
    die;
}
#--------------- Exit if accessed directly -------------#



#--------------- define plugin url ---------------------#
define( 'PLUGIN_URL', plugins_url('', __FILE__) );
#--------------- define plugin url ---------------------#



#--------------- Add all fronted files -----------------#
function wp_custom_files_for_test_widget(){
	wp_register_style( 'test-custom-style', plugins_url( '/css/style.css', __FILE__ ), '', '1.0' );
	wp_enqueue_style('test-custom-style');
	
	wp_register_style( 'font-awesome', plugins_url( '/font-awesome/css/font-awesome.min.css', __FILE__ ), '', '4.7.0' );
	wp_enqueue_style('font-awesome');
}
add_action('wp_enqueue_scripts', 'wp_custom_files_for_test_widget');
#--------------- Add all fronted files -----------------#



#--------------- Add all back-end files ----------------#
function admin_custom_files_for_test_widget(){
	wp_enqueue_media();
	wp_register_script( 
		'widget-custom-js',
		plugins_url('/admin/js/widget-custom.js', __FILE__),
		array('jquery'),
		'1.0'
	);
	wp_enqueue_script('widget-custom-js');

	wp_register_style('widget-custom-css', plugins_url('/admin/css/widget-custom.css', __FILE__), '', '1.0');
	wp_enqueue_style('widget-custom-css');

	wp_register_style('font-awesome', plugins_url('/font-awesome/css/font-awesome.min.css', __FILE__), '', '4.7.0');
	wp_enqueue_style('font-awesome');
}
add_action('admin_enqueue_scripts', 'admin_custom_files_for_test_widget');
#--------------- Add all back-end files ----------------#


#--------------- Add extends class of WP_Widget --------#
if(file_exists(dirname(__FILE__).'/admin/inc/widgets.php')){
	require_once(dirname(__FILE__).'/admin/inc/widgets.php');
}
#--------------- Add extends class of WP_Widget --------#