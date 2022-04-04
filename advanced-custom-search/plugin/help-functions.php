<?php 

# Tutorial: https://www.youtube.com/watch?v=An2J0JsAseM

# ------- wp advanced search include functions -------- #

require_once('wp-advanced-search/wpas.php');

function theme_search_form() {
	$prefix = '_meta_id_';
	$args = array();
	$args['wp_query'] = array( 'post_type'     => array('post', 'field', 'param'), 
                              'posts_per_page' => 10,
	                          'orderby'        => 'date', 
	                          'order'          => 'DESC' );
	                          
	// Here is where we specify the page where results will be shown
	$args['form'] = array( 'action' => get_bloginfo('url') . '/theme-search' );
	
	$args['fields'][] = array( 'type'  		=>  'search',
							  'label'  		=>  'Field Name',
							  'placeholder' =>  'Enter text here' );

	$args['fields'][] = array( 'type'      =>  'meta_key',
	                         'label'     =>  'Field Label',
	                         'format'    =>  'radio', 
	                         'meta_key'  =>  $prefix . 'radio',
	                           'values'  => array(
	                                'yes'  => 'Yes',
	                                'no'   => 'No',
	                            ),
	                         'compare'   => 'IN' );

	$args['fields'][] = array( 'type'      =>  'taxonomy',
                             'taxonomy'    =>  'notice_type',
                             'allow_null'  =>  true,
                             'format'      => 'select',
                             'relation'    =>  'IN' );

	$args['fields'][] = array( 'type'   => 'submit', 
	                         'value'  => 'Search' );
  
  $args['fields'][] = array( 'type'        =>  'reset',
                             'value'       => 'Load More' );

	register_wpas_form('theme_search', $args);
}
add_action('init','theme_search_form');
# ------- wp advanced search include functions -------- #




/**
 * Udvash Notice Advanced Search
 */ 
require_once('wp-advanced-search/wpas.php');

function udvash_notice_search_form() {
  $prefix = '_wpas_id_';
  $args = array();
  $args['wp_query'] = array( 'post_type'     => array('notice', 'field', 'param'), 
                            'posts_per_page' => 9,
                            'orderby'        => 'date', 
                            'order'          => 'DESC' );

  $args['form'] = array( 'auto_submit' => true );

  $args['form']['ajax']  = array( 'enabled' => true,
                                  'show_default_results' => true,
                                  'results_template' => 'template-notice-ajax-results.php', // This file must exist in your theme root
                                  'button_text' => 'আরো দেখতে');
  
  $args['fields'][] = array( 'type'        =>  'taxonomy',
                             'taxonomy'    =>  'notice_type',
                             'allow_null'  =>  true,
                             'relation'    =>  'IN' );

  register_wpas_form('udvash_notice_wpas', $args);
}
add_action('init','udvash_notice_search_form');



/**
 * Udvash Branch Advanced Search
 */

function udvash_branch_search_form() {
  $prefix = '_wpas_id_';
  $args = array();
  $args['wp_query'] = array( 'post_type'     => array('branch', 'field', 'param'), 
                            'posts_per_page' => -1,
                            'orderby'        => 'date', 
                            'order'          => 'DESC' );

  $args['form'] = array( 'auto_submit' => true );

  $args['form']['ajax']  = array( 'enabled' => true,
                                  'show_default_results' => true,
                                  'results_template' => 'template-branch-ajax-results.php', // This file must exist in your theme root
                                  'button_text' => 'Load More');
  
  $args['fields'][] = array( 'type'        =>  'taxonomy',
                             'taxonomy'    =>  'branch_district',
                             'allow_null'  =>  true,
                             'relation'    =>  'IN' );

  register_wpas_form('udvash_branch_wpas', $args);
}
add_action('init','udvash_branch_search_form');



/**
 * Udvash Course Advanced Search
 */

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
                                  'results_template' => 'template-course-ajax-results.php', // This file must exist in your theme root
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



/**
 * Udvash Post Advanced Search
 */

function udvash_study_guide_line_search_form() {
  $prefix = '_wpas_id_';
  $args = array();
  $args['wp_query'] = array( 'post_type'     => array('post', 'field', 'param'), 
                            'posts_per_page' => 2,
                            'orderby'        => 'date', 
                            'order'          => 'DESC' );

  $args['form'] = array( 'auto_submit' => true );

  $args['form']['ajax']  = array( 'enabled' => true,
                                  'show_default_results' => true,
                                  'results_template' => 'template-post-ajax-results.php', // This file must exist in your theme root
                                  'button_text' => 'Load More');
  
  $args['fields'][] = array( 'type'        =>  'taxonomy',
                             'taxonomy'    =>  'category',
                             'format'      => 'select',
                             'allow_null'  =>  true,
                             'relation'    =>  'IN' );

  register_wpas_form('udvash_study_guide_line_wpas', $args);
}
add_action('init','udvash_study_guide_line_search_form');


?>