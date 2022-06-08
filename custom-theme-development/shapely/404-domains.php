<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Shapely
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<h5>This is Opps page of 404-domain.php page.</h5>
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 style="text-align: center;" class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'shapely' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p style="text-align: center;"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'shapely' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
