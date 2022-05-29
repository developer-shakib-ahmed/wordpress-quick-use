jQuery(document).ready(function(){
	jQuery(document).on('click', 'a#image_upload', function(e){
		e.preventDefault();

		var image_uploader = wp.media({
			'title' : 'Custom Title Text',
			'button': {
				'text' : 'Custom Text', 
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

	jQuery(document).on('click', 'a#image_reset', function(){
		jQuery('input.image_receive').removeAttr('value');
		jQuery('div.display_image').fadeOut();
	});
});