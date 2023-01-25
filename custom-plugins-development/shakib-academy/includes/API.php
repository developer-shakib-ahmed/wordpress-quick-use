<?php

namespace Shakib\Academy;

/**
 * API handler class
 */
class API {

  public function __construct() {

    add_action( 'rest_api_init', [ $this, 'register_api' ] );

  }



  /**
   * Register api handler
   */
  public function register_api() {

    $addressbook = new API\Addressbook();

    $addressbook->register_routes();

  }

}