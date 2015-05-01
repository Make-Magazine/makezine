
// This file contains common JavaScript that is loaded into every page.
// We want to register and enqueue these scripts with WordPress.

// Load Typekit
try{Typekit.load();}catch(e){}

jQuery( document ).ready( function( $ ) {
    // Sadly the Facebook Comment Box does not allow us to change the positioning
    $( '.comment-list' ).appendTo( '#comments' );

    // Allow links within bootstrap tabs for sharing URL of a particular tab
    var url = document.location.toString();
    if ( url.match( '#' ) ) {
        $( '.nav-tabs a[href=#' + url.split( '#' )[1] + ']').tab( 'show' ) ;
    }

    // Change hash in URL for tab linking
    $( '.nav-tabs a' ).on( 'shown', function( e ) {
        // Use the History API if possible, or else, fall back.
        // The History API will allow us to hash a URL without page jump in modern browsers.
        if ( history.pushState ) {
            window.history.pushState( null, null, e.target.hash );
        } else {
            window.location.hash = e.target.hash;
        }
    });
});

<span class="st_sharethis" st_url="http://sharethis.com" st_title="Sharing Rocks!"></span>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
    stLight.options({
        publisher:'5c073b97-d6e5-4edd-abc6-a41f3b2c6ea1',
                offsetLeft:'150'
    });
</script>
