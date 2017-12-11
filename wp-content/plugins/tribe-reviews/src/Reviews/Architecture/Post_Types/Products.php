<?php

namespace Reviews\Architecture\Post_Types;

class Products {

	const NAME = 'products';

	public function __construct() {
		add_action( 'init', [ $this, 'create_post_type' ], 10 );
		add_action( 'init', [ $this, 'acf_fields' ], 11 );
	}

	public function create_post_type() {

		$labels = [
			'name'               => 'Product Reviews',
			'single_name'        => 'Product Review',
			'add_new_item'       => 'Add New Product Review',
			'edit_item'          => 'Edit Product Review',
			'new_item'           => 'New Product Review',
			'all_items'          => 'All Product Reviews',
			'view_item'          => 'View Product Review',
			'search_items'       => 'Search Product Reviews',
			'not_found'          => 'No Product Reviews found',
			'not_found_in_trash' => 'No Product Reviews found in the Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Product Reviews',
		];

		register_post_type( self::NAME, [
			'labels'      => $labels,
			'public'      => true,
			'has_archive' => false,
			'rewrite'     => [ 'slug' => sanitize_title( $labels['single_name'] ) ],
			'menu_icon'   => 'dashicons-cart',
			'supports'    => [ 'title', 'editor', 'thumbnail', 'author' ],
		] );

		register_taxonomy_for_object_type( 'post_tag', self::NAME );

	}

	public function acf_fields() {
		if ( ! function_exists( 'register_field_group' ) ) {
			return;
		}

		register_field_group( array(
			'id'         => 'acf_product-specs',
			'title'      => 'Displayed Specs',
			'fields'     => array(
				array(
					'key'          => 'field_5630fdsr2fdswsf8f',
					'label'        => 'Specs to show on the single',
					'name'         => 'specs',
					'type'         => 'repeater',
					'instructions' => 'Add label and value pairs describing the specification of the product. Note that these are simply for visual display and do not affect the filters should this product be part of a comparison.',
					'sub_fields'   => array(
						array(
							'key'           => 'field_563fds12fbf90',
							'label'         => 'Label',
							'name'          => 'label',
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
							'key'           => 'field_563gfds32r0bf91',
							'label'         => 'Description',
							'name'          => 'description',
							'type'          => 'text',
							'column_width'  => '',
							'default_value' => '',
							'placeholder'   => '',
							'prepend'       => '',
							'append'        => '',
							'formatting'    => 'none',
							'maxlength'     => '',
						),
					),
					'row_min'      => 0,
					'row_limit'    => '',
					'layout'       => 'table',
					'button_label' => 'Add Row',
				),
			),
			'location'   => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'products',
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


		register_field_group( array(
			'id'         => 'acf_product-filters',
			'title'      => 'Comparison data for filters',
			'fields'     => array(
				array(
					'key'     => 'field_564586b576ee9',
					'label'   => '',
					'name'    => '',
					'type'    => 'message',
					'message' => 'Add key meta information about the product to power the filters. This is ONLY used when the product is part of a comparison.',
				),
				array(
					'key'           => 'field_56304faf8e32a',
					'label'         => 'Recommendations',
					'name'          => 'winners',
					'type'          => 'checkbox',
					'choices'       => array(
						''                        => 'None',
						'best-overall'            => 'Best Overall',
						'best-value'              => 'Best Value',
						'best-for-schools'        => 'Best for Schools',
						'most-portable'           => 'Most Portable',
						'outstanding-open-source' => 'Outstanding Open Source',
						'best-large-format'       => 'Best Large Format',
					),
					'default_value' => '',
				),
				array(
					'key'               => 'field_56305082d20a9',
					'label'             => 'Build Volume Filter',
					'name'              => 'build_volume_filter',
					'type'              => 'radio',
					'choices'           => array(
						'small'  => 'Small',
						'medium' => 'Medium',
						'large'  => 'Large',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_563050a7d20ab',
					'label'             => 'Bed Style',
					'name'              => 'bed_style',
					'type'              => 'radio',
					'choices'           => array(
						'heated'   => 'Heated',
						'unheated' => 'Not Heated',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'           => 'field_563050d8d20ac',
					'label'         => 'Filament Size',
					'name'          => 'filament_size',
					'type'          => 'radio',
					'choices'       => array(
						'1.75mm' => '1.75mm',
						'3mm'    => '3mm',
					),
					'default_value' => '',
					'layout'        => 'horizontal'
				),
				array(
					'key'           => 'field_563050ebd20ad',
					'label'         => 'Materials',
					'name'          => 'materials',
					'type'          => 'radio',
					'choices'       => array(
						'open'        => 'Open',
						'proprietary' => 'Proprietary',
					),
					'default_value' => '',
					'layout'        => 'horizontal'
				),
				array(
					'key'               => 'field_56305116d20af',
					'label'             => 'Hot End',
					'name'              => 'hot_end',
					'type'              => 'radio',
					'choices'           => array(
						'standard'  => 'Standard',
						'high-temp' => 'High Temperature',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_56305139d20b0',
					'label'             => 'Temperature Control',
					'name'              => 'temperature_control',
					'type'              => 'radio',
					'choices'           => array(
						'1'  => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_5630518a27c64',
					'label'             => 'Print Untethered',
					'name'              => 'print_untethered',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_5630519e27c66',
					'label'             => 'Onboard Controls',
					'name'              => 'onboard_controls',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'           => 'field_563051be27c68',
					'label'         => 'OS',
					'name'          => 'os',
					'type'          => 'checkbox',
					'choices'       => array(
						'windows' => 'Windows',
						'mac'     => 'Mac',
						'linux'   => 'Linux',
					),
					'default_value' => '',
					'layout'        => 'horizontal',
				),
				array(
					'key'               => 'field_563051d827c69',
					'label'             => 'Open Source Software',
					'name'              => 'open_source_software',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_563051e827c6b',
					'label'             => 'Open Source Hardware',
					'name'              => 'open_source_hardware',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),

			),
			'location'   => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'products',
					),
					array(
						'param'    => 'post_taxonomy',
						'operator' => '==',
						'value'    => 'product-categories:printers',
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


		register_field_group( array(
			'id'         => 'acf_product-filters-boards',
			'title'      => 'Comparison data for filters',
			'fields'     => array(
				array(
					'key'     => 'field_564586b576ee9',
					'label'   => '',
					'name'    => '',
					'type'    => 'message',
					'message' => 'Add key meta information about the product to power the filters. This is ONLY used when the product is part of a comparison.',
				),
				array(
					'key'           => 'field_bo56304faf8e32a',
					'label'         => 'Recommendations',
					'name'          => 'winners',
					'type'          => 'checkbox',
					'choices'       => array(
						''                => 'None',
						'robotics'        => 'Robotics',
						'wearables'       => 'Wearables',
						'education'       => 'Education',
						'light-and-sound' => 'Light and Sound',
						'IoT' 						=> 'IoT',
						'sub-10'          => 'Dirt Cheap',
					),
					'default_value' => '',
				),
				array(
					'key'               => 'field_bo56305082d20a9',
					'label'             => 'Type',
					'name'              => 'type',
					'type'              => 'radio',
					'choices'           => array(
						'microcontroller'       => 'Microcontroller',
						'single-board-computer' => 'Single Board Computer',
						'fpga'                  => 'FPGA',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_bo563050a7d20ab',
					'label'             => 'Software',
					'name'              => 'software',
					'type'              => 'radio',
					'choices'           => array(
						'arduino' => 'Arduino',
						'linux'   => 'Linux',
						'other'   => 'Other',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'           => 'field_bo563050d8d20ac',
					'label'         => 'Clock Speed',
					'name'          => 'clock_speed',
					'type'          => 'radio',
					'choices'       => array(
						'8MHz'   => '8 MHz+',
						'16MHz'  => '16 MHz+',
						'32MHz'  => '32 MHz+',
						'100MHz' => '100 MHz+',
						'1GHz'   => '1 GHz+',
					),
					'default_value' => '',
					'layout'        => 'horizontal'
				),
				array(
					'key'           => 'field_bo563050ebd20ad',
					'label'         => 'Processor',
					'name'          => 'processor',
					'type'          => 'radio',
					'choices'       => array(
						'8bit'  => '8-bit',
						'32bit' => '32-bit',
						'64bit' => '64-bit',
					),
					'default_value' => '',
					'layout'        => 'horizontal'
				),
				array(
					'key'               => 'field_bo56305116d20af',
					'label'             => 'I/O Pins Digital',
					'name'              => 'pins_digital',
					'type'              => 'radio',
					'choices'           => array(
						'1-10'  => '1-10',
						'11-20' => '11-20',
						'21-50' => '21-50',
						'50+'   => '50+',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_bo563fsdfcxbcv40af',
					'label'             => 'I/O Pins Analog',
					'name'              => 'pins_analog',
					'type'              => 'radio',
					'choices'           => array(
						''     => 'None',
						'1-3'  => '1-3',
						'4-6'  => '4-6',
						'7-12' => '7-12',
						'13+'  => '13+',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_bo56305139d20b0',
					'label'             => 'WiFi',
					'name'              => 'wifi',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_bo5630518a27c64',
					'label'             => 'Video',
					'name'              => 'video',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_bo5630519e27c66',
					'label'             => 'Bluetooth',
					'name'              => 'bluetooth',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
				array(
					'key'               => 'field_bo563051d827c69',
					'label'             => 'Ethernet',
					'name'              => 'ethernet',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'products',
					),
					array(
						'param'    => 'post_taxonomy',
						'operator' => '==',
						'value'    => 'product-categories:boards',
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

		register_field_group( array(
			'id'         => 'acf_product-information',
			'title'      => 'Product information',
			'fields'     => array(
				array(
					'key'     => 'field_56fds2fewvdswee9',
					'label'   => '',
					'name'    => '',
					'type'    => 'message',
					'message' => 'Ready to add the scores? You can add them in the comparison once you connect it in the product review.',
				),
				array(
					'key'          => 'field_5630fds43rf327a',
					'label'        => 'Hero Image',
					'name'         => 'hero_image',
					'type'         => 'image',
					'save_format'  => 'object',
					'preview_size' => 'thumbnail',
					'library'      => 'all',
					'required'     => 1
				),
				array(
					'key'           => 'field_56304f648e325',
					'label'         => 'Name of the machine',
					'name'          => 'name_of_the_machine',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'none',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_56304f778e326',
					'label'         => 'Manufacturer',
					'name'          => 'manufacturer',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'none',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_56304f848e327',
					'label'         => 'Manufacturer URL',
					'name'          => 'manufacturer_url',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'none',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_56304f968e328',
					'label'         => 'Price as Tested',
					'name'          => 'price_as_tested',
					'type'          => 'number',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'min'           => '',
					'max'           => '',
					'step'          => '',
				),
				array (
					'key' => 'field_5644e918427bd',
					'label' => '3D View Config File Path',
					'name' => '3d_view_config',
					'type' => 'text',
					'instructions' => 'Please provide a relative path to the uploaded config file for this product\'s 3D View. Generally, config files should be located at:<br /><code>/wp-content/uploads/wr360_assets/[product_name]/[product_name].xml</code>',
					'default_value' => '',
					'placeholder' => '/wp-content/uploads/wr360_assets/[product_name]/[product_name].xml',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				),
        array(
					'key'           => 'field_prodDisc',
					'label'         => 'Discontinued',
					'name'          => 'discontinued',
					'type'          => 'radio',
					'choices'       => array(
						'no'          => 'No',
						'yes'         => 'Yes'
					),
					'default_value' => 'no',
				),
       
			),
			'location'   => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'products',
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

		register_field_group( array(
			'id'         => 'acf_product-sidebar',
			'title'      => 'Sidebar information',
			'fields'     => array(
				array(
					'key'           => 'field_5fds43e3ewqdsa99',
					'label'         => 'Why to buy Title',
					'name'          => 'why_to_buy_title',
					'type'          => 'text',
					'default_value' => 'Why To Buy',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_563045tgehf425',
					'label'         => 'Why to buy',
					'name'          => 'why_to_buy',
					'type'          => 'wysiwyg',
					'default_value' => '',
					'toolbar'       => 'full',
					'media_upload'  => 'yes',
				),
				array(
					'key'           => 'field_5630fshj3499',
					'label'         => 'Buy Link',
					'name'          => 'buy_link',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
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
					'key'           => 'field_4dfgfre12e2',
					'label'         => 'Scores Image Title',
					'name'          => 'scores_image_title',
					'type'          => 'text',
					'default_value' => 'How this scored',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'          => 'field_563fasd35fdsf',
					'label'        => 'Scores Image',
					'name'         => 'scores_image',
					'type'         => 'image',
					'save_format'  => 'object',
					'preview_size' => 'thumbnail',
					'library'      => 'all',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'products',
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

    register_field_group( array(
			'id'         => 'acf_product-filters-drones',
			'title'      => 'Comparison data for filters',
			'fields'     => array(
				array(
					'key'     => 'field_drones001',
					'label'   => '',
					'name'    => '',
					'type'    => 'message',
					'message' => 'Add key meta information about the product to power the filters. This is ONLY used when the product is part of a comparison.',
				),
				array(
					'key'           => 'field_drones002',
					'label'         => 'Recommendations',
					'name'          => 'winners',
					'type'          => 'checkbox',
					'choices'       => array(
						''            => 'None',
						'overall'     => 'Best Overall',
						'beginners'   => 'Best for Beginners',
						'hackable'    => 'Most Hackable',
					),
					'default_value' => '',
				),

          //Select One: 0-600', 601'-1200', 1201'-3000', 3001+
				array(
					'key'               => 'field_drones003',
					'label'             => 'Range',
					'name'              => 'range',
					'type'              => 'radio',
					'choices'           => array(
						'0'               => "0-600'",
						'1'               => "601'-1200'",
						'2'               => "1201'-3000'",
						'3'               => "3001+",
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
          //Select Any: Built-In, GoPro
          array(
					'key'               => 'field_drones007',
					'label'             => 'Go Pro Camera',
					'name'              => 'gopro',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),
          array(
					'key'               => 'field_drones008',
					'label'             => 'Built-In Camera',
					'name'              => 'builtin',
					'type'              => 'radio',
					'choices'           => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => '',
					'layout'            => 'horizontal',
				),

          //Select One: 4K, Variable, 2.7K, 1080p
				array(
					'key'           => 'field_drones005',
					'label'         => 'Camera Resolution',
					'name'          => 'cameraresolution',
					'type'          => 'radio',
          'choices'       => array(
						'4k'          => '4K',
						'variable'    => 'Variable',
						'27k'         => '2.7K',
						'1080p'       => '1080p',
					),
					'default_value' => '',
					'layout'        => 'horizontal'
				),
          //Select One: 0-7 minutes, 7-15 minutes, 15-20 minutes, 20+ minutes
				array(
					'key'           => 'field_drones006',
					'label'         => 'Battery Life',
					'name'          => 'batterylife',
					'type'          => 'radio',
					'choices'       => array(
						'0'           => '0-7 minutes',
						'1'           => '7-15 minutes',
						'2'           => '15-20 minutes',
						'3'           => '20+ minutes',
					),
					'default_value' => '',
					'layout'        => 'horizontal'
				),

			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'products',
					),
					array(
						'param'    => 'post_taxonomy',
						'operator' => '==',
						'value'    => 'product-categories:drones',
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



}