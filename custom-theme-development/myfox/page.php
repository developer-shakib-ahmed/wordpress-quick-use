<?php get_header(); ?>

	<div class="page_content">						
	    <?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>

	        <p><?php the_content(); ?></p>

	    <?php endwhile; ?>

	    <?php else : ?>
	       <section class="four_zero_four">
	           <h3><?php _e('404 Error&#58; Not Found', 'myFox'); ?></h3>
	       </section>
	    <?php endif; ?>					
	</div>

<?php get_footer(); ?>