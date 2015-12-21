
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

wp_enqueue_script( 'make-homegrid', get_stylesheet_directory_uri() . '/version-2/js/homegrid.js', array( 'jquery' ), false, true );
?>
<?php
// custom-fields for curated section
$main_link = '';
$main_url = '';
$main_title = '';
$main_subtitle = '';
$main_image = '';
$main_id = '';

$top_link = '';
$top_url = '';
$top_title = '';
$top_subtitle = '';
$top_image = '';
$top_id = '';

$bottom_link = '';
$bottom_url = '';
$bottom_title = '';
$bottom_subtitle = '';
$bottom_image = '';
$bottom_id = '';

// Check if the menu exists
$menu_name = 'Home Page Curation';
$menu_exists = wp_get_nav_menu_object( $menu_name );

// Get ad object.

    if ( $menu_exists ) {
	$menu = wp_get_nav_menu_object(  $menu_name );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        
        if ($menu_items[0])
        {   
            $main_post = $menu_items[0];
            $main_id= $main_post->object_id;
            $main_link = $main_post->url;
            $main_url = $main_post->url;
            $main_title = $main_post->title;
            $main_subtitle = $main_post->description;
            if ($main_post->attr_title)
            $main_image = $main_post->attr_title;
            else
            $main_image = wp_get_attachment_url(get_post_thumbnail_id($main_id));
        }
        if ($menu_items[1])
        {   
            $top_post = $menu_items[1];
            $top_id= $top_post->object_id;
            $top_link = $top_post->url;
            $top_url = $top_post->url;
            $top_title = $top_post->title;
            $top_subtitle = $top_post->description;
            if ($top_post->attr_title)
            $top_image = $top_post->attr_title;
            else
            $top_image = wp_get_attachment_url(get_post_thumbnail_id($top_id));
            
        }
        if ($menu_items[2])
        {   
            $bottom_post = $menu_items[2];
            $bottom_id= $bottom_post->object_id;
            $bottom_link = $bottom_post->url;
            $bottom_url = $bottom_post->url;
            $bottom_title = $bottom_post->title;
            $bottom_subtitle = $bottom_post->description;
            if ($bottom_post->attr_title)
            $bottom_image = $bottom_post->attr_title;
            else
            $bottom_image = wp_get_attachment_url(get_post_thumbnail_id($bottom_id));
           
        }
        /*
	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
            print_r($menu_item);
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            
	}*/
    } else {
	$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    }

?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">    
      <div class="row">
        <a href="<?php echo esc_html( $main_link ); ?>"
          class="mz-featured-imageblock mz-imageblock-hero"
          style="background-image:url('<?php echo get_resized_remote_image_url( $main_image, 1200, 694 ); ?>');">
          <div class="featured-image-shadow"></div>
          <div class="mz-text-overlay">
            <h2><?php echo $main_title; ?></h2>
            <p><?php echo esc_html( $main_subtitle ); ?></p>
          </div>
        </a>
      </div>
      <div class="filter-display-wrapper">
        <div class="red-box-category">
        <?php home_tags( "$main_id" ) ?>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="row">
      <a href="<?php echo esc_html( $top_link ); ?>"
        class="mz-featured-imageblock"
        style="background-image:url('<?php echo get_resized_remote_image_url( $top_image, 813, 470 ); ?>');">
        <div class="featured-image-shadow"></div>
        <div class="mz-text-overlay mz-text-overlay-side">
          <h2><?php echo $top_title; ?></h2>
        </div>
      </a>
      <div class="filter-display-wrapper">
        <div class="red-box-category">
          <?php home_tags( "$top_id" ) ?>
        </div>
      </div>
    </div>
  </div>
            
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="row">
      <a href="<?php echo esc_html( $bottom_link ); ?>"
        class="mz-featured-imageblock"
        style="background-image:url('<?php echo get_resized_remote_image_url( $bottom_image, 813, 470 ); ?>');">
      <div class="featured-image-shadow"></div>
      <div class="mz-text-overlay mz-text-overlay-side">
        <h2><?php echo $bottom_title; ?></h2>
      </div>
      </a>
      <div class="filter-display-wrapper">
        <div class="red-box-category">
          <?php home_tags( "$bottom_id" ) ?>
        </div>
      </div>
      </div>
    </div>
  </div> <!-- row -->    
  
  <!-- AD UNIT -->
  <div class="ad-unit">  
    <div class="col-lg-12 hidden-md hidden-sm hidden-xs"></div>

      <?php global $make; print $make->ads->ad_leaderboard; ?>

    </div> 
  </div>  

  <!-- EVENTS PANEL -->
  <div class="container event-unit">
    <div class="row"> 

<!--  Home "waist" Promos -->
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-faire">
        <a href="https://www.makershed.com/">
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promos/promo-shed-01.jpg' ?>" class="img-responsive center-block event" />
        </a>
      </div> 
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-camp">
        <a href="/2015/12/17/make-show-stopping-netflix-socks/">          
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promos/promo-netflix20.jpg' ?>" class="img-responsive center-block event" />
        </a>
      </div> 
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-sponsored">
        <a href="/giftguide/">
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promos/promo_giftguide2.jpg' ?>" class="img-responsive center-block event" />
        </a>
      </div> 
    </div>  
  </div>

  <!-- MAKER SHED PANEL -->
  <div class="container shed-row">
    <?php echo make_shopify_featured_products_slider_home( 'row-fluid' ); ?>
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
