<?php
function light_bold_scripts() {
    // Magnific Popup
    wp_enqueue_script( 'magnificPopup-js', get_stylesheet_directory_uri().'/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', false );
    wp_enqueue_style( 'magnificPopup-style', get_stylesheet_directory_uri().'/magnific-popup/magnific-popup.css', '', '1.1.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'light_bold_scripts' );

?>