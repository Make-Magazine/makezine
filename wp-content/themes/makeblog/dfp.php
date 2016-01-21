<?php
/**
 * DFP Ad Block
 *
 * Initializes all of the ads for Maker Faire.
 *
 */

// Define global make obj.
$make = new stdClass();

// Standard Make Ads.
class MakeAds {

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
    
    public function setAds() {

        // General Leaderboard.
        $this->ad_leaderboard = $this->makeAdsRender(array(
            'size' => '[[728,90],[940,250],[970,90],[970,250],[320,50]]',
            'sizeMap' => '[[[1000,0],[[728,90],[940,250],[970,90],[970,250]]],[[730,0],[[728,90]]],[[0,0],[[320,50]]]]',
            'pos' => 'atf',
        ));

        // General Leaderboard BTF.
        $this->ad_leaderboard_btf = $this->makeAdsRender(array(
            'size' => '[[728,90],[940,250],[970,90],[970,250],[320,50]]',
            'sizeMap' => '[[[1000,0],[[728,90],[940,250],[970,90],[970,250]]],[[730,0],[[728,90]]],[[0,0],[[320,50]]]]',
            'pos' => 'btf',
        ));

        // Alternate Leaderboard.
        $this->ad_leaderboard_alt = $this->makeAdsRender(array(
            'size' => '[[728,90],[970,90],[320,50]]',
            'sizeMap' => '[[[1000,0],[[728,90],[970,90]]],[[730,0],[[728,90]]],[[0,0],[[320,50]]]]',
            'pos' => 'atf',
        ));

        // Alternate Leaderboard BTF.
        $this->ad_leaderboard_alt_btf = $this->makeAdsRender(array(
            'size' => '[[728,90],[970,90],[320,50]]',
            'sizeMap' => '[[[1000,0],[[728,90],[970,90]]],[[730,0],[[728,90]]],[[0,0],[[320,50]]]]',
            'pos' => 'btf',
        ));

        // 728x90.
        $this->ad_728x90 = $this->makeAdsRender(array(
            'size' => '[[728,90],[320,50]]',
            'sizeMap' => '[[[730,0],[[728,90]]],[[0,0],[[320,50]]]]',
            'pos' => 'btf',
        ));

        // 300x250.
        $this->ad_300x250 = $this->makeAdsRender(array(
            'size' => '[[300,250]]',
            'pos' => 'btf',
        ));

        // 300x250 ATF.
        $this->ad_300x250_atf = $this->makeAdsRender(array(
            'size' => '[[300,250]]',
            'pos' => 'atf',
        ));

        // 300x250 house.
        $this->ad_300x250_house = $this->makeAdsRender(array(
            'size' => '[[300,250]]',
            'pos' => 'house',
        ));

        // 300x250 shed.
        $this->ad_300x250_shed = $this->makeAdsRender(array(
            'size' => '[[300,250]]',
            'pos' => 'shed',
        ));

        // 300x250 flexible (300x250 or 300x600).
        $this->ad_300x250_flex = $this->makeAdsRender(array(
            'size' => '[[300,250],[300,600]]',
            'pos' => 'btf',
        ));

        // 300x250 flexible ATF (300x250 or 300x600).
        $this->ad_300x250_flex_atf = $this->makeAdsRender(array(
            'size' => '[[300,250],[300,600]]',
            'pos' => 'atf',
        ));

        // 300x600.
        $this->ad_300x600 = $this->makeAdsRender(array(
            'size' => '[[300,600]]',
            'pos' => 'btf',
        ));

        // 247x96.
        $this->ad_247x96 = $this->makeAdsRender(array(
            'size' => '[[247,96]]',
            'pos' => 'atf',
        ));

        // 940x39.
        $this->ad_940x39 = $this->makeAdsRender(array(
            'size' => '[[940,39],[970,39]]',
            'pos' => 'atf',
        ));

        // 940x39 makefaire.
        $this->ad_940x39_makefaire = $this->makeAdsRender(array(
            'size' => '[[940,39]]',
            'pos' => 'atf',
        ));

        // 2160x547.
        $this->ad_2160x547 = $this->makeAdsRender(array(
            'size' => '[[2160,547]]',
            'pos' => 'atf',
        ));

        // 125x125.
        $this->ad_125x125 = $this->makeAdsRender(array(
            'size' => '[[125,125]]',
            'pos' => 'btf',
        ));

        // 1x1.
        $this->ad_1x1 = $this->makeAdsRender(array(
            'size' => '[[1,1]]',
            'pos' => 'atf',
        ));
    }
    
    // A function used to render the <script> tags for ads.
    protected function makeAdsRender(array $ad = array()) {

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

}

// Set Make Ad variables.
class MakeAdVars {

    /*
     * Gather ad variables.
     *
     * Note: must run within a WP loop.
     */
    public function getVars() {
        // Get current page info.
        $current_page = (is_object($wp_query) && is_array($wp_query) && ($wp_query['pagename'] != '') && ($wp_query['pagename'] != 'wp-cron.php' )) ? $wp_query : NULL;
        $parent = (!empty($_REQUEST['parent']) ? $_REQUEST['parent'] : NULL);
        $id = get_the_ID();
        $posttags = is_single() || is_admin() ? get_the_tags() : NULL;
        $postcat = is_single() || is_admin() ? get_the_category() : (is_category() ? explode(",", get_category_parents(get_query_var('cat'), FALSE, ",")) : NULL);
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $root_url = $protocol . $_SERVER['HTTP_HOST'];
        // Grabs URI for unique tag.
        $this->page = is_admin() ? substr(str_replace($root_url, "", get_permalink()), 0, 40) : substr($_SERVER['REQUEST_URI'], 0, 40);

        // Post info.
        if ($current_page !== NULL) {
            $q_posts = get_posts(array('pagename' => $wp_query['pagename'], 'post_type' =>'any', 'post_status' => 'any'));
            $q_post_id = $q_posts[0]->ID;
            $post_adslot_targeting_name = get_post_meta($q_post_id, '_adslot_targeting_name', TRUE);
            $post_adslot_targeting_ids = get_post_meta($q_post_id, '_adslot_targeting_ids', TRUE);
        } 

        // Custom Targeting Key/Value pairings.
        $this->custom_target_name = !empty($post_adslot_targeting_name) ? $post_adslot_targeting_name : NULL;
        $this->custom_target_value = !empty($post_adslot_targeting_name) ? (!empty($post_adslot_targeting_ids) ? $post_adslot_targeting_ids : (string) $post->ID) : NULL;

        // Post Taxonomy.
        if ($posttags) {
            $this->tags = array();
            foreach($posttags as $tag) {
                $this->tags[] = str_replace(" ", "-", strtolower($tag->name)); 
            }
        }

        // Categories.
        if ($postcat) {
            $this->cat = array();
            foreach($postcat as $cat) {
                if ($cat != "") {
                    $this->cat[] = str_replace(" ", "-", strtolower((is_object($cat) ? $cat->name : $cat)));
                }
            }
        }

        // Ad zone logic. (using switch block to contrast if block below).
        switch (TRUE) {
            case isset($parent):
                $this->zone = '/11548178/Makezine/Blog/' . esc_js($parent);
                break;

            case is_page(array('home-page-include', 'home-page', 'home', 'Humanity: At the Core of Robotics excitement', 116357)):
                $this->zone = '/11548178/Makezine/Homepage';
                break;

            case is_category():
                $this->zone = '/11548178/Makezine/Blog' . esc_js(make_get_category_name());
                break;

            case 'craft' == get_post_type():
                $this->zone = '/11548178/Makezine/Craft/Blog' . esc_js(make_get_category_name());
                break;

            case 'slideshow' == get_post_type():
                $this->zone = '/11548178/Makezine/Blog/Slideshow';
                break;

            case 'volume' == get_post_type():
                $this->zone = '/11548178/Makezine/Blog/Magazine';
                break;

            case is_page(array('kids')):
                $this->zone = '/11548178/Makezine/Blog/Kids';
                break;

            case is_page(array('craftzine', 235220 )):
                $this->zone = '/11548178/Makezine/Craft/Homepage';
                break;

            case is_home() || is_archive():
                $this->zone = '/11548178/Makezine/Blog' . esc_js(make_get_category_name_strip_slash());
                break;

            case is_page(array('craftzine', 'craft-home')):
                $this->zone = '/11548178/Makezine/Craft/Homepage' . esc_js(make_get_category_name_strip_slash());
                break;

            default:
                $this->zone = '/11548178/Makezine/Blog' . esc_js(make_get_category_name());
                break;
        }

        // Ad sponsor logic.
        if (has_tag('project-remake')) {
            $this->sponsor = 'schick';
        }
        elseif (has_tag('mcm')) {
            $this->sponsor = 'mcm';
        }
        elseif ( ( has_tag( array( 'greatcreate', 'Weekend Projects' ) ) || is_page( array( 286853, 271492, 313151, 341320 ) ) ) && !is_category( 'electronics' )  ) {
            $this->sponsor = 'radioshack';
        }
        elseif (has_tag('esurance') || is_page( array(313086, 316119, 316937) ) ) {
            $this->sponsor = 'esurance';
        }
        elseif (has_tag('tinkernation')) {
            $this->sponsor = 'tinkernation';
        }
        elseif (has_tag('bosch')) {
            $this->sponsor = 'bosch';
        }
        elseif (is_single(array(109345,109347))) {
            $this->sponsor = 'moneyball';
        }
        elseif (is_single(array(78509,120079,121013,121988,123191))) {
            $this->sponsor = 'volt';
        }
        elseif (is_single(array(121818))) {
            $this->sponsor = 'microchip';
        }
        elseif (is_single(array(333675))) {
            $this->sponsor = 'energizer';
        }
        elseif (is_single(array(122575))) {
            $this->sponsor = 'xobject';
        }
        elseif (is_page( array( 289746,271575 ) ) ) {
            $this->sponsor = 'mcm';
        }
        elseif ( has_category( '3d-printing-workshop' ) ) {
            $this->sponsor = 'sketchup';
        }
        elseif ( ! is_archive() && ( has_tag( 'nikon' ) || is_page( array( 388070 ) ) ) ) {
            $this->sponsor = 'nikon';
        }
        elseif (is_single(array(424504))) {
            $this->sponsor = 'element';
        }
        elseif (has_tag('lincolnelectric2014') || is_page( array(452017) ) ) {
            $this->sponsor = 'lincolnelectric2014';
        }
        elseif (has_tag('dremel2014')) {
            $this->sponsor = 'dremel2014';
        }
        elseif (has_tag('makerpro') || is_page( array(302792) ) ) {
            $this->sponsor = 'makerpro';
        }
        elseif (has_tag('arrowcypress') || is_page( array(461313,463824,462353,463460,463441) ) ) {
            $this->sponsor = 'arrowcypress';
        }
        elseif (has_tag('cornell') || is_page( array(466354,466367,466360,466358,466356) ) ) {
            $this->sponsor = 'cornell';
        }
        elseif (has_tag('halloween')) {
            $this->sponsor = 'halloween';
        }
        else {
            $this->sponsor = NULL;   
        }

    }

} 
