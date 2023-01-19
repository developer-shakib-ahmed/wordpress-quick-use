<?php

/**
 * Plugin Name: Elementor Form Submissions Reply
 * Description: Just another elementor addons. You can reply or notify to users when you are updated elementor form submissions fields. 
 * Plugin URI: https://plugins.shakibahmed.com/
 * Author: Developer Shakib Ahmed
 * Author URI: https://shakibahmed.com/
 * Text Domain: sk-efsr
 * Domain Path: /languages/
 * Version: 1.0
 * License: GPL2 or Later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */



/**
 * Plugin Prefix: SK_EFSR | sk_efsr
 *
 * SK_EFSR = Shakib Elementor Form Submissions Reply
 */



if ( ! defined( 'ABSPATH' ) ) {
  exit;
}



/**
 * Require autoload files
 */
require_once __DIR__ . '/vendor/autoload.php';




/**
 * The main plugin class
 */
final class SK_EFSR {

  /**
	 * Plugin version
	 *
	 * @var string
	 */
	const version = '1.0';


  
  /**
	 * Plugin full name
	 *
	 * @var string
	 */
	const plugin_name = 'Elementor Form Submissions Reply';



  /**
   * Class Constructor
   */
	private function __construct() {

    $this->define_constants();

    register_activation_hook( SK_EFSR_FILE, [$this, 'activate'] );

		add_action( 'plugins_loaded', [$this, 'sk_init_plugin'] );

	}



  /**
   * Define the required plugin constants
   *
   * @return void
   */
	public function define_constants() {
		define( 'SK_EFSR_VERSION', self::version );
		define( 'SK_EFSR_TEXTDOMAIN', 'sk-efsr' );
		define( 'SK_EFSR_FILE', __FILE__ );
		define( 'SK_EFSR_PATH', __DIR__ );
		define( 'SK_EFSR_URL', plugins_url( '', SK_EFSR_FILE ) );
		define( 'SK_EFSR_ASSETS', SK_EFSR_URL . '/assets' );
	}



	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function sk_init_plugin() {

		new \Shakib\EFSR\Assets();

    add_action( 'admin_notices', [$this, 'sk_efsr_show_admin_notice'] );

		add_action( 'admin_enqueue_scripts', [ $this, 'sk_efsr_load_scripts' ] );

		add_action( 'wp_ajax_sk_ajax_action', 'sk_efsr_ajax_handle' );

	}



	/**
	 * Load script on submission page
	 */
	
	public function sk_efsr_load_scripts() {

		if ( function_exists( 'get_current_screen' ) ) {
      
			if( get_current_screen()->id == 'elementor_page_e-form-submissions' ) {

				wp_enqueue_script( 'sk-efsr-ajax' );

				wp_dequeue_script( 'form-submission-admin' );
				
			}

    }

	}



	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function activate() {

    

	}



  /**
   * Show admin notice
   */
  public function sk_efsr_show_admin_notice() {

    $class = 'updated notice is-dismissible';
    $message = __( "Thank you for using <b>". self::plugin_name ."</b> addons!", SK_EFSR_TEXTDOMAIN );

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );

  }



	/**
	 * Initializes a singleton instance of main class
	 *
	 * @return \SK_EFSR
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
 * @return \SK_EFSR
 */
function SK_Elementor_Form_Submissions_Reply() {
	return SK_EFSR::init();
}

/**
 * Kick-off the plugin
 */
SK_Elementor_Form_Submissions_Reply();