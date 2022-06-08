<?php get_header(); ?>

	<div class="blog_page_content">
		<div class="row">
			<?php if ( $redux_demo['blog_layouts'] == 1 ) : ?>

			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<?php get_sidebar(); ?>			
			</div>

			<?php endif ; ?>

			<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
				<div class="blog_post" id="single_post">
					<div class="single_post">
						<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
							<?php $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),'stunning-demo-large'); ?>

							<a id="single_img" rel="lightbox" title="<?php the_title(); ?>" href="<?php echo $post_thumbnail[0]; ?>">
								<?php the_post_thumbnail('my-blog-thumbs'); ?>
							</a>

							<h1><?php the_title(); ?></h1>
							<div class="entry-info">
								<span><i class="fa fa-clock-o"></i> <?php the_time('M d, Y') ?></span>
								<span><i class="fa fa-pencil"></i>
									<a href="<?php the_author(); ?>"><?php the_author(); ?></a>
								</span>
								<span><i class="fa fa-comments"></i>
									<?php if ( comments_open() ) : ?> <?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?><?php endif; ?>
								</span>
								<span class="cat"><?php the_category(', '); ?></span>
							</div>														

							<?php the_content(); ?>

							<?php comments_template( '', true ); ?>

						<?php endwhile; ?>

						<?php else : ?>
							<h3><?php _e('404 Error&#58; Not Found', 'newspaper'); ?></h3>
						<?php endif; ?>		
					</div>
				</div>
			</div>

			<?php if ( $redux_demo['blog_layouts'] == 2 ) : ?>

			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<?php get_sidebar(); ?>			
			</div>

			<?php endif ; ?>

		</div>			
	</div>

<?php get_footer(); ?>