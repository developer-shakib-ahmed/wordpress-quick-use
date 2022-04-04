jQuery(document).ready(function() {
	wp.customize('copyright_text', function(value){
		value.bind(function(to) {
			jQuery('div.copyright p').text(to);
		});
	});
});