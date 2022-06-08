<?php if(have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>		
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="single_post">
			<?php $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),'stunning-demo-large'); ?>

			<a id="single_img" rel="lightbox" title="<?php the_title(); ?>" href="<?php echo $post_thumbnail[0]; ?>">
				<?php the_post_thumbnail('my-blog-thumbs'); ?>
			</a>			

			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

			<?php get_template_part( 'postmeta' ); // Post Meta (postmeta.php) ?>		

			<?php the_excerpt(); ?> 

			<div class="button"><a href="<?php the_permalink(); ?>">Read More</a></div>
			
		</div>
		
	</div>
<?php endwhile; ?>	
<?php endif; ?>
