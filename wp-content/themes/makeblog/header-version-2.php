<?php
/**
 * Makezine Version 2 template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */

?>
<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="https://www.facebook.com/2008/fbml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Version2">
    <meta name="author" content="">

    <link rel="icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico" />
    <link rel="shortcut icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico" />

    <link rel="apple-touch-icon" href="apple-touch-icon.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="apple-icon-144x144.png"/>


    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700" rel="stylesheet" type="text/css">
	
    <title><?php echo make_generate_title_tag(); ?></title>
    <meta name="twitter:widgets:csp" content="on">
    <meta name="p:domain_verify" content="c4e1096cb904ca6df87a2bb867715669" >
    <meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
    <meta property="fb:admins" content="1612614584" />
	
    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="<?php echo get_template_directory_uri().'/version-2/js/bootstrap.min.js' ?>"></script>
  	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
   
      <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
      <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
      <script src="<?php echo get_template_directory_uri().'/version-2/js/ie-emulation-modes-warning.js' ?>"></script>
  	<script src="<?php echo get_template_directory_uri().'/version-2/js/header.js' ?>"></script>

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
  <body>
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

	<!-- BANNER -->
	<div class="header-wrapper">
    <header class="hidden-xs page-banner">
      <div class="row" id="top-header">
        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
        <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs text-center top-nav">
          <h6><a href="http://www.makershed.com/?utm_source=makezine.com&utm_medium=brand+bar&utm_campaign=shop+best+sellers&utm_term=shop+best+sellers">Shop Best Sellers at Maker Shed &rarr; Kits, Books, More!</a></h6>
        </div>
        <div class="col-lg-1 col-md-3 col-sm-3 hidden-xs text-center subscribe">
          <h6><a href="https://readerservices.makezine.com/mk/default.aspx?">Subscribe
            <img src="<?php echo get_template_directory_uri().'/version-2/img/2-layers@2x.png' ?>"></a></h6>
        </div>
      </div> <!-- row -->    
    </header>

    <div class="container panel header">
      <!--nav class="navbar navbar-default"-->
      <nav class="navbar navbar-default">
        <div class="row">

          <!-- LOGO & TAG LINE -->
          <a href="<?php echo home_url(); ?>" class="logo-a"><div class="col-md-2 col-sm-4 col-xs-5 logo-text">
            <img src="<?php echo get_template_directory_uri().'/version-2/img/make_logo.png' ?>" class="mz-logo" />
            <br>
            <h5 class="mz-tag">We are all Makers</h5>
			<h6><a href="https://readerservices.makezine.com/mk/default.aspx?"><?php _e( 'Subscribe', 'makeblog' ) ?></a></h6>
          </div></a>

  
          <!-- MENUS -->
          <div class="col-md-7 col-sm-8 col-xs-12 menu-container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#makezine-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>  
            <!-- Collapsible Menu -->
			<div id="makezine-navbar-collapse-1" class="navbar-collapse">
			<!-- Mobile search -->
				<div class="hidden-md mz-search search-bar-mobile">
		    
					<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
					<label>
					    <input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search">
					</label>
    			    <input type="submit" class="search-submit" value="Search" />
					</form>        
				</div>
				<?php wp_nav_menu('menu=Make main&menu_class=nav navbar-nav'); ?>
			
	       <div class="mz-social mobile-social">  
          <h5>Follow Us</h5>
          <a href="http://facebook.com/makemagazine"><img src="/wp-content/themes/makeblog/version-2/img/facebook.png" alt="facebook" class="social-button"></img></a>
          <a href="http://twitter.com/make"><img src="/wp-content/themes/makeblog/version-2/img/twitter.png" alt="twitter" class="social-button"></img></a>
          <a href="http://pinterest.com/makemagazine/"><img src="/wp-content/themes/makeblog/version-2/img/pinterest.png" alt="pinterest" class="social-button"></img></a>    
          <a href="http://https://instagram.com/makemagazine/"><img src="/wp-content/themes/makeblog/version-2/img/instagram.png" alt="instagram" class="social-button"></img></a> 


          <!--  <a href="http://facebook.com/makemagazine"><i class="fa fa-facebook fa-lg"></i></a>
          <a href="http://twitter.com/make"><i class="fa fa-twitter sfa-lg"></i></a>
          <a href="http://pinterest.com/makemagazine/"><i class="fa fa-pinterest-p fa-lg"></i></a>    
          <a href="http://https://instagram.com/makemagazine/"><i class="fa fa-instagram fa-lg"></i></a>  -->
        	
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
								<input type="hidden" name="custom_source" value="footer" /> 
								<input type="hidden" name="custom_incentive" value="none" /> 
								<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
								<input type="hidden" id="format_mime" name="format" value="mime" />
								<input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true" />
								<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
								<input type="hidden" name="errors_to" value="" />
								<div class="mz-form-horizontal">
									<input name="email" placeholder="Enter your Email" required="required" type="text">
									<input value="GO" class="btn-cyan" type="submit">
								</div>
						  </form>
						</div>
					<h6>Copyright © 2004-2015 Maker Media, Inc.</br>
					All rights reserved</h6>
				</div> 
				
			</div>
			<div class="get-dark"></div>
          </div>
    

          <!-- SEARCH -->                    
          <div class="col-md-1 hidden-xs mz-search search-bar">
		    
                <form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
					<label>
					    <input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search">
						<div class="close-search"></div>
					</label>
    			    <input type="submit" class="search-submit" value="Search" />
			    </form>        
          </div>
		  <div class="col-lg-1 col-md-3 col-sm-3 hidden-xs subscribe sticky-subscribe">
				<h6><a href="https://readerservices.makezine.com/mk/default.aspx?"><h5>Subscribe</h5>
						<img src="<?php echo get_template_directory_uri().'/version-2/img/2-layers@2x.png' ?>"></a></h6>
		  </div>
			
          <!-- SOCIAL MEDIA ICONS -->
          <div class="col-md-2  hidden-sm hidden-xs text-center desktop-social"> 
            <div class="mz-social">  
              <a href="http://facebook.com/makemagazine"><img src="/wp-content/themes/makeblog/version-2/img/facebook.png" alt="facebook" class="social-button"></img></a>
              <a href="http://twitter.com/make"><img src="/wp-content/themes/makeblog/version-2/img/twitter.png" alt="twitter" class="social-button"></img></a>
              <a href="http://pinterest.com/makemagazine/"><img src="/wp-content/themes/makeblog/version-2/img/pinterest.png" alt="pinterest" class="social-button"></img></a>    
              <a href="https://instagram.com/makemagazine/"><img src="/wp-content/themes/makeblog/version-2/img/instagram.png" alt="instagram" class="social-button"></img></a> 
      
              <!--  <a href="http://facebook.com/makemagazine"><i class="fa fa-facebook fa-lg"></i></a>
              <a href="http://twitter.com/make"><i class="fa fa-twitter  fa-lg"></i></a>
              <a href="http://pinterest.com/makemagazine/"><i class="fa fa-pinterest-p fa-lg"></i></a>    
              <a href="https://instagram.com/makemagazine/"><i class="fa fa-instagram fa-lg"></i></a>  -->
            </div>     
          </div>   
        </div> <!-- row -->  
      </nav>

    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo get_template_directory_uri().'/version-2/js/ie10-viewport-bug-workaround.js' ?>"></script>
</div>
<div class="second-nav"></div>
</div>