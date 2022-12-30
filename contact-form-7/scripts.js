jQuery(document).ready(function( $ ){

  document.addEventListener( 'wpcf7submit', function( event ) {
    let invalid_fields = event.detail.apiResponse.invalid_fields;
  
    console.log(invalid_fields);

    for ( var i = 0; i < invalid_fields.length; i++ ) {
      console.log(invalid_fields[i].field);

      jQuery('form span[data-name="'+ invalid_fields[i].field +'"]').append('<span style="display: block;color: red;font-weight: bold;">This is field cannot be empty!</span>');
    }

  }, false );


  let wpcf7Checkbox = jQuery('form input[type="checkbox"]');
  let wpcf7TextField = jQuery('form .wpcf7-text');
  let ansVal = jQuery('form .answered');

  wpcf7TextField.focusout(function(e){
    if( e.target.name == 'your-name' ){
      if( jQuery(this).val().length <= 0 ){
        ansObj['q_card_1'] = false;
      }else{
        ansObj['q_card_1'] = true;
      }
    }

    if( e.target.name == 'your-email' ){
      if( jQuery(this).val().length <= 0 ){
        ansObj['q_card_2'] = false;
      }else{
        ansObj['q_card_2'] = true;
      }
    }

    console.log(e.target.name);
    console.log(ansObj);

    const countResult = Object.keys(ansObj).reduce((o, key) => {
      ansObj[key] !== false && (o[key] = ansObj[key]);
      return o;
    },{});

    ansVal.text(Object.keys(countResult).length);

  });

  wpcf7Checkbox.on('change', function(e) {
    let currentField = jQuery('input[name="'+e.target.name+'"]');
    let currentFieldParent = currentField.closest('.wpcf7-form-control-wrap');

    let atleastOneCheck = Array.prototype.slice.call(currentField).some(x => x.checked);

    if( e.target.name == 'checkbox-1[]' ){
      if(!atleastOneCheck) {
        currentFieldParent[0].append('<span style="display: block;color: red;font-weight: bold;">This is field cannot be empty!</span>');
        ansObj['q_card_3'] = false;
      }else{
        ansObj['q_card_3'] = true;
      }
    }

    if( e.target.name == 'your-fruits[]' ){
      if(!atleastOneCheck) {
        currentFieldParent[0].append('<span style="display: block;color: red;font-weight: bold;">This is field cannot be empty!</span>');
        ansObj['q_card_4'] = false;
      }else{
        ansObj['q_card_4'] = true;
      }
    }

    const countResult = Object.keys(ansObj).reduce((o, key) => {
      ansObj[key] !== false && (o[key] = ansObj[key]);
      return o;
    },{});

    ansVal.text(Object.keys(countResult).length);
    
  });

  const ansObj = {
    q_card_1: false,
    q_card_2: false,
    q_card_3: false,
    q_card_4: false,
  }

  console.log('-Done-');
});







/*
https://www.techiedelight.com/count-number-check-boxes-javascript/
http://jsfiddle.net/RvH7R/
https://stackoverflow.com/questions/46585258/es6-filter-an-object-based-on-true-values
*/