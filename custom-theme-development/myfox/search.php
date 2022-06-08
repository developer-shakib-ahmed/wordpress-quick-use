	
<?php get_header(); ?>

    <div class="blog_page_content">
        <div class="row">
			<?php if ( $redux_demo['blog_layouts'] == 1 ) : ?>

			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<?php get_sidebar(); ?>			
			</div>

			<?php endif ; ?>

            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="blog_post" id="search_page">
						<h4 class="search_title">
							<?php printf( __( 'Search Results for: %s', 'myfox' ), '<span>' . get_search_query() . '</span>' ); ?>
						</h4>

						<?php if (have_posts()) : ?>
						
							<?php get_template_part( 'post-excerpt' ); // Post Excerpt (post-excerpt.php) ?>
							<?php get_template_part( 'pagenav' ); // Page Navigation (pagenav.php) ?>

						<?php else : ?>
							<div class="postr">
								<div class="four_zero_page">
                            		<h1 class="four-zero-four"><span>404</span> Not Found</h1>
                       			</div> 
								
								<div class="entry">
									<p>
										<?php _e('Sorry, but the page you are trying to reach is unavailable or does not exist.', 'myfox'); ?>
									</p>			
								</div> <!-- end div .entry -->
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
