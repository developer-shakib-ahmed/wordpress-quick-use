<?php

/**
 * Plugin Name: Shakib Academy
 * Description: This is a basic plugin. In this plugin we create address book management system.
 * Plugin URI: https://shakibahmed.com/plugins/shakib-academy
 * Author: Developer Shakib Ahmed
 * Author URI: https://shakibahmed.com
 * Text Domain: sk-academy
 * Domain Path: /languages/
 * Version: 1.0
 * License: GPL2 or Later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Plugin Prefix: SK_ACADEMY | sk_academy
 *
 * SK_ACADEMY = Shakib Academy
 */

/**
 * Help links
 *
 * @link https://www.itsupportguides.com/knowledge-base/tech-tips/how-to-generate-sql-create-table-script-using-phpmyadmin/
 *
 * @link
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Require autoload files
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Shakib_Academy {

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const version = '1.0';

	/**
	 * Class Constructor
	 */
	private function __construct() {

		$this->define_constants();

		register_activation_hook( SK_ACADEMY_FILE, [$this, 'activate'] );

		add_action( 'plugins_loaded', [$this, 'sk_init_plugin'] );
	}

	/**
	 * Define the required plugin constants
	 *
	 * @return void
	 */
	public function define_constants() {
		define( 'SK_ACADEMY_VERSION', self::version );
		define( 'SK_ACADEMY_TEXTDOMAIN', 'sk-academy' );
		define( 'SK_ACADEMY_FILE', __FILE__ );
		define( 'SK_ACADEMY_PATH', __DIR__ );
		define( 'SK_ACADEMY_URL', plugins_url( '', SK_ACADEMY_FILE ) );
		define( 'SK_ACADEMY_ASSETS', SK_ACADEMY_URL . '/assets' );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function sk_init_plugin() {

		new \Shakib\Academy\Assets();

		if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			new Shakib\Academy\Ajax();
		}

		if ( is_admin() ) {
			new Shakib\Academy\Admin();
		} else {
			new Shakib\Academy\Frontend();
		}

		new Shakib\Academy\API();
	}

	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function activate() {

		$installer = new Shakib\Academy\Installer();
		$installer->run();

	}

	/**
	 * Initializes a singleton instance of main class
	 *
	 * @return \Shakib_Academy
	 */
	public static function init() {
		static $instance = false;

		if ( !$instance ) {
			$instance = new self();
		}
		return $instance;
	}
}

/**
 * Initializes the main plugin
 *
 * @return \Shakib_Academy
 */
function shakib_academy() {
	return Shakib_Academy::init();
}

/**
 * Kick-off the plugin
 */
shakib_academy();
