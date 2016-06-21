<?php

/**
 * Template Name: Summer of Making
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('version-2'); ?>

<div id="som" class="bs-margin-fix"> <?php

  // check if the flexible content field has rows of data
  if( have_rows('content_panels')):

    // loop through the rows of data
    while ( have_rows('content_panels') ) : the_row();




      // IMAGE CAROUSEL (RECTANGLE)
      if( get_row_layout() == 'static_or_carousel' ):

        $activeinactive = get_sub_field('activeinactive');
        if( $activeinactive == 'Active' ):

          // check if the nested repeater field has rows of data
          if( have_rows('image_with_text_overlay') ):

            echo '<section class="rectangle-image-carousel">
                    <div id="carouselPanel" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner" role="listbox">';
            $i = 0;

            // loop through the rows of data
            while ( have_rows('image_with_text_overlay') ) : the_row();

              $image = get_sub_field('image');
              $title = get_sub_field('title');
              $paragraph_text = get_sub_field('paragraph_text');
              $bottom_left_cta_button_text = get_sub_field('bottom_left_cta_button_text');
              $bottom_left_cta_button_url = get_sub_field('bottom_left_cta_button_url');
              $bottom_right_button_text = get_sub_field('bottom_right_button_text');
              $bottom_right_cta_button_url = get_sub_field('bottom_right_cta_button_url');

              if ($i == 0) { ?>
                <div class="item active">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <?php if (!empty($title)) { ?>
                      <div class="carousel-caption">
                        <h1><?php echo $title; ?></h1>
                        <?php if (!empty($paragraph_text)) { echo '<div class="som-slider-txt">' . $paragraph_text . '</div>'; } ?>
                        <div class="som-slider-btns">
                          <?php if (!empty($bottom_left_cta_button_text)) { echo '<a href="' . $bottom_left_cta_button_url . '" class="som-slider-link-left">' . $bottom_left_cta_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; } ?>
                          <?php if (!empty($bottom_right_button_text)) { echo '<a href="' . $bottom_right_cta_button_url . '" class="som-slider-link-right">' . $bottom_right_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; } ?>
                        </div>
                      </div>
                    <?php } ?>
                </div> <?php
              } else { ?>
                <div class="item">
                  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                  <?php if (!empty($title)) { ?>
                    <div class="carousel-caption">
                      <h1><?php echo $title; ?></h1>
                      <?php if (!empty($paragraph_text)) { echo '<div class="som-slider-txt">' . $paragraph_text . '</div>'; } ?>
                      <div class="som-slider-btns">
                        <?php if (!empty($bottom_left_cta_button_text)) { echo '<a href="' . $bottom_left_cta_button_url . '" class="som-slider-link-left">' . $bottom_left_cta_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; } ?>
                        <?php if (!empty($bottom_right_button_text)) { echo '<a href="' . $bottom_right_cta_button_url . '" class="som-slider-link-right">' . $bottom_right_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; } ?>
                      </div>
                    </div>
                  <?php } ?>
                </div> <?php
              }
              $i++;
            endwhile; ?>

            </div>

            <?php if( $i > 1 ): ?>
<!--               <ol class="carousel-indicators">
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
          </div>
        </section> <?php

          endif;

        endif;





      // 1 COLUMN LAYOUT
      elseif( get_row_layout() == '1_column' ): 

        $activeinactive = get_sub_field('activeinactive');
        if( $activeinactive == 'Active' ):

          $above_cta_button_text = get_sub_field('above_cta_button_text');
          $column_1 = get_sub_field('column_1');
          $below_cta_button_text = get_sub_field('below_cta_button_text');
          $below_cta_button_url = get_sub_field('below_cta_button_url');
          echo '<section class="som-content-panel-1">
                  <div class="container">';

          if(get_sub_field('above_cta_button_text')){
            echo '  <div class="row text-center som-column1-top-btn">
                      <h3>' . $above_cta_button_text . '</h3>
                    </div>';
          }

          if(get_sub_field('title')){
            echo '  <div class="row">
                      <div class="col-xs-12 text-center">
                        <h2>' . get_sub_field('title') . '</h2>
                      </div>
                    </div>';
          }

          echo '    <div class="row">
                      <div class="col-xs-12 text-center">' . $column_1 . '</div>
                    </div>';

          if(get_sub_field('below_cta_button_text')){
            echo '  <div class="row text-center som-column1-bottom-btn">
                      <a class="btn-cyan" href="' . $below_cta_button_url . '">' . $below_cta_button_text . '</a>
                    </div>';
          }

          echo '  </div>
                </section>';

        endif;





      // 2 COLUMN LAYOUT
      elseif( get_row_layout() == '2_column' ): 

        $activeinactive = get_sub_field('activeinactive');
        if( $activeinactive == 'Active' ):

          $image = get_sub_field('image');
          $top_left_blue_text = get_sub_field('top_left_blue_text');
          $top_left_blue_url = get_sub_field('top_left_blue_url');
          $top_right_blue_text = get_sub_field('top_right_blue_text');
          $top_right_blue_url = get_sub_field('top_right_blue_url');
          $title = get_sub_field('title');
          $column_1 = get_sub_field('column_1');
          $bottom_left_cta_button_text = get_sub_field('bottom_left_cta_button_text');
          $bottom_left_cta_button_url = get_sub_field('bottom_left_cta_button_url');
          $bottom_right_button_text = get_sub_field('bottom_right_button_text');
          $bottom_right_cta_button_url = get_sub_field('bottom_right_cta_button_url');
          $bottom_sponsors = get_sub_field('bottom_sponsors');

          echo '<section class="som-content-panel-2">';

          $image_placement = get_sub_field('image_placement');
          if( $image_placement == 'Left' ):

            echo '<div class="som-2col-img-l" style="background: url(' . $image["url"] . ') no-repeat center center;"></div>    
                    <div class="">
                      <div class="row">
                        <div class="col-sm-6"></div>

                        <div class="col-sm-6 som-2col-txt">';

                          if (!empty($top_left_blue_text)) { echo '<span class="som-2col-top-l">' . $top_left_blue_text . '</span>'; }
                          if (!empty($top_right_blue_text)) { echo '<span class="som-2col-top-r">' . $top_right_blue_text . '</span>'; }
                          echo '<div class="clearfix"></div>';
                          if (!empty($title)) { echo '<h3>' . $title . '</h3>'; }
                          if (!empty($column_1)) { echo '<div class="som-2col-wyswyg">' . $column_1 . '</div>'; }
                          if (!empty($bottom_left_cta_button_text)) { echo '<a href="' . $bottom_left_cta_button_url . '" class="som-2col-bot-l">' . $bottom_left_cta_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; }
                          if (!empty($bottom_right_button_text)) { echo '<a href="' . $bottom_right_cta_button_url . '" class="som-2col-bot-r">' . $bottom_right_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; }
                          if (!empty($bottom_sponsors)) { echo '<div class="som-2col-bottom_sponsors">' . $bottom_sponsors . '</div>'; }

            echo '      </div>';

          elseif( $image_placement == 'Right' ):

            echo '<div class="som-2col-img-r" style="background: url(' . $image["url"] . ') no-repeat center center;"></div>    
                    <div class="">
                      <div class="row">
                        <div class="col-sm-6 som-2col-txt">';

                          if (!empty($top_left_blue_text)) { echo '<span class="som-2col-top-l">' . $top_left_blue_text . '</span>'; }
                          if (!empty($top_right_blue_text)) { echo '<span class="som-2col-top-r">' . $top_right_blue_text . '</span>'; }
                          echo '<div class="clearfix"></div>';
                          if (!empty($title)) { echo '<h3>' . $title . '</h3>'; }
                          if (!empty($column_1)) { echo '<div class="som-2col-wyswyg">' . $column_1 . '</div>'; }
                          if (!empty($bottom_left_cta_button_text)) { echo '<a href="' . $bottom_left_cta_button_url . '" class="som-2col-bot-l">' . $bottom_left_cta_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; }
                          if (!empty($bottom_right_button_text)) { echo '<a href="' . $bottom_right_cta_button_url . '" class="som-2col-bot-r">' . $bottom_right_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; }
                          if (!empty($bottom_sponsors)) { echo '<div class="som-2col-bottom_sponsors">' . $bottom_sponsors . '</div>'; }

            echo '      </div>';

          endif;

          echo '    <div class="clearfix"></div> 
                    </div>
                  </div>
                </section>';

        endif;





      // SUMMER READS
      elseif( get_row_layout() == 'summer_reads' ): 

        $activeinactive = get_sub_field('activeinactive');
        if( $activeinactive == 'Active' ):

          $background_image = get_sub_field('background_image');
          $top_cta_text = get_sub_field('top_cta_text');
          $title = get_sub_field('title');
          $sub_title_text = get_sub_field('sub_title_text');
          $wysiwyg_editor = get_sub_field('wysiwyg_editor');

          echo '<section class="som-summer-reads" style="background: url(' . $background_image["url"] . ') no-repeat center center;">
                  <div class="container">
                    <div class="row">
                      <div class="col-xs-12 col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3 text-center">';

          if (!empty($top_cta_text)){
            echo '      <h3>' . $top_cta_text . '</h3>';
          }

          if (!empty($title)){
            echo '      <h2>' . $title . '</h2>';
          }

          if (!empty($sub_title_text)){
            echo '      <p>' . $sub_title_text . '</p>';
          }

          if (!empty($wysiwyg_editor)){
            echo '      <div class="som-sr-wysiwyg">' . $wysiwyg_editor . '</h2>';
          }

          echo '      </div>
                    </div>
                  </div>
                </section>';

        endif;






      // RECENT POSTS
      elseif( get_row_layout() == 'post_feed' ): 

        $activeinactive = get_sub_field('activeinactive');
        if( $activeinactive == 'Active' ):

          $args = array(
            'tag' => 'summer-of-making',
            'numberposts' => 4, 
            'post_status' => 'publish' 
          );
          $recent_posts = wp_get_recent_posts( $args );

          echo '<section class="recent-post-panel"><div class="container">';

          if(get_sub_field('title')){
            echo '<div class="row padbottom text-center">
                    <div class="title-w-border-r">
                      <h2>' . get_sub_field('title') . '</h2>
                    </div>
                  </div>';
          }

          echo '<div class="row">';

          foreach( $recent_posts as $recent ){
            echo '<div class="recent-post-post col-xs-12 col-sm-3">
                    <article class="recent-post-inner">
                      <a href="' . get_permalink($recent["ID"]) . '">';
                      if ( get_the_post_thumbnail($recent['ID']) != '' ) {
                        $thumb_id = get_post_thumbnail_id($recent['ID']);
                        $url = wp_get_attachment_url($thumb_id);
                        echo "<div class='recent-post-img' style='background-image: url(" . $url . ");'></div>";
                      }

            echo  '     <div class="recent-post-text">
                          <h4>' . $recent["post_title"] . '</h4>
                          <p class="recent-post-date">' . mysql2date('M j, Y',  $recent["post_date"]) . '</p>
                          <p class="recent-post-descripton">' . substr(wp_strip_all_tags($recent["post_content"]), 0 , 150) . '</p>
                        </div>
                      </a>
                    </article>
                  </div>';
          }

          // echo '<div class="col-xs-12 padtop padbottom text-center">
          //         <a class="btn-cyan" href="/blog">More News</a>
          //       </div>';

          echo '</div></div></section>';

        endif;





      // 1 COLUMN TINT FEED
      elseif( get_row_layout() == 'tint_feed' ): 

        $activeinactive = get_sub_field('activeinactive');
        if( $activeinactive == 'Active' ):

          $column_1 = get_sub_field('column_1');

          echo '<section class="com-tint">
                  <div class="">';

          if(get_sub_field('title')){
            echo '  <div class="row">
                      <div class="col-xs-12 text-center padbottom">
                        <h3>' . get_sub_field('title') . '</h3>
                      </div>
                    </div>';
          }

          echo '    <div class="row">
                      <div class="col-xs-12">' . $column_1 . '</div>
                    </div>';

          echo '  </div>
                  <div class="flag-banner"></div>
                </section>';

        endif;




      // 3 Column Images
      elseif( get_row_layout() == '3_column_images' ):

        $panel_title = get_sub_field('panel_title');
        $left_image = get_sub_field('left_image');
        $left_image_url = get_sub_field('left_image_url');
        $middle_image = get_sub_field('middle_image');
        $middle_image_url = get_sub_field('middle_image_url');
        ?>

          <aside class="fom-panel">
            <div class="container">

              <?php if(!empty($panel_title)){
                echo '  <div class="row">
                          <div class="col-xs-12 text-center padbottom">
                            <h2>' . $panel_title . '</h2>
                          </div>
                        </div>';
              } ?>

              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-4 text-center">
                  <?php if (!empty($left_image_url)) { echo '<a href="' . $left_image_url . '">'; } ?>
                    <img src="<?php echo $left_image['url']; ?>" alt="<?php echo $left_image['alt']; ?>" class="img-responsive" />
                  <?php if (!empty($left_image_url)) { echo '</a>'; } ?>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 text-center">
                  <?php if (!empty($middle_image_url)) { echo '<a href="' . $middle_image_url . '">'; } ?>
                    <img src="<?php echo $middle_image['url']; ?>" alt="<?php echo $middle_image['alt']; ?>" class="img-responsive" />
                  <?php if (!empty($middle_image_url)) { echo '</a>'; } ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 text-center house-ad">

                  <!-- ad goes here -->

                </div>
              </div>
            </div>
          </aside> <?php





    // NEWSLETTER PANEL
    elseif( get_row_layout() == 'newsletter_panel' ):

      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active' ): ?>

        <section class="newsletter-panel">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <h4>Stay in the Loop</h4>
                <p>Interesting projects and events to your inbox weekly.</p>
              </div>
              <div class="col-xs-12 col-sm-6">
                <form class="form-inline sub-form whatcounts-signup1" action="http://whatcounts.com/bin/listctrl" method="POST">
                  <input type="hidden" name="slid_1" value="6B5869DC547D3D46B52F3516A785F101" /><!-- Make: Newsletter -->
                  <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
                  <input type="hidden" name="multiadd" value="1" />
                  <input type="hidden" name="cmd" value="subscribe" />
                  <input type="hidden" name="custom_source" value="Summer of Making" />
                  <input type="hidden" name="custom_incentive" value="none" />
                  <input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
                  <input type="hidden" id="format_mime" name="format" value="mime" />
                  <input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
                  <input id="wc-email" class="form-control nl-panel-input" name="email" placeholder="Email Address" required type="email">
                  <input class="btn-cyan" value="Yes Please" type="submit">
                </form>
              </div>
            </div>
          </div>
        </section>

        <div class="fancybox-thx" style="display:none;">
          <div class="col-sm-4 hidden-xs nl-modal">
            <span class="fa-stack fa-4x">
            <i class="fa fa-circle-thin fa-stack-2x"></i>
            <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
            </span>
          </div>
          <div class="col-sm-8 col-xs-12 nl-modal">
            <h3>Awesome!</h3>
            <p>Thanks for signing up.</p>
          </div>
          <div class="clearfix"></div>
        </div>
      <?php endif;




      endif; //End flex content. Get row layout.

    endwhile;

  else :

  ?><!-- no layout found--><?php

  endif; ?>

</div>

<?php get_footer(); ?>