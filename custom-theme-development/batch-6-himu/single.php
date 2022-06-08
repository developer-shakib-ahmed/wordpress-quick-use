<?php get_header(); ?>
	<main>
		<section id="single-post">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<?php if( have_posts() ) : ?>
							<?php while( have_posts() ) : the_post(); ?>
								<h2><?php the_title(); ?></h2>
								<div class="post_thumb">
									<?php the_post_thumbnail( 'full' ); ?>
								</div>
								<hr>
								<ul>
									<li>Author: <?php the_author_posts_link(); ?></li>
									<li>Date: <?php echo get_the_date(); ?></li>
									<li>Category: <?php the_category( ', ' ); ?></li>
									<li>Tag: <?php the_tags(); ?></li>
									<li><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?></li>
								</ul>
								<hr>
								<div class="description">
									<?php the_content(); ?>
								</div>
								<div class="comments_area">
									<?php comments_template(); ?>
								</div>
							<?php endwhile; ?>
						<?php else: ?>
							<p><em>Post not found!</em></p>
						<?php endif; ?>
					</div>
					<div class="col-sm-4">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>