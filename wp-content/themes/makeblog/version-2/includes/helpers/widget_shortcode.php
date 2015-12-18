<?php 
//outpoot Lastest Project, Lastest Reviews and Skill Builders
function related_posts( $atts ) {
    $atts = shortcode_atts(array(
        'type' => 'project'
    ), $atts, 'posts_test');
    
    blog_feeds_output($atts['type']);
}
add_shortcode( 'feeds_posts', 'related_posts' );

//different adds shortcods
function content_ads_shortcode($atts) {
    global $make;
    return $make->ads->ad_300x250;
}
add_shortcode('content_ads', 'content_ads_shortcode');

function top_ads_shortcode($atts) {
    global $make;
    print $make->ads->ad_300x250;
}
add_shortcode('top_ads', 'top_ads_shortcode');

function middle_ads_shortcode($atts) {
    global $make;
    print '<div class="ad-refresh">' . $make->ads->ad_300x600 . '</div>';
}
add_shortcode('middle_ads', 'middle_ads_shortcode');

function second_rectangle_shortcode($atts) {
    global $make;print $make->ads->ad_300x250_flex_atf;
}
add_shortcode('middle_ads_tag', 'second_rectangle_shortcode');

function tag_ads_shortcode($atts) {
    global $make;
    print $make->ads->ad_300x250;
}
add_shortcode('tag_ads', 'tag_ads_shortcode');