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
                          <?php if (!empty($bottom_left_cta_button_text)) { echo '<a class="som-slider-link-left">' . $bottom_left_cta_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; } ?>
                          <?php if (!empty($bottom_right_button_text)) { echo '<a class="som-slider-link-right">' . $bottom_right_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; } ?>
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
                        <?php if (!empty($bottom_left_cta_button_text)) { echo '<a class="som-slider-link-left">' . $bottom_left_cta_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; } ?>
                        <?php if (!empty($bottom_right_button_text)) { echo '<a class="som-slider-link-right">' . $bottom_right_button_text . ' <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></a>'; } ?>
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
          $above_cta_button_url = get_sub_field('above_cta_button_url');
          $column_1 = get_sub_field('column_1');
          $below_cta_button_text = get_sub_field('below_cta_button_text');
          $below_cta_button_url = get_sub_field('below_cta_button_url');
          echo '<section class="content-panel">
                  <div class="container">';

          if(get_sub_field('above_cta_button_text')){
            echo '  <div class="row text-center som-column1-top-btn">
                      <a class="btn-bu-ghost" href="' . $above_cta_button_url . '">' . $above_cta_button_text . '</a>
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
      elseif( get_row_layout() == '2_column_photo_and_text_panel' ): 

        $activeinactive = get_sub_field('activeinactive');
        if( $activeinactive == 'Active' ):

          $column_1 = get_sub_field('column_1');
          $column_2 = get_sub_field('column_2');
          $cta_button = get_sub_field('cta_button');
          $cta_button_url = get_sub_field('cta_button_url');
          echo '<section class="content-panel">
                  <div class="container">';

          if(get_sub_field('title')){
            echo '  <div class="row">
                      <div class="col-xs-12 text-center padbottom">
                        <h2>' . get_sub_field('title') . '</h2>
                      </div>
                    </div>';
          }

          echo '    <div class="row">
                      <div class="col-sm-6">' . $column_1 . '</div>
                      <div class="col-sm-6">' . $column_2 . '</div>
                    </div>';

          if(get_sub_field('cta_button')){
            echo '  <div class="row text-center padtop">
                      <a class="btn btn-b-ghost" href="' . $cta_button_url . '">' . $cta_button . '</a>
                    </div>';
          }

          echo '  </div>
                </section>';

        endif;





      // RECENT POSTS
      elseif( get_row_layout() == 'post_feed' ): 

        $activeinactive = get_sub_field('activeinactive');
        if( $activeinactive == 'Active' ):

          $args = array( 'numberposts' => 4, 'post_status' => 'publish' );
          $recent_posts = wp_get_recent_posts( $args );

          // Get the blog template page ID
          $news_pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'blog.php'
          ));
          foreach($news_pages as $news_page){
            $news_ID = $news_page->ID;
          }
          $news_slug = get_post( $news_ID )->post_name;

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

          echo '<div class="col-xs-12 padtop padbottom text-center">
                  <a class="btn-cyan" href="/blog">More News</a>
                </div>';

          echo '</div></div></section>';

        endif;





    // NEWSLETTER PANEL
    elseif( get_row_layout() == 'newsletter_panel' ):

      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active' ): ?>

        <section class="newsletter-panel">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <p><strong>Stay in Touch:</strong> Get Local and Global Maker Faire Community updates.</p>
              </div>
              <div class="col-xs-12 col-sm-6">
                <form class="form-inline sub-form whatcounts-signup1" action="http://whatcounts.com/bin/listctrl" method="POST">
                  <input type="hidden" name="slid_1" value="6B5869DC547D3D46E66DEF1987C64E7A" /><!-- Maker Faire Newsletter -->
                  <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
                  <input type="hidden" name="multiadd" value="1" />
                  <input type="hidden" name="cmd" value="subscribe" />
                  <input type="hidden" name="custom_source" value="footer" />
                  <input type="hidden" name="custom_incentive" value="none" />
                  <input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
                  <input type="hidden" id="format_mime" name="format" value="mime" />
                  <input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
                  <input id="wc-email" class="form-control nl-panel-input" name="email" placeholder="Enter your Email" required type="email">
                  <input class="form-control btn-w-ghost" value="GO" type="submit">
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

        <script>
          jQuery(document).ready(function(){
            jQuery(".fancybox-thx").fancybox({
              autoSize : false,
              width  : 400,
              autoHeight : true,
              padding : 0,
              afterLoad   : function() {
                this.content = this.content.html();
              }
            });
            jQuery(document).on('submit', '.whatcounts-signup1', function (e) {
              e.preventDefault();
              var bla = jQuery('#wc-email').val();
              globalNewsletterSignup(bla);
              jQuery.post('http://whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup1').serialize());
              jQuery('.fancybox-thx').trigger('click');
              //jQuery('.nl-modal-email-address').text(bla);
              //jQuery('.whatcounts-signup2 #email').val(bla);
            });
          });
        </script>
      <?php endif;




      endif; //End flex content. Get row layout.

    endwhile;

  else :

  ?><!-- no layout found--><?php

  endif; ?>

</div>

<?php get_footer(); ?>