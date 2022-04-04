jQuery(document).ready(function() {
	var aps_wrap     = jQuery('div#aps_wrap'),
		apsForm      = aps_wrap.find('form'),
		apsContent   = aps_wrap.find('div.aps_content');
		aps_products = aps_wrap.find('ul#aps_products');
	apsForm.submit(function(event) {
		event.preventDefault();

		var aps_category = aps_wrap.find('select#aps_category').val(),
			aps_brand    = aps_wrap.find('select#aps_brand').val();
		var aps_data = {
			action   : 'aps',
			category : aps_category,
			brand    : aps_brand,
		};
		jQuery.ajax({
		  url: aps_url,
		  data: aps_data,
		  success: function(response) {
		  	console.log(response);
		  	aps_products.empty();
		  	for(var i=0; i<response.length; i++){
		  	  var li, id, title, permalink;
			  	  id        = response[i].id;
			  	  title     = response[i].title;
			  	  permalink = response[i].permalink;
			  	  li = '<li class="aps-product" id="product-'+id+'"><a href="'+permalink+'">'+title+'</a></li>';

		  	  aps_products.append(li);
		  	}
		  }
		});
		

	});
});