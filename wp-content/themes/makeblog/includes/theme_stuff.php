<?php
/**
 * General makeblog theme functions
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 *
 * @uses add_theme_support() To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses add_image_size() To set a custom post thumbnail size.
 *
 */
function make_action_after_setup_theme() {

	add_theme_support('post-thumbnails' );
	add_image_size( 'comment-thumb', 70, 70, true );				// Used in the most commented area of the sidebar.
	add_image_size( 'attachment-thumb', 75, 75, true ); 			// Maker Faire Sidebar
	add_image_size( 'shed-thumb', 90, 999, false); 					// Used in Maker Shed homepage widget
	add_image_size( 'ftms-thumb', 300, 999, false); 				// Used in the From the Maker Shed widget on homepage
	add_image_size( 'left-rail-home-thumb', 269, 120, true );		// Small blog posts on left rail
	add_image_size( 'house-ad', 279, 170, true );					// Top right corner of all pages
	add_image_size( 'small-home-feature-boxes', 285, 144, true );	// Feature boxes on home page.
	add_image_size( 'new-thumb', 140, 140, true ); 					// Used on Super Pages
	add_image_size( 'side-thumb', 280, 95, true );					// Used on Super Pages
	add_image_size( 'archive-thumb', 200, 200, true );				// Used on archives pages
	add_image_size( 'faire-thumb', 130, 130, true );				// Used on Maker Faire homepage
	add_image_size( 'volume-thumb', 144, 144, true );				// Used on volume page
	add_image_size( 'category-thumb', 298, 146, true );				// Used on Category archive pages when in a .span4
	add_image_size( 'category-thumb-small', 218, 146, true );		// Used on Category archive pages when in a .span3
	add_image_size( 'related-thumb', 98, 55, true );				// Used on related blocks.
	add_image_size( 'featured-thumb', 105, 105, true );				// Used on related blocks.
	add_image_size( 'p1', 301, 400, true );							// Used as the top left featured image on home page.
	add_image_size( 'p2', 290, 180, true );							// Used as the top right featured images on home page.
	add_image_size( 'maker-week-home', 620, 400, true );			// Used on Maker Week take over page.
	add_image_size( 'maker-week-thumb', 145, 110, true );			// Used on Maker Week take over page sidebar.
	add_image_size( 'search-thumb', 110, 85, true );  				// Used on the Search page
	add_image_size( 'slideshow-thumb', 620, 400 );  				// Used on the Huff-Po style slideshow
	add_image_size( 'slideshow-small-thumb', 60, 60, true );  		// Used on the Huff-Po style thumbs
	add_image_size( 'takeover-featured', 303, 288, true );			// Used on the Takeover design in the Theme Customizer
	add_image_size( 'takeover-thumb', 283, 144, true );				// Used on the Takeover design in the Theme Customizer

	/**
	  * Depracated image sizes.
	 */
	// add_image_size( 'super-thumb', 290, 170, true );
	// add_image_size( 'search-thumb', 100, 100, true );
	// add_image_size( 'big-thumb', 300, 300, true ); //300 pixels wide (and unlimited height)
	// add_image_size( 'dotw', 300, 209, true );
	// add_image_size( 'small-thumb', 50, 50, true );
	// add_image_size( 'home-biggest', 380, 264, true );

	// Content Width
	if ( ! isset( $content_width ) )
		$content_width = 620;
	// Post Formats
	add_theme_support( 'post-formats', array( 'gallery', 'aside', 'video' ) );
	// Custom Backgrounds
	add_theme_support( 'custom-background' );
	//Infinite Scroll!
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
	) );
	add_theme_support( 'automatic-feed-links' );

        /*
	if ( array('volume', 'project' ) == get_post_type() ) {
		remove_action('the_content', 'contextly_linker_widget');
	}*/

	// This is hoping to fix the issue that arises, preventing the contribute form from working.
	if ( ! is_admin() ) {
		remove_filter( 'wp_enqueue_media', 'wpcom_media_modal_tweaks' );
	}

}
add_action( 'after_setup_theme', 'make_action_after_setup_theme' );


/**
 * Adjusting the areas that Infinite Scroll supports to include author pages
 *
 * @since P-body
 */
function make_adjust_infinite_scroll_support() {
	$supported = current_theme_supports( 'infinite-scroll' ) && ( is_home() || is_tag() || is_author() );

	return $supported;
}
add_filter( 'infinite_scroll_archive_supported', 'make_adjust_infinite_scroll_support' );


/**
 * Initiate the Easy Custom Fields class
 */
$field_data = array (
	'advanced_testgroup' => array (										// unique group id
		'fields' => array(												// array "fields" with field definitions
			/**
			  * @depracated
			 */
			'Big_Video'		=> array(									// globally unique field id
				'label' 		=> 'Big YouTube Video',					// Field Label
				'hint'			=> 'Add the video ID from the YouTube video URL',	// A descriptive hint for the field
				'type' 			=> 'text',							// Custom Field Type (see Ref: field_type)
				'class'			=> 'aclass',							// CSS Wrapper class for the field
				'input_class' 	=> 'theEditor',							// CSS class for the input field
				'error_msg' 	=> 'The Advanced Field is wrong' ),		// Error message to show when validate fails
			'FeauturedID' 	=> array(									// globally unique field id
				'label' 		=> 'Maker Faire Project Profile',		// Field Label
				'hint'			=> 'Add the Maker Exhibit ID',			// A descriptive hint for the field
				'type' 			=> 'text',							// Custom Field Type (see Ref: field_type)
				'class'			=> 'aclass',							// CSS Wrapper class for the field
				'input_class' 	=> 'theEditor',							// CSS class for the input field
				'error_msg' 	=> 'The Maker ID is wrong' ),			// Error message to show when validate fails
		),
		'title' => 'Big Stuff',	// Group Title
		'context' => 'advanced',			// context as in http://codex.wordpress.org/Function_Reference/add_meta_box
		'pages' => array( 'post', 'page' ),	// pages as in http://codex.wordpress.org/Function_Reference/add_meta_box
	),
);
$easy_cf = new Easy_CF($field_data);


/**
 * Provides a way to truncate titles
 * @param  integer $length The desiered length
 * @return string
 */
function make_get_short_title( $length ) {
	$original = get_the_title();
	$title = substr( $original, 0, absint( $length ) );
	if ( strlen( $original ) > absint( $length ) ) $title .= '...';

	return $title;
}


/**
 * A fancy schmancy method to stick a big video in the post area.
 *
 * The goal was to copy what BoingBoing was doing, editors never really got excited about it. Now, deprecated.
 *
 * @deprecated 	Since January 2013.
 * @param 		$content
 * @return 		string $content with video.
 */
function make_insert_video($content) {
	global $wp_query;
			$postid = $wp_query->post->ID;
			$big_video = get_post_custom_values('Big_Video');
				if (isset($big_video[0])) {
					$content = make_youtube_embed('580','325').$content;
					return $content;
					}
				else {
					return $content;
					}
			$big_gallery = get_post_custom_values('Big_Gallery');
				if (isset($big_video[0])) {
					$content = $content.'<div class"gallery"><a href="'.the_permalink().'">Click here</a> to view the full gallery.';
					return $content;
					}
				else {
					return $content;
				}

}
add_filter('the_excerpt_rss', 'make_insert_video');
add_filter('the_content_rss', 'make_insert_video');
//add_filter('the_content_feed', 'make_insert_video');


/**
 * Method for cleaning content.
 *
 * This is some old code that Stefan wrote back in the day.
 *
 * @deprecated 	Since January 2013.
 * @param 		string $text Text to be cleaned.
 * @return 		string Cleaned text
 */
function make_richClean($text) {
	$text = str_replace(
		array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"),
		array("'", "'", '"', '"', '-', '--', '...'),
	$text);

	// Next, replace their Windows-1252 equivalents.
	$text = str_replace(
		array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)),
		array("'", "'", '"', '"', '-', '--', '...'),
	$text);

	return($text);
}

add_action('widgets_init', 'make_register_sidebar');
/**
 * Register the WordPress sidebar to site.
 *
 */
function make_register_sidebar() {
	if( function_exists('register_sidebar')) {
		register_sidebar(
			array(
				'id'=>'sidebar_top',
				'name'=>__('Sidebar Top'),
				'description'=>__('This widget area is at the top of the sidebar, above everything else.' ),
				'before_widget'=>'<div class="widget">',
				'after_widget'=>'</div>',
				'before_title'=>'<h3 class="widget-title">',
				'after_title'=>'</h3>'
			)
		);
		register_sidebar(
			array(
				'id'=>'sidebar_bottom',
				'name'=>__('Sidebar Bottom'),
				'description'=>__('This widget area is at the bottom of the sidebar, below everything else.' ),
				'before_widget'=>'<div class="sidebar_bottom">',
				'after_widget'=>'</div>',
				'before_title'=>'<h3 class="widget-title">',
				'after_title'=>'</h3>'
			)
		);
		register_sidebar(
			array(
				'id'=>'sidebar_weekend_projects',
				'name'=>__('Weekend Projects Sidebar'),
				'description'=>__('This widget area is only on the Weekend Projects page.' ),
				'before_widget'=>'<div class="widget">',
				'after_widget'=>'</div>',
				'before_title'=>'<h3 class="widget-title">',
				'after_title'=>'</h3>'
			)
		);
	}
}

// This bit is added so that we can get a fresher read on the stuff. Notably the Maker Faire feed for live events.
add_filter( 'wp_feed_cache_transient_lifetime', function() { return 900; } );


/*
   Set some CONST for universal assets (nav and footer)
   enclosed in a function for safety
   this needs to appear before the scripts/styles are enqueued 
*/
function set_universal_asset_constants() {
   // Assume that we're in prod; only change if we are definitively in another
   $universal_asset_env = 'make.co';
   $universal_asset_proto = 'https://';
   $universal_asset_user = false;
   $universal_asset_pass = false;
   $host = $_SERVER['HTTP_HOST'];
   // dev environments
   if(strpos($host, 'dev.') === 0) {
      $universal_asset_env = 'dev.make.co';
      $universal_asset_user = 'makecodev';
      $universal_asset_pass = '8f86ba87';
   }
   // stage environments
   else if(strpos($host, 'stage.') === 0) {
      $universal_asset_env = 'stage.make.co';
      $universal_asset_user = 'makecstage';
      $universal_asset_pass = 'c2792563';
   }
   // legacy staging environments
   else if(strpos($host, '.staging.wpengine.com') > -1) {
      $universal_asset_env = 'makeco.staging.wpengine.com';
      $universal_asset_user = 'makeco';
      $universal_asset_pass = 'memberships';
   }
   // local environments
   else if(strpos($host, ':8888') > -1) {
      $universal_asset_env = 'makeco:8888'; // this will require that we use `makeco` as our local
      $universal_asset_proto = 'http://';
   }
   // Set the important bits as CONSTANTS that can easily be used elsewhere
   define('UNIVERSAL_ASSET_URL_PREFIX', $universal_asset_proto . $universal_asset_env);
   define('UNIVERSAL_ASSET_USER', $universal_asset_user);
   define('UNIVERSAL_ASSET_PASS', $universal_asset_pass);
}
set_universal_asset_constants();

/**
 * Enqueue all scripts and stylesheets.
 * @return void
 *
 * @version  1.1
 */

function make_load_resources() {
	global $wp_query;

  // To ensure CSS files are downloaded in parallel, always include CSS before JavaScript.
  //wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
  wp_enqueue_style( 'make-css', get_stylesheet_directory_uri() . '/css/style.min.css' );
  wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/version-2/css/style.min.css');
  wp_enqueue_style( 'make-print', get_stylesheet_directory_uri() . '/css/print.min.css', array(), false, 'print' );
  wp_enqueue_style( 'roboto-fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700', false );
  wp_enqueue_style( 'roboto-slab-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', false );
  wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false );
  wp_enqueue_style('universal.css', UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/css/universal.min.css');

	// Load optimizely A/B testing script
	//wp_enqueue_script( 'make-optimizely', '//cdn.optimizely.com/js/2101321427.js', array( 'jquery' ) );

	//load data finder for cookies
	// wp_enqueue_script( 'user-data-script', '//cdn.makezine.com/js/make-v3.js', array( 'make-optimizely' ) );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'modernizer', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), false, false );
	wp_enqueue_script( 'header-version-2', get_stylesheet_directory_uri() . '/version-2/js/header.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'single-story', get_stylesheet_directory_uri() . '/version-2/js/single-story.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'lazyload', get_stylesheet_directory_uri() . '/version-2/js/jquery.lazyload.min.js', array( 'jquery' ));
	wp_enqueue_script( 'make-oembed', get_stylesheet_directory_uri() . '/js/jquery.oembed.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'fancybox', get_stylesheet_directory_uri() . '/js/fancybox.js', array( 'jquery' ), false, true );

  $my_theme = wp_get_theme();
  $my_version = $my_theme->get('Version');
	wp_enqueue_script( 'misc-scripts', get_stylesheet_directory_uri() . '/js/footer-scripts/min/built.min.js', array( 'jquery', 'fancybox' ), $my_version, true );
	wp_enqueue_script('universal', UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/js/min/universal.min.js', array(), $my_version, true);
	// Just what's necessary to have js files use the admin-ajax
   wp_localize_script('misc-scripts', 'ajax_object',
	  array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'home_url' => get_home_url(),
			'logout_nonce' => wp_create_nonce('ajax-logout-nonce'),
	  )
	);

	// What page are we on? And what is the pages limit?
	wp_localize_script( 'make-projects', 'vars', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	// File Input
	wp_enqueue_script( 'make-fileinput', get_stylesheet_directory_uri() . '/js/fileinput.js', array( 'jquery' ) );

	// display our map sort plugin for Maker Camp
	if ( is_page( 315793 ) )
		wp_enqueue_script( 'make-sort-table', get_stylesheet_directory_uri() . '/js/jquery.tablesorter.min.js', array( 'jquery' ), false, true );
	}


add_action( 'wp_enqueue_scripts', 'make_load_resources' );


/**
 * Adds scripts and styles to particular pages in the admin areas.
 * @return void
 */
function make_enqueue_resources_admin() {
	$screen = get_current_screen();

	// Run this code when we are in the magazine dashboard
	if ( $screen->id == 'volume_page_manager' ) {
		wp_enqueue_style( 'make-dashboard-css', get_stylesheet_directory_uri() . '/includes/magazine-dashboard/css/dashboard.css' );
		wp_enqueue_script( 'make-sort-table', get_stylesheet_directory_uri() . '/js/jquery.tablesorter.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'make-dashboard', get_stylesheet_directory_uri() . '/includes/magazine-dashboard/js/dashboard-scripts.js', array( 'make-sort-table' ) );
	}

	// Run this code when we are in the magazine edit screen
	if ( $screen->id == 'magazine' ) {
		wp_enqueue_script( 'make-hide-publish-btn', get_stylesheet_directory_uri() . '/js/jquery.hide-publish-btn.js', array( 'jquery' ), '1.0', true );
	}

}
add_action( 'admin_enqueue_scripts', 'make_enqueue_resources_admin' );


/**
 * Catch a description for the OG protocol
 *
 * @deprecated 	Since January 2013.
 * @param 		string $post->post_content to be trimmed, stripped, and shortened.
 * @return 		string Cleansed text.
 */
function make_catch_that_desc() {
	global $post;
	$meta = trim( strip_tags( strip_shortcodes( $post->post_content )));
	$meta = wp_trim_words( $meta,  25,  '…' );
	return($meta);
}

/**
 * List all Makers that are associated with the post.
 *
 * @deprecated 	Since January 2013.
 * @return 		string List of Makers
 */
function make_makers() {

	$terms = get_the_terms(get_the_ID(), 'maker');
	$count = count($terms);
		if($terms > 0) {

			echo '<hr>';
			echo '<h4>Makers in this post:</h4>';
			the_terms( get_the_ID(), 'maker');
			$location = get_the_terms(get_the_ID(), 'maker');
			$count = count($location);
			if($location > 0) {
				echo ' &#150; ';
				the_terms( get_the_ID(), 'location');
			}
		}
}

/**
 * Send iTunes requests to a specific feed
 */
function itunes_feed() {
	if( is_feed() && is_category('make_podcast')) {
		include(TEMPLATEPATH . '/feed-rss2-itunes.php' );
		exit;
	}
}

add_action('template_redirect', 'itunes_feed');

add_action('pre_get_posts', 'make_mf_remove_tag_from_home' );

/**
 * Take Maker Faire posts that don't have MF tag, and remove from the main query.
 * @param $query
 */
function make_mf_remove_tag_from_home( $query ) {

	// only impact the main WordPress query and if on homepage or feed
	if( $query->is_main_query() && ( $query->is_home() || $query->is_feed() ) ) {
		$query->set( 'tag__not_in', array( 5183, 22815, 9947 ) );
	}
}

/**
 * Truncate the excerpt to 50 charecters.
 */
function make_custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'make_custom_excerpt_length', 999 );

add_action( 'infinite_scroll_render', 'make_infinite_scroll_render' );

/**
 * Function to enable unlimited scroll.
 * @deprecated Since January 2013
 */
function make_infinite_scroll_render() {
	while ( have_posts() ) : the_post();
		get_template_part( 'content' );
	endwhile;
}
/**
 * Get the first category name of a post.
 * This take the category name, strips out content (spaces, &, and) and then returns.
 * @return string Main category name with a slash at the end.
 */
function make_get_category_name() {
	global $post;
	if ( (is_single() || is_admin()) && has_category() ) {
		$cats = get_the_terms($post->ID, 'category');
		$sortcats = array_shift($cats);
		if (!empty($sortcats)) {
			$cat = $sortcats; // let's just assume the post has one category
		}
	}
	elseif ( is_category() ) { // category archives
		$cat = get_queried_object();
	}
	if (is_single() || is_admin() || is_category()) {
		$output = '/';
	} else {
		$output = null;
	}
	$boom = array( '&amp;', ' ', 'and' );
	if (!empty($cat->name)) {
		$output .= str_replace($boom, '', $cat->name);
	}
	return $output;
}
/**
 * Get the first category name of a post.
 * This take the category name, strips out content (spaces, &, and) and then returns.
 * @return string Main category name with a stripped slash.
 */
function make_get_category_name_strip_slash() {
	if ( is_single() || is_admin() ) {
		$cats =  get_the_category();
		$cat = $cats[0]; // let's just assume the post has one category
	}
	elseif ( is_category() ) { // category archives
		$cat = get_queried_object();
	}

	if (isset($cat->name)) {
		$boom = array( '&amp;', ' ', 'and' );
		$output = str_replace($boom, '', $cat->name);
		return $output;
	}
}

/**
 * Add different content types to the main queries.
 * This will bring posts, craft, projects, video into the main query. Allows for better archive pages.
 * @return string Main category name.
 */
function make_add_custom_types( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( $query->is_tag() || $query->is_author() || $query->is_tax() || $query->is_home() ) && empty( $query->query_vars['suppress_filters'] ) ) {

		// don't load craft posts on the home.php
		if ( is_home() ) {
			$query->set( 'post_type', array( 'post', 'projects', 'video', 'review', 'magazine' ) );
		} else {
			$query->set( 'post_type', array( 'post', 'craft', 'projects', 'video', 'review', 'magazine', 'products', 'reviews' ) );
		}

		return $query;
	}
}
add_filter( 'pre_get_posts', 'make_add_custom_types' );
/**
 * Change the default look to be by added date for admin pages.
 * NOTE (ts): updated 2018-10-26, to allow user-selected sorting criteria 
 * to pass through, only default if no user choice
 */
function make_set_default_sort( $query ) {
	if ( is_admin() && $query->is_main_query() && empty( $query->query_vars['suppress_filters'] ) ) {
      if($query->get('orderby') === '') {
         $query->set( 'orderby', 'date' );
         $query->set( 'order', 'DESC' );
      }
		return $query;
	}
}
add_filter( 'pre_get_posts', 'make_set_default_sort' );

add_filter( 'byline_auto_filter_author', '__return_true' );

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}

/**
 * Add the Qualtrics popup to the Footer
 */
function make_qualtrics_script() {
	if ( make_get_cap_option( 'qualtrics_script' ) ) : ?>
	<!--BEGIN QUALTRICS POPUP-->
	<script type="text/javascript">
		var q_viewrate = <?php echo esc_js( intval( make_get_cap_option( 'qualtrics_script_percent' ) ) ); ?>;
		var url = 'http://s.qualtrics.com/ControlPanel/Graphic.php?IM=IM_ef9i42Jt6yJs8OV&V=1378824622';
		if ( Math.random() < q_viewrate / 100 ){
			var q_popup_f = function(){
				var q_script = document.createElement("script");
				var q_popup_g = function(){
					new QualtricsEmbeddedPopup( {
						id: "SV_1Rex7PkiBgaaK3z",
						imagePath: "https://qdistribution.qualtrics.com/WRQualtricsShared/Graphics/",
						surveyBase: "http://surveys.makermedia.com/WRQualtricsSurveyEngine/",
						delay: <?php echo esc_js( intval( make_get_cap_option( 'qualtrics_script_delay' ) ) ); ?>,
						preventDisplay:0,
						animate:true,
						width:400,
						height:300,
						surveyPopupWidth:900,
						surveyPopupHeight:600,
						startPos:"BR",
						popupText:"<div style='margin-bottom:20px;'><image src=" + url + "></div>Would you please help us improve our website by answering 3 questions?",
						linkText:"Click Here"
					});
				};
				q_script.onreadystatechange= function () {
					if (this.readyState == "loaded")
						q_popup_g();
				};
				q_script.onload = q_popup_g;
				q_script.src="https://qdistribution.qualtrics.com/WRQualtricsShared/JavaScript/Distribution/popup.js";
				document.getElementsByTagName("head")[0].appendChild(q_script);
			};
			if (window.addEventListener){
				window.addEventListener("load",q_popup_f,false);
			} else if (window.attachEvent) {
				r=window.attachEvent("onload",q_popup_f);
			};
		};
	</script>
	<noscript><p><a target="_blank" href="http://surveys.makermedia.com/WRQualtricsSurveyEngine/?SID=SV_1Rex7PkiBgaaK3z">Click Here</a><p></noscript>
	<!--END QUALTRICS POPUP-->
	<?php endif;
}

//TODO: In the redesign, the qualtrics_script cap got removed.  Until we put that back in, removing this script that uses it
//add_action( 'wp_footer', 'make_qualtrics_script' );

/**
 * Adds the popover javascript for review posts.
 */
function make_add_popover() {
	if ('review' == get_post_type()) { ?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".define").popover();
				});
			</script>
	<?php }
}

add_action('wp_footer', 'make_add_popover' );

/**
 * Removes the thumbnail class from the homepages of Craft and make.
 */
function make_get_rid_of_thumbnail_class() {

	if ( is_page( array( 'craft-home', 'home-page-include', 'home-page' ) ) ) { ?>

		<script>
			jQuery(document).ready(function(){
				jQuery(".entry-content img").removeClass('thumbnail');
			});
		</script>

	<?php }
}

add_action('wp_footer', 'make_get_rid_of_thumbnail_class');

/**
 * Halloween Bats for halloween tag
 */
function make_get_bats() {

	if ( is_tag( 'halloween' ) ) { ?>

		  <!-- adds bat number 1 -->
		  <script type="text/javascript" async src="//1abxf1rh6g01lhm2riyrt55k.wpengine.netdna-cdn.com/wp-content/uploads/2015/10/jsbat.js"></script>
		  <!-- adds bat number 2 -->
		  <script type="text/javascript" async src="//1abxf1rh6g01lhm2riyrt55k.wpengine.netdna-cdn.com/wp-content/uploads/2015/10/jsbat.js"></script>
		  <!-- adds bat number 3 -->
		  <script type="text/javascript" async src="//1abxf1rh6g01lhm2riyrt55k.wpengine.netdna-cdn.com/wp-content/uploads/2015/10/jsbat.js"></script>

	<?php }
}

add_action('wp_footer', 'make_get_bats');

/**
 * Hides the post name from the breadcrumb.
 * Ideally, we would do this using PHP, but I couldn't figure out an easy method. While this might be a little jarring, it works for now.
 */
function make_hide_breadcrumb_elements() {

	if (is_single()) { ?>

		<script>
			jQuery(document).ready(function(){
				jQuery("span.divider").eq(-1).hide();
				jQuery(".current").hide();
			});
		</script>

	<?php }
}

add_action('wp_footer', 'make_hide_breadcrumb_elements');

add_action('right_now_content_table_end', 'add_magazine_article_counts');

/**
 * Counts the post numbers for the Dashboard.
 */
function add_magazine_article_counts() {
		if (!post_type_exists('magazine')) {
			 return;
		}

		$num_posts = wp_count_posts( 'magazine' );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( 'Magazine Article', 'Magazine Articles', intval($num_posts->publish) );
		if ( current_user_can( 'edit_posts' ) ) {
			$url = admin_url( 'edit.php?post_type=magazine' );
			$num = '<a href="'.$url.'">'.$num.'</a>';
			$text = '<a href="'.$url.'">'.$text.'</a>';
		}
		echo '<td class="first b b-magazine">' . $num . '</td>';
		echo '<td class="t magazine">' . $text . '</td>';

		echo '</tr>';

		if ($num_posts->pending > 0) {
			$num = number_format_i18n( $num_posts->pending );
			$text = _n( 'Magazine Articles Pending', 'Magazine Articles Pending', intval($num_posts->pending) );
			if ( current_user_can( 'edit_posts' ) ) {
				$url = admin_url( 'edit.php?post_status=pending&post_type=magazine' );
				$num = '<a href="'.$url.'">'.$num.'</a>';
				$text = '<a href="'.$url.'">'.$text.'</a>';
			}
			echo '<td class="first b b-recipes">' . $num . '</td>';
			echo '<td class="t recipes">' . $text . '</td>';

			echo '</tr>';
		}
}

add_action('right_now_content_table_end', 'add_craft_article_counts');

/**
 * Counts the craft numbers for the Dashboard.
 */
function add_craft_article_counts() {
		if (!post_type_exists('craft')) {
			 return;
		}

		$num_posts = wp_count_posts( 'craft' );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( 'Craft Post', 'Craft Posts', intval($num_posts->publish) );
		if ( current_user_can( 'edit_posts' ) ) {
			$url = admin_url( 'edit.php?post_type=craft' );
			$num = '<a href="'.$url.'">'.$num.'</a>';
			$text = '<a href="'.$url.'">'.$text.'</a>';
		}
		echo '<td class="first b b-craft">' . $num . '</td>';
		echo '<td class="t craft">' . $text . '</td>';

		echo '</tr>';

		if ($num_posts->pending > 0) {
			$num = number_format_i18n( $num_posts->pending );
			$text = _n( 'Craft Posts Pending', 'Craft Posts Pending', intval($num_posts->pending) );
			if ( current_user_can( 'edit_posts' ) ) {
				$url = admin_url( 'edit.php?post_status=pending&post_type=craft' );
				$num = '<a href="'.$url.'">'.$num.'</a>';
				$text = '<a href="'.$url.'">'.$text.'</a>';
			}
			echo '<td class="first b b-craft">' . $num . '</td>';
			echo '<td class="t craft">' . $text . '</td>';

			echo '</tr>';
		}
}

add_action('right_now_content_table_end', 'add_page_2_article_counts');

/**
 * Counts the Page: 2 numbers for the Dashboard.
 */
function add_page_2_article_counts() {
		if (!post_type_exists('page_2')) {
			 return;
		}

		$num_posts = wp_count_posts( 'page_2' );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( 'Page:2 Post', 'Page: 2 Posts', intval($num_posts->publish) );
		if ( current_user_can( 'edit_posts' ) ) {
			$url = admin_url( 'edit.php?post_type=page_2' );
			$num = '<a href="'.$url.'">'.$num.'</a>';
			$text = '<a href="'.$url.'">'.$text.'</a>';
		}
		echo '<td class="first b b-page_2">' . $num . '</td>';
		echo '<td class="t page_2">' . $text . '</td>';

		echo '</tr>';

		if ($num_posts->pending > 0) {
			$num = number_format_i18n( $num_posts->pending );
			$text = _n( 'Page: 2 Pending', 'Page: 2 Posts Pending', intval($num_posts->pending) );
			if ( current_user_can( 'edit_posts' ) ) {
				$url = admin_url( 'edit.php?post_status=pending&post_type=page_2' );
				$num = '<a href="'.$url.'">'.$num.'</a>';
				$text = '<a href="'.$url.'">'.$text.'</a>';
			}
			echo '<td class="first b b-page_2">' . $num . '</td>';
			echo '<td class="t b-page_2">' . $text . '</td>';

			echo '</tr>';
		}
}

/**
 * Creates a dropdown of child categories.
 * @deprecated Since January 2013.
 */
function make_cat_change() {

	if (is_category()) { ?>

		<script type="text/javascript">
			var dropdown = document.getElementById("cat");
			function onCatChange() {
				if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
					location.href = "<?php echo get_option('home'); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
				}
			}
			dropdown.onchange = onCatChange;
		</script>

<?php }

}

//add_action('wp_footer', 'make_cat_change');

/**
 * Takes popular tags, and renames them.
 */
function make_get_better_tag_title( $title = null ) {
	if ( $title == null ) {
		$title = single_cat_title('', false);
	}
	$machine = array(
		'robotskills',
		'castmat',
		'advancedmaterials',
		'reusedmat',
		'plywoodmat',
		'naturalmaterials',
		'naturalmaterial',
		'metalmat',
		'ceramicsmat',
		'concretematerial',
		'circuitskills',
		'electronskills',
		'foodskills',
		'hobbyskills',
		'machineskills',
		'MechanicSkills',
		'metalskills',
		'Photo Skills',
		'plasticskills',
		'robotskills',
		'skillbuilder',
		'WoodSkills',
		'papermat',
		'glassmat',
		'greatcreate'
		);
	$human   = array(
		'Robot Skill Builder',
		'Casting Materials',
		'Advanced Mataerials',
		'Reused Materials',
		'Plywood',
		'Natural Materials',
		'Natural Materials',
		'Metal',
		'Ceramics',
		'Concrete',
		'Circuit Skill Builder',
		'Electronics Skill Builder',
		'Food Skill Builder',
		'Hobby Skill Builder',
		'Machining Skill Builder',
		'Mechanic Skill Builder',
		'Metal Skill Builder',
		'Photo Skill Builder',
		'Plastic Skill Builder',
		'Robot Skill Builder',
		'Skill Builder',
		'Woodworking Skill Builder',
		'Paper Skill Builder',
		'Glass',
		'Radio Shack\'s The Great Create'
		);

	$newtag = str_replace($machine, $human, $title);
	return $newtag;

}

/**
 * Adds the post thumbnail to the RSS feed.
 * Like a lot of people, I wish that we weren't truncating the RSS feed, but hey, not my decision!
 */
function make_rss_post_thumbnail($content) {
	global $post;
	if( has_post_thumbnail($post->ID) ) {
		$content =  '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, 'archive-thumb', array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '</a>' . get_the_excerpt() . '<p><a href="' . get_permalink() . '">Read more on MAKE</a></p>';
	}
	return $content;
}

add_filter('the_excerpt_rss', 'make_rss_post_thumbnail');
add_filter('the_content_feed', 'make_rss_post_thumbnail');


add_filter( 'the_content', 'make_add_sharing_to_content_top' );

/**
 * Adds the WordPress.com sharing bar to the top of posts.
 */
function make_add_sharing_to_content_top( $content ) {

	if ( function_exists( 'sharing_display') )
		$content = sharing_display() . $content;

	return $content;
}

/**
 * Add category nicenames in body and post class
 * @deprecated Since January 2013
 */
function make_category_id_class($classes) {
	foreach((get_the_category( get_the_ID() )) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
//add_filter('post_class', 'make_category_id_class');
//add_filter('body_class', 'make_category_id_class');


add_action( 'admin_head', 'make_cpt_icons' );
/**
 * Adds icons for the custom post types that are in the admin.
 */
function make_cpt_icons() { ?>
	<style type="text/css" media="screen">
		.icon16.icon-dashboard:before,
		#adminmenu .menu-icon-dashboard div.wp-menu-image:before {
			content: '\f226';
		}

		.icon16.icon-post:before,
		#adminmenu .menu-icon-post div.wp-menu-image:before {
			content: '\f109';
		}

		.icon16.icon-media:before,
		#adminmenu .menu-icon-media div.wp-menu-image:before {
			content: '\f104';
		}

		.icon16.icon-links:before,
		#adminmenu .menu-icon-links div.wp-menu-image:before {
			content: '\f103';
		}

		.icon16.icon-page:before,
		#adminmenu .menu-icon-page div.wp-menu-image:before {
			content: '\f105';
		}

		.icon16.icon-comments:before,
		#adminmenu .menu-icon-comments div.wp-menu-image:before {
			content: '\f101';
			margin-top: 1px;
		}

		.icon16.icon-appearance:before,
		#adminmenu .menu-icon-appearance div.wp-menu-image:before {
			content: '\f100';
		}

		.icon16.icon-plugins:before,
		#adminmenu .menu-icon-plugins div.wp-menu-image:before {
			content: '\f106';
		}

		.icon16.icon-users:before,
		#adminmenu .menu-icon-users div.wp-menu-image:before {
			content: '\f110';
		}

		.icon16.icon-tools:before,
		#adminmenu .menu-icon-tools div.wp-menu-image:before {
			content: '\f107';
		}

		.icon16.icon-settings:before,
		#adminmenu .menu-icon-settings div.wp-menu-image:before {
			content: '\f108';
		}

		.icon16.icon-site:before,
		#adminmenu .menu-icon-site div.wp-menu-image:before {
			content: '\f112'
		}

		.icon16.icon-generic:before,
		#adminmenu .menu-icon-generic div.wp-menu-image:before {
			content: '\f111';
		}

		.icon16.icon-video:before,
		#adminmenu #menu-posts-video div.wp-menu-image:before {
			content: '\f126';
		}

		.icon16.icon-project:before,
		#adminmenu #menu-posts-projects div.wp-menu-image:before {
			content: '\f308';
		}

		.icon16.icon-magazine:before,
		#adminmenu #menu-posts-magazine div.wp-menu-image:before {
			content: '\f123';
		}

		.icon16.icon-review:before,
		#adminmenu #menu-posts-review div.wp-menu-image:before {
			content: '\f175';
		}

		.icon16.icon-volume:before,
		#adminmenu #menu-posts-volume div.wp-menu-image:before {
			content: '\f318';
		}

		.icon16.icon-errata:before,
		#adminmenu #menu-posts-errata div.wp-menu-image:before {
			content: '\f117';
		}

		.icon16.icon-page_2:before,
		#adminmenu #menu-posts-page_2 div.wp-menu-image:before {
			content: '\f161';
		}

		.icon16.icon-golink:before,
		#adminmenu #menu-posts-go div.wp-menu-image:before {
			content: '\f103';
		}

		.icon16.icon-craft:before,
		#adminmenu #menu-posts-craft div.wp-menu-image:before {
			content: '\f309';
		}

	</style>
<?php }

add_action( 'pre_get_posts', 'make_support_post_parent_queries_in_admin' );
/**
 * Adds the ability to get all posts from a given parent in the admin.
 */
function make_support_post_parent_queries_in_admin( $query ) {
	if ( is_admin() && ! empty( $_GET['post_parent'] ) && $query->is_main_query() && ! $query->get( 'post_parent' ) && empty( $_POST ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		$query->set( 'post_parent', absint( $_GET['post_parent'] ) );
	}
}

/**
 * iTunes RSS feed stuff for page templates.
 */

$field_data = array (
	'advanced_testgroup' => array (
		'fields' => array(
			'ImageURL'					=> array(),
			'Summary'				    => array(),
			'Subtitle'				    => array(),
			'Tag'						=> array()
	),
	'title'		=> 'RSS Stuff',
	'context'	=> 'side',
	'pages'		=> array( 'page' ),
	),
);

$easy_cf = new Easy_CF($field_data);

function make_get_post_meta_rss( $term ) {
	$term =  get_post_custom_values( $term );
	$term = $term[0];
	$term = ent2ncr( $term );
	return $term;

}

/**
 * Spits out a UL of all of the featured posts
 */
function make_daily_themes() {
	$featuredposts = esc_html( make_get_cap_option( 'weekly' ) );
	$posts = array_map( 'get_post', explode( ',', $featuredposts ) );
	$output = '<ul>';
	foreach ( $posts as $idx => $post ) {
		$output .= '<li><a href="' . get_permalink( $post->ID ) . '">';
		if ( $idx == 0 )
			$output .= '<strong>Monday Jolt:</strong> ';
		if ( $idx == 1 )
			$output .= '<strong>Toolsday:</strong> ';
		if ( $idx == 2 )
			$output .= '<strong>Workshop Wednesday:</strong> ';
		if ( $idx == 3 )
			$output .= '<strong>3D Thursday:</strong> ';
		if ( $idx == 4 )
			$output .= '<strong>Family Friday:</strong> ';
		$output .= get_the_title( $post->ID );
		$output .= '</a></li>';

	}
	$output .= '</ul>';
	return $output;

	wp_reset_query();
}

add_shortcode( 'make-themes', 'make_daily_themes' );

/**
 * Adds a dynamic feature block to the home page.
 */
function make_featured_post() {
	global $post;
	$post_id = make_get_cap_option( 'daily' );
	$post = get_post( $post_id );
	$output = '<div class="img"><a href="' . get_permalink( $post->ID) . '">';
	$output .= get_the_post_thumbnail( $post->ID , $size = 'featured-thumb' );
	$output .= '</div>';
	$output .= '<div class="blurb">';
	$output .= '<h3>' . esc_attr( $post->post_title) . '</h3>';
	$output .= '<p>' . wp_trim_words(strip_shortcodes( $post->post_content ), 35) . '</p>';
	$output .= '</a></div>';
	return $output;
}


/**
 * Renames the custom post type on the front end to be a little better.
 */
function make_post_type_better_name( $name ) {
	if ($name == 'post') {
		return 'posts';
	} elseif ($name == 'projects' ) {
		return 'projects';
	} elseif ( $name == 'videos' ) {
		return 'videos';
	} elseif ( $name == 'magazine' ) {
		return 'articles';
	} elseif ( $name == 'review' ) {
		return 'reviews';
	} elseif ( $name == 'craft' ) {
		return 'craft';
	}
}

add_action( 'init', 'make_allow_data_atts' );
function make_allow_data_atts() {
	global $allowedposttags;

	$tags = array( 'div,a,li' );
	$new_attributes = array(
		'data-toggle'	=> true,
		'data-dismiss'	=> true,
		'data-slide'	=> true,
		);

	foreach ( $tags as $tag ) {
		if ( isset( $allowedposttags[ $tag ] ) && is_array( $allowedposttags[ $tag ] ) )
			$allowedposttags[ $tag ] = array_merge( $allowedposttags[ $tag ], $new_attributes );
	}
}

add_filter('tiny_mce_before_init', 'make_filter_tiny_mce_before_init');
function make_filter_tiny_mce_before_init( $options ) {

	if ( ! isset( $options['extended_valid_elements'] ) )
		$options['extended_valid_elements'] = '';

	$options['extended_valid_elements'] .= ',a[data*|class|id|style|href]';
	$options['extended_valid_elements'] .= ',li[data*|class|id|style]';
	$options['extended_valid_elements'] .= ',div[data*|class|id|style]';

	return $options;
}

add_filter( 'wpcom_sitemap_post_types', 'make_sitemap_add_gallery_post_type' );

function make_sitemap_add_gallery_post_type( $post_types ) {
	$post_types[] = 'gallery';
	$post_types[] = 'video';
	$post_types[] = 'craft';
	$post_types[] = 'review';
	$post_types[] = 'projects';
	return $post_types;
}


/**
 * Adds a menu field to the menus section of the admin area for the topbar
 * @return void
 *
 * @version  1.1
 */
function make_register_menu() {

	// Make Navigation menus
	register_nav_menu( 'make-primary', __( 'Make Primary Nav', 'make' ) );
	register_nav_menu( 'make-secondary', __( 'Make Secondary Nav', 'make' ) );

	// Popdown Menus
	register_nav_menu( 'popdown-menu-top', __( 'Popdown Top', 'make' ) );
	register_nav_menu( 'popdown-menu-middle', __( 'Popdown Middle', 'make' ) );
	register_nav_menu( 'popdown-menu-last', __( 'Popdown Last', 'make' ) );
}
add_action( 'init', 'make_register_menu' );


add_filter( 'wp_kses_allowed_html', 'mf_allow_data_atts', 10, 2 );
function mf_allow_data_atts( $allowedposttags, $context ) {
	$tags = array( 'div', 'a', 'li' );
	$new_attributes = array(
		'data-toggle' 	=> true,
		'data-dismiss' 	=> true,
		'data-interval'	=> true,
		);

	foreach ( $tags as $tag ) {
		if ( isset( $allowedposttags[ $tag ] ) && is_array( $allowedposttags[ $tag ] ) )
			$allowedposttags[ $tag ] = array_merge( $allowedposttags[ $tag ], $new_attributes );
	}

	return $allowedposttags;
}


add_filter('tiny_mce_before_init', 'mf_filter_tiny_mce_before_init');
function mf_filter_tiny_mce_before_init( $options ) {

	if ( ! isset( $options['extended_valid_elements'] ) )
		$options['extended_valid_elements'] = '';

	$options['extended_valid_elements'] .= ',a[data*|class|id|style|href]';
	$options['extended_valid_elements'] .= ',li[data*|class|id|style]';
	$options['extended_valid_elements'] .= ',div[data*|class|id|style]';

	return $options;
}


/**
 * Allows us to easily integrate different types of authors.
 * This is needed because our blog feeds contain multiple types of posts.
 * This will handle the display of those different kinds and apply the right data and styling.
 * @param  string $post_id The post ID of the post we are returning this info for
 * @param  string $prefix  The string to add in front of the autor name. Defaults to "By".
 * @return String
 *
 * @version  1.0
 */
function make_get_author( $post_id, $prefix = 'By' ) {

	// Return our post type name
	$post_type = get_post_type( absint( $post_id ) );

	// Check that we are not loading a video CPT. If we are, return false so we don't echo anything
	// if ( $post_type == 'video')
	// 	return false;

	// If we want to echo our results, we'll do that here.
	echo '<li>';
	echo esc_attr( $prefix ) . ' ';

	if( function_exists( 'coauthors_posts_links' ) ) {
		coauthors_posts_links();
	} else {
		the_author_posts_link();
	}

	echo '</li>';

}


/**
 * Filter the query variables and make sure we are searching for the feed so we can include our custom post types like a boss.
 * @param  array $query_var The query variables.
 * @return array
 *
 * @version  1.0
 */
function make_add_post_types_to_feed( $query_var ) {

	// Check that we are quering the RSS feed and post_type isn't being used.
	if ( isset( $query_var['feed'] ) && ! isset( $query_var['post_type'] ) )
		$query_var['post_type'] = array( 'post', 'projects', 'review', 'video', 'magazine' );

	return $query_var;

}
add_filter( 'request', 'make_add_post_types_to_feed' );



/**
 * Remove unncessary meta boxes from Authors
 * @return void
 */
function make_remove_metaboxes_for_authors() {
	// Remove the following metaboxes for authors and below
	if ( ! current_user_can( 'delete_others_pages' ) ) {

		// Remove Edit Flow Editorial Metadata
		remove_meta_box( 'ef_editorial_meta', 'post', 'side' );
		remove_meta_box( 'ef_editorial_meta', 'projects', 'side' );
		remove_meta_box( 'ef_editorial_meta', 'magazine', 'side' );
		remove_meta_box( 'ef_editorial_meta', 'review', 'side' );
		remove_meta_box( 'ef_editorial_meta', 'video', 'side' );

		// Remove Edit Flot Editorial Comments
		remove_meta_box( 'edit-flow-editorial-comments', 'post', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'projects', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'magazine', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'review', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'craft', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'video', 'normal' );

		// Remove Edit Flow Notifications
		remove_meta_box( 'edit-flow-notifications', 'post', 'advanced' );
		remove_meta_box( 'edit-flow-notifications', 'projects', 'advanced' );
		remove_meta_box( 'edit-flow-notifications', 'magazine', 'advanced' );
		remove_meta_box( 'edit-flow-notifications', 'review', 'advanced' );
		remove_meta_box( 'edit-flow-notifications', 'video', 'advanced' );

		// Remove Primary Section Taxonomy
		remove_meta_box( 'mob_section_primary_term_div', 'post', 'side' );
		remove_meta_box( 'mob_section_primary_term_div', 'projects', 'side' );
		remove_meta_box( 'mob_section_primary_term_div', 'magazine', 'side' );
		remove_meta_box( 'mob_section_primary_term_div', 'review', 'side' );

		// Remove Primary Type Taxonomy
		remove_meta_box( 'mob_types_primary_term_div', 'post', 'side' );
		remove_meta_box( 'mob_types_primary_term_div', 'projects', 'side' );
		remove_meta_box( 'mob_types_primary_term_div', 'magazine', 'side' );
		remove_meta_box( 'mob_types_primary_term_div', 'review', 'side' );
		remove_meta_box( 'mob_types_primary_term_div', 'craft', 'side' );

		// Remove Primary Difficulty
		remove_meta_box( 'mob_difficulty_primary_term_div', 'projects', 'side' );
		remove_meta_box( 'mob_difficulty_primary_term_div', 'video', 'side' );

		// Remove Primary Playlist
		remove_meta_box( 'mob_playlist_primary_term_div', 'video', 'side' );

		// Remove Magazine Meta
		remove_meta_box( 'magazine_meta', 'post', 'side' );
		remove_meta_box( 'magazine_meta', 'projects', 'side' );
		remove_meta_box( 'magazine_meta', 'magazine', 'side' );
		remove_meta_box( 'magazine_meta', 'review', 'side' );

		// Remove Projects Meta
		remove_meta_box( 'advanced_testgroup', 'projects', 'advanced' );

		// Remove Tools Taxonomy
		remove_meta_box( 'tagsdiv-tools', 'projects', 'side' );

		// Remove Parts Taxonomy
		remove_meta_box( 'tagsdiv-parts', 'projects', 'side' );

	}
}
add_action( 'do_meta_boxes', 'make_remove_metaboxes_for_authors' );


/**
 * Hide post types we don't want to show to authors
 * @return void
 */
function make_remove_admin_areas_for_authors() {
	// Remove the following metaboxes for authors and below
	if ( ! current_user_can( 'delete_others_pages' ) ) {
		remove_menu_page( 'edit.php?post_type=newsletter' );
	}
}
add_action( 'admin_menu', 'make_remove_admin_areas_for_authors' );

/**
 * Function to generate the title tags for page heads.
 */
function make_generate_title_tag() {

	$output = '';
	if ( is_home() || is_front_page() ) {
		$output .= get_bloginfo('name') . ' | ' . get_bloginfo('description');
	} elseif ( is_page( 235220 ) || is_post_type_archive( 'craft' ) ) {
		$output .= 'Craft | Crocheting, knitting, sewing, jewelry making, and papercraft';
	} elseif ( is_singular( 'craft' ) ) {
		$output .= wp_title( '', false ) . ' | MAKE: Craft';
	} elseif ( is_author() ) {
		$output .= make_author_name(get_queried_object()) . ' Author Profile | ' . get_bloginfo('name');
	} else {
		$output .= wp_title( '', false );
	}
	return $output;
}

/**
 * Generate a description for the meta description tag.
 *
 * On the home page, use the bloginfo() description, if a single page, use 20 words of the post content. At some point, need to use the excerpt if it exists, then default to the post content. At the end, run it through esc_attr().
 */
function make_generate_description() {
	global $post;
	if ( is_single() ) {
		if ( empty ($post->post_content) ) {
			$fallback_content = get_post_meta ( absint( $post->ID ), 'Description' , true );
			return esc_attr( wp_trim_words( htmlspecialchars( wp_kses( strip_shortcodes( $fallback_content ), array() ) ), 20 ) );
		}
		return esc_attr( wp_trim_words( htmlspecialchars( wp_kses( strip_shortcodes( $post->post_content ), array() ) ), 20 ) );
	} elseif( is_page( 235220 ) || is_post_type_archive( 'craft' ) ) {
		return 'The craft movement encourages people to make things themselves rather than buy what thousands of others already own';
	} else {
		return esc_attr( get_bloginfo('name') . " - " . get_bloginfo('description') );
	}
}

/**
 * Simple boolean function to test if we are on a category page, and if that page has a parent.
 */
function make_is_parent_page() {
	if ( is_category() ) {
		$obj = get_queried_object();
		if ( $obj->parent == 0 ) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

/**
 * Adds footer copyright information
 */
function make_copyright_footer() { ?>
	<div class="footer_copyright">
		<div class="col-xs-12 text-center">
			<p class="text-muted"><small>Make: and Maker Faire are registered trademarks of Maker Media, Inc. | <a href="//makermedia.com/privacy/">Privacy</a> | <a href="//makermedia.com/terms/">Terms</a></small></p>
			<p class="text-muted"><small>Copyright &copy; 2004-<?php echo date("Y") ?> Maker Media, Inc.  All rights reserved</small></p>
		</div>
	</div>
<?php }


/**
 * Custom string length.
 * Just a wrapper for substr()
 * @param  string $str String to be shortened
 * @param  int $length Character count to limit the string
 * @param  bool $echo Whether to echo or return the string. Default is to return.
 */
function make_trim_characters( $str, $length, $echo = false ) {
	if ( $echo == false ) {
		return substr( $str, 0, $length);
	} else {
		echo substr( $str, 0, $length);
	}
}

/**
 * Add a post title override for the home page.
 */
$field_data = array (
	'title_takeover' => array(
		'fields' => array(
			'title_override' 	=> array(
				'label' 		=> 'Title Override',
				'hint'			=> 'Use this to create a custom shortened title.',
				'type' 			=> 'text',
				),
		),
		'title' => 'Post Override',
		'context' => 'advanced',
		'pages' => array( 'post', 'page', 'projects', 'review', 'craft', 'magazine' ),
	),
);
$easy_cf = new Easy_CF( $field_data );

function make_get_post_template() {
	global $pagenow;
	if ( 'post.php' == $pagenow ) {
		$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : intval( $_POST['post_ID'] ) ;
		$template_file = get_post_meta( $post_id, '_wp_page_template', TRUE );
		$field_data = array (
			'title_takeover' => array(
				'fields' => array(
					'first_row'	=> array(
						'label' 		=> 'First Row',
						'hint'			=> 'Insert a shortcode here, or anything else that you want to spit out...',
						'type' 			=> 'text',
						),
					'second_row'	=> array(
						'label' 		=> 'Second Row',
						'hint'			=> 'Insert a shortcode here, or anything else that you want to spit out...',
						'type' 			=> 'text',
						),
				),
				'title' => 'Weekend Projects Sliders',
				'context' => 'advanced',
				'pages' => array( 'page' ),
			),
		);
		if ( $template_file == 'page-weekend-projects-2013.php' ) {
			$easy_cf = new Easy_CF( $field_data );
		}
	}
}

add_filter( 'init', 'make_get_post_template' );


function make_post_card( $args ) {

	$the_query = new WP_Query( $args );

	$output = '';

	while ( $the_query->have_posts() ) : $the_query->the_post();
		$output .= '<a href="' . esc_url( get_permalink() ) . '">';
		$output .= ( isset( $args[ 'weekend-projects'] ) ) ? '<img class="weekend-project-image" src="' . get_stylesheet_directory_uri() . '/img/WP02_Feature_banner_02.jpg" alt="Powered by RadioShack">' : '';
		$output .= get_the_post_thumbnail( get_the_id(), 'small-home-feature-boxes' );
		$title = get_post_meta( get_the_ID(), 'title_override', true );
		$output .= ( ! empty( $title ) ) ? '<h4>' . make_trim_characters( esc_html( $title ), get_theme_mod( 'make_home_title_text' ) ) . '</h4>' : '<h4>' . make_trim_characters( get_the_title(), get_theme_mod( 'make_home_caption_taxt' ) ) . '</h4>';
		$output .= Markdown( make_trim_characters( strip_shortcodes( get_the_excerpt() ), get_theme_mod( 'make_home_caption_taxt' ) ) );
		$output .= '</a>';
	endwhile;

	// Reset Post Data
	wp_reset_postdata();

	return $output;
}


/**
 * Get categories as a simple array
 */
function make_get_categories_as_array() {
	$cats = get_categories();
	$categories = array( 0 => 'None' );
	foreach ($cats as $key => $value) {
		$categories[ absint( $value->term_id )] = esc_html( $value->name );
	}
	return $categories;
}

/**
 * Assign the takeover banner to the category pages
 */
function make_get_banner_to_category_page() {
	global $post;
	if ( get_theme_mod( 'make_home_banner_category' ) == get_queried_object_id() ) :

		if ( get_theme_mod( 'make_home_banner' ) === 'on' ) : ?>

			<div class="col-xs-12 home-banner">
				<a href="<?php echo esc_url( get_theme_mod( 'make_category_banner_link', 'https://makezine.com/maker-faire-rome-arduino-project-challenge/' ) ); ?>">
					<img src="<?php echo esc_url( get_theme_mod( 'make_home_takeover_image', get_stylesheet_directory_uri() . '/img/cnc.jpg' ) ); ?>">
				</a>
			</div>

		<?php endif;

	endif;

}


add_action( 'category_top', 'make_get_banner_to_category_page' );


/**
 * Set caption width to auto for responsive theme
 */

// add_filter( 'img_caption_shortcode', 'bs_responsive_img_caption_filter', 10, 3 );
// function bs_responsive_img_caption_filter( $val, $attr, $content = null ) {
// 	extract( shortcode_atts( array(
// 		'id' => '',
// 		'align' => '',
// 		'width' => '',
// 		'caption' => ''
// 		), $attr
// 	) );

// 	if ( 1 > (int) $width || empty( $caption ) )
// 		return $val;

// 	$new_caption = sprintf( '<div id="%1$s" class="wp-caption %2$s" style="max-width:100%% !important;height:auto;width:auto;">%4$s<p class="wp-caption-text">%5$s</p></div>',
// 		esc_attr( $id ),
// 		esc_attr( $align ),
// 		'', //( 10 + (int) $width ),
// 		do_shortcode( $content ),
// 		$caption
// 	);
// 	return $new_caption;
// }

/**
 * Populate Tag Blocks
 */
function home_tags($postid) {
	$post_type = get_post_type( $postid );
  $output = '';
	if ( $post_type == 'page' ) {
		return;
	}
	else {
		$post_video = get_post_meta( $postid, 'ga_youtube_embed' );
		if ( $post_type == 'projects' ) {
			$flag = get_post_meta( $postid, 'display_category', true );
			if ( ! empty( $flag ) ) {
				$category = get_term( $flag, 'category' );
			} else {
				$categories = get_the_category( $postid );
				$category = $categories[0];
			}
			$catname = $category->name;
			$caturl = get_category_link( $category ) . '';

			echo '<a href="'.$caturl.'" alt="category"><span class="fa fa-wrench"></span>'.$catname.'</a>';
		}
		else {
			$dc = get_post_meta( $postid, 'display_category', true );
			$tag = get_the_tags( $postid );
			if ( ! empty( $dc ) ) {
				$term = get_term( $dc, 'post_tag' );
				echo '<a href="' . get_site_url() . '/tag/' . $term->slug . '/" alt="tag">'.$term->name.'</a>';
			}
			elseif( ! empty( $tag ) ) {
				echo '<a href="' . get_site_url() . '/tag/' . $tag[0]->slug . '/" alt="tag">'.$tag[0]->name.'</a>';
			}
			else {
				echo '';
			}
		}
		if ( $post_video[0] > 0 ) {
			$output .= '<div class="videoblock"><a href="';
      $link = get_the_permalink($postid);
      $output .= $link;
      $output .= '">';
      $output .= '';
      $output .= '<span class="video fa fa-video-camera"></span>';
      $output .= '</a></div>';
      echo $output;
		}
	}
}