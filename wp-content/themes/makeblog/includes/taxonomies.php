<?php

add_action( 'init', 'register_taxonomy_craft_rss' );

function register_taxonomy_craft_rss() {

	$labels = array( 
		'name' => _x( 'Craft RSS', 'craft_rss' ),
		'singular_name' => _x( 'Craft RSS', 'craft_rss' ),
		'search_items' => _x( 'Search Craft RSS', 'craft_rss' ),
		'popular_items' => _x( 'Popular Craft RSS', 'craft_rss' ),
		'all_items' => _x( 'All Craft RSS', 'craft_rss' ),
		'parent_item' => _x( 'Parent Craft RSS', 'craft_rss' ),
		'parent_item_colon' => _x( 'Parent Craft RSS:', 'craft_rss' ),
		'edit_item' => _x( 'Edit Craft RSS', 'craft_rss' ),
		'update_item' => _x( 'Update Craft RSS', 'craft_rss' ),
		'add_new_item' => _x( 'Add New Craft RSS', 'craft_rss' ),
		'new_item_name' => _x( 'New Craft RSS', 'craft_rss' ),
		'separate_items_with_commas' => _x( 'Separate craft rss with commas', 'craft_rss' ),
		'add_or_remove_items' => _x( 'Add or remove Craft RSS', 'craft_rss' ),
		'choose_from_most_used' => _x( 'Choose from most used Craft RSS', 'craft_rss' ),
		'menu_name' => _x( 'Craft RSS', 'craft_rss' ),
	);

	$args = array( 
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => false,
		'hierarchical' => 'radio',
		'rewrite' => true,
		'query_var' => true
	);

	//register_taxonomy( 'craft_rss', array('craft'), $args );
}
