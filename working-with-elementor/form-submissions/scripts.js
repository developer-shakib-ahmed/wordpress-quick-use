jQuery(window).on('load', function () {
  if (window.innerWidth <= 767) {
    let flatpickrInput = jQuery('.flatpickr-input.flatpickr-mobile');

    flatpickrInput.focusout(function () {
      if(jQuery(this).val().length > 0){
        flatpickrInput.addClass('hasValue');
      }else{
        flatpickrInput.removeClass('hasValue');
      }
      console.log('Length: ' + jQuery(this).val().length);
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