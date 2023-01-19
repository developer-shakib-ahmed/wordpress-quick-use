<?php
/**
 * ajax action handle function
 */
function sk_efsr_ajax_handle() {

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

  global $wpdb;

  $submissionData = [];

  $getSubmissions = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}e_submissions_values WHERE submission_id = {$sk_ajax_data['submission_id']}", OBJECT );
            
  foreach( $getSubmissions as $data){
    $submissionData[$data->key] = $data->value;
  }


  /**
   * Send mail after submission update
   */
  $default_email = 'live.shakib@gmail.com';
  $email_from    = $default_email;
  $reply_to      = $default_email;
  $message       = "
  <p>Hi {$submissionData['name']},</p>

  <p>Name: {$submissionData['name']}</p>

  <p>Email: {$submissionData['email']}</p>

  <p>Message: {$submissionData['message']}</p>
  ";

  //php mailer variables
  $email_to = isset( $submissionData['email'] ) ? $submissionData['email'] : 'wpbestcoder@gmail.com';
  $subject  = "Shakib - Submission Update";
  $headers  = "From: ". $email_from . "\r\n" . "Reply-To: " . $reply_to . "\r\n" . "Content-Type: text/html; charset=UTF-8";

  //Here put your Validation and send mail
  $sent = wp_mail($email_to, $subject, strip_tags($message, '<p><b><br>'), $headers);


  $sk_return_data = [
    'sent_to' => $email_to
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