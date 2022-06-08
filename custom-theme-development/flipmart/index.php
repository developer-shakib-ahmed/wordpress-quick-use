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
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array('class' => 'img-responsive') ); ?></a>
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <span class="author"><?php the_author(); ?></span>
                <span class="review"><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?></span>
                <span class="date-time"><?php the_time('F j, Y g.i A'); ?></span>
                <p><?php echo wp_trim_words( get_the_content(), 70 ); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn btn-upper btn-primary read-more">Read more</a>
              </div>
              <?php endwhile; ?>

              <div class="clearfix blog-pagination filters-container  wow fadeInUp animated" style="padding: 0px; background: none; box-shadow: none; margin-top: 15px; border: none; visibility: visible; animation-name: fadeInUp;">
                <div class="text-right">
                  <div class="pagination-container">
                    <ul class="list-inline list-unstyled">
                      <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                      <li><a href="#">1</a></li>
                      <li class="active"><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div><!-- End .blog-pagination -->

            <?php else: ?>
              <h1>No "Post" Was Found!</h1>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
<?php get_footer(); ?>