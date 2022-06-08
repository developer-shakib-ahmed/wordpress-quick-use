<?php
/*

	Template name: Top Search Domain

 */

get_header(); ?>

	<?php $layout_class = ( function_exists('shapely_get_layout_class') ) ? shapely_get_layout_class(): ''; ?>  
    <div id="primary" class="col-md-9 mb-xs-24 <?php echo $layout_class; ?>">
		<main id="main" class="site-main" role="main">

			<div id="domain_page">

				<div id="page_content">
					<ul>
						<?php
						global $post;
						$args = array( 'posts_per_page' => -1, 'post_type'=> 'domain-items');
						$myposts = get_posts( $args );
						foreach( $myposts as $post ) : setup_postdata($post); ?>					
						
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>

						<?php endforeach; ?>
					</ul>
				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<aside id="domain_aside" class="widget-area col-md-3 hidden-sm" role="complementary">
<?php dynamic_sidebar( 'domain_page_sidebar' ); ?>
</aside>

<?php get_footer(); ?>
