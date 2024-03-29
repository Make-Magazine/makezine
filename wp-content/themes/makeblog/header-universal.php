<?php
/**
 * Makezine Universal Nav Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */

global $make;
global $wp_query;
global $post;

// remove any enqueue we don't want
if (!is_single()) {
  //Remove WebRotator Plugin Styles
  remove_action("wp_enqueue_scripts", "add_action_webrotate_styles");
}



require_once 'version-2/includes/Mobile_Detect.php';
$detect = new Mobile_Detect;
$post_per_page = 15;
$device = 'pc';
if ( $detect->isMobile() ) {
  $post_per_page = 5;
  $device = 'mobile';
}

if( $detect->isTablet() ){
  $post_per_page = 10;
  $device = 'tablet';
} ?>
<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo make_generate_title_tag(); ?></title>
  <meta name="twitter:widgets:csp" content="on">
  <meta name="p:domain_verify" content="c4e1096cb904ca6df87a2bb867715669" >
  <?php // Below site verfication is linked to Maker Media Webmaster tools account ?>
  <meta name="google-site-verification" content="eAyS6vj89QDOsofiDC4sB-2YR3YNg_VGCYiQnWm2mqc" />
  <meta name="norton-safeweb-site-verification" content="4g4w71jm7qt9e7ghe2dxdhiq0mnnkwom6ue80rdet53q3figx8ooxrffbgkkl9kzo3qi85l2j-txt-fh8w-p2z5769ht01z8s6sxq3-8r7cojmimgp00homsjjjv96ww" />
  <meta property="fb:admins" content="1612614584" />

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/manifest.json">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">

  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <!--[endif]-->

  <!-- Pingdom for site monitoring -->
  <script>
    var _prum = [['id', '53fcea2fabe53d341d4ae0eb'],
      ['mark', 'firstbyte', (new Date()).getTime()]];
    (function() {
      var s = document.getElementsByTagName('script')[0]
          , p = document.createElement('script');
      p.async = 'async';
      p.src = '//rum-static.pingdom.net/prum.min.js';
      s.parentNode.insertBefore(p, s);
    })();
  </script>
  <!-- End Pingdom Code -->

  <!-- Begin Chartbeat Code -->
  <script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
  <!-- End Chartbeat Code -->
  <script type="text/javascript">
    var templateUrl = '<?= get_site_url(); ?>';
  </script>

  <?php wp_head(); ?>

  <?php
  // Set Ads.
  $make->ad_vars = new MakeAdVars;
  $make->ad_vars->getVars();
  $make->ads = new MakeAds;
  $make->ads->setAds();
  ?>

  <!-- Page Ad Vars -->
  <script type='text/javascript'>
  var ad_vars = <?php print str_replace("&amp;", "&", json_encode($make->ad_vars, JSON_UNESCAPED_SLASHES)); ?>;
  </script>


  <!-----------------------------------------------------------
      For Some reason this part needed to be commented out before getting my local up and running
  ------------------------------------------------------------>

  <?php
    $make_ads_1x1 = get_theme_mod('make_ads_1x1_enable');
    if (!empty($make_ads_1x1)): ?>
    <!-- 1x1 ad unit -->
    <?php print $make->ads->ad_1x1; ?>
  <?php endif; ?>

  <?php
    $make_ads_scroll = get_theme_mod('make_ads_scroll_enable');
    if (!empty($make_ads_scroll)): ?>
    <!-- scroll loading flag -->
    <script type="text/javascript">var make_ads_scroll_load = true;</script>
  <?php endif; ?>

  <!-- Time-tracking for Custom Dimensions -->
  <time itemprop="startDate" datetime="<?php the_time( 'c' ); ?>" style="display: none;"></time>
	
  <?php
    // Tracking pixels users can turn off through the cookie law checkbox -- defaults to yes
	if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) {
  ?>
	  <!-- Make GPT -->
	  <script type='text/javascript' src="<?php print get_template_directory_uri() . '/js/gpt.js'; ?>"></script>

	  <!-- nativo script -->
	  <script type="text/javascript" src="//s.ntv.io/serve/load.js" async></script>
		<?php if (is_page('content')): ?>
		  <meta http-equiv="X-UA-Compatible" content="IE=10" />
		  <meta name="robots" content="noindex, nofollow" />
		<?php endif; ?>
	  <!-- end nativo script -->
	
	  <!-- Google Tag Manager -->
	  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	  })(window,document,'script','dataLayer','GTM-PC5R77');</script>
	  <!-- End Google Tag Manager -->

	  <!-- Google Universal Analytics -->
	  <!-- Primary Categories Dimension Query -->
	  <?php $primary_cat_query = get_post_meta( get_the_id(), 'ga_primary_category' ); $primary_cat = (isset($primary_cat_query[0])?$primary_cat_query[0]:''); ?>
	  <?php
		$cats = get_the_category();
		$primarycat = array();
		foreach ( $cats as $cat ) {
		  if ( $cat->category_parent < 1 ) {
			$primarycat[] = $cat->category_nicename;
		  }
		  elseif ( $cat->category_parent > 0 ) {
			$parent_cat_id = $cat->category_parent;
			$cat2 = get_cat_name($parent_cat_id);
			$primarycat[] = $cat2;
		  }
		}
		$primary_cat_dimension = (isset($primarycat[0])?$primarycat[0]:'');
	  ?>
	  <?php $youtube_embed_query = get_post_meta( get_the_id(), 'ga_youtube_embed' ); $youtube_embed = (isset($youtube_embed_query[0])?$youtube_embed_query[0]:''); ?>
	  <script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-51157-1', 'auto');
		ga('require', 'GTM-TXW38JQ');
		ga('require', 'displayfeatures');
		ga('send', 'pageview', {
		  'page': location.pathname + location.search + location.hash
		});
		var dimensionValue11 = document.getElementsByTagName("time")[0].getAttribute("datetime");
		ga('set', 'dimension11', dimensionValue11);
		ga('set', 'dimension13', "<?php echo $primary_cat ?>");
		ga('set', 'dimension14', "<?php echo $youtube_embed ?>");
	  </script>

	  <script type="text/javascript">
		dataLayer = [];
	  </script>

	  <?php if ( is_404() ) : // Load this last. ?>
		<script>
		  ga('send', 'event', '404', document.location.href + document.location.search, document.referrer);
		</script>
	  <?php endif; ?>

		<!-- Pinterest Tag -->
		<script>
		!function(e){if(!window.pintrk){window.pintrk = function () {
		window.pintrk.queue.push(Array.prototype.slice.call(arguments))};var
		  n=window.pintrk;n.queue=[],n.version="3.0";var
		  t=document.createElement("script");t.async=!0,t.src=e;var
		  r=document.getElementsByTagName("script")[0];
		  r.parentNode.insertBefore(t,r)}}("https://s.pinimg.com/ct/core.js");
		pintrk('load', '2617466540835', {em: '<user_email_address>'});
		pintrk('page');
		</script>
		<noscript>
		<img height="1" width="1" style="display:none;" alt=""
		  src="https://ct.pinterest.com/v3/?event=init&tid=2617466540835&pd[em]=<hashed_email_address>&noscript=1" />
		</noscript>
		<!-- end Pinterest Tag -->
	<?php } // end cookie law if ?>
	
</head>
<body id="makeblog" <?php body_class(); ?>>
	
<?php
// Tracking pixels users can turn off through the cookie law checkbox -- defaults to yes
if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) {
?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PC5R77"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php } // end cookie law if ?>
	
<div id="search-modal">
  <form role="search" method="get" class="search-form" action="/">
      <label class="sb-search-label" for="search">Search</label>
        <input class="sb-search-input search-field" placeholder="What are you searching for?" value="" name="s" id="search" title="" type="text">
        <input class="sb-search-submit" name="submit" value="Search" type="submit">
  </form>
  <div id="popular-links">
    <strong>POPULAR SEARCHES:</strong>
    <ul class="pop-links-list">
        <li><a href="/?s=arduino" target="_self">Arduino</a></li>
        <li><a href="/?s=cnc" target="_self">CNC</a></li>
        <li><a href="/?s=raspberry pi" target="_self">Raspberry Pi</a></li>
        <li><a href="/?s=wood working" target="_self">Woodworking</a></li>
    </ul>
    <ul class="pop-links-list">
        <li><a href="/?s=3d printing" target="_self">3D Printing</a></li>
        <li><a href="/?s=iot" target="_self">IOT</a></li>
        <li><a href="/?s=robot" target="_self">Robot</a></li>
        <li><a href="/?s=maker faire" target="_self">Maker Faire</a></li>
    </ul>
  </div>
</div>

<header id="universal-nav" class="universal-nav">

	<?php // Nav Level 1 and Hamburger
     $context = null;
     if(UNIVERSAL_ASSET_USER && UNIVERSAL_ASSET_PASS) {
        $context = stream_context_create(array(
              'http' => array(
                 'header'  => "Authorization: Basic " . base64_encode(UNIVERSAL_ASSET_USER.':'.UNIVERSAL_ASSET_PASS)
              )
        ));
     }
     echo file_get_contents( UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/universal-topnav.html', false, $context);
	?>
	
  <div id="nav-level-2" class="nav-level-2">
    <div class="container">
        <?php
          wp_nav_menu( array(
              'menu'              => 'secondary_universal_menu',
              'theme_location'    => 'secondary_universal_menu',
              'depth'             => 1,
              'container'         => '',
              'container_class'   => '',
              'link_before'       => '<span>',
              'link_after'        => '</span>',
              'menu_class'        => 'nav navbar-nav',
              'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
              'walker'            => new wp_bootstrap_navwalker())
          );
        ?>
    </div>
  </div><!-- .nav-level-2 -->
  <div class="container">
    <ul class="search-button">
        <div class="subscribe-call-out">
            <div class="subscribe-text">
                <a href="https://readerservices.makezine.com/mk/?PC=MK">
                    Want the full magazine:<br />SUBSCRIBE TODAY!
                </a>
            </div>
            <span class="lnr lnr-star"></span>
        </div>
        <li>
          <div id="sb-search" class="sb-search">
            <i class="fa fa-search" aria-hidden="true"></i>
          </div>
        </li>
    </ul>
  </div>

  <div id="nav-flyout">
    <?php
      echo file_get_contents( UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/universal-megamenu.html', false, $context);
    ?>
   </div>
	
	<?php
	// Tracking pixels users can turn off through the cookie law checkbox -- defaults to yes
	if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) {
	?>
		<script async id="aniviewJS94454388" src="https://play.aniview.com/58fcbed1073ef420086c9d08/5d8c8d3828a061037c01b4b0/makezine1.js"></script>
	<?php } // end cookie law if ?>
	
</header>
<div class="nav-flyout-underlay"></div>


<!-- Optional Under Nav Promo Blue Bar and Message. Settings In Theme Customizer -->
<?php if( get_theme_mod( 'make_header_bluebar_enable' ) != '') { ?>
  <div class="second-nav promo-text-under-nav hidden-xs hidden-sm">
    <div class="container">
      <h3>
        <a href="<?php echo get_theme_mod( 'make_header_bluebar_link', '' ); ?>"><?php echo get_theme_mod( 'make_header_bluebar_text', '' ); ?></a>
      </h3>
    </div>
  </div>
<?php } // end if ?>