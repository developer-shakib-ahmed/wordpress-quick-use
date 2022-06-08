<?php /* Template Name: Full Width */ ?>

<?php get_header(); ?>

	<main>
		<section id="page">
			<?php while(have_posts()) : the_post(); ?>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
		</section>
	</main>

<?php get_footer(); ?>


