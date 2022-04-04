<?php 

/**
 * illustrated Parts Advanced Search
 */
require_once('wp-advanced-search/wpas.php');

function illustrated_parts_search_form() {
  $prefix = '_wpas_id_';
  $args = array();
  $args['wp_query'] = array('post_type'     => array('illustrated_parts', 'field', 'param'), 
                            'posts_per_page' => 10,
                            'orderby'        => 'date', 
                            'order'          => 'DESC' );

  $args['form'] = array( 'auto_submit' => true );

  $args['form']['ajax']  = array( 'enabled' => true,
                                  'show_default_results' => true,
                                  'results_template' => 'illustrated-parts-ajax-results.php', // This file must exist in your theme root
                                  'button_text' => 'Load More');
                                  
  $args['fields'][] = array( 'type'  	   =>  'search',
							 'label'  	   =>  'Search',
							 'placeholder' =>  'Write and Press Enter' );
  
  $args['fields'][] = array( 'type'        =>  'taxonomy',
                             'label'  	   =>  'Type',
                             'taxonomy'    =>  'illustrated_parts_type',
                             'allow_null'  =>  true,
                             'relation'    =>  'IN' );

  $args['fields'][] = array( 'type'      =>  'meta_key',
                            'label'     =>  'Years',
                            'format'    =>  'select', 
                            'meta_key'  =>  '_mb_year',
                            'values'  => array(
                              '1993'  => '1993',
                              '2021'  => '2021',
                            ),
                            'allow_null'  =>  true,
                            'compare'   => 'IN' );

  register_wpas_form('illustrated_parts_wpas', $args);
}
add_action('init','illustrated_parts_search_form');