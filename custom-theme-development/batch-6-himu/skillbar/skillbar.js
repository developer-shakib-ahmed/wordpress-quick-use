
jQuery(document).ready(function(){

	var skillbar = jQuery('div.skillbar');

	//alert(skillbar.length);

	skillbar.each(function(i) {

		var percent = jQuery(this).find('span.percent');

		jQuery(this).find('span.progress').animate( { width: percent.text() }, 10000 );

	});

});


















