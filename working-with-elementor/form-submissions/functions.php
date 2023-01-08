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





function shakib_elementor_submission(){
  $screen_id = get_current_screen()->id;

?>

<?php if($screen_id == 'elementor_page_e-form-submissions' ): ?>
<div style="margin-left: 180px; margin-bottom: 100px;">
  <h2>Submission Reply</h2>

  <?php
    var_dump(get_current_screen());
  ?>
</div>
<?php endif; ?>

<?php
}
add_action('admin_footer', 'shakib_elementor_submission');