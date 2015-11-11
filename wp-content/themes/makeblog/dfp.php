<?php
/**
 * DFP Ad Block
 *
 * Initializes all of the ads for Maker Faire.
 *
 */

global $make;
global $wp_query;
global $post;

/*
 * Set standard ad sizes.
 */

$make->ads = new stdClass();

// A function used to render the <script> tags for ads.
function make_ads_render(array $ad = array()) {

  // Default vars.
  $ad += array(
    'size' => '[300,250]',
    'sizeMap' => NULL,
    'viewport' => NULL,
    'pos' => 'btf', 
  );

  // Add JS vars & gpt methods.
  $js_string = "<script>";
  $js_string .= "var ad = make.gpt.getVars(" . $ad['size'] . ");\r\n";
  $js_string .= "document.write('<div id=\"' + ad.slot + '\" class=\"make_ad ' + {$ad['size']}.join().replace(/\[\]/g,'').replace(/,/g,'x') + '\"></div>');\r\n";
  $js_string .= "make.gpt.setAd({";
  $js_string .= "'size' : {$ad['size']}";
  $js_string .= ", 'pos' : '{$ad['pos']}'";
  $js_string .= ", 'adPos' : ad.adPos";
  $js_string .= ", 'slot' : ad.slot";
  $js_string .= ", 'tile' : ad.tile";
  $js_string .= ", 'companion' : (window.ad_vars ? ad_vars.companion : false)";

  if ($ad['sizeMap']) {
    $js_string .= ", 'sizeMap' : {$ad['sizeMap']}";
  }
  if ($ad['viewport']) {
    $js_string .= ", 'viewport' : '{$ad['viewport']}'";
  }

  $js_string .= "});\r\n </script>";

  return $js_string;

}

/*
 * Define ad sizes.
 *
 * Example template usage:
 * <?php global $make; print $make->ads->300x250; ?>
 *
 * Example dynamic usage:
 * <!-- add div placholder to DOM -->
 * <div class="js-ad" data-size='[[300,250]]' data-pos='"btf"'></div>
 * <script>
 * // Call dynamic JS loading function.
 * make.gpt.loadDyn();
 * </script>
 *
 */

// General Leaderboard.
$make->ads->ad_leaderboard = make_ads_render(array(
    'size' => '[[728,90],[940,250],[970,90],[970,250],[320,50]]',
    'sizeMap' => '[[[1000,0],[[728,90],[940,250],[970,90],[970,250]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]',
    'pos' => 'atf',
));

// General Leaderboard BTF.
$make->ads->ad_leaderboard_btf = make_ads_render(array(
    'size' => '[[728,90],[940,250],[970,90],[970,250],[320,50]]',
    'sizeMap' => '[[[1000,0],[[728,90],[940,250],[970,90],[970,250]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]',
    'pos' => 'btf',
));

// Alternate Leaderboard.
$make->ads->ad_leaderboard_alt = make_ads_render(array(
    'size' => '[[728,90],[970,90],[320,50]]',
    'sizeMap' => '[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]',
    'pos' => 'atf',
));

// Alternate Leaderboard BTF.
$make->ads->ad_leaderboard_alt_btf = make_ads_render(array(
    'size' => '[[728,90],[970,90],[320,50]]',
    'sizeMap' => '[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]',
    'pos' => 'btf',
));

// 728x90.
$make->ads->ad_728x90 = make_ads_render(array(
    'size' => '[[728,90],[320,50]]',
    'sizeMap' => '[[[800,0],[[728,90]]],[[0,0],[[320,50]]]]',
    'pos' => 'btf',
));

// 300x250.
$make->ads->ad_300x250 = make_ads_render(array(
    'size' => '[[300,250]]',
    'pos' => 'btf',
));

// 300x250 ATF.
$make->ads->ad_300x250_atf = make_ads_render(array(
    'size' => '[[300,250]]',
    'pos' => 'atf',
));

// 300x250 house.
$make->ads->ad_300x250_house = make_ads_render(array(
    'size' => '[[300,250]]',
    'pos' => 'house',
));

// 300x250 shed.
$make->ads->ad_300x250_shed = make_ads_render(array(
    'size' => '[[300,250]]',
    'pos' => 'shed',
));

// 300x250 flexible (300x250 or 300x600).
$make->ads->ad_300x250_flex = make_ads_render(array(
    'size' => '[[300,250],[300,600]]',
    'pos' => 'btf',
));

// 300x250 flexible ATF (300x250 or 300x600).
$make->ads->ad_300x250_flex_atf = make_ads_render(array(
    'size' => '[[300,250],[300,600]]',
    'pos' => 'atf',
));

// 300x600.
$make->ads->ad_300x600 = make_ads_render(array(
    'size' => '[[300,600]]',
    'pos' => 'btf',
));

// 247x96.
$make->ads->ad_247x96 = make_ads_render(array(
    'size' => '[[247,96]]',
    'pos' => 'atf',
));

// 940x39.
$make->ads->ad_940x39 = make_ads_render(array(
    'size' => '[[940,39],[970,39]]',
    'pos' => 'atf',
));

// 940x39 makefaire.
$make->ads->ad_940x39_makefaire = make_ads_render(array(
    'size' => '[[940,39]]',
    'pos' => 'atf',
));

// 2160x547.
$make->ads->ad_2160x547 = make_ads_render(array(
    'size' => '[[2160,547]]',
    'pos' => 'atf',
));

// 125x125.
$make->ads->ad_125x125 = make_ads_render(array(
    'size' => '[[125,125]]',
    'pos' => 'btf',
));

// 1x1.
$make->ads->ad_1x1 = make_ads_render(array(
    'size' => '[[1,1]]',
    'pos' => 'atf',
));

/*
 * Gather ad variables.
 */

$make->ad_vars = new stdClass();

// Get current page info.
$current_page = (is_object($wp_query) && is_array($wp_query) && ($wp_query['pagename'] != '') && ($wp_query['pagename'] != 'wp-cron.php' )) ? $wp_query : NULL;
$parent = (!empty($_REQUEST['parent']) ? $_REQUEST['parent'] : NULL);
$posttags = is_single() ? get_the_tags() : NULL;
$postcat = is_single() ? get_the_category() : (is_category() ? explode(",", get_category_parents($wp_query->get_queried_object()->term_id, FALSE, ",")) : NULL);

$make->ad_vars->page = $_SERVER['REQUEST_URI'];

// Post info.
if ($current_page !== NULL) {
    $q_posts = get_posts(array('pagename' => $wp_query['pagename'], 'post_type' =>'any', 'post_status' => 'any'));
    $q_post_id = $q_posts[0]->ID;
    $post_adslot_targeting_name = get_post_meta($q_post_id, '_adslot_targeting_name', TRUE);
    $post_adslot_targeting_ids = get_post_meta($q_post_id, '_adslot_targeting_ids', TRUE);
} 

// Custom Targeting Key/Value pairings.
$make->ad_vars->custom_target_name = !empty($post_adslot_targeting_name) ? $post_adslot_targeting_name : NULL;
$make->ad_vars->custom_target_value = !empty($post_adslot_targeting_name) ? (!empty($post_adslot_targeting_ids) ? $post_adslot_targeting_ids : (string) $post->ID) : NULL;

// Post Taxonomy.
if ($posttags) {
    $make->ad_vars->tags = array();
    foreach($posttags as $tag) {
        $make->ad_vars->tags[] = str_replace(" ", "-", strtolower($tag->name)); 
    }
}

// Categories.
if ($postcat) {
    $make->ad_vars->cat = array();
    foreach($postcat as $cat) {
        if ($cat != "") {
            $make->ad_vars->cat[] = str_replace(" ", "-", strtolower((is_object($cat) ? $cat->name : $cat)));
        }
    }
}

// Ad zone logic. (using switch block to contrast if block below).
switch (TRUE) {
    case isset($parent):
        $make->ad_vars->zone = '/11548178/Makezine/Blog/' . esc_js($parent);
        break;

    case is_page(array('home-page-include', 'home-page', 'home', 'Humanity: At the Core of Robotics excitement', 116357)):
        $make->ad_vars->zone = '/11548178/Makezine/Homepage';
        break;

    case is_category():
        $make->ad_vars->zone = '/11548178/Makezine/Blog' . esc_js(make_get_category_name());
        break;

    case 'craft' == get_post_type():
        $make->ad_vars->zone = '/11548178/Makezine/Craft/Blog' . esc_js(make_get_category_name());
        break;

    case 'slideshow' == get_post_type():
        $make->ad_vars->zone = '/11548178/Makezine/Blog/Slideshow';
        break;

    case 'volume' == get_post_type():
        $make->ad_vars->zone = '/11548178/Makezine/Blog/Magazine';
        break;

    case is_page(array('kids')):
        $make->ad_vars->zone = '/11548178/Makezine/Blog/Kids';
        break;

    case is_page(array('craftzine', 235220 )):
        $make->ad_vars->zone = '/11548178/Makezine/Craft/Homepage';
        break;

    case is_home() || is_archive():
        $make->ad_vars->zone = '/11548178/Makezine/Blog' . esc_js(make_get_category_name_strip_slash());
        break;

    case is_page(array('craftzine', 'craft-home')):
        $make->ad_vars->zone = '/11548178/Makezine/Craft/Homepage' . esc_js(make_get_category_name_strip_slash());
        break;

    default:
        $make->ad_vars->zone = '/11548178/Makezine/Blog' . esc_js(make_get_category_name());
        break;
}

// Ad sponsor logic.
if (has_tag('project-remake')) {
    $make->ad_vars->sponsor = 'schick';
}
elseif (has_tag('mcm')) {
    $make->ad_vars->sponsor = 'mcm';
}
elseif ( ( has_tag( array( 'greatcreate', 'Weekend Projects' ) ) || is_page( array( 286853, 271492, 313151, 341320 ) ) ) && !is_category( 'electronics' )  ) {
    $make->ad_vars->sponsor = 'radioshack';
}
elseif (has_tag('esurance') || is_page( array(313086, 316119, 316937) ) ) {
    $make->ad_vars->sponsor = 'esurance';
}
elseif (has_tag('tinkernation')) {
    $make->ad_vars->sponsor = 'tinkernation';
}
elseif (has_tag('bosch')) {
    $make->ad_vars->sponsor = 'bosch';
}
elseif (is_single(array(109345,109347))) {
    $make->ad_vars->sponsor = 'moneyball';
}
elseif (is_single(array(78509,120079,121013,121988,123191))) {
    $make->ad_vars->sponsor = 'volt';
}
elseif (is_single(array(121818))) {
    $make->ad_vars->sponsor = 'microchip';
}
elseif (is_single(array(333675))) {
    $make->ad_vars->sponsor = 'energizer';
}
elseif (is_single(array(122575))) {
    $make->ad_vars->sponsor = 'xobject';
}
elseif (is_page( array( 289746,271575 ) ) ) {
    $make->ad_vars->sponsor = 'mcm';
}
elseif ( has_category( '3d-printing-workshop' ) ) {
    $make->ad_vars->sponsor = 'sketchup';
}
elseif ( ! is_archive() && ( has_tag( 'nikon' ) || is_page( array( 388070 ) ) ) ) {
    $make->ad_vars->sponsor = 'nikon';
}
elseif (is_single(array(424504))) {
    $make->ad_vars->sponsor = 'element';
}
elseif (has_tag('lincolnelectric2014') || is_page( array(452017) ) ) {
    $make->ad_vars->sponsor = 'lincolnelectric2014';
}
elseif (has_tag('dremel2014')) {
    $make->ad_vars->sponsor = 'dremel2014';
}
elseif (has_tag('makerpro') || is_page( array(302792) ) ) {
    $make->ad_vars->sponsor = 'makerpro';
}
elseif (has_tag('arrowcypress') || is_page( array(461313,463824,462353,463460,463441) ) ) {
    $make->ad_vars->sponsor = 'arrowcypress';
}
elseif (has_tag('cornell') || is_page( array(466354,466367,466360,466358,466356) ) ) {
    $make->ad_vars->sponsor = 'cornell';
}
elseif (has_tag('halloween')) {
    $make->ad_vars->sponsor = 'halloween';
}
else {
    $make->ad_vars->sponsor = NULL;   
}

?>

<!-- Page Ad Vars -->
<script type='text/javascript'>
    var ad_vars = <?php print str_replace("&amp;", "&", json_encode($make->ad_vars, JSON_UNESCAPED_SLASHES)); ?>;
</script>

<!-- Make GPT -->
<script type='text/javascript' src="<?php print get_template_directory_uri() . '/js/gpt.js'; ?>"></script>

<!-- 1x1 ad unit -->
<?php print $make->ads->ad_1x1; ?>
