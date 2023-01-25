<?php
/**
 * Insert a new address
 *
 * @return int|WP_Error
 */

function sk_academy_insert_address( $args = [] ) {
	global $wpdb;

	$defaults = [
		'name' => '',
		'phone' => '',
		'address' => '',
		'created_by' => get_current_user_id(),
		'created_at' => current_time( 'mysql' ),
	];

	$data = wp_parse_args( $args, $defaults );

	if( isset( $data[ 'id' ] ) ) {

		$id = $data[ 'id' ];
		unset( $data[ 'id' ] );

		$updated = $wpdb->update(
			"{$wpdb->prefix}sk_academy_addresses",
			$data,
			[ 'id' => $id ],
			['%s', '%s', '%s', '%d', '%s'],
			[ '%d' ]
		);

		return $updated;
	}
	else{
		$inserted = $wpdb->insert(
			"{$wpdb->prefix}sk_academy_addresses",
			$data,
			['%s', '%s', '%s', '%d', '%s']
		);

		if ( !$inserted ) {
			return new WP_Error( 'failed-to-insert', __( 'Failed to insert data', SK_ACADEMY_TEXTDOMAIN ) );
		}

		return $wpdb->insert_id;
	}
}



/**
 * Fetch All Addresses
 *
 *
 * @param array $args
 *
 * @return array
 */
function sk_academy_get_addresses( $args = [] ) {
	global $wpdb;

	$defaults = [
		'per_page' => 10,
		'offset'   => 0,
		'orderby'  => 'id',
		'order'    => 'ASC',
	];

	$args = wp_parse_args( $args, $defaults );

	$items = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT * FROM {$wpdb->prefix}sk_academy_addresses ORDER BY {$args['orderby']} {$args['order']} LIMIT {$args['offset']}, {$args['per_page']}"
		)
	);

	return $items;
}



/**
 * Get the count of total addresses
 * 
 * @return int
 */
function sk_academy_address_count(){
	global $wpdb;

	return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}sk_academy_addresses" );
}



/**
 * Fetch a single address from the DB
 *
 * @param int $id
 *
 * @return object
 */
function sk_academy_get_address( $id ) {

	global $wpdb;

	return $wpdb->get_row( 
		$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sk_academy_addresses WHERE id = %d", $id )
	);

}



/**
 * Delete an address
 *
 * @param int $id
 *
 * @return int|boolean
 */
function sk_academy_delete_address( $id ) {

	global $wpdb;

	return $wpdb->delete( $wpdb->prefix . 'sk_academy_addresses', [ 'id' => $id ], [ '%d' ] );

}