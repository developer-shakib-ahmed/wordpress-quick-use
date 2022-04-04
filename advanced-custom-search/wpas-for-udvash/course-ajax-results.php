<?php 
/*
 * template-course-ajax-results.php
 * This file should be created in the root of your theme directory
 */

?>

<?php
if ( have_posts() ) :             
  while ( have_posts() ) : the_post(); ?>

      <div class="course">
        <div class="img">
            <?php the_post_thumbnail( 'full' ); ?>
        </div>
        <div class="content">
            <div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

            <ul class="meta">
                <?php if($categories = get_the_terms( get_the_ID(), 'course_type' )): ?>
                  <?php
                    if($categories[0]->name == '৮'){
                      $categoryName = "Class 8";
                    }elseif ($categories[0]->name == '৯') {
                      $categoryName = "Class 9";
                    }elseif ($categories[0]->name == '১০') {
                      $categoryName = "Class 10";
                    }elseif ($categories[0]->name == '১১') {
                      $categoryName = "Class 11";
                    }elseif ($categories[0]->name == '১২') {
                      $categoryName = "Class 12";
                    }else{
                      $categoryName = $categories[0]->name;
                    }
                  ?>
                  <li><?php echo $categoryName; ?></li>
                <?php endif; ?>
                
                <?php if(rwmb_meta( '_mb_start_on' )): ?>
                  <li><?php echo rwmb_meta( '_mb_start_on' ); ?><?php echo rwmb_meta( '_mb_end_on' ) ? " - " . rwmb_meta( '_mb_end_on' ) : ""; ?></li>
                <?php endif; ?>
                
                <?php if(rwmb_meta( '_mb_duration' )): ?>
                  <li><?php echo rwmb_meta( '_mb_duration' ); ?></li>
                <?php endif; ?>
            </ul>

            <div class="buy-now">
				<?php if(rwmb_meta( '_mb_price' )): ?>
					<?php if(rwmb_meta( '_mb_sale_price' )): ?>
						<div class="price">Tk <?php echo rwmb_meta( '_mb_sale_price' ); ?><span>Tk <?php echo rwmb_meta( '_mb_price' ); ?></span></div>
					<?php else: ?>
						<div class="price">Tk <?php echo rwmb_meta( '_mb_price' ); ?></div>
					<?php endif; ?>
				<?php endif; ?>
				<?php if(rwmb_meta( '_mb_buy_link' )): ?>
					<div class="buttons font1">
						<a href="<?php echo rwmb_meta( '_mb_buy_link' ); ?>" class="btn btn-red">Enroll Now</a>
					</div>
				<?php endif; ?>
			</div>
        </div>
		  <a class='card-link' href="<?php the_permalink(); ?>"></a>
      </div>

   <?php 
   endwhile; 

else :
   echo '<p class="not-found">Sorry, no results found in your choice!</p>';
endif; 
wp_reset_query();
?>
