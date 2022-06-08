<?php

/* Custom widget add function ********************************************/	
	function myfox_widget_functions() {

		register_sidebar( array(
			'name' => __( 'Sidebar Widget', 'myfox' ),
			'id' => 'sidebar_widget',
			'description' => __( 'This is main sidebar widget.', 'myfox' ),
			'before_widget' => '<div class="single_widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="single_widget_title">',
			'after_title' => '</h3>',
		) );

	}
	add_action('widgets_init', 'myfox_widget_functions');

?>