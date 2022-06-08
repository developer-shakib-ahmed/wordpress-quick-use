<?php 
/*
	Template Name: Welcome
*/
get_header(); ?>
		<div class="header_area" id="go_top"></div>

		<!----End mainmenu_area -->

		<?php echo do_shortcode('[features title="This is features title" des="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer odio urna, maximus bibendum pulvinar eu, molestie eu arcu. Vestibulum elementum."]'); ?>

		<!---- End key_feature_area -->

		<?php echo do_shortcode('[solid_background background_color="#7542F9" des="This is the awesome descriptions." link="http://www.google.com"]'); ?>

		<!----End solid_background -->	







		<div class="demo_area">	
			<h2>this is the title</h2>
			<span class="spans"></span>
			<p class="paragraph">the descriptions is Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
			    <?php
			    global $post;

			    $args = array( 'posts_per_page' => 12, 'post_type'=> 'stunning-items' );//, 'stunning_cat' => 'business one'
			    $myposts = get_posts( $args );
			    foreach( $myposts as $post ) : setup_postdata($post); ?>

			<?php $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'stunning-demo' );?>
			<?php $stunning_post_thumbnail_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'stunning-demo-large' ); ?>


				<div class="single_demo">
					<div class="single_img">
						<a rel="lightbox" title="<?php the_title(); ?>" href="<?php echo $stunning_post_thumbnail_large[0] ?>"><img src="<?php echo $post_thumbnail[0]?>" alt="stunning post thumbnail"></a>
						<a href=""><?php echo "Category Name"; ?></a>					
					</div>					
				</div>

			    <?php endforeach; ?>

			<div class="load_quick_btn">
				<a data-uk-scrollspy="{cls:'uk-animation-slide-left', repeat: false}" class="one"  href=""><span><i class="fa fa-refresh"></i></span>LOAD MORE</a>
				<a data-uk-scrollspy="{cls:'uk-animation-slide-right', repeat: false}" class="two" href=""><span><i class="fa fa-clock-o"></i></span>QUICK LIST</a>
			</div>
		</div>


<!-- 		<?php echo do_shortcode('[stunning title="this is the title" des="the descriptions is Lorem ipsum dolor sit amet, consectetur adipiscing elit."]'); ?> -->
		<!---- End demo_area -->

		<?php echo do_shortcode('[support link="http://www.google.com" iframe="https://www.youtube.com/embed/awCJndUEYCk" title="update and support" des="Duis quis lectus tellus. Ut id tincidunt tellus. Cras sapien neque, rutrum sed maximus vel, luctus eget leo. Duis ut dolor sapien. Cras eget tempor purus. Vivamus maximus massa vitae fermentum pretium. Vestibulum et cursus urna, id auctor magna. Ut rhoncus eget dolor eget interdum. Sed nec turpis enim. Ut vulputate gravida magna, non posuere dui vulputate ac. Praesent pulvinar elementum metus eget condimentum."]'); ?>
		<!----End support_area -->

		<?php echo do_shortcode('[funfact]'); ?>
		<!----End funfact_area -->

		<?php echo do_shortcode('[mobile_device img1="http://irahul.xyz/myfox/wp-content/uploads/2015/12/m_right.jpg" img2="http://irahul.xyz/myfox/wp-content/uploads/2015/12/m_left1.jpg" title="this is mobile device title" des="this is mobile device description"]'); ?>
		<!---- End mobile_area -->

		<?php echo do_shortcode('[parallax parallax_img="http://irahul.xyz/myfox/wp-content/uploads/2015/12/parallax1.jpg" demo_link="http://google.com/demo" buy_link="http://google.com/buy_now" title="this is title" des="this is descriptions"]'); ?>
		<!----End buy_area -->

		<div class="feature_area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h2>WE HAVE ALL WHAT YOU NEED</h2>
						<span class="spans"></span>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer odio urna, maximus bibendum pulvinar eu, molestie eu arcu. Vestibulum<br> elementum magna vel erat sagittis egestas. Vestibulum aliquam, ex eu vulputate porta, tellus enim sollicitudin ante
						</p>
						<img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/pc_packege.png" alt="">						
					</div>
				</div>	
			</div>
		</div>
		<!----End feature_area -->

		<?php echo do_shortcode('[parallax parallax_img="http://irahul.xyz/myfox/wp-content/uploads/2015/12/parallax2.jpg" demo_link="http://google.com/demo" buy_link="http://google.com/buy_now" title="this is title" des="this is descriptions"]'); ?>
		<!----End admin_area -->

		<?php echo do_shortcode('[crazy_stunning title="crazy stunning title" des="crazy stunning descriptions"]'); ?>		
		<!---- Finish c_feature_bottom_area -->

		<?php echo do_shortcode('[support link="http://www.google.com" iframe="https://www.youtube.com/embed/vVtEgdamUtY" title="one click install" des="Duis quis lectus tellus. Ut id tincidunt tellus. Cras sapien neque, rutrum sed maximus vel, luctus eget leo. Duis ut dolor sapien. Cras eget tempor purus. Vivamus maximus massa vitae fermentum pretium. Vestibulum et cursus urna, id auctor magna. Ut rhoncus eget dolor eget interdum. Sed nec turpis enim. Ut vulputate gravida magna, non posuere dui vulputate ac. Praesent pulvinar elementum metus eget condimentum."]'); ?>
		<!----End install_area -->

		<div class="main_feature_area">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<ul>
							<li id="li_first"><a href="">Fully Responsive</a></li>
							<li><a href="">Retina Ready</a></li>
							<li><a href="">Extremely Customizable</a></li>
							<li><a href="">WP 3.7+ Ready</a></li>
							<li><a href="">Demo Files Included (XML)</a></li>
							<li><a href="">10 Hero Styles</a></li>
							<li><a href="">5 Header-Title Styles</a></li>
							<li><a href="">2 Header Styles Dark & Light</a></li>
							<li><a href="">Fullscreen Slider</a></li>
							<li><a href="">Parallax Support</a></li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<ul>
							<li><a href="">Fullscreen YouTube Video</a></li>
							<li><a href="">Parallax Background Section</a></li>
							<li><a href="">Video Background Section (YouTube)</a></li>
							<li><a href="">Color Background Section</a></li>
							<li><a href="">Unlimited Colors</a></li>
							<li><a href="">Portfolio Management</a></li>
							<li><a href="">Tons of Shortcodes</a></li>
							<li><a href="">Shortcode Generator</a></li>
							<li><a href="">Font Awesome Icon Integration</a></li>
							<li><a href="">Smooth Scroll</a></li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<ul>
							<li><a href="">Multiple Sidebars</a></li>
							<li><a href="">Blog Sidebar Left, Right and Without</a></li>
							<li><a href="">Sidebar</a></li>
							<li><a href="">Child Theme Ready</a></li>
							<li><a href="">Child Theme Included</a></li>
							<li><a href="">WPML Ready</a></li>
							<li><a href="">Translation Ready</a></li>
							<li><a href="">Perfect Code</a></li>
							<li><a href="">Custom Widgets (Twitter, Video)</a></li>
							<li><a href="">Twitter Plugin</a></li>							
						</ul>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<ul>
							<li><a href="">Search Engine Optimized</a></li>
							<li><a href="">Retina Ready</a></li>
							<li><a href="">Extremely Customizable</a></li>
							<li><a href="">WP 3.7+ Ready</a></li>
							<li><a href="">Demo Files Included (XML)</a></li>
							<li><a href="">10 Hero Styles</a></li>
							<li><a href="">5 Header-Title Styles</a></li>
							<li><a href="">2 Header Styles Dark & Light</a></li>
							<li><a href="">Fullscreen Slider</a></li>
							<li><a href="">Parallax Support</a></li>
						</ul>
					</div>																				
				</div>
			</div>
		</div>
		<!----End main_feature_area -->

		<?php echo do_shortcode('[carousel title="The incredible shortcode title" des="this is incredible shortcode descriptions" img="http://irahul.xyz/myfox/wp-content/uploads/2015/12/wow1.jpg"]'); ?>
		<!----End shortcode_area -->

		<div class="c_feature_area">
			<h2>CRAZY NICE LAYOUT OPTIONS</h2>
			<span class="spans"></span>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer odio urna, maximus bibendum pulvinar eu, molestie eu arcu. Vestibulum<br> elementum magna vel erat sagittis egestas. Vestibulum aliquam, ex eu vulputate porta, tellus enim sollicitudin ante
			</p>				
		</div>
		<span class="bottom_arrow"><img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/c_arrow.png" alt=""></span>
		<!---- End c_feature_area -->
		<div class="layout_area">
			<div class="container">
				<div class="row">
					<div data-uk-scrollspy="{cls:'uk-animation-slide-right', repeat: false}" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="single_layout">
							<img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/layoutA1.png" alt="">
							<p>Left Sidebar / Content</p>
						</div>
						<div class="single_layout">
							<img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/layoutA2.png" alt="">
							<p>100% Width For Page Content</p>
						</div>
					</div>
					<div data-uk-scrollspy="{cls:'uk-animation-slide-right', repeat: false, delay:300}" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="single_layout">
							<img class="layoutb1" src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/layoutB1.png" alt="">
							<p>Right Sidebar / Content</p>
						</div>
						<div class="single_layout">
							<img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/layoutB2.png" alt="">
							<p>Logo / Navigation</p>
						</div>
					</div>
					<div data-uk-scrollspy="{cls:'uk-animation-slide-right', repeat: false, delay:600}" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="single_layout">
							<img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/layoutC1.png" alt="">
							<p>No Sidebar Full Content</p>
						</div>
						<div class="single_layout">
							<img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/layoutC2.png" alt="">
							<p>No Sidebar / Simple Content</p>
						</div>
					</div>
					<div data-uk-scrollspy="{cls:'uk-animation-slide-right', repeat: false, delay:900}" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="single_layout">
							<img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/layoutD1.png" alt="">
							<p>Boxed Layout</p>
						</div>
						<div class="single_layout">
							<img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/layoutD2.png" alt="">
							<p>Topbar / Logo / Navigation </p>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<!----End layout_area -->

		<?php echo do_shortcode('[ecommerce title="this is title" des="this is descriptions" toplogo="http://irahul.xyz/myfox/wp-content/uploads/2015/12/commerce.png" screenshot_img="http://irahul.xyz/myfox/wp-content/uploads/2015/12/file-2.jpeg"]'); ?>	
		<!----End commerce_area -->

		<?php echo do_shortcode('[solid_background background_color="#8989B4" des="This is the another awesome descriptions." link="http://www.facebook.com"]'); ?>

		<!----End solid_background -->	
		
		<?php echo do_shortcode('[testimonial]'); ?>
		<!----End testimonial_area -->	

		<div class="support_foram_area">
			<div data-uk-scrollspy="{cls:'uk-animation-scale-up', repeat: false, delay:300}" class="single_support color_one">
				<h3>FRIENDLY DOCUMENTATIONS</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut lobortis nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed lacinia, est eget scelerisque blandit, nulla eros mollis erat, vel ornare quam sem ut nisi. Mauris eu dolor mi. Praesent fermentum nulla id nisi interdum faucibus.
				</p>
				<a href="">CHECK IT NOW</a>
			</div>
			<div data-uk-scrollspy="{cls:'uk-animation-scale-up', repeat: false, delay:600}" class="single_support color_two">
				<h3>VIDEO TUTORIALS</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut lobortis nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed lacinia, est eget scelerisque blandit, nulla eros mollis erat, vel ornare quam sem ut nisi. Mauris eu dolor mi. Praesent fermentum nulla id nisi interdum faucibus.
				</p>
				<a href="">CHECK IT NOW</a>
			</div>
			<div data-uk-scrollspy="{cls:'uk-animation-scale-up', repeat: false, delay:300}" class="single_support color_three">
				<h3>24/7 SUPPORT SERVICE</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut lobortis nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed lacinia, est eget scelerisque blandit, nulla eros mollis erat, vel ornare quam sem ut nisi. Mauris eu dolor mi. Praesent fermentum nulla id nisi interdum faucibus.
				</p>
				<a href="">CHECK IT NOW</a>
			</div>
		</div>	
		<!----End support_foram_area -->	
		
		<?php echo do_shortcode('[introduce]'); ?>
		<!----End introducing_area -->

		<?php echo do_shortcode('[parallax parallax_img="http://irahul.xyz/myfox/wp-content/uploads/2015/12/parallax3.jpg" demo_link="http://google.com/demo" buy_link="http://google.com/buy_now" title="this is title" des="this is descriptions"]'); ?>	
		<!----End buyfox_area -->
<?php get_footer(); ?>		




