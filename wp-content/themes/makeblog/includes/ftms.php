<?php

add_action( 'init', 'makeblog_from_the_maker_shed' );

// Custom post type for Deal of the Week
function makeblog_from_the_maker_shed() {

	$labels = array( 
		'name' => _x( 'From the Shed', 'from-the-maker-shed' ),
		'singular_name' => _x( 'From the Shed', 'from-the-maker-shed' ),
		'add_new' => _x( 'Add New', 'from-the-maker-shed' ),
		'add_new_item' => _x( 'Add New From the Maker Shed', 'from-the-maker-shed' ),
		'edit_item' => _x( 'Edit From the Maker Shed', 'from-the-maker-shed' ),
		'new_item' => _x( 'New From the Maker Shed', 'from-the-maker-shed' ),
		'view_item' => _x( 'View From the Maker Shed', 'from-the-maker-shed' ),
		'search_items' => _x( 'Search From the Maker Shed', 'from-the-maker-shed' ),
		'not_found' => _x( 'No From the Maker Shed found', 'from-the-maker-shed' ),
		'not_found_in_trash' => _x( 'No From the Maker Shed found in Trash', 'from-the-maker-shed' ),
		'parent_item_colon' => _x( 'Parent From the Maker Shed:', 'from-the-maker-shed' ),
		'menu_name' => _x( 'From the Shed', 'from-the-maker-shed' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'post-formats' ),
		'taxonomies' => array( 'category', 'post_tag', 'page-category' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'menu_position' => 44,
	);

	register_post_type( 'from-the-maker-shed', $args );
	
}

$ftms_field_data = array (

	'ftms_fields' => array (										// unique group id
		'fields' => array(												// array "fields" with field definitions 
		
			'ftms_price'	=> array(								// globally unique field id
				'label' 		=> 'Price',		// Field Label
				'hint'			=> 'Add the price to be shown on the widget make sure to include dollar sign',	// A descriptive hint for the field
				'type' 			=> 'textarea',							// Custom Field Type (see Ref: field_type)
				'class'			=> 'aclass',							// CSS Wrapper class for the field
				'input_class' 	=> 'theEditor',							// CSS class for the input field
				'error_msg' 	=> 'The Advanced Field is wrong' ),		// Error message to show when validate fails
				
			'ftms_link'	=> array(								// globally unique field id
				'label' 		=> 'Maker Shed URL',		// Field Label
				'hint'			=> 'Include the link for the product on makershed.com - e.g. http://www.makershed.com/Ultimate_Microcontroller_Pack_p/msump.html',	// A descriptive hint for the field
				'type' 			=> 'textarea',							// Custom Field Type (see Ref: field_type)
				'class'			=> 'aclass',							// CSS Wrapper class for the field
				'input_class' 	=> 'theEditor',							// CSS class for the input field
				'error_msg' 	=> 'The Advanced Field is wrong' ),		// Error message to show when validate fails
				
			'ftms_pre_price_verbage'	=> array(								// globally unique field id
				'label' 		=> 'Pre Price Verbiage',		// Field Label
				'hint'			=> 'Text seen before price defaults to - e.g. On Sale',	// A descriptive hint for the field
				'type' 			=> 'textarea',							// Custom Field Type (see Ref: field_type)
				'class'			=> 'aclass',							// CSS Wrapper class for the field
				'input_class' 	=> 'theEditor',							// CSS class for the input field
				'error_msg' 	=> 'The Advanced Field is wrong' ),		// Error message to show when validate fails
		),
		
		'title' => 'From the Maker Shed',	// Group Title
		'context' => 'advanced',			// context as in http://codex.wordpress.org/Function_Reference/add_meta_box
		'pages' => 'from-the-maker-shed',	// pages as in http://codex.wordpress.org/Function_Reference/add_meta_box
	),
	
);


// $ftms_easy_cf = new Easy_CF($ftms_field_data);

if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(
		array(
			'label' => 'Product Thumbnail',
			'id' => 'product-thumbnail',
			'post_type' => 'from-the-maker-shed'
		)
	);
}

?>
