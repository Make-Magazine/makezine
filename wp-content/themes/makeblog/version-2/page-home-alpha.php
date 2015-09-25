
<?php

/*
Template Name: Home Page Alpha
*/

require_once 'includes/Mobile_Detect.php';
$detect = new Mobile_Detect;
$device = 'pc';
if ( $detect->isMobile() ) {
  $device = 'mobile';
}
if( $detect->isTablet() ){
  $device = 'tablet';
}

get_header( 'version-2' );

?>
<?php
// custom-fields for curated section
$mainurl = make_get_cap_option( 'main_url' );
$topurl = make_get_cap_option( 'top_url' );
$bottomurl = make_get_cap_option( 'bottom_url' );
$mainid = make_get_cap_option( 'main_id' );
$topid = make_get_cap_option( 'top_id' );
$bottomid = make_get_cap_option( 'bottom_id' );

?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">    
      <div class="row">
        <a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>"
          class="mz-featured-imageblock mz-imageblock-hero"
          style="background-image:url('<?php echo get_resized_remote_image_url( $mainurl, 813, 470 ); ?>');">
          <div class="featured-image-shadow"></div>
          <div class="mz-text-overlay">
            <h2><?php echo esc_html( make_get_cap_option( 'main_title' ) ); ?></h2>
            <p><?php echo esc_html( make_get_cap_option( 'main_subtitle' ) ); ?></p>
          </div>
        </a>
      </div>
      <div class="filter-display-wrapper">
        <div class="red-box-category">
        <p><?php home_tags( "$mainid" ) ?></p>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="row">
      <a href="<?php echo esc_html( make_get_cap_option( 'top_link' ) ); ?>"
        class="mz-featured-imageblock"
        style="background-image:url('<?php echo get_resized_remote_image_url( $topurl, 813, 470 ); ?>');">
        <div class="featured-image-shadow"></div>
        <div class="mz-text-overlay mz-text-overlay-side">
          <h2><?php echo esc_html( make_get_cap_option( 'top_title' ) ); ?></h2>
        </div>
      </a>
      <div class="filter-display-wrapper">
        <div class="red-box-category">
          <p><?php home_tags( "$topid" ) ?></p>
        </div>
      </div>
    </div>
  </div>
            
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="row">
      <a href="<?php echo esc_html( make_get_cap_option( 'bottom_link' ) ); ?>"
        class="mz-featured-imageblock"
        style="background-image:url('<?php echo get_resized_remote_image_url( $bottomurl, 813, 470 ); ?>');">
      <div class="featured-image-shadow"></div>
      <div class="mz-text-overlay mz-text-overlay-side">
        <h2><?php echo esc_html( make_get_cap_option( 'bottom_title' ) ); ?></h2>
      </div>
      </a>
      <div class="filter-display-wrapper">
        <div class="red-box-category">
          <p><?php home_tags( "$bottomid" ) ?></p>
        </div>
      </div>
      </div>
    </div>
  </div> <!-- row -->    
  
  <!-- AD UNIT -->
  <div class="ad-unit">  
    <div class="col-lg-12 hidden-md hidden-sm hidden-xs"></div>
      <div id="div-gpt-ad-664089004995786621-1" class="banner-canvas">
        <script type='text/javascript'>
          googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-1')});
        </script>
      </div>
    </div> 
  </div>  

  <!-- EVENTS PANEL -->
  <div class="container">
    <div class="row event-unit"> 
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-camp"> 

        <a href="http://makercon.com?utm_source=makezine.com&utm_medium=ads&utm_campaign=cross+site+promo&utm_creative=business+conference+3+images">
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promo3.jpg' ?>" class="img-responsive center-block event" />
        </a>

      </div> 
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-faire">


        <a href="http://makerfaire.com/new-york-2015/education-forum/?utm_source=
makezine.com&utm_medium=ads&utm_campaign=cross+site+promo&utm_creative=education+classroom">    
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promo1.jpg' ?>" class="img-responsive center-block event" />
        </a>

      </div> 
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-sponsored"> 


        <a href="http://makerfaire.com?utm_source=
makezine.com&utm_medium=ads&utm_campaign=cross+site+promo&utm_creative=wmf+location+logo">             
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promo2.jpg' ?>" class="img-responsive center-block event" />
        </a> 

      </div> 
    </div>  
  </div>
  
  <!-- MAKER SHED PANEL -->
  <div class="container">
    <div class="row product-wrapper"> 
        <?php echo make_shopify_featured_products_slider_home( 'row-fluid' ); ?>
    </div>
  </div> <!-- MakerShed -->

  <div class="all-projects <?php echo $device ?>">
    <div class="content container">
      <div class="posts-list container">
        <?php sorting_posts_home(); //TODO Rename Function ?>  
      </div>
    </div>
    <div id="temp_post_list" style="display: none"></div>
  </div>

<?php get_footer(); ?>