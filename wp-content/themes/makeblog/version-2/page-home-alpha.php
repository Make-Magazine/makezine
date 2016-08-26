
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
$main_sponsor = '';
$main_title = '';
$main_subtitle = '';
$main_image = '';
$main_id = '';

$top_link = '';
$top_url = '';
$top_sponsor = '';
$top_title = '';
$top_subtitle = '';
$top_image = '';
$top_id = '';

$bottom_link = '';
$bottom_url = '';
$bottom_sponsor = '';
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
            $main_sponsor =  get_field('sponsored_content_label', $main_id);
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
            $top_sponsor =  get_field('sponsored_content_label', $top_id);
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
            $bottom_sponsor =  get_field('sponsored_content_label', $bottom_id);
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
<div class="home-featured-stories">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <div class="row">
        <a href="<?php echo esc_html( $main_link ); ?>"
          class="mz-featured-imageblock mz-imageblock-hero"
          style="background-image:url('<?php echo get_resized_remote_image_url( $main_image, 1200, 694 ); ?>');">
          <div class="featured-image-shadow"></div>
          <div class="mz-text-overlay">
            <?php if (!empty($main_sponsor)) {
              echo '<span class="sponsored-title-home">SPONSORED BY ' . $main_sponsor . '</span>';
            } ?>
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
          class="mz-featured-imageblock mz-featured-imageblock-top"
          style="background-image:url('<?php echo get_resized_remote_image_url( $top_image, 813, 470 ); ?>');">
          <div class="featured-image-shadow"></div>
          <div class="mz-text-overlay mz-text-overlay-side">
            <?php if (!empty($top_sponsor)) {
              echo '<span class="sponsored-title-home">SPONSORED BY ' . $top_sponsor . '</span>';
            } ?>
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
          <?php if (!empty($bottom_sponsor)) {
            echo '<span class="sponsored-title-home">SPONSORED BY ' . $bottom_sponsor . '</span>';
          } ?>
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

  <!-- DYNAMIC EVENTS PANEL -->
  <?php if( get_theme_mod( 'make_home3x_on_off' ) != '') { 
    $make_home3x_1url = get_theme_mod( 'make_home3x_1url' );
    $make_home3x_1top = get_theme_mod( 'make_home3x_1top' );
    $make_home3x_1smalltop = get_theme_mod( 'make_home3x_1smalltop' );
    $make_home3x_1title = get_theme_mod( 'make_home3x_1title' );
    $make_home3x_1smallbot = get_theme_mod( 'make_home3x_1smallbot' );
    $make_home3x_1btn = get_theme_mod( 'make_home3x_1btn' );
    $make_home3x_1img = get_theme_mod( 'make_home3x_1img' );

    $make_home3x_2url = get_theme_mod( 'make_home3x_2url' );
    $make_home3x_2top = get_theme_mod( 'make_home3x_2top' );
    $make_home3x_2smalltop = get_theme_mod( 'make_home3x_2smalltop' );
    $make_home3x_2title = get_theme_mod( 'make_home3x_2title' );
    $make_home3x_2smallbot = get_theme_mod( 'make_home3x_2smallbot' );
    $make_home3x_2btn = get_theme_mod( 'make_home3x_2btn' );
    $make_home3x_2img = get_theme_mod( 'make_home3x_2img' );

    $make_home3x_3url = get_theme_mod( 'make_home3x_3url' );
    $make_home3x_3top = get_theme_mod( 'make_home3x_3top' );
    $make_home3x_3smalltop = get_theme_mod( 'make_home3x_3smalltop' );
    $make_home3x_3title = get_theme_mod( 'make_home3x_3title' );
    $make_home3x_3smallbot = get_theme_mod( 'make_home3x_3smallbot' );
    $make_home3x_3btn = get_theme_mod( 'make_home3x_3btn' );
    $make_home3x_3img = get_theme_mod( 'make_home3x_3img' );
    ?>

    <div class="home-event-info-3x container">
      <div class="home-event-1x">
        <a href="<?php echo $make_home3x_1url; ?>" <?php if(!empty($make_home3x_1img)){ ?>style="background-image: url(<?php echo $make_home3x_1img; ?>);"<?php } ?>>
          <?php if(!empty($make_home3x_1top)) { ?>
            <h5><?php echo $make_home3x_1top; ?></h5>
          <?php } ?>
          <div class="home-event-body">
            <?php if(!empty($make_home3x_1smalltop)) { ?>
              <p class="home-event-p1"><?php echo $make_home3x_1smalltop; ?></p>
            <?php } ?>
            <?php if(!empty($make_home3x_1title)) { ?>
              <h4><?php echo $make_home3x_1title; ?></h4>
            <?php } ?>
            <?php if(!empty($make_home3x_1smallbot)) { ?>
              <p class="home-event-p2"><?php echo $make_home3x_1smallbot; ?></p>
            <?php } ?>
            <?php if(!empty($make_home3x_1btn)) { ?>
              <div>
                <span class="home-event-span"><?php echo $make_home3x_1btn; ?></span>
              </div>
            <?php } ?>
          </div>
        </a>
      </div>

      <div class="home-event-1x">
        <a href="<?php echo $make_home3x_2url; ?>" <?php if(!empty($make_home3x_2img)){ ?>style="background-image: url(<?php echo $make_home3x_2img; ?>);"<?php } ?>>
          <?php if(!empty($make_home3x_2top)) { ?>
            <h5><?php echo $make_home3x_2top; ?></h5>
          <?php } ?>
          <div class="home-event-body">
            <?php if(!empty($make_home3x_2smalltop)) { ?>
              <p class="home-event-p1"><?php echo $make_home3x_2smalltop; ?></p>
            <?php } ?>
            <?php if(!empty($make_home3x_2title)) { ?>
              <h4><?php echo $make_home3x_2title; ?></h4>
            <?php } ?>
            <?php if(!empty($make_home3x_2smallbot)) { ?>
              <p class="home-event-p2"><?php echo $make_home3x_2smallbot; ?></p>
            <?php } ?>
            <?php if(!empty($make_home3x_2btn)) { ?>
              <div>
                <span class="home-event-span"><?php echo $make_home3x_2btn; ?></span>
              </div>
            <?php } ?>
          </div>
        </a>
      </div>

      <div class="home-event-1x">
        <a href="<?php echo $make_home3x_3url; ?>" <?php if(!empty($make_home3x_3img)){ ?>style="background-image: url(<?php echo $make_home3x_3img; ?>);"<?php } ?>>
          <?php if(!empty($make_home3x_3top)) { ?>
            <h5><?php echo $make_home3x_3top; ?></h5>
          <?php } ?>
          <div class="home-event-body">
            <?php if(!empty($make_home3x_3smalltop)) { ?>
              <p class="home-event-p1"><?php echo $make_home3x_3smalltop; ?></p>
            <?php } ?>
            <?php if(!empty($make_home3x_3title)) { ?>
              <h4><?php echo $make_home3x_3title; ?></h4>
            <?php } ?>
            <?php if(!empty($make_home3x_3smallbot)) { ?>
              <p class="home-event-p2"><?php echo $make_home3x_3smallbot; ?></p>
            <?php } ?>
            <?php if(!empty($make_home3x_3btn)) { ?>
              <div>
                <span class="home-event-span"><?php echo $make_home3x_3btn; ?></span>
              </div>
            <?php } ?>
          </div>
        </a>
      </div>
    </div>

  <?php } else { ?>

    <!-- STATIC EVENTS PANEL -->
    <div class="container event-unit">
      <!-- Home "waist" Promos -->
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-faire">
        <a href="/comparison/boards/how-we-test/shootout/">
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promos/promo-boards-01.jpg' ?>" class="img-responsive center-block event" alt="Make Boards Guide" />
        </a>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-sponsored">
        <a href="/summer-of-making/?utm_source=cspromobar&utm_medium=site&utm_campaign=summermaking16" target="_blank">
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promos/SOM_Inner_Site_Promo_C_@x2.png' ?>" class="img-responsive center-block event" alt="Summer of Making" />
        </a>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="event-camp">
        <a href="https://www.eventbrite.com/e/world-maker-faire-new-york-2016-tickets-25957796468" target="_blank">
          <img src="<?php echo get_template_directory_uri().'/version-2/img/promos/Promo_WMF_2016_v16.png' ?>" class="img-responsive center-block event" alt="World Maker Faire New York" />
        </a>
      </div>
    </div>

  <?php } ?>


  <div class="all-projects <?php echo $device ?>">
    <div class="content container">
      <div class="posts-list">
        <?php sorting_posts_home(); ?>
      </div>
    </div>
    <div class="home-ads bottom">
      <?php global $make; print $make->ads->ad_728x90; ?>
    </div>
    <div id="temp_post_list" style="display: none"></div>
  </div>

<?php get_footer(); ?>
