<?php
namespace Reviews\Architecture;

class Relationships {

	protected $types;

	const PRODUCTS_IN_REVIEW = 'products_in_review';

	public function __construct( array $types ) {

		$this->types = $types;

		if ( ! function_exists( 'p2p_register_connection_type' ) ) {
			return;
		}

		add_action( 'init', [ $this, self::PRODUCTS_IN_REVIEW ], 60 );
	}

	/**
	 *
	 */
	public function products_in_review() {

		p2p_register_connection_type( [
			'name'           => self::PRODUCTS_IN_REVIEW,
			'from'           => $this->types['Products'],
			'to'             => $this->types['Reviews'],
			'sortable'       => 'any',
			'cardinality'    => 'many-to-one',
			'title'          => [
				'to'   => 'Products',
				'from' => 'Review',
			],
			'admin_dropdown' => true,
			'admin_column'   => 'to',
			'to_labels'      => [
				'singular_name' => 'Review',
				'search_items'  => 'Search Review',
				'not_found'     => 'No Review found.',
				'create'        => 'Assign to Review',
			],
			'from_labels'    => [
				'singular_name' => 'Products',
				'search_items'  => 'Search Products',
				'not_found'     => 'No Product found.',
				'create'        => 'Add Product',
			],
			'admin_box'      => [
				'show'    => 'from',
				'context' => 'advanced',
			],
		] );
	}

	/**
	 * Filters a WP Query by a relationship defined on this class.
	 *
	 * Abstracts the relationship type. It's P2P now but could be replaced by
	 * taxonomy or any other kind without affecting callers of this class.
	 *
	 * @param \WP_Query $query
	 * @param string    $relationship
	 * @param mixed     $value
	 *
	 * @return mixed
	 */
	public function filter_wp_query( $query, $relationship, $value ) {
		$query->set( 'connected_type', $relationship );
		$query->set( 'connected_items', $value );

		return $query;
	}


	/**
	 * @param int   $review_id
	 * @param array $args
	 *
	 * @return array
	 */
	public function get_products_in_review( $review_id, $args = [] ) {
		$posts = get_posts( wp_parse_args( $args, array(
			'connected_type'   => self::PRODUCTS_IN_REVIEW,
			'connected_items'  => $review_id,
			'suppress_filters' => false,
			'post_type'        => $this->types['Products'],
			'posts_per_page'   => - 1
		) ) );

		return $posts;
	}

	/**
	 * @param $product_id
	 *
	 * @return array
	 *
	 */
	public function get_review_for_product( $product_id ) {
		$posts = get_posts( array(
			'connected_type'   => self::PRODUCTS_IN_REVIEW,
			'connected_items'  => $product_id,
			'suppress_filters' => false,
			'post_type'        => $this->types['Reviews']
		) );

		return $posts;
	}

}