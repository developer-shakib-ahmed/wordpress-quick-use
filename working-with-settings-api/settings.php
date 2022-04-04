<?php


#----- Admin Sub Menu Register -----#

// Update With WP Built-In Function

function custom_admin_submenu(){
	//Add Settings Sub Page

	$page_title        = 'Custom Section';
	$menu_title        = $page_title;
	$capability        = 'manage_options';
	$menu_slug         = strtolower(str_replace(' ', '_', $page_title));
	$callback_function = 'add_options_page_callback';

	add_options_page( $page_title, $menu_title, $capability, $menu_slug, $callback_function );
}
add_action( 'admin_menu', 'custom_admin_submenu' );


function custom_admin_submenu_init() {
	$setting_page = 'custom_section';
	$section_1 = 'custom_submenu_section_1';

    register_setting( 'custom_submenu_form', 'custom_submenu_data' );

    add_settings_section( $section_1, 'Custom Section 1', 'custom_submenu_section_1_callback', $setting_page );

    add_settings_field( 
    	'custom_text_field_1',
    	'Your Name', 'custom_text_field_1_callback',
    	$setting_page, $section_1,
    	array( 'label_for' => 'name' )
    );
}
add_action( 'admin_init', 'custom_admin_submenu_init' );


function custom_submenu_section_1_callback(){
	return true;
}


function custom_text_field_1_callback(){
	$option = get_option( 'custom_submenu_data' );
	$name   = (esc_attr( $option['name'] )) ? esc_attr( $option['name'] ) : '';
	echo "<input type='text' id='name' name='custom_submenu_data[name]' value='".$name."' class='regular-text' />";
}


function add_options_page_callback(){
?>
<div class="wrap">
	<h1>Custom Section Panel</h1>
	
	<form action="options.php" method="post">
		<?php
			settings_fields( 'custom_submenu_form' );
			do_settings_sections( 'custom_section' );
			submit_button();
		?>

	</form>
</div>
<?php
}
#----- Admin Sub Menu Register -----#


?>