<?php
/*
  template name: Courses
*/

get_header();

$search = new WP_Advanced_Search('udvash_course_wpas');
?>

<div class="course-search-section">
	<div class="course-form">		
		<div class="container">
			<div class="inner">
				<h1 class="form-title">কোর্স ফর</h1>
				<?php $search->the_form(); ?>
			</div>
		</div>
	</div>
	
	<div class="course-results">
		<div class="container">
			<div id="wpas-results"></div>
		</div>
	</div>
</div>


<?php get_footer(); ?>