<?php

/**
 * Root namespace
 */

namespace Shakib\Academy;

/**
 * The Admin Class
 *
 * This class will handle all admin related classes
 */
class Admin {

	/**
	 * Initializes the class
	 */
	public function __construct() {
		$addressbook = new Admin\Addressbook();

		$this->dispatch_actions( $addressbook );

		new Admin\Menu( $addressbook );
	}



	/**
	 * Address book handler
	 */
	public function dispatch_actions( $addressbook ) {
		add_action( 'admin_init', [$addressbook, 'form_handler'] );
		add_action( 'admin_post_delete-address-action', [$addressbook, 'delete_address'] );
	}
}
