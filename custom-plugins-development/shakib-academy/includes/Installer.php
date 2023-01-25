<?php

namespace Shakib\Academy;

/**
 * The Installer Class
 */
class Installer {

	/**
	 * Run the installer
	 *
	 * @return void
	 */
	public function run() {

		$this->add_version();
		$this->create_tables();

	}

	/**
	 * Store current version into table when plugin in activate
	 */
	public function add_version() {
		$installed = get_option( 'sk_academy_installed' );

		if ( !$installed ) {
			update_option( 'sk_academy_installed', time() );
		}

		update_option( 'sk_academy_version', SK_ACADEMY_VERSION );
	}

	/**
	 * Create necessary database tables
	 *
	 * @return void
	 */

	public function create_tables() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}sk_academy_addresses` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `address` varchar(255) DEFAULT NULL,
    `phone` varchar(30) DEFAULT NULL,
    `created_by` bigint(20) unsigned NOT NULL,
    `created_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
    ) $charset_collate";

		if ( !function_exists( 'dbDelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		dbDelta( $schema );

	}

}