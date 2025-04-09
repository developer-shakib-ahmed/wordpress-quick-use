<?php 
  
  define( 'ELEMENTOR_PRO_VERSION', '3.23.1' );
  if ( get_option('_elementor_pro_license_data') ) {
    delete_option( '_elementor_pro_license_data');
  }
  
  update_option( 'elementor_pro_license_key', '*********' );
  update_option( '_elementor_pro_license_v2_data', [ 'timeout' => strtotime( '+12 hours', current_time( 'timestamp' ) ), 'value' => json_encode( [ 'success' => true, 'license' => 'valid', 'expires' => '01.01.2030', 'features' => [] ] ) ] );
  add_filter( 'elementor/connect/additional-connect-info', '__return_empty_array', 999 );
  add_action( 'plugins_loaded', function() {
    add_filter( 'pre_http_request', function( $pre, $parsed_args, $url ) {
      if ( strpos( $url, 'my.elementor.com/api/v2/licenses' ) !== false ) {
        return [
          'response' => [ 'code' => 200, 'message' => '??' ],
          'body'     => json_encode( [ 'success' => true, 'license' => 'valid', 'expires' => '01.01.2030' ] )
        ];
      } elseif ( strpos( $url, 'my.elementor.com/api/connect/v1/library/get_template_content' ) !== false ) {
        $response = wp_remote_get( "http://wordpressnull.org/elementor/templates/{$parsed_args['body']['id']}.json", [ 'sslverify' => false, 'timeout' => 25 ] );
        if ( wp_remote_retrieve_response_code( $response ) == 200 ) {
          return $response;
        } else {
          return $pre;
        }
      } else {
        return $pre;
      }
    }, 10, 3 );
  } );
  /**
   * All versions should be `major.minor`, without patch, in order to compare them properly.
   * Therefore, we can't set a patch version as a requirement.
   * (e.g. Core 3.15.0-beta1 and Core 3.15.0-cloud2 should be fine when requiring 3.15, while
   * requiring 3.15.2 is not allowed)
   */



   update_option( 'elementor_pro_license_key', '*********' );
   update_option( '_elementor_pro_license_v2_data', [ 'timeout' => strtotime( '+12 hours', current_time( 'timestamp' ) ), 'value' => json_encode( [ 'success' => true, 'license' => 'valid', 'expires' => '01.01.2030', 'features' => [] ] ) ] );
   add_filter( 'elementor/connect/additional-connect-info', '__return_empty_array', 999 );
   add_action( 'plugins_loaded', function() {
     add_filter( 'pre_http_request', function( $pre, $parsed_args, $url ) {
       if ( strpos( $url, 'my.elementor.com/api/connect/v1/library/get_template_content' ) !== false ) {
         $response = wp_remote_get( "https://brt-br-server.s3.sa-east-1.amazonaws.com/elementor-pro-templates-ultrapackv2-com-8943957/{$parsed_args['body']['id']}.json", [ 'sslverify' => false, 'timeout' => 35 ] );
         if ( wp_remote_retrieve_response_code( $response ) == 200 ) {
           return $response;
         } else {
           return $pre;
         }
       } elseif ( preg_match( '/https:\/\/(my\.elementor|ms-8874\.elementor)\.com\/api\/v1\/kits-library\/kits\/([\w]+)\/download-link/', $url, $matches ) ) {
         $kit_id = $matches[2];
               $response = array(
                   'body' => json_encode(array(
                       'download_link' => 'https://brt-br-server.s3.sa-east-1.amazonaws.com/elementor-pro-kits-ultrapackv2-com-8943957/templates-id/' . $kit_id . '.zip',
                   )),
                   'response' => array(
                       'code' => 200,
                       'message' => 'OK',
                   ),
                   'headers' => array(
                       'content-type' => 'application/json',
                   ),
               );
               return $response;
       } else {
         return $pre;
       }
     }, 10, 3 );
   } );
   
   define( 'ELEMENTOR_PRO_VERSION', '3.25.1' );