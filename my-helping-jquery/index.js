jQuery(document).ready(function(){

	var width = jQuery('body').width();

	if(width<=750){
		jQuery('div.maths .icon').click(function(){
		    jQuery('div.maths .math_content').slideToggle();
		});
	}

});



// Ajax add to cart on the product page
// https://elartica.com/2017/08/03/woocommerce-ajax-add-cart-single-product-page/
var $warp_fragment_refresh = {
    url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
    type: 'POST',
    success: function( data ) {
        if ( data && data.fragments ) {
            jQuery.each( data.fragments, function( key, value ) {jQuery( key ).replaceWith( value );});
            jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
        }
    }
};

jQuery('.entry-summary form.cart').on('submit', function (e){
    e.preventDefault();
    jQuery('.entry-summary').block({message: null,overlayCSS: {cursor: 'none'}});
    var product_url = window.location,form = jQuery(this);
    jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result) {
        // update fragments
        jQuery.ajax($warp_fragment_refresh);
        jQuery('.entry-summary').unblock();
    });
});



// https://github.com/woocommerce/woocommerce/blob/master/assets/js/frontend/add-to-cart.js
jQuery(document).ready(function($) {

    jQuery( document.body ).on( 'adding_to_cart', function(){
        console.log('Product Adding');
    });

    jQuery( document.body ).on( 'added_to_cart', function(){
        console.log('Product Added');
    });

    jQuery( document.body ).on( 'removed_from_cart', function(){
        console.log('Product Removed');
    });

    jQuery(document.body).on('updated_cart_totals', function(){
        
    });

});


// http://www.vandelaydesign.com/delete-a-wordpress-post-using-ajax/
//https://quadmenu.com/add-to-cart-with-woocommerce-and-ajax-step-by-step/



// Ajax wishlist
jQuery(document).ready( function(){
    jQuery(document).on( 'added_to_wishlist removed_from_wishlist', function(){
        var counter = jQuery('div#header-outer span.wish-count');
        jQuery.ajax({
            url: yith_wcwl_l10n.ajax_url,
            data: {action: 'yith_wcwl_update_wishlist_count'},
            dataType: 'json',
            success: function( data ){counter.html( data.count );},
            // beforeSend: function(){counter.block();},
            // complete: function(){counter.unblock();}
        });
    });
});


// Ajax
jQuery(document).ajaxComplete(function() {
    
});

// Manually update checkout ajax
jQuery('body').trigger('update_checkout');


// Variation Price Hide/Show
jQuery(document).on('show_variation', function(event) {
    jQuery('.woocommerce-variation.single_variation').stop().removeAttr('style');
    jQuery('form.variations_form p.price').hide();
});

jQuery(document).on('hide_variation', function(event) {
    jQuery('.woocommerce-variation.single_variation').hide();
    jQuery('form.variations_form p.price').show();
});
// Variation Price Hide/Show



// DOM Create Function
window.create = function(){
    if(arguments.length === 0){return document.createElement('div');}
    var element = document.createElement(arguments[0]);
    for(var i in arguments[1]){element.setAttribute(i, arguments[1][i]);}
    return element;
};
// use: create('div', {'id':'idName'});


// DOM Onload Function
window.onload = function() {};


// Contact Form 7 Helping
jQuery('input.noRequired').each(function(index, el) {
    if(jQuery(this).val() == ''){
        jQuery(this).val('.');
    }
    jQuery(this).focusin(function(){
        if(jQuery(this).val() == '.'){
            jQuery(this).val('');
        }
    });
    jQuery(this).focusout(function(){
        if(jQuery(this).val() == ''){
            jQuery(this).val('.');
        }
    });
});
// Contact Form 7 Helping



var getReferenceURL = window.location.href;
var url = new URL(getReferenceURL);
var pdfReference = url.searchParams.get('pdf-reference');
if(pdfReference == null){
    jQuery('a#pdfDownload').click(function(event) {
        event.preventDefault();         
        alert('Please Submit Form Before Download!');
    });
}else{
    jQuery('a#pdfDownload').attr('href', jQuery('a#pdfDownload').attr('href') + pdfReference + '.pdf');
}

setTimeout(function(){
    jQuery('form input[type="checkbox"]').each(function(index, el){
        jQuery(this).attr('id', jQuery(this).attr('id')+index);
        var label = jQuery(this).next()[0];
        label.attributes[0].nodeValue = jQuery(this).attr('id');
        console.log(label);
    });
},1000);



if(jQuery('body').width() >= 1000){
 if(jQuery('body').hasClass('page-id-6344')){
     var menuNavigation = jQuery('div#menuNavigation');
     var headerSpace = jQuery('div#header-outer');
        var stickyOffset = menuNavigation.offset().top;
        jQuery(window).scroll(function(){
         var scroll = jQuery(window).scrollTop();
         if ( scroll >= (stickyOffset - headerSpace.outerHeight()) ){
             menuNavigation.addClass('fixed');
         }
         else{
             menuNavigation.removeClass('fixed');
         }
        });
    }
}



/* Menu Text Change On Hover */
jQuery(document).ready(function($) {
  var innerTxt, title, rect;
  jQuery('header#top ul.sf-menu li a').hover(function() {
    rect = jQuery(this)[0].getBoundingClientRect();
    innerTxt = jQuery(this).text();
    title = jQuery(this).attr('title');
    if(title !== undefined){
      jQuery(this).css('min-width', rect.width);
      jQuery(this).addClass('hover');
      jQuery(this).text(title);
    }
  },function() {
    jQuery(this).css('min-width', '');
    jQuery(this).removeClass('hover');
    jQuery(this).text(innerTxt);
  });
});
/* Menu Text Change On Hover */



/* Select to Custom Dropdown */
jQuery(document).ready(function($) {
    var customSelect = 'woocommerce-currency-switcher';
    jQuery('header select.'+customSelect).attr('id', 'header-currency-switcher');
    jQuery('li.off-canvas-language-and-currency select.'+customSelect).attr('id', 'off-canvas-currency-switcher');
    if( jQuery('select').hasClass(customSelect) ) {
        jQuery('select.'+customSelect).each(function(index, el) {
            var selectVal = jQuery('select#'+jQuery(this).attr('id')+' option:selected').html();
            jQuery(this).parent().append('<div class="selected-value" id="'+jQuery(this).attr('id')+'"></div>');
            if(jQuery(this).val()){
                jQuery(this).parent().find('div.selected-value').append('<span>'+selectVal+'</span>');
            }else{
                jQuery(this).parent().find('div.selected-value').append('<span>Select Option</span>');
            }
            
            jQuery(this).parent().find('div.selected-value').append('<ul class="'+jQuery(this).attr('class')+' '+customSelect+'-'+index+'" id="'+jQuery(this).attr('id')+'"></ul>');
            jQuery(this).find('option').each(function(index, el) {
                if(el.value){
                    if(jQuery(this).parent().val() == el.value){
                        jQuery('ul#'+jQuery(this).parent().attr('id')).append('<li class="selected" data-val="'+el.value+'" title="'+el.label+'">'+el.label+'</li>');
                    }else{
                        jQuery('ul#'+jQuery(this).parent().attr('id')).append('<li data-val="'+el.value+'" title="'+el.label+'">'+el.label+'</li>');
                    }
                }
            });
        });
    }

    if(jQuery('ul').hasClass(customSelect)){
        jQuery('ul.'+customSelect).each(function(index, el) {
            jQuery(this).find('li').each(function(index, el) {
                jQuery(this).click(function(event) {
                    jQuery('div#'+jQuery(this).parent().attr('id')).find('span').html(jQuery(this).html());
                    woocs_redirect(jQuery(this).attr('data-val'));
                    jQuery(this).parent().find('li').removeClass('selected');
                    jQuery(this).addClass('selected');
                });
            });
        });
    }
});
/* Select to Custom Dropdown */



/* scroll smooth with click */
jQuery(function() {
  jQuery('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html, body').animate({
          scrollTop: target.offset().top-0
        }, 1000);
        return false;
      }
    }
  });
});
/* scroll smooth with click */




/* Hide Element on Click AnyWhere */
// Method-1
jQuery(document).ready(function() {

    jQuery(document).click(function(event) {
        var eL = event.target;
        var popup = jQuery('div#headerLogin');
        if( eL.className == 'register-pop' || eL.className == 'show_login' ){event.preventDefault();popup.toggle();}
        else if( popup.is(eL) || popup.has(eL).length > 0 ){return true;}
        else{popup.hide();}
    });
    
});

// Method-2
jQuery(document).ready(function( $ ){
  jQuery(document).click(function(event) {
    var hamBurgerIcon = jQuery('div#hamBurgerIcon');
    var eL = event.target;
    var menu = jQuery('div#top-menu-wrap');
    if( eL.id == 'hamBurgerIcon' || eL.className == 'bar' ){
      event.preventDefault();
      hamBurgerIcon.toggleClass('close');
      menu.toggleClass('show');
    }else if( menu.is(eL) || menu.has(eL).length > 0 ){
      if( eL.id == 'top-menu-wrap' ){
        hamBurgerIcon.removeClass('close');
        menu.removeClass('show');
      }else{
        return true;
      }
    }else{
      hamBurgerIcon.removeClass('close');
      menu.removeClass('show');
    }    
  });
});
/* Hide Element on Click AnyWhere */


/* Advanced Search Select to Ul */
var customSelect = 'wpas-select';
var customSelectWrap = 'div.custom-select-wrap';
if( jQuery('select').hasClass(customSelect) ) {
  jQuery('select.'+customSelect).each(function(index, el) {
      var selectVal = jQuery('select#'+jQuery(this).attr('id')+' option:selected').html();
      jQuery(this).parent().append('<div class="selected-value custom-select-wrap" id="'+jQuery(this).attr('id')+'"></div>');
      if(jQuery(this).val()){
          jQuery(this).parent().find('div.selected-value').append('<span class="selected-text">'+selectVal+'</span>');
      }else{
          jQuery(this).parent().find('div.selected-value').append('<span>Select Option</span>');
      }

      jQuery(this).parent().find('div.selected-value').append('<ul class="'+jQuery(this).attr('class')+' '+customSelect+'-'+index+'" id="'+jQuery(this).attr('id')+'"></ul>');
      jQuery(this).find('option').each(function(index, el) {
          if(el.value){
              if(jQuery(this).parent().val() == el.value){
                  jQuery('ul#'+jQuery(this).parent().attr('id')).append('<li class="selected" val="'+el.value+'" title="'+el.label+'">'+el.label+'</li>');
              }else{
                  jQuery('ul#'+jQuery(this).parent().attr('id')).append('<li val="'+el.value+'" title="'+el.label+'">'+el.label+'</li>');
              }
          }
      });
  });
}

if(jQuery('ul').hasClass(customSelect)){
jQuery('ul.'+customSelect).each(function(index, el) {
  jQuery(this).find('li').each(function(index, el) {
    jQuery(this).click(function(event) {
      jQuery('div#'+jQuery(this).parent().attr('id')).find('span').html(jQuery(this).html());
      jQuery('select#'+jQuery(this).parent().attr('id')).val(jQuery(this).attr('val')).change();
      jQuery(this).parent().find('li').removeClass('selected');
      jQuery(this).addClass('selected');
      jQuery(customSelectWrap).removeClass('show');
    });
  });
});
}

jQuery(document).click(function(event) {
console.log(event.target.className);
if(event.target.className == 'selected-text'){
  jQuery(customSelectWrap).toggleClass('show');
}else{
  jQuery(customSelectWrap).removeClass('show');
}
});
/* Advanced Search Select to Ul */