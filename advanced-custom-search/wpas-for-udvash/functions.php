<?php 

/**
 * Udvash Course Advanced Search
 */

require_once('wp-advanced-search/wpas.php');

function udvash_course_search_form() {
  $prefix = '_wpas_id_';
  $args = array();
  $args['wp_query'] = array( 'post_type'     => array('course', 'field', 'param'), 
                            'posts_per_page' => -1,
							'meta_key'       => '_mb_order',
							'orderby'        => 'meta_value_num',
							'order'          => 'ASC',
						   );

  $args['form'] = array( 'auto_submit' => true );

  $args['form']['ajax']  = array( 'enabled' => true,
                                  'show_default_results' => true,
                                  'results_template' => 'course-ajax-results.php', // This file must exist in your theme root
                                  'button_text' => 'Load More');
  
  $args['fields'][] = array( 'type'        =>  'reset',
                             'value'       => 'All' );
  
  $args['fields'][] = array( 'type'        =>  'taxonomy',
                             'taxonomy'    =>  'course_type',
                             'format'      => 'radio',
                             'relation'    =>  'IN' );

  register_wpas_form('udvash_course_wpas', $args);
}
add_action('init','udvash_course_search_form');