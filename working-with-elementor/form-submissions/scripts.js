/*
  https://www.the-art-of-web.com/javascript/validate-date/
*/

jQuery(window).on('load', function () {
  if (window.innerWidth <= 767) {
    let flatpickrInput = jQuery('.flatpickr-input.flatpickr-mobile');

    flatpickrInput.focusout(function () {
      if(jQuery(this).val().length > 0){
        flatpickrInput.addClass('hasValue');
      }else{
        flatpickrInput.removeClass('hasValue');
      }
    });

    
    const priceObj = {
      'form-field-passengers': [10, 20, 30],
      'form-field-luggages': [5, 15]
    }

    let selectFields = jQuery('form select');
    selectFields.change(function( e ){
      const priceData = [];

      selectFields.each(function(i){
        priceData.push(priceObj[selectFields[i].id][selectFields[i].selectedIndex]);
      });

      console.log(priceData.reduce( (a, b) => a + b, 0 ));
    });

  }
  console.log('-Loaded-');
});

jQuery(document).ready(function () {
  jQuery('input#form-field-name').focusout(function () {
    console.log(jQuery(this).val());
  });

  console.log('-Done-');
});