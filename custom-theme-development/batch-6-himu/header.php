<?php global $url; $url = get_template_directory_uri(); ?>

<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>

	<?php wp_head(); ?>
	
</head>
	<body data-spy="scroll" <?php body_class(); ?>>
		<header data-spy="affix" data-offset-top="90">
			<div class="container">
				<div class="row pad-sm">
					<div class="col-sm-12 menu-area al-right">
						<nav class="navbar navbar-default my-nav">
							<div class="container-fluid topbar al-center">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobilemenu" aria-expanded="false">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
<li class="my-logo">
<?php 

if(has_custom_logo()){

	the_custom_logo();

}else{
	echo '<a class="no-logo" href="'.admin_url( '/customize.php' ).'">Set Logo</a>';
}

?>
</li>
								<div class="collapse navbar-collapse" id="mobilemenu">
<ul class="ul-left">
<li>
<?php 

if(has_custom_logo()){

	the_custom_logo();

}else{
	echo '<a class="no-logo" href="'.admin_url( '/customize.php' ).'">Set Logo</a>';
}

?>
</li>
</ul>


<!-- <ul class="nav navbar-nav mmmm">
	<li><a href="#home">home</a></li>
	<li><a href="#about-us">about us</a></li>
	<li><a href="#services">service</a></li>
	<li><a href="#team">our team</a></li>
	<li><a href="#portfolio">portfolio</a></li>
	<li><a href="#clients">clients</a></li>
	<li><a href="#blog">blog</a></li>
	<li><a href="#contact">contact</a></li>
</ul> -->

<?php 
	wp_nav_menu( array(
		'theme_location'	=>	'header_menu', //
		'container'	        =>	'div',
		'container_class'	=>	'header_menu',
		'container_id'	    =>	'container-id',
		'menu_id'	        =>	'menu',
		'menu_class'	    =>	'nav navbar-nav mmmm',
		'fallback_cb'	    =>	'defualt_menu_text',
	));
?>
								</div>

								<?php get_search_form(); ?>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</header><!-- header end -->