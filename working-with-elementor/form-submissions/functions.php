<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );




/**
 * Admin enqueue scripts & style
 */
function shakib_submission_scripts() {

  $screen_id = get_current_screen()->id;
  
  if( $screen_id == 'elementor_page_e-form-submissions' ) {
    
    wp_enqueue_script( 'shakib-submission', get_stylesheet_directory_uri() . '/js/shakib-submissions.js', array('jquery'), '', true );
    
  }

}
add_action( 'admin_enqueue_scripts', 'shakib_submission_scripts' );



/**
 * Admin notice on submission page
 */
function independence_notice() {
  $screen_id = get_current_screen()->id;

  ?>
    <div style="margin-top: 10px;" class="notice notice-success">
      <p>Shakib notice => {Screen Id: <?php echo $screen_id; ?>}</p>
    </div>
  <?php

}
add_action( 'admin_notices', 'independence_notice' );



function shakib_elementor_submission(){
  $screen_id = get_current_screen()->id;
?>

<?php if($screen_id == 'elementor_page_e-form-submissions' ): ?>

  <div style="margin-top: 0px;" class="notice notice-success">

    <p>Shakib notice => {Screen Id: <?php echo $screen_id; ?>}</p>
    
  </div>

<?php endif; ?>

<?php
}
add_action('admin_footer', 'shakib_elementor_submission');