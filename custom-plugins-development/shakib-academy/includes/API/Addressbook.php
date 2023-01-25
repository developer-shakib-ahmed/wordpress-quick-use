<?php

namespace Shakib\Academy\API;

use WP_REST_Controller, WP_REST_Server, WP_Error;

/**
 * Addressbook class
 */
class Addressbook extends WP_REST_Controller {

  public function __construct() {

    $this->namespace = 'academy/v1';
    $this->rest_base = 'addresses';
    
  }



  /**
   * Register routes handler
   */
  public function register_routes() {

    register_rest_route(
      $this->namespace,
      '/' . $this->rest_base,
      [
        [
          'methods'             => WP_REST_Server::READABLE,
          'callback'            => [ $this, 'get_items' ],
          'permission_callback' => [ $this, 'get_items_permissions_check' ],
          'args'                => $this->get_collection_params(),
        ],

        [
          'methods'             => WP_REST_Server::CREATABLE,
          'callback'            => [ $this, 'create_item' ],
          'permission_callback' => [ $this, 'create_item_permissions_check' ],
          'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::CREATABLE ),
        ],

        'schema' => [ $this, 'get_item_schema'],
      ]
    );


    register_rest_route(
      $this->namespace,
      '/' . $this->rest_base . '/(?P<id>[\d]+)',
      [
        'args' => [
          'id' => [
            'description' => __( 'Unique identifier for the object.', SK_ACADEMY_TEXTDOMAIN ),
            'type'        => 'integer',
          ],
        ],

        [
          'methods'             => WP_REST_Server::READABLE,
          'callback'            => [ $this, 'get_item' ],
          'permission_callback' => [ $this, 'get_item_permissions_check' ],
          'args'                => [
            'context' => $this->get_context_param( [ 'default' => 'view' ] ),
          ],
        ],

        [
          'methods'             => WP_REST_Server::EDITABLE,
          'callback'            => [ $this, 'update_item' ],
          'permission_callback' => [ $this, 'update_item_permissions_check' ],
          'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::EDITABLE ),
        ],

        [
          'methods'             => WP_REST_Server::DELETABLE,
          'callback'            => [ $this, 'delete_item' ],
          'permission_callback' => [ $this, 'delete_item_permissions_check' ],
        ],

        'schema' => [ $this, 'get_item_schema'],
      ]
    );

  }



  /**
   * Checks if a given request has access
   *
   * @param \WP_REST_Request $request
   *
   * @return boolean
   */
  public function get_items_permissions_check( $request ) {

    if ( current_user_can( 'manage_options' ) ) {
      return true;
    }

    return false;

  }



  /**
   * Retrieves a list of address items
   *
   * @param \WP_REST_Request $request
   * 
   * @return \WP_REST_Response | WP_Error
   */
  public function get_items( $request ) {

    $args = [];
    $params = $this->get_collection_params();

    foreach ($params as $key => $value) {
      if( isset( $request[ $key ] ) ) {
        $args[ $key ] = $request[ $key ];
      }
    }

    // create 'offset' for our function
    $args['offset'] = $args['per_page'] * ( $args['page'] - 1 );

    unset(  $args['page'] );

    $data      = [];
    $addresses = sk_academy_get_addresses( $args );

    foreach ( $addresses as $address ) {
      $response = $this->prepare_item_for_response( $address, $request );
      $data[]   = $this->prepare_response_for_collection( $response );
    }

    $total = sk_academy_address_count();
    $max_pages = ceil( $total / (int) $args['per_page'] );

    $response = rest_ensure_response( $data );

    $response->header( 'X-WP-Total', (int) $total );
    $response->header( 'X-WP-TotalPages', (int) $max_pages );

    return $response;

  }



  /**
   * Get the address, if ID is valid
   * 
   * @param int $id
   * 
   * @return Object|\WP_Error
   */
  protected function get_address( $id ) {

    $address = sk_academy_get_address( $id );

    if( ! $address ) {
      return new WP_Error(
        'rest_address_invalid_id',
        __( 'Invalid address ID', SK_ACADEMY_TEXTDOMAIN ),
        [ 'status' => 404 ],
      );
    }

    return $address;

  }



  /**
   * Checks if a given request has access to get a specific item.
   *
   * @param \WP_REST_Request $request
   *
   * @return \WP_Error|boolean
   */
  public function get_item_permissions_check( $request ) {

    if( ! current_user_can( 'manage_options' ) ) {
      return false;
    }

    $address = $this->get_address( $request['id'] );

    if( is_wp_error( $address ) ) {
      return $address;
    }

    return true;

  }



    /**
   * Retrieves one item from the collection
   *
   * @param \WP_REST_Request $request
   * 
   * @return \WP_Error|\WP_REST_Response
   */
  public function get_item( $request ) {

    $address = $this->get_address( $request['id'] );

    $response = $this->prepare_item_for_response( $address, $request );
    $response = rest_ensure_response( $response );

    return $response;

  }



  /**
   * Checks if a given request has access to create items.
   *
   * @param \WP_REST_Request $request
   *
   * @return \WP_Error|boolean
   */
  public function create_item_permissions_check( $request ) {

    return $this->get_items_permissions_check( $request );

  }



  /**
   * Creates item from the collection
   *
   * @param \WP_REST_Request $request
   * 
   * @return \WP_Error|\WP_REST_Response
   */
  public function create_item( $request ) {

    $address = $this->prepare_item_for_database( $request );

    if( is_wp_error( $address ) ) {
      return $address;
    }

    $address_id = sk_academy_insert_address( $address );

    if( is_wp_error( $address_id ) ) {
      $address_id->add_data( [ 'status' => 400 ] );
      return $address_id;
    }

    $address = $this->get_address( $address_id );
    $response = $this->prepare_item_for_response( $address, $request );
    $response->set_status( 201 );
    $response->header( 'Location', rest_url( sprintf( '%s/%s/%d', $this->namespace, $this->rest_base, $address_id ) ) );

    return rest_ensure_response( $response );

  }



  /**
   * Checks if a given request has access to update a specific item.
   *
   * @param \WP_REST_Request $request Full data about the request
   *
   * @return \WP_Error|boolean
   */
  public function update_item_permissions_check( $request ) {

    return $this->get_item_permissions_check( $request );
  
  }



  /**
   * Updates one item from the collection
   *
   * @param \WP_REST_Request $request
   * 
   * @return \WP_Error|\WP_REST_Response
   */
  public function update_item( $request ) {

    $address = $this->get_address( $request['id'] );

    $prepared = $this->prepare_item_for_database( $request );

    $prepared = array_merge( (array) $address, $prepared );

    $updated = sk_academy_insert_address( $prepared );

    if( ! $updated ) {
      return new WP_Error(
        'rest_address_not_updated',
        __( 'Sorry, the address could not be updated!', SK_ACADEMY_TEXTDOMAIN ),
        [ 'status' => 400 ],
      );
    }

    $address = $this->get_address( $request['id'] );

    $response = $this->prepare_item_for_response( $address, $request );

    return rest_ensure_response( $response );

  }



  /**
   * Checks if a given request has access to delete a specific item.
   *
   * @param \WP_REST_Request $request
   *
   * @return \WP_Error|boolean
   */
  public function delete_item_permissions_check( $request ) {

    return $this->get_item_permissions_check( $request );
  
  }



  /**
   * Delete one item from the collection
   *
   * @param \WP_REST_Request $request
   * 
   * @return \WP_Error|\WP_REST_Response
   */
  public function delete_item( $request ) {

    $address = $this->get_address( $request['id'] );

    $previous = $this->prepare_item_for_response( $address, $request );

    $deleted = sk_academy_delete_address( $request['id'] );

    if( ! $deleted ) {
      return new WP_Error(
        'rest_address_not_deleted',
        __( 'Sorry, the address could not be deleted!', SK_ACADEMY_TEXTDOMAIN ),
        [ 'status' => 400 ],
      );
    }

    $data = [
      'deleted'  => true,
      'previous' => $previous->get_data(),
    ];

    $response = rest_ensure_response( $data );

    return $response;

  }



  /**
   * Prepares one item for create or update oparetion
   *
   * @param \WP_REST_Request $request
   * 
   * @return \WP_Error|object
   */
  public function prepare_item_for_database( $request ) {

    $prepared = [];

    if( isset( $request['name'] ) ) {
      $prepared['name'] = $request['name'];
    }

    if( isset( $request['address'] ) ) {
      $prepared['address'] = $request['address'];
    }

    if( isset( $request['phone'] ) ) {
      $prepared['phone'] = $request['phone'];
    }

    return $prepared;

  }



  /**
   * Prepares the item for the REST response
   * 
   * @param mixed $item WordPress representation of the item.
   * @param \WP_REST_Request $request
   * 
   * @return \WP_Error|WP_REST_Response
   */
  public function prepare_item_for_response( $item, $request ) {

    $data = [];
    $fields = $this->get_fields_for_response( $request );

    if ( in_array( 'id', $fields, true ) ) {
      $data['id'] = (int) $item->id;
    }

    if ( in_array( 'name', $fields, true ) ) {
      $data['name'] = $item->name;
    }

    if ( in_array( 'address', $fields, true ) ) {
      $data['address'] = $item->address;
    }

    if ( in_array( 'phone', $fields, true ) ) {
      $data['phone'] = $item->phone;
    }

    if ( in_array( 'date', $fields, true ) ) {
      $data['date'] = mysql_to_rfc3339( $item->created_at );
    }

    $context = ! empty( $request['context'] ) ? $request['context'] : 'view';
    $data    = $this->filter_response_by_context( $data, $context );
  
    $response = rest_ensure_response( $data );
    $response->add_links( $this->prepare_links( $item ) );

    return $response;
    
  }



  /**
   * Prepare links for the request
   *
   * @param \WP_Post $post Post Object
   *
   * @return array links for the given post
   */
  public function prepare_links( $item ) {

    $base = sprintf( '%s/%s', $this->namespace, $this->rest_base );

    $links = [
      'self' => [
        'href' => rest_url( trailingslashit( $base ) . $item->id ),
      ],
      'collection' => [
        'href' => rest_url( $base ),
      ],
    ];

    return $links;

  }



  /**
   * Retrieves the address schema,
   *
   * @return array
   */
  public function get_item_schema() {

    if ( $this->schema ) {

      return $this->add_additional_fields_schema( $this->schema );

    }

    $schema = [
      '$schema'    => 'http://json-schema.org/draft-04/schema#',
      'title'      => 'address',
      'type'       => 'object',
      'properties' => [
        'id' => [
          'description' => __( 'Unique identifier for the address', SK_ACADEMY_TEXTDOMAIN ),
          'type'        => 'integer',
          'context'     => [ 'view', 'edit' ],
          'readonly'    => true,
        ],
        'name' => [
          'description' => __( 'Name of the address', SK_ACADEMY_TEXTDOMAIN ),
          'type'        => 'string',
          'context'     => [ 'view', 'edit' ],
          'required'    => true,
          'arg_options' => [
            'sanitize_callback' => 'sanitize_text_field',
          ],
        ],
        'address' => [
          'description' => __( 'Show full address', SK_ACADEMY_TEXTDOMAIN ),
          'type'        => 'string',
          'context'     => [ 'view', 'edit' ],
          'required'    => true,
          'arg_options' => [
            'sanitize_callback' => 'sanitize_textarea_field',
          ],
        ],
        'phone' => [
          'description' => __( 'Phone number of the address', SK_ACADEMY_TEXTDOMAIN ),
          'type'        => 'string',
          'context'     => [ 'view', 'edit' ],
          'required'    => true,
          'arg_options' => [
            'sanitize_callback' => 'sanitize_text_field',
          ],
        ],
        'date' => [
          'description' => __( "The date the object was published, in the site's time.", SK_ACADEMY_TEXTDOMAIN ),
          'type'        => 'string',
          'format'      => 'date-time',
          'context'     => [ 'view' ],
          'readonly'    => true,
        ],
      ],
    ];

    $this->schema = $schema;

    return $this->add_additional_fields_schema( $this->schema );

  }



  /**
   * Retrieves the query params for collections
   * 
   * @return array
   */
  public function get_collection_params() {

    $params = parent::get_collection_params();

    unset( $params['search'] );

    return $params;

  }

}