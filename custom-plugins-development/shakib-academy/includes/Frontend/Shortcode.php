<?php
  
namespace Shakib\Academy\Frontend;



/**
 * The Shortcode Class
 */
class Shortcode {

  /**
   * Initializes the class
   */
  
  public function __construct() {
    
    add_shortcode( 'shakib_academy', [ $this, 'sh_render_shortcode' ] );

  }



  /**
   * Shortcode render function
   *
   * @param array $atts
   * @param string $content
   *
   * @return string
   */
  public function sh_render_shortcode( $atts, $content = '' ) {

    wp_enqueue_script( 'sk-frontend-script' );
    wp_enqueue_style( 'sk-frontend-style' );

    return '<h2 class="sk-academy-title">Hello from Shakib Academy.</h2>';

  }

}