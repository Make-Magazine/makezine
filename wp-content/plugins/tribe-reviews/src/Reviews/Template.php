<?php
namespace Reviews;


class Template {

	const OVERRIDE_FOLDER_NAME = 'views';

	/**
	 * Wrapper around wp_enqueue_scripts and wp_enqueue_styles
	 * Makes easier to enqueue from this plugin's resources folder
	 *
	 * @param string $filename  The name of the file to enqueue
	 * @param string $extension js / css
	 * @param array  $req
	 *
	 * @return string the handle of the resource.
	 */
	public static function enqueue( $filename, $extension, $req = [ ], $footer = false ) {
		$url = self::get_resources_url() . $extension . '/';

		$prefix = 'make_';

		$name = $prefix . $filename;
		$file = $url . $filename . '.' . $extension;

		if ( $extension == 'css' ) {
			wp_enqueue_style( $name, $file, $req );
		} else {
			wp_enqueue_script( $name, $file, $req, null, $footer );
		}

		return $name;
	}


	/**
	 * Includes a template file if exitsts
	 *
	 * @param string $filename           Name of the file to include
	 * @param array  $vars               Array with variables that will be accessible
	 *                                   from the template file.
	 * @param bool   $overrideable       If true, it will first look in the views
	 *                                   folder in the user's theme.
	 *
	 * @return bool
	 */
	public static function render( $filename, $vars = [ ], $overrideable = true ) {
		$path = '';

		if ( $overrideable ) {
			$folder     = apply_filters( 'make_views_folder', self::OVERRIDE_FOLDER_NAME );
			$folder     = trailingslashit( $folder );
			$theme_file = locate_template( [ $folder . $filename ] );

			if ( ! empty( $theme_file ) ) {
				$path = $theme_file;
			}
		}

		if ( empty( $path ) ) {
			$path = trailingslashit( self::get_views_path() ) . $filename;
		}

		if ( ! file_exists( $path ) ) {
			return false;
		}

		extract( $vars );

		do_action( 'make_before_load_template', $filename, $vars );

		include $path;

		do_action( 'make_after_load_template', $filename, $vars );

		return true;
	}

	/**
	 * Returns the path to the views folder
	 *
	 * @return string
	 */
	public static function get_views_path() {
		$views_folder = self::get_plugin_path() . 'views';
		$views_folder = apply_filters( 'make_views_path', $views_folder );
		$views_folder = trailingslashit( $views_folder );

		return $views_folder;
	}


	/**
	 * Returns the url to the resources folder
	 *
	 * @return string
	 */
	public static function get_resources_url() {
		$resources_folder = self::get_plugin_url() . 'resources';
		$resources_folder = apply_filters( 'make_resources_url', $resources_folder );
		$resources_folder = trailingslashit( $resources_folder );

		return $resources_folder;
	}

	protected static function get_plugin_path() {
		return trailingslashit( dirname( dirname( plugin_dir_path( __FILE__ ) ) ) );
	}

	protected static function get_plugin_url() {
		return trailingslashit( dirname( dirname( plugin_dir_url( __FILE__ ) ) ) );
	}

}