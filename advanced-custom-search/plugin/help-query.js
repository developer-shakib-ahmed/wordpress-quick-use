jQuery(document).ready(function($) {

	// Add All Option inside dropdown
	if(jQuery('body').hasClass('page-id-6558')){
		jQuery("#tax_coaches_tag").prepend(new Option("All Coaches", ""));
		jQuery('form#wp-advanced-search')[0].reset();
		jQuery('form#wp-advanced-search').each(function() {
		    jQuery(this).submit();
		    return false;
		});
	}


	// Add First Option Label
	if(jQuery('body').hasClass('page-id-53106')){
		jQuery("select#tax_illustrated_parts_type option[value]:first").text("All Parts Type");
      	// jQuery('form#wp-advanced-search')[0].reset();
		// jQuery('form#wp-advanced-search').submit();
	}
});