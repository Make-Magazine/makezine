<?php

namespace Reviews\Architecture\Taxonomies;


class ProductCategories {

	const NAME = 'product-categories';

	protected $post_types = [ ];

	public function __construct( $post_types ) {
		$this->post_types = $post_types;
		add_action( 'init', array( $this, 'register_taxonomy' ), 10 );
	}

	/**
	 * Registers the buildings taxonomy
	 */
	public function register_taxonomy() {

		$labels = array(
			'name'              => _x( 'Product Categories', 'taxonomy general name' ),
			'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Product Categories' ),
			'all_items'         => __( 'All Product Categories' ),
			'parent_item'       => __( 'Parent Product Category' ),
			'parent_item_colon' => __( 'Parent Product Category' ),
			'edit_item'         => __( 'Edit Product Category' ),
			'update_item'       => __( 'Update Product Category' ),
			'add_new_item'      => __( 'Add New Product Category' ),
			'new_item_name'     => __( 'New Product Category' ),
			'menu_name'         => __( 'Product Categories' ),
		);

		$args = array(
			'public'            => true,
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => true,
		);

		register_taxonomy( self::NAME, $this->post_types, $args );
	}

}
