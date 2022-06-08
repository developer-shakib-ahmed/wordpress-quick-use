<?php

#----- wp_enqueue_script -----#
// register for java-script file
function register_java_script_file(){
	wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js', array('jquery'), '1.8.6');

	// Extra Java-Script files
	wp_enqueue_script( 'bootstrap', get_theme_file_uri('/assets/js/bootstrap.min.js'), array('jquery'), '3.2.0', true );
	wp_enqueue_script( 'bootstrap-hover-dropdown', get_theme_file_uri('/assets/js/bootstrap-hover-dropdown.min.js'), array('jquery', 'bootstrap'), '2.0.11', true );
	wp_enqueue_script( 'owl-carousel', get_theme_file_uri('/assets/js/owl.carousel.min.js'), array('jquery', 'bootstrap-hover-dropdown'), '3.2.0', true );
	wp_enqueue_script( 'echo', get_theme_file_uri('/assets/js/echo.min.js'), array('jquery', 'owl-carousel'), '1.6.0', true );
	wp_enqueue_script( 'jquery-easing', get_theme_file_uri('/assets/js/jquery.easing-1.3.min.js'), array('jquery', 'echo'), '1.3', true );
	wp_enqueue_script( 'bootstrap-slider', get_theme_file_uri('/assets/js/bootstrap-slider.min.js'), array('jquery', 'jquery-easing'), '4.0.5', true );
	wp_enqueue_script( 'jquery.rateit', get_theme_file_uri('/assets/js/jquery.rateit.min.js'), array('jquery', 'bootstrap-slider'), '1.0.21', true );
	wp_enqueue_script( 'lightbox', get_theme_file_uri('/assets/js/lightbox.min.js'), array('jquery', 'bootstrap-slider'), '2.7.1', true );
	wp_enqueue_script( 'bootstrap-select', get_theme_file_uri('/assets/js/bootstrap-select.min.js'), array('jquery', 'lightbox'), '1.6.2', true );
	wp_enqueue_script( 'wow', get_theme_file_uri('/assets/js/wow.min.js'), array('jquery', 'bootstrap-select'), '0.1.12', true );
	wp_enqueue_script( 'scripts', get_theme_file_uri('/assets/js/scripts.js'), array('jquery', 'wow'), '1.0', true );
}
add_action('wp_enqueue_scripts', 'register_java_script_file');


// register for css file
function register_style_file(){
	// Bootstrap Core CSS
	wp_enqueue_style( 'bootstrap', get_theme_file_uri('/assets/css/bootstrap.min.css'), array('admin-bar'), '3.2.0', 'all' );

	// Customizable CSS
	wp_enqueue_style( 'main', get_theme_file_uri('/assets/css/main.css'), array('bootstrap'), '1.0', 'all' );
	wp_enqueue_style( 'blue', get_theme_file_uri('/assets/css/blue.css'), array('main'), '1.0', 'all' );
	wp_enqueue_style( 'owl-carousel', get_theme_file_uri('/assets/css/owl.carousel.css'), array('blue'), '1.3.3', 'all' );
	wp_enqueue_style( 'owl-transitions', get_theme_file_uri('/assets/css/owl.transitions.css'), array('owl-carousel'), '1.3.2', 'all' );
	wp_enqueue_style( 'animate', get_theme_file_uri('/assets/css/animate.min.css'), array('owl-transitions'), '1.0', 'all' );
	wp_enqueue_style( 'rateit', get_theme_file_uri('/assets/css/rateit.css'), array('animate'), '1.0', 'all' );
	wp_enqueue_style( 'bootstrap-select', get_theme_file_uri('/assets/css/bootstrap-select.min.css'), array('rateit'), '1.6.2', 'all' );

	// Icons/Glyphs
	wp_enqueue_style( 'font-awesome', get_theme_file_uri('/assets/css/font-awesome.css'), array('rateit'), '4.6.2', 'all' );

	// Theme Root CSS	
	wp_enqueue_style( 'theme-root', get_stylesheet_uri(), array(), '1.0', 'all' );
}
add_action('wp_enqueue_scripts', 'register_style_file');
#----- wp_enqueue_script -----#


#----- add_theme_support -----#
add_theme_support( 'title-tag' );

add_theme_support( 'custom-logo', array(
	// 'default-image'=> get_template_directory_uri().'/img/shop-logo.png',
    'height'       => 150,
    'width'        => 150,
    'flex-height'  => true,
    'flex-width'   => true,
));

add_theme_support( 'post-thumbnails' );

add_theme_support( 'woocommerce' );
#----- add_theme_support -----#


#----- register_nav_menu -----#
register_nav_menu( 'main-menu', 'Main Menu' );
register_nav_menu( 'top-menu', 'Top Menu' );

function default_menu(){
	$menu_create_link = esc_url(home_url('/wp-admin/nav-menus.php'));
	echo '<ul><li><a href="'.$menu_create_link.'">'.'Create Menu'.'</a></ul></li>';
}
#----- register_nav_menu -----#


#----- sidebar-function.php -----#
require_once('inc/sidebar-functions.php');
#----- sidebar-function.php -----#


#----- woocommerce-functions.php -----#
require_once('inc/woocommerce-functions.php');
#----- woocommerce-functions.php -----#




?>