<?php
/*
Plugin Name:	Reviews functionality
Description:	Product reviews
Author:		    Modern Tribe
Version:	    1.0
Author URI:	    http://www.tri.be
*/

require_once trailingslashit( __DIR__ ) . 'vendor/autoload.php';


// Start the core plugin
add_action( 'plugins_loaded', function () {
	Reviews();
} );

/**
 * Shorthand to get the instance of our main core plugin class
 *
 * @return \Reviews\Core
 */
function Reviews() {
	return \Reviews\Core::instance( new Pimple\Container() );
}
