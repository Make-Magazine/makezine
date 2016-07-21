jQuery( document ).ready( function( $ ) {

	// Track links clicked
	$( '.ga-nav a' ).click( function(e) {
		var link_name = $(this).text();
		var menu_name = $(this).parents('ul.nav').attr('id');

		// Track this click with Google, yo.
		ga('send', 'event', menu_name, 'Click', link_name);
	});

});
