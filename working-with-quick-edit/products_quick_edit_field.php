<?php 



function manage_products_columns( $columns, $post_type ) {

	switch ( $post_type ) {	
		case 'products':
			$new_columns = array();			
			foreach( $columns as $key => $value ) {
				$new_columns[ $key ] = $value;
				if ( $key == 'title' ) {
					$new_columns[ 'sponsorship_column' ] = 'Sponsorship';
				}					
			}			
			return $new_columns;			
	}	
	return $columns;	
}
add_filter( 'manage_posts_columns', 'manage_products_columns', 10, 2 );



function manage_products_sortable_columns( $sortable_columns ) {

	$sortable_columns[ 'sponsorship_column' ] = 'sponsorship';
	return $sortable_columns;
	
}
add_filter( 'manage_edit-products_sortable_columns', 'manage_products_sortable_columns' );


function manage_products_custom_column( $column_name, $post_id ) {
	switch( $column_name ) {
	
		case 'sponsorship_column':
		
			echo '<div id="sponsorship-' . $post_id . '">' . get_post_meta( $post_id, '_meta_id_product_sponsorship', true ) . '</div>';
			break;
			
	}
	
}
add_action( 'manage_products_posts_custom_column', 'manage_products_custom_column', 10, 2 );



function manage_products_pre_get_posts( $query ) {

	if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
	
		switch( $orderby ) {
			case 'sponsorship':
				$query->set( 'meta_key', '_meta_id_product_sponsorship' );
				$query->set( 'orderby', 'meta_value' );				
				break;				
		}
	
	}
	
}
add_action( 'pre_get_posts', 'manage_products_pre_get_posts', 1 );



function manage_products_posts_clauses( $pieces, $query ) {
	global $wpdb;
	if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
		$order = strtoupper( $query->get( 'order' ) );
		if ( ! in_array( $order, array( 'ASC', 'DESC' ) ) )
			$order = 'ASC';	
		switch( $orderby ) {
			case 'sponsorship':
				$pieces[ 'join' ] .= " LEFT JOIN $wpdb->postmeta wp_rd ON wp_rd.post_id = {$wpdb->posts}.ID AND wp_rd.meta_key = '_meta_id_product_sponsorship'";				
				$pieces[ 'orderby' ] = "STR_TO_DATE( wp_rd.meta_value,'%m/%d/%Y' ) $order, " . $pieces[ 'orderby' ];				
				break;		
		}	
	}
	return $pieces;
}
add_filter( 'posts_clauses', 'manage_products_posts_clauses', 1, 2 );



function manage_products_bulk_quick_edit_custom_box( $column_name, $post_type ) {
	if($post_type!='products') return;
	if($column_name!='sponsorship_column') return;
?>
	<fieldset class="inline-edit-col-left" style="clear:both;">
		<div class="inline-edit-col">
			<div class="inline-edit-group wp-clearfix">
				<div class="alignleft">
					<span class="title">Sponsorship</span>
					<span style="margin-left:9px;" class="input-text-wrap">
						<label style="display:inline-block;" for="sponsored">
							<input type="radio" id="sponsored" name="_meta_id_product_sponsorship" class="" value="sponsored">Sponsored</label>
					</span>
				</div>
				<div class="alignleft">
					<span style="margin-left:20px;">
						<label style="display:inline-block;" for="affiliate">
							<input type="radio" id="affiliate" name="_meta_id_product_sponsorship" class="" value="affiliate">Affiliate</label>
					</span>
				</div>
			</div>
		</div>
	</fieldset>
<?php
}
add_action( 'quick_edit_custom_box', 'manage_products_bulk_quick_edit_custom_box', 10, 2 );


function manage_products_enqueue_admin_scripts() {

	wp_enqueue_script( 'manage-products-quick-edit', get_parent_theme_file_uri( 'js/products_bulk_quick_edit.js' ), array( 'jquery', 'inline-edit-post' ), '', true );
	
}
add_action( 'admin_print_scripts-edit.php', 'manage_products_enqueue_admin_scripts' );


function manage_products_save_post( $post_id, $post ) {
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
	
		case 'products':
		
			$custom_fields = array( '_meta_id_product_sponsorship' );
			
			foreach( $custom_fields as $field ) {
			
				if ( array_key_exists( $field, $_POST ) )
					update_post_meta( $post_id, $field, $_POST[ $field ] );
					
			}
				
			break;
			
	}
	
}
add_action( 'save_post', 'manage_products_save_post', 10, 2 );



function manage_products_bulk_quick_save_bulk_edit() {
	// we need the post IDs
	$post_ids = ( isset( $_POST[ 'post_ids' ] ) && !empty( $_POST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : NULL;
		
	// if we have post IDs
	if ( ! empty( $post_ids ) && is_array( $post_ids ) ) {
	
		// get the custom fields
		$custom_fields = array( '_meta_id_product_sponsorship' );
		
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
add_action( 'wp_ajax_manage_wp_posts_using_bulk_quick_save_bulk_edit', 'manage_products_bulk_quick_save_bulk_edit' );



?>