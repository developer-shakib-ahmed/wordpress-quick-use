jQuery(document).ready(function( $ ){

  document.addEventListener( 'wpcf7submit', function( event ) {
    var inputs = event.detail.inputs;

    let invalid_fields = event.detail.invalid_fields;
  
    console.log(invalid_fields);

    for ( var i = 0; i < inputs.length; i++ ) {
      // console.log(inputs[i]);
    }

  }, false );


  console.log('-Done-');
});