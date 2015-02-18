<?php

//hook into the init action and call create_maker_taxonomies when it fires
add_action( 'init', 'create_maker_taxonomies', 0 );

//create maker taxonomy for the post type "post"
function create_maker_taxonomies() 
{
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name' => _x( 'Makers', 'taxonomy general name' ),
		'singular_name' => _x( 'Maker', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Makers' ),
		'popular_items' => __( 'Popular Makers' ),
		'all_items' => __( 'All Makers' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Maker' ), 
		'update_item' => __( 'Update Maker' ),
		'add_new_item' => __( 'Add New Maker' ),
		'new_item_name' => __( 'New Maker Name' ),
		'separate_items_with_commas' => __( 'Separate makers with commas' ),
		'add_or_remove_items' => __( 'Add or remove makers' ),
		'choose_from_most_used' => __( 'Choose from the most used makers' ),
		'menu_name' => __( 'Makers' ),
	); 

	register_taxonomy('maker','post',array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'maker' ),
	));
}

//hook into the init action and call create_maker_taxonomies when it fires
add_action( 'init', 'create_maker_locations', 0 );

//create maker taxonomy for the post type "post"
function create_maker_locations() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
	'name' => _x( 'Makers Locations', 'taxonomy general name' ),
	'singular_name' => _x( 'Maker Location', 'taxonomy singular name' ),
	'search_items' =>  __( 'Search Makers Locations' ),
	'popular_items' => __( 'Popular Maker Locations' ),
	'all_items' => __( 'All Maker Locations' ),
	'parent_item' => null,
	'parent_item_colon' => null,
	'edit_item' => __( 'Edit Maker Location' ), 
	'update_item' => __( 'Update Maker Location' ),
	'add_new_item' => __( 'Add New Maker Location' ),
	'new_item_name' => __( 'New Maker Location' ),
	'separate_items_with_commas' => __( 'Separate maker location with commas' ),
	'add_or_remove_items' => __( 'Add or remove maker locations' ),
	'choose_from_most_used' => __( 'Choose from the most used  locations' ),
	'menu_name' => __( 'Maker Locations' ),
  ); 

  register_taxonomy('location', array( 'post','review' ), array(
	'hierarchical' => false,
	'labels' => $labels,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'maker-location' ),
  ));
}

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
