<?php
// Easy Custom Fields Plugin
require_once(WP_PLUGIN_DIR . '/easy-custom-fields/easy-custom-fields.php');

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

Version 2 Includes
15. Version
*/

// 1. Error Reporting

if (defined('WP_CLI') && WP_CLI)
    include_once dirname(__FILE__) . '/includes/class-make-cli.php';

// 2. WordPress.com VIP Hosting Stuff
// include_once dirname( __FILE__ ) . '/includes/vip.php';

// Load Gigya!
// include_once dirname( __FILE__ ) . '/includes/gigya/gigya.php';

// 3. NUMBERED PAGE NAVIGATION
include_once dirname(__FILE__) . '/includes/pagenavi.php';

// 4. Comments Function
include_once dirname(__FILE__) . '/includes/comment.php';

// 5. Shortcodes
include_once dirname(__FILE__) . '/includes/shortcodes.php';

// 6. Theme Stuff
include_once dirname(__FILE__) . '/includes/theme_stuff.php';

// 7. Custom Taxonomies
include_once dirname(__FILE__) . '/includes/taxonomies.php';

// 8. Page 2 - Custom Post Type
include_once dirname(__FILE__) . '/includes/page_2.php';

// 9. YouTube Embed Function
include_once dirname(__FILE__) . '/includes/youtube.php';

// 10. Contribute Function
include_once dirname(__FILE__) . '/includes/contribute.php';

// 11. Scheduled Posts
include_once dirname(__FILE__) . '/includes/wordpress-scheduled-time.php';

// 12. From the Maker Shed
include_once dirname(__FILE__) . '/includes/ftms.php';

// 13. Search Engine
//include_once dirname(__FILE__) . '/includes/search-terms.php';

// 14. Search Terms Custom Post Type
//include_once dirname(__FILE__) . '/includes/search-terms-cpt.php';

// 15. Search Terms Custom Post Type
include_once dirname(__FILE__) . '/includes/featured-makers.php';

// 16. Search Terms Custom Post Type
// 46. Cheezcap
// include_once dirname(__FILE__) . '/version-2/includes/cheezcap/cheezcap.php';

// 17. House Ads Custom Post Type
include_once dirname(__FILE__) . '/includes/house-ads-cpt.php';

// 19. Magazine Articles
//include_once dirname(__FILE__) . '/includes/magazine-cpt.php';

// 20. Craft Feed Meta Box
//include_once dirname(__FILE__) . '/includes/craft-cpt-stuff.php';

// 21. Slideshow CPT
include_once dirname(__FILE__) . '/includes/slideshow.php';

// 22. Reviews CPT
//include_once dirname(__FILE__) . '/includes/reviews.php';

// 24. Projects CPT
include_once dirname(__FILE__) . '/includes/projects-cpt.php';

// 25. Video CPT
include_once dirname(__FILE__) . '/includes/video-cpt.php';

// 26. Order Bender
//include_once dirname( __FILE__ ) . '/includes/order-bender.php';

// 27. Errata CPT
//include_once dirname(__FILE__) . '/includes/errata-cpt.php';

// 28. Contextly
//include_once dirname( __FILE__ ) . '/includes/contextly-related-links/contextly-linker.php';

// 28. Markdown
include_once dirname(__FILE__) . '/includes/markdown/markdown.php';

// 29. Categories
include_once dirname(__FILE__) . '/includes/categories.php';

// 30. JSON Endpoint
include_once dirname(__FILE__) . '/includes/json-endpoint.php';

// 31. Projects Step Manager
include_once dirname(__FILE__) . '/includes/projects-manager.php';

// 31. Maker Camp
include_once dirname(__FILE__) . '/includes/maker-camp.php';

// 33. CLI CSV
if (defined('WP_CLI') && WP_CLI)
    include_once dirname(__FILE__) . '/includes/wp-cli.php';

// 34. Author Bio
include_once dirname(__FILE__) . '/includes/class-author-profile.php';

// 35. Go Links
include_once dirname(__FILE__) . '/includes/post-types/go.php';

// 36. Bit.ly Functions
include_once dirname(__FILE__) . '/includes/bitly.php';

// 37. Maker Camp Map
include_once dirname(__FILE__) . '/includes/google-maps.php';

// 38. Content Manager
include_once dirname(__FILE__) . '/includes/magazine-dashboard/magazine-dashboard.php';

// 39. Newsletter Post Type
include_once dirname(__FILE__) . '/includes/post-types/newsletter.php';

// 40. Social Stats
include_once dirname(__FILE__) . '/includes/stats/stats.php';

// 41. Blog Dashboard
include_once dirname(__FILE__) . '/includes/blog-dashboard/blog-dashboard.php';

// 42. Search Facets
//include_once dirname(__FILE__) . '/includes/search/search.php';

// 43. Maker Shed Functions
include_once dirname(__FILE__) . '/includes/shed/shed.php';

// 44. Home Take Over - Theme Customizer API
include_once dirname(__FILE__) . '/includes/theme-customizer/takeover.php';

// 45. Related Content Blocks
include_once dirname(__FILE__) . '/includes/related.php';

// 45. Contribute Form
include_once dirname(__FILE__) . '/includes/contribute/contribute.php';

// 45. Instagram
include_once dirname(__FILE__) . '/includes/instagram/instagram.php';

// 46. Makers Post Type
include_once dirname(__FILE__) . '/includes/post-types/makers.php';

// 47. VIP Helper
include_once dirname(__FILE__) . '/includes/vip-helper.php';

// 48. VIP Helper COM
include_once dirname(__FILE__) . '/includes/vip-helper-wpcom.php';

// Version-2 Includes
include_once dirname(__FILE__) . '/version-2/includes/makezine_rewrite_rules.php';

// Version-2 Includes
include_once dirname(__FILE__) . '/version-2/includes/home-menu-curator.php';

// Define global make obj.
$make = new stdClass();

function dfp_add_meta_boxes($postType)
{
    $types = array('page', 'projects');
    if (in_array($postType, $types)) {
        add_meta_box('dfp_target_metabox', 'DFP Targeting', 'dfp_target_metabox', $postType, 'normal', 'default');
    }
}

add_action('add_meta_boxes', 'dfp_add_meta_boxes');

function dfp_target_metabox($page)
{

    $_adslot_targeting_name = get_post_meta($page->ID, '_adslot_targeting_name', true);
    $_adslot_targeting_ids = get_post_meta($page->ID, '_adslot_targeting_ids', true);
    ?>
    <table style="width: 100%">
        <tr>
            <td>DFP Target Name</td>
        </tr>
        <tr>
            <td><input style="width: 100%" type="text" name="adslot_targeting_name"
                       value="<?php echo esc_attr($_adslot_targeting_name); ?>"></td>
        </tr>
    </table>
    <table style="width: 100%">
        <tr>
            <td>DFP Target IDs</td>
        </tr>
        <tr>
            <td><input style="width: 100%" type="text" name="adslot_targeting_ids"
                       value="<?php echo esc_attr($_adslot_targeting_ids); ?>"></td>
        </tr>
    </table>
    <?php

}

add_action('save_post', 'dfp_target_save_post', 10, 2);
function dfp_target_save_post($page_id, $page)
{

    if (isset($_POST['adslot_targeting_name']) && $_POST['adslot_targeting_name'] != '') {
        update_post_meta($page_id, '_adslot_targeting_name', sanitize_text_field($_POST['adslot_targeting_name']));
    }

    if (isset($_POST['adslot_targeting_ids']) && $_POST['adslot_targeting_ids'] != '') {
        update_post_meta($page_id, '_adslot_targeting_ids', sanitize_text_field($_POST['adslot_targeting_ids']));
    }
}

function add_theme_caps()
{
    // gets the author role
    $role = get_role('contributor');

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap('upload_files');
}

add_action('contributor_init', 'add_theme_caps');

// Custom placement of jetpack share buttons
function jptweak_remove_share()
{
    remove_filter('the_content', 'sharing_display', 19);
    remove_filter('the_excerpt', 'sharing_display', 19);
    if (class_exists('Jetpack_Likes')) {
        remove_filter('the_content', array(Jetpack_Likes::init(), 'post_likes'), 30, 1);
    }
}

add_action('loop_start', 'jptweak_remove_share');

function get_resized_remote_image_url($url, $width, $height, $escape = true)
{
    if (class_exists('Jetpack') && Jetpack::is_module_active('photon')) :
        $width = (int)$width;
        $height = (int)$height;

// Photon doesn't support redirects, so help it out by doing http://foobar.wordpress.com/files/ to http://foobar.files.wordpress.com/
        if (function_exists('new_file_urls'))
            $url = new_file_urls($url);

        $thumburl = jetpack_photon_url($url, array('resize' => array($width, $height)));

        return ($escape) ? esc_url($thumburl) : $thumburl;
    endif;
}

function get_excerpt_by_id($post_id)
{
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 35; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    if (count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    endif;

    $the_excerpt = '<p>' . $the_excerpt . '</p>';

    return $the_excerpt;
}

// Define our current Version number using the stylesheet version
function my_wp_default_styles($styles)
{
    $my_theme = wp_get_theme();
    $my_version = $my_theme->get('Version');
    $styles->default_version = $my_version;
}

add_action("wp_default_styles", "my_wp_default_styles");

// Force Parent Category selection

function parent_category_toggle()
{

    $taxonomies = apply_filters('parent_category_toggle', array());
    for ($x = 0; $x < count($taxonomies); $x++) {
        $taxonomies[$x] = '#' . $taxonomies[$x] . 'div .selectit input';
    }
    $selector = implode(',', $taxonomies);
    if ($selector == '') $selector = '.selectit input';

    echo '
    <script>
    jQuery("' . $selector . '").change(function(){
      var $chk = jQuery(this);
      var ischecked = $chk.is(":checked");
      $chk.parent().parent().siblings().children("label").children("input").each(function(){
    var b = this.checked;
    ischecked = ischecked || b;
    })
      checkParentNodes(ischecked, $chk);
    });
    function checkParentNodes(b, $obj)
    {
      $prt = findParentObj($obj);
      if ($prt.length != 0)
      {
       $prt[0].checked = b;
       checkParentNodes(b, $prt);
      }
    }
    function findParentObj($obj)
    {
      return $obj.parent().parent().parent().prev().children("input");
    }
    </script>
    ';

}

add_action('admin_footer-post.php', 'parent_category_toggle');
add_action('admin_footer-post-new.php', 'parent_category_toggle');

get_template_part('version-2/includes/pbd-ajax-load-posts');
get_template_part('version-2/includes/Mobile_Detect.php');

function make_shopify_featured_products($row = 'row') {
    echo '<li class="ads temp ow product-wrapper shed-row">';
    echo make_shopify_featured_products_slider_home('row-fluid' );
    echo '</li>';
    die();
}

add_action('wp_ajax_make_shopify_featured_products', 'make_shopify_featured_products');
add_action('wp_ajax_nopriv_make_shopify_featured_products', 'make_shopify_featured_products');


function theme_styles()
{
    wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() . '/version-2/css/bootstrap.min.css');
    wp_enqueue_style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/version-2/css/style.css');
    wp_enqueue_style('project-css', get_stylesheet_directory_uri() . '/version-2/css/project-style.css');
<<<<<<< HEAD
    wp_enqueue_style('blogpage-css', get_stylesheet_directory_uri() . '/version-2/css/blog.css');
=======
    wp_enqueue_style('single-storie-css', get_stylesheet_directory_uri() . '/version-2/css/single-story.css');
>>>>>>> b33fcb008010eae752d9412167f1c19063803a88
}

add_action('wp_enqueue_scripts', 'theme_styles');

function winwar_first_sentence($string)
{
    $sentence = preg_split('/(\.|!|\?)\s/', $string, 2, PREG_SPLIT_DELIM_CAPTURE);
    return $sentence['0'] . $sentence['1'];
}

function filter_list_output()
{
    $output = '';
    $output .= '<div class="filter-list row">';
    $output .= '<div class="filter-item">';
    $output .= '<div class="spinner">';
    $output .= '<img src="';
    $spinner = get_stylesheet_directory_uri() . '/images/spinner_60.gif';
    $output .= $spinner;
    $output .= '" alt="spinner">';
    $output .= '</div>';
    $output .= '<span class="fa fa-chevron-up"></span>';
    $output .= '<span class="fa fa-chevron-down"></span>';
    $output .= '<ul class="col-lg-5 col-md-6 col-sm-7 col-xs-7">';
    $output .= '<li class="difficulty">';
    $output .= '<p>difficulty</p>';
    $output .= '<ul class="diff-item">';
    $output .= '<li><span class="all-lvl fa fa-wrench clicks" data-value="diff1" data-original-title="Easy for Everyone"></span></li>';
    $output .= '<li><span class="moderate fa fa-wrench clicks"  data-value="diff2" data-toggle="tooltip" data-placement="top"
       data-original-title="Intermediate"></span></li>';
    $output .= '<li><span class="spec-skill fa fa-wrench clicks"  data-value="diff3" data-toggle="tooltip" data-placement="top"
       data-original-title="Advanced (But we`ll help you learn the required skills.)"></span></li>';
    $output .= '</ul>';
    $output .= '</li>';
    $output .= '<li class="duration">';
    $output .= '<p>duration</p>';
    $output .= '<ul class="duration-item">';
    $output .= '<li><span class="1-3h fa fa-clock-o clicks"  data-value="dur1" data-toggle="tooltip" data-placement="top" data-original-title="Avg. build time 1-3 hours"></span></li>';
    $output .= '<li><span class="3-8h fa fa-clock-o clicks"  data-value="dur2" data-toggle="tooltip" data-placement="top" data-original-title="Avg. build time 3-8 hours"></span></li>';
    $output .= '<li><span class="8-16h fa fa-clock-o clicks" data-value="dur3"  data-toggle="tooltip" data-placement="top" data-original-title="Avg. build time 8-16 hours (a weekend)"></span></li>';
    $output .= '<li><span class="16h fa fa-clock-o clicks" data-value="dur4"  data-toggle="tooltip" data-placement="top" data-original-title="Avg. build time >16 hours"></span></li>';
    $output .= '</ul>';
    $output .= '</li>';
    $output .= '</ul>';
    $output .= '<p class="clear clicks">Clear all</p>';
    $output .= '<div class="post-filter col-lg-3 col-md-3 col-sm-4 col-xs-4">';
    $output .= '<p class="recent current clicks" data-value="recent">Recent</p>';
    $output .= '<p class="popular clicks" data-value="popular">Popular</p>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    echo $output;
    return $output;
}

function truncate_with_ellipses($str, $len) {
    return strlen($str) > $len ? substr($str,0,$len)."..." : $str;
}

function sorting_posts_home($current_cat_id = '', $difficulty = '', $how_to_sort = 'recent', $duration = '', $paged = '1', $type = 'initial_load')
{
    require_once 'version-2/includes/Mobile_Detect.php';
    $device = '';
    $detect = new Mobile_Detect;
    $post_per_page = 18;
    if ($detect->isMobile()) {
        $post_per_page = 5;
        $device = 'mobile';
    }

    if ($detect->isTablet()) {
        $post_per_page = 10;
        $device = 'tablet';
    }
    $current_cat_name = single_cat_title("", 0);
    $sub_meta_query = array(
        'relation' => 'AND',
    );
    $meta_query = array(
        'relation' => 'AND',
    );
    $meta_query[] = $sub_meta_query;
    $args = array(
        'post_type' => array('post', 'projects',),
        'meta_query' => $meta_query,
        'posts_per_page' => $post_per_page,
        'paged' => $paged,
        'orderby' => $ordered,
        'post__in' => $top_ids,
        'post_status' => 'publish',
    );

    if (!empty($current_cat_id)) $args['cat'] = $current_cat_id;
    $query = new WP_Query($args);
    $counter = 0;
    $ads_counter = 0;
    $max_num_pages = $query->max_num_pages;
    $output = '';
    // Add leadboard for additional pages.
    if (isset($paged) && $paged > 1 && $post_per_page > 12) {
        $output .= '<li class="row post_rows"><div class="js-ad" data-size=\'[[728,90],[940,250],[970,90],[970,250],[320,50]]\' data-size-map=\'[[[1000,0],[[728,90],[940,250],[970,90],[970,250]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]\' data-pos=\'"btf"\'></div></li>';
    }
    if ($type !== 'load_more') {
        $output .= '<ul class="selected-posts-list" data-max_num_pages="' . $max_num_pages . '">';
    }
    if ($query->have_posts()) {
        while ($query->have_posts())  : $query->the_post();
            if ($counter == 0) {
                $output .= '<li class="row post_rows"> <ul>';
            }
            $counter++;

            if ( $ads_counter == 0 && $counter == 3 && $post_per_page == 18 ) {
                $output .= '<li class="post col-lg-4 col-md-4 col-sm-6 col-xs-12 own_ads';
                $output .= '">';
                $output .= '<div class="own">';
                $output .= '<div class="home-ads">';
                $output .= '<div class="js-ad" data-size=\'[[300,250]]\' data-pos=\'"btf"\'></div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</li>';
                $counter++;
                $output .= '</ul> </li>';
                $counter = 0;
                $ads_counter = 1;
            }
            else {

                $output .= '<li class="post col-lg-4 col-md-4 col-sm-6 col-xs-12';
                if (($ads_counter == 16) and ($device != 'tablet') and ($device != 'mobile')) {
                    $output .= ' before-ads';
                }
                if (($ads_counter == 3) and ($device == 'tablet')) {
                    $output .= ' before-ads';
                }
                if (($ads_counter == 1) and ($device == 'mobile')) {
                    $output .= ' before-ads';
                }

                $post_id = get_the_ID();
                $output .= '">';
                $output .= '<div class="gradient-wrapper"><div class="gradient_animation"><a href="';
                $link = get_the_permalink();
                $output .= $link;
                $output .= '">';
                $output .= '</a></div>';
                $output .= '<div class="final_gradient"><a href="';
                $link = get_the_permalink();
                $output .= $link;
                $output .= '">';
                $output .= '</a></div>';
                $output .= '<a href="';
                $link = get_the_permalink();
                $output .= $link;
                $output .= '">';
                $args = array(
                    'resize' => '370,240',
                );
                $url = wp_get_attachment_image(get_post_thumbnail_id($post_id), 'project-thumb');
                $re = "/^(.*? src=\")(.*?)(\".*)$/m";
                preg_match_all($re, $url, $matches);
                $str = $matches[2][0];
                $photon = jetpack_photon_url($str, $args);
                $output .= '<img src="' . $photon . '" alt="thumbnail">';
                $output .= '</a>';


                $post_duration = get_post_meta($post_id, 'project_duration');
                $post_difficulty = get_post_meta($post_id, 'project_difficulty');
                $post_video = get_post_meta($post_id, 'ga_youtube_embed');
                $post_flag = get_post_meta($post_id, 'flag_taxonomy');
                $output .= '<div class="filter-display-wrapper">';
                $output .= '<div class="red-box-category">';

                $red_cat_name = '';
                $cat_link = '';
                if ('post' == get_post_type()) {
                    $post_display_category = get_post_meta($post_id, 'display_category');

                    if (!empty($post_display_category[0])) {
                        $red_cat_name = get_tag(intval($post_display_category[0]))->name;
                        $cat_link = get_tag_link($post_display_category[0]);
                    } else {
                        if ($the_tags = get_the_tags()) {
                            $the_tag = $the_tags[0]; //TODO: be smarter here.  Should probably get the tag with most things
                            $red_cat_name = $the_tag->name;
                            $cat_link = get_tag_link($the_tag->term_id);
                        }
                    }
                } elseif (!empty($post_flag[0])) {
                    $red_cat_name = get_cat_name(intval($post_flag[0]));
                    $cat_link = get_category_link($post_flag[0]) . '?post_type=projects';
                } else {
                    $post_categories = get_the_category();
                    foreach ($post_categories as $post_category) {
                        if (!empty($current_cat_id)) {
                            if ($post_category->parent == $current_cat_id) {
                                $child_cat[] = $post_category->name;
                            }
                        } else {
                            if ($post_category->category_parent == 0) {
                                $parent_cat[] = $post_category->name;
                                $parent_id[] = $post_category->term_id;
                            }
                        }
                    }


                    if (!empty($current_cat_id)) {
                        $child_cat_length = count($child_cat);
                        $child_cat_length--;
                        $random_cat_number = rand(0, $child_cat_length);
                        if ($child_cat_length >= 0) {
                            $red_cat_name = $child_cat[$random_cat_number];
                        } else {
                            $red_cat_name = '';
                        }
                    } else {
                        $parent_cat_length = count($parent_cat);
                        $parent_cat_length--;
                        $random_cat_number = rand(0, $parent_cat_length);
                        $red_cat_name = $parent_cat[$random_cat_number];
                        $cat_link = get_category_link($parent_id[$random_cat_number]) . '?post_type=projects';
                    }
                }
                $red_cat_name = htmlspecialchars_decode($red_cat_name);
                $cat_length = iconv_strlen($red_cat_name, 'UTF-8');
                if ($cat_length > 13) {
                    $red_cat_name = substr($red_cat_name, 0, 13) . '...';
                }
                if (!empty($red_cat_name)) {
                    $output .= '<p><a href="';
                    $output .= $cat_link;
                    if ('post' == get_post_type()) {
                        $output .= '">#';
                    } else {
                        $output .= '"><span class="fa fa-wrench"></span>';
                    }
                    $output .= $red_cat_name;
                    $output .= '</a></p>';
                }
                if (!empty($post_video[0])) {
                    $output .= '<div class="videoblock">';
                    $output .= '<span class="video fa fa-video-camera"></span>';
                    $output .= '</div>';
                }
                $output .= '</div>';
                $difficulty_counter = 0;
                $duration_counter = 0;
                if (!empty($post_difficulty[0])) {
                    switch ($post_difficulty[0]) {
                        case 'Easy':
                            $difficulty_counter = 1;
                            break;
                        case 'Moderate':
                            $difficulty_counter = 2;
                            break;
                        case 'Hard':
                            $difficulty_counter = 3;
                            break;
                    }
                }

                if (!empty($post_duration[0])) {
                    switch ($post_duration[0]) {
                        case '1–3 Hours ':
                            $duration_counter = 1;
                            break;
                        case '3-8 Hours':
                            $duration_counter = 2;
                            break;
                        case '8–16 Hours (A Weekend)':
                            $duration_counter = 3;
                            break;
                        case '>16 Hours':
                            $duration_counter = 4;
                            break;
                    }
                }

                $output .= '<div class="difficulty-lvl">';
                while ($difficulty_counter > 0) {
                    $output .= '<span class="difficulty-level-image fa fa-wrench"></span>';
                    $difficulty_counter--;
                }
                $output .= '</div>';
                $output .= '<div class="duration-lvl">';
                while ($duration_counter > 0) {
                    $output .= '<span class="duration-level-image fa fa-clock-o"></span>';
                    $duration_counter--;
                }
                $output .= '</div>';
                $output .= '</div>';
                $excerpt = get_the_excerpt();
                if (!has_excerpt($post_id)) {
                    $excerpt = strip_tags(strip_shortcodes(winwar_first_sentence($excerpt)));
                }
                $output .= '<p class="excerpt trans"><a href="';
                $link = get_the_permalink();
                $output .= $link;
                $output .= '">';
                /** strip_shortcodes did not seem to be working here for contextly - maybe it isn't r
                    egistered as a shortcode at this point.  I am duplicating the strip_shortcode call
                    here from WPSEO_Utils.  We should really figure out how to make strip_shortcodes work.
                */
                $output .= truncate_with_ellipses(preg_replace( '`\[[^\]]+\]`s', '', $excerpt ), 240);
                $output .= '</a>';
                $output .= '</p>';
                $output .= '</div><h2>';
                $output .= '<a href="';
                $link = get_the_permalink();
                $output .= $link;
                $output .= '">';
                $post_title = get_the_title();
                $output .= truncate_with_ellipses($post_title, 90);
                $output .= '</a>';
                $output .= '</h2></li>';
                if (($counter == 3) and ($device != 'tablet') and ($device != 'mobile')) {
                    $output .= '</ul> </li>';
                    $counter = 0;
                }
                if (($counter == 2) and ($device == 'tablet')) {
                    $output .= '</ul> </li>';
                    $counter = 0;
                }
                if (($counter == 1) and ($device == 'mobile')) {
                    $output .= '</ul> </li>';
                    $counter = 0;
                }

            }

            
        endwhile;
        if (($counter == 1) and ($device != 'mobile')) {
            $output .= '</ul> </li>';
        }
        do_action('custom_page_hook', $query);
        wp_reset_query();
    } else {
        $output .= '<div class="error_message">';
        $output .= '<p>Darn: we haven\'t created any projects like this for all projects (yet).</p>';
        $output .= '<span>But keep browsing!</span>';
        $output .= '</div>';
    }
    if ($type !== 'load_more') {
        $output .= '</ul>';
    }

    if ($max_num_pages > 1 && $type !== 'load_more') {
        $output .= '<p id="pbd-alp-load-posts" class="row"><a href="javascript:void(0);">More</a><i class="fa fa-spinner fa-pulse more-button-spinner"></i></p>';
    }
    echo $output;
}

function get_homegrid_with_ajax()
{
    $current_cat_id = $_POST['cat'];
    $difficulty = $_POST['diff'];
    $how_to_sort = $_POST['sort'];
    $duration = $_POST['dur'];
    $type = $_POST['type'];
    $paged = !empty($_POST['paged']) ? $_POST['paged'] : 1;
        
    sorting_posts_home($current_cat_id, $difficulty, $how_to_sort, $duration, $paged, $type);

    die();
}

add_action('wp_ajax_sorting_posts_home', 'get_homegrid_with_ajax');
add_action('wp_ajax_nopriv_sorting_posts_home', 'get_homegrid_with_ajax');

function sorting_posts($current_cat_id = '', $difficulty = '', $how_to_sort = 'recent', $duration = '', $paged = '1', $type = 'initial_load')
{
    require_once 'version-2/includes/Mobile_Detect.php';
    $device = '';
    $detect = new Mobile_Detect;
    $post_per_page_initial = 18;
    if ($detect->isMobile()) {
        $post_per_page_initial = 18;
        $device = 'mobile';
    }

    if ($detect->isTablet()) {
        $post_per_page_initial = 12;
        $device = 'tablet';
    }
    else {
        $post_per_page = $post_per_page_initial - 1;
    }
    $current_cat_name = single_cat_title("", 0);
    $sub_meta_query = array(
        'relation' => 'AND',
    );
    $meta_query = array(
        'relation' => 'AND',
    );

    switch ($difficulty) {
        case 'diff1':
            $sub_meta_query[] = array(
                'key' => 'project_difficulty',
                'value' => 'Easy',
                'compare' => '=',
            );
            break;
        case 'diff2':
            $sub_meta_query[] = array(
                'key' => 'project_difficulty',
                'value' => 'Moderate',
                'compare' => '=',
            );
            break;
        case 'diff3':
            $sub_meta_query[] = array(
                'key' => 'project_difficulty',
                'value' => 'Hard',
                'compare' => '=',
            );
            break;

    }
    $meta_query[] = $sub_meta_query;
    switch ($duration) {

        case 'dur1':
            $sub_meta_query[] = array(
                'key' => 'project_duration',
                'value' => '1–3 Hours ',
                'compare' => '=',
            );
            break;
        case 'dur2':
            $sub_meta_query[] = array(
                'key' => 'project_duration',
                'value' => '3-8 Hours',
                'compare' => '=',
            );
            break;
        case 'dur3':
            $sub_meta_query[] = array(
                'key' => 'project_duration',
                'value' => '8–16 Hours (A Weekend)',
                'compare' => '=',
            );
            break;
        case 'dur4':
            $sub_meta_query[] = array(
                'key' => 'project_duration',
                'value' => '>16 Hours',
                'compare' => '=',
            );
            break;
    }

    $top_ids = '';
    $ordered = 'date';
    if ($how_to_sort === 'popular') {
        $top_posts = stats_get_csv('postviews', array('days' => 90, 'limit' => -1));
        $top_ids = array();
        usort($top_posts, 'sort_down');
        foreach ($top_posts as $top_post) {
            $top_ids[] = $top_post['post_id'];
        }
        $ordered = 'post__in';
    }
    $meta_query[] = $sub_meta_query;
    $offset = ( $paged - 1 ) * $post_per_page;
    if ( $paged > 1 ) {
        $offset--;
    }
    $args = array(
        'post_type' => 'projects',
        'meta_query' => $meta_query,
        'posts_per_page' => $post_per_page,
        'page' => $paged,
        'offset'     =>  $offset,
        'orderby' => $ordered,
        'post__in' => $top_ids,
        'post_status' => 'publish',
        'category__not_in' => array(25624, 12, 8, 24794, 13, 1),
    );
    if (!empty($current_cat_id)) $args['cat'] = $current_cat_id;
    $query = new WP_Query($args);
    $counter = 0;
    $ads_counter = 0;
    $cat_link = '';
    $child_cat_length = -1;
    $max_num_pages = $query->max_num_pages;
    $count_posts = $query->post_count;
    $output = '';
    if ($type !== 'load_more') {
        $output .= '<ul class="selected-posts-list" data-max_num_pages="' . $max_num_pages . '">';
    }
    // Add leadboard for additional pages.
    if (isset($paged) && $paged > 1 && $post_per_page > 12) {
        $output .= '<li class="row post_rows"><div class="js-ad" data-size=\'[[728,90],[940,250],[970,90],[970,250],[320,50]]\' data-size-map=\'[[[1000,0],[[728,90],[940,250],[970,90],[970,250]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]\' data-pos=\'"btf"\'></div></li>';
    }
    if ($query->have_posts()) {
        while ($query->have_posts())  : $query->the_post();
            $child_cat = array();
            $parent_cat = array();
            $parent_id = array();
            $red_cat_name = '';
            if ($counter == 0) {
                $output .= '<li class="row post_rows"> <ul>';
            }
            $counter++;
            
            $output .= '<li class="post col-lg-4 col-md-4 col-sm-6 col-xs-12';
            if (( ( $ads_counter + 1 ) == $count_posts) and ( $count_posts > 2 )) {
                $output .= ' before-ads';
            }
            $post_id = get_the_ID();
            $output .= '">';
            $output .= '<div class="gradient-wrapper"><div class="gradient_animation"><a href="';
            $link = get_the_permalink();
            $output .= $link;
            $output .= '">';
            $output .= '</a></div>';
            $output .= '<div class="final_gradient"><a href="';
            $link = get_the_permalink();
            $output .= $link;
            $output .= '">';
            $output .= '</a></div>';
            $output .= '<a href="';
            $link = get_the_permalink();
            $output .= $link;
            $output .= '">';
            $args = array(
                'resize' => '370,240',
            );
            $url = wp_get_attachment_image(get_post_thumbnail_id($post_id), 'project-thumb');
            $re = "/^(.*? src=\")(.*?)(\".*)$/m";
            preg_match_all($re, $url, $matches);
            $str = $matches[2][0];
            $photon = jetpack_photon_url($str, $args);
            $output .= '<img src="' . $photon . '" alt="thumbnail">';
            $output .= '</a>';
            $post_duration = get_post_meta($post_id, 'project_duration');
            $post_difficulty = get_post_meta($post_id, 'project_difficulty');
            $post_video = get_post_meta($post_id, 'ga_youtube_embed');
            $post_flag = get_post_meta($post_id, 'flag_taxonomy');

            if (!empty($post_flag[0])) {
                $red_cat_name = get_cat_name(intval($post_flag[0]));
                $cat_link = get_category_link($post_flag[0]) . '?post_type=projects';
            } else {
                $post_categories = get_the_category();
                foreach ($post_categories as $post_category) {
                    if (!empty($current_cat_id)) {

                        if ($post_category->parent == $current_cat_id) {
                            $child_cat[] = $post_category->name;
                            $child_id[] = $post_category->term_id;
                        }
                    } else {
                        if ($post_category->category_parent == 0) {
                            $parent_cat[] = $post_category->name;
                            $parent_id[] = $post_category->term_id;
                        }
                    }
                }

                if (!empty($current_cat_id)) {
                    $child_cat_length = count($child_cat);
                    $child_cat_length--;
                    $check_parrent = get_category_parents($current_cat_id, false);
                    $check_parrent_counter = substr_count($check_parrent, '/');
                    if ($child_cat_length > 0) {
                        $red_cat_name = $child_cat[0];
                    } elseif ($check_parrent_counter > 1) {
                        $red_cat_name = '';
                    } else {
                        $find_sub_cats = get_the_category($post_id);
                        foreach ($find_sub_cats as $find_sub_cat) {
                            if ($find_sub_cat->parent != 0) {
                                $child_cat[] = $find_sub_cat->name;
                                $child_id[] = $find_sub_cat->term_id;
                            }
                        }
                        $child_cat_length = count($child_cat);
                        $child_cat_length--;
                        if ($child_cat_length > 0) {
                            $red_cat_name = $child_cat[0];
                        } else {
                            foreach ($find_sub_cats as $find_sub_cat) {
                                $child_cat[] = $find_sub_cat->name;
                                $child_id[] = $find_sub_cat->term_id;
                            }
                            $child_cat_length = count($child_cat);
                            $child_cat_length--;
                            $red_cat_name = $child_cat[0];
                        }
                    }
                    $cat_link = get_category_link($child_id[0]) . '?post_type=projects';
                } else {
                    $parent_cat_length = count($parent_cat);
                    $parent_cat_length--;
                    $red_cat_name = $parent_cat[0];
                    $cat_link = get_category_link($parent_id[0]) . '?post_type=projects';
                }
            }
            if (empty($red_cat_name)) {
                $red_cat_name = $post_category->name;
            }
            $red_car_id = get_cat_ID($red_cat_name);
            $cat_link = get_category_link($red_car_id) . '?post_type=projects';
            $red_cat_name = htmlspecialchars_decode($red_cat_name);
            $cat_length = iconv_strlen($red_cat_name, 'UTF-8');
            if ($cat_length > 13) {
                $red_cat_name = substr($red_cat_name, 0, 13) . '...';
            }
            $output .= '<div class="filter-display-wrapper">';
            if (!empty($red_cat_name)) {
                $output .= '<div class="red-box-category">';
                $output .= '<p><a href="';
                $output .= $cat_link;
                $output .= '"><span class="fa fa-wrench"></span>';
                $output .= $red_cat_name;
                $output .= '</a></p>';
                $output .= '</div>';
            }
            if (!empty($post_video[0])) {
                $output .= '<div class="videoblock">';
                $output .= '<span class="video fa fa-video-camera"></span>';
                $output .= '</div>';
            }
            $difficulty_counter = 0;
            $duration_counter = 0;
            if (!empty($post_difficulty[0])) {
                switch ($post_difficulty[0]) {
                    case 'Easy':
                        $difficulty_counter = 1;
                        break;
                    case 'Moderate':
                        $difficulty_counter = 2;
                        break;
                    case 'Hard':
                        $difficulty_counter = 3;
                        break;
                }
            }
            if (!empty($post_duration[0])) {
                switch ($post_duration[0]) {
                    case '1–3 Hours ':
                        $duration_counter = 1;
                        break;
                    case '3-8 Hours':
                        $duration_counter = 2;
                        break;
                    case '8–16 Hours (A Weekend)':
                        $duration_counter = 3;
                        break;
                    case '>16 Hours':
                        $duration_counter = 4;
                        break;
                }
            }

            $output .= '<div class="difficulty-lvl">';
            while ($difficulty_counter > 0) {
                $output .= '<span class="difficulty-level-image fa fa-wrench"></span>';
                $difficulty_counter--;
            }
            $output .= '</div>';
            $output .= '<div class="duration-lvl">';

            while ($duration_counter > 0) {
                $output .= '<span class="duration-level-image fa fa-clock-o"></span>';
                $duration_counter--;
            }
            $output .= '</div>';
            $output .= '</div>';
            $excerpt = get_the_excerpt();
            if (!has_excerpt($post_id)) {
                $excerpt = winwar_first_sentence($excerpt);
            }
            $output .= '<p class="excerpt trans"><a href="';
            $link = get_the_permalink();
            $output .= $link;
            $output .= '">';
             /** strip_shortcodes did not seem to be working here for contextly - maybe it isn't r
                egistered as a shortcode at this point.  I am duplicating the strip_shortcode call
                here from WPSEO_Utils.  We should really figure out how to make strip_shortcodes work.
            */
            $output .= truncate_with_ellipses(preg_replace( '`\[[^\]]+\]`s', '', $excerpt ), 240);
            $output .= '</a>';
            $output .= '</p>';
            $output .= '</div><h2>';
            $output .= '<a href="';
            $link = get_the_permalink();
            $output .= $link;
            $output .= '">';
            $post_title = get_the_title();
            $output .= truncate_with_ellipses($post_title, 90);
            $output .= '</a>';
            $output .= '</h2></li>';

            if (($counter == 3) and ($device != 'tablet') and ($device != 'mobile')) {
                $output .= '</ul> </li>';
                $counter = 0;
            }
            if (($counter == 2) and ($device == 'tablet')) {
                $output .= '</ul> </li>';
                $counter = 0;
            }
            if (($counter == 1) and ($device == 'mobile')) {
                $output .= '</ul> </li>';
                $counter = 0;
            }
            if ( ( $ads_counter == 1 ) and ( $post_per_page == $post_per_page_initial - 1 ) ) {
                if (($counter == 0) and ( ($device == 'mobile') or ($device == 'tablet') )) {
                    $output .= '<li class="row post_rows"> <ul>';
                }
                $output .= '<li class="post col-lg-4 col-md-4 col-sm-6 col-xs-12 own_ads';
                if ( $count_posts <= 2 ) {
                    $output .= ' before-ads';
                }
                $output .= '">';
                $output .= '<div class="own">';
                $output .= '<div class="home-ads">';
                $output .= '<div class="js-ad" data-size=\'[[300,250]]\' data-pos=\'"btf"\'></div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</li>';
                $counter++;
                if (($counter == 3) and ($device != 'tablet') and ($device != 'mobile')) {
                    $output .= '</ul> </li>';
                    $counter = 0;
                }
                if (($counter == 2) and ($device == 'tablet')) {
                    $output .= '</ul> </li>';
                    $counter = 0;
                }
                if (($counter == 1) and ($device == 'mobile')) {
                    $output .= '</ul> </li>';
                    $counter = 0;
                }
            }

            $ads_counter++;
        endwhile;
        if (($counter == 1) and ($device != 'mobile')) {
            $output .= '</ul> </li>';
        }
        if (($ads_counter == $post_per_page) and ($ads_counter == ($post_per_page_initial - 1))) {
            $output .= '</ul> </li>';
        }
        do_action('custom_page_hook', $query);
        wp_reset_query();
    } else {
        if (!empty($current_cat_id)) {
            $current_cat_name = get_cat_name($current_cat_id);
        } else {
            $current_cat_name = "All projects";
        }
        $output .= '<div class="error_message">';
        $output .= '<p>Darn: we haven\'t created any projects like this for <span class="current_cat_name">' . $current_cat_name . '</span> (yet).</p>';
        $output .= '<span>But keep browsing!</span>';
        $output .= '</div>';
    }
    if ($type !== 'load_more') {
        $output .= '</ul>';
    }

    if ($max_num_pages > 1 && $type !== 'load_more') {
        $output .= '<p id="pbd-alp-load-posts" class="row"><a href="javascript:void(0);">More</a><i class="fa fa-spinner fa-pulse more-button-spinner"></i></p>';
    }

    echo $output;
}

function get_projects_with_ajax()
{
    $current_cat_id = $_POST['cat'];
    $difficulty = $_POST['diff'];
    $how_to_sort = $_POST['sort'];
    $duration = $_POST['dur'];
    $type = $_POST['type'];
    $paged = !empty($_POST['paged']) ? $_POST['paged'] : 1;
        
    sorting_posts($current_cat_id, $difficulty, $how_to_sort, $duration, $paged, $type);

    die();
}
add_action('wp_ajax_sorting_posts', 'get_projects_with_ajax');
add_action('wp_ajax_nopriv_sorting_posts', 'get_projects_with_ajax');

function sort_down($a, $b)
{
    if ($a['views'] == $b['views']) {
        return 0;
    }
    return ($a['views'] > $b['views']) ? -1 : 1;
}

add_action('after_setup_theme', 'projects_theme_setup_thumbnail');
function projects_theme_setup_thumbnail()
{
    add_image_size('project-thumb', 370, 240, true); // (cropped)
}
add_action('after_setup_theme', 'events_nav_setup_thumbnail');
function events_nav_setup_thumbnail()
{
    add_image_size('events-nav-thumb', 102, 102, true); // (cropped)
}
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'Events',
        array(
            'labels' => array(
                'name' => 'Events',
                'singular_name' => 'Events',
                'add_new' => 'Add new',
                'add_new_item' => 'Add new item',
                'edit_item' => 'Edit',
                'new_item' => 'New item',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Sorry, not found',
                'not_found_in_trash' => 'Not found in trash',
            ),
            'description' => 'Events post type',
            'public' => True,
            'publicly_queryable' => null,
            'exclude_from_search' => null,
            'show_ui' => null,
            'show_in_menu' => null,
            'menu_position' => null,
            'menu_icon' => null,
            'hierarchical' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies' => array(),
            'has_archive' => false,
            'query_var' => true,
            'capability_type' => 'page',
            'show_in_nav_menus' => null,

        )
    );
}
function blog_output() {
    require_once 'version-2/includes/blog_output.php';
    $puling_result = story_pulling();
    echo $puling_result;
}