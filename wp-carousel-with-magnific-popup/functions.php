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
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
  
	wp_enqueue_style( 'owl-carousel-style', get_stylesheet_directory_uri() . '/owl-carousel/owl.carousel.min.css', '', '2.3.4', 'all' );
	
  wp_enqueue_style( 'owl-carousel-theme-style', get_stylesheet_directory_uri() . '/owl-carousel/owl.theme.default.min.css', '', '2.3.4', 'all' );

  wp_enqueue_style( 'magnific-popup-style', get_stylesheet_directory_uri().'/magnific-popup/magnific-popup.css', '', '1.1.0', 'all' );

  wp_enqueue_script( 'owl-carousel-js', get_stylesheet_directory_uri() . '/owl-carousel/owl.carousel.min.js', array('jquery'), '2.3.4', false );

  wp_enqueue_script( 'magnific-popup-js', get_stylesheet_directory_uri() . '/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', false );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );



/**
 * Testimonials Custom Post
 */
function otribe_testimonials_register(){

  $singular_name  = 'Testimonial';
  $plural_name  = 'Testimonials';
  $slug       = strtolower(str_replace(" ", "_", $singular_name));

  $labels = array( 
    'name'                  =>  $plural_name,
    'singular_name'         =>  $singular_name,
    'menu_name'             =>  $plural_name,
    'name_admin_bar'        =>  $singular_name, // must use
    'add_new'               =>  'Add '.$singular_name,
    'add_new_item'          =>  'Add New '.$singular_name,
    'all_items'             =>  'All '.$plural_name, // must use
    'new_item'              =>  'New '.$singular_name, // unknown
    'view_item'             =>  'View '.$singular_name,
    'edit_item'             =>  'Edit '.$singular_name,
    'search_items'          =>  'Search '.$plural_name,
    'parent_item_colon'     =>  'Parent '.$singular_name.':', // hidden
    'not_found_in_trash'    =>  'No '.$plural_name.' found in Trash.',
    'not_found'             =>  'No '.$plural_name.' found.',
    'featured_image'        =>  $singular_name.' Featured Image',
    'set_featured_image'    =>  'Set '.$singular_name.' Featured Image',
    'remove_featured_image' =>  'Remove '.$singular_name.' Featured Image',
    'use_featured_image'    =>  'Use As '.$singular_name.' Featured Image', // unknown
  );


  $args = array(
    'labels'              =>  $labels,
    'public'              =>  true,
    'show_ui'             =>  true,
    'publicly_queryable'  =>  true,
    'show_in_menu'        =>  true,
    'query_var'           =>  true,
    'capability_type'     =>  'post',
    'has_archive'         =>  true,
    'menu_position'       =>  10,
    'menu_icon'           =>  'dashicons-cover-image',
    'exclude_from_search' =>  false,
    'show_in_nav_menus'   =>  true,
    'hierarchical'        =>  true,
    'can_export'          =>  true,
    'taxonomies'          =>  array( 'testimonial-category' ),
    'rewrite'             =>  true,
    'supports'            =>  array( 'title', 'editor', 'author', 'thumbnail' ),
  );

  register_post_type( $slug, $args);

}
add_action( 'init', 'otribe_testimonials_register' );



/**
 * Testimonials Custom Taxonomy
 */
function otribe_testimonials_category() {

  $singular_name  = 'Testimonial Category';
  $plural_name  = 'Testimonial Categories';
  $slug       = strtolower(str_replace(" ", "_", $singular_name)); 

  $labels = array(
    'name'                  => $plural_name,
    'singular_name'         => $singular_name,
    'search_items'          => 'Search '.$plural_name,
    'popular_items'         => 'Popular '.$plural_name,
    'all_items'             => 'All '.$plural_name,
    'view_item'             => 'View '.$singular_name,
    'parent_item'           => 'Parent '.$singular_name,
    'parent_item_colon'     => 'Parent '.$singular_name,
    'edit_item'             => 'Edit '.$singular_name,
    'update_item'           => 'Update '.$singular_name,
    'add_new_item'          => 'Add New '.$singular_name,
    'new_item_name'         => 'New '.$singular_name,
    'add_or_remove_items'   => 'Add or remove '.$plural_name,
    'choose_from_most_used' => 'Choose from most used '.$plural_name,
    'menu_name'             => $plural_name,
    'not_found'             => 'No '.$plural_name.' found.',
  );

  $args = array(
    'labels'            => $labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_admin_column' => true,
    'hierarchical'      => true,
    'show_tagcloud'     => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => true,
    'query_var'         => true,
    'capabilities'      => array(),
  );

  register_taxonomy( $slug, array( 'testimonial' ), $args );
}

add_action( 'init', 'otribe_testimonials_category' );



/**
 * Testimonials Carousel Shortcode
 */
function otribe_testimonials_carousel_shortcode($atts){
	ob_start();

  extract(shortcode_atts( array(
		'category' => '',
		'per_page' => '9',
		'style' => 'carousel',
	), $atts, 'otribe_testimonials' ));

  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$carouselQuery = new WP_Query(array(
		'post_type'      => 'testimonial',
		'posts_per_page' => $per_page,
    'paged'          => $paged,
    'tax_query' => array(
			array(
				'taxonomy'			   => 'testimonial_category',
				'field'            => 'slug',
				'terms'            => $category,
				'include_children' => false,
				'operator'         => 'AND',
			)
		),
	));

?>
<div id="otribeTestimonials" data-show="<?php echo $per_page; ?>" data-category="<?php echo empty($category) ? "all" : $category ; ?>" data-style="<?php echo $style; ?>">
	<div class="<?php echo $style == "carousel" ? "owl-carousel owl-theme" : "otribe-" . $style ; ?>">
		<?php if($carouselQuery->have_posts()) : ?>
			<?php
        while($carouselQuery->have_posts()) : $carouselQuery->the_post();
				$locations = get_post_meta( get_the_ID(), 'testimonial_locations', true);
      ?>

		  <div class="item" id="post-<?php echo get_the_ID(); ?>">
        <a class="testimonial-popup" href="#poppup-<?php echo get_the_ID(); ?>">
          <div class="post_thumb">
          <?php the_post_thumbnail( 'full' ); ?>
          </div>

          <div class="content">
          <div class="excerpt">
            <p><?php echo wp_trim_words(get_the_content(), 26, '...') ?></p>
          </div>

          <div class="post_meta">
            <p class="meta"><?php echo $locations; ?></p>
          </div>
          </div>
        </a>

        <div id="poppup-<?php echo get_the_ID(); ?>" class="white-popup-block mfp-hide">
          <div class="popup-content-wrap">
          <div class="popup-content">
            <?php the_post_thumbnail( 'full' ); ?>
            <?php the_content(); ?>
            <p class="meta"><?php echo $locations; ?></p>
          </div>
          </div>
        </div>
		  </div>

		<?php endwhile; wp_reset_postdata(); ?>

		<?php else: ?>

			<h4>No Testimonial Found!</h4>

		<?php endif; ?>
	</div>

  <?php

    if( $style == "grid" ){
      notribe_testimonials_pagination($carouselQuery->max_num_pages, "", $paged);
    }

  ?>

</div>
<?php
	return ob_get_clean();
}
add_shortcode( 'otribe_testimonials', 'otribe_testimonials_carousel_shortcode' );



/*
* Otribe Testimonials Pagination
*/
function notribe_testimonials_pagination($numpages = '', $pagerange = '', $paged='') {

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
    echo "<nav class='pagination'>" . $paginate_links . "</nav>";
  }

}