<?php

/*

    http://www.wpexplorer.com/wordpress-tinymce-tweaks/

*/

function myfox_mce_css() {
    wp_enqueue_style('symple_shortcodes-tc', get_template_directory_uri() .'/css/my-mce-style.css' );
}
add_action( 'admin_enqueue_scripts', 'myfox_mce_css' );


// Hooks your functions into the correct filters
function myfox_shortcode_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'myfox_shortcode_mce_plugin' );
        add_filter( 'mce_buttons', 'myfox_shortcode_register_mce_button' );
    }
}
add_action('admin_head', 'myfox_shortcode_mce_button');

// Declare script for new button
function myfox_shortcode_mce_plugin( $plugin_array ) {
    $plugin_array['my_mce_button'] = get_template_directory_uri() .'/js/mce-button.js';
    return $plugin_array;
}

// Register new button in the editor
function myfox_shortcode_register_mce_button( $buttons ) {
    array_push( $buttons, 'my_mce_button' );
    return $buttons;
}

?>