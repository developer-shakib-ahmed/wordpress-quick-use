<?php get_header(); ?>
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
      <div class="container">
        <div class="row">
          <?php get_sidebar(); ?>
          <!-- CONTENT -->
          <div class="col-xs-12 col-sm-12 col-md-9 page">
            <div class="page-content wow fadeInUp animated">
              <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post(); ?>
                  <?php the_content(); ?>
                <?php endwhile; ?>
              <?php else: ?>
                <h1>No "Page" Was Found!</h1>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php get_footer(); ?>