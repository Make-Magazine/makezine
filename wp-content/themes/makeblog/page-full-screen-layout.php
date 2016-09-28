<?php

/**
 * Template Name: Full Screen Layout
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('version-2'); ?>

<div id="full-screen-page"> <?php

  // check if the flexible content field has rows of data
  if( have_rows('static_image_or_carousel')):

    echo '<div id="carouselPanel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">';
    $i = 0;

    // loop through the rows of data
    while ( have_rows('static_image_or_carousel') ) : the_row();

      $image = get_sub_field('image');
      $title = get_sub_field('title');
      $paragraph_text = get_sub_field('paragraph_text');
      $bottom_left_cta_button_text = get_sub_field('bottom_left_cta_button_text');
      $bottom_left_cta_button_url = get_sub_field('bottom_left_cta_button_url');
      $bottom_right_button_text = get_sub_field('bottom_right_button_text');
      $bottom_right_cta_button_url = get_sub_field('bottom_right_cta_button_url');

      if ($i == 0) { ?>
        <div class="item active">
          <div class="fsp-full-screen-img" style="background: url(<?php echo $image; ?>) center center no-repeat;"></div>
            <?php if (!empty($title)) { ?>
              <div class="carousel-caption">
                <div class="carousel-caption-inner">
                  <h1><?php echo $title; ?></h1>
                  <?php if (!empty($paragraph_text)) { echo '<div class="som-slider-txt">' . $paragraph_text . '</div>'; } ?>
                  <div class="som-slider-btns">
                    <?php if (!empty($bottom_left_cta_button_text)) { echo '<a href="' . $bottom_left_cta_button_url . '" class="som-slider-link-left">' . $bottom_left_cta_button_text . '</a>'; } ?>
                    <?php if (!empty($bottom_right_button_text)) { echo '<a href="' . $bottom_right_cta_button_url . '" class="som-slider-link-right">' . $bottom_right_button_text . '</a>'; } ?>
                  </div>
                </div>
              </div>
            <?php } ?>
        </div> <?php
      } else { ?>
        <div class="item">
          <div class="fsp-full-screen-img" style="background: url(<?php echo $image; ?>) center center no-repeat;"></div>
          <?php if (!empty($title)) { ?>
            <div class="carousel-caption">
              <div class="carousel-caption-inner">
                <h1><?php echo $title; ?></h1>
                <?php if (!empty($paragraph_text)) { echo '<div class="som-slider-txt">' . $paragraph_text . '</div>'; } ?>
                <div class="som-slider-btns">
                  <?php if (!empty($bottom_left_cta_button_text)) { echo '<a href="' . $bottom_left_cta_button_url . '" class="som-slider-link-left">' . $bottom_left_cta_button_text . '</a>'; } ?>
                  <?php if (!empty($bottom_right_button_text)) { echo '<a href="' . $bottom_right_cta_button_url . '" class="som-slider-link-right">' . $bottom_right_button_text . '</a>'; } ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div> <?php
      }
      $i++;
    endwhile; ?>

        </div>

        <?php if( $i > 1 ): ?>
          <!-- <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol> -->

          <a class="left carousel-control" href="#carouselPanel" role="button" data-slide="prev">
            <i class="fa fa-angle-left glyphicon-chevron-right" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carouselPanel" role="button" data-slide="next">
            <i class="fa fa-angle-right glyphicon-chevron-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        <?php endif; ?>
      </div> <?php

  else :

  ?><!-- no layout found--><?php

  endif; ?>

</div>

<?php get_footer(); ?>