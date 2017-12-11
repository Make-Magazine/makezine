<?php
namespace Reviews;


use Reviews\Architecture\Post_Types\Reviews;
use Reviews\Architecture\Relationships;

class AJAX {

	const FILTER_ACTION = 'reviews-filters';

	public function __construct() {
		add_action( 'wp_ajax_'        . self::FILTER_ACTION, [ $this, 'filter' ] );
		add_action( 'wp_ajax_nopriv_' . self::FILTER_ACTION, [ $this, 'filter' ] );
	}

	public function filter() {

		if ( empty( $_POST['post_id'] ) || absint( $_POST['post_id'] ) === 0 ) {
			$this->err();
		}

		$args = array(
			'connected_type'  => Relationships::PRODUCTS_IN_REVIEW,
			'connected_items' => absint( $_POST['post_id'] ),
			'nopaging'        => true,
		);

		$args = $this->process_meta( $args );
		$args = $this->process_sort( $args );

		ksort( $args );

		$cache_key = 'review' . md5( json_encode( $args ) );

		$products = wp_cache_get( $cache_key );

		if ( $products === false ) {
			$products = new \WP_Query( $args );
			$products = $this->prepare_post_array( $products->posts );
			wp_cache_add( $cache_key, maybe_serialize( $products ), '', 900 );
		} else {
			$products = maybe_unserialize( $products );
		}

		$this->ok( $products );
	}

	private function process_sort( $args ) {
		$sortby = ! empty( $_POST['sort'] ) && in_array( $_POST['sort'], [ 'score', 'price', 'title', 'most_recent' ], true ) ? $_POST['sort'] : 'score';
    $orderDef = ($_POST['sort']=='score'||$_POST['sort']=='most_recent'?'DESC':'ASC');
    $order  = (!empty( $_POST['order'] ) ? $_POST['order'] : $orderDef);

		if ( ! Reviews::is_scoring_enabled( $_POST['post_id'] ) && $sortby === 'score' ) {
			$sortby = 'title';
		}

		switch ( $sortby ) {

			case 'score':
				$args['meta_key'] = 'total_score';
				$args['orderby']  = 'meta_value_num';
				$args['order']    = $order;
				break;

			case 'price':
				$args['meta_key'] = 'price_as_tested';
				$args['orderby']  = 'meta_value_num';
				$args['order']    = $order;
				break;

			case 'title':
				$args['orderby'] = 'title';
				$args['order']   = $order;
				break;

			case 'most_recent':
				$args['orderby'] = 'most_recent';
				$args['order']   = $order;
				break;

		}

		return $args;
	}

	private function process_meta( $args ) {
		if ( empty( $_POST['filters'] ) ) {

			return $args;
		}
		$meta_query = [
			'relation' => 'AND'
		];

		foreach ( (array) $_POST['filters'] as $field => $values ) {

			if ( $field === 'os' || $field === 'winners'  ) { // Hack to cover for how ACF stores this data

				$os_query = [ 'relation' => 'OR' ];
				foreach ( $values as $value ) {
					$os_query[] = [
						'key'     => $field,
						'value'   => $value,
						'compare' => 'LIKE'
					];
				}

				$meta_query[] = $os_query;
			} else {
				$meta_query[] = [
					'key'     => $field,
					'value'   => $values,
					'compare' => 'IN'
				];
			}

		}

		$args['meta_query'] = $meta_query;

		return $args;
	}

	private function prepare_post_array( $posts ) {
		$data = [ ];

		foreach ( $posts as $post ) {
      $subtitle = (get_post_meta( $post->ID, 'discontinued', true )=='yes'?'Discontinued by manufacturer':'');
			$data[] = [
				'ID'        => $post->ID,
				'title'     => $post->post_title,
        'subtitle'  => $subtitle,
				'most_recent' => $post->post_date,
				'price'     => '$' . absint( get_post_meta( $post->ID, 'price_as_tested', true ) ),
				'buy_url'   => get_post_meta( $post->ID, 'buy_link', true ),
				'type'      => $this->type( $post->ID ),
				'score'     => abs( get_post_meta( $post->ID, 'total_score', true ) ),
				'thumbnail' => wp_get_attachment_url(get_post_thumbnail_id( $post->ID )),
				'link'      => get_permalink( $post->ID ),
				'winner'    => $this->winner( $post->ID )
			];
		}

		return $data;
	}

	private function winner( $post_id ) {
		$winner = array(
			'best-overall'            => 'Best Overall',
			'best-value'              => 'Best Value',
			'best-for-schools'        => 'Best for Schools',
			'most-portable'           => 'Most Portable',
			'outstanding-open-source' => 'Outstanding Open Source',
			'best-large-format'       => 'Best Large Format',
			'robotics'                => 'Robotics',
			'wearables'               => 'Wearables',
			'education'               => 'Education',
			'light-and-sound'         => 'Light and Sound',
			'IoT'         						=> 'IoT',
			'sub-10'                  => 'Dirt Cheap',
      'overall'                 => 'Best Overall',
			'beginners'               => 'Best for Beginners',
			'hackable'                => 'Most Hackable',
		);
		$value  = get_field( 'winners', $post_id );

		if ( empty( $value ) ) {
			return '';
		}

		$value = array_map( function ( $i ) use ( $winner ) {
			return ! empty( $winner[ $i ] ) ? $winner[ $i ] : '';
		}, $value );

		return implode( ' / ', $value );
	}

	private function type( $post_id ) {

		$type = array(
			'microcontroller'       => 'Microcontroller',
			'single-board-computer' => 'Single Board Computer',
			'fpga'                  => 'FPGA',
		);

		$value = get_field( 'type', $post_id );

		return isset( $type[ $value ] ) ? $type[ $value ] : '';

	}

	private function err( $data = [ ] ) {
		$this->response( false, $data );
	}

	private function ok( $data = [ ] ) {
		$this->response( true, $data );
	}

	private function response( $success, $data ) {
		$response = [
			'success' => $success,
			'data'    => $data
		];

		wp_send_json( $response );
	}

}
