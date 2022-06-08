<?php
/*

  Template Name: Domain Search

*/

get_header(); ?>

  
<?php $layout_class = ( function_exists('shapely_get_layout_class') ) ? shapely_get_layout_class(): ''; ?>  
	<section id="primary" class="content-area col-md-9 mb-xs-24 <?php echo $layout_class; ?>">
		<main id="main" class="site-main" role="main">

		<div id="page_content">
              <?php 
                  $search = new WP_Advanced_search( 'newpage' );
              ?>

              <?php $query = $search->query(); ?>

		<h6 style="margin-left: 10px;" class="results-count">
           Displaying <?php echo $search->results_range(); ?> 
           of <?php echo "<b>".$query->found_posts."</b>"; ?> Search Results.
         </h6>

			<table>
				<tr id="table_head">
					<td>DOMAIN NAME</td>
					<td>CATEGORY</td>
					<td>BUY NOW</td>
					<td>LEASE NOW</td>
				</tr>
				<?php if ( $query->have_posts() ): 
               		 while ( $query->have_posts() ): $query->the_post();

                 		$id = get_the_ID();

						 $terms = get_the_terms( $id , 'domain_cat' );

						 if($terms != null){
						 	$domain_cat = $terms ;
						 }else{
						 	$domain_cat = "No Category";
						 }

						 foreach ( $domain_cat as $term ) { 
						 	$domain_cat = $term->name;
						 	$domain_cat_id = $term->term_id;
						 	$link = get_term_link($term);
						 }

						$prefix = '_cmb_';

						$pricebox = get_post_meta($id, 'priceBox', true);	
						$domainselect = get_post_meta($id, 'domainSelect', true);	

						if ($pricebox){ $set_pricebox = $pricebox;}
						else{ $set_pricebox = "price";}		

						if ($domainselect){ $set_domain = $domainselect;}
						else{ $set_domain = ".domain";}						 

						?>				
						
							<tr>
								<td><a id="domain" href="<?php the_permalink(); ?>"><?php the_title(); ?><span><?php echo $set_domain; ?></span></a></td>
								<td><a id="category" href="<?php echo $link; ?>" title="<?php echo $domain_cat; ?>"><?php echo $domain_cat; ?></a></td>
								<td><a id="buy" href="<?php the_permalink(); ?>">buy now</a></td>
								<td><a id="lease">$ <?php echo $set_pricebox; ?></a></td>
							</tr>

              <?php endwhile;?>

              <?php else:?>
                <tr>
                	<td colspan="4">
                		<h4 style="margin-top:24px;text-align:center;">Sorry!!! Your Content Could Not Found.</h4>
                	</td>
                </tr>
              <?php endif; ?>
			</table>
			<br>
			<?php wp_pagenavi( array( 'query' => $query ) ); ?>
			<br><br>		
		</div>

        </main><!-- #main -->
    </section><!-- #primary -->

<aside id="domain_aside" class="widget-area col-md-3 hidden-sm" role="complementary">
  <?php dynamic_sidebar( 'domain_page_sidebar' ); ?>
</aside>

<?php get_footer(); ?>
