<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Shapely
 */

get_header(); ?>

	
    <?php $layout_class = ( function_exists('shapely_get_layout_class') ) ? shapely_get_layout_class(): ''; ?>  
        <section id="primary" class="content-area col-md-9 mb-xs-24 <?php echo $layout_class; ?>">
          <main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="entry-header nolist">
				<h1 class="post-title entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'shapely' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

				<ul>
					<?php while ( have_posts() ) : the_post(); ?>

						<li><h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h3></li>
						<li><p><?php the_content(); ?></p></li>
						<br>
						<li><button><a href="<?php the_permalink(); ?>">Read More...</a></button></li><br><br><br><br><br>

					<?php  endwhile; ?>
				</ul>		

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>	

		</main><!-- #main -->
	</section><!-- #primary -->
	

<?php get_sidebar(); get_footer(); ?>