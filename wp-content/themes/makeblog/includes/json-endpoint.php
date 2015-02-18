<?php                                                                                                                                                                                          
/*
Plugin Name: WP_Rewrite endpoints demo
Description: A plugin giving example usage of the WP_Rewrite endpoint API
Plugin URI: http://make.wordpress.org/plugins/2012/06/07/rewrite-endpoints-api/
Author: Jon Cave
Author URI: http://joncave.co.uk/
*/

function makeplugins_endpoints_add_endpoint() {
        // register a "json" endpoint to be applied to posts and pages
        add_rewrite_endpoint( 'json', EP_PERMALINK | EP_PAGES );
}
add_action( 'init', 'makeplugins_endpoints_add_endpoint' );

function makeplugins_endpoints_template_redirect() {
        global $wp_query;

        // if this is not a request for json or it's not a singular object then bail
        if ( ! isset( $wp_query->query_vars['json'] ) || ! is_singular() )
                return;

        // output some JSON (normally you might include a template file here)
        makeplugins_endpoints_do_json();
        exit;
}
add_action( 'template_redirect', 'makeplugins_endpoints_template_redirect' );

function makeplugins_endpoints_do_json() {
        header( 'Content-Type: application/json' );

        $post = get_queried_object();
        echo json_encode( $post );
}

function makeplugins_endpoints_activate() {
        // ensure our endpoint is added before flushing rewrite rules
        makeplugins_endpoints_add_endpoint();
        // flush rewrite rules - only do this on activation as anything more frequent is bad!
        flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'makeplugins_endpoints_activate' );

function makeplugins_endpoints_deactivate() {
        // flush rules on deactivate as well so they're not left hanging around uselessly
        flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'makeplugins_endpoints_deactivate' );