<?php 

#------ ajax product search ------#

// scripts register
function ajax_prduct_search_scripts(){
	wp_enqueue_script( 'aps-script', get_template_directory_uri() . '/ajax/ajax_product_search.js', array('jquery'), '1.0', true );
	wp_localize_script( 'aps-script', 'aps_url', array('ajax_url' => admin_url( 'admin-ajax.php' )) );
}

// shortcode register
function ajax_prduct_search_shortcode( $atts ){
	ob_start();
	extract(shortcode_atts(array(
		'show_all' => 'false',
	), $atts, 'ajax_product_search'));

	$productCats = get_terms(array(
		'taxonomy'   => 'product_cat',
		'fields'     => 'all',
		'hide_empty' => false,
	));

	$pwb_brands = get_terms(array(
		'taxonomy'   => 'pwb-brand',
		'fields'     => 'all',
		'hide_empty' => false,
	));
?>
	<div id="aps_wrap">
		<form action="" method="get">
			<label for="aps_category">Select Category</label>
			<select name="aps_category" id="aps_category">
				<option value="">-- Select Category --</option>
				<?php foreach( $productCats as $productCat ) : ?>
					<option value="<?php echo $productCat->slug; ?>"><?php echo$productCat->name; ?></option>
				<?php endforeach; ?>
			</select>
			<label for="aps_brand">Select Brand</label>
			<select name="aps_brand" id="aps_brand">
				<option value="">-- Select Brand --</option>
				<?php foreach( $pwb_brands as $pwb_brand ) : ?>
					<option value="<?php echo $pwb_brand->slug; ?>"><?php echo$pwb_brand->name; ?></option>
				<?php endforeach; ?>
			</select>
			<input type="submit" value="Search" />
		</form>
		<div class="aps_content">
			<h5>Your Products Here.</h5>
			<ul id="aps_products">
				<?php 
					$apsProducts = new WP_Query(array(
						'post_type' => 'product',
						'posts_per_page' => -1,
					));
				?>
				<?php if( $apsProducts->have_posts() ) : ?>
					<?php while( $apsProducts->have_posts() ) : $apsProducts->the_post(); ?>
						<li class="aps-product" id="product-<?php echo get_the_ID(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php else: ?>
					<h4>No Product Found!</h4>
				<?php endif; ?>
			</ul>
		</div>
	</div><!-- /#aps_wrap -->
<?php

	// hooking for scripts register function
	ajax_prduct_search_scripts();
	
	return ob_get_clean();
}
add_shortcode( 'ajax_product_search', 'ajax_prduct_search_shortcode' );

// ajax action
function ajax_prduct_search_action(){

	header("Content-Type: application/json");

	$aps_category = '';
	if(isset($_GET['category']))
		$aps_category = sanitize_text_field( $_GET['category'] );

	$aps_brand = '';
	if(isset($_GET['brand']))
		$aps_brand = sanitize_text_field( $_GET['brand'] );

	$aps_query = new WP_Query(array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'tax_query'		 => array(
			array(
				'taxonomy'         => 'product_cat',
				'field'            => 'slug',
				'terms'            => $aps_category,
				'include_children' => false,
				'operator'         => 'AND',
			),
			array(
				'taxonomy'         => 'pwb-brand',
				'field'            => 'slug',
				'terms'            => $aps_brand,
				'include_children' => false,
				'operator'         => 'AND',
			)
		),
	));

	$aps_filter = array();

	while ($aps_query->have_posts()) {
		$aps_query->the_post();
		$aps_filter[] = array(
			'id' => get_the_ID(),
			'title' => get_the_title(),
			'permalink' => get_the_permalink(),
		);
	}

	echo json_encode( $aps_filter );

	wp_die();
}
add_action( 'wp_ajax_aps', 'ajax_prduct_search_action' );
add_action( 'wp_ajax_nopriv_aps', 'ajax_prduct_search_action' );
#------ ajax product search ------#





?>