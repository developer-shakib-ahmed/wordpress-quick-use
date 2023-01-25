<?php

namespace Shakib\Academy;

/**
 * Assets handler class
 */
class Assets {

  public function __construct() {

    add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );

  }



  /**
   * Scripts handler
   */
  public function get_scripts() {

    return [

      'sk-frontend-script' => [
        'src'       => SK_ACADEMY_ASSETS . '/js/frontend.js',
        'version'   => filemtime( SK_ACADEMY_PATH . '/assets/js/frontend.js' ),
        'in_footer' => true,
        'deps'      => [ 'jquery' ],
      ],

      'sk-admin-script' => [
        'src'       => SK_ACADEMY_ASSETS . '/js/admin.js',
        'version'   => filemtime( SK_ACADEMY_PATH . '/assets/js/admin.js' ),
        'in_footer' => true,
        'deps'      => [ 'jquery' ],
      ],

      'admin-delete-academy' => [
        'src'       => SK_ACADEMY_ASSETS . '/js/admin-delete-academy.js',
        'version'   => filemtime( SK_ACADEMY_PATH . '/assets/js/admin-delete-academy.js' ),
        'in_footer' => true,
        'deps'      => [ 'jquery', 'wp-util' ],
      ],

      'sk-enquiry-script' => [
        'src'       => SK_ACADEMY_ASSETS . '/js/enquiry.js',
        'version'   => filemtime( SK_ACADEMY_PATH . '/assets/js/enquiry.js' ),
        'in_footer' => true,
        'deps'      => [ 'jquery' ],
      ]

    ];

  }



  /**
   * Style handler
   */
  public function get_styles() {

    return [

      'sk-frontend-style' => [
        'src'     => SK_ACADEMY_ASSETS . '/css/frontend.css',
        'version' => filemtime( SK_ACADEMY_PATH . '/assets/css/frontend.css' ),
      ],

      'sk-admin-style' => [
        'src'     => SK_ACADEMY_ASSETS . '/css/admin.css',
        'version' => filemtime( SK_ACADEMY_PATH . '/assets/css/admin.css' ),
      ],

      'sk-enquiry-style' => [
        'src'     => SK_ACADEMY_ASSETS . '/css/enquiry.css',
        'version' => filemtime( SK_ACADEMY_PATH . '/assets/css/enquiry.css' ),
      ]

    ];

  }



  /**
   * Register enqueue handler
   */
  public function register_assets() {

    $scripts = $this->get_scripts();

    foreach ( $scripts as $handle => $script ) {
      
      $deps = isset( $script['deps'] ) ? $script['deps'] : false;
      wp_register_script( $handle, $script['src'], $deps, $script['version'], $script['in_footer'] );

    }



    $styles = $this->get_styles();

    foreach ( $styles as $handle => $style ) {
      
      $deps = isset( $style['deps'] ) ? $style['deps'] : false;
      wp_register_style( $handle, $style['src'], $deps, $style['version'] );

    }


    
    wp_localize_script( 'sk-enquiry-script', 'skAjaxObj', [
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'error'   => __( 'Something went wrong!', SK_ACADEMY_TEXTDOMAIN ),
    ] );

    wp_localize_script( 'admin-delete-academy', 'skAdminAjax', [
      'nonce'   => wp_create_nonce( 'sk_delete_address' ),
      'action'  => 'sk_delete_address_action',
      'confirm' => __( 'Are you sure?', SK_ACADEMY_TEXTDOMAIN ),
      'error'   => __( 'Something went wrong!', SK_ACADEMY_TEXTDOMAIN ),
    ] );

  }

}