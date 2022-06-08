<?php get_header(); ?>
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
      <div class="container">
        <div class="row">
          <?php get_sidebar(); ?>
          <!-- CONTENT -->
          <div class="col-xs-12 col-sm-12 col-md-9 blog-page">
          <h3 class="archive_title"> <?php if(have_posts()): ?>

              <?php if(is_category()): ?>
                <span>Archive for: <i><?php single_cat_title(); ?></i> Category</span>

                  <?php elseif(is_tag()): ?>
                      <span>Archive for: <i><?php single_tag_title(); ?></i> Tag</span>

                  <?php elseif(is_day()): ?>
                      <span>Archive for: <i><?php the_time('F jS, Y'); ?></i></span>

                  <?php elseif(is_month()): ?>
                      <span>Archive for: <i><?php the_time('F, Y'); ?></i></span>

                  <?php elseif(is_year()): ?>
                      <span>Archive for: <i><?php the_time('Y'); ?></i></span>

              <?php elseif(is_author()): ?>
                      <span>Author archive for: <i><?php the_author(); ?></i></span>
              <?php endif; ?>

            <?php endif; ?> </h3><!-- End h2.archive_title -->
            <?php if(have_posts()) : ?>
              <?php while(have_posts()) : the_post(); ?>
                <div class="blog-post wow fadeInUp animated">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array('class' => 'img-responsive') ); ?></a>
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <span class="author"><?php the_author(); ?></span>
                <span class="review"><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?></span>
                <span class="date-time"><?php the_time('F j, Y g.i A'); ?></span>
                <p><?php echo wp_trim_words( get_the_content(), 70 ); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn btn-upper btn-primary read-more">Read more</a>
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