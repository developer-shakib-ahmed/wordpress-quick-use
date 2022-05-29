jQuery(document).ready(function(){
	jQuery(document).on('click', 'a#image_upload', function(e){
		e.preventDefault();

		var image_uploader = wp.media({
			'title' : 'About Me Image',
			'button': {
				'text' : 'Set the image', 
			},
			'multiple' : false,  
		});

		image_uploader.open();

		image_uploader.on('select', function(){
			var image = image_uploader.state().get('selection').first().toJSON();
			var image_src = image.url;

			jQuery('input.image_receive').val(image_src);
			jQuery('div.display_image img').attr('src', image_src);
		});

	});

	jQuery(document).on('click', 'a#custom_icons', function(){
		jQuery('div.custom_icons').slideToggle();
	});
});