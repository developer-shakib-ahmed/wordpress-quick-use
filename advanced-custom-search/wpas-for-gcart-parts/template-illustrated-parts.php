<?php
  /*
  * Template Name: Search Result
  */
?>

<?php
  get_header(); 
  $prefix = '_meta_id_';
?>

<?php 
    $search   = new WP_Advanced_Search('theme_search');
    $temp     = $wp_query;
    $wp_query = $search->query();
?>

  <figure>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div id="sidebar">
            <h1>Sidebar goes here</h1>
            <?php $search->the_form(); ?>
          </div><!-- End #sidebar -->
        </div>
        <div class="col-lg-9">
          <div id="content">
            <div class="post_content">
              <div class="search-results">
                <h4 class="results-count">Displaying <?php echo $search->results_range(); ?> of <?php echo $wp_query->found_posts; ?> results</h4>

                <?php
                    if ( have_posts() ) :         
                    while ( have_posts() ) : the_post();
                    $post_type = get_post_type_object($post->post_type);
                ?>

                <article class="posts">

                    <?php

                        $id = get_the_ID();
                        // custom meta box info.
                        $meta_name = get_post_meta( $id, $prefix.'meta_name', true );

                    ?>

                    <div class="posts_box">

                        <p><b>Post Title:</b> <?php the_title(); ?></p>         

                    </div>

                </article>

                <?php 
                    endwhile; 
                    else :
                        echo '<p>Sorry, no results matched your search.</p>';
                    endif; 
                    $search->pagination();
                    $wp_query = $temp;
                    wp_reset_query();
                ?>
              </div><!-- End .search-results -->
            </div>      
          </div><!-- End #content -->
        </div>
      </div>
    </div>
  </figure><!-- End /figure -->

<?php get_footer(); ?>