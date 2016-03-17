<?php
/**
 * Plugin Name: PBD AJAX Load Posts
 * Plugin URI: http://www.problogdesign.com/
 * Description: Load the next page of posts with AJAX.
 * Version: 0.1
 * Author: Pro Blog Design
 * Author URI: http://www.problogdesign.com/
 */
 
 /**
  * Initialization. Add our script if needed on this page.
  */
 function pbd_alp_init($wp_query) {

    // What page are we on? And what is the pages limit?
    $max = $wp_query->max_num_pages;
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

    // Add some parameters for the JS.
    wp_localize_script(
        'pbd-alp-load-posts',
        'pbd_alp',
        array(
            'startPage' => $paged,
            'maxPages' => $max,
            'nextLink' => next_posts($max, false)
        )
    );
 }
 add_action('custom_page_hook', 'pbd_alp_init');