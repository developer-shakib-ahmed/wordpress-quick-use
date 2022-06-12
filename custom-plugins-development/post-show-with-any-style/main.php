<?php 
/*
	Plugin Name: Post Show With Any Style
	Plugin URI:  https://wordpress.org/plugins/post-show-with-any-style
	Description: This plugin allow to show post with any style like grid, carousel, masonry etc
	Version:     1.0.0
	Author:      Developer Shakib Ahemd
	Author URI:  https://www.shakibahmed.com
	License:     GPL v2 or later
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/



/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}



/**
 * Currently plugin version of (pswas).
 * PSWAS = short form of plugin name
 */
define( 'PSWAS_VERSION', '1.0.0' );



/**
 * define PSWAS plugin path
 */
define( 'PSWAS_PATH', plugin_dir_path( __FILE__ ) );



/**
 * define PSWAS plugin url
 */
define( 'PSWAS_URL', plugin_dir_url( __FILE__ ) );



/**
 * include PSWAS settings file
 */
require PSWAS_PATH . 'includes/pswas_settings.php';



/**
 * include PSWAS shortcode file
 */
require PSWAS_PATH . 'includes/pswas_shortcodes.php';



/**
 * include PSWAS enqueue file
 */
require PSWAS_PATH . 'includes/pswas_enqueue.php';