/*
  https://geeker.co/contact/
*/


// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
  $.fn.inputFilter = function(callback, errMsg) {
    return this.on('input keydown keyup mousedown mouseup select contextmenu drop focusout', function(e) {
      if (callback(this.value)) {
        // Accepted value
        if (['keydown','mousedown','focusout'].indexOf(e.type) >= 0){
          $(this).removeClass('input-error');
          this.setCustomValidity('');
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty('oldValue')) {
        // Rejected value - restore the previous one
        $(this).addClass('input-error');
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = '';
      }
    });
  };
}(jQuery));


jQuery(document).ready(function () {
  if( jQuery('body').hasClass('page-id-5852') ){
    jQuery('#form-field-firstname').inputFilter(function(value) { return /^[a-z]*$/i.test(value); }, 'Must use alphabetic characters');
    jQuery('#form-field-lastname').inputFilter(function(value) { return /^[a-z]*$/i.test(value); }, 'Must use alphabetic characters');
  console.log('-Done-');
});