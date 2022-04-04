<?php

// product query
$product_query = new WP_Query(array(
	'post_type'      => 'product',
	'posts_per_page' => -1,
	'orderby'        =>'date',
	'order'          => 'DESC',
	'stock'          => 1,
	'tax_query' => array(
		array(
			'taxonomy' 		   => 'product_cat',
			'field'            => 'slug',
			'terms'            => $product_category,
			'include_children' => false,
			'operator'         => 'AND',
		)
	),
));

?>

<ul class="product_lists">
	<?php if($product_query->have_posts()): ?>
		<?php while($product_query->have_posts()) : $product_query->the_post();
			global $woocommerce, $product;
			$get_product = new WC_Product( get_the_ID() );
			$currency = get_woocommerce_currency_symbol();
			$price = get_post_meta( get_the_ID(), '_regular_price', true);
			$sale = get_post_meta( get_the_ID(), '_sale_price', true);
			$add_to_cart_text = $get_product->single_add_to_cart_text();
			$get_price_html = $get_product->get_price_html();
			$product_thumbnail = (has_post_thumbnail( $product_query->post->ID )) ? get_the_post_thumbnail($product_query->post->ID, 'full') : '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />';
		?>
			<li class="product" id="product-<?php echo get_the_ID(); ?>">
				<div class="product_container">
					<div class="product_img">
						<a href="<?php the_permalink(); ?>"><?php echo $product_thumbnail; ?></a>
					</div>
					<div class="product_caption">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<span class="price"><?php echo $get_price_html; ?></span>
						<div class="cart">
							<?php woocommerce_template_loop_add_to_cart( $product_query->post, $product ); ?>
						</div>
					</div>
				</div>
			</li>
		<?php endwhile; wp_reset_postdata(); ?>
	<?php else: ?>
		<li class="no-product">No Product Found!</li>
	<?php endif; ?>
</ul>

<div class="product_pagination">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $product_query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>


<!-- Featured Product Query -->
<?php


function _woo_featured_product_shortcode(){
	ob_start();
	$meta_query  = WC()->query->get_meta_query();
	$tax_query   = WC()->query->get_tax_query();
	$tax_query[] = array(
	    'taxonomy' => 'product_visibility',
	    'field'    => 'name',
	    'terms'    => 'featured',
	    'operator' => 'IN',
	);
	 
	$args = array(
	    'post_type'           => 'product',
	    'post_status'         => 'publish',
	    'posts_per_page'      => 10,
	    'meta_query'          => $meta_query,
	    'tax_query'           => $tax_query,
	);
	 
	$featured_query = new WP_Query( $args );
	     
	if ($featured_query->have_posts()) {
	    while ($featured_query->have_posts()) :  $featured_query->the_post();
	        $product = get_product( $featured_query->post->ID );
	        $price = $product->get_price_html();
	?>
	<div class="featured-product">
	    <a href="<?php the_permalink(); ?>">
	        <?php echo woocommerce_get_product_thumbnail(); ?>
	    </a>
	    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</div>
	<?php endwhile; }
	return ob_get_clean();
}
add_shortcode( '_featured_product', '_woo_featured_product_shortcode' );



// Woocommerce Functions Lists
echo woocommerce_get_product_thumbnail();
get_woocommerce_term_meta( $term_id, 'key', true );

#-- https://businessbloomer.com/woocommerce-easily-get-product-info-title-sku-desc-product-object/ --#
#-- https://docs.woocommerce.com/wc-apidocs/class-WC_Product.html --#

// Get Product ID
$product->get_id();

// Get Product General Info
$product->get_type();
$product->get_name();
$product->get_slug();
$product->get_date_created();
$product->get_date_modified();
$product->get_status();
$product->get_featured();
$product->get_catalog_visibility();
$product->get_description();
$product->get_short_description();
$product->get_sku();
$product->get_menu_order();
$product->get_virtual();
get_permalink( $product->get_id() );

// Get Product Prices
$product->get_price_html();
$product->get_price();
$product->get_regular_price();
$product->get_sale_price();
$product->get_date_on_sale_from();
$product->get_date_on_sale_to();
$product->get_total_sales();

// Get Product Tax, Shipping & Stock
$product->get_tax_status();
$product->get_tax_class();
$product->get_manage_stock();
$product->get_stock_quantity();
$product->get_stock_status();
$product->get_backorders();
$product->get_sold_individually();
$product->get_purchase_note();
$product->get_shipping_class_id();

// Get Product Dimensions
$product->get_weight();
$product->get_length();
$product->get_width();
$product->get_height();
$product->get_dimensions();

// Get Linked Products
$product->get_upsell_ids();
$product->get_cross_sell_ids();
$product->get_parent_id();

// Get Product Variations
$product->get_attributes();
$product->get_default_attributes();

// Get Product Taxonomies
$product->get_categories();
$product->get_category_ids();
$product->get_tag_ids();

// Get Product Downloads
$product->get_downloads();
$product->get_download_expiry();
$product->get_downloadable();
$product->get_download_limit();

// Get Product Images
$product->get_image_id();
get_the_post_thumbnail_url( $product->get_id(), 'full' );
$product->get_gallery_image_ids();

// Get Product Reviews
$product->get_reviews_allowed();
$product->get_rating_counts();
$product->get_average_rating();
$product->get_review_count();

// Get $product object from product ID
$product = wc_get_product( $product_id );
$product->get_type();
$product->get_name();



// Get $product object from $order / $order_id
$order = new WC_Order( $order_id );
$ordgerItems = $order->get_items();
foreach ( $ordgerItems as $ordgerItem ) {
    $product = wc_get_product( $ordgerItem['product_id'] );
    $product->get_type();
    $product->get_name();
}

// Get $product object from Cart object
$cart = WC()->cart->get_cart();
foreach( $cart as $cart_item ){
    $product = wc_get_product( $cart_item['product_id'] );
    $product->get_type();
    $product->get_name();
}

?>