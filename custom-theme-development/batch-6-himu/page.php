<?php get_header(); ?>

	<main>
		<section id="page">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<?php while(have_posts()) : the_post(); ?>
							<h2>
								<?php the_title(); ?>
								<span class="subtitle">Subtitle: 
									<?php
										$id = get_the_ID();

										$subtitle = get_post_meta( $id, 'page_subtitle', true );

										$icon = get_post_meta( $id, 'page_icon', true );

										echo $subtitle;
									?>										
								</span>
								<i class="fa fa-<?php echo $icon; ?>"></i>
							</h2>
							<div class="page-content">
								<?php the_content(); ?>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>


