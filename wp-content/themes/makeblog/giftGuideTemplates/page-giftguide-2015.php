<?php
/**
 * Template Name: Holiday Gift Guide 2015
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('version-2'); ?>
  
<div id="gg2015">

  <div class="container gg2015-header gg2015-header-home hidden-xs">

    <div class="row">

      <div class="col-sm-5 col-md-6 gg2015-border-right">

        <h3>THE ULTIMATE MAKERS</h3>
        <h3 class="gg2015-big-font">GIFT GUIDE</h3>
        <p>These are our top gifting picks of the 2015 holiday season in nine different categories - something for everyone in your family of makers - from the best solder sucker to a speedy FPV microdrone.</p>

      </div>

      <div class="col-sm-7 col-md-6 gg2015-nav">

        <div class="col-sm-4">
          <a href="/giftguide/craft"><h2>CRAFT</h2></a>
          <a href="/giftguide/science"><h2>SCIENCE</h2></a>
          <a href="/giftguide/drones"><h2>DRONES</h2></a>
        </div>

        <div class="col-sm-4">
          <a href="/giftguide/electronics"><h2>ELECTRONICS</h2></a>
          <a href="/giftguide/wood-working"><h2>WOODWORKING</h2></a>
          <a href="/giftguide/make-believe"><h2>MAKE: BELIEVE</h2></a>
        </div>

        <div class="col-sm-4">
          <a href="/giftguide/metal-shop"><h2>METAL SHOP</h2></a>
          <a href="/giftguide/automotive"><h2>AUTOMOTIVE</h2></a>
          <a href="/giftguide/kitchen"><h2>KITCHEN</h2></a>
        </div>

      </div>

    </div>

  </div>

  <div class="container gg2015-hero">

    <img class="visible-xs-block gg2015-mobile-hero img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/gift-guide-2015/home_background_mobile_2.png" alt="Makey snow globe animation" />
    <div class="gg2015-snow"></div>

    <div class="col-sm-7 hidden-xs">
      <img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/gift-guide-2015/UltimateMakersGiftGuide_Title.png" alt="The Ultimate Makers Gift Guide" />
      <img class="img-responsive col-sm-4 col-sm-offset-4 gg2015-badge" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/gift-guide-2015/Maker-Gift-Guide-Badge.jpg" alt="Maker Gift Guide Badge" />
    </div>

  </div>

  <div class="container gg2015-mobile-naver text-center visible-xs-block">
    <a id="gg2015-mobile-naver-a" href="#">
      <h4>BROWSE <i class="fa fa-chevron-down"></i></h4>
    </a>
  </div>
  <div class="gg2015-mobile-nav-home hidden-sm hidden-md hidden-lg">
    <div class="col-xs-6">
      <a href="/giftguide/automotive"><h5>AUTOMOTIVE</h5></a>
      <a href="/giftguide/electronics"><h5>ELECTRONICS</h5></a>
      <a href="/giftguide/kitchen"><h5>KITCHEN</h5></a>
      <a href="/giftguide/wood-working"><h5>WOOD WORKING</h5></a>
      <a href="/giftguide/metal-shop"><h5>METAL SHOP</h5></a>
    </div>
    <div class="col-xs-6">
      <a href="/giftguide/drones"><h5>DRONES</h5></a>
      <a href="/giftguide/craft"><h5>CRAFT</h5></a>
      <a href="/giftguide/make-believe"><h5>MAKE: BELIEVE</h5></a>
      <a href="/giftguide/science"><h5>SCIENCE</h5></a>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="container gg2015-mobile-home visible-xs-block">
    <h2>THE BEST TOOLS AND TOYS FOR THE ONES YOU LOVE</h2>
    <p>These are our top gifting picks of the 2015 holiday season in nine different categories - something for everyone in your family of makers - from the best solder sucker to a speedy FPV microdrone.</p>
  </div>

</div>
<style>
/* This is to keep the Sumome left social sharing icons from auto hiding */
  .sumome-share-client-wrapper-left-page {
    opacity: 1 !important;
  }
</style>
<script>
  jQuery( "#gg2015-mobile-naver-a" ).on( "click", function() {
    event.preventDefault();
    if ( jQuery( ".gg2015-mobile-nav" ).is( ":hidden" ) ) {
      jQuery( ".gg2015-mobile-nav" ).slideDown( "medium" );
    } else {
      jQuery( ".gg2015-mobile-nav" ).hide();
    }
  });
</script>
<?php get_footer(); ?>