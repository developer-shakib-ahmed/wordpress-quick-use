<?php

#----- include owl carousel -----#
function include_scripts(){
	wp_enqueue_script( 'owlCarousel-js', get_stylesheet_directory_uri().'/js/owl-carousel/owl.carousel.min.js', array('jquery'), '2.3.4', false );
	wp_enqueue_style( 'owlCarousel-style', get_stylesheet_directory_uri().'/js/owl-carousel/owl.carousel.min.css', '', '2.3.4', 'all' );
	wp_enqueue_style( 'owlCarousel-theme-style', get_stylesheet_directory_uri().'/js/owl-carousel/owl.theme.default.min.css', '', '2.3.4', 'all' );
}
add_action( 'wp_enqueue_scripts', 'include_scripts' );
#----- include owl carousel -----#



#----- product carousel shortcode -----#
function light_product_carousel_shortcode($atts){
	ob_start();
	extract(shortcode_atts( array(
		'product_category' => '',
	), $atts, 'light_product_carousel' ));

	// product query
	$product_carousel = new WP_Query(array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'orderby'        =>'date',
		'order'          => 'DESC',
		'stock'          => 1,
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field'            => 'slug',
				'terms'            => $product_category,
				'include_children' => false,
				'operator'         => 'AND',
			)
		),
	));

?>
<div class="productCarousel">
	<div class="owl-carousel owl-theme">
		<?php if($product_carousel->have_posts()) : ?>
			<?php while($product_carousel->have_posts()) : $product_carousel->the_post();
				global $woocommerce, $product;
				$get_product = new WC_Product( get_the_ID() );
				$currency = get_woocommerce_currency_symbol();
				$price = get_post_meta( get_the_ID(), '_regular_price', true);
				$sale = get_post_meta( get_the_ID(), '_sale_price', true);
				$add_to_cart_text = $get_product->single_add_to_cart_text();
				$get_price_html = $get_product->get_price_html();
				$product_thumbnail = (has_post_thumbnail( $product_carousel->post->ID )) ? get_the_post_thumbnail($product_carousel->post->ID, 'full') : '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />';
			?>
				<div class="item" id="product-<?php echo get_the_ID(); ?>">
					<div class="product_container">
						<div class="product_img">
							<a href="<?php the_permalink(); ?>"><?php echo $product_thumbnail; ?></a>
						</div>
						<div class="product_caption">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<span class="price"><?php echo $get_price_html; ?></span>
							<div class="cart">
								<?php woocommerce_template_loop_add_to_cart( $product_carousel->post, $product ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		<?php else: ?>
			<h4>No Product Found!</h4>
		<?php endif; ?>
	</div>
</div>
<?php
	return ob_get_clean();
}
add_shortcode( 'light_product_carousel', 'light_product_carousel_shortcode' );
#----- product carousel shortcode -----#



#----- post carousel shortcode -----#
function light_post_carousel_shortcode($atts){
	ob_start();
	extract(shortcode_atts( array(
		'post_category' => '',
	), $atts, 'light_post_carousel' ));

	// post query
	$post_carousel = new WP_Query(array(
		'post_type'      => 'post',
		'posts_per_page' => -1,
		'orderby'        =>'date',
		'tax_query' => array(
			array(
				'taxonomy'			=> 'category',
				'field'            => 'slug',
				'terms'            => $post_category,
				'include_children' => false,
				'operator'         => 'AND',
			)
		),
	));

	$currentCat = get_category_by_slug( $post_category );
	$cat_title  = $currentCat->name;
	$cat_link   = get_category_link( $currentCat->term_id );

?>
<div id="<?php echo $post_category; ?>" class="postCarousel PostCarousel1">
	<div class="cat_title">
		<div class="title_inner">
			<span class="t_big"><?php echo $cat_title; ?></span>
			<span class="t_line"></span>
			<span class="t_link"><a href="<?php echo $cat_link; ?>" class="more">View All</a></span>
		</div>
	</div>
	<div class="owl-carousel owl-theme">
		<?php if($post_carousel->have_posts()) : ?>
			<?php while($post_carousel->have_posts()) : $post_carousel->the_post();
				$viewCount = get_post_meta( get_the_ID(), 'light_viewsCount', true);
				if($viewCount >= 1){
					$viewCount = ($viewCount == 1) ? $viewCount.' view' : $viewCount.' views' ;
				}else{
					$viewCount = 'No View';
				}
			?>
				<div class="item" id="post-<?php echo get_the_ID(); ?>">
					<div class="post_thumb">
						<?php
							$postThumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false );
						?>
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo $postThumb[0]; ?>)"></a>
					</div>
					<div class="post_meta">
						<h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="meta">
							<span class="date"><?php echo My_Ago_Time(); ?></span>
							<span class="dot">·</span>
							<span class="view"><?php echo $viewCount; ?></span>
						</p>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		<?php else: ?>
			<h4>No Post Found!</h4>
		<?php endif; ?>
	</div>
</div>
<?php
	return ob_get_clean();
}
add_shortcode( 'light_post_carousel', 'light_post_carousel_shortcode' );
// [light_post_carousel post_category="featured"]
#----- post carousel shortcode -----#



#----- Related post carousel shortcode -----#
function related_post_carousel_shortcode($atts){
	ob_start();
	$current_id = get_the_ID();

	// related post query
	$related_items = new WP_Query(array(
		'post_type'      => 'post',
		'posts_per_page' => -1,
		'orderby' 		 => 'rand',
		'post__not_in' => array($current_id),
	));

?>
<div id="post-<?php echo $current_id; ?>" class="postCarousel PostCarousel1 relatedPostCarousel">
	<div class="owl-carousel owl-theme">
		<?php if($related_items->have_posts()) : ?>
			<?php while($related_items->have_posts()) : $related_items->the_post();
				$viewCount = get_post_meta( get_the_ID(), 'light_viewsCount', true);
				if($viewCount >= 1){
					$viewCount = ($viewCount == 1) ? $viewCount.' view' : $viewCount.' views' ;
				}else{
					$viewCount = 'No View';
				}
			?>
				<div class="item" id="post-<?php echo get_the_ID(); ?>">
					<div class="post_thumb">
						<?php
							$postThumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false );
						?>
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo $postThumb[0]; ?>)"></a>
					</div>
					<div class="post_meta">
						<h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="meta">
							<span class="date"><?php echo My_Ago_Time(); ?></span>
							<span class="dot">·</span>
							<span class="view"><?php echo $viewCount; ?></span>
						</p>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		<?php else: ?>
			<h4>No Post Found!</h4>
		<?php endif; ?>
	</div>
</div>
<?php
	return ob_get_clean();
}
add_shortcode( 'related_post_carousel', 'related_post_carousel_shortcode' );
// [related_post_carousel]
#----- Related post carousel shortcode -----#



#----- Recent post carousel shortcode -----#
function recent_post_carousel_shortcode($atts){
	ob_start();

	// Recent post carousel query
	$recentPostCarousel = new WP_Query(array(
		'post_type'      => 'post',
		'posts_per_page' => -1,
	));

?>
<div id="recentPostCarousel" class="postCarousel recentPostCarousel">
	<div class="owl-carousel owl-theme">
		<?php if($recentPostCarousel->have_posts()) : ?>
			<?php while($recentPostCarousel->have_posts()) : $recentPostCarousel->the_post();
				$viewCount = get_post_meta( get_the_ID(), 'light_viewsCount', true);
				if($viewCount >= 1){
					$viewCount = ($viewCount == 1) ? $viewCount.' view' : $viewCount.' views' ;
				}else{
					$viewCount = 'No View';
				}
			?>
				<div class="item" id="post-<?php echo get_the_ID(); ?>">
					<div class="post_thumb">
						<?php
							$postThumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false );
						?>
						<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo $postThumb[0]; ?>)"></a>
					</div>
					<div class="post_meta">
						<h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="meta">
							<span class="date"><?php echo My_Ago_Time(); ?></span>
							<span class="dot">·</span>
							<span class="view"><?php echo $viewCount; ?></span>
						</p>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		<?php else: ?>
			<h4>No Post Found!</h4>
		<?php endif; ?>
	</div>
</div>
<?php
	return ob_get_clean();
}
add_shortcode( 'recent_post_carousel', 'recent_post_carousel_shortcode' );
// [recent_post_carousel]
#----- Recent post carousel shortcode -----#

?>