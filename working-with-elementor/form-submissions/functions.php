<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */



/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );



/**
 * Enqueue scripts & styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

	wp_enqueue_script( 'custom-scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js', array('jquery'), '', true );

}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );



/**
 * Admin enqueue scripts & style
 */
function shakib_submissions_scripts() {

  $screen_id = get_current_screen()->id;
  
  if( $screen_id == 'elementor_page_e-form-submissions' ) {
    
    wp_enqueue_script( 'shakib-submissions', get_stylesheet_directory_uri() . '/js/shakib-submissions.js', array('jquery'), '', true );

    wp_enqueue_script( 'sk-submissions-ajax', get_stylesheet_directory_uri() . '/js/sk-submissions-ajax.js', array('jquery'), '', true );

    wp_localize_script( 'sk-submissions-ajax', 'skAjaxObj', [
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'nonce'   => wp_create_nonce( 'sk-ajax-nonce' ),
      'action'  => 'sk_ajax_action',
    ] );
    
  }

}
add_action( 'admin_enqueue_scripts', 'shakib_submissions_scripts' );



/**
 * ajax action handle function
 */
function sk_submissions_ajax() {

  check_ajax_referer( 'sk-ajax-nonce' );

  header("Content-Type: application/json");

  $sk_ajax_data = [];

  if( isset( $_POST[ 'action' ] ) ) {
    $sk_ajax_data['action'] = $_POST[ 'action' ];
  }

  if( isset( $_POST[ '_ajax_nonce' ] ) ) {
    $sk_ajax_data['_ajax_nonce'] = $_POST[ '_ajax_nonce' ];
  }

  if( isset( $_POST[ 'submission_id' ] ) ) {
    $sk_ajax_data['submission_id'] = $_POST[ 'submission_id' ];
  }


  /**
   * Send mail after submission update
   */
  $email_from = 'live.shakib@gmail.com';
  $reply_to   = 'live.shakib@gmail.com';
  $message    = 'Hi, This is a demo email after submission data update!';

  //php mailer variables
  $email_to = 'live.shakib@gmail.com';
  $subject  = "Shakib - Submission Update";
  $headers  = 'From: '. $email_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n";

  //Here put your Validation and send mail
  $sent = wp_mail($email_to, $subject, strip_tags($message), $headers);



  $sk_return_data = [
    'email_sent_to' => $email_to
  ];

  if($sent) {
    $sk_return_data['mail_sent'] = true;
  }
  else  {
    $sk_return_data['mail_sent'] = false;
  }

  echo json_encode( $sk_return_data );

  wp_die();

}
add_action( 'wp_ajax_sk_ajax_action', 'sk_submissions_ajax' );


/**
 * Admin notice on submission page
 */
function independence_notice() {
  $screen_id = get_current_screen()->id;

  ?>
    <div style="margin-top: 10px;" class="notice notice-success">
      <p>Shakib notice => {Screen Id: <?php echo $screen_id; ?>}</p>
    </div>
  <?php

}
// add_action( 'admin_notices', 'independence_notice' );



function shakib_elementor_submission(){
  $screen_id = get_current_screen()->id;
?>

<?php if($screen_id == 'elementor_page_e-form-submissions' ): ?>

  <div style="margin-top: 0px;" class="notice notice-success">

    <p>Shakib notice => {Screen Id: <?php echo $screen_id; ?>}</p>
    
  </div>

<?php endif; ?>

<?php
}
// add_action('admin_footer', 'shakib_elementor_submission');



