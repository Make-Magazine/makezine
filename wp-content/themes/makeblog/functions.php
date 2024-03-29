<?php
// FOR NOW, TURN OFF GUTENBURG
// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// Easy Custom Fields Plugin
require_once(WP_PLUGIN_DIR . '/easy-custom-fields/easy-custom-fields.php');
/*
Table of Contents
-----------------
1.  Error Reporting
2.  WordPress.com VIP Stuff
3.  Page Numbering
4.  Comments Function
5.  Short Codes
6.  Theme Stuff
7.  Custom Taxonomies
8.  Page 2 - Custom Post Type
9.  YouTube Embed Function
10. Contribute Function
11. Scheduled Posts
12. From the Maker Shed
13. Search Engine
14. Search Terms Custom Post Type

Version 2 Includes
15. Version
*/

// 1. Error Reporting

if (defined('WP_CLI') && WP_CLI)
include_once dirname(__FILE__) . '/includes/class-make-cli.php';

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

// 28. Markdown
include_once dirname(__FILE__) . '/includes/markdown/markdown.php';

// 29. Categories
include_once dirname(__FILE__) . '/includes/categories.php';

// 30. JSON Endpoint
include_once dirname(__FILE__) . '/includes/json-endpoint.php';

// 31. Projects Step Manager
include_once dirname(__FILE__) . '/includes/projects-manager.php';

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

// 40. Social Stats
include_once dirname(__FILE__) . '/includes/stats/stats.php';

// 41. Blog Dashboard
include_once dirname(__FILE__) . '/includes/blog-dashboard/blog-dashboard.php';

// 42. Search Facets
//include_once dirname(__FILE__) . '/includes/search/search.php';

// 44. Custom Customizer Settings - Theme Customizer API
include_once dirname(__FILE__) . '/includes/theme-customizer/customizer.php';

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

// 49. Topic CPT
include_once dirname(__FILE__) . '/includes/topic-cpt.php';

// Version-2 Includes
include_once dirname(__FILE__) . '/version-2/includes/makezine_rewrite_rules.php';

// Version-2 Includes
include_once dirname(__FILE__) . '/version-2/includes/home-menu-curator.php';

// Universal Nav Includes

require_once('lib/wp_bootstrap_navwalker.php');

// DFP functions.
include_once dirname(__FILE__) . '/dfp.php';

// Include all function files in the makeblog/functions directory:
foreach ( glob(dirname(__FILE__) . '/functions/*.php' ) as $file) {
  include_once $file;
}

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
    if (class_exists('Jetpack') && Jetpack::is_module_active('photon')) {
        $width = (int)$width;
        $height = (int)$height;

// Photon doesn't support redirects, so help it out by doing http://foobar.wordpress.com/files/ to http://foobar.files.wordpress.com/
        if (function_exists('new_file_urls'))
            $url = new_file_urls($url);

        $thumburl = jetpack_photon_url($url, array(
            'resize' => array($width, $height),
            'quality' => get_photon_img_quality(),
            'strip' => 'all',
        ));

        return ($escape) ? esc_url($thumburl) : $thumburl;
    } else{
      return $url;
    }
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

function load_scripts() {
    
  $my_theme = wp_get_theme();
  $my_version = $my_theme->get('Version');
  if (strpos($_SERVER['REQUEST_URI'], "authenticated") !== false){
    wp_enqueue_script('billboard', get_stylesheet_directory_uri() . '/js/billboard.js', array('jquery'), $my_version);
  }

   if(is_page_template( 'page-gift-guide-general.php' ) ) {
      wp_enqueue_script('vue-app', get_stylesheet_directory_uri() . '/Vue/gift-guide/dist/main.min.js', array(), $my_version);
   }

}

add_action('wp_enqueue_scripts', 'load_scripts');

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
    $output .= '<ul class="col-xs-12">';
    $output .= '<li class="difficulty">';
    $output .= '<p>difficulty</p>';
    $output .= '<ul class="diff-item">';
    $output .= '<li><span class="all-lvl fa fa-wrench clicks" data-value="diff1" data-original-title="Easy for Everyone"></span></li>';
    $output .= '<li><span class="moderate fa fa-wrench clicks" data-value="diff2" data-toggle="tooltip" data-placement="top" data-original-title="Intermediate"></span></li>';
    $output .= '<li><span class="spec-skill fa fa-wrench clicks" data-value="diff3" data-toggle="tooltip" data-placement="top" data-original-title="Advanced (But we`ll help you learn the required skills.)"></span></li>';
    $output .= '</ul>';
    $output .= '</li>';
    $output .= '<li class="duration">';
    $output .= '<p>duration</p>';
    $output .= '<ul class="duration-item">';
    $output .= '<li><span class="1-3h fa fa-clock-o clicks" data-value="dur1" data-toggle="tooltip" data-placement="top" data-original-title="Avg. build time 1-3 hours"></span></li>';
    $output .= '<li><span class="3-8h fa fa-clock-o clicks" data-value="dur2" data-toggle="tooltip" data-placement="top" data-original-title="Avg. build time 3-8 hours"></span></li>';
    $output .= '<li><span class="8-16h fa fa-clock-o clicks" data-value="dur3" data-toggle="tooltip" data-placement="top" data-original-title="Avg. build time 8-16 hours (a weekend)"></span></li>';
    $output .= '<li><span class="16h fa fa-clock-o clicks" data-value="dur4" data-toggle="tooltip" data-placement="top" data-original-title="Avg. build time >16 hours"></span></li>';
    $output .= '</ul>';
    $output .= '</li>';
    $output .= '</ul>';
    $output .= '<p class="clear clicks">Clear all</p>';
    $output .= '</div>';
    $output .= '</div>';
    echo $output;
    return $output;
}

add_action('after_setup_theme', 'projects_theme_setup_thumbnail');
function projects_theme_setup_thumbnail()
{
    add_image_size('project-thumb', 370, 240, true); // (cropped)
}

/**
 * Adds the Youtube inside Fancybox modal
 * To use: [youtube-modal "wnnWrLt_RCo"]
 * Place YT id in shortcade
 */
add_shortcode('youtube-modal', 'youtube_shortcode_modal');

function youtube_shortcode_modal($atts){

    if(!isset($atts[0])) return;
    $id = strip_tags($atts[0]);
    ob_start();
    ?>

    <div class="post col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="sprout-video">
            <a class="fancytube fancybox.iframe" href="https://www.youtube.com/embed/<?php echo $id; ?>?autoplay=1">
                <img class="img-responsive" src="https://img.youtube.com/vi/<?php echo $id; ?>/mqdefault.jpg" alt="MakerCon Conference Videos" height="180" width="100%" />
                <img class="yt-play-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-btn.png" alt="Youtube overlay play button" />
            </a>
        </div>
    </div>

    <?php
    return ob_get_clean();
}



/**
 * Checks the URL for which thank you modal to how.
 * URL with ?thankyou=true&subscribed-to=make-newsletter will show the normal thank you modal
 * URL with ?thankyou=true&subscribed-to=free-pdf will show the any free PDF modal
 * URL with ?success=true&subscribe-preferences will show the WhatCounts Subscription preferences success modal
 * URL with ?thank-you-project-submission will show the basic thank you modal after contribute submission
 */
function display_thank_you_modal_if_signed_up() { ?>
    <div class="fancybox-thx" style="display:none;">
        <div class="nl-modal-extra-cont nl-thx-p1">
            <div class="nl-modal-div1">
                <div class="col-sm-8 col-xs-12">
                    <h4>Welcome to the Make: Community!</h4>
                    <p><span class="nl-modal-email-address"></span> you are now signed up to the Make: newsletter.</p>
                </div>
                <div class="col-sm-4 hidden-xs text-center">
                    <i class="fa fa-check-square-o fa-5x"></i>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="nl-modal-div2">
                <div class="col-xs-12">
                    <h4>You might also like these newsletters:</h4>
                    <form class="whatcounts-signup2" action="https://secure.whatcounts.com/bin/listctrl" method="POST">
                        <input type="hidden" name="cmd" value="subscribe" />
                        <input type=hidden name="multiadd" value="1" />
                        <input type="hidden" id="email" name="email" value="" />
                        <input type="hidden" id="format_mime" name="format" value="mime" />
                        <label class="list-radio pull-right">
                          <input type="checkbox" id="list_6B5869DC547D3D467B33E192ADD9BE4B_yes" name="slid_1" value="6B5869DC547D3D467B33E192ADD9BE4B" />
                          <span for="list_6B5869DC547D3D467B33E192ADD9BE4B_yes" class="newcheckbox"></span>
                        </label>
                        <h4>Maker Pro</h4><p>The latest news about startups, products, incubators, and innovators</p>
                        <hr />

                        <label class="list-radio pull-right">
                          <input type="checkbox" id="list_6B5869DC547D3D46E66DEF1987C64E7A_yes" name="slid_2" value="6B5869DC547D3D46E66DEF1987C64E7A" />
                          <span for="list_6B5869DC547D3D46E66DEF1987C64E7A_yes" class="newcheckbox"></span>
                        </label>
                        <h4>Maker Faire</h4><p>Keep up with the Greatest Show(and tell) on Earth</p>
                        <hr />

                        <label class="list-radio pull-right">
                          <input type="checkbox" id="list_6B5869DC547D3D4637EA6E33C6C8170D_yes" name="slid_3" value="6B5869DC547D3D4637EA6E33C6C8170D" />
                          <span for="list_6B5869DC547D3D4637EA6E33C6C8170D_yes" class="newcheckbox"></span>
                        </label>
                        <h4>Make: Education</h4><p>How making is transforming learning</p>
                        <hr />

                      <input class="ghost-button-black pull-right" type="submit" value="Submit" />
                      <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="nl-modal-cont nl-thx-p2" style="display:none;">
            <div class="col-sm-4 hidden-xs nl-modal">
                <span class="fa-stack fa-4x">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
                </span>
            </div>
            <div class="col-sm-8 col-xs-12 nl-modal">
                <h3>Awesome!</h3>
                <p>Thanks for signing up. Please check your email to confirm.</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="fancybox-thx-free-pdf" style="display:none;">
        <div class="nl-modal-cont">
            <div class="col-sm-3 hidden-xs nl-modal" style="padding-top:20px;">
                <span class="fa-stack fa-4x">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
                </span>
            </div>
            <div class="col-sm-9 col-xs-12 nl-modal">
                <h3 class="text-center">Awesome!</h3>
                <p class="text-center">Your FREE PDF is on its way. Please check your email. You will also be receiving the weekly Make: Newsletter to keep you inspired with new projects and more product reviews.</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="fancybox-sub-pref" style="display:none;">
        <div class="nl-modal-cont">
            <div class="col-sm-4 hidden-xs nl-modal">
                <span class="fa-stack fa-4x">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
                </span>
            </div>
            <div class="col-sm-8 col-xs-12 nl-modal">
                <h3>We've got it.</h3>
                <p>Your changes have been saved. Keep Making!</p>
                <div class="social-network-container">
                    <ul class="social-network social-circle">
                        <li><a href="//www.facebook.com/makemagazine" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="//twitter.com/make" class="icoTwitter" title="Twitter" target="_blank"><i class="fa fa-twitter" target="_blank"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="fancybox-contribute-submission" style="display:none;">
        <div class="nl-modal-cont">
            <div class="col-sm-4 hidden-xs nl-modal">
                <span class="fa-stack fa-4x">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
                </span>
            </div>
            <div class="col-sm-8 col-xs-12 nl-modal">
                <h3>Thank you!</h3>
                <p>Thanks for your submission. Our editors will review your materials and follow up with you via email as soon as possible. In the meantime, keep making stuff!</p>
                <div class="social-network-container">
                    <ul class="social-network social-circle">
                        <li><a href="//www.facebook.com/makemagazine" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="//twitter.com/make" class="icoTwitter" title="Twitter" target="_blank"><i class="fa fa-twitter" target="_blank"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="nl-modal-error" style="display:none;">
        <div class="col-xs-12 nl-modal padtop">
            <p class="lead">The reCAPTCHA box was not checked. Please try again.</p>
        </div>
        <div class="clearfix"></div>
    </div>
<?php }


function register_widget_zone() {
    register_sidebar(
        array(
            'id'=>'sidebar_blog_page',
            'name'=>__('Blog Sidebar'),
            'description'=>__('This widget area is only on the Blog page.' ),
            'before_widget'=>'<div class="widget-zone">',
            'after_widget'=>'</div>',
            'before_title'=>'<h3 class="widget-title">',
            'after_title'=>'</h3>'
        )
    );
    register_sidebar(
        array(
            'id'=>'sidebar_blogpost_page',
            'name'=>__('Single Post Sidebar'),
            'description'=>__('This widget area is only on the single post.' ),
            'before_widget'=>'<div class="widget">',
            'after_widget'=>'</div>',
            'before_title'=>'<h3 class="widget-title">',
            'after_title'=>'</h3>'
        )
    );
    register_sidebar(
        array(
            'id'=>'sidebar_tags_page',
            'name'=>__('Tags Sidebar'),
            'description'=>__('This widget area is only on the tags list page.' ),
            'before_widget'=>'<div class="widget">',
            'after_widget'=>'</div>',
            'before_title'=>'<h3 class="widget-title">',
            'after_title'=>'</h3>'
        )
    );
    register_sidebar(
        array(
            'id'=>'sidebar_comparison_boards',
            'name'=>__('Boards Comparison Sidebar'),
            'description'=>__('This widget area on all Boards Comparison pages.' ),
            'before_widget'=>'<div class="widget-zone">',
            'after_widget'=>'</div>',
            'before_title'=>'<h3 class="widget-title">',
            'after_title'=>'</h3>'
        )
    );
    register_sidebar(
        array(
            'id'=>'sidebar_comparison_3dprinter',
            'name'=>__('3D Printer Comparison Sidebar'),
            'description'=>__('This widget area on all 3D Printer Comparison pages.' ),
            'before_widget'=>'<div class="widget-zone">',
            'after_widget'=>'</div>',
            'before_title'=>'<h3 class="widget-title">',
            'after_title'=>'</h3>'
        )
    );
    register_sidebar(
        array(
            'id'=>'sidebar_comparison_drones',
            'name'=>__('Drones Comparison Sidebar'),
            'description'=>__('This widget area on all Drones Comparison pages.' ),
            'before_widget'=>'<div class="widget-zone">',
            'after_widget'=>'</div>',
            'before_title'=>'<h3 class="widget-title">',
            'after_title'=>'</h3>'
        )
    );
}
add_action('widgets_init', 'register_widget_zone');
function kc_widget_form_extend( $instance, $widget ) {
    if ( !isset($instance['classes']) )
        $instance['classes'] = null;

    $row .= "Class:\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' class='widefat' value='{$instance['classes']}'/>\n";
    $row .= "</p>\n";

    echo $row;
    return $instance;
}
add_filter('widget_form_callback', 'kc_widget_form_extend', 10, 2);function kc_widget_update( $instance, $new_instance ) {
    $instance['classes'] = $new_instance['classes'];
    return $instance;
}
add_filter( 'widget_update_callback', 'kc_widget_update', 10, 2 );
function kc_dynamic_sidebar_params( $params ) {
    global $wp_registered_widgets;
    $widget_id    = $params[0]['widget_id'];
    $widget_obj    = $wp_registered_widgets[$widget_id];
    $widget_opt    = get_option($widget_obj['callback'][0]->option_name);
    $widget_num    = $widget_obj['params'][0]['number'];

    if ( isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']) )
        $params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
    return $params;
}
add_filter( 'dynamic_sidebar_params', 'kc_dynamic_sidebar_params' );

require_once('includes/widget_shortcode.php');
require_once('version-2/includes/blog_feed.php');
require_once('version-2/includes/tags_output.php');
require_once('version-2/includes/blog_output.php');

function catch_first_image_tags() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = (isset($matches[1][0])?$matches[1][0]:'');

    if(empty($first_img)) {
        $first_img = get_template_directory_uri().'/version-2/img/thumbtag.jpg';
    }
    return $first_img;
}
function catch_first_image_nav() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    if(empty($first_img)) {
        $first_img = get_template_directory_uri().'/version-2/img/thumbhead.jpg';
    }
    return $first_img;
}
function catch_first_image_story() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    if(empty($first_img)) {
        $first_img = get_template_directory_uri().'/version-2/img/thumbstory.jpg';
    }
    return $first_img;
}
function catch_first_image_story_nav() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    if(empty($first_img)) {
        $first_img = get_template_directory_uri().'/version-2/img/thumbnav.jpg';
    }
    return $first_img;
}

function the_titlesmall($before = '', $after = '', $echo = true, $length = false) {
    $title = get_the_title();

    if ( $length && is_numeric($length) ) {
        $title = substr( $title, 0, $length );
    }

    if ( strlen($title)> 0 ) {
        $title = apply_filters('the_titlesmall', $before . $title . $after, $before, $after);
        if ( $echo )
            echo $title;
        else
            return $title;
    }
}

// Global photon image quality.
function get_photon_img_quality() {
    $quality = '70';
    return $quality;
}


//Removing for ge light
if (is_page_template('page-ge-light-life.php'))
{
  remove_filter('the_content', 'wpautop');
  remove_filter('the_excerpt', 'wpautop' );
}

// Add taxonomy to pages.
function add_taxonomies_to_pages() {
  register_taxonomy_for_object_type( 'post_tag', 'page' );
  register_taxonomy_for_object_type( 'category', 'page' );
  register_taxonomy_for_object_type( 'product-categories', 'reviews' ); // On each review page, we'll use the product category to determine what filters to show
}
add_action( 'init', 'add_taxonomies_to_pages' );


//Custom text for the Jetpack infinite scroll "Older Posts" button
function filter_jetpack_infinite_scroll_js_settings( $settings ) {
    $settings['text'] = __( 'More Posts', 'l18n' );
    return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'filter_jetpack_infinite_scroll_js_settings' );

//Removing the page post type from the search sesults
function remove_post_type_page_from_search() {
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
    $wp_post_types['page_2']->exclude_from_search = true;
}
add_action('init', 'remove_post_type_page_from_search');


//Advanced Custom Fields Custom Setting WordPress Menu
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Custom Settings',
        'menu_title'    => 'Custom Settings',
        'menu_slug'     => 'custom-settings',
        'position'      => 50,
        'capability'    => 'edit_posts',
        'redirect'      => true
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Home Page Custom Settings',
        'menu_title'    => 'Home Page',
        'menu_slug'     => 'home-page',
        'parent_slug'   => 'custom-settings',
        'position'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Navigation',
        'menu_title'    => 'Navigation',
        'menu_slug'     => 'nav-events',
        'parent_slug'   => 'custom-settings',
        'position'      => false
    ));

}

//remove the tag meta box for non administrator roles
add_action('admin_init','customize_meta_boxes');
/**
 * Remove capabilities from editors.
 *
 * Call the function when your plugin/theme is activated.
 */

function customize_meta_boxes() {
  global $current_user;
  wp_get_current_user();
  $user = wp_get_current_user();

  if ( !in_array( 'administrator', (array) $user->roles ) ) {
    remove_meta_box('tagsdiv-post_tag','post','normal');
    remove_meta_box('tagsdiv-post_tag','page','normal');
  }

}


//override the gettags ajax function
add_action( 'wp_ajax_get-tagcloud', 'ajax_tag_cloud_wpse_99497', 1 );

function ajax_tag_cloud_wpse_99497() {
if ( ! isset( $_POST['tax'] ) ) {
    wp_die( 0 );
 }

 $taxonomy = sanitize_key( $_POST['tax'] );
 $tax = get_taxonomy( $taxonomy );
 if ( ! $tax ) {
    wp_die( 0 );
 }

 if ( ! current_user_can( $tax->cap->assign_terms ) ) {
    wp_die( -1 );
 }

 $term_params = array( 'number' => 45, 'orderby' => 'count', 'order' => 'DESC' );
 switch ($taxonomy) {
  case 'product_tag':
    $term_params['hide_empty'] = false;
   break;
 }
 $tags = get_terms( $taxonomy, $term_params );


 if ( empty( $tags ) )
    wp_die( $tax->labels->not_found );

 if ( is_wp_error( $tags ) )
    wp_die( $tags->get_error_message() );

 foreach ( $tags as $key => $tag ) {
    $tags[ $key ]->link = '#';
    $tags[ $key ]->id = $tag->term_id;
 }

 // We need raw tag names here, so don't filter the output
 $return = wp_generate_tag_cloud( $tags, array('format' => 'list', 'largest'=>8) );

 if ( empty($return) )
    wp_die( 0 );

 echo $return;

 wp_die();
}


//
// Change the get_theme_mod function to https
//
function get_theme_mod_img($mod_name){
    return str_replace(array('http:', 'https:'), '', get_theme_mod($mod_name));
}

//
// Using wp_get_attachment_url filter, we can fix the dreaded mixed content browser warning
//
add_filter( 'wp_get_attachment_url', 'set_url_scheme' );


// Making error logs for ajax to call
add_action( 'wp_ajax_make_error_log', 'make_error_log' );
add_action( 'wp_ajax_nopriv_make_error_log', 'make_error_log' );

/** Write to PHP error log */
function make_error_log(){
  $error = filter_input(INPUT_POST, 'make_error', FILTER_SANITIZE_STRING);
  error_log(print_r($error, TRUE));
}

 add_shortcode('contextly_sidebar', function($attrs) {
	  //We disabled contextly but need to return blanks for old shortcodes that are hard coded in the post
	  return '';
 } );

// Turn off commenting for the projects post type
function comments_off( $open, $post_id ) {
    $post_type = get_post_type( $post_id );
    // allow comments for built-in "post" post type
    if ( $post_type == 'projects' ) {
        return false;
    }
}
add_filter( 'comments_open', 'comments_off', 10 , 2 );

function get_excerpt($limit, $source = null){
    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'&hellip;';
    return $excerpt;
}