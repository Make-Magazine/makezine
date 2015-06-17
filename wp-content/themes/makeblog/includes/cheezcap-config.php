<?php
/**
 * Config for CheezCAP
 */

$themename = 'CheezCap'; // used on the title of the custom admin page
$req_cap_to_edit = 'manage_options'; // the user capability that is required to access the CheezCap settings page
$cap_menu_position = 99; // OPTIONAL: This value represents the order in the dashboard menu that the CheezCap menu will display in. Larger numbers push it further down.
$cap_icon_url = ""; // OPTIONAL: Path to a custom icon for the CheezCap menu item. ex. $cap_icon_url = WP_CONTENT_URL . '/your-theme-name/images/awesomeicon.png'; Image size should be around 20px x 20px.

function cap_get_options() {
	$number_entries = array( 'Select a Number:', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '12', '14', '16', '18', '20' );

	return array(
		new Group( 'Featured Posts', 'firstGroup',
			array(
				new TextOption(
					'Ribbon Title',
					'What do you want the ribbon to say, keep this short. Ten characters or so...',
					'ribbon_title',
					''
				),
				new BooleanOption(
					'Display Ribbon Title',
					'Choose if you wish to display or hide the Ribbon Title.',
					'ribbon_title_display',
					'1'
				),
				new TextOption(
					'Main Item Title',
					'This is the big image on the left...',
					'main_title',
					''
				),
				new TextOption(
					'Main Item Subtitle',
					'',
					'main_subtitle',
					''
				),
				new TextOption(
					'Main Item Link',
					'This is the link that to the main post. Make sure to use add the http://',
					'main_link',
					''
				),
				new TextOption(
					'Main Item Image URL',
					'Add the uploaded image URL. Size should be 301px &times; 400px.',
					'main_url',
					''
				),
				new TextOption(
					'Main Item Image ID',
					'Add the ID of the image that you would like to use here. It will take the size from p1 thumbnail.',
					'main_id',
					''
				),
				new TextOption(
					'Top Right Item Title',
					'This is the big image on the top right.',
					'top_title',
					''
				),
				new TextOption(
					'Top Right Item Subtitle',
					'',
					'top_subtitle',
					''
				),
				new TextOption(
					'Top Right Item Link',
					'This is the link that to the main post. Make sure to use add the http://',
					'top_link',
					''
				),
				new TextOption(
					'Top Right Image URL',
					'Add the uploaded image URL. Size should be 290px &times; 180px.',
					'top_url',
					''
				),
				new TextOption(
					'Top Right Image ID',
					'Add the ID of the image that you would like to use here. It will take the size from p2 thumbnail.',
					'top_url_id',
					''
				),
				new TextOption(
					'Bottom Right Item Title',
					'This is the big image on the top right.',
					'bottom_title',
					''
				),
				new TextOption(
					'Bottom Right Item Subtitle',
					'',
					'bottom_subtitle',
					''
				),
				new TextOption(
					'Bottom Right Item Link',
					'This is the link that to the main post. Make sure to use add the http://',
					'bottom_link',
					''
				),
				new TextOption(
					'Bottom Right Image URL',
					'Add the uploaded image URL. Size should be 290px &times; 180px.',
					'bottom_url',
					''
				),
				new TextOption(
					'Bottom Right Image ID',
					'Add the ID of the image that you would like to use here. It will take the size from p2 thumbnail.',
					'bottom_url_id',
					''
				),
				new TextOption(
					'Hot Topics',
					'Add an ordered list with three items to be used in the Hot Topic section near the search bar at the top of the page.',
					'hot_topics',
					'<ul class="terms">
						<li><a href="http://blog.makezine.com/kids">Kids</a></li>
						<li><a href="http://blog.makezine.com/arduino/">Arduino</a></li>
						<li><a href="http://blog.makezine.com/category/desktop-manufacturing/3d-printing-desktop-manufacturing/">3D Printing</a></li>
					</ul>',
					'true'
				),
				new TextOption(
					'Livestream Embed',
					'When you add the src of the Flash embed of a Livestream video here, it will add it under the feature boxes on the home page.',
					'livestream',
					''
				),
				new TextOption(
					'Featured Posts',
					'Add the post IDs of one post that you want to feature.',
					'daily',
					'274361'
				),
				new TextOption(
					'Weekly Theme',
					'Add the post IDs of the five posts that you want to feature. They need to be in order, m->f.',
					'weekly',
					'274361'
				),
		
			)
		),
		new Group( 'Craft Featured Posts', 'second_group',
			array(
				new TextOption(
					'Ribbon Title',
					'What do you want the ribbon to say, keep this short. Ten characters or so...',
					'craft_ribbon_title',
					''
				),
				new TextOption(
					'Main Item Title',
					'This is the big image on the left...',
					'craft_main_title',
					''
				),
				new TextOption(
					'Main Item Subtitle',
					'',
					'craft_main_subtitle',
					''
				),
				new TextOption(
					'Main Item Link',
					'This is the link that to the main post. Make sure to use add the http://',
					'craft_main_link',
					''
				),
				new TextOption(
					'Main Item Image URL',
					'Add the uploaded image URL. Size should be 301px &times; 400px.',
					'craft_main_url',
					''
				),
				new TextOption(
					'Top Right Item Title',
					'This is the big image on the top right.',
					'craft_top_title',
					''
				),
				new TextOption(
					'Top Right Item Subtitle',
					'',
					'craft_top_subtitle',
					''
				),
				new TextOption(
					'Top Right Item Link',
					'This is the link that to the main post. Make sure to use add the http://',
					'craft_top_link',
					''
				),
				new TextOption(
					'Top Right Image URL',
					'Add the uploaded image URL. Size should be 290px &times; 180px.',
					'craft_top_url',
					''
				),
				new TextOption(
					'Bottom Right Item Title',
					'This is the big image on the top right.',
					'craft_bottom_title',
					''
				),
				new TextOption(
					'Bottom Right Item Subtitle',
					'',
					'craft_bottom_subtitle',
					''
				),
				new TextOption(
					'Bottom Right Item Link',
					'This is the link that to the main post. Make sure to use add the http://',
					'craft_bottom_link',
					''
				),
				new TextOption(
					'Bottom Right Image URL',
					'Add the uploaded image URL. Size should be 290px &times; 180px.',
					'craft_bottom_url',
					''
				),
				new TextOption(
					'Hot Topics',
					'Add an ordered list with three items to be used in the Hot Topic section near the search bar at the top of the page.',
					'craft_hot_topics',
					'<ul class="terms">
						<li><a href="http://blog.makezine.com/kids">Kids</a></li>
						<li><a href="http://blog.makezine.com/arduino/">Arduino</a></li>
						<li><a href="http://blog.makezine.com/category/desktop-manufacturing/3d-printing-desktop-manufacturing/">3D Printing</a></li>
					</ul>',
					'true'
				),
				new TextOption(
					'BIG OL\' YOUTUBE VIDEO',
					'When you add the URL a YouTube video here, it will add it under the feature boxes on the home page.',
					'craft_youtube',
					''
				),
				new TextOption(
					'Video Heading',
					'This goes above the YouTube video',
					'youtube_feature_heading',
					''
				),
			)
		),
		new Group( 'Featured Content', 'anotherGroup',
			array(
				new TextOption(
					'BIG OL\' YOUTUBE VIDEO',
					'When you add the URL of a YouTube video here, it will add it under the feature boxes on the home page. You can also add a post ID here, and it will pull the linked YouTube video.',
					'youtube',
					''
				),
				new TextOption(
					'Featured Video Heading',
					'Something along the lines of "Maker Shed Exclusive"',
					'feature_heading',
					'Maker Shed Exclusive'
				),
				new TextOption(
					'Featured Video Link',
					'Add the URL or ID of the page you wish to link to .',
					'feature_url',
					''
				),
				new TextOption(
					'Featured Box Title',
					'This is the title of the content that you want to go in the box.',
					'feature_title',
					'The Arduino Forager'
				),
				new TextOption(
					'Featured Box Caption',
					'Keep this caption kinda short, no more then 30 words. If you need to use an apostrope, type & #39; w/o space.',
					'feature_caption',
					'Find out why the SuperCap racer is the best kit to start learning how to solder today. This is a great little write up rolls...',
					true
				),
				new TextOption(
					'Featured Box Image URL',
					'Add the image URL here. Don\'t forget the http://',
					'feature_img'
				),
				new TextOption(
					'Featured Box Link URL',
					'Add the link URL here. Don\'t forget the http://',
					'feature_link',
					'http://makershed.com'
				),	
			)
		),
		new Group( 'Hangouts', 'hangouts',
			array(
				new BooleanOption(
					'Display Daily Schedule',
					'When enabled, this will remove the weekly schedule, and replace it with the content from below to create the daily blurb.',
					'daily_hangout',
					'default'
				),
				new TextOption(
					'Daily Heading',
					'Heading for the daily schedule, might be something like this, "Join MAKE on Google+ for Today’s Hangout"',
					'hangout_heading',
					'Join MAKE on Google+ for Today’s Hangout'
				),
				new TextOption(
					'Daily Blurb',
					'Heading for the daily schedule, might be something like this, "Today’s Hangout: This is photoshop\'s version..."',
					'hangout_blurb',
					'Maker Shed Exclusive'
				),
				// new TextOption(
				// 	'Daily Caption',
				// 	'Caption for the daily schedule, might be something like this, "Watch the hangout at google.com/+make" Don\'t forget to add the HTML for any links.',
				// 	'hangout_caption',
				// 	'Watch the hangout at <a href="http://google.com/+make">google.com/+make</a>'
				// ),
				new BooleanOption(
					'Hangout On Air',
					'When enabled, this will make the header animate wit the .gif.',
					'onair',
					'onair'
				),
			)
		),
		new Group( 'Weekly Take-Over', 'weekly-take-over',
			array(
				new BooleanOption(
					'Weekly Take-Over',
					'Do you want to enable the Weekly Take-Over design on the home page?',
					'weekly_takeover_enabled',
					'1'
				),
				new TextOption(
					'Title (max 29 characters)',
					'Add the title for the weekly take-over.',
					'wto_title',
					''
				),
				new TextOption(
					'Sub Title (max 32 characters)',
					'Add the sub-title for the weekly take-over',
					'wto_subtitle',
					''
				),
				new TextOption(
					'Main Post Title',
					'The title of the main post.',
					'post1_title',
					''
				),
				new TextOption(
					'Main Post ID',
					'The ID of the main post. This is used to the image and link.',
					'post1_id',
					''
				),
				new TextOption(
					'Main Post Custom Image (268x248)',
					'Add a custom image. (optional. if empty, the featured image or the first image of the post will be used).',
					'post1_img',
					''
				),
				new TextOption(
					'Top Right Title',
					'The title of the top right post.',
					'post2_title',
					''
				),
				new TextOption(
					'Top Right ID',
					'The ID of the top right post. This is used to the image and link.',
					'post2_id',
					''
				),
				new TextOption(
					'Top Right Custom Image (250x163)',
					'Add a custom image. (optional. if empty, the featured image or the first image of the post will be used).',
					'post2_img',
					''
				),
				new TextOption(
					'Bottom Right Title',
					'The title of the bottom right post.',
					'post3_title',
					''
				),
				new TextOption(
					'Bottom Right ID',
					'The ID of the bottom right post. This is used to the image and link.',
					'post3_id',
					''
				),
				new TextOption(
					'Bottom Right Custom Image (250x163)',
					'Add a custom image. (optional. if empty, the featured image or the first image of the post will be used).',
					'post3_img',
					''
				),
			)
		),
		new Group( 'Maker Camp Takeover', 'campGroup',
			array(
				new BooleanOption(
					'Maker Camp Homepage Takeover',
					'Do you want the Maker Camp to be on the home page?',
					'make_camp_takeover',
					'1'
				),
				new TextOption(
					'Maker Camp Homepage Posts',
					'Add two post IDs here, comma seperated, with no space.',
					'make_camp_takeover_posts',
					''
				),
				new TextOption(
					'Maker Camp Homepage Main Heading',
					'This is the heading under the video on the left.',
					'make_camp_takeover_heading',
					''
				),
				new TextOption(
					'Maker Camp Homepage Content',
					'This is the content under the heading on the left side.',
					'make_camp_takeover_content',
					'',
					true
				),
				new TextOption(
					'THE BIG OL\' YOUTUBE VIDEO',
					'Add the URL of a YouTube video here.',
					'camp_youtube',
					''
				),
			)
		),
		new Group( 'Day of Making', 'campGroup',
			array(
				new TextOption(
					'Day of Making featured post',
					'Add post ID',
					'dom_featured',
					''
				),
					new TextOption(
					'Day of Making post 1',
					'Add post ID',
					'dom_1',
					''
				),
					new TextOption(
					'Day of Making post 2',
					'Add post ID',
					'dom_2',
					''
				),
					new TextOption(
					'Day of Making post 3',
					'Add post ID',
					'dom_3',
					''
				),
					new TextOption(
					'Day of Making post 4',
					'Add post ID',
					'dom_4',
					''
				),
					new TextOption(
					'Day of Making post 5',
					'Add post ID',
					'dom_5',
					''
				),
					new TextOption(
					'Day of Making post 6',
					'Add post ID',
					'dom_6',
					''
				),
					new TextOption(
					'Day of Making post 7',
					'Add post ID',
					'dom_7',
					''
				),													
			)
		),		
		new Group( 'Maker Week', 'makerWeekGroup',
			array(
				new BooleanOption(
					'Maker Week Homepage Takeover',
					'Do you want the Maker Week to be on the home page?',
					'maker_week',
					'1'
				),
				new TextOption(
					'Maker Week Homepage Posts',
					'Add three post IDs here, comma seperated, with no space.',
					'make_week_takeover_posts',
					''
				),
			)
		),
		new Group( 'Qualtrics Script', 'qualtrics',
			array(
				new BooleanOption(
					'Display Qualtrics Script',
					'Do you want to show the survey script?',
					'qualtrics_script',
					'1'
				),
				new TextOption(
					'Delay Amount',
					'Time is in milliseconds, so 6000 == sixty seconds.',
					'qualtrics_script_delay',
					'3000'
				),
				new TextOption(
					'Pageview Percentage',
					'What percent of pageviews should load the popup.',
					'qualtrics_script_percent',
					'8'
				),
				new BooleanOption(
					'Display Survey Monkey Script',
					'Do you want to show the survey script?',
					'survey_monkey_script'
				),
			)
		),
	);
}


function make_get_cap_option( $option_name ) {
	return cap_get_options( $option_name );
}