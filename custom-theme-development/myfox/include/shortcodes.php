<?php

// this is dubble shortcode for features area.
function features_area_shortcode($atts){

	extract( shortcode_atts(array(
		'title' => 'features title',
		'des' => 'features descriptions',
	), $atts, 'features') );//features == shortcode name.

	$q = new WP_Query( array( 'posts_per_page' => '18', 'post_type' => 'feature-items'  ) );


// this is wrapper section
	$list = '
		<div class="key_feature_area">
			<div class="container">
				<div class="row">
					<h2>'.$title.'</h2>
					<span class="spans"></span>
					<p class="paragraph">'.$des.'</p>
	';

	while ($q->have_posts()) : $q->the_post();
		// get the ID of your post in the loop

		$id = get_the_ID();	

		$feature_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );

		$animation = get_post_meta($id, 'animation', true);
		$delay = get_post_meta($id, 'delay', true);
		$repeat_true_false = get_post_meta($id, 'repeat', true);

		if ($animation){ $set_animation = $animation;}
		else{ $set_animation = "slide-bottom";}

		if ($delay){ $set_delay = $delay;}
		else{ $set_delay = "900";}	

		if ($repeat_true_false == "on"){ $set_repeat = "true";}
		else{ $set_repeat = "false";}		

		$list .= '
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<div class="single_feature" data-uk-scrollspy="{cls:\'uk-animation-'.$set_animation.'\', repeat: '.$set_repeat.', delay:'.$set_delay.'}">
					<h4><span><img src="'.$feature_thumbnail[0].'" alt=""></span>'.get_the_title().'</h4>
					<p>'.get_the_excerpt().'</p>
				</div>											
			</div>
		';
	endwhile;
	$list.= '</div></div></div>';
	wp_reset_query();
	return $list;
}
add_shortcode('features', 'features_area_shortcode');
//custom-post shorcode use method: [features title="" des=""] //


// This is simple shortcode ***************//
	function solid_background_shortcode($atts){
		extract( shortcode_atts(array(
			'des'	=>	'',
			'link'	=>	'',
			'background_color'	=>	'#7542F9',			
		), $atts, 'solid_background' ) );

		global $redux_demo;

		$learn_more_img = $redux_demo['image']['url'];

		return '

			<div style="background-color:'.$background_color.'" class="solid_background">
				<div class="container">
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<h2>'.$des.'</h2>
						</div>	
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="learn_btn">
							<a href="'.$link.'"><img src="'.$learn_more_img.'" alt="">'.$redux_demo['text'].'</a>
							</div>
						</div>						
					</div>
				</div>			
			</div>

		';
	}
add_shortcode( 'solid_background', 'solid_background_shortcode' );
// use method: [solid_background link="" des="" background_color=""] //


// this is dubble shortcode for stunning demo area.
// function stunning_demo_area_shortcode($atts){

// 	extract( shortcode_atts(array(
// 		'title' => 'stunning title',
// 		'des' => 'stunning descriptions',
// 	), $atts, 'stunning') );//stunning == shortcode name.

// 	$q = new WP_Query( array( 'posts_per_page' => '12', 'post_type' => 'stunning-items', 'stunning_cat' => 'business one' ) );


// // this is wrapper section
// 	$list = '
// 		<div class="demo_area">	
// 			<h2>'.$title.'</h2>
// 			<span class="spans"></span>
// 			<p class="paragraph">'.$des.'</p>
// 	';

// 	while ($q->have_posts()) : $q->the_post();
// 		// get the ID of your post in the loop

// 		$id = get_the_ID();

// 		$stunning_category = get_the_category_by_id(2);

// 		$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'stunning-demo' );

// 		$stunning_post_thumbnail_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'stunning-demo-large' );	

// 		$list .= '
// 			<div class="single_demo">
// 				<div class="single_img">
// 					<a rel="lightbox" title="'.get_the_title().'" href="'.$stunning_post_thumbnail_large[0].'"><img src="'.$post_thumbnail[0].'" alt="stunning post thumbnail"></a>
// 					<a href="">category name</a>					
// 				</div>					
// 			</div>
// 		';
// 	endwhile;
// 	$list.= '

// 			<div class="load_quick_btn">
// 				<a data-uk-scrollspy="{cls:\'uk-animation-slide-left\', repeat: false}" class="one" href=""><span><i class="fa fa-refresh"></i></span>LOAD MORE</a>
// 				<a data-uk-scrollspy="{cls:\'uk-animation-slide-right\', repeat: false}" class="two" href=""><span><i class="fa fa-clock-o"></i></span>QUICK LIST</a>
// 			</div>
// 		</div>

// 	';
// 	wp_reset_query();
// 	return $list;
// }
// add_shortcode('stunning', 'stunning_demo_area_shortcode');
//custom-post shorcode use method: [features title="" des=""] //


// This is simple shortcode ***************//
	function support_area_shortcode($atts){
		extract( shortcode_atts(array(
			'des'	=>	'',
			'link'	=>	'',
			'title'	=>	'',			
			'iframe'	=>	'',			
		), $atts, 'support' ) );
		return '

		<div class="support_area">
			<div class="container">
				<div class="row">
					<div data-uk-scrollspy="{cls:\'uk-animation-slide-right\', repeat: false}" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="support_text">
							<h2>'.$title.'</h2>
							<span class="spans"></span>
							<p>'.$des.'</p>
							<a href="'.$link.'"><span><i class="fa fa-clock-o"></i></span>SUPPORT CENTER</a>
						</div>
					</div>

					<div data-uk-scrollspy="{cls:\'uk-animation-slide-left\', repeat: false}" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="support_img"><iframe src="'.$iframe.'" frameborder="0" allowfullscreen></iframe></div>
					</div>
				</div>	
			</div>			
		</div>

		';
	}
add_shortcode( 'support', 'support_area_shortcode' );
// use method: [support link="" iframe="" title="" des=""] //


// this is dubble shortcode for funfact count area.
function funfact_area_shortcode($atts){

	$q = new WP_Query( array( 'posts_per_page' => '4', 'post_type' => 'funfact-items'  ) );


// this is wrapper section
	$list = '
		<div class="funfact_area">
			<div class="container">
				<div class="row">
	';

	while ($q->have_posts()) : $q->the_post();
		// get the ID of your post in the loop

		$id = get_the_ID();

		$animation 	       = get_post_meta($id, 'animation', true);
		$delay             = get_post_meta($id, 'delay', true);
		$repeat_true_false = get_post_meta($id, 'repeat', true);

		if ($animation){ $set_animation = $animation;}
		else{ $set_animation = "slide-bottom";}

		if ($delay){ $set_delay = $delay;}
		else{ $set_delay = "900";}	

		if ($repeat_true_false == "on"){ $set_repeat = "true";}
		else{ $set_repeat = "false";}



		$funfact_icon = get_post_meta($id, 'funfact_icon', true);
		$count_lenght = get_post_meta($id, 'count_lenght', true);

		if ($funfact_icon){ $set_icon = $funfact_icon;}
		else{ $set_icon = "home";}	

		if ($count_lenght){ $set_count_lenght = $count_lenght;}
		else{ $set_count_lenght = "12345";}				

		$list .= '
			<div data-uk-scrollspy="{cls:\'uk-animation-'.$set_animation.'\', repeat: '.$set_repeat.', delay:'.$set_delay.'}" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 cursor">
				<span class="fun_icon"><i class="fa fa-'.$set_icon.'"></i></span>
				<h2 class="counter numscroller" data-slno=\'1\' data-min=\'0\' data-max=\''.$set_count_lenght.'\' data-delay=\'5\' data-increment="45">'.$set_count_lenght.'</h2>
				<span class="spans"></span>
				<p>'.get_the_title().'</p>
			</div>
		';
	endwhile;
	$list.= '</div></div></div>';
	wp_reset_query();
	return $list;
}
add_shortcode('funfact', 'funfact_area_shortcode');
//custom-post shorcode use method: [funfact] //





// this is mobile device big size shortcode for mobile device optimaizetion area.



function mobile_left_shortcode($atts){

	$q = new WP_Query( array( 'posts_per_page' => '3', 'post_type' => 'mobile-left-items'  ) );


// this is wrapper section
	$list = '<div class="mobile_text_l">';

	while ($q->have_posts()) : $q->the_post();
		// get the ID of your post in the loop

		$id = get_the_ID();

		$animation 	       = get_post_meta($id, 'animation', true);
		$delay             = get_post_meta($id, 'delay', true);
		$repeat_true_false = get_post_meta($id, 'repeat', true);

		if ($animation){ $set_animation = $animation;}
		else{ $set_animation = "slide-bottom";}

		if ($delay){ $set_delay = $delay;}
		else{ $set_delay = "900";}	

		if ($repeat_true_false == "on"){ $set_repeat = "true";}
		else{ $set_repeat = "false";}

		$mobile_left_icon = get_post_meta($id, 'mobile_left_icon', true);

		if ($mobile_left_icon){ $mobile_left_icon = $mobile_left_icon;}
		else{ $mobile_left_icon = "globe";}			

		$list .= '
		
			<div data-uk-scrollspy="{cls:\'uk-animation-'.$set_animation.'\', repeat: '.$set_repeat.', delay:'.$set_delay.'}">
				<h3>'.get_the_title().'<span><i class="fa fa-'.$mobile_left_icon.'"></i></span></h3>
				<p>'.get_the_excerpt().'</p>
			</div>
		';
	endwhile;
	$list.= '</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('mobile_left', 'mobile_left_shortcode');
//custom-post shorcode use method: [mobile_left] //


// this is dubble shortcode for mobile device (mobile right) area.
function mobile_right_shortcode($atts){

	$q = new WP_Query( array( 'posts_per_page' => '3', 'post_type' => 'mobile-right-items'  ) );


// this is wrapper section
	$list = '<div class="mobile_text_r">';

	while ($q->have_posts()) : $q->the_post();
		// get the ID of your post in the loop

		$id = get_the_ID();

		$animation 	       = get_post_meta($id, 'animation', true);
		$delay             = get_post_meta($id, 'delay', true);
		$repeat_true_false = get_post_meta($id, 'repeat', true);

		if ($animation){ $set_animation = $animation;}
		else{ $set_animation = "slide-bottom";}

		if ($delay){ $set_delay = $delay;}
		else{ $set_delay = "900";}	

		if ($repeat_true_false == "on"){ $set_repeat = "true";}
		else{ $set_repeat = "false";}

		$mobile_right_icon = get_post_meta($id, 'mobile_right_icon', true);

		if ($mobile_right_icon){ $mobile_right_icon = $mobile_right_icon;}
		else{ $mobile_right_icon = "user";}			

		$list .= '

			<div data-uk-scrollspy="{cls:\'uk-animation-'.$set_animation.'\', repeat: '.$set_repeat.', delay:'.$set_delay.'}">
				<h3><span><i class="fa fa-'.$mobile_right_icon.'"></i></span>'.get_the_title().'</h3>
				<p>'.get_the_excerpt().'</p>
			</div>
		';
	endwhile;
	$list.= '</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('mobile_right', 'mobile_right_shortcode');
//custom-post shorcode use method: [mobile_right] //



// This is mobile device shortcode ***************//
	function mobile_device_area_shortcode($atts){
		extract( shortcode_atts(array(
			'des'	=>	'',
			'title'	=>	'',			
			'img1'	=>	'',
			'img2'	=>	'',			
		), $atts, 'mobile_device' ) );
		return '

		<div class="mobile_area">
			<div class="container">
				<div class="row">
					<h2>'.$title.'</h2>
					<span class="spans"></span>
					<p>'.$des.'</p>

					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" id="padding">
						'.do_shortcode('[mobile_left]').'
					</div>

					<div data-uk-scrollspy="{cls:\'uk-animation-scale-up\', repeat: false}" class="col-lg-3 col-md-3 col-sm-6 col-xs-12" id="mobile_l">
						<img src="'.$img1.'" alt="left side mobile image">
					</div>					
					<div data-uk-scrollspy="{cls:\'uk-animation-scale-up\', repeat: false}" class="col-lg-3 col-md-3 col-sm-6 col-xs-12" id="mobile_r">
						<img src="'.$img2.'" alt="right side mobile image">
					</div>

					<div data-uk-scrollspy="{cls:\'uk-animation-slide-right\', repeat: false}" class="col-lg-3 col-md-3 col-sm-6 col-xs-12" id="padding2">
						<div class="mobile_text_r">
							'.do_shortcode('[mobile_right]').'
						</div>					
					</div>

				</div>
			</div>
		</div>

		';
	}
add_shortcode( 'mobile_device', 'mobile_device_area_shortcode' );
// use method: [mobile_device img1="" img2="" title="" des=""] //







// This is parallax shortcode ***************//
	function parallax_area_shortcode($atts){
		extract( shortcode_atts(array(
			'des'	=>	'',
			'title'	=>	'',			
			'demo_link'	=>	'',
			'buy_link'	=>	'',			
			'parallax_img'	=>	'',			
		), $atts, 'parallax' ) );
		return '

			<div style="background: url('.$parallax_img.') no-repeat center center;
			    position: relative;    
			    background-attachment: fixed;
			    height: 600px;
			    width: 100%;
			    background-color: #461C9C;" class="buy_area" data-stellar-background-ratio="0.3">

				<div class="buy_text">
					<h1>'.$title.'</h1>
					<p>'.$des.'</p>
					<a data-uk-scrollspy="{cls:\'uk-animation-slide-left\', repeat: false}" class="a_one" href="'.$demo_link.'">select deme</a>
					<a data-uk-scrollspy="{cls:\'uk-animation-slide-right\', repeat: false}" class="a_two" href="'.$buy_link.'">buy it now</a>
				</div>
			</div>

		';
	}
add_shortcode( 'parallax', 'parallax_area_shortcode' );
// use method: [parallax parallax_img="" demo_link="" buy_link="" title="" des=""] //



// this is dubble shortcode for crazy stunning area.
function crazy_stunning_area_shortcode($atts){

	extract( shortcode_atts(array(
		'title' => 'crazy stunning title',
		'des' => 'crazy stunning descriptions',
	), $atts, 'crazy_stunning') );//crazy_stunning == shortcode name.

	$q = new WP_Query( array( 'posts_per_page' => '6', 'post_type' => 'stunning-items'  ) );


// this is wrapper section
	$list = '
		<div class="c_feature_area">
			<h2>'.$title.'</h2>
			<span class="spans"></span>
			<p>'.$des.'</p>				
		</div>
		<span class="bottom_arrow"><img src="'.get_template_directory_uri().'/img/Landing_page/c_arrow.png" alt=""></span>
		<div class="c_feature_bottom_area">
			<div class="container">
				<div class="row">
	';

	while ($q->have_posts()) : $q->the_post();
		// get the ID of your post in the loop

		$id = get_the_ID();	

		$stunning_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'stunning-demo' );
		$stunning_post_thumbnail_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'stunning-demo-large' );

		$animation = get_post_meta($id, 'animation', true);
		$delay = get_post_meta($id, 'animation_delay', true);

		if ($animation){ $set_animation = $animation;}
		else{ $set_animation = "slide-bottom";}

		if ($delay){ $set_delay = $delay;}
		else{ $set_delay = "900";}		

		$list .= '
			<div data-uk-scrollspy="{cls:\'uk-animation-slide-left\', repeat: false, delay:600}" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="single_c_feature">
					<a rel="lightbox" title="'.get_the_title().'" href="'.$stunning_post_thumbnail_large[0].'"><img src="'.$stunning_post_thumbnail[0].'" alt="stunning post thumbnail"></a>
					<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
					<span class="spans"></span>
					<p>'.get_the_excerpt().'</p>
				</div>
			</div>
		';
	endwhile;
	$list.= '</div></div></div>';
	wp_reset_query();
	return $list;
}
add_shortcode('crazy_stunning', 'crazy_stunning_area_shortcode');
//custom-post shorcode use method: [crazy_stunning title="" des=""] //



// this is dubble shortcode for shortcode area.
function carousel_area_shortcode($atts){

	extract( shortcode_atts(array(
		'title' => 'features title',
		'des' => 'features descriptions',
		'img' => '',
	), $atts, 'carousel') );//carousel == shortcode name.

	$q = new WP_Query( array( 'posts_per_page' => '12', 'post_type' => 'stunning-items'  ) );


// this is wrapper section
	$list = '
		<div class="shortcode_area">
			<img src="'.$img.'" alt="carousel area top image">
			<h1>'.$title.'</h1>
			<p>'.$des.'</p>
				<div id="owl-demo" class="owl-carousel">
	';

	while ($q->have_posts()) : $q->the_post();
		// get the ID of your post in the loop

		$id = get_the_ID();	

		$stunning_carousel_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumb' );	

		$list .= '

			<div class="single_codes">
				<img src="'.$stunning_carousel_img[0].'" alt="carousel item image">
			</div>
		';
	endwhile;
	$list.= '
			</div>
			<div class="code_btn">
				<a data-uk-scrollspy="{cls:\'uk-animation-slide-left\', repeat: false}" class="a_one" href="">CHECK ALL SHORTCODE</a>
				<a data-uk-scrollspy="{cls:\'uk-animation-slide-right\', repeat: false}" class="a_two" href="">BUY THEFOX NOW</a>				
			</div>
		</div>
	';
	wp_reset_query();
	return $list;
}
add_shortcode('carousel', 'carousel_area_shortcode');
//custom-post shorcode use method: [carousel title="" des="" img=""] //



// this is dubble shortcode for carousel testimonial area.
function testimonial_area_shortcode($atts){

	$q = new WP_Query( array( 'posts_per_page' => '4', 'post_type' => 'testimonial-items'  ) );


// this is wrapper section
	$list = '
		<div class="testimonial_area">
			<div class="container">
				<div class="row">
					<div id="owl-demo2" class="owl-carousel owl-theme rahul">
	';

	while ($q->have_posts()) : $q->the_post();
		// get the ID of your post in the loop

		$id = get_the_ID();

		$testimonial_name = get_post_meta($id, 'testimonial_name', true);
		$testimonial_category = get_post_meta($id, 'testimonial_category', true);

		if ($testimonial_name){ $set_testimonial_name = $testimonial_name;}
		else{ $set_testimonial_name = "testimonial name";}

		if ($testimonial_category){ $set_testimonial_category = $testimonial_category;}
		else{ $set_testimonial_category = "testimonial category";}		

		$list .= '
			  <div class="item">
					<h2>'.get_the_excerpt().'</h2>
					<p><a href="'.get_permalink().'">'.$set_testimonial_name.'</a> - '.$set_testimonial_category.'</p>
			  </div>
		';
	endwhile;
	$list.= '</div></div></div></div>';
	wp_reset_query();
	return $list;
}
add_shortcode('testimonial', 'testimonial_area_shortcode');
//custom-post shorcode use method: [testimonial] //



// this is dubble shortcode for theme introducing area.
function introduce_area_shortcode($atts){

	$q = new WP_Query( array( 'posts_per_page' => '4', 'post_type' => 'introduce-items'  ) );


// this is wrapper section
	$list = '
		<div class="introducing_area">
			<div class="container">
				<div class="row">
	';

	while ($q->have_posts()) : $q->the_post();
		// get the ID of your post in the loop

		// $id = get_the_ID();	

		$intorduce_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );

		$list .= '
			<div data-uk-scrollspy="{cls:\'uk-animation-slide-bottom\', repeat: false}" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 intro">
				<span><img src="'.$intorduce_img[0].'" alt="intorduceing features image"></span>
				<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
				<p>'.get_the_excerpt().'</p>
			</div>
		';
	endwhile;
	$list.= '</div></div></div>';
	wp_reset_query();
	return $list;
}
add_shortcode('introduce', 'introduce_area_shortcode');
//custom-post shorcode use method: [introduce] //


// This is simple shortcode ***************//
	function ecommerce_area_shortcode($atts){
		extract( shortcode_atts(array(
			'title'				=>	'',		
			'des'				=>	'',
			'toplogo'			=>	'',
			'screenshot_img'	=>	'',
		), $atts, 'ecommerce' ) );
		return '

		<div class="commerce_area">
			<div class="container">
				<div class="row">
					<img class="img_one" src="'.$toplogo.'" alt="WooCommerce logo image">
					<h3>'.$title.'</h3>
					<p>'.$des.'</p>
					<img class="img_two" src="'.$screenshot_img.'" alt="E-commerce screenshots image">
				</div>
			</div>
		</div>

		';
	}
add_shortcode( 'ecommerce', 'ecommerce_area_shortcode' );
// use method: [ecommerce title="" des="" toplogo="" screenshot_img=""] //



// This is simple shortcode ***************//
	function contact_area_shortcode($atts){
		extract( shortcode_atts(array(
			'title'				=>	'',	
			'subtitle'				=>	'',	
			'des'				=>	'',
		), $atts, 'contact' ) );


		return '

			<div class="contact_us_area">
				<div class="container">
					<div class="row">
						<h1>'.$title.'</h1>
						<p style="margin-bottom:66px;">'.$des.'</p>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="contact_us_left">
								<h2>'.$subtitle.'</h2>
								<div style="margin: 35px 0px 10px 0px;">
									<a href="#"><span class="fa fa-flag-o"></span>companys</a>
									<a href="#"><span class="fa fa-home"></span>address</a>
									<a href="#"><span class="fa fa-phone"></span>phone</a>
									<a href="#"><span class="fa fa-envelope-o"></span>email</a>
									<a href="#"><span class="fa fa-map-marker"></span> zip code: zipcode</a>
								</div>
								<div>
									<a href=""><i class="fa fa-facebook"></i></a>
									<a href=""><i class="fa fa-twitter"></i></a>
									<a href=""><i class="fa fa-google-plus"></i></a>
									<a href=""><i class="fa fa-youtube"></i></a>
									<a href=""><i class="fa fa-rss"></i></a>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="contact_us">									
								'.do_shortcode('[contact-form-7 id="285" title="fox contact"]').'
							</div>
						</div>
					</div>
				</div>				
			</div>

		';
	}
add_shortcode( 'contact', 'contact_area_shortcode' );
// use method: [contact title="" subtitle="" des=""] //


// This is map shortcode ***************//
	function map_area_shortcode($atts){
		extract( shortcode_atts(array(
			'width'		=>	'',
			'height'	=>	'',
			'src'		=>	'',
		), $atts, 'map' ) );
		return '

			<div class="map_area" style="height:'.$height.'px;">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
						<iframe src="'.$src.'" width="'.$width.'" height="'.$height.'" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>				
			</div>

		';
	}
add_shortcode( 'map', 'map_area_shortcode' );
// use method: [map height="" url=""] //






?>