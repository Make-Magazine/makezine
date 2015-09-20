<?php
//
// CheezCap - Cheezburger Custom Administration Panel
// (c) 2008 - 2011 Cheezburger Network (Pet Holdings, Inc.)
// LOL: http://cheezburger.com
// Source: http://github.com/cheezburger/cheezcap/
// Authors: Kyall Barrows, Toby McKes, Stefan Rusek, Scott Porad
// License: GNU General Public License, version 2 (GPL), http://www.gnu.org/licenses/gpl-2.0.html
//
$themename = 'CheezCap'; // used on the title of the custom admin page
$req_cap_to_edit = 'manage_options'; // the user capability that is required to access the CheezCap settings page
$cap_menu_position = 99; // OPTIONAL: This value represents the order in the dashboard menu that the CheezCap menu will display in. Larger numbers push it further down.
$cap_icon_url = ""; // OPTIONAL: Path to a custom icon for the CheezCap menu item. ex. $cap_icon_url = WP_CONTENT_URL . '/your-theme-name/images/awesomeicon.png'; Image size should be around 20px x 20px.

$number_entries = array( '', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '12', '14', '16', '18', '20' );
$number_entries_labels = array( '== Select a Number ==' );

$cap = new CheezCap( array(

		new CheezCapGroup( 'Featured Posts', 'firstCheezCapGroup',
			array(
				new CheezCapTextOption(
					'Main Item Title',
					'This is the big image on the left...',
					'main_title',
					''
				),
				new CheezCapTextOption(
					'Main Item Post ID',
					'This is the post ID for the main post. Hover over "Edit Post" and look for the number in the URL',
					'main_id',
					''
				),
				new CheezCapTextOption(
					'Main Item Subtitle',
					'',
					'main_subtitle',
					''
				),
				new CheezCapTextOption(
					'Main Item Link',
					'This is the link to the main post. Make sure to use add the http://',
					'main_link',
					''
				),
				new CheezCapTextOption(
					'Main Item Image URL',
					'Add the uploaded image URL.',
					'main_url',
					''
				),
				new CheezCapTextOption(
					'Top Right Item Title',
					'This is the image on the top right.',
					'top_title',
					''
				),
				new CheezCapTextOption(
					'Top Right Item Post ID',
					'This is the post ID for the top-right post. Hover over "Edit Post" and look for the number in the URL',
					'top_id',
					''
				),
				new CheezCapTextOption(
					'Top Right Item Link',
					'This is the link that to the top-right post. Make sure to use add the http://',
					'top_link',
					''
				),
				new CheezCapTextOption(
					'Top Right Image URL',
					'Add the uploaded image URL.',
					'top_url',
					''
				),
				new CheezCapTextOption(
					'Bottom Right Item Title',
					'This is the image on the bottom right.',
					'bottom_title',
					''
				),
				new CheezCapTextOption(
					'Bottom Right Item Post ID',
					'This is the post ID for the bottom-right post. Hover over "Edit Post" and look for the number in the URL',
					'bottom_id',
					''
				),
				new CheezCapTextOption(
					'Bottom Right Item Link',
					'This is the link that to the bottom-right post. Make sure to use add the http://',
					'bottom_link',
					''
				),
				new CheezCapTextOption(
					'Bottom Right Image URL',
					'Add the uploaded image URL.',
					'bottom_url',
					''
				),								
			)
		),				
	), array(
		'themename' => 'Home', // used on the title of the custom admin page
		'req_cap_to_edit' => 'manage_options', // the user capability that is required to access the CheezCap settings page
		'cap_menu_position' => 99, // OPTIONAL: This value represents the order in the dashboard menu that the CheezCap menu will display in. Larger numbers push it further down.
		'cap_icon_url' => '', // OPTIONAL: Path to a custom icon for the CheezCap menu item. ex. $cap_icon_url = WP_CONTENT_URL . '/your-theme-name/images/awesomeicon.png'; Image size should be around 20px x 20px.
	)
);


function make_get_cap_option( $option_name ) {
	global $cap;
	return $cap->$option_name;
}