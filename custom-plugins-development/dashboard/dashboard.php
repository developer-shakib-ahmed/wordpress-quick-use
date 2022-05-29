<?php 

/*
  Plugin Name: Custom Dashboard
  Plugin URI: http://www.shakibahmed.com/plugins/custom-dashboard
  Author: Shakib Ahmed
  Author URI: http://www.shakibahmed.com
  Description: This plugin for you. You can able to make you or your company custom dashboard by "Custom Dashboard Plugin".
  Version: 1.0
  Text Domain: custom-dashboard
  License: GPL2
*/

#--------------- PHP output buffering ------------------#
ob_start();
#--------------- PHP output buffering ------------------#



#--------------- Report all PHP errors -----------------#
// error_reporting(E_ALL);
#--------------- Report all PHP errors -----------------#



#--------------- Exit if accessed directly -------------#
if( !defined( 'ABSPATH' ) ) {
  die('You are not allowed to call this page directly.');
}
#--------------- Exit if accessed directly -------------#



#--------------- define plugin url ---------------------#
define( 'PLUGIN_URL', plugins_url('', __FILE__) );
#--------------- define plugin url ---------------------#



#--------------- Add all back-end files ----------------#
function admin_custom_files_for_dashboard(){
  wp_enqueue_script( 'jquery' );
  wp_register_script( 
    'custom-jquery',
    plugins_url('/admin/js/custom-jquery.js', __FILE__),
    array('jquery'),
    '1.0'
  );
  wp_enqueue_script('custom-jquery');

  wp_register_style('admin-custom', plugins_url('/admin/css/custom-style.css', __FILE__), '', '1.0');
  wp_enqueue_style('admin-custom');

  wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', '', '4.7.0');
  wp_enqueue_style('font-awesome');
}
add_action('admin_enqueue_scripts', 'admin_custom_files_for_dashboard');
add_action('login_enqueue_scripts', 'admin_custom_files_for_dashboard');
#--------------- Add all back-end files ----------------#


#--------------- show_admin_bar ------------------------#
function hide_admin() {
    show_admin_bar(false);
}
add_action('set_current_user', 'hide_admin');
#--------------- show_admin_bar ------------------------#


#--------------- admin_sidebar_logout_link -------------#
function admin_sidebar_logout_link() {
    add_menu_page( 'Logout', '<a class="link" href="'.wp_logout_url(home_url()).'">Log Out</a>', 'read', 'logout', '', 'dashicons-logout', 100 );
}
add_action( 'admin_menu' , 'admin_sidebar_logout_link' );
#--------------- admin_sidebar_logout_link -------------#


#--------------- hide_latest_wp_update -----------------#
function hide_latest_wp_update() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action( 'admin_head', 'hide_latest_wp_update', 1 );
#--------------- hide_latest_wp_update -----------------#


#--------------- wordress_remove_admin_submenus --------#
function wordress_remove_admin_submenus() {
    
    remove_submenu_page( 'index.php', 'update-core.php' );

    if (!current_user_can( 'activate_plugins' )) {
       remove_menu_page( 'profile.php' );
       remove_menu_page( 'tools.php' );
       remove_menu_page( 'upload.php' );
       //remove_menu_page( 'edit.php' );
       remove_menu_page( 'edit.php?post_type=page' );
       remove_menu_page( 'edit.php?post_type=ditty_news_ticker' );
       remove_menu_page( 'edit-comments.php' );
       remove_menu_page( 'wpcf7' );
       remove_menu_page( 'vc-welcome' );
    }

    add_filter( 'admin_footer_text', '__return_empty_string', 11 );
    add_filter( 'update_footer',     '__return_empty_string', 11 );
}
add_action( 'admin_menu', 'wordress_remove_admin_submenus', 999 );
#--------------- wordress_remove_admin_submenus --------#


#--------------- custom_action_adminmenu ---------------#
function custom_action_adminmenu(  ) { 
?>
    <div id="customCode">
        <?php
            $current_user    = wp_get_current_user();
            $userID          = $current_user->ID;
            $userUserName    = $current_user->user_login;
            $userDisplayName = $current_user->display_name;
            $userFirstName   = $current_user->user_firstname;
            $userLastName    = $current_user->user_lastname;
            $userEmail       = $current_user->user_email;
            $userPower       = $current_user->roles; // $current_user->wp_capabilities
            $userAvater       = get_avatar( $userID, 96 );
        ?>
        <div class="userAvater"><?php echo $userAvater; ?></div>
        <h2 class="userName"><?php 
            if($userFirstName || $userLastName){
               echo $userFirstName.' '.$userLastName; 
            }else{
                echo "Your Name";
            }
        ?></h2>
        <p class="userPower"><?php echo implode(', ', $userPower); ?></p>
    </div>
<?php
};
add_action( 'adminmenu', 'custom_action_adminmenu', 1 );
#--------------- custom_action_adminmenu ---------------#


#--------------- sm_login_logo_url ---------------------#
function sm_login_logo_url() {
    $url = 'https://www.servermore.com/';
    return $url;
}
add_filter( 'login_headerurl', 'sm_login_logo_url' );
#--------------- sm_login_logo_url ---------------------#


#--------------- sm_login_logo_title -------------------#
function sm_login_logo_title() {
    return 'Powered by Sever More';
}
add_filter('login_headertitle', 'sm_login_logo_title');
#--------------- sm_login_logo_title -------------------#


#--------------- remove_wp_admin_bar_nodes -------------#
function remove_wp_admin_bar_nodes( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
    // $wp_admin_bar->remove_node( 'site-name' );
    $wp_admin_bar->remove_node( 'comments' );
    $wp_admin_bar->remove_node( 'new-content' );
    // $wp_admin_bar->remove_node( 'updates' );
}
add_action( 'admin_bar_menu', 'remove_wp_admin_bar_nodes', 999 );
#--------------- remove_wp_admin_bar_nodes -------------#


#--------------- remove_contextual_help_tabs -----------#
function remove_contextual_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter( 'contextual_help', 'remove_contextual_help_tabs', 999, 3 );
#--------------- remove_contextual_help_tabs -----------#


#--------------- remove screen_options_show_screen -----#
add_filter('screen_options_show_screen', '__return_false');
#--------------- remove screen_options_show_screen -----#


#--------------- remove_admin_bar_howdy_text -----#
function remove_admin_bar_howdy_text( $wp_admin_bar ) {
    $user_id = get_current_user_id();
    $current_user = wp_get_current_user();
     
    if ( 0 != $user_id ) {
        $avatar = get_avatar( $user_id, 28 );
        $howdy = sprintf( __('%1$s'), $current_user->display_name );         
        $wp_admin_bar->add_menu( array(
            'id' => 'my-account',
            'title' => $howdy . $avatar,
        ) );     
    }
}
add_action( 'admin_bar_menu', 'remove_admin_bar_howdy_text', 11 );
#--------------- remove_admin_bar_howdy_text -----#


#--------------- remove update_plugins -----------#
add_filter('pre_site_transient_update_plugins', '__return_null');
#--------------- remove update_plugins -----------#


#--------------- VC disable_updater --------------#
function ec_hide_vc_notification_css() {
	echo '<style> #vc_license-activation-notice { display: none !important; } </style>';
}
add_action('admin_head', 'ec_hide_vc_notification_css');
#--------------- VC disable_updater --------------#


#--------------- remove update_themes ------------#
add_filter('pre_site_transient_update_themes', '__return_null');
#--------------- remove update_themes ------------#


#--------------- set admin_color_scheme ----------#
function set_default_admin_color_scheme($color_scheme) {
    $color_scheme = 'blue'; // "Default", "Light", "Blue", "Midnight", "Sunrise", "Ectoplasm", "Ocean", "Coffee"
    return $color_scheme;
}
add_filter( 'get_user_option_admin_color', 'set_default_admin_color_scheme', 99 );
#--------------- set admin_color_scheme ----------#


#--------------- remove admin_color_scheme -------#
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
#--------------- remove admin_color_scheme -------#


#--------------- remove default dashboard feeds --#
function remove_defualt_dashboard_widgets() {
     global $wp_meta_boxes;
     unset(
          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'],
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']
     );
     remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
     remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
}
add_action('wp_dashboard_setup', 'remove_defualt_dashboard_widgets');
#--------------- remove default dashboard feeds --#


#--------------- Bangla_Bdnews24 dashboard feeds ------# 
function Bangla_Bdnews24_dashboard_widget_feed_output() {
     echo '<div class="rss-widget">';
     wp_widget_rss_output(array(
          'url' => 'http://bangla.bdnews24.com/?widgetName=rssfeed&widgetId=1151&getXmlFeed=true',
          'title' => 'Bangla.bdnews24.com',
          'items' => 50,
          'show_summary' => 0,
          'show_author' => 0,
          'show_date' => 1
     ));
     echo '</div>';
}

function set_Bangla_Bdnews24_dashboard_widget_feed() {
     wp_add_dashboard_widget( 'dashboard_custom_feed', 'সাম্প্রতিক জাতীয় খবর' , 'Bangla_Bdnews24_dashboard_widget_feed_output' );
}
add_action('wp_dashboard_setup', 'set_Bangla_Bdnews24_dashboard_widget_feed');
#--------------- Bangla_Bdnews24 dashboard feeds ------#


#--------------- dailysatkhira dashboard feeds ------#
function dailysatkhira_dashboard_widget_feed_output( ) {
     echo '<div class="rss-widget">';
     wp_widget_rss_output(array(
          'url' => 'http://dailysatkhira.com/feed',
          'title' => 'Dailysatkhira.com',
          'items' => 50,
          'show_summary' => 0,
          'show_author' => 0,
          'show_date' => 1
     ));
     echo '</div>';
}

function set_dailysatkhira_dashboard_widget_feed() {
  wp_add_dashboard_widget('dashboard_widget', 'সাম্প্রতিক সাতক্ষীরা জেলার খবর', 'dailysatkhira_dashboard_widget_feed_output');
}
add_action('wp_dashboard_setup', 'set_dailysatkhira_dashboard_widget_feed' );
#--------------- dailysatkhira dashboard feeds ------#


#--------------- Remove Frontend Edit Link ------#
function vc_remove_frontend_links() {
    vc_disable_frontend(); // this will disable frontend editor
}
add_action( 'vc_after_init', 'vc_remove_frontend_links' );
add_filter( 'edit_post_link', '__return_false' );
#--------------- Remove Frontend Edit Link ------#


#--------------- Add Admin Approval Files ------#
if( file_exists( plugin_dir_path(  __FILE__).'/chairman_approval/chairman_approval.php' ) ){
    include_once( plugin_dir_path(  __FILE__).'/chairman_approval/chairman_approval.php' );
}
#--------------- Add Admin Approval Files ------#


?>