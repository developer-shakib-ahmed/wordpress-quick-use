<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>




<div class="wpb_wrapper">
	<div id="topBar">
		<a href="<?php echo home_url( '/images-page' ); ?>"><< All Categories</a>
	</div>

  
  <div class="logo">
    <?php if(has_custom_logo()) : ?>
    <?php the_custom_logo(); ?>
    <?php else: ?>
    <?php $header_text = get_theme_mod( 'header_text' ); if($header_text): ?>
    <h1 class="site-title"><a href="<?php echo esc_url(home_url()); ?>"><?php echo bloginfo( 'name' ); ?></a></h1>
    <h2 class="description"><?php echo bloginfo( 'description' ); ?></h2>
    <?php endif; ?>
    <?php endif; ?>
  </div>

  <nav id="menu">
    <?php
      $theme_location = 'main-menu';
      wp_nav_menu( array( 
        'theme_location' => $theme_location,
        'container_class' => $theme_location.'-container',
        'menu_id' => $theme_location,
        'menu_class' => $theme_location,
        'fallback_cb' => 'default_menu',
      ));
    ?>
  </nav>

	<div id="posts_by_cat">

		<?php if(have_posts()): ?>

		<?php while(have_posts()) : the_post(); ?>

			<?php $post_slug = $post->post_name; ?>

			<article id="post-<?php echo $post_slug; ?>" class="category_posts">

        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'post-thumb' ) ); ?></a>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array( 370, 250 ), array( 'class' => 'post-thumb' ) ); ?></a>

        <?php
          if ( has_post_thumbnail() ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false );
            $image = esc_url($image[0]);
          }
        ?>

        <img src="<?php echo $image; ?>" alt="">

				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

        <p class="post_meta">
          <span><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?></span>
        </p>

        <p><?php $post_meta = get_post_meta( $post->ID, 'sub_title', true ); ?></p>
        
        <p><?php echo get_the_date( 'm / d / Y' ); ?></p>

        <?php 
          echo wp_trim_words( get_the_content(), 100 ); // post content
          echo wp_trim_words( get_the_excerpt(), 100 ); // post excerpt
          echo wp_trim_words( get_the_title(), 100 ); // post title
        ?>

        <?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>

			</article>

		<?php endwhile; ?>

  	<?php else: ?>

  		<h1>NO post found !!!</h1>

  	<?php endif;  ?>

	</div>

	<div id="info">
		<div class="count">

		<p class="results-count">Total <?php global $wp_query; $total_posts = $wp_query->found_posts; echo $total_posts-1; ?> items</p>

		</div>
	</div><!-- End #info -->
</div><!-- End .wpb_wrapper -->



<?php 

# ---- custom post query by taxonomy ---- #
$query = new WP_Query( array(
    'post_type' => 'faqs',  // name of post type.
    'tax_query' => array(
        array(
            'taxonomy' => 'faq_category',   // taxonomy name
            'field'    => 'term_id',        // term_id, slug or name
            'terms'    => 48,               // term id, term slug or term name
        )
    )
) );
# ---- custom post query by taxonomy ---- #



# ---- custom post query by taxonomy ---- #
$args = array(

  'post_type' => 'acme_post_type',      
  'tax_query' => array(       
  
  'relation' => 'AND',

    array(          
      'taxonomy' => 'acme_labels',
      'field'    => 'term_id',
      'terms'    => 100
      ),        
    array(          
      'taxonomy' => 'acme_labels',          
      'field'    => 'term_id',          
      'terms'    => 200       
      )     
  )  

);    
$posts = get_posts( $args );
# ---- custom post query by taxonomy ---- #


?>


<?php 

# ---- custom wp_list_categories query---- #
wp_list_categories(array(
    'echo'                => true,
    'hide_empty'          => true,
    'hierarchical'        => true,
    'order'               => 'ASC',
    'orderby'             => 'name',
    'show_count'          => 0,
    'style'               => 'list',
    'taxonomy'            => 'image-type',
    'title_li'            => '',
));



# ---- custom taxonomy lists ---- #
echo get_the_term_list( $post->ID, 'image-type', '<li class="jobs_item">', ', ', '</li>' );

$id = get_the_ID();
$terms = get_the_terms( $id , 'image-type' );
if($terms != null){
  $image_type = $terms ;
}else{
  $image_type = "No Category";
}

foreach ($image_type as $term ) { 
  $image_type = $term->name;
  $image_type_link = get_term_link($term);

  if ($image_type == 'All Categories') {
    $image_type = '';
  }else{
    $image_type = '<a href="'.$image_type_link.'">'.$image_type.'</a>';
  }

echo $image_type;

}
#-- End foreach loop --#

#-- Returns All Term Items for $taxonomy_name. --#
// declare your taxonomy name

$taxonomy_name = 'image-type';
$term_lists = wp_get_post_terms( $post->ID, $taxonomy_name, array( 'fields' => 'all' ));

foreach($term_lists as $term_single) {
  $term_id = $term_single->term_id;
  $term_name = $term_single->name;
  $term_slug = $term_single->slug;
  $term_group = $term_single->term_group;
  $term_taxonomy_id = $term_single->term_taxonomy_id;
  $term_taxonomy = $term_single->taxonomy;
  $term_description = $term_single->description;
  $term_parent = $term_single->parent;
}
#-- End foreach loop --#

$term = get_term( '1', 'category' ); 
$name = $term->name;
$slug = $term->slug;


?>


<?php
  $adLocation = array(133, 123, 121, 127, 135, 129, 131, 125);
  foreach ($adLocation as $value) {
    $term = get_term( $value, 'ad_location' );
    echo '<li class="item item-'.$term->slug.'"><a href="'.get_term_link($value).'">'.$term->name.'</a></li>';
  }
?>


<?php 

// dynamic term id in taxonomy page
$term_ID = get_queried_object()->term_id;

get_category_parents( $term_ID, true, '>' );

$cat_slug = get_category(get_query_var('cat'))->slug;

?>

  <?php
    $taxonomy_name = 'knowledgeify-category';
    $term_lists = wp_get_post_terms( $post->ID, $taxonomy_name, array( 'fields' => 'all' ));
    $term_id = get_queried_object()->term_id;
    $term_children = get_term_children( $term_id, $taxonomy_name );

    echo '<ul class="all_child">';
    $count = 1;
    foreach ( $term_children as $child ) {
      $count++;
      $count = $count%3;

      $term = get_term_by( 'id', $child, $taxonomy_name );

      if($count == 2){ $open = '<div class="child_group">'; }else{ $open = ''; } if($count == 1){ $close = '</div>'; }else{ $close = ''; }

      echo $open.'<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>'.$close;
    }
    echo '</ul>';
  ?>

  <?php 
    $count = count(get_the_category()); 
    foreach((get_the_category()) as $i => $category) {
     echo $category->cat_name; if ($i < $count - 1) echo ", "; 
    } 
  ?>


<div class="post_navigation">
  <?php         
    $next_post = get_next_post();
    $nextID = $next_post->ID;
    $prev_post = get_previous_post();
    $prevID = $prev_post->ID;
  ?>
  <p class="link">
    <?php if($nextID): ?>
      <a href="<?php the_permalink($nextID); ?>" class="next_post">Next Post</a>
    <?php endif; ?>

    <?php if($prevID): ?>
      <a href="<?php the_permalink($prevID); ?>" class="prev_post">Previous Post</a>
    <?php endif; ?>
  </p>
</div>

<div class="next_and_prev_page">
  <?php 
    // this function will be show next and previous page of this template
    previous_posts_link( '← Previous Page' );
    next_posts_link( 'Next Page →', $services->max_num_pages );

   ?>
</div>

<div class="next_prev">
  <p class="prev">
  <?php previous_post_link('<button class="btn btn-primary" ><i class="fa fa-caret-left"></i>%link</button>', 'Previous', false); ?>              
  </p>
  <p class="next">
  <?php next_post_link('<button class="btn btn-primary" >%link <i class="fa fa-caret-right"></i></button>', 'Next', false); ?>              
  </p>
</div>

<div class="next_prev">
  <?php
    $prev = get_permalink(get_adjacent_post(false,'',true));
    $next = get_permalink(get_adjacent_post(false,'',false));
    $current_post = get_permalink();
  ?>

  <?php if($prev != $current_post) : ?>
  <p class="learn_more prev"><a href="<?php echo $prev; ?>"><span><i class="fa fa-angle-left"></i></span>See Previous</a></p>
  <?php endif; ?>

  <?php if($next !=$current_post) : ?>
  <p class="learn_more next"><a href="<?php echo $next; ?>">See Next<span><i class="fa fa-angle-right"></i></span></a></p>
  <?php endif; ?>
</div>

<div class="pagination">
  <?php
      the_posts_pagination(array(

        'screen_reader_text'  => ' ',
        // 'mid_size' => 2,
        'prev_text' => '« Previous', 
        'next_text' => 'Next »',

      ));
  ?>
</div>


<div class="custom_pagination">
    <?php
      if (function_exists('custom_pagination')) {
        custom_pagination($services->max_num_pages, "", $paged);
      }
    ?>
</div>

<?php
#---- insert this function in theme functions.php ----#
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

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
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}

?>

<a href="<?php echo wp_login_url( get_permalink() ); ?>">Sign in</a>


<!-- Author info -->
<?php
  // global $current_user;

   $current_user = wp_get_current_user();

  echo $current_user->user_firstname;
  echo $current_user->user_lastname;
  echo $current_user->user_email;
  echo $current_user->user_url;
  echo get_avatar( $current_user->ID, 64 );

?>
<?php echo get_the_author_meta( 'user_email' );  ?>



<?php 

// This method will be show all scope
$term_lists = get_terms( array(
    'taxonomy'    => 'category',
    'hide_empty'  => false,
    'orderby'     => 'count', // count, name, date, title
    'order'     => 'ASC', // ASC, DESC
    'fields'    => 'all',
) );

foreach($term_lists as $term_single) {
  $term_id = $term_single->term_id;
  $term_name = $term_single->name;
  $term_slug = $term_single->slug;
  $term_group = $term_single->term_group;
  $term_taxonomy_id = $term_single->term_taxonomy_id;
  $term_taxonomy = $term_single->taxonomy;
  $term_description = $term_single->description;
  $term_count = $term_single->count;
  $term_filter = $term_single->filter;
  $term_parent = $term_single->parent;

  echo $term_count.' ';
}
#-- End foreach loop --#
?>


<?php #-- recentPost --# ?>
<div id="recentPost">
  <ul class="recentItems">

      <?php

      $args = array(
          'numberposts'      => 5,
          'offset'           => 0,
          'category'         => 0,
          'orderby'          => 'post_date',
          'order'            => 'DESC',
          'include'          => '',
          'exclude'          => '',
          'meta_key'         => '',
          'meta_value'       => '',
          'post_type'        => 'post',
          'post_status'      => 'publish',
          'suppress_filters' => false
      );
      $recentPosts = wp_get_recent_posts( $args, ARRAY_A );

      foreach( $recentPosts as $post ) : ?>
      <li class="recentPost post-<?php echo $post['ID']; ?>">
          <div class="recentThumb">
              <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post['ID']), $size = 'medium', false ) ?>
              <img src="<?php echo $image[0] ?>" alt="image-<?php echo $post['ID']; ?>">
          </div>
          <p class="recentTitle">
              <a href="<?php echo get_permalink($post['ID']) ?>"><?php echo $post['post_title'] ?></a>
          </p>
      </li>
      <?php endforeach; wp_reset_query(); ?>

  </ul>
</div>
<?php #-- recentPost --# ?>

<?php

#----- wp_pagenavi -----#

if(is_front_page()){
  $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
}else{
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
}

$loop = new WP_Query(array( 'paged'   => $paged ));
if(function_exists('wp_pagenavi')){
  wp_pagenavi( array( 'query' => $loop ) );
}
#----- wp_pagenavi -----#

?>


<?php

  if(is_product_category()){
      $current_ID = get_queried_object()->term_id;
      $get_children = get_term_children( $current_ID, 'product_cat' );
      if(!empty($get_children)){
          echo '<ul class="product-cat-list">';
          foreach ( $get_children as $child ) {
              $get_child = get_term_by( 'id', $child, 'product_cat' );
              $childName = $get_child->name;
              $childLink = get_term_link( $child, 'product_cat' );
              $childThumbnailId = get_woocommerce_term_meta( $child, 'thumbnail_id', true );
            $childImage = wp_get_attachment_url( $childThumbnailId );
              echo '<li class="id-'.$child.'"><a href="'.$childLink.'"><img src="'.$childImage.'"><span>'.$childName.'</span></a></li>';
          }
          echo '</ul>';
      }
  }



  
?>


<?php wp_footer(); ?>	
</body>
</html>