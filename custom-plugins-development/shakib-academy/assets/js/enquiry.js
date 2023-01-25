( function( $ ) {

  console.log('-Hello from Enquiry-');

  let enquiryForm = $('#sk-enquiry-form form');

  $(enquiryForm).on('submit', function (e) {
    e.preventDefault();

    console.log('Loading...');

    let data = $(this).serialize();

    $.post( skAjaxObj.ajaxurl, data, function ( response ) {
      
      if( response.success ) {
        console.log(response.success);
      }
      else{
        console.log(response.data.message);
      }
      
    })
    .fail( function() {
      console.log( skAjaxObj.error );
    });

  });

} )( jQuery );