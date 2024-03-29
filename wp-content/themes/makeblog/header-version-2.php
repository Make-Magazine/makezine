<?php
/**
 * Makezine Version 2 template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */

global $make;
global $wp_query;
global $post;

// remove any enqueue we don't want
if (!is_single())
{
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

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-PC5R77');</script>
  <!-- End Google Tag Manager -->

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

  <!-- Make GPT -->
  <script type='text/javascript' src="<?php print get_template_directory_uri() . '/js/gpt.js'; ?>"></script>

  <!-- nativo script -->
  <script type="text/javascript" src="//s.ntv.io/serve/load.js" async></script>
    <?php if (is_page('content')): ?>
      <meta http-equiv="X-UA-Compatible" content="IE=10" />
      <meta name="robots" content="noindex, nofollow" />
    <?php endif; ?>
  <!-- end nativo script -->

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

  <!-- Google Optimize -->
  <style>.async-hide { opacity: 0 !important} </style>
  <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
  h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
  (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
  })(window,document.documentElement,'async-hide','dataLayer',4000,
  {'GTM-TXW38JQ':true});</script>
  <!-- End Google Optimize -->

  <!-- Google Universal Analytics -->
  <!-- Primary Categories Dimension Query -->
  <?php $primary_cat_query = get_post_meta( get_the_id(), 'ga_primary_category' ); $primary_cat = (isset($primary_cat_query[0])?$primary_cat_query[0]:''); ?>
  <?php
    $cats = get_the_category();
    $primarycat = array();
    foreach ( $cats as $cat ) {
      if ( $cat->category_parent < 1 )
        $primarycat[] = $cat->category_nicename;
      elseif ( $cat->category_parent > 0 )
        $parent_cat_id = $cat->category_parent;
      $cat2 = get_cat_name($parent_cat_id);
      $primarycat[] = $cat2;
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
</head>
<body id="makeblog" <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PC5R77"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

 <!-- TOP BRAND BAR -->
  <!--div class="top-header-bar-brand">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-center">
          <p class="header-make-img">
            <a href="/fall-making/">Events, Projects and More - Discover Fall Making <span style="font-size:24px;vertical-align:text-bottom">&rsaquo;</span></a>
          </p>
        </div>
      </div>
    </div>
  </div-->

<header class="header-wrapper">
  <div class="header-white-bg">
    <div class="container header <?php echo $device ?>">
      <div class="row">
        <nav class="navbar navbar-default">

          <!-- LOGO & TAG LINE -->
          <div class="col-md-2 col-sm-4 col-xs-5 logo-text">
            <a href="<?php echo home_url(); ?>">
              <img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri()); ?>/img/Make_logo.svg" alt="Make: logo" />
            </a>
          </div>

          <!-- MENUS -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#makezine-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <!-- Desktop and Mobile Menu -->
          <div class="col-md-7 col-sm-8 menu-container">

            <!-- Optional Above Nav Promo Message. Settings In Theme Customizer -->
            <?php if( get_theme_mod( 'make_header_promo_enable' ) != '') {
              echo '<h3 id="promo-text-above-nav" class="hidden-xs">';
              echo '<a href="' . get_theme_mod( 'make_header_promo_link', '' ) . '">' . get_theme_mod( 'make_header_promo_text', '' ) . '</a>';
              echo '</h3>';
            } // end if ?>

            <!-- Collapsible Menu -->
            <div id="makezine-navbar-collapse-1" class="navbar-collapse">

              <!-- Mobile search -->
              <div class="search-bar-mobile hidden-md hidden-lg">
                <form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
                  <label>
                    <input type="search" class="search-field" placeholder="Search Make: Magazine" value="" name="s" title="">
                  </label>
                  <input type="submit" class="search-submit" value="Search" />
                </form>
              </div>

              <?php wp_nav_menu('menu=Make main&menu_class=nav navbar-nav'); ?>

              <div class="mz-social mobile-social">
                <h5>Follow Us</h5>
                <div class="social-network-container">
                  <ul class="social-network social-circle">
                    <li><a href="//facebook.com/makemagazine" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="//twitter.com/make" class="icoTwitter" title="Twitter" target="_blank"><i class="fa fa-twitter" target="_blank"></i></a></li>
                    <li><a href="//pinterest.com/makemagazine" class="icoPinterest" title="Pinterest" target="_blank"><i class="fa fa-pinterest-p" target="_blank"></i></a></li>
                    <li><a href="//instagram.com/makemagazine" class="icoInstagram" title="Instagram" target="_blank"><i class="fa fa-instagram" target="_blank"></i></a></li>
                  </ul>
                </div>

                <!-- Mobile nav bottom info-->
                <div class="mz-footer-subscribe">
                  <?php
                  $isSecure = "http://";
                  if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                    $isSecure = "https://";
                  }
                  ?>
                  <h4>Sign Up For Our Newsletter</h4>
                  <form class="sub-form whatcounts-head-mobile" action="https://secure.whatcounts.com/bin/listctrl" method="POST">
                    <input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" /><!-- Makezine -->
                    <input type="hidden" name="cmd" value="subscribe" />
                    <input type="hidden" name="custom_source" value="Mobile Header" />
                    <input type="hidden" name="custom_incentive" value="none" />
                    <input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
                    <input type="hidden" id="format_mime" name="format" value="mime" />
                    <input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true&subscribed-to=make-newsletter" />
                    <input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
                    <input type="hidden" name="errors_to" value="" />
                    <div id="recapcha-header-mobile" class="g-recaptcha" data-size="invisible"></div>
                    <div class="mz-form-horizontal">
                      <input name="email" placeholder="Enter your Email" required="required" type="email">
                      <input value="GO" class="btn-cyan" type="submit">
                    </div>
                  </form>
                </div><!-- End subscribe div -->
                <h6>Copyright © 2004-2018 Maker Media, Inc.</br>
                  All rights reserved</h6>
              </div><!-- End mobile-social div -->
            </div><!-- End #makezine-navbar-collapse-1 -->
          </div><!-- End .menu-container -->

          <div class="get-dark"></div>

          <!-- NEW SEARCH -->
          <div id="sb-search" class="sb-search hidden-xs hidden-sm">
            <form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
              <label class="sb-search-label">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="sb-search-input search-field" placeholder="Search Make: Magazine" type="text" value="" name="s" id="search">
              </label>
              <label class="sb-search-open-trigger">
                <!-- <i class="fa fa-times" aria-hidden="true"></i> -->
                <input class="sb-search-submit" type="submit" value="">
              </label>
              <i class="fa fa-search" aria-hidden="true"></i>
            </form>
          </div>

          <!-- New Header Subscribe stuff -->
          <div id="mz-header-subscribe" class="hidden-xs hidden-sm">
            <div>
              <a id="trigger-overlay" href="https://readerservices.makezine.com/mk/default.aspx?pc=MK&pk=" target="_blank">
                <img id="mz-mag-cover" src="<?php echo get_template_directory_uri() . '/img/magazine-covers/Make-magazine-cover-55.png'; ?>" alt="Make: magazine cover, subscribe here" />
              </a>
              <div class="mz-header-rtCol">
                <a class="mz-header-signin" href="/account" target="_blank">Sign In</a> 
                <a class="subscribe-red-btn" href="https://readerservices.makezine.com/mk/default.aspx?pc=MK&pk=" target="_blank">SUBSCRIBE<span> &amp; save</span></a>
              </div>
            </div>
          </div>

          <!-- Subscribe link in Sticky Navbar -->
          <div class="sticky-subscribe">
            <a class="subscribe-red-btn" href="https://readerservices.makezine.com/mk/default.aspx?pc=MK&pk=" target="_blank">SUBSCRIBE<span> &amp; save</span></a>
            <a class="mz-header-signin" href="/account" target="_blank">Sign In</a> 
          </div>

        </nav>
      </div><!-- row -->
    </div><!-- container header -->
  </div><!-- header-white-bg -->

  <div class="dynamic-header-posts <?php if( get_theme_mod( 'make_header_bluebar_enable' ) != '') { ?>dynamic-header-posts-margin<?php } ?>">
    <div class="dynamic-header-container container">
      <div class="menu-container row">
        <div class="menu-sub-menu"></div>
      </div>
      <div class="dynamic-header-content row">

        <div class="latest-projects row">
          <?php query_posts('post_type=projects&showposts=4'); ?>
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="project-post col-lg-3 col-md-3 col-sm-3">

              <a href="<?php the_permalink(); ?>" class="pull-left">
                <?php
                $args = array(
                  'resize' => '370,220',
                  'quality' => get_photon_img_quality(),
                  'strip' => 'all',
                );
                $url = wp_get_attachment_image(get_post_thumbnail_id(), 'project-thumb');
                $re = "/^(.*? src=\")(.*?)(\".*)$/m";
                preg_match_all($re, $url, $matches);
                $str = $matches[2][0];
                $photon = jetpack_photon_url($str, $args);
                if(strlen($url) == 0){
                  $photon = catch_first_image_nav();
                  $photon = jetpack_photon_url( $photon, $args );
                } ?>
                <img src="<?php echo $photon; ?>" alt="Featured Project Thumbnail" />
                <h2><?php the_title(); ?></h2>
              </a>

            </div>
          <?php endwhile; ?>

          <?php else: ?>
            <?php echo '<h1>No content found</h1>' ?>
          <?php endif; ?>
          <?php wp_reset_query(); ?>
        </div>

        <div class="latest-stories row">
          <?php query_posts('showposts=4'); ?>
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="stories-post col-lg-3 col-md-3 col-sm-3">

              <a href="<?php the_permalink(); ?>" class="pull-left">
                <?php
                $args = array(
                  'resize' => '370,220',
                  'quality' => get_photon_img_quality(),
                  'strip' => 'all',
                );
                $url = wp_get_attachment_image(get_post_thumbnail_id(), 'project-thumb');
                $re = "/^(.*? src=\")(.*?)(\".*)$/m";
                preg_match_all($re, $url, $matches);
                $str = $matches[2][0];
                $photon = jetpack_photon_url($str, $args);
                if(strlen($url) == 0){
                  $photon = catch_first_image_nav();
                  $photon = jetpack_photon_url( $photon, $args );
                } ?>
                <img src="<?php echo $photon; ?>" alt="Featured Story Post Thumbnail" />
                <h2><?php the_title(); ?></h2>
              </a>

            </div>
          <?php endwhile; ?>

          <?php else: ?>
            <?php echo '<h1>No content found</h1>' ?>
          <?php endif; ?>
          <?php wp_reset_query(); ?>
        </div>

        <div class="nav-guides row">
          <?php if( have_rows('guides_nav', 'option') ): ?>
            <?php while( have_rows('guides_nav', 'option') ): the_row();

              $image = get_sub_field('image');
              $url = get_sub_field('url');
              $args = array(
                'resize' => '370,260',
                'quality' => get_photon_img_quality(),
                'strip' => 'all',
              );
              $photon = jetpack_photon_url($image, $args); ?>

              <div class="nav-img-item col-lg-3 col-md-3 col-sm-3">
                <a href="<?php echo $url; ?>">
                  <img class="img-responsive" src="<?php echo $photon; ?>" alt="Our maker guides help you find the perfect tool for your project" />
                </a>
              </div>

            <?php endwhile; ?>
          <?php endif; ?>
        </div>

        <div class="latest-shop row">
          <?php if( have_rows('shop_nav', 'option') ): ?>
            <?php while( have_rows('shop_nav', 'option') ): the_row();

              $image = get_sub_field('image');
              $url = get_sub_field('url');
              $args = array(
                'resize' => '370,260',
                'quality' => get_photon_img_quality(),
                'strip' => 'all',
              );
              $photon = jetpack_photon_url($image, $args); ?>

              <div class="nav-img-item col-lg-3 col-md-3 col-sm-3">
                <a href="<?php echo $url; ?>">
                  <img class="img-responsive" src="<?php echo $photon; ?>" alt="Featured shopping by category" />
                </a>
              </div>

            <?php endwhile; ?>
          <?php endif; ?>
        </div>

        <div class="latest-events row">
          <?php if( have_rows('add_each_event_here', 'option') ): ?>
            <?php while( have_rows('add_each_event_here', 'option') ): the_row();

              $image = get_sub_field('image');
              $location = get_sub_field('location');
              $date = get_sub_field('date');
              $url = get_sub_field('url');
              $args = array(
                'resize' => '105,105',
                'quality' => get_photon_img_quality(),
                'strip' => 'all',
              );
              $photon = jetpack_photon_url($image, $args); ?>

              <div class="events-post col-lg-2 col-md-2">
                <a href="<?php echo $url; ?>">
                  <img src="<?php echo $photon; ?>" alt="Featured Maker Faire event" />
                  <h3><?php echo $location; ?></h3>
                  <p><?php echo $date; ?></p>
                </a>
              </div>

            <?php endwhile; ?>
          <?php endif; ?>
        </div>

        <div class="nav-share-row row">
          <?php if( have_rows('get_involved_nav', 'option') ): ?>
            <?php while( have_rows('get_involved_nav', 'option') ): the_row();

              $image = get_sub_field('image');
              $url = get_sub_field('url');
              $args = array(
                'resize' => '370,260',
                'quality' => get_photon_img_quality(),
                'strip' => 'all',
              );
              $photon = jetpack_photon_url($image, $args); ?>

              <div class="nav-img-item col-lg-3 col-md-3 col-sm-3">
                <a href="<?php echo $url; ?>">
                  <img class="img-responsive" src="<?php echo $photon; ?>" alt="Get involved in the maker community here" />
                </a>
              </div>

            <?php endwhile; ?>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
  <div class="close-dynamic-content"></div>
</header><!-- header-wrapper -->


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