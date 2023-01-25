<?php

/**
 * Set namespace
 */

namespace Shakib\Academy\Admin;

/**
 * The admin menu handler class
 */
class Menu {

	public $addressbook;



	public function __construct( $addressbook ) {
		$this->addressbook = $addressbook;

		add_action( 'admin_menu', [$this, 'sk_academy_admin_menu_page_register'] );
	}



	public function sk_academy_admin_menu_page_register() {

		$capability = 'manage_options';
		$parent_slug = 'shakib-academy';

		$sk_academy_page_hook = add_menu_page(
			__( 'Shakib Academy', SK_ACADEMY_TEXTDOMAIN ),
			__( 'Academy', SK_ACADEMY_TEXTDOMAIN ),
			$capability,
			$parent_slug,
			[$this->addressbook, 'render_page'],
			'dashicons-welcome-learn-more',
			10
		);

		add_action( 'admin_head-' . $sk_academy_page_hook, [ $this, 'enqueue_assets' ] );

		add_submenu_page(
			$parent_slug,
			__( 'Shakib Academy Address Book', SK_ACADEMY_TEXTDOMAIN ),
			__( 'Address Book', SK_ACADEMY_TEXTDOMAIN ),
			$capability,
			$parent_slug,
			[$this->addressbook, 'render_page'],
			null
		);

		$sk_settings_page_hook = add_submenu_page(
			$parent_slug,
			__( 'Shakib Academy Settings', SK_ACADEMY_TEXTDOMAIN ),
			__( 'Settings', SK_ACADEMY_TEXTDOMAIN ),
			$capability,
			$parent_slug . '-settings',
			[$this, 'sk_academy_settings_page_cb'],
			null
		);

		add_action( 'admin_head-' . $sk_settings_page_hook, [ $this, 'enqueue_assets' ] );
	}



	/**
	 * Render SK_ACADEMY settings page content
	 */
	public function sk_academy_settings_page_cb() {

		echo '<div class="sk-setting-page">';

			echo '<h2>Hello Settings.</h2>';

			$installedTime = get_option( 'sk_academy_installed' );

			echo '<h4>Plugin installed date: ' . date( 'd/m/Y', $installedTime ) . '</h4>';

			echo '<h4>Plugin installed version: ' . get_option( 'sk_academy_version' ) . '</h4>';

			echo '<hr>';
			echo '<h4>FILE: ' . SK_ACADEMY_FILE . '</h4>';
			echo '<h4>PATH: ' . SK_ACADEMY_PATH . '</h4>';
			echo '<h4>URL: ' . SK_ACADEMY_URL . '</h4>';
			echo '<h4>ASSETS: ' . SK_ACADEMY_ASSETS . '</h4>';
			echo '<h4>TEXTDOMAIN: ' . SK_ACADEMY_TEXTDOMAIN . '</h4>';

			echo '<hr>';

		echo '</div>';
	}



	/**
	 * Enqueue assets handler
	 */
	public function enqueue_assets() {
		
		if ( get_current_screen()->id == 'toplevel_page_shakib-academy' ) {
			wp_enqueue_script( 'admin-delete-academy' );
		}
		else{
			wp_enqueue_style( 'sk-admin-style' );
			wp_enqueue_script( 'sk-admin-script' );
		}
	}
}
