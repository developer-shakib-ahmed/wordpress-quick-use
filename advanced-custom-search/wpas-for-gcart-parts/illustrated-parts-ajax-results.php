<?php 
/*
 * template-illustrated-parts-ajax-results.php
 * This file should be created in the root of your theme directory
 */

?>

<?php
if ( have_posts() ) :             
  while ( have_posts() ) : the_post();
    $phone1 = rwmb_meta( '_mb_phone1' );
    $phone2 = rwmb_meta( '_mb_phone2' );
  ?>
      <div class="branch">
        <div class="top">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <a href="<?php the_permalink(); ?>" class="more"><i class="fas fa-long-arrow-alt-right"></i></a>
        </div>
        <div class="bottom">
          <?php if($phone1): ?>
            <a href="tel:<?php echo $phone1; ?>"><i class="fas fa-phone-alt"></i><?php echo $phone1; ?></a>
          <?php endif; ?>
          <?php if($phone2): ?>
            <a href="tel:<?php echo $phone2; ?>"><i class="fas fa-phone-alt"></i><?php echo $phone2; ?></a>
          <?php endif; ?>
        </div>
      </div>

   <?php 
   endwhile; 

else :
   echo '<p>Sorry, no results matched your search.</p>';
endif; 
wp_reset_query();
?>
