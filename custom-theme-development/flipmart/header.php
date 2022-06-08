<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
  <head>
    <!-- Meta -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    
    <!-- Fonts --> 
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

  <?php wp_head(); global $woocommerce; global $wp_filter; ?>
  </head>
  <body <?php body_class('cnt-home'); ?> >
    <!--  HEADER  -->
    <header class="header-style-1">
      <div class="top-bar animate-dropdown">
        <div class="container">
          <div class="header-top-inner">
            <div class="cnt-account">
              <?php                
                  wp_nav_menu(array(
                    'theme_location' => 'top-menu',
                    'fallback_cb' => 'default_menu',
                    'items_wrap' => '<ul id = "%1$s" class = "list-unstyled %2$s">%3$s</ul>',
                  ));
               ?>
            </div>

          <!--<div class="cnt-block">
              <ul class="list-unstyled list-inline">
                <li class="dropdown dropdown-small">
                  <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">USD</a></li>
                    <li><a href="#">INR</a></li>
                    <li><a href="#">GBP</a></li>
                  </ul>
                </li>
                <li class="dropdown dropdown-small">
                  <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">English</a></li>
                    <li><a href="#">French</a></li>
                    <li><a href="#">German</a></li>
                  </ul>
                </li>
              </ul>
            </div> -->

            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="main-header">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
              <div class="logo">
              <?php if(has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
              <?php else : ?>
                <a href="<?php home_url(); ?>"><img src="<?php echo get_theme_file_uri('/assets/images/logo.png'); ?>" alt=""></a>
              <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
              <div class="search-area">
                <form>
                  <div class="control-group">
                    <ul class="categories-filter animate-dropdown">
                      <li class="dropdown">
                        <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" >
                          <li class="menu-header">Computer</li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                        </ul>
                      </li>
                    </ul>
                    <input class="search-field" placeholder="Search here..." />
                    <a class="search-button" href="#" ></a>    
                  </div>
                </form>
              </div>
              <!-- SEARCH AREA : END -->				
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
              <!-- SHOPPING CART DROPDOWN -->
              <div class="dropdown dropdown-cart">
                <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                  <div class="items-cart-inner">
                    <div class="basket">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                    </div>
                    <div class="basket-item-count">
                      <span class="count">
                        <div class="cart-contents">
                          <?php echo WC()->cart->get_cart_contents_count(); ?>                      
                        </div>
                      </span>
                    </div>
                    <div class="total-price-basket">
                      <span class="lbl">Total -</span>
                      <span class="total-price"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
                    </div>
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <div class="header-quickcart">
                    <?php woocommerce_mini_cart(); ?>  
                  </div>
                </ul>
              </div>
              <!-- SHOPPING CART DROPDOWN : END -->				
            </div>
          </div>
        </div>
      </div>
      <!--  NAVBAR -->
      <div class="header-nav animate-dropdown">
        <div class="container">
          <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
              <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
            </div>
            <div class="nav-bg-class">
              <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                  <?php                    
                      wp_nav_menu(array(
                        'theme_location'  => 'main-menu',
                        'items_wrap'      => '<ul id = "%1$s" class ="%2$s">%3$s</ul>',
                        'fallback_cb'     => 'default_menu',
                        'container_class' => 'nav-outer',
                        'menu_class'      => 'nav navbar-nav',
                      ));
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!--  HEADER : END  -->