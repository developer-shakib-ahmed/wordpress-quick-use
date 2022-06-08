<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $BeRocket_LGV;

get_header( 'shop' );

// gridlist-view
$product_style = br_lgv_get_cookie ( 0 );
$grided = ($product_style == 'grid' ? 'selected' : '');
$listed = ($product_style == 'list' ? 'selected' : '');

?>

<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <?php woocommerce_breadcrumb(); ?>
    </div>
  </div>
</div><!-- End .breadcrumb -->

<?php 

// echo "<pre>";
// var_dump($wp_filter['wc_add_to_cart_message_html']);
// echo "</pre>";

 ?>


<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
	  	<!-- SIDEBAR -->
		<?php
			/**
			 * woocommerce_sidebar hook.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );
		?>
      	<!-- CONTENT -->
        <div class="col-xs-12 col-sm-12 col-md-9 page">
            <div id="products-page" class="page-content wow fadeInUp animated">
            	<div class="shop_header">
            		<div class="row">
            			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            				<div class="gird_view">
								<div class="berocket_lgv_widget">
								    View by <a title="Grid" href="#" data-type="grid" class="berocket_lgv_set berocket_lgv_button berocket_lgv_button_grid <?php echo $grided; ?>">
								    <i class="fa fa-th"></i>
								    </a>
								    <a title="List" href="#" data-type="list" class="berocket_lgv_set berocket_lgv_button berocket_lgv_button_list <?php echo $listed; ?>">
								    <i class="fa fa-bars"></i>
								    </a>
								</div>
            				</div>
            			</div>
            			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            				<div class="shop_by">Sort by<?php woocommerce_catalog_ordering(); ?></div>
            			</div>
            			<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            				<div class="select_show">Show<?php do_action('woocommerce_before_shop_loop'); ?></div>
            			</div>
            			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            				<div class="shop_paginate"><?php wp_pagenavi(); ?></div>
            			</div>
            		</div>
            	</div>
				<?php
					/**
					 * woocommerce_before_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 * @hooked WC_Structured_Data::generate_website_data() - 30
					 */
					do_action( 'woocommerce_before_main_content' );
				?>
			    <header class="woocommerce-products-header">

					<?php if ( apply_filters( 'woocommerce_show_page_title', false ) ) : ?>

						<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

					<?php endif; ?>

					<?php
						/**
						 * woocommerce_archive_description hook.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
					?>

			    </header>

					<?php if ( have_posts() ) : ?>

						<?php
							/**
							 * woocommerce_before_shop_loop hook.
							 *
							 * @hooked wc_print_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
						?>

						<?php woocommerce_product_loop_start(); ?>

							<?php woocommerce_product_subcategories(); ?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php
									/**
									 * woocommerce_shop_loop hook.
									 *
									 * @hooked WC_Structured_Data::generate_product_data() - 10
									 */
									do_action( 'woocommerce_shop_loop' );
								?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>

						<?php
							/**
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>

						<div class="shop_paginate"><?php wp_pagenavi(); ?></div>

					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<?php
							/**
							 * woocommerce_no_products_found hook.
							 *
							 * @hooked wc_no_products_found - 10
							 */
							do_action( 'woocommerce_no_products_found' );
						?>

					<?php endif; ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer( 'shop' ); ?>
