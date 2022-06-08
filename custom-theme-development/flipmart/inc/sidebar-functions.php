<?php

#---------- Sidebar Functions ----------#
function flipmart_register_sidebar(){

	// Blog sidebar
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'flipmart' ),
		'id'            => 'blog-sidebar',
		'description'   => 'Sidebar area for blog page.',
		'before_widget' => '<div id="%1$s" class="%2$s sidebar-widget wow fadeInUp outer-bottom-small animated" >',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="section-title">',
		'after_title'   => '</h3>'
	));

	// shop sidebar
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'flipmart' ),
		'id'            => 'shop-sidebar',
		'description'   => 'Sidebar area for shop page.',
		'before_widget' => '<div id="%1$s" class="%2$s sidebar-widget wow fadeInUp outer-bottom-small animated" >',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="section-title">',
		'after_title'   => '</h3>'
	));

	// Footer Top 1
	register_sidebar( array(
		'name'          => __( 'Footer Top 1', 'flipmart' ),
		'id'            => 'footer-top-1',
		'description'   => 'Sidebar area for footer top 1.',
		'before_widget' => '<div id="%1$s" class="%2$s footer-widget" >',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="module-heading"><h4 class="module-title">',
		'after_title'   => '</h4></div>'
	));

	// Footer Top 2
	register_sidebar( array(
		'name'          => __( 'Footer Top 2', 'flipmart' ),
		'id'            => 'footer-top-2',
		'description'   => 'Sidebar area for footer top 2.',
		'before_widget' => '<div id="%1$s" class="%2$s footer-widget" >',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="module-heading"><h4 class="module-title">',
		'after_title'   => '</h4></div>'
	));

	// Footer Top 3
	register_sidebar( array(
		'name'          => __( 'Footer Top 3', 'flipmart' ),
		'id'            => 'footer-top-3',
		'description'   => 'Sidebar area for footer top 3.',
		'before_widget' => '<div id="%1$s" class="%2$s footer-widget" >',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="module-heading"><h4 class="module-title">',
		'after_title'   => '</h4></div>'
	));

	// Footer Top 4
	register_sidebar( array(
		'name'          => __( 'Footer Top 4', 'flipmart' ),
		'id'            => 'footer-top-4',
		'description'   => 'Sidebar area for footer top 4.',
		'before_widget' => '<div id="%1$s" class="%2$s footer-widget" >',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="module-heading"><h4 class="module-title">',
		'after_title'   => '</h4></div>'
	));

	// Footer Bottom 1
	register_sidebar( array(
		'name'          => __( 'Footer Bottom 1', 'flipmart' ),
		'id'            => 'footer-bottom-1',
		'description'   => 'Sidebar area for footer top 1.',
		'before_widget' => '<div id="%1$s" class="%2$s footer-widget" >',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="module-heading"><h4 class="module-title">',
		'after_title'   => '</h4></div>'
	));

	// Footer Bottom 2
	register_sidebar( array(
		'name'          => __( 'Footer Bottom 2', 'flipmart' ),
		'id'            => 'footer-bottom-2',
		'description'   => 'Sidebar area for footer top 2.',
		'before_widget' => '<div id="%1$s" class="%2$s footer-widget" >',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="module-heading"><h4 class="module-title">',
		'after_title'   => '</h4></div>'
	));
	
}
add_action('widgets_init', 'flipmart_register_sidebar');
#---------- Sidebar Functions ----------#

?>