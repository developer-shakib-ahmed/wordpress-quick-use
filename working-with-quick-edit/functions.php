<?php 

add_filter( 'manage_posts_columns', 'manage_wp_posts_be_qe_manage_posts_columns', 10, 2 );
function manage_wp_posts_be_qe_manage_posts_columns( $columns, $post_type ) {

	switch ( $post_type ) {	
		case 'post':
			$new_columns = array();			
			foreach( $columns as $key => $value ) {
				$new_columns[ $key ] = $value;
				if ( $key == 'title' ) {
					$new_columns[ 'release_date_column' ] = 'Release Date';
					$new_columns[ 'coming_soon_column' ] = 'Coming Soon';
					$new_columns[ 'film_rating_column' ] = 'Film Rating';
				}					
			}			
			return $new_columns;			
	}	
	return $columns;	
}



add_filter( 'manage_edit-post_sortable_columns', 'manage_wp_posts_be_qe_manage_sortable_columns' );
function manage_wp_posts_be_qe_manage_sortable_columns( $sortable_columns ) {

	$sortable_columns[ 'release_date_column' ] = 'release_date';
	$sortable_columns[ 'film_rating_column' ] = 'film_rating';
	return $sortable_columns;
	
}


add_action( 'manage_posts_custom_column', 'manage_wp_posts_be_qe_manage_posts_custom_column', 10, 2 );
function manage_wp_posts_be_qe_manage_posts_custom_column( $column_name, $post_id ) {
	switch( $column_name ) {
	
		case 'release_date_column':
		
			echo '<div id="release_date-' . $post_id . '">' . get_post_meta( $post_id, 'release_date', true ) . '</div>';
			break;
			
		case 'coming_soon_column':
		
			echo '<div id="coming_soon-' . $post_id . '">' . get_post_meta( $post_id, 'coming_soon', true ) . '</div>';
			break;
			
		case 'film_rating_column':
		
			echo '<div id="film_rating-' . $post_id . '">' . get_post_meta( $post_id, 'film_rating', true ) . '</div>';
			break;
			
	}
	
}



add_action( 'pre_get_posts', 'manage_wp_posts_be_qe_pre_get_posts', 1 );
function manage_wp_posts_be_qe_pre_get_posts( $query ) {

	if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
	
		switch( $orderby ) {
			case 'film_rating':
				$query->set( 'meta_key', 'film_rating' );
				$query->set( 'orderby', 'meta_value' );				
				break;				
		}
	
	}
	
}



add_filter( 'posts_clauses', 'manage_wp_posts_be_qe_posts_clauses', 1, 2 );
function manage_wp_posts_be_qe_posts_clauses( $pieces, $query ) {
	global $wpdb;
	if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
		$order = strtoupper( $query->get( 'order' ) );
		if ( ! in_array( $order, array( 'ASC', 'DESC' ) ) )
			$order = 'ASC';	
		switch( $orderby ) {
			case 'release_date':
				$pieces[ 'join' ] .= " LEFT JOIN $wpdb->postmeta wp_rd ON wp_rd.post_id = {$wpdb->posts}.ID AND wp_rd.meta_key = 'release_date'";				
				$pieces[ 'orderby' ] = "STR_TO_DATE( wp_rd.meta_value,'%m/%d/%Y' ) $order, " . $pieces[ 'orderby' ];				
				break;		
		}	
	}
	return $pieces;
}



// add_action( 'bulk_edit_custom_box', 'manage_wp_posts_be_qe_bulk_quick_edit_custom_box', 10, 2 );
add_action( 'quick_edit_custom_box', 'manage_wp_posts_be_qe_bulk_quick_edit_custom_box', 10, 2 );
function manage_wp_posts_be_qe_bulk_quick_edit_custom_box( $column_name, $post_type ) {

	switch ( $post_type ) {
	
		case 'post':
		
			switch( $column_name ) {
			
				case 'release_date_column':
				
					?><fieldset class="inline-edit-col-left">
						<div class="inline-edit-col">
							<label>
								<span class="title">Release Date</span>
								<span class="input-text-wrap">
									<input type="text" value="" name="release_date">
								</span>
							</label>
						</div>
					</fieldset><?php
					break;
					
				case 'coming_soon_column':
				
					?><fieldset class="inline-edit-col-left">
						<div class="inline-edit-col">
							<label>
								<span class="title">Coming Soon</span>
								<span class="input-text-wrap">
									<label style="display:inline;">
										<input type="radio" name="coming_soon" value="Yes" /> Yes
									</label>&nbsp;&nbsp;
									<label style="display:inline;">
										<input type="radio" name="coming_soon" value="No" /> No
									</label>
								</span>
							</label>
						</div>
					</fieldset><?php
					break;
					
				case 'film_rating_column':
				
					?><fieldset class="inline-edit-col-left">
						<div class="inline-edit-col">
							<label>
								<span class="title">Film rating</span>
								<span class="input-text-wrap">
									<select name="film_rating">
										<option value="">Rating</option>
										<option value="G">G</option>
										<option value="PG">PG</option>
										<option value="PG-13">PG-13</option>
										<option value="R">R</option>
										<option value="NC-17">NC-17</option>
										<option value="X">X</option>
										<option value="GP">GP</option>
										<option value="M">M</option>
										<option value="M/PG">M/PG</option>
									</select>
								</span>
							</label>
						</div>
					</fieldset><?php
					break;
					
			}
			
			break;
			
	}
	
}


function manage_wp_posts_be_qe_enqueue_admin_scripts() {

	wp_enqueue_script( 'manage-wp-posts-using-bulk-quick-edit', get_parent_theme_file_uri( 'js/bulk_quick_edit.js' ), array( 'jquery', 'inline-edit-post' ), '', true );
	
}
add_action( 'admin_print_scripts-edit.php', 'manage_wp_posts_be_qe_enqueue_admin_scripts' );



add_action( 'save_post', 'manage_wp_posts_be_qe_save_post', 10, 2 );
function manage_wp_posts_be_qe_save_post( $post_id, $post ) {
	// pointless if $_POST is empty (this happens on bulk edit)
	if ( empty( $_POST ) )
		return $post_id;
		
	// verify quick edit nonce
	if ( isset( $_POST[ '_inline_edit' ] ) && ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) )
		return $post_id;
			
	// don't save for autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
		
	// dont save for revisions
	if ( isset( $post->post_type ) && $post->post_type == 'revision' )
		return $post_id;
		
	switch( $post->post_type ) {
	
		case 'post':
		
			$custom_fields = array( 'release_date', 'coming_soon', 'film_rating' );
			
			foreach( $custom_fields as $field ) {
			
				if ( array_key_exists( $field, $_POST ) )
					update_post_meta( $post_id, $field, $_POST[ $field ] );
					
			}
				
			break;
			
	}
	
}



add_action( 'wp_ajax_manage_wp_posts_using_bulk_quick_save_bulk_edit', 'manage_wp_posts_using_bulk_quick_save_bulk_edit' );
function manage_wp_posts_using_bulk_quick_save_bulk_edit() {
	// we need the post IDs
	$post_ids = ( isset( $_POST[ 'post_ids' ] ) && !empty( $_POST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : NULL;
		
	// if we have post IDs
	if ( ! empty( $post_ids ) && is_array( $post_ids ) ) {
	
		// get the custom fields
		$custom_fields = array( 'release_date', 'coming_soon', 'film_rating' );
		
		foreach( $custom_fields as $field ) {
			
			// if it has a value, doesn't update if empty on bulk
			if ( isset( $_POST[ $field ] ) && !empty( $_POST[ $field ] ) ) {
			
				// update for each post ID
				foreach( $post_ids as $post_id ) {
					update_post_meta( $post_id, $field, $_POST[ $field ] );
				}
				
			}
			
		}
		
	}
	
}


require_once( 'products_quick_edit_field.php' );


?>
<!-- https://github.com/bamadesigner/manage-wordpress-posts-using-bulk-edit-and-quick-edit/blob/master/manage_wordpress_posts_using_bulk_edit_and_quick_edit.php -->

<!-- https://shibashake.com/wordpress-theme/expand-the-wordpress-quick-edit-menu -->

<!-- https://wpdreamer.com/2012/03/manage-wordpress-posts-using-bulk-edit-and-quick-edit/#add_to_bulk_quick_edit -->

<!-- https://wp-types.com/forums/topic/add-bulkquick-edit-options-for-custom-fields/ -->