jQuery(document).ready(function(){
	//go to section start
	jQuery(function() {
		jQuery('header a[href*="#"]:not([href="#"])').click(function() {
		    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		      var target = jQuery(this.hash);
		      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
		      if (target.length) {
		        jQuery('html, body').animate({
		          scrollTop: target.offset().top-0
		        }, 500);
		        return false;
		      }
		    }
		});
	});
	//go to section end
	
	//slider
	jQuery('section.slider div.carousel').carousel({
		interval: 5000,
		pause: null,
	});
	//slider end
	
	jQuery('div.para1').hover(function(){
		jQuery('div.para i.fa-th').css("transform" , "rotate(360deg)  scale(1.1)");
	});
	jQuery('div.para1').mouseleave(function(){
		jQuery('div.para i.fa-th').css("transform" , "rotate(0deg)  scale(1)");
	});
	jQuery('div.para2').hover(function(){
		jQuery('div.para i.fa-html5').css("transform" , "rotate(360deg) scale(1.1)");
	});
	jQuery('div.para2').mouseleave(function(){
		jQuery('div.para i.fa-html5').css("transform" , "rotate(0deg) scale(1)");
	});
	jQuery('div.para3').hover(function(){
		jQuery('div.para i.fa-users').css("transform" , "rotate(360deg) scale(1.1)");
	});
	jQuery('div.para3').mouseleave(function(){
		jQuery('div.para i.fa-users').css("transform" , "rotate(0deg) scale(1)");
	});
	//parallax
	jQuery('section#services').parallax('50%', 0.3 );
	//parallax end
	
	//mixitup start
	var contentEl = jQuery('section#portfolio div.content');

	var mixer = mixitup(contentEl);
	//mixitup end
	
	// portfolio pop-up effect
	
	var popUp     = jQuery('div#popUp_content');
	var hidePopup = jQuery('span.cross, div#popUp_content');
	var showPopup = jQuery('div.overlay i.fa-search-plus');
	showPopup.click(function(){
		popUp.fadeIn('slow');
	});
	
	hidePopup.click(function(e){
		var findId    = e.target.id,
		    findClass = e.target.className;
			
			if( findId == 'popUp_content' || findClass == 'cross' ){
				popUp.fadeOut('slow');;
			}
	});
	//goto top start
	
	var top = jQuery('div.gototop');

	jQuery(window).scroll(function(){

		var topPosition = jQuery(this).scrollTop();

		jQuery('a.scroll').text(topPosition);

		if(topPosition >= 200){
			top.addClass('active');
		}else{
			top.removeClass('active');
		}
	});

	top.click(function(){
		jQuery('html, body').animate({
			scrollTop: 0,
		}, 500);
	});
	
	
	var ourCarousel = jQuery('div#carousel-1');
	ourCarousel.owlCarousel({
	    loop:true,
	    margin:30,
	    nav:true, // enables Next/Prev
	    navText:[ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
	    dots:false, // remove dots
	    lazyLoad:true,
	    autoplay:true,
	    autoplayTimeout:2000,
	    autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        500:{
	            items:2
	        },
			600:{
	            items:2
	        },
			992:{
				items:3
			},
	        1200:{
	            items:4
	        }
	    }
	});


	jQuery('li.search-trigger a').click(function(event) {
		event.preventDefault();
		jQuery('form#searchform').slideToggle();
	});
	
	
});