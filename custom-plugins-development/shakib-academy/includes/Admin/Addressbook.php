<?php

/**
 * Set namespace
 */

namespace Shakib\Academy\Admin;

use Shakib\Academy\Traits\Form_Error;

/**
 * The Addressbook class
 */
class Addressbook {

	use Form_Error;

	/**
	 * Render addressbook page content
	 *
	 * @return mixed
	 */

	public function render_page() {
		$action = isset($_GET['action']) ? $_GET['action'] : 'list';
		$id     = isset( $_GET[ 'id' ] ) ? intval( $_GET[ 'id' ] ) : 0;

		switch ($action) {
			case 'new':
				$template = __DIR__ . '/view/address-new.php';
				break;

			case 'edit':
				$address  = sk_academy_get_address( $id );
				$template = __DIR__ . '/view/address-edit.php';
				break;

			case 'view':
				$template = __DIR__ . '/view/address-view.php';
				break;

			default:
				$template = __DIR__ . '/view/address-list.php';
				break;
		}

		if (file_exists($template)) {
			include $template;
		}
	}

	/**
	 * Handle the form
	 *
	 * @return void
	 */
	public function form_handler() {
		if (!isset($_POST['submit_address'])) {
			return;
		}

		if (!wp_verify_nonce($_POST['_wpnonce'], 'new-address')) {
			wp_die('Are you cheating?');
		}

		if (!current_user_can('manage_options')) {
			wp_die('Are you cheating?');
		}

		/**
		 * When submit edit address form, we get an id param.
		 */
		$id = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;


		$name    = isset(  $_POST['name']) ? sanitize_text_field($_POST['name']) : '';
		$address = isset(  $_POST['address']) ? sanitize_textarea_field($_POST['address']) : '';
		$phone   = isset(  $_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

		if (empty($name)) {
			$this->errors['name'] = __('Name cannot be empty!', SK_ACADEMY_TEXTDOMAIN);
		}

		if (empty($phone)) {
			$this->errors['phone'] = __('Phone cannot be empty!', SK_ACADEMY_TEXTDOMAIN);
		}

		if (!empty($this->errors)) {
			return;
		}

		$args = [
			'name'    => $name,
			'address' => $address,
			'phone'   => $phone,
		];

		if( $id ) {
			$args['id'] = $id;
		}

		$insert_id = sk_academy_insert_address( $args );

		if ( is_wp_error( $insert_id ) ) {
			wp_die( $insert_id->get_error_message() );
		}

		if ( $id ) {
			$redirected_to = admin_url( 'admin.php?page=shakib-academy&action=edit&id=' . $id .'&updated=true' );
		}
		else{
			$redirected_to = admin_url( 'admin.php?page=shakib-academy&inserted=true' );
		}

		wp_redirect( $redirected_to );
		
		exit;
	}



	/**
	 * Handle address delete
	 * 
	 * @return
	 */
	public function delete_address() {

		if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'delete-address' ) ) {
			wp_die('Are you cheating?');
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating?' );
		}

		$id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

		if( sk_academy_delete_address( $id ) ) {
			$redirected_to = admin_url( 'admin.php?page=shakib-academy&deleted=true' );
		}
		else{
			$redirected_to = admin_url( 'admin.php?page=shakib-academy&deleted=false' );
		}
		
		wp_redirect( $redirected_to );

		exit;

	}
	
}


