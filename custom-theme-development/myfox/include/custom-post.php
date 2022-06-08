<?php

/* Register custom post areas ********************************************/	
	function myfox_custom_post() {

		register_post_type( 'feature-items',
			array(
				'labels' => array(
					'name' 			=> __( 'Features' ),
					'singular_name' => __( 'Features' ),
					'add_new_item' 	=> __( 'Add New Feature' ),
               		'edit_item' 	=> __( 'Edit Feature' ),
                    'view_item' 	=> __( 'View Feature' ),
               		'not_found' 	=> __( 'Sorry, we couldn\'t find the Features you are looking for.' )
				),
				'public' 			  => true,
            	'publicly_queryable'  => true,
				'supports' 			  => array('thumbnail', 'title', 'editor', 'author', 'excerpt', 'custom-fields', 'comments'),
				'has_archive'		  => true,
				'menu_icon' 		  => 'dashicons-smiley',
                'capability_type'	  => 'post',
				'rewrite' 			  => array('slug' => 'feature-item'),
			)
		);

		register_post_type( 'stunning-items',
			array(
				'labels' => array(
					'name' => __( 'Stunnings' ),
					'singular_name' => __( 'Stunnings' ),
					'add_new_item' => __( 'Add New Stunning' )
				),
				'public' => true,
				'supports' => array('thumbnail', 'title', 'editor', 'author', 'comments', 'excerpt'),
				'has_archive' => true,
				'menu_icon' => 'dashicons-admin-post',
				'rewrite' => array('slug' => 'stunning-item'),
				'taxonomies' => array('post_tag'),
			)
		);

		register_post_type( 'funfact-items',
			array(
				'labels' => array(
					'name' => __( 'Funfacts' ),
					'singular_name' => __( 'Funfacts' ),
					'add_new_item' => __( 'Add New Funfact' )
				),
				'public' => true,
				'supports' => array('title', 'editor', 'author', 'custom-fields', 'comments'),
				'has_archive' => true,
				'menu_icon' => 'dashicons-admin-post',
				'rewrite' => array('slug' => 'funfact-item'),
			)
		);

		register_post_type( 'mobile-left-items',
			array(
				'labels' => array(
					'name' => __( 'Mobile Lefts' ),
					'singular_name' => __( 'Mobile Lefts' ),
					'add_new_item' => __( 'Add New Mobile Left Item' )
				),
				'public' => true,
				'supports' => array('title', 'editor', 'author', 'custom-fields', 'excerpt', 'comments'),
				'has_archive' => true,
				'menu_icon' => 'dashicons-admin-post',
				'rewrite' => array('slug' => 'mobile-left-item'),
			)
		);

		register_post_type( 'mobile-right-items',
			array(
				'labels' => array(
					'name' => __( 'Mobile Rights' ),
					'singular_name' => __( 'Mobile Rights' ),
					'add_new_item' => __( 'Add New Mobile Right Item' )
				),
				'public' => true,
				'supports' => array('title', 'editor', 'author', 'custom-fields', 'excerpt', 'comments'),
				'has_archive' => true,
				'menu_icon' => 'dashicons-admin-post',
				'rewrite' => array('slug' => 'mobile-right-item'),
			)
		);

		register_post_type( 'testimonial-items',
			array(
				'labels' => array(
					'name' => __( 'Testimonials' ),
					'singular_name' => __( 'Testimonials' ),
					'add_new_item' => __( 'Add New Testimonial' )
				),
				'public' => true,
				'supports' => array('title', 'editor', 'author', 'excerpt', 'comments', 'thumbnail', 'custom-fields'),
				'has_archive' => true,
				'menu_icon' => 'dashicons-testimonial',
				'rewrite' => array('slug' => 'testimonial-item'),
			)
		);

		register_post_type( 'introduce-items',
			array(
				'labels' => array(
					'name' => __( 'Introduces' ),
					'singular_name' => __( 'Introduces' ),
					'add_new_item' => __( 'Add New Introduce' )
				),
				'public' => true,
				'supports' => array('title', 'editor', 'author', 'excerpt', 'comments', 'thumbnail'),
				'has_archive' => true,
				'menu_icon' => 'dashicons-admin-post',
				'rewrite' => array('slug' => 'introduce-item'),
			)
		);

	}
	add_action('init', 'myfox_custom_post');






// myfox custom taxonomy support section.


function myfox_custom_taxonomy() {
	register_taxonomy(
		'stunning_cat',  //This is name of the taxonomy. ( this is very important. )
		'stunning-items',                  //post type name ( this is very important. )
		array(
			'hierarchical'          => true,
			'label'                 => 'Stunning Categorise',  //Display name
			'query_var'             => true,
			'show_ui'         		=> true,
			'show_admin_column'		=> true,
			'rewrite'               => array(
				'slug'              => 'stunning-category', // This is slug.
				'with_front'    	=> true // Don't display the category base before
				)
			)
	);


	register_taxonomy(
		'testimonial_cat',  //This is name of the taxonomy. ( this is very important. )
		'testimonial-items',                  //post type name ( this is very important. )
		array(
			'hierarchical'          => true,
			'label'                 => 'Testimonial Categorise',  //Display name
			'query_var'             => true,
			'show_ui'         		=> true,
			'show_admin_column'		=> true,
			'rewrite'               => array(
				'slug'              => 'testimonial-category', // This is slug.
				'with_front'    	=> true // Don't display the category base before
				)
			)
	);
}
add_action( 'init', 'myfox_custom_taxonomy');



// this category filter function for stunning-items
function specials_restrict_manage_posts() {
	global $typenow;

	if ($typenow=='stunning-items'){//stunning-items == post_type name
		 $args = array(
			 'show_option_all' => "All Stunning Categories",
			 'taxonomy'        => 'stunning_cat', // stunning_cat == taxonomy name
			 'name'          	=> 'Stunning Filter',
		);

		wp_dropdown_categories($args);
	}
}

add_action( 'request', 'my_request' );
function my_request($request) {

	if (is_admin() && isset($request['post_type']) && $request['post_type']=='stunning-items') {//stunning-items == post_type name
		$request['term'] = get_term($request['type'],'type')->name;
}
return $request;
}
add_action('restrict_manage_posts','specials_restrict_manage_posts');



function specials_restrict_manage_posts2() {
	global $typenow;

	if ($typenow=='testimonial-items'){//testimonial-items == post_type name
		 $args = array(
			 'show_option_all' => "All Testimonial Categories",
			 'taxonomy'        => 'testimonial_cat', // stunning_cat == taxonomy name
			 'name'            => 'Testimonial Filter',
		);

		wp_dropdown_categories($args);
	}
}

add_action( 'request', 'my_request2' );
function my_request2($request) {

	if (is_admin() && isset($request['post_type']) && $request['post_type']=='testimonial-items') {//testimonial-items == post_type name
		$request['term'] = get_term($request['type'],'type')->name;
}
return $request;
}
add_action('restrict_manage_posts','specials_restrict_manage_posts2');



?>