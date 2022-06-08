<?php /* Template Name: Contact Template */ ?>

<?php get_header(); ?>

	<main>
		<section class="contact-page" id="contact">
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
							<?php echo do_shortcode( '[contact-form-7 id="186" title="Himu Contact Form"]' ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>