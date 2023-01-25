( function( $ ) {

  console.log('Hello from Academy');

  /**
   * Delete address with ajax
   * 
   * using Event Delegation 
   */

  $('table.wp-list-table.addresses').on('click', 'a.submitdelete', function (e) { 
    e.preventDefault();

    if( ! confirm( skAdminAjax.confirm ) ) {
      return;
    }

    let self = $(this);

    wp.ajax.post( skAdminAjax.action, {
      id      : self.data('id'),
      _wpnonce: skAdminAjax.nonce
    })
    .done( function( response ) {

      console.log(response.message);

      self.closest('tr')
      .css('background-color', 'red')
      .hide(400, function() {
        $(this).remove();
      });

    })
    .fail( function( error ) {
      console.log( skAdminAjax.error );
      alert( error.message );
    });
    
  });

} )( jQuery );