<?php /* Template Name: Himu Teams */ ?>

<?php get_header(); ?>

	<main>
		<section class="teams-page" id="teams">
			<div class="container">
				<div class="row">
					<h1 style="text-align: center;">All Team Members</h1>

					<?php 

						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$all_teams = new WP_Query(array(
							'post_type' => 'team',
							'posts_per_page' => 3,
							'paged' => $paged,
						));

					?>
					<?php if( $all_teams->have_posts() ) : ?>
						<?php while($all_teams->have_posts()) : $all_teams->the_post(); ?>
						<?php 
							$id = get_the_ID();
							$team_profession = get_post_meta( $id, 'team_profession', true );
							$team_fb = get_post_meta( $id, 'team_fb', true );
						?>
							<div class="col-sm-4">
								<div class="member">
									<?php the_post_thumbnail( 'full' ); ?>
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<p><?php echo wp_trim_words( get_the_content(), 10, '' ); ?></p>
									<?php 
										if($team_fb){
											echo '<a href="'.$team_fb.'"><i class="fa fa-facebook"></i></a>';
										}
									?>
								</div>
							</div>
						<?php endwhile; ?>

						<div class="himu_pagination">
							<?php wp_pagenavi( array( 'query' => $all_teams ) ); ?>
						</div>

					<?php else: ?>
						<h2>No Team Members Found!</h2>
					<?php endif; ?>

					
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>