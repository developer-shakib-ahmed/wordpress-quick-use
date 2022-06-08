<?php
/*
 * The template for displaying page navigation.
 */
?>

<div id="pagi">
    <?php the_posts_pagination(array(
    	'prev_text'				=>	'PREV',				    	
    	'next_text'				=>	'NEXT',				    	
    	'screen_reader_text'	=>	' '			    	
    ));?>
</div>
