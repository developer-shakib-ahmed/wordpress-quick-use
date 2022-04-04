<?php 


// for function.php
# ---- cmb2 include functions  ---- #
if(file_exists( dirname( __FILE__ ) . '/cmb2/init.php' )){
	require_once( 'cmb2/init.php' );
}

if(file_exists( dirname( __FILE__ ) . '/cmb2/cmb2-functions.php' )){
	require_once( 'cmb2/cmb2-functions.php' );
}
# ---- cmb2 include functions  ---- #

# ---- cmb2 include functions  ---- #
if(file_exists( dirname( __FILE__ ) . '/cmb2/init.php' )){
	require_once( dirname( __FILE__ ) . '/cmb2/init.php' );
}

if(file_exists( dirname( __FILE__ ) . '/cmb2/cmb2-functions.php' )){
	require_once( dirname( __FILE__ ) . '/cmb2/cmb2-functions.php' );
}
# ---- cmb2 include functions  ---- #


# ---- cmb2 include functions  ---- #
require_once( 'cmb2/init.php' );
require_once( 'cmb2/cmb2-functions.php' );
# ---- cmb2 include functions  ---- #




// for index.php

// get data from cmb2
$id = get_the_ID();
$prefix = '_meta_id_';
$text = get_post_meta( $id, $prefix.'text', true );



# ------- cmb2_output_file_list ------------ #
// cmb2_output_file_list
function cmb2_output_file_list( $file_list_meta_key, $img_size = 'medium' ) {
	// Get the list of files
	$files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );
	$fileListOutput = '';

	$fileListOutput .= '<div class="file-list-wrap">';
	// Loop through them and output an image
		foreach ( (array) $files as $attachment_id => $attachment_url ) {
			$prepare_attachment = wp_prepare_attachment_for_js( $attachment_id );
			$title = $prepare_attachment['title'];
			$caption = wp_get_attachment_caption( $attachment_id );
			$alt = get_post_meta( $attachment_id );
			$desc = '';
			$fileListOutput .= '<div class="file-list-image">';
				$fileListOutput .= wp_get_attachment_image( $attachment_id, $img_size );
				$fileListOutput .= '<p>Title: <b>'.$title.'</b></p>';
				$fileListOutput .= '<p>Caption: <b>'.$caption.'</b></p>';
				$fileListOutput .= '<p>Alt Text: <b>'.$alt['_wp_attachment_image_alt']['0'].'</b></p>';
				$fileListOutput .= '<p>Description: <b>'.$desc.'</b></p>';
			$fileListOutput .= '</div>';
		}
	$fileListOutput .= '</div>';

	echo $fileListOutput;

} // cmb2_output_file_list( $prefix.'file', 'thumbnail' );
# ------- cmb2_output_file_list ------------ #














?>