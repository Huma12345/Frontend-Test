jQuery( document ).ready( function() { 

	jQuery( '.psag-notice button.notice-dismiss' ).ready( function() {

		jQuery( '.psag-notice button.notice-dismiss' ).on( 'click', function() {
			
			var data = {
				'action': 'dismiss_notice',
			};

			jQuery.post( admin_notice_ajax_object.ajax_url, data, function( response ) {
			});

		});

	});

});
