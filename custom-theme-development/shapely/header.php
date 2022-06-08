<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shapely
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'shapely' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
<div class="header_top">
<div class="container info_bar">
<div class="row">
<nav>
<ul>
<li class="signup"><a href="#">Sign Up</a></li>
<li class="login"><a href="#">Login</a></li>
<li class="help"><a href="#">Help Center</a></li>
<li class="language"><a href="#">English</a></li>
</ul>
</nav>
</div>
</div>
</div>


        <div class="nav-container">            
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <div class="container nav-bar">
                    <div class="row">
                        <div id="navWrap" style="clear: both;">
                            <div class="module left">
                                <?php shapely_get_header_logo(); ?>
                            </div>
                            <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                                <i class="fa fa-bars"></i>
                            </div>
                            <div class="module-group right">
                                <div class="module left">
                                    <?php shapely_header_menu(); // main navigation ?>
                                </div>
                                <!--end of menu module-->
                                <div class="module widget-handle search-widget-handle left">
                                    <div class="search">
                                        <i class="fa fa-search"></i>
                                        <span class="title"><?php _e("Site Search", 'shapely'); ?></span>
                                    </div>
                                    <!-- <div class="function">
                                        <?php get_search_form(); ?>
                                        <?php get_template_part('searchform'); ?>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!--end of module group-->
                                
                        <div class="function">
                            <div class="advanced_search">
                                  <?php 
                                      $search = new WP_Advanced_search( 'newpage' );
                                  ?>

                                  <?php $search->the_form(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </nav><!-- #site-navigation -->

        </div>
	</header><!-- #masthead -->
    
	<div id="content" class="main-container">
        <?php ( is_page_template('template-home.php') ) ? '' : shapely_top_callout(); ?>
        <section class="content-area <?php echo ( get_theme_mod('top_callout', true ) ) ? '' : ' pt0 ' ?>">
          <div id="main" class="<?php echo ( !is_page_template( 'template-home.php' )) ? 'container': ''; ?>" role="main">
                <div class="row">