<?php
/*
Template Name: Home Page Alpha
*/
get_header( 'version-2' );

wp_enqueue_script( 'make-homegrid', get_stylesheet_directory_uri() . '/version-2/js/homegrid.js', array( 'jquery' ), false, true );

  if( have_rows('featured_articles', 'option') ):

    $layout = get_field('featured_article_layout', 'option');
    $c = 1;

    while( have_rows('featured_articles', 'option') ): the_row();

      ${'scheduled_article' . $c} = get_sub_field('schedules_or_preferred_article');
      ${'image_overide1' . $c} = get_sub_field('image_overide1');
      ${'backup_article' . $c} = get_sub_field('backup_article');
      ${'image_overide2' . $c} = get_sub_field('image_overide2');
      ${'additional_options' . $c} = get_sub_field('additional_options');

      if ( ${'scheduled_article' . $c}->post_status == 'publish') { 
        ${'hf' . $c} = ${'scheduled_article' . $c};
        ${'hf' . $c . '_id'} = ${'hf' . $c}->ID;
        if ( $image_overide11 ) {
          ${'hf' . $c . '_image'} = $image_overide11;
        } else {
          ${'hf' . $c . '_image_array'} = wp_get_attachment_image_src( get_post_thumbnail_id( ${'hf' . $c . '_id'} ), array( 1200, 694 ) );
          ${'hf' . $c . '_image'} = ${'hf' . $c . '_image_array'}[0];
        }
      } else { 
        ${'hf' . $c} = $backup_article1;
        ${'hf' . $c . '_id'} = ${'hf' . $c}->ID;
        if ( $image_overide12 ) {
          ${'hf' . $c . '_image'} = $image_overide12;
        } else {
          ${'hf' . $c . '_image_array'} = wp_get_attachment_image_src( get_post_thumbnail_id( ${'hf' . $c . '_id'} ), array( 1200, 694 ) );
          ${'hf' . $c . '_image'} = ${'hf' . $c . '_image_array'}[0];
        }
      }
      ${'hf' . $c . '_link'} = get_permalink(${'hf' . $c . '_id'});
      ${'hf' . $c . '_sponsor'} = get_field('sponsored_content_label', ${'hf' . $c . '_id'});
      ${'hf' . $c . '_title'} = ${'hf' . $c}->post_title;
      ${'hf' . $c . '_excerpt'} = ${'hf' . $c}->post_excerpt;

      $c++;

    endwhile;

  endif;

          // echo '<pre>';
          // var_dump($hf1_image);
          // echo '</pre>';
          // echo '<pre>';
          // var_dump($hf1_image);
          // echo '</pre>';
  ?>

  <div id="home-featured" class="<?php echo $layout; ?>">
    <div class="hf-row1">

      <div class="hf-1 hf-article">
        <a href="<?php echo esc_html( $hf1_link ); ?>" style="background-image:url('<?php echo $hf1_image; ?>');">
          <div class="featured-image-shadow"></div>
          <div class="mz-text-overlay">
            <?php if (!empty($hf1_sponsor)) {
              echo '<span class="sponsored-title-home">SPONSORED BY ' . $hf1_sponsor . '</span>';
            } ?>
            <h2><?php echo $hf1_title; ?></h2>
            <p><?php echo esc_html( $hf1_excerpt ); ?></p>
          </div>
          <?php if( $additional_options1 && in_array('livenow', $additional_options1) ) {
            echo '<span class="live-now-alert"><i class="fa fa-circle" aria-hidden="true"></i> Live Now</span>'; 
          } ?>
        </a>
        <div class="filter-display-wrapper">
          <div class="red-box-category">
            <?php home_tags( "$hf1_id" ) ?>
          </div>
        </div>
      </div>

      <div class="hf-2 hf-article">
        <a href="<?php echo esc_html( $hf2_link ); ?>" style="background-image:url('<?php echo $hf2_image; ?>');">
          <div class="featured-image-shadow"></div>
          <div class="mz-text-overlay">
            <?php if (!empty($hf2_sponsor)) {
              echo '<span class="sponsored-title-home">SPONSORED BY ' . $hf2_sponsor . '</span>';
            } ?>
            <h2><?php echo $hf2_title; ?></h2>
            <p><?php echo esc_html( $hf2_excerpt ); ?></p>
          </div>
          <?php if( $additional_options2 && in_array('livenow', $additional_options2) ) {
            echo '<span class="live-now-alert"><i class="fa fa-circle" aria-hidden="true"></i> Live Now</span>'; 
          } ?>
        </a>
        <div class="filter-display-wrapper">
          <div class="red-box-category">
            <?php home_tags( "$hf2_id" ) ?>
          </div>
        </div>
      </div>

      <div class="hf-3 hf-article">
        <a href="<?php echo esc_html( $hf3_link ); ?>" style="background-image:url('<?php echo $hf3_image; ?>');">
          <div class="featured-image-shadow"></div>
          <div class="mz-text-overlay">
            <?php if (!empty($hf3_sponsor)) {
              echo '<span class="sponsored-title-home">SPONSORED BY ' . $hf3_sponsor . '</span>';
            } ?>
            <h2><?php echo $hf3_title; ?></h2>
            <p><?php echo esc_html( $hf3_excerpt ); ?></p>
          </div>
          <?php if( $additional_options3 && in_array('livenow', $additional_options3) ) {
            echo '<span class="live-now-alert"><i class="fa fa-circle" aria-hidden="true"></i> Live Now</span>'; 
          } ?>
        </a>
        <div class="filter-display-wrapper">
          <div class="red-box-category">
            <?php home_tags( "$hf3_id" ) ?>
          </div>
        </div>
      </div>

      <div class="hf-4 hf-article">
      </div>

      <div class="hf-5 hf-article">
      </div>
    </div>
  <!--   <div class="hf-row2">
      <div class="hf-6 hf-article">
      </div>
      <div class="hf-7 hf-article">
      </div>
      <div class="hf-8 hf-article">
      </div>
      <div class="hf-9 hf-article">
      </div>
    </div> -->

  </div>

  <!-- AD UNIT -->
  <div class="ad-unit">
    <div class="col-lg-12 hidden-md hidden-sm hidden-xs"></div>
    <?php global $make; print $make->ads->ad_leaderboard; ?>
  </div>

  <!-- DYNAMIC EVENTS PANEL -->
  <?php
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
