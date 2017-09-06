<?php
namespace Reviews;


class Theme {
	private $container;

	public function __construct( $container ) {
		$this->container = $container;
		add_action( 'wp_enqueue_scripts', [ $this, 'load_resources' ], 50 );
		add_action( 'wp_footer', [$this, 'inject_modal_markup'] );
		add_filter( 'pre_option_gravatar_disable_hovercards', [ $this, 'disable_hovercards' ] );
	}

	public function  load_resources() {

		if ( ! is_singular( array_values( $this->container['post_types'] ) ) ) {
			return;
		}

		// Enqueue our Product Review styles.
		wp_enqueue_script( 'make-reviews', get_stylesheet_directory_uri() . '/reviews/js/src/index.js', array( 'jquery', 'bootstrap-js' ) );

		wp_localize_script( 'make-reviews', 'MakeReviews', array(
			'ajax_url'    => set_url_scheme( 'admin-ajax.php', 'https' ),
			'ajax_action' => AJAX::FILTER_ACTION,
			'post_id'     => get_the_ID()
		) );

		// Enqueue our Product Review styles.
		wp_enqueue_style( 'make-reviews', get_stylesheet_directory_uri() . '/reviews/css/master.css', array(
			'style'
		) );
	}

	public function disable_hovercards( $value ) {
		if ( ! is_singular( array_values( $this->container['post_types'] ) ) ) {
			return $value;
		}

		return 'disabled';
	}

	public static function partition_array( $list, $p ) {
		$listlen   = count( $list );
		$partlen   = floor( $listlen / $p );
		$partrem   = $listlen % $p;
		$partition = array();
		$mark      = 0;
		for ( $px = 0; $px < $p; $px ++ ) {
			$incr             = ( $px < $partrem ) ? $partlen + 1 : $partlen;
			$partition[ $px ] = array_slice( $list, $mark, $incr );
			$mark += $incr;
		}

		return $partition;
	}

	public function inject_modal_markup() {

		if ( is_singular( array_values( $this->container['post_types'] ) ) ) {
			get_template_part( 'reviews/content/modal' );
		}

	}

}
