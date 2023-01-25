<?php
  
namespace Shakib\Academy\Frontend;

/**
 * Enquiry handler class
 */
class Enquiry {

  public function __construct() {
    
    add_shortcode( 'sk_academy_enquiry', [ $this, 'render_shortcode' ] );

  }



  /**
   * Render shortcode
   */
  public function render_shortcode( $atts, $content = null ) {

    wp_enqueue_style( 'sk-enquiry-style' );
    wp_enqueue_script( 'sk-enquiry-script' );

    ob_start();

    include __DIR__ . '/views/enquiry.php';

    return ob_get_clean();

  }




}