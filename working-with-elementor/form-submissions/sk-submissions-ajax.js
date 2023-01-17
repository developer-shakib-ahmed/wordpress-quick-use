/**
 * Do some cool things after submission updated successfully
 * 
 * @param data 
 * 
 * @returns boolean
 */
function sk_get_submission_update_data( data = null ) {
  let skData = data;

  const skObj = {
    form_action: skData.action,
    form_method: skData.method,
  };

  skObj.submission_id = skObj.form_action.match(/([^#/])*$/gi)[0];
  
  console.log( 'Loading...' );
    
  jQuery.post(
    skAjaxObj.ajaxurl,
    {
      action       : skAjaxObj.action,
      _ajax_nonce  : skAjaxObj.nonce,
      submission_id: skObj.submission_id,
    },
    function (data, textStatus, jqXHR) {
      console.log( data );
      console.log( textStatus );
      console.log( jqXHR.status );
      console.log( jqXHR.statusText );
    }
  )
  .fail( function( skAjaxError ) {
    console.log( 'Ajax post error: ' + skAjaxError.status + ' -> ' + skAjaxError.statusText );
  });
}