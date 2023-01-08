/*
  https://www.the-art-of-web.com/javascript/validate-date/
*/

jQuery(window).on('load', function () {
  let selectFields = jQuery('form select');
  let totalPrice = jQuery('form #form-field-total_price');
  let landingTime = jQuery('form #form-field-landing_time');
  let isNight = false;

  const extraFee = 10;
  const hoursArray = ['22', '23', '00', '01', '02', '03', '04', '05'];
  const priceObj = {
    'form-field-passengers': [10, 20, 30],
    'form-field-luggages': [5, 15]
  }

  landingTime.on('input', function (e) {
    if (jQuery(this).val().length > 0) {
      let getHours = jQuery(this).val().substr(0, 2);

      if( hoursArray.includes( getHours ) ) {
        isNight = true;
      }
      else{
        isNight = false;
      }

      changePrice();
    }
    else {
      console.log('-Invalid Time-');
    }
  });

  selectFields.change(function (e) {
    changePrice();
  });


  // Create a custom price change function
  function changePrice() {
    const priceData = [];

    selectFields.each(function (i) {
      priceData.push(priceObj[selectFields[i].id][selectFields[i].selectedIndex]);
    });

    if (isNight) {
      priceData.push(extraFee);
    }

    totalPrice.val(priceData.reduce((a, b) => a + b, 0));

    console.log(priceData);
  }



  // work on mobile view
  if (window.innerWidth <= 767) {
    let flatpickrInput = jQuery('.flatpickr-input.flatpickr-mobile');

    flatpickrInput.focusout(function () {
      if(jQuery(this).val().length > 0){
        flatpickrInput.addClass('hasValue');
      }
      else{
        flatpickrInput.removeClass('hasValue');
      }
    });
  }

  console.log('-Loaded-');
});

jQuery(document).ready(function () {
  

  console.log('-Done-');
});