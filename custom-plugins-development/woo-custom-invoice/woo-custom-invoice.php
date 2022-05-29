<?php 
/*
	Plugin Name: WooCommerce Invoice
	Plugin URI:  https://www.aschool.org/wp-content/plugins/woo-custom-invoice
	Description: This plugin allow to show up the Woo Commerce Order Invoice criteria.
	Version:     1.0.0
	Author:      Shakib Ahemd
	Author URI:  https://www.shakibahmed.com
	License:     GPL-2.0+
	License URI: http://www.gnu.org/licenses/gpl-2.0.txt

	This theme, like WordPress, is licensed under the GPL.
	Use it to make something cool, have fun, and share what you've learned with others.
	Plugin Short Name: wci [WooCommerce Custom Invoice]
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2019 Automattic, Inc.
*/


if( ! defined( 'ABSPATH' ) ){
	die( 'Hey, you can\'t access this file, you silly human!' );
}


// Configuration Info
$WCI_Config = array(
	'logo'	   => "/wp-content/uploads/2019/09/invoice-logo.png",
	'qrcode'   => "/wp-content/uploads/2019/09/qrcode.png",
	'address'  => "1st Floor, Riad Plaza,<br>Amjhupi Bazar,<br>Meherpur 7101",
	'phone1'   => "+8801713902426",
	'email'    => "support@uniquesoftbd.com",
	'website'  => "www.uniquesoftbd.com",
);


// Print link
function show_print_link_in_admin_order_data($order){
    $getOrder = new WC_Order(get_the_ID());
    $getOrderKey = $getOrder->order_key;
    echo '<a target="_blank" href="'.wc_get_checkout_url().'order-received/'.get_the_ID().'/?key='.$getOrderKey.'">Print</a>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'show_print_link_in_admin_order_data', 10, 1 );


// Thank You Notice Text
function wci_thank_you_notice_text( $thank_you_title, $order ){
	$thank_you_title = "<span class='thank_you_notice'>Thank you. Your Order has been received.</span>";
	return $thank_you_title; 
}
add_filter( 'woocommerce_thankyou_order_received_text', 'wci_thank_you_notice_text', 20, 2 );


// Show Order Details
function wci_order_details_on_order_received_page( $order ){
if(is_order_received_page()):
$order = wc_get_order( $order->id );
global $WCI_Config;
$logo           = $WCI_Config['logo'];
$QRCode         = $WCI_Config['qrcode'];
$SupportAddress = $WCI_Config['address'];
$SupportPhone1  = $WCI_Config['phone1'];
$SupportEmail   = $WCI_Config['email'];
$website        = $WCI_Config['website'];
?>
<!-- Print Button -->
<?php if( wp_get_current_user()->roles[0] != 'customer' && is_user_logged_in() ): ?>
    <div class="print">
        <button id="btnPrint"><i class="fa fa-print"></i></button>
    </div>
<?php endif; ?>
<!-- Print Button -->
<div id="printContent">
	<div class="wciWrap">
		<div class="wci_top">
			<h1>INVOICE</h1>
		</div>
		<div class="wciInner">
			<div class="wci_header">
	            <ul>
	                <li class="Date"><span>Date: <b><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></b></span></li>
	                <li class="Logo">
	                    <img src="<?php echo $logo; ?>" alt="Logo">
	                </li>
	                <li class="Number"><span>Order Number: <b><?php echo $order->get_order_number(); ?></b></span></li>
	            </ul>
			</div>
			<div class="wci_data">
				<ul class="wci_item_head">
					<li class="itemNo">SL</li>
					<li class="itemTitle">Title</li>
					<li class="itemPrice">Price</li>
					<li class="itemQty">Quantity</li>
					<li class="itemSubTotal">Sub Total</li>
				</ul>
				<ul class="wci_item_footer">
					<?php
						foreach( $order->get_items() as $item_id => $item ):
						$product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
						// $product_price = $product->get_sale_price() ? $product->get_sale_price() : $product->get_regular_price();
						$currency = "<span class='woocommerce-Price-currencySymbol'>".get_woocommerce_currency_symbol()."</span>";
						$product_price = $order->get_line_subtotal($item) / $item['qty'];
					?>					
					<li id="item-<?php echo $item_id; ?>">
						<span class="itemNo"><?php echo $count<=9 ? '0'.++$count : ++$count; ?></span>
						<span class="itemTitle"><?php echo $item['name']; ?></span>
						<span class="itemPrice"><?php echo $currency . " " . number_format($product_price, 2); ?></span>
						<span class="itemQty"><?php echo $item['qty']; ?></span>
						<span class="itemSubTotal"><?php echo $order->get_formatted_line_subtotal( $item ); ?></span>
					</li>
					<?php endforeach; ?>
				</ul>
				<ul class="wci_item_total">
					<?php foreach ( $order->get_order_item_totals() as $key => $total ): ?>
						<li>
							<span class="subtotalLabel"><?php echo $total['label']; ?></span>
							<span class="subtotalValue"><?php echo $total['value']; ?></span>
						</li>					
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="wci_footer">
				<div class="wci_f_left">
					<h3>Client Details</h3>
					<div class="client_details">
						<div class="left_details">
	                        <!-- <h5>Billing Details</h5> -->
	                        <?php
	                        	$billing_first_name = get_user_meta( $order->get_user_id(), 'billing_first_name', true );
	                        	$billing_last_name = get_user_meta( $order->get_user_id(), 'billing_last_name', true );
	                        ?>
	                        <?php if($billing_first_name): ?>
	                            <p class="clientName"><b>Name: </b><?php echo esc_html( $billing_first_name ) . " " . esc_html( $billing_last_name ); ?></p>
	                        <?php endif; ?>

	                        <?php if($billing_address = get_user_meta( $order->get_user_id(), 'billing_address_1', true )): ?>
	                            <p class="clientAddress"><b>Address: </b><?php echo esc_html( $billing_address ); ?></p>
	                        <?php endif; ?>

	                        <?php if ( $billing_state = get_user_meta( $order->get_user_id(), 'billing_state', true ) ) : ?>
                                <p class="clientState"><b>District: </b><?php echo WC()->countries->states[$order->billing_country][$billing_state]; ?></p>
                            <?php endif; ?>

	                        <?php if($billing_email = get_user_meta( $order->get_user_id(), 'billing_email', true )): ?>
	                            <p class="clientEmail"><b>Email: </b><?php echo esc_html( $billing_email ); ?></p>
	                        <?php endif; ?>

	                        <?php if($billing_phone = get_user_meta( $order->get_user_id(), 'billing_phone', true )): ?>
	                            <p class="clientPhone"><b>Phone No: </b><?php echo esc_html( $billing_phone ); ?></p>
	                        <?php endif; ?>
	                    </div>
						<!-- <div class="right_details"><h5>Shipping Details</h5></div> -->
					</div>
				</div>
				<div class="wci_f_right">
					<img class="QRCode" src="<?php echo $QRCode; ?>" alt="QRCode">
					<p class="address"><?php echo $SupportAddress; ?></p>
					<p class="phone">
						<span>Helpline:</span>
						<span>
							<a href="tel:<?php echo $SupportPhone1; ?>"><?php echo $SupportPhone1; ?></a>
						</span>
					</p>                    
					<a class="mail" href="mailto:<?php echo $SupportEmail; ?>"><?php echo $SupportEmail; ?></a>
					<a class="web" href="https://<?php echo $website; ?>">www.<?php echo $website; ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
endif;
}
add_action('woocommerce_order_details_after_order_table', 'wci_order_details_on_order_received_page', 99);


// Invoice Style
function woo_custom_invoice_styles(){
	$screen_id = get_current_screen()->id;

	if(is_order_received_page()){
		wp_enqueue_style( 'woo-custom-invoice', plugins_url( 'assets/css/woo-custom-invoice.css', __FILE__ ) );
	}
}
add_action( 'wp_head', 'woo_custom_invoice_styles' );


// Invoice Scripts
function woo_custom_invoice_scripts(){
	$screen_id = get_current_screen()->id;
	if(is_order_received_page()){
		wp_enqueue_script( 'invoice-print', plugins_url( 'assets/js/woo-custom-invoice-print.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	}
}
add_action( 'wp_footer', 'woo_custom_invoice_scripts' );

?>