<?php

add_action( 'init', 'make_register_cpt_search_term' );

function make_register_cpt_search_term() {

	$labels = array( 
		'name' => _x( 'Search Terms', 'search_term' ),
		'singular_name' => _x( 'Search Term', 'search_term' ),
		'add_new' => _x( 'Add New Term', 'search_term' ),
		'add_new_item' => _x( 'Add New Search Term', 'search_term' ),
		'edit_item' => _x( 'Edit Search Term', 'search_term' ),
		'new_item' => _x( 'New Search Term', 'search_term' ),
		'view_item' => _x( 'View Search Term', 'search_term' ),
		'search_items' => _x( 'Search Featured Search Terms', 'search_term' ),
		'not_found' => _x( 'No featured search terms found', 'search_term' ),
		'not_found_in_trash' => _x( 'No featured search terms found in Trash', 'search_term' ),
		'parent_item_colon' => _x( 'Parent Search Term:', 'search_term' ),
		'menu_name' => _x( 'Search Terms', 'search_term' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'description' => 'Tool for measuring custom search terms for featured products.',
		'supports' => array( 'title', 'thumbnail', 'custom-fields', 'revisions', 'editor' ),
		'taxonomies' => array( 'search_terms' ),
		'public' => false,
		'show_ui' => false,
		'show_in_menu' => true,
		'show_in_nav_menus' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'has_archive' => false,
		'query_var' => false,
		'can_export' => true,
		'rewrite' => false,
		'capability_type' => 'post',
		'menu_icon' => get_stylesheet_directory_uri() .'/img/magnifier--plus.png',
		'menu_position' => 100,
	);

	register_post_type( 'search_term', $args );
}

$field_data = array (
	'advanced_testgroup' => array (				// unique group id
		'fields' => array(						// array "fields" with field definitions 
			'Label'			=> array(),			// Custom Validator (see Ref: validator)
			'LinkTitle'		=> array(),			// Custom Validator (see Ref: validator)
			'LinkURL'		=> array(),			// A descriptive hint for the field
	),
	'title'		=> 'Search Term Meta',			// Group Title
	'context'	=> 'side',						// context as in http://codex.wordpress.org/Function_Reference/add_meta_box
	'pages'		=> array( 'search_term' ),		// pages as in http://codex.wordpress.org/Function_Reference/add_meta_box
	),
);

//if ( !class_exists( "Easy_CF_Validator_Email" ) ) {

	//class Easy_CF_Validator_Email extends Easy_CF_Validator {
	//	public function get( $value='' ) {
	//		return esc_attr( $value );
	//	}
	//
	//	public function set( $value='' ) {
	//		$value = esc_attr( trim( stripslashes( $value ) ) );
	//		return $value;
	//	}

	//public function validate( $value='' ) {
	//	if ( empty( $value ) || is_email( $value ) ) 
	//		return true;
	//	else
	//		return false;
	//	}
	//}
//}

// if ( !class_exists( "Easy_CF_Field_Textarea" ) ) {
// 	class Easy_CF_Field_Textarea extends Easy_CF_Field {
// 		public function print_form() {
// 			$class = ( empty( $this->_field_data['class'] ) ) ? $this->_field_data['id'] . '_class' :  $this->_field_data['class'];
// 				$input_class = ( empty( $this->_field_data['input_class'] ) ) ? $this->_field_data['id'] . '_input_class' :  $this->_field_data['input_class'];

// 				$id = ( empty( $this->_field_data['id'] ) ) ? $this->_field_data['id'] :  $this->_field_data['id'];
// 				$label = ( empty( $this->_field_data['label'] ) ) ? $this->_field_data['id'] :  $this->_field_data['label'];
// 				$value = $this->get();
// 				$hint = ( empty( $this->_field_data['hint'] ) ) ? '' :  '<p><em>' . $this->_field_data['hint'] . '</em></p>';

// 				$label_format =
// 					'<div class="%s">'.
// 					'<p><label for="%s"><strong>%s</strong></label></p>'.
// 					'<p><textarea class="%s" style="width: 100%%;" type="text" name="%s">%s</textarea></p>'.
// 					'%s'.
// 					'</div>';
// 			printf( $label_format, $class, $id, $label, $input_class, $id, $value, $hint );
// 		}
// 	}
// }

// $easy_cf = new Easy_CF($field_data);


add_action( 'init', 'make_register_taxonomy_search_terms' );

function make_register_taxonomy_search_terms() {

	$labels = array( 
		'name' => _x( 'Search Terms', 'search_terms' ),
		'singular_name' => _x( 'Search Term', 'search_terms' ),
		'search_items' => _x( 'Search Search Terms', 'search_terms' ),
		'popular_items' => _x( 'Popular Search Terms', 'search_terms' ),
		'all_items' => _x( 'All Search Terms', 'search_terms' ),
		'parent_item' => _x( 'Parent Search Term', 'search_terms' ),
		'parent_item_colon' => _x( 'Parent Search Term:', 'search_terms' ),
		'edit_item' => _x( 'Edit Search Term', 'search_terms' ),
		'update_item' => _x( 'Update Search Term', 'search_terms' ),
		'add_new_item' => _x( 'Add New Search Term', 'search_terms' ),
		'new_item_name' => _x( 'New Search Term', 'search_terms' ),
		'separate_items_with_commas' => _x( 'Separate search terms with commas', 'search_terms' ),
		'add_or_remove_items' => _x( 'Add or remove Search Terms', 'search_terms' ),
		'choose_from_most_used' => _x( 'Choose from most used Search Terms', 'search_terms' ),
		'menu_name' => _x( 'The Terms', 'search_terms' ),
	);

	$args = array( 
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => false,
		'query_var' => true
	);

	register_taxonomy( 'search_terms', array('search_term'), $args );
}

function make_columns_head($defaults) {
	$defaults['camp_title'] = 'Campaign Title';
	$defaults['blurb'] = 'Blurb';
	$defaults['featured_image'] = 'Featured Image';
	return $defaults;
}

function make_columns_content($column_name, $post_ID) {
	if ($column_name == 'featured_image') {
		the_post_thumbnail('search-thumb', array('class' => 'thumbnail', 'style' => 'padding: 3px;border: 1px solid #CCC;background-color: #EEE;} '));
	}
	if ($column_name == 'camp_title') {
		$linktitle = get_post_custom_values('LinkTitle');
		if (isset($linktitle[0])) {
			echo esc_attr($linktitle[0]);
		}
	}
	if ($column_name == 'blurb') {
		echo wp_trim_words( get_the_excerpt(), $num_words = 40, $more = '… ' );
	}
}

add_filter('manage_search_term_posts_columns', 'make_columns_head');
add_filter('manage_search_term_posts_custom_column', 'make_columns_content', 10, 2);