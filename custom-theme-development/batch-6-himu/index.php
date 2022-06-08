<?php get_header(); ?>

	<main>
		<section class="blog-section" id="blog">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<h1>Our Blog</h1>
						<div class="row">
							<?php if(have_posts()) : ?>
								<?php while(have_posts()) : the_post(); ?>
									<div class="col-sm-6">
										<div class="inner">
											<?php the_post_thumbnail( array( 300, 160 ), array( 'class' => 'img-responsive' ) ); ?>
											<h4 class="blog"><?php the_title(); ?></h4>
											<i class="fa fa-pencil-square-o"></i><span>posted by <?php the_author(); ?> |</span> 
											<i class="fa fa-clock-o"></i><span>posted on <?php echo get_the_date(); ?></span>
											<p class="sm-black">
												<?php echo wp_trim_words( get_the_content(), 9, '...' ); ?>
											</p>
											<a class="blog" href="<?php the_permalink(); ?>">read more</a>
										</div>
									</div>
								<?php endwhile; ?>
							<?php else: ?>
								<h1>Posts not found.</h1>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-sm-4">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>