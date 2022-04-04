<?php

// https://stackoverflow.com/questions/40661032/using-checkboxes-for-variations-in-woocommerce-to-allow-multiple-choice

// global $wp_filter;
// echo '<pre>';
//     var_dump( $wp_filter['woocommerce_before_shop_loop'] );
// echo '</pre>';

/*
    show the currency code before the symbol.
*/
function patricks_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'USD':
            $currency_symbol = 'USD $';
            break;
        case 'NZD':
            $currency_symbol = 'NZD $';
            break;
        case 'AUD':
            $currency_symbol = 'AUD $';
            break;
    }
    return $currency_symbol;
}
add_filter('woocommerce_currency_symbol', 'patricks_currency_symbol', 30, 2);



/*
	Change the "Add to Cart" text on the single product page
*/
function wc_custom_single_addtocart_text() {
    return "Pay Now";
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'wc_custom_single_addtocart_text' );


#---------- woocommerce_product_add_to_cart_text -#
// Use for: WooCommerce <2.6.14
function flipmart_add_to_cart_text() {
    global $product;
    
    $product_type = $product->product_type;
    
    switch ( $product_type ) {
        case 'external':
            return __( 'Buy product', 'woocommerce' );
        break;
        case 'grouped':
            return __( 'View products', 'woocommerce' );
        break;
        case 'simple':
            return __( 'Add in your bag', 'woocommerce' );
        break;
        case 'variable':
            return __( 'Select options', 'woocommerce' );
        break;
        default:
            return __( 'Read more', 'woocommerce' );
    }   
}
add_filter( 'woocommerce_product_add_to_cart_text' , 'flipmart_add_to_cart_text' );

 
function woo_archive_custom_cart_button_text() { 
    return __( 'My Button Text', 'woocommerce' ); // 2.1 +
}
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );
#---------- woocommerce_product_add_to_cart_text -#



#---------- products view per page ----------------#
// http://mercytapscott.com/add-number-of-products-per-page-to-woocommerce
function flipmart_woocommerce_products_show_by() {
echo '<span class="itemsorder">Show:'; ?>
<form action="" method="POST" name="results" class="woocommerce-ordering">
<select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="sortby" onchange="this.form.submit()">
<?php
    // get products on page reload
    if(isset($_POST['woocommerce-sort-by-columns']) && (($_COOKIE['shop_pageResults'] <> $_POST['woocommerce-sort-by-columns']))) {
        $numberOfProductsPerPage = $_POST['woocommerce-sort-by-columns'];
    }else{
        $numberOfProductsPerPage = $_COOKIE['shop_pageResults'];
    }
    $shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
        // ''   => __('Products per page', 'flipmart'),
        '3' => __('3', 'flipmart'),
        '6' => __('6', 'flipmart'),
        '9' => __('9', 'flipmart'),
        '12'=> __('12', 'flipmart'),
        '-1'=> __('All', 'flipmart'),
    ));
    foreach ( $shopCatalog_orderby as $sort_id => $sort_name ){
        echo '<option value="'.$sort_id.'"'.selected( $numberOfProductsPerPage , $sort_id , true ).'>'.$sort_name.'</option>';
    }
?>
</select>
</form>
<?php echo '</span>'; }
function dl_sort_by_page($count) {
  if (isset($_COOKIE['shop_pageResults'])) {
     $count = $_COOKIE['shop_pageResults'];
  }
  if (isset($_POST['woocommerce-sort-by-columns'])) {
    setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/', 'http://localhost/flipmart/', false);
    $count = $_POST['woocommerce-sort-by-columns'];
  }
  return $count;
}
add_filter('loop_shop_per_page','dl_sort_by_page');
#---------- products view per page ----------------#




// custom_override_checkout_fields
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
	$fields['order']['order_comments']['placeholder'] = 'My new placeholder';
	return $fields;
}



// custom_unset_checkout_fields
add_filter( 'woocommerce_checkout_fields' , 'custom_unset_checkout_fields' );
function custom_unset_checkout_fields( $fields ) {
	unset($fields['billing']['billing_last_name']);
	return $fields;
}


// custom_labeltext_checkout_fields
add_filter( 'woocommerce_checkout_fields' , 'custom_labeltext_checkout_fields' );
function custom_labeltext_checkout_fields( $fields ) {
     $fields['billing']['billing_first_name']['label'] = '您的姓名';
     return $fields;
}


/* Change the "Proceed to PayPal" button text in the WooCommerce checkout screen
 * Add this to your theme's functions.php file
 */
add_filter( 'gettext', 'custom_paypal_button_text', 20, 3 );
function custom_paypal_button_text( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Proceed to PayPal' :
			$translated_text = __( 'NEW BUTTON TEXT', 'woocommerce' );
			break;
	}
	return $translated_text;
}




if ( ! function_exists( 'magneto_setup_woocommerce_image_dimensions' ) ) {
    function magneto_setup_woocommerce_image_dimensions() {
        $catalog = array( // square_medium size
            'width'     => '550',   // px
            'height'    => '550',   // px
            'crop'      => 1        // true
        );
     
        $single = array(
            'width'     => '550',   // px
            'height'    => '550',   // px
            'crop'      => 1        // true
        );
     
        $thumbnail = array(
            'width'     => '360',   // px
            'height'    => '360',   // px
            'crop'      => 0        // false
        );
     
        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
    add_action( 'after_switch_theme', 'magneto_setup_woocommerce_image_dimensions' );
}


#---------- custom woocommerce catalog ordering ------#

// function flipmart_woocommerce_catalog_ordering( $args ) {
//   $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
//  if ( 'random_list' == $orderby_value ) {
//      $args['orderby'] = 'rand';
//      $args['order'] = '';
//      $args['meta_key'] = '';
//  }
//  return $args;
// }
// add_filter( 'woocommerce_get_catalog_ordering_args', 'flipmart_woocommerce_catalog_ordering' );
// add_filter( 'woocommerce_default_catalog_orderby_options', 'flipmart_woocommerce_catalog_orderby' );

function custom_woocommerce_catalog_orderby( $sortby ) {
    // modify
    $sortby['menu_order'] = 'Default';
    $sortby['popularity'] = 'Popularity';
    $sortby['rating']     = 'Rating';
    $sortby['price']      = 'Price: Lowest first';
    $sortby['price-desc'] = 'Price: Highest first';

    // unset
    unset($sortby['date']);
    return $sortby;
}
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );

// custom woocommerce catalog filter
function praise_sort_by_latest_woocommerce_shop( $args ) {
   $orderby_value = isset( $_GET['orderby'] ) ? wc_clean( (string) wp_unslash( $_GET['orderby'] ) ) : wc_clean( get_query_var( 'orderby' ) );
    
   if ( 'name' == $orderby_value ) {
      $args['orderby'] = 'title';
      $args['order'] = 'asc';
      $args['meta_key'] = '';
   }
    
   return $args;
    
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'praise_sort_by_latest_woocommerce_shop' );
#---------- custom woocommerce catalog ordering ------#


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

// function remove_plugin_actions(){
//    global $WC_List_Grid;
//    remove_action( 'woocommerce_before_shop_loop', array( $WC_List_Grid, 'gridlist_toggle_button' ), 30); 
// }
// add_action('init','remove_plugin_actions');

#---------- Remove woo-commerce default hook ------#


#---------- modify woo-commerce default hook priority ------#
function modify_woocommerce_hook_priority(){

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
    
}
add_action( 'init', 'modify_woocommerce_hook_priority' );
#---------- modify woo-commerce default hook priority ------#


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
    <div class="total-price-basket"><?php echo WC()->cart->get_cart_total(); ?></div>
<?php
    $fragments['div.total-price-basket'] = ob_get_clean();
    return $fragments;
});
#---------- custom woocommerce_mini_cart() -----------#


#---------- qty_label_before_add_to_cart -------------#
function qty_label_before_add_to_cart() {
 echo '<div class="qty">qty: </div>'; 
}
add_action( 'woocommerce_before_add_to_cart_button', 'qty_label_before_add_to_cart' );
#---------- qty_label_before_add_to_cart -------------#


#--------- Remove dropdown variation default options -#
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'mmx_remove_select_text');
function mmx_remove_select_text( $args ){
    $args['show_option_none'] = '';
    return $args;
}
#--------- Remove dropdown variation default options -#


# ------- redirect_to_checkout ------------ #
add_filter ('add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    return $checkout_url;
}
# ------- redirect_to_checkout ------------ #


# ------- shop_page_redirection ------------ #
function shop_page_redirection() {
    if( is_shop() ){
        wp_redirect( home_url( '/product-category/coffee/' ) );
        exit();
    }
}
add_action( 'template_redirect', 'shop_page_redirection' );
# ------- shop_page_redirection ------------ #


# ------- cwp_wc_terms ------------ #
function cwp_wc_terms( $terms_is_checked ) {   
  return true;   
}   
add_filter( 'woocommerce_terms_is_checked_default', 'cwp_wc_terms', 10 );
# ------- cwp_wc_terms ------------ #


# ------- disable_autofocus ---------------- #
function disable_checkout_autofocus_firstname( $fields ) {
    $fields['billing']['billing_first_name']['autofocus'] = false; 
    return $fields;
} 
add_filter( 'woocommerce_checkout_fields', 'disable_checkout_autofocus_firstname' );
# ------- disable_autofocus ---------------- #


# ------- Remove Shipping Flat Rate Label ------------ #
function wc_remove_shipping_label( $label, $method ) {
    $new_label = preg_replace( '/^.+:/', '', $label );
    return $new_label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'wc_remove_shipping_label', 10, 2 );


function wc_free_shipping_label( $label, $method ) {
  if ( 0 == $method->cost ) {
    $label = 'Free!';
  }
  return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'wc_free_shipping_label', 10, 2 ); 


function hide_shipping_method_based_on_shipping_class( $rates, $package ) {
    // HERE define your shipping class SLUG
    $class_slug = array('anewall', 'free', 'loomwell', 'milamira-bridal', 'purple-may', 'rewritten', 'wool-art', 'yasmine-layani', 'leila-rae', 'light-paper');

    // HERE define the shipping method to hide
    $method_key_ids = array('flat_rate:4', 'flat_rate:7', 'flat_rate:8', 'flat_rate:10', 'flat_rate:12', 'flat_rate:14', 'flat_rate:16', 'flat_rate:17');

    // Checking in cart items
    foreach( WC()->cart->get_cart() as $cart_item ){
        // If we find the shipping class
        if( in_array($cart_item['data']->get_shipping_class(), $class_slug) ){
            foreach( $method_key_ids as $method_key_id ){
                unset($rates[$method_key_id]); // Remove the targeted method
            }
            break; // Stop the loop
        }
    }
    return $rates;
}
add_filter( 'woocommerce_package_rates', 'hide_shipping_method_based_on_shipping_class', 10, 2 );
# ------- Remove Shipping Flat Rate Label ------------ #


function gcartparts_free_shipping_cart_notice_zones() {
 
    global $woocommerce;     
    $default_zone = new WC_Shipping_Zone(0);
    $default_methods = $default_zone->get_shipping_methods();
 
    foreach( $default_methods as $key => $value ) {
        if ( $value->id === "free_shipping" ) {
            if ( $value->min_amount > 0 ) $min_amounts[] = $value->min_amount;
        }
    }
 
    $delivery_zones = WC_Shipping_Zones::get_zones();
     
    foreach ( $delivery_zones as $key => $delivery_zone ) {
        foreach ( $delivery_zone['shipping_methods'] as $key => $value ) {
            if ( $value->id === "free_shipping" ) {
                if ( $value->min_amount > 0 ) $min_amounts[] = $value->min_amount;
            }
        }
    }
 
    if ( is_array($min_amounts) ) {

        $min_amount = min($min_amounts);         
        $current = WC()->cart->subtotal;

        if ( $current < $min_amount ) {
            $added_text = esc_html__('Get free shipping if you order ', 'woocommerce' ) . wc_price( $min_amount - $current ) . esc_html__(' more!', 'woocommerce' );
            $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );
            $notice = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( 'Continue Shopping', 'woocommerce' ), $added_text );
            wc_print_notice( $notice, 'notice' );
        }else{
            wc_print_notice( esc_html__('Your order qualifies for free shipping!', 'woocommerce' ), 'notice' );
        }
    } 
} 
add_action( 'woocommerce_before_cart', 'gcartparts_free_shipping_cart_notice_zones' );


function gcartparts_hide_shipping_when_free_is_available( $rates ) {
    $free = array();
    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free[ $rate_id ] = $rate;
            break;
        }
    }
    return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'gcartparts_hide_shipping_when_free_is_available', 100 );


# ------- Hide Coupon Only Checkout Page ------------ #
function hide_coupon_field_on_checkout( $enabled ) {
    if ( is_checkout() ) { $enabled = false; }
    return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_checkout' );
# ------- Hide Coupon Only Checkout Page ------------ #


# ------- Change the order of the My Account Page endpoints ----- #
//  https://wpbeaches.com/change-rename-woocommerce-endpoints-accounts-page/
function custom_order_and_rename_myaccount_endpoints() {
    $myorder = array(
        'dashboard'          => __( 'Personal Info', 'woocommerce' ),
        'orders'             => __( 'My Orders', 'woocommerce' ),
        'my-reviews'         => __( 'My Reviews', 'woocommerce' ),
        'edit-account'       => __( 'Account', 'woocommerce' ),
        'edit-address'       => __( 'Addresses', 'woocommerce' ),
        // 'customer-logout'    => __( 'Logout', 'woocommerce' ),
        // 'downloads'          => __( 'Download', 'woocommerce' ),
    );
    return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'custom_order_and_rename_myaccount_endpoints' );
# ------- Change the order of the My Account Page endpoints ----- #


# ------- my reviews custom endpoint callback ----- #

function my_reviews_EP() {
    add_rewrite_endpoint( 'my-reviews', EP_PERMALINK | EP_PAGES );
}
add_action( 'init', 'my_reviews_EP' );

function my_reviews_query_vars( $vars ) {
    $vars[] = 'my-reviews';
    return $vars;
}
add_filter( 'query_vars', 'my_reviews_query_vars', 0 );

function my_reviews_flush_rewrite_rules() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_reviews_flush_rewrite_rules' );
 
function my_reviews_custom_endpoint_callback() {
    echo '<h1>My Reviews</h1>';    
}
add_action( 'woocommerce_account_my-reviews_endpoint', 'my_reviews_custom_endpoint_callback' );

# ------- my reviews custom endpoint callback ----- #


# ------- order button text ----- #
function woo_custom_order_button_text() {
    return __( 'Confirm Order', 'woocommerce' ); 
}
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 
# ------- order button text ----- #


function make_shop_product_full(){

    remove_filter( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

    function new_product_thumbnail(){
        the_post_thumbnail( 'full' );
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'new_product_thumbnail', 10 );
}
add_action( 'init', 'make_shop_product_full' );



#----- Method:1 Added custom field in Checkout Form & Order Details ------#

// @link: https://docs.woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/

// Our hooked in function - $fields is passed via the filter!
function add_checkout_fax_field( $fields ) {
    $fields['billing']['billing_fax'] = array(
        'label'       => __('Fax', 'woocommerce'),
        'placeholder' => _x('Fax', 'placeholder', 'woocommerce'),
        'required'    => false,
        'class'       => array('form-row-wide billing-fax'),
        'clear'       => true,
        'priority'    => 9
    );
    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'add_checkout_fax_field' );



// Check if set, if its not set add an error.
function checkout_fax_field_process_notice() {
    if ( ! $_POST['billing_fax'] )
        wc_add_notice( __( '<strong>Billing Fax </strong>is a required field.' ), 'error' );
}

// add_action('woocommerce_checkout_process', 'checkout_fax_field_process_notice');



// Update the order meta with field value
function checkout_fax_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['billing_fax'] ) ) {
        update_post_meta( $order_id, 'Fax', sanitize_text_field( $_POST['billing_fax'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'checkout_fax_field_update_order_meta' );



// Display field value on the order edit page 
function checkout_fax_field_in_admin_order_data($order){
    echo '<p><strong>'.__('Fax').':</strong> ' . get_post_meta( $order->get_id(), 'Fax', true ) . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'checkout_fax_field_in_admin_order_data', 10, 1 );


function checkout_alt_phone_in_admin_order_data($order){
    $billingAltPhone = get_post_meta( $order->get_order_number(), 'billing_alt_phone', true );
    echo '<div class="address"><p><strong style="display:block;">'.__('Alternative Phone No').':</strong>' . '<a href="tel:'.$billingAltPhone.'">' . $billingAltPhone . '</a></p></div>';

    echo '<div class="edit_address">';
    woocommerce_wp_text_input( array(
        'id' => 'billing_alt_phone',
        'label' => 'Alternative Phone No:',
        'value' => $billingAltPhone,
        'wrapper_class' => 'form-field-wide'
    ) );
    echo '</div>';

    $billingSubdistrict = get_post_meta( $order->get_order_number(), 'billing_subdistrict', true );
    echo '<div class="address"><p><strong style="display:block;">'.__('Sub District').':</strong><span>' . $billingSubdistrict . '</span></p></div>';

    echo '<div class="edit_address">';
    woocommerce_wp_text_input( array(
        'id' => 'billing_subdistrict',
        'label' => 'Sub District',
        'value' => $billingSubdistrict,
        'wrapper_class' => 'form-field-wide'
    ) );
    echo '</div>';

    // Print link
    $getOrder = new WC_Order(get_the_ID());
    $getOrderKey = $getOrder->order_key;
    echo '<a target="_blank" href="'.wc_get_checkout_url().'order-received/'.get_the_ID().'/?key='.$getOrderKey.'">Print</a>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'checkout_alt_phone_in_admin_order_data', 10, 1 );


#----- Method:1 Added custom field in Checkout Form & Order Details ------#





#----- Method:2 Added custom field in Checkout Form & Order Details ------#

// @link: https://wisdmlabs.com/blog/add-custom-fields-woocommerce-checkout-page/


// Checkout Default fields
$wdm_address_fields = array(
    'country',
    'title', //new field
    'address_4',
    'address_3',
    'first_name',
    'last_name',
    'company',
    'address_2',
    'address_1',
    'city',
    'state',
    'postcode'
);


// Checkout Extra fields
// $wdm_ext_fields = array(
//     'title',
//     'address_3',
//     'address_4'
// );


function wdm_override_default_address_fields( $address_fields ){
    
    $temp_fields = array();
    global $wdm_address_fields;

    $address_fields['title'] = array(
        'label'     => __('Title', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'type'      => 'select',
        'options'   => array(
            'Mr'    => __('Mr', 'woocommerce'),
            'Mrs'   => __('Mrs', 'woocommerce'),
            'Miss'  => __('Miss', 'woocommerce')
        )
    );
      
    $address_fields['address_4'] = array(
        'label'       => __('Area', 'woocommerce'),
        'placeholder' => 'Area',
        'class'       => array('form-row-wide', 'address-field'),
        'type'        => 'text'
    );
    
    $address_fields['address_3'] = array(
        'label'       => __('House No / Name', 'woocommerce'),
        'placeholder' => 'House No / Name',
        'required'    => true,
        'class'       => array('form-row-wide', 'address-field'),
        'type'        => 'text'
     );

    foreach($wdm_address_fields as $fky){       
        $temp_fields[$fky] = $address_fields[$fky];
    }
    
    $address_fields = $temp_fields;
    
    return $address_fields;
}
add_filter( 'woocommerce_default_address_fields' , 'wdm_override_default_address_fields' );


function wdm_formatted_address_replacements( $address, $args ){

    global $order;

    $address['{name}'] = $args['title']." ".$args['first_name']." ".$args['last_name']; //show title along with name
    $address['{address_1}'] = $args['address_1']."\r\n".$args['address_2']; //reposition to display as it should be
    $address['{address_2}'] = $args['address_3']."\r\n".$args['address_4']; //reposition to display as it should be

    $address['{postcode}'] = $args['postcode']."\r\n\r\n". "Fax: " .get_post_meta( get_the_ID(), 'Fax', true );

    $address['{Rahul}'] = 'Hi, rahul'; //reposition to display as it should be

    echo "<pre>";
        // print_r(get_the_ID());
    echo "</pre>";
    
    return $address;
}
add_filter('woocommerce_formatted_address_replacements', 'wdm_formatted_address_replacements', 99, 2);


function wdm_update_formatted_billing_address( $address, $obj ){

    global $wdm_address_fields;
         
    if( is_array( $wdm_address_fields ) ){
        
        foreach($wdm_address_fields as $waf){
            $address[$waf] = $obj->{'billing_'.$waf};
        }
    }         
    return $address;    
}
add_filter( 'woocommerce_order_formatted_billing_address', 'wdm_update_formatted_billing_address', 99, 2);


function wdm_update_formatted_shipping_address( $address, $obj ){

    global $wdm_address_fields;
         
    if( is_array( $wdm_address_fields ) ){
        
        foreach( $wdm_address_fields as $waf ){
            $address[$waf] = $obj->{'shipping_'.$waf};
        }
    }    
    return $address;    
}
add_filter( 'woocommerce_order_formatted_shipping_address', 'wdm_update_formatted_shipping_address', 99, 2);


function wdm_my_account_address_formatted_address( $address, $customer_id, $name ){
    
    global $wdm_address_fields;
    
    if( is_array( $wdm_address_fields ) ){
        
        foreach($wdm_address_fields as $waf){
            $address[$waf] = get_user_meta( $customer_id, $name.'_'.$waf, true );
        }
    }    
    return $address;
}
add_filter('woocommerce_my_account_my_address_formatted_address', 'wdm_my_account_address_formatted_address', 99, 3);


function wdm_add_extra_customer_field( $fields ){
    
    //take back up of email and phone fields as they will be lost after repositioning
    $email = $fields['email']; 
    $phone = $fields['phone'];

    $fields = wdm_override_default_address_fields( $fields );
    
    //reassign email and phone fields
    $fields['email'] = $email;
    $fields['phone'] = $phone;
    
    global $wdm_address_fields;
    
    if( is_array( $wdm_address_fields ) ){
        
        foreach( $wdm_address_fields as $wef ){
            $fields[$wef]['show'] = false;
            //hide the way they are display by default as we have now merged them within the address field
        }
    }    
    return $fields;
}
add_filter('woocommerce_admin_billing_fields', 'wdm_add_extra_customer_field');
add_filter('woocommerce_admin_shipping_fields', 'wdm_add_extra_customer_field');


#----- Method:2 Added custom field in Checkout Form & Order Details ------#


# ------- Custom Edit Account Field ----- #
// Save the custom field
function woocommerce_edit_account_phone( $user_id ) {
    if( isset( $_POST['account_phone'] ) ){
        update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['account_phone'] ) );
    }
}
add_action( 'woocommerce_save_account_details', 'woocommerce_edit_account_phone', 12, 1 );

// Empty Check
function edit_account_phone_empty_check(){
    if ( ! ( $_POST['account_phone'] ) ) {
        wc_add_notice( __( '<strong>Phone Number </strong>is a required field.' ), 'error' );
    }
}
add_action( 'woocommerce_save_account_details_errors', 'edit_account_phone_empty_check' );
# ------- Custom Edit Account Field ----- #



#----- My Account Registration Extra Fields -----#

//@Link: https://www.cloudways.com/blog/add-woocommerce-registration-form-fields/

// Add Registration Fields
function wooc_extra_register_fields() {?>
    <p class="form-row form-row-first">
        <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>

    <p class="form-row form-row-last">
        <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>

    <p class="form-row form-row-wide">
        <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php esc_attr_e( $_POST['billing_phone'] ); ?>" />
    </p>
    <div class="clear"></div>
<?php
}
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );


// Validating Registration Fields
function wooc_validate_extra_register_fields( $validation_error, $username, $password, $email )
{
    if( !isset($_POST['billing_first_name']) || empty($_POST['billing_first_name']) ){
        $validation_error->add('error', 'Please enter your First name.');
    }
    elseif( !isset($_POST['billing_last_name']) || empty($_POST['billing_last_name']) ){
        $validation_error->add('error', 'Please enter your Last name.');
    }
    return $validation_error;
}
add_filter( 'woocommerce_process_registration_errors', 'wooc_validate_extra_register_fields', 10, 4 );



// Save Registration Fields
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['billing_phone'] ) ) {
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    }

}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
#----- My Account Registration Extra Fields -----#


#----- Stop Auto Redirect On Search -----#
add_filter( 'woocommerce_redirect_single_search_result', '__return_false' );
#----- Stop Auto Redirect On Search -----#


#----- free shipping label text -----#
// function wc_free_shipping_label( $label, $method ) {
//   if ( 0 == $method->cost ) {
//     $label = 'Free!';
//   }
//   return $label;
// }
// add_filter( 'woocommerce_cart_shipping_method_full_label', 'wc_free_shipping_label', 10, 2 );
#----- free shipping label text -----# 


#----- Order Details Editable Fields -----#
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'mishafunction' );        
function mishafunction( $order ){        
    $x = get_post_meta( $order->get_order_number(), 'CUSTOM FIELD NAME', true );
    ?>
    <div class="address">
    <p<?php if( !$x ) echo ' class="none_set"' ?>>
        <strong>Datum rojstva:</strong>
        <?php echo ( $x ) ? $x : '' ?>
    </p>
    </div>
    <div class="edit_address"><?php
    woocommerce_wp_text_input( array(
        'id' => 'CUSTOM FIELD NAME',
        'label' => 'Datum rojstva:',
        'value' => $x,
        'wrapper_class' => 'form-field-wide'
    ) );
    ?></div><?php
}
#----- Order Details Editable Fields -----#




?>

<?php echo wc_price($product->price); ?>


<?php

/**
 * Display category image on category archive
 */
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        if ( $image ) {
            echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
        }
    }
}

?>


<?php
//  https://support.yithemes.com/hc/en-us/articles/115001372967-Wishlist-How-to-count-number-of-products-wishlist-in-ajax

echo '<li class="nectar-woo-wishlist"><a href="/wishlist/"><i class="icon-salient-heart-2"></i><span class="wish-count">'.YITH_WCWL()->count_products().'</span></a></li>';


if( defined( 'YITH_WCWL' ) ){
    function yith_wcwl_ajax_update_count(){
        wp_send_json( array( 'count' => yith_wcwl_count_all_products() ) );
    }
    add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
    add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}


// Archive product per page
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 4;
    }
}
add_filter('loop_shop_columns', 'loop_columns', 999);


// Archive Color Attribute
function praiseonlinestore_color_attribute_on_archive() {
    if(is_shop() || is_product_category()){
        global $product;
        $attributes = $product->get_attributes();
        if($attributes["pa_color"]){
            // $attribute_taxonomies = wc_get_attribute_taxonomies();
            echo '<ul class="paColor">';
            $pa_color = wp_get_post_terms( $product->get_id(), 'pa_color', 'all' );
            foreach ( $pa_color as $term ) {
                $colorImageId = get_term_meta( $term->term_id, 'product_attribute_image', true );
                $colorImage   = wp_get_attachment_image_src( $colorImageId, 'thumbnail', false );
                $getColorCode = get_term_meta( $term->term_id, 'product_attribute_color', true );
                if($colorImage){
                    echo '<li><img src="'.$colorImage[0].'" alt="'.$term->name.'"></li>';
                }else{
                    echo '<li style="background-color:'.$getColorCode.'"></li>';
                }
            }
            echo '</ul>';
        }
    }
}
add_action( 'woocommerce_after_shop_loop_item', 'praiseonlinestore_color_attribute_on_archive', 15 );


// Archive Product Attribute
function praiseonlinestore_product_attribute_on_archive() {
    if(is_shop() || is_product_category()){
        global $product;
        $attributes = $product->get_attributes();
        if($attributes){
            echo '<ul style="display:none" class="paAttributes">';
                foreach ($attributes as $attribute) {
                    $pa_attributes = wp_get_post_terms( $product->get_id(), $attribute->get_name(), 'all' );
                    echo "<li class=".$attribute->get_name().">".count($pa_attributes)." ".wc_attribute_label($attribute->get_name())."</li>";
                }
            echo '</ul>';
        }
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'praiseonlinestore_product_attribute_on_archive', 10 );



// Show Variation Price Below Title
function shuffle_variable_product_elements(){
    if ( is_product() ) {
        global $post;
        $product = wc_get_product( $post->ID );
        if ( $product->is_type( 'variable' ) ) {
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
            add_action( 'woocommerce_before_variations_form', 'woocommerce_template_single_price', 10 );

            remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
            add_action( 'woocommerce_before_variations_form', 'woocommerce_single_variation', 20 );

            add_action( 'woocommerce_before_variations_form', 'praiseonlinestore_pwb_single_product_brand', 25 );
        }
    }
}
add_action( 'woocommerce_before_single_product', 'shuffle_variable_product_elements' );



// Enable Salient theme image popup
echo "<a href='' rel='prettyPhoto'><img src='' alt=''></a>";


// checkout error customize
function praise_checkout_error_customize( $fields, $errors ){
    // if any validation errors
    if( !empty( $errors->get_error_codes() ) ) {

        // remove all of them
        foreach( $errors->get_error_codes() as $code ) {
            $errors->remove( $code );
        }

        // add our custom one
        $errors->add( 'validation', 'Please be sure to complete all required information.' ); 
    } 
}
add_action( 'woocommerce_after_checkout_validation', 'praise_checkout_error_customize', 9999, 2);



/*
 01. if ( $email->id == 'new_order' ) {}
 02. if ( $email->id == 'cancelled_order' ) {}
 03. if ( $email->id == 'failed_order' ) {}
 04. if ( $email->id == 'customer_on_hold_order' ) {}
 05. if ( $email->id == 'customer_processing_order' ) {}
 06. if ( $email->id == 'customer_completed_order' ) {}
 07. if ( $email->id == 'customer_refunded_order' ) {}
 08. if ( $email->id == 'customer_invoice' ) {}
 09. if ( $email->id == 'customer_note' ) {}
 10. if ( $email->id == 'customer_reset_password' ) {}
 11. if ( $email->id == 'customer_new_account' ) {}
*/

function praise_add_email_note_specific_email( $order, $sent_to_admin, $plain_text, $email ) {
    // echo '<p>'.$email->id.'</p>';
    if($email->id=="customer_refunded_order"){
        echo '<h3 id="again_email_note">Your Order Has Been Refunded</h3>';
    }elseif($email->id=="new_order"){
        echo '<h3 id="again_email_note">Please process new order!</h3>';
    }elseif($email->id=="customer_processing_order"){
        echo '<h3 id="again_email_note">WE WILL EMAIL YOU AGAIN WHEN YOUR ORDER IS PROCESSED</h3>';
    }else{
        echo '<h3 id="again_email_note">We will email you again when it is on its way</h3>';
    }
}
add_action( 'woocommerce_email_order_details', 'praise_add_email_note_specific_email', 10, 4 );


function praise_add_template_title_customer_completed_order( $email_heading , $email ) {
    return $email_heading = 'Thank you for your purchase';
};
add_filter( "woocommerce_email_heading_customer_completed_order", 'praise_add_template_title_customer_completed_order', 10, 2 );



/* Add short description under product title */
function woocommerce_template_loop_product_title_with_desc() {
        global $product;
        $short_description = apply_filters( 'woocommerce_short_description', $product->post->post_excerpt );
        echo '<h3 class="loop-title">' . get_the_title() . '</h3>';
        echo '<div class="short-desc">' . $short_description . '</div>';
}

function _remove_woocommerce_default_hook(){
    /*REMOVE old loop-title action             */
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
    
    /* ADD new loop-title-with sku action      */
    add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title_with_desc', 10 );
}
add_action( 'init', '_remove_woocommerce_default_hook' );


?>


<ul>
    <li><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>">View Cart</a></li>
    <li><a href="<?php echo get_permalink( wc_get_page_id( 'view_order' ) ); ?>">Track your orders</a></li>
    <li><a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">Account Information</a></li>
</ul>


https://appcoder.link/how-to-update-shipping-cost-in-cart-dynamically-based-on-a-custom-field-in-woocommerce/


<!-- Cart item note -->
https://pluginrepublic.com/how-to-add-an-input-field-to-woocommerce-cart-items/



<?php

/* Up Sell Product Customize on Single Product Page*/
function bbloomer_change_number_related_products( $args ) {
   $args['posts_per_page'] = 2;
   $args['columns'] = 2; 
   return $args;
}
add_filter( 'woocommerce_upsell_display_args', 'bbloomer_change_number_related_products', 9999 );



if( isset($_POST['add-to-cart']) ){

    $product = wc_get_product( get_the_ID() );
    $product->set_regular_price($_POST['alg_open_price']);
    $product->set_sale_price($_POST['alg_open_price']);
    $product->set_price($_POST['alg_open_price']);
    $product->save();

}



