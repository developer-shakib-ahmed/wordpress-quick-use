<?php get_header(); ?>
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
      <div class="container">
        <div class="row">
          <?php get_sidebar(); ?>
          <!-- CONTENT -->
          <div class="col-xs-12 col-sm-12 col-md-9 blog-page">
            <?php if(have_posts()) : ?>
              <?php while(have_posts()) : the_post(); ?>
                <div class="blog-post wow fadeInUp animated">
                <?php the_post_thumbnail( 'full', array('class' => 'img-responsive') ); ?>
                <h1><?php the_title(); ?></h1>
                <span class="author"><?php the_author(); ?></span>
                <span class="review"><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?></span>
                <span class="date-time"><?php the_time('F j, Y g.i A'); ?></span>
                <?php the_content(); ?>
              </div>
              <?php endwhile; ?>
            <?php else: ?>
              <h1>No "Post" Was Found!</h1>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
<?php get_footer(); ?>