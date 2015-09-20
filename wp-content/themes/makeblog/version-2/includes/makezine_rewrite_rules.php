<?php
add_action('init', 'add_makezine_legacy_CPT_rewrites');
function add_makezine_legacy_CPT_rewrites()
{
	//http://makezine.com/craft/slug
	add_rewrite_rule(
	'craft/([^/]*)/([^/]*)/?$',
	'index.php?pagename=$matches[1]',
	'top'
	
	);
	// http://makezine.com/magazine/slug
	add_rewrite_rule(
	'magazine/([^/]*)/([^/]*)/?$',
	'index.php?pagename=$matches[1]',
	'top'
			);
	// http://makezine.com/review/slug
	add_rewrite_rule(
	'review/([^/]*)/([^/]*)/?$',
	'index.php?pagename=$matches[1]',
	'top'
			);
	// http://makezine.com/video/slug
	add_rewrite_rule(
	'video/([^/]*)/([^/]*)/?$',
	'index.php?pagename=$matches[1]',
	'top'
			);
	// http://makezine.com/errata/make-volumenumber/slug
	add_rewrite_rule(
	'errata/([^/]*)/([^/]*)/?$',
	'index.php?pagename=$matches[2]',
	'top'
			);
	
}

