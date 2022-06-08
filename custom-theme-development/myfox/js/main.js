jQuery(document).ready(function($){
	$.scrollUp();	
});
// End scrollUp active js

jQuery(document).ready(function($) {
	var s = $("#sticker");
	var pos = s.position();
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		 if (windowpos >= pos.top) {
		 	s.addClass("stick");
		 } else {
		 	s.removeClass("stick");
		 }
		});
});	
// End stick a div active js

/*slicknav mobile menu active code*/
jQuery(document).ready(function($){
	$('#nav').slicknav();
});


// owl-carousel(random) active code
jQuery(document).ready(function($) {
 
  //Sort random function
  function random(owlSelector){
    owlSelector.children().sort(function(){
        return Math.round(Math.random()) - 0.5;
    }).each(function(){
      $(this).appendTo(owlSelector);
    });
  }
 
  $("#owl-demo").owlCarousel({
    navigation: true,
    navigationText: [
      "<i class='icon-chevron-left icon-white'></i>",
      "<i class='icon-chevron-right icon-white'></i>"
      ],
    beforeInit : function(elem){
      //Parameter elem pointing to $("#owl-demo")
      random(elem);
    }

  });



 
  $("#owl-demo2").owlCarousel({
 
      navigation : true, // Show next and prev buttons
      navigationText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>"
      ],
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true
 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
 

 




    jQuery(function($){
      $.stellar({
        horizontalScrolling: false,
        verticalOffset: 40
      });
    });



 
});


jQuery(document).ready(function(){

      jQuery("div.search_box a").click(function(){
        jQuery(this).addClass("active");
        jQuery("div.show_search_box").toggle(300);
      });

});





