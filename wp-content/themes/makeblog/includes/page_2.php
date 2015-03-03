<?php

add_action( 'init', 'js_page_2_type' );

function js_page_2_type() {
	register_post_type( 'page_2',
		array(
			'labels' => array(
				'name' => __( 'Page 2' ),
				'singular_name' => __( 'Page 2' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Page 2 Post' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Page 2 Post' ),
				'new_item' => __( 'New Page 2 Post' ),
				'view' => __( 'View Page 2' ),
				'view_item' => __( 'View Page 2 Post' ),
				'search_items' => __( 'Search Page 2 Posts' ),
				'not_found' => __( 'No Page 2 Posts Found...' ),
				'not_found_in_trash' => __( 'No Page 2 posts found in trash...' ),
				'parent' => __( 'Parent Page 2' ),
			),
			'public' => true,
			'description' => __( 'User contributed posts that aren\'t fit for the main page.' ),
			'public' => true,
			'show_ui' => true,
			'has_archive'=> true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'author', 'comments' ),
			'rewrite' => array( 'slug' => 'page-2', 'with_front' => false ),
			'taxonomies' => array( 'post_tag', 'category', 'maker', 'location'),
			'menu_position' => 48,
		)
	);
}

$field_data = array (
	'advanced_testgroup' => array (
		'fields' => array(
			'author'			=> array(),
			'author_email'		=> array(),
			'author_website'	=> array(),
			'author_bio'		=> array(),
			'link'				=> array(),
	),
	'title'		=> 'Page 2 Author Meta',
	'context'	=> 'side',
	'pages'		=> array( 'page_2' ),
	),
);

// $easy_cf = new Easy_CF($field_data);

add_filter( 'the_content', 'make_page2_content_filter', 5 );

function make_page2_content_filter( $content ) {
	global $post;

	if ( 'page_2' == get_post_type() ) {

		$link = get_post_meta( $post->ID, 'link', true );
		
		if ( $link ) {
			$source =  '<p><a href="'. esc_url( $link ).'" style="border-bottom:0px;"><span class="label" style="color:white">Source</a><span></p>';
			return $content.$source;

		}
	}

	return $content;
}
