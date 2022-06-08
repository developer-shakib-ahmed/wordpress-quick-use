		<?php global $redux_demo; ?>

		<div class="footer_btm_area">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

						<p><img src="<?php echo get_template_directory_uri(); ?>/img/Landing_page/heart.png" alt=""> Copyright &copy; <a href="<?php echo $redux_demo['company_url']; ?>"><?php echo $redux_demo['company_name']; ?></a> <?php echo $redux_demo['years']; ?> | Design by <a href="<?php echo $redux_demo['designer_url']; ?>"><?php echo $redux_demo['designer_name']; ?></a></p>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<ul>
							<?php if($redux_demo['social_icons']['1']) :?>
								<li><a href="<?php echo $redux_demo['social_icons']['1']; ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<?php endif;?>							
							
							<?php if($redux_demo['social_icons']['2']) :?>
								<li><a href="<?php echo $redux_demo['social_icons']['2']; ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<?php endif;?>							
							
							<?php if($redux_demo['social_icons']['3']) :?>
								<li><a href="<?php echo $redux_demo['social_icons']['3']; ?>" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
							<?php endif;?>							
							
							<?php if($redux_demo['social_icons']['4']) :?>
								<li><a href="<?php echo $redux_demo['social_icons']['4']; ?>" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
							<?php endif;?>							
							
							<?php if($redux_demo['social_icons']['5']) :?>
								<li><a href="<?php echo $redux_demo['social_icons']['5']; ?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
							<?php endif;?>							
							
							<?php if($redux_demo['social_icons']['6']) :?>
								<li><a href="<?php echo $redux_demo['social_icons']['6']; ?>" class="dribbble"><i class="fa fa-dribbble"></i></a></li>
							<?php endif;?>
							
							<?php if($redux_demo['social_icons']['7']) :?>
								<li><a href="<?php echo $redux_demo['social_icons']['7']; ?>" class="rss"><i class="fa fa-rss"></i></a></li>
							<?php endif;?>

						</ul>
					</div>
				</div>
			</div>
		</div>
		<!----End footer_btm_area -->

        <script src="<?php echo get_template_directory_uri(); ?>/js/function.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>




        <!---- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>

		<!-- facebook like page javascript functions -->
		<script>
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
			  fjs.parentNode.insertBefore(js, fjs);
			}
			(document, 'script', 'facebook-jssdk'));
		</script>      

        <?php wp_footer(); ?>

    </body>
</html>