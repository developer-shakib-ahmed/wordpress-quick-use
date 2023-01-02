<?php
/**
 * Template Name: Show Form Submissions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area">
    
    <main id="main" class="site-main" role="main">
        
        <?php
        
        if (isset($_GET['id'])) {
            $getTrackingID = $_GET['id'];
          
            global $wpdb;
            $tableName = "{$wpdb->prefix}e_submissions_values";
            
            $getValueByTrackingID = $wpdb->get_results( "SELECT * FROM $tableName WHERE value = {$getTrackingID}", OBJECT );
            
            $submissionID = $getValueByTrackingID[0]->submission_id;
            
            $getSubmissionByTrackingID = $wpdb->get_results( "SELECT * FROM $tableName WHERE submission_id = {$submissionID}", OBJECT );
            
            foreach($getSubmissionByTrackingID as $data){
                echo "<p>{$data->key}: {$data->value}</p>";
            }
            
        }
        else {
          echo "Hello World.";
        }
            
        ?>
        
        
        
    </main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
