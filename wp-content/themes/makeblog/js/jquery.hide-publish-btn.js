jQuery(window).load(function() {

	// Get the current value of our post status
	var current_status = jQuery( '#post_status :selected' ).val();


	// We'll want to disable the publish button until we have set a status of "Published in Mag". Let's first make sure this post isn't already published
	if ( current_status !== 'publish' ) {
		if ( current_status !== 'published-in-mag' ) {
			jQuery( '#publish.button' ).addClass( 'disabled-publish' ).attr( 'disabled', 'disabled' );
		}
	}
	

	// What if we change the status? Let's handle that...
	jQuery( '#post_status' ).change( function() {
		
		// Get the new value
		var current_status = jQuery( '#post_status :selected' ).val();

		// Disable our publish button if needed
		if ( current_status !== 'published-in-mag' ) {
			jQuery( '#publish.button' ).addClass( 'disabled-publish' ).attr( 'disabled', 'disabled' );
		} else {
			jQuery( '#publish.button' ).removeClass( 'disabled-publish' ).removeAttr( 'disabled', '' );
		}
	});

});