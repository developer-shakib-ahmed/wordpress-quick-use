( function( $ ) {
  
  $(document).ready(function () {

    let btnUpdate  = $('#publishing-action');
    let btnActions = $('.e-form-submissions-main__header .button');

    btnActions.click(function (e) {

      console.log(e.traget);
    
    });

    btnUpdate.click(function (e) { 
      e.preventDefault();
      console.log(e.traget);
    });
    
    console.log( '- Shakib -' );

  });

  

} )( jQuery );


function sk_get_submission_update_data( data = null ) {
  let skData = data;

  const skObj = {
    action: skData.action,
    method: skData.method,
  };

  console.log( skObj );

  console.log( 'Submission has been successfully updated.' );
}