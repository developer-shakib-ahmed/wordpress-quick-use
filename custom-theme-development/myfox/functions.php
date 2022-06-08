<?php

/* wordPress comment reply ajax call ********************************************/
function comment_scripts(){

   if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

}

add_action( 'wp_enqueue_scripts', 'comment_scripts' );


/* Latest wordPress jQuery call ********************************************/	
	function myfox_latest_jquery_call() {
		wp_enqueue_script('jquery');
	}
	add_action('init', 'myfox_latest_jquery_call');


	/* WordPress dynamic Menu register function ********************************************/
	// add menu support and fallback menu if menu doesn't exist
	add_action('init', 'wpj_register_menu');
	function wpj_register_menu() {
		if (function_exists('register_nav_menu')) {
			register_nav_menu( 'wpj-main-menu', __( 'Main Menu', 'myfox' ) );
		}
	}
	function wpj_default_menu() {
		echo '<ul id="nav">';
		if ('page' != get_option('show_on_front')) {
			echo '<li><a href="'. home_url() . '/">Home</a></li>';
		}
		wp_list_pages('title_li=');
		echo '</ul>';
	}


	include_once('include/shortcodes.php');
	include_once('include/shortcode-list.php');
	include_once('include/custom-post.php');
	include_once('include/widget.php');


	/* Image resize function ********************************************/	
	add_image_size( 'stunning-demo', 280, 350 );//width * height
	add_image_size( 'stunning-demo-large', 800, 600 );//width * height
	add_image_size( 'post-thumb', 370, 170 );//width * height
	add_image_size( 'my-blog-thumbs', 850, 450 );//width * height


	/* Add Theme Support function ********************************************/	
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'slider-items', 'feature-items', 'stunning-items', 'testimonial-items', 'introduce-items') );

	// widget shortcode filter function //
	add_filter( 'widget_text', 'do_shortcode' );




/* Excerpt ********************************************/
	/* Make the "read more" link to the post */
	function new_excerpt_more($more) {
	    global $post;
		return '<span style="margin-left:0px;" class="read_more"></span>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
	/* Set the excerpt length */
	function new_excerpt_length($length) {
		return 25;//default--$length == 57
	}
	add_filter('excerpt_length', 'new_excerpt_length');



// This is Theme option frame-work include function.........



// custom fields meta box hide functions

// add_action('admin_init','remove_custom_meta_boxes');

// function remove_custom_meta_boxes() {
// 	remove_meta_box('postcustom','post','normal');
// 	remove_meta_box('postcustom','page','normal');
// 	remove_meta_box('postcustom','feature-items','normal');
// 	remove_meta_box('postcustom','funfact-items','normal');
// 	remove_meta_box('postcustom','mobile-left-items','normal');
// 	remove_meta_box('postcustom','mobile-right-items','normal');
// 	remove_meta_box('postcustom','testimonial-items','normal');
// }



/*Redux-Framework file add functions *******************************************************************************************************/

require_once('redux-theme-option/ReduxCore/framework.php');
require_once('redux-theme-option/sample/config.php');// this is our working file


/*Custom-Meta-Box-2-Framework file add functions *******************************************************************************************************/

require_once('custom-meta-box/init.php');
require_once('custom-meta-box/cmb-functions.php');// this is our working file

?>