<?php

/*
	Woo-Commerce Functions
*/


#---------- loop_shop_columns --------------------#
// https://docs.woocommerce.com/document/change-number-of-products-per-row/
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}
add_filter('loop_shop_columns', 'loop_columns');
#---------- loop_shop_columns --------------------#


#---------- woocommerce_breadcrumb_defaults ------#
// https://docs.woocommerce.com/document/customise-the-woocommerce-breadcrumb/
function flipmart_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => '', // &#47;
        'wrap_before' => '<ul class="list-inline list-unstyled">',
        'wrap_after'  => '</ul>',
        'before'      => '<li>',
        'after'       => '</li>',
        'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
    );
}
add_filter( 'woocommerce_breadcrumb_defaults', 'flipmart_woocommerce_breadcrumbs' );
#---------- woocommerce_breadcrumb_defaults ------#


#---------- Remove woo-commerce default hook ------#
function remove_woocommerce_default_hook(){

	global $WC_List_Grid;

	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 0 );

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30, 0 );

	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10, 0 );

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

}
add_action( 'init', 'remove_woocommerce_default_hook' );

function remove_plugin_actions(){
   global $WC_List_Grid;
   remove_action( 'woocommerce_before_shop_loop', array( $WC_List_Grid, 'gridlist_toggle_button' ), 30); 
}
add_action('init','remove_plugin_actions');

#---------- Remove woo-commerce default hook ------#


#---------- modify woo-commerce default hook priority ------#
function modify_woocommerce_hook_priority(){

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );

    add_action( 'woocommerce_after_shop_loop_item_title', 'each_product_add_to_wishlist' );

    function each_product_add_to_wishlist(){
        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
    }

}
add_action( 'init', 'modify_woocommerce_hook_priority' );
#---------- modify woo-commerce default hook priority ------#


#---------- modify woo-commerce default filter -------------#
function filter_yith_wcwl_button_label( $wishlist_label ) { 
    // make filter magic happen here... 
    $wishlist_label = '<i class="fa fa-heart"></i>';
    return $wishlist_label; 
};
add_filter( 'yith_wcwl_button_label', 'filter_yith_wcwl_button_label', 10, 1 );
#---------- modify woo-commerce default filter -------------#


#---------- custom woocommerce catalog ordering ------#
function flipmart_woocommerce_catalog_orderby( $sortby ) {
	// modify
	$sortby['menu_order'] = 'Default';
	$sortby['popularity'] = 'Popularity';
	$sortby['rating'] = 'Rating';
	$sortby['price'] = 'Price: Lowest first';
	$sortby['price-desc'] = 'Price: Highest first';

	// unset
	unset($sortby['date']);
	return $sortby;
}
add_filter( 'woocommerce_catalog_orderby', 'flipmart_woocommerce_catalog_orderby' );
#---------- custom woocommerce catalog ordering ------#


#---------- custom woocommerce_mini_cart() -----------#
// https://stackoverflow.com/questions/39969280/woocommerce-add-to-cart-ajax-and-mini-cart

// Cart item/items count
add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {
    ob_start();
?>
    <div class="cart-contents">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </div>
    <?php $fragments['div.cart-contents'] = ob_get_clean();
    return $fragments;
});

// Mini cart
add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {
    ob_start();
?>
    <div class="header-quickcart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['div.header-quickcart'] = ob_get_clean();
    return $fragments;
});

// Cart total
add_filter('woocommerce_add_to_cart_fragments', function ( $fragments ) {
    ob_start();
?>
    <span class="total-price"><?php echo WC()->cart->get_cart_total(); ?></span>
<?php
    $fragments['span.total-price'] = ob_get_clean();
    return $fragments;
});
#---------- custom woocommerce_mini_cart() -----------#


#---------- qty_label_before_add_to_cart -------------#
function qty_label_before_add_to_cart() {
 echo '<div class="qty">qty: </div>';
}
add_action( 'woocommerce_before_add_to_cart_button', 'qty_label_before_add_to_cart' );
#---------- qty_label_before_add_to_cart -------------#



?>