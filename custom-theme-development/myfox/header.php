<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <body>
 *
 * @link https://wp-admin.xyz/rahul
 *
 * @package RahuL
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
		<!-- title -->
		<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
		<!-- title -->

		<!-- meta -->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<!-- meta -->        

		<!-- link -->
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon_Rahul.ico" /><!-- favicon -->

	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css">
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrapTheme.css">
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.theme.css">

	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/uikit.min.css">
		
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">		
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/normalize.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slicknav.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font/font.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/menu.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css">
		<!-- root stylesheet-->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
		<!-- root stylesheet-->
		<!-- link -->
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2.min.js"></script>

		<?php wp_head(); ?>
		<?php global $redux_demo; ?>

		<style type="text/css">

			<?php echo $redux_demo['custom_css']; ?>

			a{color:<?php echo $redux_demo['link_color']['regular'];?>;}
			a:hover{color:<?php echo $redux_demo['link_color']['hover'];?>;}
			a:active{color:<?php echo $redux_demo['link_color']['active'];?>;}

			.solid_background .learn_btn a:{color:<?php echo $redux_demo['lmb_text_color'];?>;}
			.solid_background .learn_btn a:{background-color:<?php echo $redux_demo['lmb_background_color'];?>;}
			.solid_background .learn_btn a:hover{color:<?php echo $redux_demo['lmbh_text_color'];?>;}
			.solid_background .learn_btn a:hover{background-color:<?php echo $redux_demo['lmbh_background_color'];?>;}


		</style>

    </head>
    <body>

        <!-- Add your site or application content here -->
        	
		<!----End header_area -->

		<div class="" style="margin-top:0.1px;"></div>
		<div class="mainmenu_area" id="sticker">	
			<div class="logo">				
				<a style="background: url(<?php echo $redux_demo['logo_upload']['url']; ?>) center center;" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('title'); ?>"></a>
			</div>	
			<div class="logostick">			
				<a style="background: url(<?php echo $redux_demo['logo_upload2']['url']; ?>) center center;" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('title'); ?>"></a>
			</div>		
			<div class="mainmenu">
				<div class="mainmenu_box">	
					<!-- Dynamic Main menu -->
					<?php
					    if (function_exists('wp_nav_menu')) {
					     wp_nav_menu(array('theme_location' => 'wpj-main-menu', 'menu_id' => 'nav', 'fallback_cb' => 'wpj_default_menu'));
					  }
					  else {
					      wpj_default_menu();
					  }
					?>
				</div>
				<div class="search_box">
					<ul>
						<li>							
							<a><i class="fa fa-search"></i></a>
							<div class="show_search_box">
								<div class="container">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">			
											<?php get_template_part('searchform'); ?>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		