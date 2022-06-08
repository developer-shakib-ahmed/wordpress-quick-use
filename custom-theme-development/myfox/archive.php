<?php get_header(); ?>

	<div class="blog_page_content">
		<div class="row">
			<?php if ( $redux_demo['blog_layouts'] == 1 ) : ?>

			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<?php get_sidebar(); ?>			
			</div>

			<?php endif ; ?>

			<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
				<div class="blog_post" id="archive_post">
					<h4 class="archive_title">
						<?php if (have_posts()) : ?>
							<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
								<?php /* If this is a category archive */ if (is_category()) { ?>
									<?php _e('Archive for the', 'myfox'); ?> <span>'<?php echo single_cat_title(); ?>'</span> <?php _e('Category', 'myfox'); ?>									
								<?php /* If this is a tag archive */  } elseif( is_tag() ) { ?>
									<?php _e('Archive for the', 'myfox'); ?> <?php single_tag_title(); ?> Tag
								<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
									<?php _e('Archive for', 'myfox'); ?> <span><?php the_time('F jS, Y'); ?></span>										
							 	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
									<?php _e('Archive for', 'myfox'); ?> <span><?php the_time('F, Y'); ?></span>								
								<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
									<?php _e('Archive for', 'myfox'); ?> <span><?php the_time('Y'); ?></span>										
							  	<?php /* If this is a search */ } elseif (is_search()) { ?>
									<?php _e('Search Results', 'myfox'); ?>							
							  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
									<?php _e('Author Archive', 'myfox'); ?>										
								<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
									<?php _e('Blog Archives', 'myfox'); ?>										
						<?php } ?>					
					</h4>
					
						<?php get_template_part( 'post-excerpt' ); // Post Excerpt (post-excerpt.php) ?>
						<?php get_template_part( 'pagenav' ); // Page Navigation (pagenav.php) ?>

						<?php else : ?>
							<div class="post">
								<h3><?php _e('404 Error&#58; Not Found', 'never'); ?></h3>
							</div>
						<?php endif; ?>
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