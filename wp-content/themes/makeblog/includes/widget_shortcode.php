<?php 
//outpoot Lastest Project, Lastest Reviews, Skill Builders, or posts by tag
// Example [feeds_posts type='Post' tag_slug='science' ]
function related_posts( $atts ) {
    $atts = shortcode_atts(array(
        'type' => 'project',
        'tag_slug'  => 'default'
    ), $atts, 'posts_test');
    
    blog_feeds_output($atts['type'],$atts['tag_slug']);
}
add_shortcode( 'feeds_posts', 'related_posts' );

//different adds shortcods
function content_ads_shortcode($atts) {
	if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) {
		global $make;
		return $make->ads->ad_300x250;
	}
}
add_shortcode('content_ads', 'content_ads_shortcode');

function top_ads_shortcode($atts) {
	if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) {
		global $make;
		print '<div class="sidebar-ad"><p id="ads-title">ADVERTISEMENT</p> <div class=\'js-ad scroll-load\' data-size=\'[[300,250]]\' data-viewport=\'"large"\' data-pos=\'"btf"\'></div> </div>';
	}
}
add_shortcode('top_ads', 'top_ads_shortcode');

function middle_ads_shortcode($atts) {
	if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) {
		global $make;
		print '<div class="ad-refresh"><p id="ads-title">ADVERTISEMENT</p> <div class=\'js-ad scroll-load\' data-size=\'[[300,600]]\' data-viewport=\'"large"\' data-pos=\'"btf"\'></div> </div>';
	}
}
add_shortcode('middle_ads', 'middle_ads_shortcode');

function second_rectangle_shortcode($atts) {
	if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) {
    	global $make;print $make->ads->ad_300x250_flex_atf;
	}
}
add_shortcode('middle_ads_tag', 'second_rectangle_shortcode');

function tag_ads_shortcode($atts) {
	if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) {
		global $make;
		print $make->ads->ad_300x250;
	}
}
add_shortcode('tag_ads', 'tag_ads_shortcode');