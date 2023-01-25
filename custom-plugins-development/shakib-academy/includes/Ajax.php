<?php

namespace Shakib\Academy;

/**
 * Ajax handler class
 */
class Ajax {

  public function __construct() {

    add_action( 'wp_ajax_sk_enquiry_action', [ $this, 'submit_enquiry' ] );
    add_action( 'wp_ajax_nopriv_sk_enquiry_action', [ $this, 'submit_enquiry' ] );
    
    add_action( 'wp_ajax_sk_delete_address_action', [ $this, 'delete_address' ] );
  }



  /**
   * Enquiry submit handler
   */
  public function submit_enquiry() {

    if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'sk-enquiry-form' ) ) {
      wp_send_json_error([
        'message' => 'Nonce verification failed!'
      ]);
    }
    
    wp_send_json_success([
      'message' => 'Enquiry has been sent successfully!'
    ]);

  }



  /**
   * Address delete handler
   */
  public function delete_address() {

    if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'sk_delete_address' ) ) {
      wp_send_json_error([
        'message' => 'Nonce verification failed!'
      ]);
    }

    $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

		if( sk_academy_delete_address( $id ) ) {

      wp_send_json_success([
        'message' => 'Address has been deleted successfully!'
      ]);

		}
    else{
      wp_send_json_error([
        'message' => 'Address delete failed!'
      ]);
    }
    
    

  }

}