<?php
namespace Reviews;

/**
 * Class Core
 *
 * @package Reviews
 */
class Core {

	protected static $_instance;

	protected $container = null;

	protected $types = [
		'Products',
		'Reviews'
	];

	protected $taxonomies = [
		'ProductCategories' => [
			'Products',
		],
	];

	/**
	 * @param \ArrayAccess $container
	 */
	public function __construct( $container ) {
		$this->container = $container;

		$this->load_post_types();
		$this->load_taxonomies();

		$this->load_utils();
	}

	public function container() {
		return $this->container;
	}

	protected function load_utils() {
		$this->container['Relationships'] = function ( $container ) {
			return new Architecture\Relationships( $container['post_types'] );
		};

		$this->container['AdminUI'] = function ( $container ) {
			return new AdminUI( );
		};

		$this->container['AJAX'] = function ( $container ) {
			return new AJAX();
		};

		$this->container['Theme'] = function ( $container ) {
			return new Theme( $container );
		};

		$this->container['Relationships'];
		$this->container['AdminUI'];
		$this->container['AJAX'];
		$this->container['Theme'];
	}

	protected function load_post_types() {

		$post_types = [ ];

		foreach ( $this->types as $type ) {
			$this->container[ 'Post_Type::' . $type ] = function ( $container ) use ( $type ) {
				$class = '\Reviews\Architecture\Post_Types\\' . $type;

				return new $class( $container );
			};

			$obj = $this->container[ 'Post_Type::' . $type ];

			$post_types[ $type ] = $obj::NAME;

		}

		$this->container['post_types'] = $post_types;

	}

	public function load_taxonomies() {
		$taxonomies = [ ];

		foreach ( $this->taxonomies as $taxonomy => $post_types ) {
			$this->container[ 'Taxonomy::' . $taxonomy ] = function () use ( $taxonomy, $post_types ) {
				$class = '\Reviews\Architecture\Taxonomies\\' . $taxonomy;

				$post_types = array_map( function ( $item ) {
					$obj = $this->container[ 'Post_Type::' . $item ];

					return $obj::NAME;
				}, $post_types );

				return new $class( $post_types );
			};

			$obj = $this->container[ 'Taxonomy::' . $taxonomy ];

			$taxonomies[ $taxonomy ] = $obj::NAME;

		}

		$this->container['taxonomies'] = $taxonomies;
	}


	/**
	 * @param null|\ArrayAccess $container
	 *
	 * @return Core
	 * @throws \Exception
	 */
	public static function instance( $container = null ) {
		if ( ! isset( self::$_instance ) ) {

			if ( empty( $container ) ) {
				throw new \Exception( 'You need to provide a Pimple container' );
			}

			$className       = __CLASS__;
			self::$_instance = new $className( $container );
		}

		return self::$_instance;
	}

}
