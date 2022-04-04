<?php 

/*
* This shortcode with custom post pagination
*/
function fruitful_event_testing_shortcode($atts){
  ob_start();
  extract(shortcode_atts(array(
    'type' => 'past'
  ), $atts));
  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
  $getEvents = new WP_query(array(
    'post_type' => 'event',
    'posts_per_page' => 1,
    'paged'   => $paged,
    'meta_query' => array(
        array(
            'key'     => '_mb_event_type',
            'value'   => $type,
            'compare' => '=',
        ),
    ),
  ));
  
  while($getEvents->have_posts()){
    $getEvents->the_post();
    the_title( '<h1>', '</h1>', true );
  }
  wp_reset_postdata();
  
  fruitful_custom_pagination($getEvents->max_num_pages, "", $paged);
  
  return ob_get_clean();
  }
  add_shortcode( 'event_test', 'fruitful_event_testing_shortcode' );
  /**
 * Fruitful Custom Pagination
 */
function fruitful_custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  global $paged;

  if (empty($paged)) {
    $paged = 1;
  }

  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('<'),
    'next_text'       => __('>'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}









/**
 * Nexus Real Tynyc Property Shortcode by Status
 */

function nexusrealtynyc_property_shortcode_by_status($atts){
ob_start();
extract(shortcode_atts(array(
  'status' => 'rent', // sale
  'type'   => '',
  'tag'    => '',
), $atts));
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$propertyArgs = array(
  'post_type' => 'tm-property',
  'posts_per_page' => 6,
  'paged'   => $paged,
  'meta_query' => array(
      array(
          'key'     => '_tm_property_status',
          'value'   => $status,
          'compare' => '=',
      ),
  ),
);

if( !empty( $type ) ){
  $propertyArgs['tax_query'][] = array(
    'taxonomy' => 'tm-property_type',
    'field'    => 'slug',
    'terms'    => $type,
    'operator' => 'IN',
  );
}

if( !empty( $tag ) ){
  $propertyArgs['tax_query'][] = array(
    'taxonomy' => 'tm-property_tag',
    'field'    => 'slug',
    'terms'    => $tag,
    'operator' => 'IN',
  );
}

$getProperty = new WP_query($propertyArgs);

?>

<pre style="display: none;">
  <?php // var_dump($propertyArgs); ?>  
</pre>

<div id="tm-re-property-items" class="tm-property__wrap regular grid">
  <?php while($getProperty->have_posts()): $getProperty->the_post(); ?>
    <div></div>
  <?php endwhile; ?>
</div>

<?php
wp_reset_postdata();
nexusrealtynyc_property_pagination($getProperty->max_num_pages, "", $paged);
return ob_get_clean();
}
add_shortcode( 'property_by_status', 'nexusrealtynyc_property_shortcode_by_status' );


/**
* Nexus Real Tynyc Property Pagination
*/
function nexusrealtynyc_property_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  global $paged;

  if (empty($paged)) {
    $paged = 1;
  }

  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
      $numpages = 1;
    }
  }

  $pagination_args = array(
    'base' => get_pagenum_link(1) . '%_%',
    'format' => 'page/%#%',
    'total' => $numpages,
    'current' => $paged,
    'show_all' => False,
    'end_size' => 1,
    'mid_size' => $pagerange,
    'prev_next' => True,
    'prev_text' => __('Previous'),
    'next_text' => __('Next'),
    'type' => 'plain',
    'add_args' => false,
    'add_fragment' => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='pagination'>";
    //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
    echo $paginate_links;
    echo "</nav>";
  }

}