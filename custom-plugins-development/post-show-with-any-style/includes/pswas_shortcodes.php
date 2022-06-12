<?php 


function my_test_function(){

  // Get the value of the current screen
  $currentScreen = get_current_screen();

  // Get the value of the pswas settings 
  $options = get_option( 'pswas_options' );
?>

  <?php if($currentScreen->base == "toplevel_page_pswas"): ?>
  <div style="margin-left: 180px;">
    <h1>Hello Output</h1>
    <?php 
      var_dump(isset($options["pswas_enable_masonry"]));
    ?>
  </div>
  <?php endif; ?>

<?php
}
add_action('admin_head', 'my_test_function');





/**
 * Add shortcode function for post display
 */
function pswas_post_shortcode_function($atts){
  ob_start();

  // Get the value of the pswas settings 
  $options = get_option( 'pswas_options' );

  extract(shortcode_atts( array(
    'style' => 'grid',
    'show' => '3'
  ), $atts, 'pswas_post' ));
  
  $postQuery = new WP_Query(array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $show,
  ));
  
  if($postQuery->have_posts()): ?>

    <div class="pswas-posts pswas-style-<?php echo($options["pswas_select_style"]); ?> <?php echo(isset($options["pswas_enable_masonry"]) ? (($options["pswas_select_style"] != "carousel") ? "enable-masonry" : "") : ""); ?> <?php echo $options["pswas_select_style"] == "carousel" ? "owl-carousel owl-theme" : ""; ?>">

      <?php while ( $postQuery->have_posts() ) : $postQuery->the_post(); ?>

        <div class="pswas-post <?php echo $options["pswas_select_style"] == "carousel" ? "item" : ""; ?>">
          <div class="pswas-inner">
            <div class="pswas-thumb">
              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
            </div>

            <div class="pswas-content">
              <div class="pswas-title">
                <?php the_title("<h2><a href=" . get_the_permalink() . ">", '</a></h2>'); ?>
              </div>

              <div class="pswas-meta">
                <div class="pswas-author">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>

                  <span><?php echo get_the_author(); ?></span>
                </div>

                <div class="pswas-date">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="30"><path d="M347.216 301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83s-19.83 8.864-19.83 19.83v118.978c0 6.246 2.935 12.136 7.932 15.864l79.318 59.489a19.71 19.71 0 0 0 11.878 3.966c6.048 0 11.997-2.717 15.884-7.952 6.585-8.746 4.8-21.179-3.965-27.743zM256 0C114.833 0 0 114.833 0 256s114.833 256 256 256 256-114.833 256-256S397.167 0 256 0zm0 472.341c-119.275 0-216.341-97.066-216.341-216.341S136.725 39.659 256 39.659c119.295 0 216.341 97.066 216.341 216.341S375.275 472.341 256 472.341z"></path></svg>

                  <span><?php echo get_the_date(); ?></span>
                </div>
              </div>

              <div class="pswas-excerpt">
                <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
              </div>

              <div class="pswas-bottom">
                <p class="more">
                  <a href="<?php the_permalink(); ?>">
                    Read More
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="30"><path d="M506.134 241.843c-.006-.006-.011-.013-.018-.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285.068s-7.762 20.492.067 28.284L443.558 236H20c-11.046 0-20 8.954-20 20s8.954 20 20 20h423.557l-70.162 69.824c-7.829 7.792-7.859 20.455-.067 28.284s20.457 7.858 28.285.068l104.504-104c.006-.006.011-.013.018-.019 7.833-7.818 7.808-20.522-.001-28.314z"></path></svg>
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>

      <?php endwhile; ?>

    </div>

    <?php if( $options["pswas_select_style"] == "carousel" ): ?>

      <script>
        (function($){
          $(function(){

            $('.pswas-posts.owl-carousel').owlCarousel({
                margin: 0,
                nav: true,
                loop: true,
                dots:false,
                autoplay:false,
                autoplaySpeed: 1200,
                responsive: { 0: { items: 1 }, 768: { items: 3 } },
                navText:[ '<', '>' ]
            });

            console.log('--carousel done--');
          });
        })( jQuery );
      </script>

    <?php elseif( isset($options["pswas_enable_masonry"]) && $options["pswas_select_style"] != "carousel" ): ?>

      <script>
        (function($){
          $(function(){

            var grid = document.querySelector('.pswas-posts.enable-masonry');

            var msnry = new Masonry( grid, {
              itemSelector: '.pswas-post',
              columnWidth: '.pswas-post',
              percentPosition: true
            });

            imagesLoaded( grid ).on( 'progress', function() {
              // layout Masonry after each image loads
              msnry.layout();
            });

            console.log('--Masonry done--');
          });
        })( jQuery );
      </script>

    <?php endif; ?>



  <?php endif; wp_reset_postdata();  

  return ob_get_clean();
  }
  add_shortcode( 'pswas_post', 'pswas_post_shortcode_function' );