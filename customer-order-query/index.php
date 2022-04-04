<?php
/*
	Template Name: Customer Orders
*/

get_header();

$has_sidebar = is_active_sidebar( 'sidebar-1' );
$has_sidebar = apply_filters( 'sshop_layout_has_sidebar', $has_sidebar );
?>
<style type="text/css">
div.customer_order_lists li{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;padding-top:15px;border-top:1px solid #ddd}
div.customer_order_lists ul{margin:0;padding:0;border-bottom:1px solid #ddd}
div.customer_order_lists li img{width:60px;height:auto;margin-right:10px}
div.customer_order_lists li span{flex:1}
div.customer_order_lists li span._col_qty{text-align:center}
div.customer_order_lists h4 {margin: 50px 0;display: inline-block;border-bottom: 2px solid #e8500e;padding-bottom: 5px;}
div.customer_order_lists li span._col_price{text-align:right}
div.customer_order_lists ul._colHead span{font-weight:bold;color: #e8500e;}
div.customer_order_lists ul._colHead{border-bottom:0 solid #ddd}
</style>

	<div id="primary" class="content-area content-page <?php echo  ( $has_sidebar ) ? 'has-sidebar' : 'no-sidebar'; ?>">
        <?php
        /**
         * @hooked sshop_main_content_title - 10
         */
        do_action( 'sshop_before_main_content' ) ;
        ?>
		<main id="main" class="site-main" role="main">
			
			<div class="customer_order_lists">

				<div class="_col"> <?php // _col = Customer Order Lists ?>
					<?php
						$getOrdersDate = get_posts( array(
						    'numberposts' => -1,
						    'meta_key'    => '_customer_user',
						    'meta_value'  => get_current_user_id(),
						    'post_type'   => wc_get_order_types( 'view-orders' ),
						    'post_status' => array_keys( wc_get_order_statuses() )
						));

						foreach ($getOrdersDate as $OrdersDate) {
							$orderDates[] = substr($OrdersDate->post_date, 0, 10);
							$orderDates   = array_unique($orderDates);
						}

						foreach ($orderDates as $orderDate) {

							$year  = substr( $orderDate, 0, 4 );
							$month = substr( $orderDate, 5, 2 );
							$day   = substr( $orderDate, 8, 2 );

							$getOrders = get_posts( array(
							    'numberposts' => -1,
							    'meta_key'    => '_customer_user',
							    'meta_value'  => get_current_user_id(),
							    'post_type'   => wc_get_order_types( 'view-orders' ),
							    'post_status' => array_keys( wc_get_order_statuses() ),
							    'date_query'  => array( array( 'year' => $year, 'month' => $month, 'day' => $day ) )
							));

							$_colHead = '';

							$_colHead .= '<h4>'.$orderDate.'</h4>';

							$_colHead .= '<ul class="_colHead">';
								$_colHead .= '<li>';
									$_colHead .= '<span class="_col_image_name">Items</span>';
									$_colHead .= '<span class="_col_qty">Quantity</span>';
									$_colHead .= '<span class="_col_price">Price</span>';
								$_colHead .= '</li>';
							$_colHead .= '</ul>';

							echo $_colHead;

							foreach ($getOrders as $getOrder) {

								$order = wc_get_order( $getOrder->ID );
								$order_items = $order->get_items();

								$you = ''; // $you = Your Order Output

								$you .= '<ul>';

								foreach ( $order_items as $item_id => $item ) {

									$get_product_data = $item->get_product();
									$productID = $get_product_data->get_id();
									$productPrice = get_woocommerce_currency_symbol().$get_product_data->price;

									$you .= '<li>';
										$you .= '<span class="_col_image_name">'.$get_product_data->get_image().$item->get_name().'</span>';
										$you .= '<span class="_col_qty">'.$item->get_quantity().'</span>';
										$you .= '<span class="_col_price">'.$productPrice.'</span>';
									$you .= '</li>';

									// echo '<pre>';
									// var_dump($get_product_data->get_id());
									// echo '</pre>';
								}
								$you .= '</ul>';
								echo $you;						
							}
						}				
					?>
				</div>
			</div>

		</main><!-- #main -->
        <?php
        if ( $has_sidebar ) {
            get_sidebar();
        }
        ?>
        <?php do_action( 'sshop_after_main_content' ); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>