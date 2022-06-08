<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shapely
 */

get_header(); ?>

<div class="single_domain_top">
	<div class="inner_wrap">

			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					$id = get_the_ID();
					$pricebox = get_post_meta($id, 'priceBox', true);	
					$domainselect = get_post_meta($id, 'domainSelect', true);	
					$emailbox = get_post_meta($id, 'emailBox', true);	
					$phonebox = get_post_meta($id, 'phoneBox', true);	

					if ($pricebox){ $set_pricebox = $pricebox;}
					else{ $set_pricebox = "price";}		

					if ($domainselect){ $set_domain = $domainselect;}
					else{ $set_domain = ".domain";}		

					if ($emailbox){ $set_email = $emailbox;}
					else{ $set_email = "setEmail@email.com";}		

					if ($phonebox){ $set_phone = $phonebox;}
					else{ $set_phone = "Mobile Number";}	
				?>

		<div class="domain_title" style="position:relative;">
			<h3><?php the_title();?><span><?php echo $set_domain; ?></span></h3>
			<span class="angle"></span>
		</div>
		<div class="inner_content">
			<ul>
				<span style="margin-bottom:25px;display:block;"><li>BUY NOW PRICE</li>
				<li style="font-size:18px;"><b>$ <?php echo $set_pricebox; ?></b></li>
				<li><a href="#"><button>BUY NOW</button></a></li>
				</span>

				<span style="margin-bottom:25px;display:block;"><li>YOU CAN ALSO SUBMIT YOUR OFFER TO:</li>
				<li><a href="#" style="color:#0373A0;font-weight:normal;text-transform:uppercase;"><?php echo $set_email; ?></a></li>
				</span>
				<li style="margin-bottom:10px;">You can also get in touch with us through:</li>
				<li style="text-align:left;padding-left:53px;margin-bottom:10px;"><a href="#" style="color:#666;font-weight: normal;"><i class="fa fa-phone" style="font-size:19px;padding-left:9px;padding-right:9px;"></i><?php echo $set_phone; ?></a></li>
				<li style="text-align:left;padding-left:53px;margin-bottom:10px;"><a href="#" style="color:#0373A0;font-weight: normal;"><i class="fa fa-envelope"></i><?php echo $set_email; ?></a></li>
			</ul>
		</div>

			<?php endwhile; ?>

			<?php endif; ?>		
	</div>
</div>
    <?php $layout_class = ( function_exists('shapely_get_layout_class') ) ? shapely_get_layout_class(): ''; ?>  
	<div id="primary" class="col-md-9 mb-xs-24 <?php echo $layout_class; ?>">

		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					$id = get_the_ID();
					$length = get_post_meta($id, 'length', true);
					$keyWord = get_post_meta($id, 'keyWord', true);
					$multiDomain = get_post_meta($id, 'multiDomain', true);						 

					if ($length){ $set_length = $length;}
					else{ $set_length = "Length";}	

					if ($keyWord){ $set_keyWord = $keyWord;}
					else{ $set_keyWord = "No-keyWord";}	
				?>

				<div class="domainDetails">
<table id="domain_details">
					<tr>
						<td colspan="2"><h4 style="margin:0;color:#D60909;font-size:20px;">Domain Details</h4></td>
						<td></td>
					</tr>
					<tr>
						<td>LANGUAGE : </td>
						<td>English</td>
					</tr>
					<tr>
						<td>LENGTH : </td>
						<td><?php echo $set_length; ?> (without TLD)</td>
					</tr>
					<tr>
						<td>KEYWORDS : </td>
						<td><?php echo $set_keyWord; ?></td>
					</tr>
					<tr>
						<td>REGISTERED TLDS : </td>
						<td><?php foreach ( $multiDomain as $new_domain ) { echo $new_domain.', '; } ?></td>
					</tr>
				</table>
</div>

			<?php endwhile; ?>
			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>			

		</main><!-- #main -->
	</div><!-- #primary -->

<aside id="domain_aside" class="widget-area col-md-3 hidden-sm" role="complementary">
	<?php dynamic_sidebar( 'domain_page_sidebar' ); ?>
</aside>

<?php get_footer(); ?>
