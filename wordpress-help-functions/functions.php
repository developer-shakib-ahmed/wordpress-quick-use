<?php


#----- after_setup_theme -------------------#
function theme_name_setup() {
  load_theme_textdomain( 'listable', get_template_directory() . '/languages' );

  add_image_size( 'listable-card-image', 450, 9999, false );

  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  add_theme_support( 'automatic-feed-links' );

  add_theme_support( 'title-tag' );

  add_theme_support( 'post-thumbnails' );

  add_theme_support( 'custom-logo' );

  add_theme_support( 'post-formats', array() );

  add_theme_support( 'job-manager-templates' );

  add_theme_support( 'woocommerce' );

  add_post_type_support( 'page', 'excerpt' );

  add_action( 'wp_head', 'listable_load_custom_js_header', 999 );

  add_action( 'wp_footer', 'listable_load_custom_js_footer', 999 );

  add_editor_style( array( 'editor-style.css' ) );
}
add_action( 'after_setup_theme', 'theme_name_setup' );
#----- after_setup_theme -------------------#



#----- Wordpress file require --------------#
require get_template_directory() . '/inc/required-plugins/required-plugins.php';
#----- Wordpress file require --------------#



#----- remove_add_theme_support_option -----#
function remove_add_theme_support_option() {
    remove_post_type_support( 'page', 'thumbnail' );
}
add_action( 'init', 'remove_add_theme_support_option' );
#----- remove_add_theme_support_option -----#



#----- wp_enqueue_script -------------------#
// register for java-script file
function register_java_script_file(){
  wp_enqueue_script( 'comment-reply' );
  wp_enqueue_script( 'jquery' );

  wp_register_script( 'demo-js', get_template_directory_uri().'/js/demo.js', array( 'jquery' ) );
  wp_enqueue_script('demo-js');
}
add_action('wp_enqueue_scripts', 'register_java_script_file');


// register for css file
function register_style_file(){
  wp_register_style( 'theme-style', get_stylesheet_uri(), '', '1.0', 'all' );
  wp_enqueue_style( 'theme-style' );

  wp_register_style( 'lightbox-css', get_template_directory_uri().'/lightbox/magnific-popup.css' );
  wp_enqueue_style('lightbox-css');
}
add_action('wp_enqueue_scripts', 'register_style_file');
#----- wp_enqueue_script -------------------#



#----- Wordpress redirect-------------------#
function logout_redirect_home(){
  wp_safe_redirect(home_url());
  exit;
}
add_action('wp_logout', 'logout_redirect_home');


// redirect homepage when url not found
function redirect_404_to_any_url() {
  if ( is_404() ) :
   	wp_redirect( home_url(), 301 ); 
    exit;
  endif;
}
add_action( 'template_redirect', 'redirect_404_to_any_url' );
#----- Wordpress redirect-------------------#



#----- Enable shortcodes in text widgets -------------------#
add_filter('widget_text','do_shortcode'); 
#----- Enable shortcodes in text widgets -------------------#



#----- the_content() length control function -------------------#
function custom_excerpt( $limit ){
  $getCentent = explode( " ", get_the_content() );
  $contentSlice = array_slice($getCentent, 0, $limit);
  $contentImplode = implode(" ", $contentSlice);
  return $contentImplode;
}
// use method: echo custom_excerpt( $limit );
#----- the_content() length control function -------------------#



#-----------------------------------------------------------------#
# Create admin $plural_name section
#-----------------------------------------------------------------# 

function theme_custom_post_register(){

  $singular_name  = 'Product';
  $plural_name  = 'Products';
  $slug       = strtolower(str_replace(" ", "_", $singular_name));

  $labels = array( 
    'name'                  =>  $plural_name,
    'singular_name'         =>  $singular_name,
    'menu_name'             =>  $plural_name,
    'name_admin_bar'        =>  $singular_name, // must use
    'add_new'               =>  'Add '.$singular_name,
    'add_new_item'          =>  'Add New '.$singular_name,
    'all_items'             =>  'All '.$plural_name, // must use
    'new_item'              =>  'New '.$singular_name, // unknown
    'view_item'             =>  'View '.$singular_name,
    'edit_item'           =>  'Edit '.$singular_name,
    'search_items'          =>  'Search '.$plural_name,
    'parent_item_colon'     =>  'Parent '.$singular_name.':', // hidden
    'not_found_in_trash'    =>  'No '.$plural_name.' found in Trash.',
    'not_found'             =>  'No '.$plural_name.' found.',
    'featured_image'        =>  $singular_name.' Featured Image',
    'set_featured_image'    =>  'Set '.$singular_name.' Featured Image',
    'remove_featured_image' =>  'Remove '.$singular_name.' Featured Image',
    'use_featured_image'    =>  'Use As '.$singular_name.' Featured Image', // unknown
  );


  $args = array(
    'labels'              =>  $labels,
    'public'              =>  true,
    'show_ui'             =>  true,
    'publicly_queryable'  =>  true,
    'show_in_menu'          =>  true,
    'query_var'             =>  true,
    'capability_type'     =>  'post',
    'has_archive'         =>  true,
    'menu_position'         =>  90,
    'menu_icon'             =>  'dashicons-menu',
    'exclude_from_search' =>  false,
    'show_in_nav_menus'     =>  true,
    'hierarchical'          =>  true,
    'can_export'            =>  true,
    'taxonomies'          =>  array( 'custom-category' ),
    'rewrite'             =>  true, // or array( 'slug' => 'custom_post' )
    'supports'              =>  array( 
      'trackbacks', 'custom-fields', 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'post-formats',
     ),
  );

  register_post_type( $slug, $args);

}
add_action( 'init', 'theme_custom_post_register' );


function theme_custom_post_enter_title( $input ) {
    global $post_type;

    $singular_name  = 'Product';
    $plural_name    = 'Products';
    $slug           = strtolower(str_replace(" ", "_", $plural_name));    

    if( is_admin() && 'Enter title here' == $input && $slug == $post_type ){
        return $singular_name.' title here';
    }

    return $input;
}
add_filter('gettext','theme_custom_post_enter_title');


function theme_custom_post_updated_messages( $messages ) {
    global $post, $post_ID;

    $singular_name  = 'Product';
    $plural_name    = 'Products';
    $slug           = strtolower(str_replace(" ", "_", $plural_name));     

    $messages[$slug] = array(
    0 => '', // Unused. Messages start at index 1.

    1 => sprintf( $singular_name.' updated. <a href="%s">View '.$singular_name.'</a>', esc_url( get_permalink( $post_ID ) ) ),

    2 => '',

    3 => '',

    4 => $singular_name.' updated.',

    5 => isset( $_GET['revision'] ) ? sprintf( $singular_name.' restored to revision from %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,

    6 => sprintf( $singular_name.' published. <a href="%s">View '.$singular_name.'</a>', esc_url( get_permalink( $post_ID ) ) ),

    7 => $singular_name.' saved.',

    8 => sprintf( $singular_name.' submitted. <a target="_blank" href="%s">Preview '.$singular_name.'</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),

    9 => sprintf( $singular_name.' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview '.$singular_name.'</a>', date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),

    10 => sprintf( $singular_name.' draft updated. <a target="_blank" href="%s">Preview '.$singular_name.'</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),

    );
    return $messages;
}
add_filter( 'post_updated_messages', 'theme_custom_post_updated_messages' );




function my_taxonomies_name() {

  $singular_name  = 'Product Category';
  $plural_name  = 'Product Categories';
  $slug       = strtolower(str_replace(" ", "_", $singular_name)); 

  $labels = array(
    'name'                  => $plural_name,
    'singular_name'         => $singular_name,
    'search_items'          => 'Search '.$plural_name,
    'popular_items'         => 'Popular '.$plural_name,
    'all_items'             => 'All '.$plural_name,
    'view_item'             => 'View '.$singular_name,
    'parent_item'           => 'Parent '.$singular_name,
    'parent_item_colon'     => 'Parent '.$singular_name,
    'edit_item'             => 'Edit '.$singular_name,
    'update_item'           => 'Update '.$singular_name,
    'add_new_item'          => 'Add New '.$singular_name,
    'new_item_name'         => 'New '.$singular_name,
    'add_or_remove_items'   => 'Add or remove '.$plural_name,
    'choose_from_most_used' => 'Choose from most used '.$plural_name,
    'menu_name'             => $plural_name,
    'not_found'             =>  'No '.$plural_name.' found.',
  );

  $args = array(
    'labels'            => $labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_admin_column' => true,
    'hierarchical'      => true,
    'show_tagcloud'     => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => true,
    'query_var'         => true,
    'capabilities'      => array(),
  );

  register_taxonomy( $slug, array( 'products' ), $args );
}

add_action( 'init', 'my_taxonomies_name' );


// function pippin_add_taxonomy_filters() {
//  global $typenow;
 
//  // an array of all the taxonomyies you want to display. Use the taxonomy name or slug
//  $taxonomies = array('image-type');
 
//  // must set this to the post type you want the filter(s) displayed on
//  if( $typenow == 'images' ){
 
//    foreach ($taxonomies as $tax_slug) {
//      $tax_obj = get_taxonomy($tax_slug);
//      $tax_name = $tax_obj->labels->name;
//      $terms = get_terms($tax_slug);
//      if(count($terms) > 0) {
//        echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
//        echo "<option value=''>Show All $tax_name</option>";
//        foreach ($terms as $term) { 
//          echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
//        }
//        echo "</select>";
//      }
//    }
//  }
// }
// add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters' );

function restrict_listings_by_business() {
    global $typenow;
    global $wp_query;

    if ($typenow == 'images') {
        $taxonomy = 'image-type';
        $business_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("All {$business_taxonomy->label}"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  $taxonomy,
            'selected'        =>  $wp_query->query['term'],
            'hierarchical'    =>  true,
            'show_count'      =>  true,
            'hide_empty'      =>  true,
            'depth'           =>  3,
      'orderby'       => 'ID',
      'order'       => 'DESC',
      'exclude'         => '84',
        ));
    }

    var_dump(wp_dropdown_categories());
}
add_action('restrict_manage_posts','restrict_listings_by_business');
// http://wordpress.stackexchange.com/questions/578/adding-a-taxonomy-filter-to-admin-list-for-a-custom-post-type



# ---------- Create Most View Item functions -------------- #
// http://www.wpbeginner.com/wp-tutorials/how-to-track-popular-posts-by-views-in-wordpress-without-a-plugin/
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');



function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
// insert into single.php -> wpb_get_post_views(get_the_ID());
# ---------- Create Most View Item functions -------------- #



#-------------- Popular items query functions---------------#
$popular_items = new WP_Query(array( 
  'post_type'      => 'post', 
  'meta_key'       => 'wpb_post_views_count',
  'posts_per_page' => 4,
  'orderby'        => 'meta_value_num',
  'order'          => 'DESC'
));

while ( $popular_items->have_posts() ) : $popular_items->the_post();
  the_title();
endwhile;
#-------------- Popular items query functions---------------#



#------ Author info custom fields --------------------------#

// Extending user profile page
// Function to create the form
function custom_show_extra_profile_fields( $user ){
?>
  <h2>Social Media</h2>
  <table class="form-table">

    <tr>
      <th><label for="facebook">Facebook URL</label></th>
      <td>
        <input class="regular-text" type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>">
        <p class="description">Enter your facebok profile url</p>
      </td>
    </tr>

    <tr>
      <th><label for="listing_url">Listing URL</label></th>
      <td>
        <input class="regular-text" type="text" name="listing_url" id="listing_url" value="<?php echo esc_attr( get_the_author_meta( 'listing_url', $user->ID ) ); ?>">
        <p class="description">Enter your listing url</p>
      </td>
    </tr>

  </table>
<?php
}

// Callback function to save the data
function custom_save_extra_profile_fields( $user_id ){
  if ( !current_user_can( 'edit_user', $user_id ) ){
    return false;
  }else{
    update_usermeta( $user_id, 'facebook', $_POST['facebook'] );
    update_usermeta( $user_id, 'listing_url', $_POST['listing_url'] );
  }
}


// Hooks
add_action( 'show_user_profile', 'custom_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'custom_show_extra_profile_fields' );
add_action( 'personal_options_update', 'custom_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'custom_save_extra_profile_fields' );
#------ Author info custom fields ---------------------------#



#----- register_nav_menu ------------------------------------#
register_nav_menus( array(
  'primary'            => esc_html__( 'Primary Menu', 'listable' ),
  'secondary'          => esc_html__( 'Secondary Menu', 'listable' ),
  'search_suggestions' => esc_html__( 'Search Menu', 'listable' ),
  'footer_menu'        => esc_html__( 'Footer Menu', 'listable' ),
) );

register_nav_menu( 'main-menu', 'Main Menu' );

function default_menu(){
  $menu_create_link = esc_url(home_url('/wp-admin/nav-menus.php'));
  echo '<ul><li><a href="'.$menu_create_link.'">'.'Create Menu'.'</a></ul></li>';
}
#----- register_nav_menu ------------------------------------#



# ------- wp advanced search include functions -------- #
require_once('wp-advanced-search/wpas.php');

function teachers_search_form() {
  $prefix = '_meta_id_';
  $args = array();
  $args['wp_query'] = array( 'post_type'      => array('teachers', 'field', 'param'), 
                             'posts_per_page' => 10,
                             'orderby'        => 'date', 
                             'order'          => 'DESC' );
                             
  // Here is where we specify the page where results will be shown
  $args['form'] = array( 'action' => get_bloginfo('url') . '/teacher-search' );
  
  $args['fields'][] = array( 'type'        =>  'search',
                             'label'       =>  'Teachers Name',
                             'placeholder' =>  'Enter teacher name' );

  $args['fields'][] = array( 'type'      =>  'meta_key',
                             'label'     =>  'Is this training certified?', 
                             'format'    =>  'radio', 
                             'meta_key'  =>  $prefix . 'certificate',
                               'values'  => array(
                                    'yes'  => 'Yes',
                                    'no'   => 'No',
                                ),
                             'compare'   => 'IN' );

  $args['fields'][] = array( 'type'      =>  'meta_key',
                             'label'     =>  'State', 
                             'format'    =>  'text',
                             'placeholder' =>  'Enter state',
                             'meta_key'  =>  $prefix . 'state', );

  $args['fields'][] = array( 'type'      =>  'meta_key',
                             'label'     =>  'Amount of hours', 
                             'format'    =>  'text',
                             'placeholder' =>  'Enter hour', 
                             'meta_key'  =>  $prefix . 'hours', );

  $args['fields'][] = array( 'type'      =>  'taxonomy',
                             'label'     =>  'Yoga Style', 
                             'format'    =>  'checkbox', 
                             'operator'  => 'IN',
                             'term_args' => array('hide_empty' => true ),
                             'taxonomy'  =>  'teacher-type', );

  $args['fields'][] = array( 'type'   => 'submit', 
                             'value'  => 'Search' );

  register_wpas_form('teachers_search', $args);
}
add_action('init','teachers_search_form');
# ------- wp advanced search include functions -------- #



# ------- custom meta box include functions ----------- #
// for function.php
if(file_exists( dirname( __FILE__ ) . '/cmb2/init.php' )){
  require_once( 'cmb2/init.php' );
}

if(file_exists( dirname( __FILE__ ) . '/cmb2/cmb2-functions.php' )){
  require_once( 'cmb2/cmb2-functions.php' );
}

# ---- cmb2 include functions  ---- #
require_once('cmb2/init.php');
require_once('cmb2/cmb2-functions.php');// our working file
# ------- custom meta box include functions ----------- #



# ------- ReduxFrameWork include functions ------------ #
require_once('redux-theme-options/ReduxCore/framework.php');
require_once('redux-theme-options/sample/config.php');// our working file
# ------- ReduxFrameWork include functions ------------ #



function make_bangla_number( $str ) {
    $engNumber = array(1,2,3,4,5,6,7,8,9,0);
    $bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
    $converted = str_replace($engNumber, $bangNumber, $str);
    
    return $converted;
}
 
add_filter( 'get_the_time', 'make_bangla_number' );
add_filter( 'the_date', 'make_bangla_number' );
add_filter( 'get_the_date', 'make_bangla_number' );
add_filter( 'comments_number', 'make_bangla_number' );
add_filter( 'get_comment_date', 'make_bangla_number' );
add_filter( 'get_comment_time', 'make_bangla_number' );
add_filter( 'the_ID', 'make_bangla_number' );
add_filter( 'get_the_ID', 'make_bangla_number' );



# ------- Customize (title-tag) ----------------------- #
function ccd_document_title_separator( $sep ) {
  $sep = "|";
  return $sep;
}
add_filter( 'document_title_separator', 'ccd_document_title_separator' );

function dq_override_post_title($title){

  global $post;
  $pageSlug = $post->post_name;

  if($pageSlug == "custom-page"){
      $title['title'] = 'EXAMPLE'; // current page title
  }

  return $title; 
}
add_filter('document_title_parts', 'dq_override_post_title');
# ------- Customize (title-tag) ----------------------- #



# ------- custom post title field label --------------- #
add_filter('gettext','custom_enter_title');
function custom_enter_title( $input ) {
    global $post_type;
    if( is_admin() && 'Enter title here' == $input && 'custom_post' == $post_type ){
        return 'Custom post title here';
    }
    return $input;
}
# ------- custom post title field label --------------- #



# ------- custom post update message ------------------ #
add_filter( 'post_updated_messages', 'rh_recipe_updated_messages' );
function rh_recipe_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['custom_post'] = array(
         0 => '', // Unused. Messages start at index 1.
         1 => sprintf( __( 'Custom post updated. <a href="%s">View Custom post</a>', 'custom_post-hero' ), esc_url( get_permalink( $post_ID ) ) ),
         //2 => '',
         //3 => '',
         //4 => __( 'Recipe updated.', 'recipe-hero' ),
         //5 => isset( $_GET['revision'] ) ? sprintf( __( 'Recipe restored to revision from %s', 'recipe-hero' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
         //6 => sprintf( __( 'Recipe published. <a href="%s">View recipe</a>', 'recipe-hero' ), esc_url( get_permalink( $post_ID ) ) ),
         //7 => __( 'Recipe saved.', 'recipe-hero' ),
         //8 => sprintf( __( 'Recipe submitted. <a target="_blank" href="%s">Preview recipe</a>', 'recipe-hero' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
         //9 => sprintf( __( 'Recipe scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview recipe</a>', 'recipe-hero' ), date_i18n( __( 'M j, Y @ G:i', 'recipe-hero' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
        //10 => sprintf( __( 'Recipe draft updated. <a target="_blank" href="%s">Preview recipe</a>', 'recipe-hero' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    );
    return $messages;
}
# ------- custom post update message ------------------ #



# ------- WPML ---------------------------------------- #
if(ICL_LANGUAGE_CODE == 'bng'){}

if(ICL_LANGUAGE_CODE == 'en'){}

function append_language_class($classes){
  $classes[] = ICL_LANGUAGE_CODE;
  return $classes;
}
add_filter('body_class', 'append_language_class');
# ------- WPML ---------------------------------------- #



# ------- Poly lang ---------------------------------------- #
if(pll_current_language() == 'en') {
    echo '';
} else if(pll_current_language() == 'fr') {
    echo ''; 
}
# ------- Poly lang ---------------------------------------- #



# ------- wp_get_recent_posts() ----------------------- #
$recent_posts = wp_get_recent_posts( array( 'numberposts' => '3', 'post_type' => 'post', ) );
foreach( $recent_posts as $recent ){
  $recents[] = $recent["ID"];
}

$the_resent_post = new WP_Query(array(
  'post_type'      => 'post',
  'posts_per_page' => '3',
  'post__not_in'   => $recents,
));
# ------- wp_get_recent_posts() ----------------------- #



# ------- adding-custom-meta-fields-to-taxonomies ----- #
// Credit: < !-- https://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies --> 

#---------- Add term page ----------#
function category_add_new_meta_field() {
  // this will add the custom meta field to the add new term page
  ?>
  <div class="form-field">
    <label for="term_meta[taxonomy_order]"><?php _e( 'Taxonomy order', 'pippin' ); ?></label>
    <input type="number" name="term_meta[taxonomy_order]" id="term_meta[taxonomy_order]" placeholder="Enter your order number"/>
    <p class="description"><?php _e( 'Enter a value for order this taxonomy.','pippin' ); ?></p>
  </div>
<?php
}
add_action( 'category_add_form_fields', 'category_add_new_meta_field', 10, 2 );
#---------- Add term page ----------#



#---------- Edit term page ----------#
function category_edit_new_meta_field($term) {
 
  // put the term ID into a variable
  $termID = $term->term_id;
 
  // retrieve the existing value(s) for this meta field. This returns an array
  $term_meta = get_option( $termID );
  $term_value = $term_meta['taxonomy_order'] ? $term_meta['taxonomy_order'] : ''; ?>

  <tr class="form-field">
  <th scope="row" valign="top">
    <label for="term_meta[taxonomy_order]"><?php _e( 'Taxonomy order', 'pippin' ); ?></label>
  </th>
    <td>
      <input type="number" name="term_meta[taxonomy_order]" id="term_meta[taxonomy_order]" value="<?php echo esc_attr( $term_value ); ?>" placeholder="Enter your order number"/>
      <p class="description"><?php _e( 'Enter a value for order this taxonomy.','pippin' ); ?></p>
    </td>
  </tr>
<?php
}
add_action( 'category_edit_form_fields', 'category_edit_new_meta_field', 10, 2 );
#---------- Edit term page ----------#



#---------- Save extra taxonomy fields callback function ----------#
function save_category_new_meta( $term_id ) {
  if ( isset( $_POST['term_meta'] ) ) {
    $termID = $term_id;
    $term_meta = get_option( $termID );
    $cat_keys = array_keys( $_POST['term_meta'] );
    foreach ( $cat_keys as $key ) {
      if ( isset ( $_POST['term_meta'][$key] ) ) {
        $term_meta[$key] = $_POST['term_meta'][$key];
      }
    }
    // Save the option array.
    update_option( $termID, $term_meta );
  }
}  
add_action( 'edited_category', 'save_category_new_meta', 10, 2 );  
add_action( 'create_category', 'save_category_new_meta', 10, 2 );
#---------- Save extra taxonomy fields callback function ----------#



#---------- Add Custom Field to Post Tag ----------#
function post_tag_add_new_meta_field() {
  ?>
  <div class="form-field">
    <h4 style="display: inline-block;margin-right: 10px;margin-bottom: 0;">Tag Visibility:</h4>
    <label style="display: inline-block;"><input type="radio" name="tag_visibility" value="yes" /> Yes</label>
    <label style="display: inline-block;margin-left: 15px;"><input type="radio" name="tag_visibility" value="no" /> No</label>
    <p class="description"><?php _e( 'Choose your visibility option','pippin' ); ?></p>
  </div>
<?php
}
add_action( 'post_tag_add_form_fields', 'post_tag_add_new_meta_field', 10, 2 );

function post_tag_edit_new_meta_field($term) {
  $term_meta = get_term_meta( $term->term_id );
  $term_value = $term_meta['tag_visibility'][0] ? $term_meta['tag_visibility'][0] : '';
?>

  <tr class="form-field">
  <th scope="row" valign="top">
    <b>Tag Visibility</b>
  </th>
    <td>
      <label style="display: inline-block;"><input type="radio" name="tag_visibility" value="yes" <?php checked( $term_value, 'yes' ); ?> /> Yes</label>
      <label style="display: inline-block;margin-left: 15px;"><input type="radio" name="tag_visibility" value="no" <?php checked( $term_value, 'no' ); ?> /> No</label>
      <p class="description"><?php _e( 'Choose your visibility option.','pippin' ); ?></p>
    </td>
  </tr>
<?php 
}
add_action( 'post_tag_edit_form_fields', 'post_tag_edit_new_meta_field', 10, 2 );

function save_post_tag_new_meta( $term_id ) {
  if( isset($_POST['tag_visibility']) ){
      $term_meta = get_term_meta( $term->term_id );
      $term_value = $term_meta['tag_visibility'][0] ? $term_meta['tag_visibility'][0] : '';
      //update_post_meta($term_id, "tag_visibility", $_POST["tag_visibility"] );
      delete_term_meta( $term_id, "tag_visibility" );
      add_term_meta( $term_id, "tag_visibility", $_POST["tag_visibility"] );
  }
}  
add_action( 'edited_post_tag', 'save_post_tag_new_meta', 10, 2 );  
add_action( 'create_post_tag', 'save_post_tag_new_meta', 10, 2 );
# ------- adding-custom-meta-fields-to-taxonomies ----- #



# ------- get dynamic all data ----- #
    $post_type            = get_post_type(); // post_type=>
    $currentObject        = get_queried_object();
    $currentTermID        = $currentObject->term_id;
    $currentTermName      = $currentObject->name;
    $currentTermSlug      = $currentObject->slug;
    $currentTaxonomy      = $currentObject->taxonomy; // taxonomy=>
    $currentTaxonomyCount = $currentObject->count;
# ------- get dynamic all data ----- #



# ------- the_posts_pagination ----- #
  $GLOBALS['wp_query']->max_num_pages = $tileBlog->max_num_pages;
  the_posts_pagination( array(
    'mid_size' => 2,
    'prev_text' => __( 'Back', 'textdomain' ),
    'next_text' => __( 'Onward', 'textdomain' ),
  ) );
# ------- the_posts_pagination ----- #



# ------- My_Ago_Time ----- #
function My_Ago_Time() {
  global $post;
  $date = $post->post_date;
  $time = get_post_time('G', true, $post);
  $mytime = time() - $time;
  if($mytime > 0 && $mytime < 2*24*60*60){
    $my_ago_time = sprintf(__('%s ago'), human_time_diff($time));
  }
  else{
    // $my_ago_time = date(get_option('date_format'), strtotime($date)) . ' at ' . date(get_option('time_format'), strtotime($date));
    $my_ago_time = date(get_option('date_format'), strtotime($date));
  }
  return $my_ago_time;
}
# ------- My_Ago_Time ----- #



#----- Default Search Filter ------#
// Search only post, product from WordPress Search
if ( !is_admin() ) {
    function theme_default_search_filter( $query ) {
        if ( $query->is_search ) {
            $query->set( 'post_type', array( 'post', 'product' ) );
        }
        return $query;
    }
    add_filter( 'pre_get_posts','theme_default_search_filter' );
}


function theme_default_search_filter( $query ) {
  if ( $query->is_search ) {
    $query->set( 'post_type', array( 'project' ) );
    $query->set( 'order ', 'DESC' );
    $query->set( 'orderby', 'title' );
    $query->set( 'posts_per_page', 2 );
  }
  return;
}
add_action( 'pre_get_posts','theme_default_search_filter', 99 );
#----- Default Search Filter ------#



add_filter( 'body_class', 'wpse15850_body_class', 10, 2 );
function wpse15850_body_class( $classes, $class ) {

    if ( current_user_can('customer') ){

        foreach($classes as &$str){
            if( strpos($str, "logged-in") > -1 ){
                $str = "";
            }
        }
    }    
    return $classes;
}



#----- Admin bar custom menu -----#
function custom_menu_in_admin_bar_menu() {  
  global $wp_admin_bar;
  $wp_admin_bar->add_menu( array(
    'parent' => 'site-name',
    'title'  => __( 'My Title 3' ),
    'href'   => 'http://www.example.com',
    'meta'   => array( 'target'   => '_blank' ), ) );
}

if ( current_user_can( 'manage_options' ) ) :
  add_action( 'admin_bar_menu', 'custom_menu_in_admin_bar_menu', 10 );
endif;
#----- Admin bar custom menu -----#




// https://wpscholar.com/blog/redirect-entire-website-except-wordpress-admin/
if ( ! is_admin() ) {
    wp_redirect( 'https://www.prohori.com' . $_SERVER['REQUEST_URI'], 301 );
    exit;
}



#----- My Redirection -----#
function my_redirection(){
  global $wp_rewrite;

  global $wp;
  $request_slug = sanitize_text_field( $wp->request );
  $request_slug = substr( $request_slug, 9 );

  if($request_slug && is_404()){
    if(is_numeric($request_slug)){
      $permalink = get_permalink( (int)$request_slug );
      wp_redirect( $permalink, 301 );
      exit;
    }else{
      wp_redirect( esc_url(home_url('/'.$request_slug)), 301 );
      exit;
    }
  }
}
add_action( 'template_redirect', 'my_redirection' );
#----- My Redirection -----#



function bb_after_setup() {
    add_post_type_support( 'agent', 'custom-fields' );
}
add_action( 'init', 'bb_after_setup' );



# ------- Highlight Current Cat ----- #
function highlight_category_on_single_post( $output, $args ) {
 
  if(is_single()){
    global $post;
 
    $terms = get_the_terms( $post->ID, $args['taxonomy'] );
    foreach( $terms as $term )
        if ( preg_match( '#cat-item-' . $term ->term_id . '#', $output ) )
            $output = str_replace('cat-item-'.$term ->term_id, 'cat-item-'.$term ->term_id . ' current-cat', $output);
  }
 
  return $output;
}
add_filter( 'wp_list_categories', 'highlight_category_on_single_post', 10, 2 );
# ------- Highlight Current Cat ----- #



function cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}
add_filter('wp_list_categories', 'cat_count_span');



// Human time.
function thb_human_time_diff_enhanced( $duration = 60 ) {
  $post_time  = get_the_time( 'U' );
  $human_time = '';
  $time_now   = date( 'U' );

  // use human time if less that $duration days ago (60 days by default).
  // 60 seconds * 60 minutes * 24 hours * $duration days.
  if ( $post_time > $time_now - ( 60 * 60 * 24 * $duration ) ) {
    $human_time = sprintf( __( '%s ago', 'thevoux' ), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
  } else {
    $human_time = get_the_date();
  }
  if ( ot_get_option( 'relative_dates', 'on') === 'off') {
    return get_the_date();
  } else {
    return $human_time;
  }
}

?>



<?php if ( get_queried_object()->taxonomy == 'product_cat' ) : ?>
  <?php get_template_part( 'archive', 'product' ); ?>
<?php else: ?>
  <?php get_template_part( 'archive', 'post' ); ?>
<?php endif; ?>


<?php 

function salient_redux_custom_fonts( $custom_fonts ) {
  return array(
    'Custom Fonts' => array(
        'futura-pt,sans-serif' => "Futura PT"
    )
  );
}
add_filter( "redux/salient_redux/field/typography/custom_fonts", "salient_redux_custom_fonts" );


/**
 * Proper ob_end_flush() for all levels
 *
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );


/**
 * Fruitful hide update notifications
*/
function remove_core_updates(){
  global $wp_version;
  
  return(object) array(
      'last_checked'=> time(),
      'version_checked'=> $wp_version,
  );
}
add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes

?>