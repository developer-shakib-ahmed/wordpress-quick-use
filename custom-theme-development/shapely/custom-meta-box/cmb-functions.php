<?php


/* START SECTIONS ONE  *******************************************************************************************************/
add_action( 'cmb2_admin_init', 'yourprefix_register_demo_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function yourprefix_register_demo_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'post',
		'title'         => __( 'Post Metabox', 'cmb2' ),
		'object_types'  => array( 'post', ), // Custom post type
	) );

	$cmb_demo->add_field( array(
		'name'             => __( 'Text Box', 'cmb2' ),
		'desc'             => __( 'field description (optional)', 'cmb2' ),
		'id'               => $prefix . 'textBox',
		'type'             => 'text',
		'default' 		   => 'Default Text',
	) );
	// End post meta box here.....................................................
 



	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'page',
		'title'         => __( 'Page Metabox', 'cmb2' ),
		'object_types'  => array( 'page', ), // Custom post type
	) );

	$cmb_demo->add_field( array(
		'name'             => __( 'Text Box', 'cmb2' ),
		'desc'             => __( 'field description (optional)', 'cmb2' ),
		'id'               => $prefix . 'textBox',
		'type'             => 'text',
		'default' 		   => 'Default Text',
	) );
	// End page meta box here.....................................................



	
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'domain_items',
		'title'         => __( 'Domains Item Metabox', 'cmb2' ),
		'object_types'  => array( 'domains', ), // Custom post type
	) );

	$cmb_demo->add_field( array(
	    'name'             => 'Domain Select',
	    'desc'             => 'Select a domain',
	    'id'               => 'domainSelect',
	    'type'             => 'select',
	    'options'          => array(
	        '.com'	 => '.com',
	        '.net'   => '.net',
	        '.org'   => '.org',
	        '.info'  => '.info',
	        '.co.uk' => '.co.uk',
	        '.co.za' => '.co.za',
	        '.es'  	 => '.es',
	        '.de'    => '.de',
	        '.me'    => '.me',
	        '.eu'    => '.eu',
	        '.co'    => '.co',
	        '.gtld'  => '.gtld',
	    ),
	) );

	$cmb_demo->add_field( array(
	    'name'    => 'Registered TLDS',
	    'desc'    => 'field description (optional)',
	    'id'      => 'multiDomain',
	    'select_all_button' => true,
	    'type'    => 'multicheck',
	    'options'          => array(
	        '.com'	 => '.com',
	        '.net'   => '.net',
	        '.org'   => '.org',
	        '.info'  => '.info',
	        '.co.uk' => '.co.uk',
	        '.co.za' => '.co.za',
	        '.es'  	 => '.es',
	        '.de'    => '.de',
	        '.me'    => '.me',
	        '.eu'    => '.eu',
	        '.co'    => '.co',
	        '.gtld'  => '.gtld',
	    ),
	) );

	$cmb_demo->add_field( array(
	    'name'    => 'Keyword Box',
	    'desc'    => 'field description (optional)',
	    'default' => 'domain key word',
	    'id'      => 'keyWord',
	    'type'    => 'text',
	) );

	$cmb_demo->add_field( array(
	    'name'    => 'Domain Length Box',
	    'desc'    => 'field description (optional)',
	    'default' => '0',
	    'id'      => 'length',
	    'type'    => 'text',
	) );

	$cmb_demo->add_field( array(
		'name'             => __( 'Price Box', 'cmb2' ),
		'desc'             => __( 'field description (optional)', 'cmb2' ),
		'id'               => 'priceBox',
		'type'             => 'text_small',
		'default' 		   => '0.00',
		'before' 		   => '$ ',
	) );

	$cmb_demo->add_field( array(
		'name'             => __( 'E-mail Box', 'cmb2' ),
		'desc'             => __( 'field description (optional)', 'cmb2' ),
		'id'               => 'emailBox',
		'type'             => 'text_email',
		'default' 		   => 'example@gmail.com',
	) );

	$cmb_demo->add_field( array(
	    'name'    => 'Phone Number Box',
	    'desc'    => 'field description (optional)',
	    'default' => '+880',
	    'id'      => 'phoneBox',
	    'type'    => 'text_medium'
	) );	

// End post meta box here.....................................................





	
}
/* END SECTIONS ONE  *******************************************************************************************************/