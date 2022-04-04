<?php

#---------- Adding Agents Meta Field ----------#
function agent_meta_boxes(){
    add_meta_box( 'agent_info', 'Agent Informations', 'agent_meta_box_callback', 'agent', 'advanced', 'default' );
}
add_action( 'add_meta_boxes', 'agent_meta_boxes' );

function agent_meta_box_callback(){
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'agent_nonce' );
    $set_agent_company = '_agent_company';
    $get_agent_company = (get_post_meta( $post->ID, $set_agent_company, true ));
    $get_agent_company = ($get_agent_company) ? $get_agent_company : "";

    $set_agent_address = '_agent_address';
    $get_agent_address = (get_post_meta( $post->ID, $set_agent_address, true ));
    $get_agent_address = ($get_agent_address) ? $get_agent_address : "";
?>
    <div id="agent_info">
        <div class="meta-row post-<?php echo $post->ID; ?>">
            <div class="meta-td">
                <label for="<?php echo $set_agent_company; ?>">Agent Company: </label>
                <input type="text" name="<?php echo esc_attr($set_agent_company); ?>" id="<?php echo $set_agent_company; ?>" value="<?php echo esc_attr($get_agent_company); ?>" />
            </div>

            <div class="meta-td">
                <label for="<?php echo $set_agent_address; ?>">Agent Address: </label>
                <input type="text" name="<?php echo esc_attr($set_agent_address); ?>" id="<?php echo $set_agent_address; ?>" value="<?php echo esc_attr($get_agent_address); ?>" />
            </div>
        </div>
    </div><!-- /#agent_info -->
    <?php
}

function agent_meta_save( $post_id ){
    // Checks save status
    $is_autosave    = wp_is_post_autosave( $post_id );
    $is_revision    = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST['agent_nonce'] ) && wp_verify_nonce( $_POST['agent_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if( $is_autosave || $is_revision || !$is_valid_nonce ){ return; }

    // Update post meta
    $agent_company = '_agent_company';
    if( isset( $_POST[$agent_company] ) ){
        if ( ! add_post_meta( $post_id, $agent_company, sanitize_text_field( $_POST[$agent_company] ), true ) ) { 
           update_post_meta ( $post_id, $agent_company, sanitize_text_field( $_POST[$agent_company] ) );
        }
    }

    $agent_address = '_agent_address';
    if( isset( $_POST[$agent_address] ) ){
        if ( ! add_post_meta( $post_id, $agent_address, sanitize_text_field( $_POST[$agent_address] ), true ) ) { 
           update_post_meta ( $post_id, $agent_address, sanitize_text_field( $_POST[$agent_address] ) );
        }
    }
}
add_action( 'save_post', 'agent_meta_save' );

function agent_meta_box_style(){
    $screen = get_current_screen();
    $post_type = $screen->post_type;
    if( $post_type=='agent' && is_admin() ){ ?>
        <style type="text/css">
        div#agent_info div.meta-row{ padding: 5px 0 0; margin: 0; }
        div#agent_info div.meta-row:after { content: ''; clear: both; display: block; width: 100%;}
        div#agent_info div.meta-td {margin: 10px 0;padding: 0;line-height: 1.3;width: 100%;float: left;display: flex;flex-wrap: nowrap;}
        div#agent_info label {display: block;padding: 8px 10px;font-size: 14px;font-weight: 600;background: #F9F9F9;flex-basis: 160px;border: 1px solid #E1E1E1;border-right-width: 0;}
        div#agent_info input, div#agent_info select, div#agent_info textarea {width: 100%;float: left;margin: 0;}
        div#agent_info p.howto{ margin-top: 0; margin-bottom: 0; clear: both;}
        div#agent_info input[type="radio"] {width: auto;margin-top: -1px;}
        </style>
    <?php 
    }
}
add_action( 'admin_head', 'agent_meta_box_style' );
#---------- Adding Agents Meta Field ----------#


#---------- Adding custom meta field ----------#
# https://wptheming.com/2010/08/custom-metabox-for-post-type
function my_meta_boxes(){
	add_meta_box( 
		'my_meta_box',			// id
		'My Meta Box',			// title
		'my_meta_box_callback', // callback
		'post',					// page => post_type
		'normal',				// context => normal, advanced, side
		'high'					// priority => default, high, low, core
	);
}
add_action( 'add_meta_boxes', 'my_meta_boxes' );

function my_meta_box_callback( $post ){
	wp_nonce_field( basename( __FILE__ ), 'my_nonce' );
	$set_post_subtitle = '_post_subtitle'; // must be ( _ ) underscore symbol!
	$get_post_subtitle = get_post_meta( $post->ID, $set_post_subtitle, true );
	$get_post_subtitle = ($get_post_subtitle) ? $get_post_subtitle : '';

	$set_show_thumbnail = '_show_thumbnail';
	$get_show_thumbnail = get_post_meta( $post->ID, $set_show_thumbnail, true );

	$set_show_title = '_show_title';
	$get_show_title = get_post_meta( $post->ID, $set_show_title, true );

?>
	<div id="myMetaBox">
		<div class="meta-row">
			<div class="meta-th">
				<label for="<?php echo esc_attr($set_post_subtitle); ?>">Post Subtitle</label>
			</div>
			<div class="meta-td">
				<input type="text" name="<?php echo esc_attr($set_post_subtitle); ?>" id="<?php echo esc_attr($set_post_subtitle); ?>" value="<?php echo esc_attr($get_post_subtitle); ?>" />
				<p class="howto">This is my custom meta box...</p>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="<?php echo esc_attr($set_show_thumbnail); ?>">Show Post Thumbnail</label>
			</div>
			<div class="meta-td">
				<input type="checkbox" name="<?php echo esc_attr($set_show_thumbnail); ?>" id="<?php echo esc_attr($set_show_thumbnail); ?>" value="1" <?php checked( '1', $get_show_thumbnail, true ); ?> />
				<p class="howto">This is meta box field description...</p>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="">Show Post Title</label>
			</div>
			<div class="meta-td">
				<label>
					<input type="radio" name="<?php echo esc_attr($set_show_title); ?>" id="<?php echo esc_attr($set_show_title); ?>" value="1" <?php checked( '1', $get_show_title, true ); ?> />
					Yes
				</label>

				<label>
					<input type="radio" name="<?php echo esc_attr($set_show_title); ?>" id="<?php echo esc_attr($set_show_title); ?>" value="0" <?php checked( '0', $get_show_title, true ); ?> />
					No
				</label>

				<p class="howto">This is meta box field description...</p>
			</div>
		</div>
	</div><!-- /#myMetaBox -->
	<?php
}

function my_meta_save( $post_id ){
	// Checks save status
	$is_autosave    = wp_is_post_autosave( $post_id );
	$is_revision    = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['my_nonce'] ) && wp_verify_nonce( $_POST['my_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if( $is_autosave || $is_revision || !$is_valid_nonce ){
		return;
	}

	// Update post meta
	if( isset( $_POST['_post_subtitle'] ) ){
		update_post_meta( $post_id, '_post_subtitle', sanitize_text_field( $_POST['_post_subtitle'] ) );
	}

	if( isset( $_POST['_show_thumbnail'] ) ){
		update_post_meta( $post_id, '_show_thumbnail', sanitize_text_field( $_POST['_show_thumbnail'] ) );
	}else{
		delete_post_meta( $post_id, '_show_thumbnail' );
	}

	if( isset( $_POST['_show_title'] ) ){
		update_post_meta( $post_id, '_show_title', sanitize_text_field( $_POST['_show_title'] ) );
	}
}
add_action( 'save_post', 'my_meta_save' );

function my_meta_box_style(){
	$screen = get_current_screen();
	$post_type = $screen->post_type;
	if( $post_type=='post' && is_admin() ){ ?>
		<style type="text/css">
		div#myMetaBox div.meta-row{ padding: 1.8em 0; margin: 0 0 .8em; }
		div#myMetaBox div.meta-row:after { content: ''; clear: both; display: block; width: 100%;}
		div#myMetaBox div.meta-th{ width: 18%; padding: 0 2% 0 0; color: #222; float: left; font-weight: 600; }
		div#myMetaBox div.meta-th{ line-height: 1.3; vertical-align: top; }
		div#myMetaBox div.meta-td{ margin-bottom: 0; padding: 0; line-height: 1.3; width: 80%; float: right; }
		div#myMetaBox label{ display: block; padding: 5px 0px; font-size: 14px; }
		div#myMetaBox input, div#myMetaBox select, div#myMetaBox textarea{ width: 100%; }
		div#myMetaBox input[type="checkbox"], div#myMetaBox input[type="radio"] {width: auto;margin: 6px 0 8px;}
		div#myMetaBox p.howto{ margin-top: 0; margin-bottom: 0; }
		</style>
	<?php 
	}
}
add_action( 'admin_head', 'my_meta_box_style' );
#---------- Adding custom meta field ----------#





#---------- Adding taxonomy custom field ----------#
/*
	@Credit: < !-- https://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies --> 
	#Credit: < !-- https://gist.github.com/shizhua/4f5f7cf4f353a1bcac5b --> 
	@Add category subtitle field.
*/
class Custom_Field_For_Category {
	
	function __construct(){
		// Adding
		add_action( 'category_add_form_fields', array( $this, 'add_tax_subtitle_field' ) );
		add_action( 'category_edit_form_fields', array( $this, 'edit_tax_subtitle_field' ) );

		// Saving
		add_action( 'create_category', array( $this, 'save_subtitle_field' ), 10, 2 );
		add_action( 'edited_category', array( $this, 'save_subtitle_field' ), 10, 2 );
	}

	public function add_tax_subtitle_field(){
	?>
		<div class="form-field">
			<label for="term_meta[tax_subtitle]">Category Subtitle</label>
			<input type="text" name="term_meta[tax_subtitle]" id="term_meta[tax_subtitle]" placeholder="Enter Subtitle..." />
			<p class="description">Add your term subtitle here...</p>
		</div>
	<?php
	}

	public function edit_tax_subtitle_field( $term ){
		$term_id   = $term->term_id;
		$term_meta = get_option( "tax_$term_id" );
		$subtitle  = $term_meta['tax_subtitle'] ? $term_meta['tax_subtitle'] : '';
	?>
		<tr class="form-field">
			<th scope="row">
				<label for="term_meta[tax_subtitle]">Category Subtitle</label>
			</th>
			<td>
				<input type="text" name="term_meta[tax_subtitle]" id="term_meta[tax_subtitle]" value="<?php echo esc_html( $subtitle ); ?>" />
				<p class="description">Add your term subtitle here...</p>
			</td>
		</tr>
	<?php
	}

	public function save_subtitle_field( $term_id ){
		if( isset( $_POST['term_meta'] ) ){
			$term_id   = $term_id;
			$term_meta = array();
			$term_meta['tax_subtitle'] = isset( $_POST['term_meta']['tax_subtitle'] ) ? esc_html( $_POST['term_meta']['tax_subtitle'] ) : '';
			update_option( "tax_$term_id", $term_meta );
		}
	}
}
$custom_field_for_category = new Custom_Field_For_Category();

/*
	foreach ($terms as $term) {
		$term_id = $term->term_id;
		
		$term_name = $term->name;

		$subtitle = get_option("subtitle_$term_id");

		$subtitle = $subtitle ? $subtitle['tax_subtitle'] : 'No Example';

		echo 'Title: '.$term_name.' -----::----- Subtitle: '.$subtitle."<br>";
	}
*/

#---------- Adding taxonomy custom field ----------#



#---------- Adding posts featured image column ----------#
# https://webdevdoor.com/wordpress/featured-image-pages-posts
// for post_type=post
function add_thumbnail_column($columns){
	$my_column = array();
	// Put the Thumbnail column before the Title column
	foreach($columns as $key => $title) {
		if ($key=='title'){
			$my_column['my_post_thumb'] = __('Thumbnail');
		}
		$my_column[$key] = $title;
	}
	return $my_column;
}
add_filter('manage_post_posts_columns', 'add_thumbnail_column', 5);
 
 
function display_thumbnail_column( $column_name, $post_id ){
	switch($column_name){
	    case 'my_post_thumb':
			$post_thumbnail_id = get_post_thumbnail_id($post_id);
			if ($post_thumbnail_id) {
				$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
				echo '<img width="100" src="' . $post_thumbnail_img[0] . '" />';
			}else{
				$default_thumbnail_img = get_template_directory_uri().'/img/default-image.png';
				echo '<img width="100" src="' . $default_thumbnail_img . '" />';
			}
		break;
	}
}
add_action('manage_post_posts_custom_column', 'display_thumbnail_column', 5, 2);
#---------- Adding posts featured image column ----------#


#---------- Adding taxonomy subtitle column ----------#
# https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_$taxonomy_id_columns
// for taxonomy=category
function add_subtitle_column( $columns ){
	$my_column = array();
	// Put the Subtitle column before the Description column
	foreach($columns as $key => $title) {
		if ($key=='description'){
			$my_column['subtitle'] = __('Subtitle');
		}
		$my_column[$key] = $title;
	}
	return $my_column;
}
add_filter( 'manage_edit-category_columns', 'add_subtitle_column' );

function display_subtitle_column( $content, $column_name, $term_id ){
	if ( $column_name == 'subtitle' ) {
		$subtitle = get_option("subtitle_".$term_id);
		$content = $subtitle["tax_subtitle"];
	}
	return $content;
}
add_filter( 'manage_category_custom_column', 'display_subtitle_column', 10, 3 );
#---------- Adding taxonomy subtitle column ----------#



#---------- Adding category multiple custom meta field ----------#
function category_fields(){
	return array(
		'subtitle' => 'Subtitle',
		'facebook' => 'Facebook',
		'twitter'  => 'Twitter',
		'youtube'  => 'Youtube',
	);
}

function category_add_form_fields_callback(){
?>
	<div class="form-field term-extra-wrap">
		<h2>Category Extra Fields</h2>
		<?php 
			wp_nonce_field( basename(__FILE__), 'category_field_nonce' );
			$term_meta = category_fields();
		?>
		<?php foreach( $term_meta as $meta_key => $meta_value ) : $meta_key = 'term-'.$meta_key; ?>
			<label for="<?php echo $meta_key; ?>"><?php echo $meta_value; ?></label>
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" placeholder="<?php echo $meta_value; ?>" />
			<br/><br/>
		<?php endforeach; ?>
	</div>

<?php
}
add_action( 'category_add_form_fields', 'category_add_form_fields_callback' );

function category_save_form_fields_callback( $term_id ){
	// Check nonce
	if( ! isset( $_POST['category_field_nonce'] ) ){
		return;
	}

	// Verify nonce
	if( ! wp_verify_nonce( $_POST['category_field_nonce'], basename(__FILE__) ) ){
		return;
	}

	// Get meta fields
	$term_meta = category_fields();
	foreach( $term_meta as $meta_key => $meta_value ){
		$meta_key = 'term-'.$meta_key;
		if( isset( $_POST[$meta_key] ) ){
			add_term_meta( $term_id, $meta_key, $_POST[$meta_key], true );
			update_term_meta( $term_id, $meta_key, $_POST[$meta_key] );
		}
	}
}
add_action( 'create_category', 'category_save_form_fields_callback' );
add_action( 'edit_category', 'category_save_form_fields_callback' );

function category_edit_form_fields_callback( $term ){
?>

	<tr class="form-field">
		<th colspan="2"><h2>Category Extra Fields</h2></th>
	</tr>
	<?php 
		wp_nonce_field( basename(__FILE__), 'category_field_nonce' );
		$term_meta = category_fields();
	?>
	<?php foreach( $term_meta as $meta_key => $meta_value ) : $meta_key = 'term-'.$meta_key; ?>
		<tr class="form-field <?php echo $meta_key; ?>-wrap">
			<?php 
				$meta_data = get_term_meta( $term->term_id, $meta_key, true );
				$meta_data = ( ! empty($meta_data) ) ? $meta_data : '' ;
			?>
			<th scope="row">
				<label for="<?php echo $meta_key; ?>"><?php echo $meta_value; ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo $meta_data; ?>" />
			</td>
		</tr>
	<?php endforeach; ?>

<?php
}
add_action( 'category_edit_form_fields', 'category_edit_form_fields_callback' );
#---------- Adding category multiple custom meta field ----------#

?>