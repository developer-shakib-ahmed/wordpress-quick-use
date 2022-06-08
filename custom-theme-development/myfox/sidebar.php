<div class="sidebar">

	<?php if ( ! dynamic_sidebar( 'sidebar_widget' ) ) : ?>
		<div class="single_widget">
			<h3>this is widget title</h3>
			<p>
				Lorem ipsum dolor sit amet,
				consectetur adipisicing elit.
				Nihil repellat sit enim voluptas ad,
				id ut nemo similique nobis minus!
			</p>
		</div>
	<?php endif; ?>

	<div class="recent_post">
		<h3>Recent Posts Thumbnails</h3>
		<ul>
			<?php global $post;
			$args = array( 'posts_per_page' => 3, 'post_type'=> 'post' );
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) : setup_postdata($post); ?>

				<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></li>

			<?php endforeach; ?>
		</ul>
	</div>
	<div class="contact">
		<h3>contact</h3>
		<table>
			<tr>
				<td><i class="fa fa-flag-o"></i> </td>
				<td><span> Company</span></td>
			</tr>
			<tr>
				<td><i class="fa fa-home"></i> </td>
				<td><span> Address</span></td>
			</tr>
			<tr>
				<td><i class="fa fa-phone"></i> </td>
				<td><span> Phone</span></td>
			</tr>
			<tr>
				<td><i class="fa fa-envelope-o"></i> </td>
				<td><span> E-mail</span></td>
			</tr>
			<tr>
				<td><i class="fa fa-map-marker"></i> </td>
				<td><span> zip code: 7101</span></td>
			</tr>
		</table>
	</div>

</div>