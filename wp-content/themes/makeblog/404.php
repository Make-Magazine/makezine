
<?php

/*
Template Name: 404
*/

get_header( 'version-2' );

?>

<div class="container">
  <div class="row sprout-sponsored-row"><h2 class="sponsored">SPROUT BY HP</h2><p class="sponsored">sponsored</p></div>
  <div class="row"><img src="<?php echo get_template_directory_uri(); ?>/images/sproutBanner.jpg" alt="Sprout Banner" class="img-responsive" width="100%" /></div>
</div>
<div class="all-projects <?php echo $device ?> all-projects-sprout">
  <div class="content container">
    <div class="posts-list container">
      <?php sorting_posts_sprout(); //TODO Rename Function ?>  
    </div>
  </div>
  <div id="temp_post_list" style="display: none"></div>
</div>
<div class="container sprout-shed-container"> 
  <div class="row product-row">
  <!-- HP Items Feed -->
  <?php echo make_shopify_featured_products_slider_sprout( 'row-fluid' ); ?>
  </div>
</div>  
<div class="container sprout-container">
  <div class="sprout-margins">
    <div class="row post_row home-sprout-row"> 
      <div class="post col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="sprout-video">
            <a class="fancytube fancybox.iframe" href="http://www.youtube.com/embed/W3zJCG_JtfI?autoplay=1">
              <img class="img-responsive" src="http://img.youtube.com/vi/W3zJCG_JtfI/mqdefault.jpg" alt="MakerCon Conference Videos" height="180" width="100%" />
              <img class="yt-play-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-btn.png" alt="Youtube overlay play button" />
            </a>
        <p class="sprout-video-caption">3D Capture Stage is a special turntable that allows true 3d scanning using 3d Object Capture.</p>
        </div>
      </div>
      <div class="post col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="sprout-video">
            <a class="fancytube fancybox.iframe" href="http://www.youtube.com/embed/HyWn4_22cN8?autoplay=1">
              <img class="img-responsive" src="http://img.youtube.com/vi/HyWn4_22cN8/mqdefault.jpg" alt="MakerCon Conference Videos" height="180" width="100%" />
              <img class="yt-play-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-btn.png" alt="Youtube overlay play button" />
            </a>
            <p class="sprout-video-caption">Our edit team checks in with the Sprout team to see how the platform is inspiring makers to learn and create.</p>
        </div>
      </div>
      <div class="post col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="sprout-video">
            <a class="fancytube fancybox.iframe" href="http://www.youtube.com/embed/wYP_UIBQExk?autoplay=1">
              <img class="img-responsive" src="http://img.youtube.com/vi/wYP_UIBQExk/mqdefault.jpg" alt="MakerCon Conference Videos" height="180" width="100%" />
              <img class="yt-play-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-btn.png" alt="Youtube overlay play button" />
            </a>
            <p class="sprout-video-caption">Designers and developers describe their first experiences with the Sprout and its potential to transform the way digital media is created.</p>
        </div>
      </div>       
    </div><!-- end sprout-video-row -->
    <div class="row post_row home-sprout-row"> 
      <div class="post col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="sprout-video">
            <a class="fancytube fancybox.iframe" href="http://www.youtube.com/embed/re7xpfUuCXE?autoplay=1">
              <img class="img-responsive" src="http://img.youtube.com/vi/re7xpfUuCXE/mqdefault.jpg" alt="MakerCon Conference Videos" height="180" width="100%" />
              <img class="yt-play-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-btn.png" alt="Youtube overlay play button" />
            </a>
        <p class="sprout-video-caption">The story of how Sprout by HP was used to create a one-of-a-kind cast cover and made a young boy feel like a superhero.</p>
        </div>
      </div>
      <div class="post col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="sprout-video">
            <a class="fancytube fancybox.iframe" href="http://www.youtube.com/embed/Tw5v00RAqow?autoplay=1">
              <img class="img-responsive" src="http://img.youtube.com/vi/Tw5v00RAqow/mqdefault.jpg" alt="MakerCon Conference Videos" height="180" width="100%" />
              <img class="yt-play-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-btn.png" alt="Youtube overlay play button" />
            </a>
            <p class="sprout-video-caption">HP's Sprout division and Dremel move toward a full-cycle approach to 3D printing and scanning.</p>
        </div>
      </div>
      <div class="post col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="sprout-video">
            <a class="fancytube fancybox.iframe" href="http://www.youtube.com/embed/icKZ_ND9p0Q?autoplay=1">
              <img class="img-responsive" src="http://img.youtube.com/vi/icKZ_ND9p0Q/mqdefault.jpg" alt="MakerCon Conference Videos" height="180" width="100%" />
              <img class="yt-play-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-btn.png" alt="Youtube overlay play button" />
            </a>
            <p class="sprout-video-caption">Sprout is an all-new computer interface that embraces creativity and accessibility. The creator, Brad Short, gives a feature tour.</p>
        </div>
      </div> 
    </div><!-- end sprout-video-row -->
  </div>
</div>

<div class="container sprout-instagram-container">
  <div class="sprout-margins sprout-margins-instagram">
    <div class="row home-sprout-row">
      <?php echo do_shortcode( '[show_twitter_instagram]' ); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>