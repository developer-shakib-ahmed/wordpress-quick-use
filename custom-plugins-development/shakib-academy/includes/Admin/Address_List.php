<?php

/**
 * Set namespace
 */

namespace Shakib\Academy\Admin;


if( ! class_exists( 'WP_List_Table' ) ) {
  require_once ABSPATH . '/wp-admin/includes/class-wp-list-table.php';
}



/**
 * The List Table Class
 */
class Address_List extends \WP_List_Table {

  public function __construct() {
    parent::__construct( [
      'plural'   => 'Addresses',
      'singular' => 'Address',
      'ajax'     => false,
      'screen'   => null,
    ] );
  }



  public function get_columns() {
    return [
      'cb'         => '<input type="checkbox" />',
      'name'       => __('Name', SK_ACADEMY_TEXTDOMAIN),
      'address'    => __('Address', SK_ACADEMY_TEXTDOMAIN),
      'phone'      => __('Phone', SK_ACADEMY_TEXTDOMAIN),
      'created_at' => __('Date', SK_ACADEMY_TEXTDOMAIN),
    ];
  }



  /**
   * Get sortable column
   *
   * @return array
   */
  public function get_sortable_columns() {
    $sortable_columns = [
      'name'       => [ 'name', true],
      'created_at' => [ 'created_at', true]
    ];

    return $sortable_columns;
  }



  protected function column_default($item, $column_name) {
    switch ( $column_name ) {
      case 'value':
        # code...
        break;
      
      default:
        return isset( $item->$column_name ) ? $item->$column_name : '';
    }
  }



  /**
   * Name column markup edit
   */
  public function column_name( $item ) {
    $actions = [];

    $actions['edit'] = sprintf( 
      '<a href="%s" title="%s">%s</a>',
      admin_url( 'admin.php?page=shakib-academy&action=edit&id=' . $item->id ),
      $item->name,
      __('Edit', SK_ACADEMY_TEXTDOMAIN)
    );

    // $actions['delete'] = sprintf( 
    //   '<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');">%s</a>',
    //   wp_nonce_url( admin_url( 'admin-post.php?page=shakib-academy&action=delete-address-action&id=' . $item->id ), 'delete-address' ),
    //   __('Delete', SK_ACADEMY_TEXTDOMAIN)
    // );

    $actions['delete'] = sprintf( 
      '<a href="#" class="submitdelete" data-id="%s">%s</a>',
      $item->id,
      __('Delete', SK_ACADEMY_TEXTDOMAIN)
    );

    return sprintf(
      '<a href="%1$s"><strong>%2$s</strong></a> %3$s',
      admin_url( 'admin.php?page=shakib-academy&action=view&id=' . $item->id ),
      $item->name,
      $this->row_actions( $actions )
    );
  }
  


  /**
   * Bulk edit column markup
   */
  public function column_cb( $item ) {
    return sprintf(
      '<input type="checkbox" name="address_id[]" value="%d">',
      $item->id
    );
  }



  public function prepare_items() {
    $column = $this->get_columns();
    $hidden = [];
    $sortable = $this->get_sortable_columns();

    $this->_column_headers = [ $column, $hidden, $sortable ];

    $per_page = 20;
    $current_page = $this->get_pagenum();
    $offset = ( $current_page - 1 ) * $per_page;

    $args = [
      'per_page' => $per_page,
      'offset'   => $offset,
    ];

    if( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
      $args['orderby'] = $_REQUEST['orderby'];
      $args['order']   = $_REQUEST['order'];
    }

    $this->items = sk_academy_get_addresses( $args );

    $this->set_pagination_args([
      'total_items' => sk_academy_address_count(),
      'per_page' => $per_page,
    ]);
  }
}