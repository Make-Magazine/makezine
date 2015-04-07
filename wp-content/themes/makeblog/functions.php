<?php
// Easy Custom Fields Plugin
require_once( WP_PLUGIN_DIR . '/easy-custom-fields/easy-custom-fields.php' );

/*

Table of Contents
-----------------

1.	Error Reporting
2.	WordPress.com VIP Stuff
3.	Page Numbering
4.	Comments Function
5.	Short Codes
6.	Theme Stuff
7.	Custom Taxonomies
8.	Page 2 - Custom Post Type
9.	YouTube Embed Function
10.	Contribute Function
11.	Scheduled Posts
12.	From the Maker Shed
13.	Search Engine
14.	Search Terms Custom Post Type
*/

// 1. Error Reporting

if ( defined( 'WP_CLI' ) && WP_CLI )
include_once dirname( __FILE__ ) . '/includes/class-make-cli.php';

// 2. WordPress.com VIP Hosting Stuff
// include_once dirname( __FILE__ ) . '/includes/vip.php';

// Load Gigya!
// include_once dirname( __FILE__ ) . '/includes/gigya/gigya.php';

// 3. NUMBERED PAGE NAVIGATION
include_once dirname( __FILE__ ) . '/includes/pagenavi.php';

// 4. Comments Function
include_once dirname( __FILE__ ) . '/includes/comment.php';

// 5. Shortcodes
include_once dirname( __FILE__ ) . '/includes/shortcodes.php';

// 6. Theme Stuff
include_once dirname( __FILE__ ) . '/includes/theme_stuff.php';

// 7. Custom Taxonomies
include_once dirname( __FILE__ ) . '/includes/taxonomies.php';

// 8. Page 2 - Custom Post Type
include_once dirname( __FILE__ ) . '/includes/page_2.php';

// 9. YouTube Embed Function
include_once dirname( __FILE__ ) . '/includes/youtube.php';

// 10. Contribute Function
include_once dirname( __FILE__ ) . '/includes/contribute.php';

// 11. Scheduled Posts
include_once dirname( __FILE__ ) . '/includes/wordpress-scheduled-time.php';

// 12. From the Maker Shed
include_once dirname( __FILE__ ) . '/includes/ftms.php';

// 13. Search Engine
include_once dirname( __FILE__ ) . '/includes/search-terms.php';

// 14. Search Terms Custom Post Type
include_once dirname( __FILE__ ) . '/includes/search-terms-cpt.php';

// 15. Search Terms Custom Post Type
include_once dirname( __FILE__ ) . '/includes/featured-makers.php';

// 16. Search Terms Custom Post Type
// 46. Cheezcap
include_once dirname( __FILE__ ) . '/includes/cheezcap/cheezcap.php';

// 17. House Ads Custom Post Type
include_once dirname( __FILE__ ) . '/includes/house-ads-cpt.php';

// 19. Magazine Articles
include_once dirname( __FILE__ ) . '/includes/magazine-cpt.php';

// 20. Craft Feed Meta Box
include_once dirname( __FILE__ ) . '/includes/craft-cpt-stuff.php';

// 21. Slideshow CPT
include_once dirname( __FILE__ ) . '/includes/slideshow.php';

// 22. Reviews CPT
include_once dirname( __FILE__ ) . '/includes/reviews.php';

// 24. Projects CPT
include_once dirname( __FILE__ ) . '/includes/projects-cpt.php';

// 25. Video CPT
include_once dirname( __FILE__ ) . '/includes/video-cpt.php';

// 26. Order Bender
include_once dirname( __FILE__ ) . '/includes/order-bender.php';

// 27. Errata CPT
include_once dirname( __FILE__ ) . '/includes/errata-cpt.php';

// 28. Contextly
//include_once dirname( __FILE__ ) . '/includes/contextly-related-links/contextly-linker.php';

// 28. Markdown
include_once dirname( __FILE__ ) . '/includes/markdown/markdown.php';

// 29. Categories
include_once dirname( __FILE__ ) . '/includes/categories.php';

// 30. JSON Endpoint
include_once dirname( __FILE__ ) . '/includes/json-endpoint.php';

// 31. Projects Step Manager
include_once dirname( __FILE__ ) . '/includes/projects-manager.php';

// 31. Maker Camp
include_once dirname( __FILE__ ) . '/includes/maker-camp.php';

// 33. CLI CSV
if ( defined('WP_CLI') && WP_CLI )
	include_once dirname( __FILE__ ) . '/includes/wp-cli.php';

// 34. Author Bio
include_once dirname(  __FILE__  ) . '/includes/class-author-profile.php';

// 35. Go Links
include_once dirname(  __FILE__  ) . '/includes/post-types/go.php';

// 36. Bit.ly Functions
include_once dirname(  __FILE__  ) . '/includes/bitly.php';

// 37. Maker Camp Map
include_once dirname( __FILE__ ) . '/includes/google-maps.php';

// 38. Content Manager
include_once dirname( __FILE__ ) . '/includes/magazine-dashboard/magazine-dashboard.php';

// 39. Newsletter Post Type
include_once dirname(  __FILE__  ) . '/includes/post-types/newsletter.php';

// 40. Social Stats
include_once dirname(  __FILE__  ) . '/includes/stats/stats.php';

// 41. Blog Dashboard
include_once dirname( __FILE__ ) . '/includes/blog-dashboard/blog-dashboard.php';

// 42. Search Facets
include_once dirname( __FILE__ ) . '/includes/search/search.php';

// 43. Maker Shed Functions
include_once dirname( __FILE__ ) . '/includes/shed/shed.php';

// 44. Home Take Over - Theme Customizer API
include_once dirname( __FILE__ ) . '/includes/theme-customizer/takeover.php';

// 45. Related Content Blocks
include_once dirname( __FILE__ ) . '/includes/related.php';

// 45. Contribute Form
include_once dirname( __FILE__ ) . '/includes/contribute/contribute.php';

// 45. Instagram
include_once dirname( __FILE__ ) . '/includes/instagram/instagram.php';

// 46. Makers Post Type
include_once dirname( __FILE__ ) . '/includes/post-types/makers.php';

// 47. VIP Helper
include_once dirname( __FILE__ ) . '/includes/vip-helper.php';

// 48. VIP Helper COM
include_once dirname( __FILE__ ) . '/includes/vip-helper-wpcom.php';


function dfp_add_meta_boxes($postType) {
  $types = array('page', 'projects');
  if(in_array($postType, $types)){
	  add_meta_box( 'dfp_target_metabox', 'DFP Targeting', 'dfp_target_metabox', $postType, 'normal', 'default' );
  }
}

add_action( 'add_meta_boxes', 'dfp_add_meta_boxes' );

function dfp_target_metabox($page) {

	$_adslot_targeting_name = get_post_meta( $page->ID, '_adslot_targeting_name', true );
  $_adslot_targeting_ids = get_post_meta( $page->ID, '_adslot_targeting_ids', true );
  ?>
    <table style="width: 100%">
      <tr>
        <td>DFP Target Name</td>
      </tr>
      <tr>
        <td><input style="width: 100%" type="text" name="adslot_targeting_name" value="<?php echo esc_attr($_adslot_targeting_name); ?>"></td>
      </tr>
    </table>
	<table style="width: 100%">
      <tr>
        <td>DFP Target IDs</td>
      </tr>
      <tr>
        <td><input style="width: 100%" type="text" name="adslot_targeting_ids" value="<?php echo esc_attr($_adslot_targeting_ids); ?>"></td>
      </tr>
    </table>
  <?php

}

add_action('save_post', 'dfp_target_save_post', 10, 2);
function dfp_target_save_post($page_id, $page) {

    if(isset($_POST['adslot_targeting_name']) && $_POST['adslot_targeting_name'] != '') {
      update_post_meta($page_id, '_adslot_targeting_name', sanitize_text_field($_POST['adslot_targeting_name']));
    }

    if(isset($_POST['adslot_targeting_ids']) && $_POST['adslot_targeting_ids'] != '') {
      update_post_meta($page_id, '_adslot_targeting_ids', sanitize_text_field($_POST['adslot_targeting_ids']));
    }
}

function add_theme_caps() {
    // gets the author role
    $role = get_role( 'contributor' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'upload_files' ); 
}
add_action( 'contributor_init', 'add_theme_caps');

// Custom placement of jetpack share buttons
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'jptweak_remove_share' );
