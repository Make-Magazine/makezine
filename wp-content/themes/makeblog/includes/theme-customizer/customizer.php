<?php


/**
 * Register and load our JavaScript that lets us preview our changes automatically in the preview window
 * @return void
 *
 * @since  HAL 9000
 */
function make_register_theme_customizer() {
	wp_enqueue_script( 'make-theme-customizer', get_stylesheet_directory_uri() . '/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), '0.1', true );
}
add_action( 'customize_preview_init', 'make_register_theme_customizer' );


/**
 * Used within the add_settings sanitize_callback option.
 * @param  string $input The data to be sanitized
 * @return string
 *
 * @since  HAL 9000
 */
function make_theme_customizer_sanitize_text( $input ) {
	return strip_tags( stripslashes( $input ) );
}


/**
 * Sanitize urls like a boss
 * @param  string $input The data to be sanitized
 * @return string
 *
 * @since  HAL 9000
 */
function make_theme_customizer_sanitize_text_url( $input ) {
	return esc_url( $input );
}


/**
 * Helper function to fetch and process our theme customizer data
 * @param  string  $mod_name The name of the modification to return
 * @param  boolean $echo     Choose to return or echo the data
 * @return string
 *
 * @since  HAL 9000
 */
function make_get_takeover_mod( $mod_name, $echo = true ) {

	switch( $mod_name ) {

		// Handle the banner image
		case 'make_banner_takeover' :
			$result = get_theme_mod( 'make_banner_takeover' );
			break;

		// Handle the banner image url (this can be a post ID or a full URL.)
		case 'make_banner_url_takeover' :
			$val = get_theme_mod( 'make_banner_url_takeover' );

			if ( absint( $val ) ) {
				$result = get_permalink( absint( $val ) );
			} else {
				$result = $val;
			}
			break;

		// Handle the post URLs
		case 'make_featured_post_url' :
		case 'make_topright_post_url' :
		case 'make_bottomright_post_url' :
			$result = get_permalink( absint( get_theme_mod( sanitize_text_field( $mod_name ) ) ) );
			break;

		// Handle the post images
		case 'make_featured_post_image' :
		case 'make_topright_post_image' :
		case 'make_bottomright_post_image' :
			$featured_image = get_theme_mod( sanitize_text_field( $mod_name ) );

			if ( $mod_name == 'make_featured_post_image' ) {
				$size = 'takeover-featured';
			} else {
				$size = 'takeover-thumb';
			}

			if ( $mod_name == 'make_featured_post_image' ) {
				$id = 'make_featured_post_url';
			} elseif ( $mod_name == 'make_topright_post_image' ) {
				$id = 'make_topright_post_url';
			} elseif ( $mod_name == 'make_bottomright_post_image' ) {
				$id = 'make_bottomright_post_url';
			}

			if ( ! empty( $featured_image ) ) {
				$result = $featured_image;
			} else {
				$image = get_the_image( array(
					'post_id' => absint( get_theme_mod( sanitize_text_field( $id ) ) ),
					'image_scan' => true,
					'size' => $size,
					'format' => 'array',
					'echo' => false,
				) );

				$result = $image['src'];
			}
			break;

		// Handle the post titles
		case 'make_featured_post_title' :
		case 'make_topright_post_title' :
		case 'make_bottomright_post_title' :
			$featured_title = get_theme_mod( sanitize_text_field( $mod_name ) );

			if ( ! empty( $featured_title ) ) {
				$result = $featured_title;
			} else {
				if ( $mod_name == 'make_featured_post_title' ) {
					$mod_post_id_field = 'make_featured_post_url';
				} elseif ( $mod_name == 'make_topright_post_title' ) {
					$mod_post_id_field = 'make_topright_post_url';
				} elseif ( $mod_name == 'make_bottomright_post_title' ) {
					$mod_post_id_field = 'make_bottomright_post_url';
				}

				$result = get_the_title( absint( get_theme_mod( $mod_post_id_field ) ) );
			}
			break;

		// Handle the featured post excerpt
		case 'make_featured_post_excerpt' :
			$featured_excerpt = get_theme_mod( 'make_featured_post_excerpt' );

			if ( ! empty( $featured_excerpt ) ) {
				$result = $featured_excerpt;
			} else {
				$the_post = get_post( absint( get_theme_mod( 'make_featured_post_url' ) ) );
				$result = $the_post->post_excerpt;
			}

	}

	if ( $echo ) {
		echo $result;
	} else {
		return $result;
	}
}


/**
 * Helper function to ensure a theme modification exists
 * @param  string $mod_name The name of the theme modification to check
 * @return boolean
 *
 * @since  HAL 9000
 */
function make_has_takeover_mod( $mod_name ) {
	$val = get_theme_mod( sanitize_text_field( $mod_name ) );

	if ( isset( $val ) && ! empty( $val ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 *
 * Sets up the interface in the theme customizer for the takeover options
 * @param  object $wp_customize An instance of the WP_Customize_Manager class
 * @return void
 *
 */
function make_header_options( $wp_customize ) {

  // Register our section
  $wp_customize->add_section( 'make_header', array(
    'title' => 'Header',
    'priority' => 1
  ) );

  // Register the enable checkbox
  $wp_customize->add_setting( 'make_header_promo_enable', array(
    'default' => '',
  ) );
	$wp_customize->add_control( 'make_header_promo_enable', array(
    'type' => 'checkbox',
    'label' => 'Enable Above Nav Promo. This is Geo Targeted to CA visitors only. Will not show for non CA visitors.',
    'section' => 'make_header',
  	'priority' => 14,
  ) );

  // Register the html for the page.
  $wp_customize->add_setting( 'make_header_promo_text', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_header_promo_text', array(
    'section' => 'make_header',
    'label' => 'Promo text',
    'type' => 'text',
    'priority' => 15,
  ) );

  // Register the html for the page.
  $wp_customize->add_setting( 'make_header_promo_link', array(
    'default' => '',
    'sanitize_callback' => 'esc_url',
  ) );
  $wp_customize->add_control( 'make_header_promo_link', array(
    'section' => 'make_header',
    'label' => 'Promo link',
    'type' => 'text',
    'priority' => 16,
  ) );


  // Register the enable checkbox
  $wp_customize->add_setting( 'make_header_bluebar_enable', array(
    'default' => '',
  ) );
	$wp_customize->add_control( 'make_header_bluebar_enable', array(
    'type' => 'checkbox',
    'label' => 'Enable Under Nav Blue Bar.',
    'section' => 'make_header',
  	'priority' => 17,
  ) );

  // Register the html for the page.
  $wp_customize->add_setting( 'make_header_bluebar_text', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_header_bluebar_text', array(
    'section' => 'make_header',
    'label' => 'Blue bar text',
    'type' => 'text',
    'priority' => 18,
  ) );

  // Register the html for the page.
  $wp_customize->add_setting( 'make_header_bluebar_link', array(
    'default' => '',
    'sanitize_callback' => 'esc_url',
  ) );
  $wp_customize->add_control( 'make_header_bluebar_link', array(
    'section' => 'make_header',
    'label' => 'Blue bar link',
    'type' => 'text',
    'priority' => 19,
  ) );

}
add_action( 'customize_register', 'make_header_options' );



function make_home_3_events( $wp_customize ) {

  // Register our section.
  $wp_customize->add_section( 'make_home3x', array(
    'title' => 'Homepage Events 3x',
    'priority' => 2
  ) );

  // Turn it on or off
  $wp_customize->add_setting( 'make_home3x_on_off', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_on_off', array(
    'type' => 'checkbox',
    'label' => 'Turn on the dynamic 3 events? (this hides the old 3 image events)',
    'section' => 'make_home3x',
    'priority' => 11,
  ) );

  // Event 1 URL
  $wp_customize->add_setting( 'make_home3x_1url', array(
    'default' => '',
    'sanitize_callback' => 'esc_url',
  ) );
  $wp_customize->add_control( 'make_home3x_1url', array(
    'section' => 'make_home3x',
    'label' => 'Event 1 URL',
    'type' => 'text',
    'priority' => 12,
  ) );

  // Event 1 top text
  $wp_customize->add_setting( 'make_home3x_1top', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_1top', array(
    'section' => 'make_home3x',
    'label' => 'Top Aligned Text',
    'type' => 'text',
    'priority' => 13,
  ) );

  // Event 1 small text upper
  $wp_customize->add_setting( 'make_home3x_1smalltop', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_1smalltop', array(
    'section' => 'make_home3x',
    'label' => 'Small Text Above Title (optional)',
    'type' => 'text',
    'priority' => 14,
  ) );

  // Event 1 title
  $wp_customize->add_setting( 'make_home3x_1title', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_1title', array(
    'section' => 'make_home3x',
    'label' => 'Title',
    'type' => 'text',
    'priority' => 15,
  ) );

  // Event 1 bottom text upper
  $wp_customize->add_setting( 'make_home3x_1smallbot', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_1smallbot', array(
    'section' => 'make_home3x',
    'label' => 'Small Text Below Title (optional)',
    'type' => 'text',
    'priority' => 16,
  ) );

  // Event 1 button
  $wp_customize->add_setting( 'make_home3x_1btn', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_1btn', array(
    'section' => 'make_home3x',
    'label' => 'Red Button Text',
    'type' => 'text',
    'priority' => 17,
  ) );

  // Event 1 image
  $wp_customize->add_setting( 'make_home3x_1img', array(
      'default' => '',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control(
      $wp_customize,
      'make_home3x_1img',
      array(
        'label'    => 'Right aligned Image. Image height should be 220px and width is up to you. Square images work best.',
        'section'  => 'make_home3x',
        'settings' => 'make_home3x_1img',
        'priority' => 18,
      )
    )
  );



  // Event 2 URL
  $wp_customize->add_setting( 'make_home3x_2url', array(
    'default' => '',
    'sanitize_callback' => 'esc_url',
  ) );
  $wp_customize->add_control( 'make_home3x_2url', array(
    'section' => 'make_home3x',
    'label' => 'Event 2 URL',
    'type' => 'text',
    'priority' => 19,
  ) );

  // Event 2 top text
  $wp_customize->add_setting( 'make_home3x_2top', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_2top', array(
    'section' => 'make_home3x',
    'label' => 'Top Aligned Text',
    'type' => 'text',
    'priority' => 20,
  ) );

  // Event 2 small text upper
  $wp_customize->add_setting( 'make_home3x_2smalltop', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_2smalltop', array(
    'section' => 'make_home3x',
    'label' => 'Small Text Above Title (optional)',
    'type' => 'text',
    'priority' => 21,
  ) );

  // Event 2 title
  $wp_customize->add_setting( 'make_home3x_2title', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_2title', array(
    'section' => 'make_home3x',
    'label' => 'Title',
    'type' => 'text',
    'priority' => 22,
  ) );

  // Event 2 bottom text upper
  $wp_customize->add_setting( 'make_home3x_2smallbot', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_2smallbot', array(
    'section' => 'make_home3x',
    'label' => 'Small Text Below Title (optional)',
    'type' => 'text',
    'priority' => 23,
  ) );

  // Event 2 button
  $wp_customize->add_setting( 'make_home3x_2btn', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_2btn', array(
    'section' => 'make_home3x',
    'label' => 'Red Button Text',
    'type' => 'text',
    'priority' => 24,
  ) );

  // Event 2 image
  $wp_customize->add_setting( 'make_home3x_2img', array(
      'default' => '',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control(
      $wp_customize,
      'make_home3x_2img',
      array(
        'label'    => 'Right aligned Image. Image height should be 220px and width is up to you. Square images work best.',
        'section'  => 'make_home3x',
        'settings' => 'make_home3x_2img',
        'priority' => 25,
      )
    )
  );



  // Event 3 URL
  $wp_customize->add_setting( 'make_home3x_3url', array(
    'default' => '',
    'sanitize_callback' => 'esc_url',
  ) );
  $wp_customize->add_control( 'make_home3x_3url', array(
    'section' => 'make_home3x',
    'label' => 'Event 3 URL',
    'type' => 'text',
    'priority' => 26,
  ) );

  // Event 3 top text
  $wp_customize->add_setting( 'make_home3x_3top', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_3top', array(
    'section' => 'make_home3x',
    'label' => 'Top Aligned Text',
    'type' => 'text',
    'priority' => 27,
  ) );

  // Event 3 small text upper
  $wp_customize->add_setting( 'make_home3x_3smalltop', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_3smalltop', array(
    'section' => 'make_home3x',
    'label' => 'Small Text Above Title (optional)',
    'type' => 'text',
    'priority' => 28,
  ) );

  // Event 3 title
  $wp_customize->add_setting( 'make_home3x_3title', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_3title', array(
    'section' => 'make_home3x',
    'label' => 'Title',
    'type' => 'text',
    'priority' => 29,
  ) );

  // Event 3 bottom text upper
  $wp_customize->add_setting( 'make_home3x_3smallbot', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_3smallbot', array(
    'section' => 'make_home3x',
    'label' => 'Small Text Below Title (optional)',
    'type' => 'text',
    'priority' => 30,
  ) );

  // Event 3 button
  $wp_customize->add_setting( 'make_home3x_3btn', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_home3x_3btn', array(
    'section' => 'make_home3x',
    'label' => 'Red Button Text',
    'type' => 'text',
    'priority' => 31,
  ) );

  // Event 3 image
  $wp_customize->add_setting( 'make_home3x_3img', array(
      'default' => '',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control(
      $wp_customize,
      'make_home3x_3img',
      array(
        'label'    => 'Right aligned Image. Image height should be 220px and width is up to you. Square images work best.',
        'section'  => 'make_home3x',
        'settings' => 'make_home3x_3img',
        'priority' => 32,
      )
    )
  );

}
add_action( 'customize_register', 'make_home_3_events' );



function make_ad_options( $wp_customize ) {

  // Register our section.
  $wp_customize->add_section( 'make_ads', array(
    'title' => 'Ad Options',
    'priority' => 10
  ) );

  // Register the 1x1 checkbox.
  $wp_customize->add_setting( 'make_ads_1x1_enable', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_ads_1x1_enable', array(
      'type' => 'checkbox',
      'label' => 'Enable 1x1 Ad Unit',
      'section' => 'make_ads',
    	'priority' => 11,
  ) );

  // Register the scroll load ads checkbox.
  $wp_customize->add_setting( 'make_ads_scroll_enable', array(
    'default' => '',
  ) );
  $wp_customize->add_control( 'make_ads_scroll_enable', array(
      'type' => 'checkbox',
      'label' => 'Enable Scroll Loading Ads',
      'section' => 'make_ads',
    	'priority' => 12,
  ) );

}
add_action( 'customize_register', 'make_ad_options' );
