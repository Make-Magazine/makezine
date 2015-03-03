jQuery( document ).ready( function( $ ) {

	// Sort the custom table and enable zebra stripes
	$.tablesorter.defaults.widgets = ['zebra'];
	$( 'table#blog-dashboard' ).tablesorter();


	// Setup Ajax for our screen options
	$( 'input.hide-column-tog:checkbox' ).on( 'click', function() {

		// Save our new options to the database
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: {
				'action' : 'blog_dash_screen_opt',
				'nonce' : $( '#blog-dashboard-screen-options input#make-blog-dashboard' ).val(),
				'submission' : $( '#blog-dashboard-screen-options input[name="submission"]:hidden' ).val(),
				'data'   : $( '#blog-dashboard-screen-options input:checked' ).serialize()
			}
		});

		// show or hide our columns on click
		var column = '.column-' + $(this).val();

		$( column ).each( function() {
			if ( $(this).is(':visible') ) {
				$(this).hide();
			} else {
				$(this).show();
			}
		});
	});
});