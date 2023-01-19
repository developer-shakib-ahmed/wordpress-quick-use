<?php

namespace Shakib\EFSR;

/**
 * Assets handlers class
 */
class Assets {

  public function __construct() {
    
    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );

  }



  /**
   * Scripts get handle
   * 
   * @return array
   */
  public function get_scripts() {

    return [

      'sk-efsr-ajax' => [
        'src'     => SK_EFSR_ASSETS . '/js/sk-efsr-ajax.js',
        'version' => filemtime( SK_EFSR_PATH . '/assets/js/sk-efsr-ajax.js' ),
      ]

    ];

  }



  /**
   * Assets register handle
   */
  public function enqueue_assets() {

    $scripts = $this->get_scripts();

    foreach ($scripts as $handle => $script) {

      $deps = isset( $script['deps'] ) ? $script['deps'] : false;
      
      wp_register_script( $handle, $script['src'], $deps, $script['version'], true );

    }

    wp_localize_script( 'sk-efsr-ajax', 'skAjaxObj', [
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'nonce'   => wp_create_nonce( 'sk-ajax-nonce' ),
      'action'  => 'sk_ajax_action',
    ] );

  }
}