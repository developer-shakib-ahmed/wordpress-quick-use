<?php 

// Get the value of the settings
$options = get_option( 'pswas_options' );


function pswas_add_enqueue(){

  // Stylesheet
  wp_enqueue_style( 'pswas-owl-carousel', PSWAS_URL . 'public/owl-carousel/owl.carousel.min.css', array(), PSWAS_VERSION, 'all' );
  wp_enqueue_style( 'pswas-owl-carousel-theme', PSWAS_URL . 'public/owl-carousel/owl.theme.default.min.css', array(), PSWAS_VERSION, 'all' );
  wp_enqueue_style( 'pswas-public', PSWAS_URL . 'public/css/pswas_public.css', array(), PSWAS_VERSION, 'all' );


  // Scripts
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'pswas-owl-carousel', PSWAS_URL .'public/owl-carousel/owl.carousel.min.js', array('jquery'), PSWAS_VERSION, false );
  wp_enqueue_script( 'pswas-masonry', PSWAS_URL .'public/js/masonry.min.js', array('jquery'), PSWAS_VERSION, false );


}
add_action('wp_enqueue_scripts', 'pswas_add_enqueue');