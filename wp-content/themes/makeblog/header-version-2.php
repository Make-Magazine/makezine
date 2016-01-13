<?php
/**
 * Makezine Version 2 template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */

?>
<?php require_once 'version-2/includes/Mobile_Detect.php';
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
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <link rel="icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico?v=2" />
  <link rel="shortcut icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico?v=2" />
  <link rel="apple-touch-icon" href="<?php bloginfo('siteurl'); ?>/apple-icon.png?v=2"/>


  <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('siteurl'); ?>/apple-icon-57x57.png?v=2">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('siteurl'); ?>/apple-icon-60x60.png?v=2">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('siteurl'); ?>/apple-icon-76x76.png?v=2">

  <link rel="apple-touch-icon" href="<?php bloginfo('siteurl'); ?>apple-touch-icon.png?v=2"/>
  <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('siteurl'); ?>apple-icon-72x72.png?v=2"/>
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('siteurl'); ?>apple-icon-144x144.png?v=2"/>

  <!-- IE 10 Metro tile icon. Replace #FFFFFF with desired tile color -->
  <link rel="manifest" href="<?php bloginfo('siteurl'); ?>/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php bloginfo('siteurl'); ?>/ms-icon-144x144.png?v=2">
  <meta name="theme-color" content="#ffffff">

  <link rel="icon" sizes="192x192" href="<?php bloginfo('siteurl'); ?>/apple-icon-192x192.png?v=2">

  <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('siteurl'); ?>/apple-icon-180x180.png?v=2">

  <!-- For iPad with high-resolution Retina display running iOS ≥ 7: -->
  <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('siteurl'); ?>/apple-icon-152x152.png?v=2">

  <!-- For iPad with high-resolution Retina display running iOS ≤ 6: -->
  <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('siteurl'); ?>/apple-icon-144x144.png?v=2">

  <!-- For iPhone with high-resolution Retina display running iOS ≥ 7: -->
  <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('siteurl'); ?>/apple-icon-120x120.png?v=2">

  <!-- For iPhone with high-resolution Retina display running iOS ≤ 6: -->
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('siteurl'); ?>/apple-icon-114x114.png?v=2">

  <!-- For first- and second-generation iPad: -->
  <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('siteurl'); ?>/apple-icon-72x72.png?v=2">

  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon" href="<?php bloginfo('siteurl'); ?>/apple-icon-precomposed.png?v=2">

  <!-- For any additional png sizes that aren't covered above -->
  <link rel="icon" sizes="16x16" href="<?php bloginfo('siteurl'); ?>/favicon-16x16.png?v=2" >
  <link rel="icon" sizes="32x32" href="<?php bloginfo('siteurl'); ?>/favicon-32x32.png?v=2" >
  <link rel="icon" sizes="96x96" href="<?php bloginfo('siteurl'); ?>/favicon-96x96.png?v=2" >

  <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700" rel="stylesheet" type="text/css">

  <title><?php echo make_generate_title_tag(); ?></title>
  <meta name="twitter:widgets:csp" content="on">
  <meta name="p:domain_verify" content="c4e1096cb904ca6df87a2bb867715669" >
  <meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
  <meta property="fb:admins" content="1612614584" />

  <!-- javascript -->
  <script src="//code.jquery.com/jquery-latest.min.js"></script>
  <script src="<?php echo get_template_directory_uri().'/version-2/js/bootstrap.min.js' ?>"></script>

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="<?php echo get_template_directory_uri().'/version-2/js/ie-emulation-modes-warning.js' ?>"></script>
  <script src="<?php echo get_template_directory_uri().'/version-2/js/header.js' ?>"></script>
  <script src="<?php echo get_template_directory_uri().'/version-2/js/single-story.js' ?>"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(). '/js/fancybox.js' ?>"></script>
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

  <?php get_template_part('dfp'); ?>

  <script type="text/javascript">
    dataLayer = [];
  </script>
</head>
<body <?php body_class(); ?>>
<!-- Google Universal Analytics -->

<!-- Time-tracking for Custom Dimensions -->
<time itemprop="startDate" datetime="<?php the_time( 'c' ); ?>"></time>

<!-- Primary Categories Dimension Query -->
<?php $primary_cat_query = get_post_meta( get_the_id(), 'ga_primary_category' ); $primary_cat = $primary_cat_query[0]; ?>
<?php
$cats = get_the_category();
foreach ( $cats as $cat ) {
  if ( $cat->category_parent < 1 )
    $primarycat[] = $cat->category_nicename;
  elseif ( $cat->category_parent > 0 )
    $parent_cat_id = $cat->category_parent;
  $cat2 = get_cat_name($parent_cat_id);
  $primarycat[] = $cat2;
}
$primary_cat_dimension = $primarycat[0];
?>
<?php $youtube_embed_query = get_post_meta( get_the_id(), 'ga_youtube_embed' ); $youtube_embed = $youtube_embed_query[0]; ?>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51157-1', 'auto');
  // Optimizely Universal Analytics Integration
  window.optimizely = window.optimizely || [];
  window.optimizely.push("activateUniversalAnalytics");
  ga('require', 'displayfeatures');
  ga('send', 'pageview', {
    'page': location.pathname + location.search  + location.hash
  });
  var dimensionValue11 = document.getElementsByTagName("time")[0].getAttribute("datetime");
  ga('set', 'dimension11', dimensionValue11);
  ga('set', 'dimension13', "<?php echo $primary_cat ?>");
  ga('set', 'dimension14', "<?php echo $youtube_embed ?>");
</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PC5R77"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-PC5R77');</script>
<!-- End Google Tag Manager  -->

<?php if ( is_404() ) : // Load this last. ?>
  <script>
    ga('send', 'event', '404', document.location.href + document.location.search, document.referrer);
  </script>
<?php endif; ?>

<header class="header-wrapper">
  <!--<img src="<?php echo get_template_directory_uri().'/version-2/img/2-layers@2x.png' ?>"> -->

  <!-- TOP BRAND BAR -->
  <div class="hidden-xs top-header-bar-brand">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-center">
          <p class="header-make-img">
            <a href="//www.makershed.com/?utm_source=makezine.com&utm_medium=brand+bar&utm_campaign=shop+best+sellers&utm_term=shop+best+sellers" target="_blank">Shop Best Sellers at Maker Shed &rarr; Kits, Books, More!</a>
          </p>
        </div>
        <div class="col-sm-3">
          <p class="header-sub-link pull-right">
            <a id="trigger-overlay" href="#">SUBSCRIBE </a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="container panel header <?php echo $device ?>">

    <!--nav class="navbar navbar-default"-->
    <nav class="navbar navbar-default">
      <div class="row">

        <!-- LOGO & TAG LINE -->
          <div class="col-md-2 col-sm-4 col-xs-5 logo-text">
            <a href="<?php echo home_url(); ?>" class="logo-a">
                <img src="<?php echo get_template_directory_uri().'/version-2/img/make_logo.png' ?>" class="mz-logo" />
            </a>
            <h5 class="mz-tag">We are all Makers</h5>
            <h6><a href="https://readerservices.makezine.com/mk/default.aspx?pc=MK&pk=M5BMKZ"><?php _e( 'Subscribe', 'makeblog' ) ?></a></h6>
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
        <div class="col-md-7 col-sm-8 col-xs-12 menu-container">

          <!-- Optional Above Nav Promo Message. Settings In Theme Customizer -->
          <?php if( get_theme_mod( 'make_header_promo_enable' ) != '') { ?>
            <h3 id="promo-text-above-nav" class="hidden-xs">
              <a href="<?php echo get_theme_mod( 'make_header_promo_link', '' ); ?>"><?php echo get_theme_mod( 'make_header_promo_text', '' ); ?></a>
            </h3>
          <?php } // end if ?>

          <!-- Collapsible Menu -->
          <div id="makezine-navbar-collapse-1" class="navbar-collapse">

            <!-- Mobile search -->
            <div class="hidden-md mz-search search-bar-mobile">
              <form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
                <label>
                  <input type="search" class="search-field" placeholder="" value="" name="s" title="">
                </label>
                <input type="submit" class="search-submit" value="Search" />
              </form>
            </div>

            <?php wp_nav_menu('menu=Make main&menu_class=nav navbar-nav'); ?>

            <div class="mz-social mobile-social">
              <h5>Follow Us</h5>
              <a href="http://facebook.com/makemagazine">
                <span class="fa-stack fa-mz">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                </span>
              </a>

              <a href="http://twitter.com/make">
                <span class="fa-stack fa-mz">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>

              <a href="http://pinterest.com/makemagazine/">
                 <span class="fa-stack fa-mz">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-pinterest-p fa-stack-1x fa-inverse"></i>
                </span>
              </a>

              <a href="https://instagram.com/makemagazine/">
                <span class="fa-stack fa-mz">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                </span>
              </a>

              <div class="mz-footer-subscribe">
                <?php
                $isSecure = "http://";
                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                  $isSecure = "https://";
                }
                ?>
                <h4>Subscribe</h4>
                <p>Stay inspired and get fresh updates</p>
                <form class="sub-form" action="http://whatcounts.com/bin/listctrl" method="POST">
                  <input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" />
                  <input type="hidden" name="cmd" value="subscribe" />
                  <input type="hidden" name="custom_source" value="Mobile Header" />
                  <input type="hidden" name="custom_incentive" value="none" />
                  <input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
                  <input type="hidden" id="format_mime" name="format" value="mime" />
                  <input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true&subscribed-to=make-newsletter" />
                  <input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
                  <input type="hidden" name="errors_to" value="" />
                  <div class="mz-form-horizontal">
                    <input name="email" placeholder="Enter your Email" required="required" type="text">
                    <input value="GO" class="btn-cyan" type="submit">
                  </div>
                </form>
              </div><!-- End subscribe div -->
              <h6>Copyright © 2004-2015 Maker Media, Inc.</br>
                All rights reserved</h6>
            </div><!-- End mobile-social div -->
          </div><!-- End #makezine-navbar-collapse-1 -->
        </div><!-- End .menu-container -->

        <div class="get-dark"></div>

        <!-- SEARCH -->
        <div class="col-md-1 hidden-xs mz-search search-bar">
          <form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
            <input type="submit" class="sendsubmit" value="" />
            <label>
              <input type="search" class="search-field" placeholder="Search..." value="" name="s" title="Search">
              <div class="close-search"></div>
            </label>
          </form>
        </div>

        <!-- Sticky Navbar -->
        <div class="col-lg-1 col-md-3 col-sm-3 hidden-xs subscribe sticky-subscribe">
          <h6>
            <a id="trigger-overlay" href="#">
              <h5>Subscribe</h5>
              <img src="<?php echo get_template_directory_uri().'/version-2/img/2-layers@2x.png' ?>">
            </a>
          </h6>
        </div>

        <!-- SOCIAL MEDIA ICONS -->
        <div class="col-md-2  hidden-sm hidden-xs text-center desktop-social">
          <div class="mz-social">
            <a href="http://facebook.com/makemagazine">
              <span class="fa-stack fa-mz">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
              </span>
            </a>

            <a href="http://twitter.com/make">
              <span class="fa-stack fa-mz">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
              </span>
            </a>

            <a href="http://pinterest.com/makemagazine/">
               <span class="fa-stack fa-mz">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-pinterest-p fa-stack-1x fa-inverse"></i>
              </span>
            </a>

            <a href="https://instagram.com/makemagazine/">
              <span class="fa-stack fa-mz">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </div>
        </div><!-- End .desktop-social -->
      </div><!-- row -->
    </nav>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo get_template_directory_uri().'/version-2/js/ie10-viewport-bug-workaround.js' ?>"></script>

  </div><!-- container panel header -->

  <!-- Optional Under Nav Promo Blue Bar and Message. Settings In Theme Customizer -->
  <?php if( get_theme_mod( 'make_header_bluebar_enable' ) != '') { ?>
    <div class="second-nav promo-text-under-nav">
      <div class="container hidden-xs">
        <h3>
          <a href="<?php echo get_theme_mod( 'make_header_bluebar_link', '' ); ?>"><?php echo get_theme_mod( 'make_header_bluebar_text', '' ); ?></a>
        </h3>
      </div>
    </div>
  <?php } // end if ?>

</header><!-- header-wrapper -->

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
                  'resize' => '370,240',
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
              <img src="<?php echo $photon; ?>" alt="thumbnail">
            </a>
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

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
                  'resize' => '370,240',
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
              <img src="<?php echo $photon; ?>" alt="thumbnail">
            </a>
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

          </div>
        <?php endwhile; ?>

        <?php else: ?>
          <?php echo '<h1>No content found</h1>' ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
      </div>
      <div class="latest-shop row">
        <div class="shop-post col-lg-3 col-md-3 col-sm-3">
          <a href="http://www.makershed.com/collections/3d-printing-fabrication?utm_source=makezine.com&utm_medium=nav+bar&utm_term=3D+printing" class="pull-left first-post"></a>
        </div>
        <div class="shop-post col-lg-3 col-md-3 col-sm-3">
          <a href="http://www.makershed.com/collections/drones-flight?utm_source=makezine.com&utm_medium=nav+bar&utm_term=drones+flight" class="pull-left second-post"></a>
        </div>
        <div class="shop-post col-lg-3 col-md-3 col-sm-3">
          <a href="http://www.makershed.com/collections/toys??utm_source=makezine.com&utm_medium=nav+bar&utm_term=kits+for+beginners" class="pull-left third-post"></a>
        </div>
        <div class="shop-post col-lg-3 col-md-3 col-sm-3">
          <a href="http://www.makershed.com/collections/books-magazines?utm_source=makezine.com&utm_medium=nav+bar&utm_term=books+magazines" class="pull-left fourth-post"></a>
        </div>
      </div>
      <div class="latest-events row">
        <?php query_posts('post_type=events&showposts=5'); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
          $id = get_the_ID();?>
          <div class="events-post col-lg-2 col-md-2 col-sm-2">
            <div class="event-thumbnail">
              <a href="<?php echo get_post_meta($id,'url',true); ?>" class="pull-left">
                <?php
                $args = array(
                    'resize' => '102,102',
                );
                $url = wp_get_attachment_image(get_post_thumbnail_id($id), 'events-nav-thumb');
                $re = "/^(.*? src=\")(.*?)(\".*)$/m";
                preg_match_all($re, $url, $matches);
                $str = $matches[2][0];
                $photon = jetpack_photon_url($str, $args);
                if(strlen($url) == 0){
                  $photon = catch_first_image_nav();
                  $photon = jetpack_photon_url( $photon, $args );
                } ?>
                <img src="<?php echo $str; ?>" alt="thumbnail">
              </a>
            </div>
            <h1><a href="<?php echo get_post_meta($id,'url',true); ?>"><?php echo get_post_meta($id,'location',true); ?></a></h1>
            <h2><a href="<?php echo get_post_meta($id,'url',true); ?>"><?php echo get_post_meta($id,'date',true); ?></a></h2>
          </div>
        <?php endwhile; ?>

        <?php else: ?>
          <?php echo '<h1>No content found</h1>' ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
      </div>
    </div>
  </div>
</div>
<div class="close-dynamic-content"></div>