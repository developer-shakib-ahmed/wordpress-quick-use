<?php /* Template Name: Homepage */ ?>

<?php global $url; ?>


<?php global $redux_demo; ?>

<?php get_header(); ?>

		<main>
			
			<div class="header" style="background-image: url(<?php header_image(); ?>); color:#<?php header_textcolor(); ?>; ">
				<div class="container">
					<div class="row">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem qui molestias consequatur inventore. Perspiciatis odio vitae necessitatibus cum sunt, illo voluptas, placeat odit similique repellendus ipsam cumque autem dolorum quia?</p>
					</div>
				</div>
			</div>

			<div class="body-bg">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							Logo
						</div>
						<div class="col-sm-8">

						</div>
					</div>
				</div>
			</div>

			<section id="home" class="slider"><!--slider section start -->
				<div class="container-fluid">
					<div class="row">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
<?php

	$Slides = $redux_demo['slider'];
	$count = 0;
	$indicator = -1;

?>

<!-- Indicators -->
<ol class="carousel-indicators">
	<?php foreach( $Slides as $Slide ) : $indicator++; ?>
		<li class="<?php if($indicator==0) { echo 'active'; } ?>" data-target="#carousel-example-generic" data-slide-to="<?php echo $indicator; ?>"></li>
	<?php endforeach; ?>
</ol>

							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">


<?php foreach( $Slides as $Slide ) : $count++; ?>

	<div id="slide-<?php echo $count; ?>" class="item <?php if($count==1) { echo 'active'; } ?>">
		<img src="<?php echo $Slide['image']; ?>" alt="...">
		<div class="carousel-caption">
		 <div class="row">
		 	<div class="col-sm-12 mm-auto">
				<h2 class="animated zoomInDown"><?php echo $Slide['title']; ?></h2>
				<h4 class="animated zoomInUp"><?php echo $Slide['description']; ?></h4>
				<a href="<?php echo $Slide['url']; ?>">get started</a>
			</div>
		 </div>
		</div>
	</div>

<?php endforeach; ?>


							</div>

<!-- Controls -->
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
</a>
						</div>
					</div>
				</div>
			</section><!-- slider end -->
			
			<section id="about-us">
				<div class="container pad-btm-md">
					<div class="row pad-md">
						<div class="col-sm-8 mm-auto al-center">
							<h3 class="black">why with us</h3>
							<p class="sm-black head">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<h4 class="black">why with us?</h4>
							<div class="tabss">
							<!-- Nav tabs -->
							  <ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#about" aria-controls="home" role="tab" data-toggle="tab">About</a></li>
								<li role="presentation"><a href="#mission" aria-controls="profile" role="tab" data-toggle="tab">Mission</a></li>
								<li role="presentation"><a href="#community" aria-controls="messages" role="tab" data-toggle="tab">Community</a></li>
							  </ul>
							</div>

						  <!-- Tab panes -->
							<div class="tab-content my-content">
								<div role="tabpanel" class="tab-pane active" id="about">
									<img src="<?php echo $url.'/' ?>img/about.jpg" alt="" class="img-responsive" />
									<p class="sm-black">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt utlaoreet dolore magna aliquam erat volutpat. Ut wisi enim ad, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad.
									</p>
								</div>
								<div role="tabpanel" class="tab-pane" id="mission">
									<img src="<?php echo $url.'/' ?>img/mission.jpg" alt="" class="img-responsive" />
									<p class="sm-black">
										Cum nobis facere, corporis voluptatibus quis accusantium distinctio ullam eum illo molestiae cupiditate possimus rerum quod reprehenderit non vero, repudiandae laudantium fuga explicabo ut hic animi. Accusamus nostrum ratione eum reprehenderit rem laboriosam? Velit optio alias qui aliquam debitis. Nulla ipsum odio iusto facilis placeat illo temporibus eius cum sed.
									</p>
								</div>
								<div role="tabpanel" class="tab-pane" id="community">
									<img src="<?php echo $url.'/' ?>img/community.jpg" alt="" class="img-responsive" />
									<p class="sm-black">
										Accusamus nostrum ratione eum reprehenderit rem laboriosam? Velit optio alias qui aliquam debitis. Nulla ipsum odio iusto facilis placeat illo temporibus eius cum sed, cupiditate repellat ex iure, veniam cumque ipsa modi ducimus blanditiis repudiandae debitis, mollitia culpa.
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="skillbars">
								<h4 class="black">our skill</h4>
								
								<div class="skillbar">
									<span class="title">html &amp; css</span>
									<span class="progress"></span>
									<span class="percent">90%</span>
								</div>
								<div class="skillbar">
									<span class="title">html &amp; css</span>
									<span class="progress"></span>
									<span class="percent">85%</span>
								</div>
								<div class="skillbar">
									<span class="title">html &amp; css</span>
									<span class="progress"></span>
									<span class="percent">70%</span>
								</div>
								<div class="skillbar">
									<span class="title">html &amp; css</span>
									<span class="progress"></span>
									<span class="percent">60%</span>
								</div>
								<div class="skillbar">
									<span class="title">html &amp; css</span>
									<span class="progress"></span>
									<span class="percent">75%</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section id="services">
				<div class="container">
					<div class="row" style="padding-top:70px;">
						<div class="col-sm-8 mm-auto al-center">
							<h3 class="white">services</h3>
							<p class="sm-white">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
							</p>
						</div>	
					</div>
					<div class="row" style="padding-bottom:100px;">
						<div class="col-sm-4">
							<div class="para para1">
								<i class="fa fa-th"></i>
								<h5 class="white">Modern Design</h5>
								<p class="sm-white">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
								</p>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="para para2">
								<i class="fa fa-html5"></i>
								<h5 class="white">Web Developement</h5>
								<p class="sm-white">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
								</p>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="para para3">
								<i class="fa fa-users"></i>
								<h5 class="white">Online Marketting</h5>
								<p class="sm-white">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section id="team">
				<div class="container">
					<div class="row" style="padding-top:70px;">
						<div class="col-sm-8 mm-auto al-center">
							<h3 class="black">meet the team</h3>
							<p class="sm-black">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 owl_carousel_one">
							<div id="carousel-1" class="owl-carousel owl-theme">
<?php 
	$Team = new WP_Query(array(
		'post_type' 	 => 'team',
		'posts_per_page' => 12,
	));
?>

<?php if( $Team->have_posts() ) : ?>
	<?php while($Team->have_posts()) : $Team->the_post(); ?>
	<?php 
		$id = get_the_ID();
		$team_profession = get_post_meta( $id, 'team_profession', true );
		$team_fb = get_post_meta( $id, 'team_fb', true );
	?>

		<div class="item">
			<div class="team-para al-center">
				<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
				<h6 class="team"><?php the_title(); ?> <span><?php echo $team_profession; ?></span></h6>
				<p class="sm-white">
					<?php echo wp_trim_words( get_the_content(), 10, '' ); ?>
				</p>
				<a href="<?php echo $team_fb; ?>"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-google-plus"></i></a>
				<a href="#"><i class="fa fa-dribbble"></i></a>
				<a href="#"><i class="fa fa-linkedin"></i></a>
			</div>
		</div>
	<?php endwhile;  ?>
<?php else : ?>
	<h2>No Team Found!</h2>
<?php endif; ?>

							</div>
						</div>
					</div>
				</div>
			</section>
			<section id="portfolio">
				<div class="container">
					<div class="row paddd">
						<div class="col-sm-8 mm-auto al-center">
							<h3 class="black">portfolio</h3>
							<p class="sm-black">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 al-center">
							<div class="controls">
								<button type="button" class="control" data-filter="all">All</button>							
								<?php 
									$all_portfoli_cats = get_terms(array(
										'taxonomy' => 'portfolio_cat',
										'fields' => 'all'
									));

									foreach ($all_portfoli_cats as $all_portfoli_cat) {
										echo '<button type="button" class="control" data-filter=".'.$all_portfoli_cat->slug.'">'.$all_portfoli_cat->name.'</button>';
									}
								?>
							</div>
						</div>
					</div>
					<div class="row" style="padding-bottom:70px;">
						<div class="content">

<?php 

	$Portfolio = new WP_Query(array(
		'post_type' => 'portfolio',
		'posts_per_page' => 12,
	));

?>

<?php if( $Portfolio->have_posts() ) : ?>
	<?php while( $Portfolio->have_posts() ) : $Portfolio->the_post();
		$portfolioCats = wp_get_post_terms( get_the_ID(), 'portfolio_cat', array( 'fields' => 'all' ) );
	?>
		<div class="mix <?php foreach ($portfolioCats as $portfolioCat) { echo $portfolioCat->slug.' '; } ?> col-md-3 col-sm-4 no-pad">
			<?php the_post_thumbnail( 'medium', array( 'class' => 'img-responsive' ) ); ?>
			<div class="overlay al-center">
				<p class="overlay-p"><?php the_title(); ?></p>
				<a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
				<i class="fa fa-search-plus"></i>
			</div>
		</div>
	<?php endwhile; ?>
<?php else : ?>
	<h2>No Portfolio Found!</h2>
<?php endif; ?>


							
						</div>
					</div>
				</div>
			</section>
			<section id="clients">
				<div class="container">
					<div class="row" style="padding-top:70px;">
						<div class="col-sm-8 mm-auto al-center">
							<h3 class="white">clients say about us</h3>
							<p class="sm-white head">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-8 mm-auto">
							<div id="clients-carousel" class="carousel slide" data-ride="carousel"> <!-- Indicators -->
								<ol class="carousel-indicators">
									<li data-target="#clients-carousel" data-slide-to="0" class="active"></li>
									<li data-target="#clients-carousel" data-slide-to="1"></li>
									<li data-target="#clients-carousel" data-slide-to="2"></li>
								</ol> <!-- Wrapper for slides -->
								<div class="carousel-inner">
									<div class="item active">
										<div class="single-client">
											<div class="media">
												<img class="client" src="<?php echo $url.'/' ?>img/member1.jpg" alt="">
												<div class="media-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><small>Someone famous in Source Title</small><a href="">www.yourwebsite.com</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="single-client">
											<div class="media">
												<img class="client" src="<?php echo $url.'/' ?>img/member2.jpg" alt="">
												<div class="media-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><small>Someone famous in Source Title</small><a href="">www.yourwebsite.com</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="single-client">
											<div class="media">
												<img class="client" src="<?php echo $url.'/' ?>img/member3.jpg" alt="">
												<div class="media-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><small>Someone famous in Source Title</small><a href="">www.yourwebsite.com</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section id="blog">
				<div class="container">
					<div class="row pad-md">
						<div class="col-sm-8 mm-auto al-center">
							<h3 class="black">our blog</h3>
							<p class="sm-black">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.
							</p>
						</div>
					</div>
					<div class="row" style="padding:20px 0px 70px;">
						<?php 
							$latestBlog = new WP_Query( array(
								'post_type'	=>	'post',
								'posts_per_page' => 3,
								'category_name' => 'Latest',
							) );
						?>
						<?php if( $latestBlog->have_posts() ) : ?>
							<?php while( $latestBlog->have_posts() ) : $latestBlog->the_post(); ?>
								<div class="col-sm-4">
									<div class="inner">
										<?php the_post_thumbnail( array( 300, 160 ), array( 'class' => 'img-responsive' ) ); ?>
										<h4 class="blog"><?php the_title(); ?></h4>
										<i class="fa fa-pencil-square-o"></i><span>posted by <?php the_author(); ?> |</span> 
										<i class="fa fa-clock-o"></i><span>posted on <?php echo get_the_date(); ?></span>
										<p class="sm-black">
											<?php echo wp_trim_words( get_the_content(), 9, '...' ); ?>
										</p>
										<a class="blog" href="<?php the_permalink(); ?>">read more</a>
									</div>
								</div>
							<?php endwhile; ?>
						<?php else: ?>
							<h1>Posts not found.</h1>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<section id="contact">
				<div class="container">
					<div class="row pad-md">
						<div class="col-sm-8 mm-auto al-center">
							<h3 class="black">contact with us</h3>
							<p class="sm-black">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							</p>
						</div>
					</div>
					<div class="row pad-btm-md">
						<div class="col-sm-6">
							<div class="inner-left">
								<h4 class="blog dev">Cluster</h4>
								<p class="address">
									Village: Mohishakhola
									<span>Post Office: Dhankhola</span>
									<span>Gangni, Meherpur</span>
									<span>(Lorem ipsum dolor sit amet)</span>
								</p>
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-google-plus"></i></a>
								<a href=""><i class="fa fa-dribbble"></i></a>
								<a href=""><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="inner-right">
								<form>
								  <div class="form-group form-left">
									<input type="text" class="my-form"id="name" placeholder="Your Name">
								  </div>
								  <div class="form-group form-right">
									<input type="email" class="my-form" id="Your Email" placeholder="Password">
								  </div>
								  <textarea placeholder="Message" class="form-control" rows="5"></textarea>
								  <button type="submit" value="submit" class="send">send</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main><!-- end /main -->

<?php get_footer(); ?>