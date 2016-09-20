<?php
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
