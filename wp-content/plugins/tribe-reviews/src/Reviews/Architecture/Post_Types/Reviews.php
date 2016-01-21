<?php

namespace Reviews\Architecture\Post_Types;

use Pimple\Container;
use Reviews\Template;

/**
 * Class Reviews
 *
 * They decided to change the label to Comparison
 * But we kept the class and cpt names as original for back compat
 *
 * @package Reviews\Architecture\Post_Types
 */
class Reviews {

	/**
	 * They decided to change the label to Comparison
	 * But we kept the class and cpt names as original for back compat
	 */
	const NAME = 'reviews';
	const EP   = 131072;

	protected $container;

	public function __construct( Container $container ) {

		$this->container = $container;

		add_action( 'init', [ $this, 'create_post_type' ], 10 );
		add_action( 'init', [ $this, 'acf_fields' ], 11 );

		add_action( 'init', [ $this, 'register_custom_endpoints' ], 9 );
		add_action( 'template_include', [ $this, 'load_custom_template' ] );
		add_action( 'request', [ $this, 'filter_request' ] );

		add_action( 'add_meta_boxes', [ $this, 'add_scoring_meta_box' ], 11 );
		add_action( 'save_post', [ $this, 'save_scoring_meta_box' ], 11 );
	}

	/**
	 *
	 */
	public function create_post_type() {

		$labels = [
			'name'               => 'Comparisons',
			'single_name'        => 'Comparison',
			'add_new_item'       => 'Add New Comparison',
			'edit_item'          => 'Edit Comparison',
			'new_item'           => 'New Comparison',
			'all_items'          => 'All Comparisons',
			'view_item'          => 'View Comparison',
			'search_items'       => 'Search Comparisons',
			'not_found'          => 'No Comparisons found',
			'not_found_in_trash' => 'No Comparisons found in the Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Comparisons',
		];

		register_post_type( self::NAME, [
			'labels'       => $labels,
			'public'       => true,
			'has_archive'  => false,
			'hierarchical' => false,
			'rewrite'      => [
				'slug'    => sanitize_title( $labels['single_name'] ),
				'ep_mask' => self::EP
			],
			'menu_icon'    => 'dashicons-thumbs-up',
			'supports'     => [ 'title', 'author' , 'thumbnail' ],
		] );

		register_taxonomy_for_object_type( 'post_tag', self::NAME );

	}

	public function register_custom_endpoints() {
		add_rewrite_endpoint( 'how-we-test', self::EP );
		add_rewrite_endpoint( 'scores', self::EP );
	}

	public function filter_request( $data ) {
		if ( isset( $data['how-we-test'] ) ) {
			$data['how-we-test'] = true;
		}

		if ( isset( $data['scores'] ) ) {
			$data['scores'] = true;
		}

		return $data;
	}

	public function load_custom_template( $template ) {
		if ( get_query_var( 'scores' ) ) {
			$template = trailingslashit( get_template_directory() ) . 'reviews/scores.php';
		}

		if ( get_query_var( 'how-we-test' ) ) {
			$template = trailingslashit( get_template_directory() ) . 'reviews/how-we-test.php';
		}

		return $template;
	}

	/**
	 *
	 */
	public function acf_fields() {
		if ( ! function_exists( 'register_field_group' ) ) {
			return;
		}

		if ( ! empty( $_GET['post'] ) && self::is_scoring_enabled( absint( $_GET['post'] ) ) ) {

			register_field_group( array(
				'id'         => 'acf_scoring-criteria',
				'title'      => 'Scoring Criteria',
				'fields'     => array(
					array(
						'key'          => 'field_562f1b52b3630',
						'label'        => '',
						'name'         => 'scoring_criteria',
						'type'         => 'repeater',
						'sub_fields'   => array(
							array(
								'key'           => 'field_562f1b60b3631',
								'label'         => 'Criteria',
								'name'          => 'criteria',
								'type'          => 'text',
								'column_width'  => '',
								'default_value' => '',
								'placeholder'   => '',
								'prepend'       => '',
								'append'        => '',
								'formatting'    => 'html',
								'maxlength'     => '',
							),
						),
						'row_min'      => 0,
						'row_limit'    => '',
						'layout'       => 'table',
						'button_label' => 'Add Criteria',
					),
				),
				'location'   => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'reviews',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options'    => array(
					'position'       => 'normal',
					'layout'         => 'default',
					'hide_on_screen' => array(),
				),
				'menu_order' => 0,
			) );
		}

		register_field_group( array(
			'id'         => 'acf_content',
			'title'      => 'Content',
			'fields'     => array(
				array(
					'key'   => 'field_56304984bd54d',
					'label' => 'How We Test',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_56fdsrfds327c6f',
					'label'         => 'Title',
					'name'          => 'title',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'none',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_563049b3bd54e',
					'label'         => 'How We Test',
					'name'          => 'how_we_test',
					'type'          => 'wysiwyg',
					'default_value' => '',
					'toolbar'       => 'full',
					'media_upload'  => 'yes',
				),
				array(
					'key'          => 'field_5630fds43rf327a',
					'label'        => 'Hero Image',
					'name'         => 'hero_image',
					'type'         => 'image',
					'save_format'  => 'object',
					'preview_size' => 'thumbnail',
					'library'      => 'all',
				),
				array(
					'key'           => 'field_4dfgdfs45sgh425',
					'label'         => 'Sidebar Text Title',
					'name'          => 'pro_tips_title',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_56304a5bff425',
					'label'         => 'Sidebar Text',
					'name'          => 'pro_tips',
					'type'          => 'wysiwyg',
					'default_value' => '',
					'toolbar'       => 'full',
					'media_upload'  => 'yes',
				),
				array(
					'key'   => 'field_56304a7b746cd',
					'label' => 'Compare',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_563fdsffds42kn',
					'label'         => 'How Scoring Works Title',
					'name'          => 'how_scoring_works_title',
					'type'          => 'text',
					'default_value' => 'How Scoring Works',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_56304ab8746ce',
					'label'         => 'How Scoring Works',
					'name'          => 'how_scoring_works',
					'type'          => 'wysiwyg',
					'default_value' => '',
					'toolbar'       => 'full',
					'media_upload'  => 'yes',
				),
				array(
					'key'          => 'field_56304ae48f87a',
					'label'        => 'Magazine Thumbnail',
					'name'         => 'magazine_thumbnail',
					'type'         => 'image',
					'save_format'  => 'object',
					'preview_size' => 'thumbnail',
					'library'      => 'all',
				),
				array(
					'key'           => 'field_56304b05c5f99',
					'label'         => 'Magazine Label',
					'name'          => 'magazine_label',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'   => 'field_56304b50e9199',
					'label' => 'Scores',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'     => 'field_564fds2fds6ee9',
					'label'   => '',
					'name'    => '',
					'type'    => 'message',
					'message' => 'Upload your graph images and describe each of the scoring methodology descriptions.',
				),
				array(
					'key'               => 'field_5672f00587dfe',
					'label'             => 'Disable Scoring',
					'name'              => 'disable_scoring',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'message'           => '',
					'default_value'     => 0,
				),
				array(
					'key'               => 'field_56304b5fe919a',
					'label'             => 'Scores Image',
					'name'              => 'scores_image',
					'type'              => 'image',
					'instructions'      => 'For Desktop',
					'save_format'       => 'object',
					'preview_size'      => 'thumbnail',
					'library'           => 'all',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_5672f00587dfe',
								'operator' => '!=',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'               => 'field_56304b9b0bf8f',
					'label'             => 'Scoring Methodology',
					'name'              => 'scoring_methodology',
					'type'              => 'repeater',
					'sub_fields'        => array(
						array(
							'key'           => 'field_56304baf0bf90',
							'label'         => 'Title',
							'name'          => 'title',
							'type'          => 'text',
							'column_width'  => '',
							'default_value' => '',
							'placeholder'   => '',
							'prepend'       => '',
							'append'        => '',
							'formatting'    => 'none',
							'maxlength'     => '',
						),
						array(
							'key'           => 'field_56304bb70bf91',
							'label'         => 'Description',
							'name'          => 'description',
							'type'          => 'textarea',
							'column_width'  => '',
							'default_value' => '',
							'placeholder'   => '',
							'maxlength'     => '',
							'rows'          => '',
							'formatting'    => 'none',
						),
					),
					'row_min'           => 0,
					'row_limit'         => '',
					'layout'            => 'table',
					'button_label'      => 'Add Row',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_5672f00587dfe',
								'operator' => '!=',
								'value'    => '1',
							),
						),
					),
				),
			),
			'location'   => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'reviews',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options'    => array(
				'position'       => 'normal',
				'layout'         => 'default',
				'hide_on_screen' => array(),
			),
			'menu_order' => 0,
		) );

	}

	/**
	 * Registers the metabox for the scoring table
	 */
	public function add_scoring_meta_box() {

		if ( ! self::is_scoring_enabled( get_the_ID() ) ) {
			return;
		}

		add_meta_box( 'scores', 'Scores', [ $this, 'do_scoring_meta_box' ], self::NAME );
	}

	/**
	 * Renders the metabox for the scoring table
	 */
	public function do_scoring_meta_box() {
		$products = $this->container['Relationships']->get_products_in_review( get_the_ID(), [ 'post_status' => 'any' ] );

		if ( empty( $products ) ) {
			echo 'Please add your products to this review from within the product edit screen.';

			return;
		}

		$criterias = get_field( 'scoring_criteria' );

		if ( empty( $criterias ) ) {
			echo 'No criterias are entered. If you added them, you need to save this page first.';
		}

		Template::enqueue( 'scoring', 'js', [ 'jquery' ] );

		Template::render( 'scoring-meta-box.php', [
			'products'  => $products,
			'criterias' => $criterias,
			'nonce'     => wp_create_nonce( 'scoring' )
		] );

	}

	/**
	 * @param $post_id
	 */
	public function save_scoring_meta_box( $post_id ) {

		if ( empty( $_POST['scoring_nonce'] ) || empty( $_POST['scores'] ) ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['scoring_nonce'], 'scoring' ) ) {
			return;
		}

		global $wpdb;

		$prodcut_scores = (array) $_POST['scores'];

		foreach ( $prodcut_scores as $product_id => $scores ) {

			$p2p_id = $wpdb->get_var( $wpdb->prepare( "Select p2p_id from $wpdb->p2p where p2p_from = %d and p2p_to = %d", $product_id, get_the_ID() ) );

			$total = 0;
			foreach ( $scores as $key => $value ) {
				p2p_update_meta( $p2p_id, $key, $value );
				$total+=absint($value);
			}

			update_post_meta( $product_id, 'total_score', $total );
		}
	}

	public static function is_how_we_test() {
		return get_query_var( 'how-we-test' );
	}

	public static function is_scores() {
		return get_query_var( 'scores' );
	}

	public static function is_review() {
		return is_singular( self::NAME ) && ! self::is_scores() && ! self::is_how_we_test();
	}

	public static function get_how_we_test_link( $review_id = null ) {

		if ( empty( $review_id ) ) {
			$review_id = get_the_ID();
		}

		return trailingslashit( get_permalink( $review_id ) ) . 'how-we-test/shootout/';
	}

	public static function get_scores_link( $review_id = null ) {

		if ( empty( $review_id ) ) {
			$review_id = get_the_ID();
		}

		return trailingslashit( get_permalink( $review_id ) ) . 'scores/shootout/';
	}

	public static function is_scoring_enabled( $review_id ) {
		return ! (bool) get_field( 'disable_scoring', $review_id );
	}

	public static function get_product_category_slug( $review_id ) {

		$container = Reviews()->container();
		$products  = $container['Relationships']->get_products_in_review( $review_id, [ 'orderby' => 'post_title', 'order' => 'ASC' ] );

		if ( empty( $products ) ) {
			return '';
		}

		$product = array_shift( $products );
		$terms   = get_the_terms( $product->ID, \Reviews\Architecture\Taxonomies\ProductCategories::NAME );

		if ( empty( $terms ) ) {
			return '';
		}
		$term = array_shift( $terms );

		return $term->slug;
	}
}