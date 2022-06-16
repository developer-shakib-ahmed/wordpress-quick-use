<?php 
# ------- dynamic year short code ---------------------------- #
function dynamic_year_shortcode(){
  return date('Y');
}
add_shortcode( 'date', 'dynamic_year_shortcode' );
// use method: [date]
# ------- dynamic year short code ---------------------------- #



# ------- Display 3 image in post ---------------------------- #
function display_3_image($atts, $content){
  extract(shortcode_atts( array( 'img1' => '', 'img2' => '', 'img3' => '' ), $atts, 'vertical_image' ));
  return '<div class="vertical_image"><img src="'.$img1.'"/><img src="'.$img2.'"/><img src="'.$img3.'"/></div>';
}
add_shortcode( 'vertical_image', 'display_3_image' );
// use method: [vertical_image img1="" img2="" img3=""]
# ------- Display 3 image in post ---------------------------- #



# ------- _shortcode ---------------------------- #
function _shortcode($atts, $content = null){
  global $current_user;
  ob_start();
?>

<div id="content">
  Content goes here...
</div>

<?php
  return ob_get_clean();
}
add_shortcode( 'shortcode_name', '_shortcode' );
# ------- _shortcode ---------------------------- #



# ------- Create Related Item Shortcode ----------- #
function related_posts_shortcode($atts, $content){
ob_start(); 
$current_id = get_the_ID();
?>
<ul class="relative-items">
  <?php
    $related_items = new WP_Query(array( 
      'post_type' => 'post', 
      'posts_per_page' => 4,
      'orderby' => 'rand',
      'post__not_in' => array($current_id),
    ));             
  ?>
  <?php if($related_items->have_posts()): ?>
    <?php while($related_items->have_posts()): $related_items->the_post(); ?>
    <?php 
      $id = get_the_ID();
    ?>
      <li class="item">
        <a href="<?php the_permalink(); ?>">
          <p><?php the_post_thumbnail( 'medium' ); ?></p>
          <p><?php the_title(); ?></p>
          <p><?php echo get_the_date(); ?></p>
        </a>
      </li>
    <?php endwhile; wp_reset_postdata(); ?>
  <?php else: ?>
  <li class="item no_relative_posts">
      <p>You have no related items.</p>
  </li>
  <?php endif; ?>                 
</ul>
<?php return ob_get_clean();
}
add_shortcode( 'related_posts', 'related_posts_shortcode' );
//Use method: [related_posts]
# ------- Create Related Item Shortcode ------------ #



# ------- thecowork_pricing_shortcode ------------ #
function thecowork_pricing_shortcode($atts){
  ob_start();
  global $post;
  extract(shortcode_atts( array( 'category' => '' ), $atts, 'thecowork_pricing' ));
  if($category){
    $priceQuery = new WP_Query(array(
      'post_type' => 'uni_price',
      'post_status' => 'publish',
      'posts_per_page' => 3,
      'tax_query' => array(
        array(
          'taxonomy' => 'price_category',
          'field'    => 'slug',
          'terms'    => $category,
        )
      ),
    ));
  }else{
    $priceQuery = new WP_Query(array(
      'post_type'      => 'uni_price',
      'post_status'    => 'publish',
      'posts_per_page' => 3,
    ));
  }
  
  if($priceQuery->have_posts()): ?>
    <div class="pricing-plan-item">
    <?php while ( $priceQuery->have_posts() ) : $priceQuery->the_post(); ?>
    <div class="">content goes here....</div>
    <?php endwhile; ?>
    </div>
  <?php endif; wp_reset_postdata();
  return ob_get_clean();
  }
  add_shortcode( 'thecowork_pricing', 'thecowork_pricing_shortcode' );
  // [thecowork_pricing category="featured"]
# ------- thecowork_pricing_shortcode ------------ #



/**
 * Video Carousel Shortcode
 */ 
function fruitful_video_carousel_shortcode($atts, $content = null) {
  global $post;
    extract(shortcode_atts(array(
        "show" => "12"
    ), $atts));
    $sermonQuery = new WP_Query(array( 
      'post_type' => 'sermon', 
      'posts_per_page' => $show,
    ));
    $content = '';
    $i = 0;
    if($sermonQuery->have_posts()):
    while($sermonQuery->have_posts()):
      $sermonQuery->the_post();
      $imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large', false );
      $excerpt = (has_excerpt()) ? get_the_excerpt() : wp_trim_words( get_the_content(), 20, null );
      $data = '<span class="date">'.rwmb_meta( '_mb_sermon_date' ).'</span>';
      $title = '<span class="title">'.get_the_title().'</span>';
      $desc = '<span class="desc">'.$excerpt.'</span>';
      $thumb = '<span class="thumb" style="background-image: url('.$imgSrc[0].')">'.$data.'<i class="fa fa-play"></i></span>';
      $content .= '[item id="'.$i.'" tab_id="'.$i.'" title="Item"][vc_column_text]<div class="sermon"><a href="'.get_the_permalink().'">'.$thumb.$title.$desc.'</a></div>[/vc_column_text][/item]';
      $i++;
    endwhile; wp_reset_postdata();
    endif;
    return do_shortcode( $content );
}
add_shortcode("fruitful_video_carousel", "fruitful_video_carousel_shortcode");
// USE: [carousel script="owl_carousel" desktop_cols="2" desktop_small_cols="2" tablet_cols="1" mobile_cols="1" column_padding="0px"][fruitful_video_carousel show="8"][/carousel]

/*
  VC Video Popup
  [nectar_video_lightbox link_style="play_button" video_url="https://www.youtube.com/watch?v=6oTurM7gESE"]

  VC Slider:-
  [vc_gallery type="flexslider_style" images="283,284,73" onclick="link_no" img_size="1920x900"]

  VC Grid:-
  [vc_gallery type="image_grid" images="301,303,302,304" layout="4" item_spacing="default" gallery_style="7" load_in_animation="none" img_size="large"]

  VC Masonry:-
  [vc_gallery type="image_grid" images="129,268,400,124,324,305" layout="3" masonry_style="true" item_spacing="10px" gallery_style="7" load_in_animation="none" img_size="large"]
*/

