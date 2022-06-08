<?php 

	add_theme_support( 'title-tag' );

	function himu_enqueue_style(){

		wp_enqueue_style(
			'font-awesome',
			get_template_directory_uri().'/font-awesome/css/font-awesome.min.css',
			'',
			'4.7.0',
			'all'
		);

		wp_enqueue_style(
			'himu-bootstrap',
			get_template_directory_uri().'/bootstrap/css/bootstrap.min.css',
			'',
			'3.3.7',
			'all'
		);

		wp_enqueue_style(
			'himu-animate',
			get_template_directory_uri().'/css/animate.css',
			'',
			'3.5.2',
			'all'
		);

		wp_enqueue_style(
			'himu-owl-carousel',
			get_template_directory_uri().'/owlcarousel/assets/owl.carousel.min.css',
			'',
			'2.2.1',
			'all'
		);

		wp_enqueue_style(
			'himu-owl-theme-green',
			get_template_directory_uri().'/owlcarousel/assets/owl.theme.green.min.css',
			'',
			'2.2.1',
			'all'
		);

		wp_enqueue_style(
			'himu-hover',
			get_template_directory_uri().'/css/hover-min.css',
			'',
			'2.2.0',
			'all'
		);

		wp_enqueue_style(
			'himu-mixitup',
			get_template_directory_uri().'/mixitup/mixitup.css',
			'',
			'3.2.1',
			'all'
		);

		wp_enqueue_style(
			'himu-skillbar',
			get_template_directory_uri().'/skillbar/skillbar.css',
			'',
			'3.2.1',
			'all'
		);

		wp_enqueue_style(
			'himu-mystyle',
			get_template_directory_uri().'/css/mystyle.css',
			'',
			'1.0',
			'all'
		);

		wp_enqueue_style(
			'himu-style',
			get_template_directory_uri().'/css/style.css',
			'',
			'1.0',
			'all'
		);

		wp_enqueue_style(
			'himu-responsive',
			get_template_directory_uri().'/css/responsive.css',
			'',
			'1.0',
			'all'
		);

		wp_enqueue_style( 
			'himu-root-style', // id
			get_bloginfo( 'stylesheet_url' ), // src
			'', // deps
			'1.0', // ver 
			'all' // media
		);

	}
	add_action( 'wp_enqueue_scripts', 'himu_enqueue_style' );



	add_theme_support( 'custom-logo', array(
		'height' => '34',
		'width' => '90'
	) );

	add_theme_support( 'custom-header', array(
		'width' => 2000,
		'height' => 160,
		'uploads' => true,
		'flex-width' => true,
		'flex-height' => true,
		'default-image' => get_template_directory_uri().'/img/service-bg.jpg',
		'default-text-color' => 'ffffff',
	) );

	$backgroundArgs = array(
		'default-color' => 'ffffff',
		'default-image' => get_template_directory_uri().'/img/8.jpg',
	);

	add_theme_support( 'custom-background', $backgroundArgs );


	add_theme_support( 'post-thumbnails' );


	register_nav_menu( 'header_menu', 'Header Menu' );
	
	function defualt_menu_text(){
		echo '<a href=" ' .admin_url( '/nav-menus.php' ) . ' ">Create Menu</a>';
	}

	
	function himu_sidebar(){
		register_sidebar(array(
			'id' => 'right-sidebar',
			'name' => 'Right Sidebar',
			'description' => 'This is our Right Sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget_title">',
			'after_title' => '</h3>',
		));
	}
	add_action( 'widgets_init', 'himu_sidebar' );


	function shortcode_register_one(){
		$return = '
			<h1>This is our first shortcode.</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
		';

		return $return;
	}
	add_shortcode( 'shortcode1', 'shortcode_register_one' );


	function shortcode_register_two( $attribute ){

		extract( shortcode_atts(
			array(
				'attr1' => '',
				'attr2' => '',
				'attr3' => '',
				'desc' => ''
			),
			$attribute,
			'shortcode2'
		) );

		$return = '
			<h1 class="'.$attr1.'" id="'.$attr2.'">'.$attr3.'</h1>
			<p>'.$desc.'</p>
		';

		return $return;
	}
	add_shortcode( 'shortcode2', 'shortcode_register_two' );


	function shortcode_register_three($a, $b){
		extract(shortcode_atts(
			array( 'color' => 'blue' ),
			$a,
			'shortcode3'
		));

		return '
			<div style="color: '.$color.'; font-size:100px; font-weight: bold;">'.do_shortcode($b).'</div>
		';
	}
	add_shortcode( 'shortcode3', 'shortcode_register_three' );


	function himu_enqueue_scripts(){
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'comment-reply' );

		wp_enqueue_script( 
			'bootstrap-js',
			get_template_directory_uri().'/bootstrap/js/bootstrap.min.js',
			array('jquery'),
			'3.3.7',
			true
		);

		wp_enqueue_script(
			'owl-carousel',
			get_template_directory_uri().'/owlcarousel/owl.carousel.min.js',
			array('jquery'),
			'2.2.1',
			true
		);

		wp_enqueue_script(
			'parallax-js',
			get_template_directory_uri().'/js/jquery.parallax.js',
			array('jquery'),
			'1.1.3',
			true
		);

		wp_enqueue_script(
			'mixitup-js',
			get_template_directory_uri().'/mixitup/mixitup.min.js',
			array('jquery'),
			'3.2.1',
			true
		);

		wp_enqueue_script(
			'skillbar-js',
			get_template_directory_uri().'/skillbar/skillbar.js',
			array('jquery'),
			'1.0',
			true
		);

		wp_enqueue_script(
			'main-js',
			get_template_directory_uri().'/js/jQuery.js',
			array('jquery'),
			'1.0',
			true
		);
	}
	add_action( 'wp_enqueue_scripts', 'himu_enqueue_scripts' );



	function himu_team_member_register(){

		$labels = array(

			'name'               => 'Teams',			
			'singular_name'      => 'Team',
			'menu_name'          => 'Teams',
			'name_admin_bar'     => 'Team',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Team',
			'new_item'           => 'New Team',
			'edit_item'          => 'Edit Team',
			'view_item'          => 'View This Team',
			'all_items'          => 'All Teams',
			'search_items'       => 'Search Teams',
			'not_found'          => 'No Teams found.',
			'not_found_in_trash' => 'No Teams found in trash.'

		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_menu'        => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 1,
			'menu_icon'           => get_template_directory_uri().'/img/team.png',
			'has_archive'         => true,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'rewrite'             => true,
			'query_var'           => true,
			'supports'            => array(
				'title',
				'editor',
				'custom-fields',
				'thumbnail'
			)
		);

		register_post_type( 'team', $args );

	}
	add_action( 'init', 'himu_team_member_register' );



	function himu_portfolio_register(){

		$labels = array(

			'name'               => 'Portfolios',			
			'singular_name'      => 'Portfolio',
			'menu_name'          => 'Portfolios',
			'name_admin_bar'     => 'Portfolio',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Portfolio',
			'new_item'           => 'New Portfolio',
			'edit_item'          => 'Edit Portfolio',
			'view_item'          => 'View This Portfolio',
			'all_items'          => 'All Portfolios',
			'search_items'       => 'Search Portfolios',
			'not_found'          => 'No Portfolios found.',
			'not_found_in_trash' => 'No Portfolios found in trash.'

		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_menu'        => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 3,
			'menu_icon'           => 'dashicons-palmtree',
			'has_archive'         => true,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'rewrite'             => true,
			'query_var'           => true,
			'supports'            => array(
				'title',
				'editor',
				'custom-fields',
				'thumbnail'
			)
		);

		register_post_type( 'portfolio', $args );

	}
	add_action( 'init', 'himu_portfolio_register' );



	function portfolio_category_register(){

		$cat_labels = array(
			'name' => 'Portfolio Categories',
			'singular_name' => 'Portfolio Category',
			'search_items' => 'Search Portfolio Categories',
			'popular_items' => 'Popular Portfolio Categories',
			'all_items' => 'All Portfolio Categories',
			'edit_item' => 'Edit Portfolio Category',
			'update_item' => 'Update Portfolio Category',
			'add_new_item' => 'Add New Portfolio Category',
			'not_found' => 'Not Found Portfolio Category',
			'menu_name' => 'Portfolio Categories',
		);

		$cat_args = array(
			'hierarchical'          => true,
			'labels'                => $cat_labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => true,
		);

		register_taxonomy( 'portfolio_cat', 'portfolio', $cat_args );
	}
	add_action( 'init', 'portfolio_category_register' );


	require_once( '/redux-framework/ReduxCore/framework.php' );
	
	require_once( '/redux-framework/sample/sample-config.php' );

?>