<?php

#----- Customizer API ---------------#
function shop_customizer_options($objectArgs){

	$objectArgs->add_section('general_options', array(
		'title'	    =>	'General Options',
		'priority'	=>	10,
	));

	$objectArgs->add_setting('copyright_text', array(
		'type' 		=> 'theme_mod', // or 'option'
		'default'	=>	'Enter your copyright text',
		'transport'	=>	'refresh', // or postMessage
	));

	$objectArgs->add_control('copyright_text', array(
		'priority'	  => 10, // Within the section.
		'section'	  =>	'general_options',  // section id
		'label'	      =>	'Copyright Text',
		'type'	      =>	'text',
	));

}
add_action( 'customize_register', 'shop_customizer_options' );

function shop_customizer_javaScript(){
	wp_enqueue_script( 'shop-customizer-preview-js', get_template_directory_uri().'/js/shop-customizer-preview.js', array('jquery', 'customize-preview'), 'v1.0', true );
}
#----- Customizer API ---------------#



function my_customizer_register( $wp_customize ){

    $wp_customize->add_panel( 'image_slider_panel', array(
        'priority'       => 210,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => 'Image Slider',
    ));		

	$loopLength = 5;

	for ($i=1; $i <= $loopLength; $i++) { 
		$wp_customize->add_section( 'image_section_'.$i, array(
			'title' => 'Slide '.$i,
			'panel' => 'image_slider_panel',
		));

		$wp_customize->add_setting( 'image_slide_'.$i, array(
			'type' => 'theme_mod',
			'default' => '',
			'transport' => 'postMessage',
		));
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control( $wp_customize, 'image_slide_'.$i, array(
				'section'     => 'image_section_'.$i,
				'label'       => 'Upload Image',
				'width'       => 400,
				'height'      => 400,
			))
		);
	}
}
add_action( 'customize_register', 'my_customizer_register' );

?>


<?php
	$loopLength = 5;
	for ($i=1; $i <= $loopLength ; $i++) { 
	?>
		<h1>Slider Image <?php echo $i; ?>: <br>
			<?php
				$url = wp_get_attachment_url(get_theme_mod( 'image_slide_'.$i ));
			?>
			<img src="<?php echo $url; ?>" alt="">
		</h1>
	<?php
	}
?>