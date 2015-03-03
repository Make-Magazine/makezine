<?php

	/**
	 * Contains all the source code for running the Google Maps Marker Map found in Maker Camp
	 *
	 * Had major issues with integrating a custom map.. Out of time, taking the easy way out with Google Maps Engine Lite.
	 * For now we'll save the source code, but will not load them until we are ready. Revert back to 73afd0f7503575d7e4ddc2f1754c2572b2770cd5 on GitHub for all the geocode fun @colegeissinger built.
	 */
	

	/**
	 * Create the shortcode
	 * @param  Array  $atts    The array of attributes passed through the shortcode (Not supported right now)
	 * @param  String $content The string of content wrapped inside the shortcode (Not supported right now)
	 * @return String
	 */
	function make_makercamp_map_shortcode( $atts, $content ) {

		$output = '<iframe src="http://mapsengine.google.com/map/u/0/embed?mid=z6jknjwOuQEA.kwp_h1l1fm4s" width="99.5%" height="464"></iframe>';

		return $output;
	}
	add_shortcode( 'makercamp-map', 'make_makercamp_map_shortcode' );


	/**
	 * Adds our meta box to the maps page template
	 * @return Void
	 */
	function make_makercamp_map_data() {
		if ( isset( $_GET['post'] ) || isset( $_POST['post_ID'] ) ) {
			$post_id = $_GET['post'] ? absint( $_GET['post'] ) : absint( $_POST['post_ID'] ) ;
			$template_file = get_post_meta( $post_id,'_wp_page_template',true );
		}

		// check for a template type
		if ( isset( $template_file ) && $template_file == 'page-makercamp-map.php' && isset( $post_id ) )
			add_meta_box( 'make-maps-data', 'Map Data (JSON array only) This builds the contact table.', 'make_map_data_callback', 'page' );
	}
	add_action( 'add_meta_boxes', 'make_makercamp_map_data' );


	/**
	 * The callback function that will handle the form in our meta box
	 * @param  Object $post The post object
	 * @return String
	 */
	function make_map_data_callback( $post ) {
		wp_nonce_field( basename( __FILE__ ), 'makercamp-nonce' );
		$map_data = get_post_meta( $post->ID, 'makercamp-maps-data', false );
		echo '<textarea name="makercamp-maps-data" id="makercamp-map-data" style="width:100%; height:90px;">' . esc_attr( $map_data[0] ) . '</textarea>';
	}


	/**
	* Hook and save our custom meta box on post save
	* @param  String $post_id Contains the current posts ID
	* @return Void
	*/
	function make_map_data_save( $post_id ) {
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	 
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['makercamp-nonce'] ) || !wp_verify_nonce( $_POST['makercamp-nonce'], basename( __FILE__ ) ) ) return;
	 
		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post', $post_id ) ) return; 

		// Make sure your data is set before trying to save it
		if( isset( $_POST['makercamp-maps-data'] ) )
	  		update_post_meta( $post_id, 'makercamp-maps-data', sanitize_text_field( $_POST['makercamp-maps-data'] ) );
	   
	}
	add_action( 'save_post', 'make_map_data_save' );
	