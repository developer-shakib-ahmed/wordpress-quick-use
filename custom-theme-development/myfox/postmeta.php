<?php
/*
 * The template for displaying post meta.
 */
?>

<div class="postmeta clearfix">

	<div class="entry-info">

		<span><i class="fa fa-clock-o"></i> <?php the_time('M d, Y') ?></span>
		<span><i class="fa fa-pencil"></i> <a href="<?php the_author(); ?>"><?php the_author(); ?></a></span>
		<span><i class="fa fa-comments"></i>
			<?php if ( comments_open() ) : ?> <?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?><?php endif; ?>
		</span>
		<span class="cat"><?php the_category(', '); ?></span>

	</div>

</div> <!-- end div .postmeta -->