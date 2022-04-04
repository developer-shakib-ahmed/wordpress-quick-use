<?php get_header(); ?>

<div class="content">
      <div class="colume">
        <div class="content_left">
        
	        <h1>Archive Posts</h1>

	        <h2 class="archive_title"><?php if(have_posts()): ?>

    				<?php if(is_category()): ?>
    					<span>Archive for: <i>'<?php single_cat_title(); ?>'</i> Category</span>

            <?php elseif(is_tag()): ?>
              <span>Archive for: <i>'<?php single_tag_title(); ?>'</i> Tag</span>

            <?php elseif(is_day()): ?>
              <span>Archive for: <i>'<?php the_time('F jS, Y'); ?>'</i></span>

            <?php elseif(is_month()): ?>
              <span>Archive for: <i>'<?php the_time('F, Y'); ?>'</i></span>

            <?php elseif(is_year()): ?>
              <span>Archive for: <i>'<?php the_time('Y'); ?>'</i></span>

    				<?php elseif(is_author()): ?>
              <span>Author archive for: <i>'<?php the_author(); ?>'</i></span>
    				<?php endif; ?>

			    <?php endif; ?></h2><!-- End h2.archive_title -->

            <?php if(have_posts()): ?>

            <?php while( have_posts() ) :  the_post() ;?>
              <div class="post">
                <div class="left">
                  <?php the_post_thumbnail( 'medium', array( 'class' => 'rahul', ) ); ?>
                </div>
                <div class="right">
                  <h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <p class="post_meta">
                    <span>By: <?php the_author_posts_link(); ?>,</span>
                    <span>Category: <?php the_category( ', ' ); ?>,</span>
                    <span>Tag: <?php the_tags(); ?>,</span>
                    <span>On: <?php the_time('m/d/y') ?>,</span>
                    <span><?php comments_popup_link( 'No Comment', '1 Comment', '% Comments', 'comment_count', 'Comment off' ); ?></span>
                  </p>
                  <?php the_excerpt(); ?>
                  <p><a class="readMore" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">Read More</a></p>
                </div>
              </div>
            <?php endwhile; ?>

            <?php else: ?>
              <h2><i>Your post is now on trash or empty.</i></h2>
            <?php endif; ?>
        </div>
          
        <div class="content_right">
          <h1>Blog Sidebar</h1>
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>

<?php get_footer(); ?>



<?php

  $post_type            = get_post_type(); // post_type=>affiliate_items
  $currentObject        = get_queried_object();
  $currentTermID        = $currentObject->term_id;
  $currentTermName      = $currentObject->name;
  $currentTermSlug      = $currentObject->slug;
  $currentTaxonomy      = $currentObject->taxonomy; // taxonomy=>affiliate_categories
  $currentTaxonomyCount = $currentObject->count;

?>
