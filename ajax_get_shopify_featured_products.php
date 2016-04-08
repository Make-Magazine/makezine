<?php
/*
	From https://wordpress.org/support/topic/running-shortcode-inside-ajax-request
	WordPress post content AJAX handler
	by Dion Designs (http://www.dion-designs.com)
*/


define('WP_USE_THEMES', false);
require(dirname(__FILE__) . '/wp-load.php');
@header('Content-Type: text/html; charset=' . get_option('blog_charset'));
@header('X-Robots-Tag: noindex');
send_nosniff_header();
nocache_headers();

make_shopify_featured_products();
?>
