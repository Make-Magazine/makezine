
<?php

/*
Template Name: Sprout Takeover
*/

// Get ad object.

get_header( 'version-2' );

?>

<div class="container"> 
  
  <div class="row"><h1>SPROUT BY HP</h1></div>

  <div class="row"><img src="<?php echo get_template_directory_uri(); ?>/images/sproutBanner.jpg" alt="Sprout Banner" class="img-responsive" width="100%" /></div>
  
  <?php
  $args=array(
      'tag' => 'sprout-by-hp',
      'showposts' => 10,
    );
  $postslist = get_posts( $args );
  $count = 0;
  ?>
  <?php $output .= '<div class="row home-sprout-row">'; ?>
  <?php foreach ($postslist as $post) :  setup_postdata($post); ?>
  <?php if (($count >= 0 && $count < 2) || ($count > 2 && $count < 6)) {
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $thumbnail_object = wp_get_attachment_image_src($thumbnail_id);
        $output .= '<div class="col-sm-4 col-md-4">';
        $output .= '<div class="hp-story">';
        $output .= '<a href="'.get_permalink( $post->ID ).'" alt="HP Sprout">';
        $output .= '<img src="'.get_resized_remote_image_url($thumbnail_object[0],555,360).'" height="240" width="100%" alt="" class="img-responsive">';
        $output .= '</a>';
        $output .= '<div class="hp-story-title">';
        $output .= '<a href="'.get_permalink( $post->ID ).'" alt="">'.$post->post_title.'</a>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
      }

        elseif ( $count == 2 ) {
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $thumbnail_object = wp_get_attachment_image_src($thumbnail_id);
        $output .= '<div class="col-sm-4 col-md-4">';
        $output .= '<div class="hp-story">';
        $output .= $make->ads->square;
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="row home-sprout-row">';
      }

  ?>

  <?php $count++; ?>
  <?php endforeach; ?>
  <?php $output .= '</div>' ?>
  <?php echo $output; ?>

  <!-- HP Items Feed -->
  <?php echo make_shopify_featured_products_slider_sprout( 'row-fluid' ); ?>

  <div class="row home-sprout-row">
    
    <?php echo do_shortcode( '[youtube-modal "wnnWrLt_RCo"]' ); ?>
    <?php echo do_shortcode( '[youtube-modal "wnnWrLt_RCo"]' ); ?>
    <?php echo do_shortcode( '[youtube-modal "wnnWrLt_RCo"]' ); ?>

  </div><!-- end sprout-video-row -->

  <div class="row home-sprout-row">
    
    <div class="col-sm-4 col-md-4">
    
      <div class="sprout-social-headline">
        <img src="<?php echo get_template_directory_uri(); ?>/images/twitter-icon.png" alt="Twitter" class="sprout-social-icon" />
      </div>
      <div class="sprout-social-hashtag-twitter"><p>#sproutbyhp</p></div>

      <div class="sprout-social-twitter">
        <a class="twitter-timeline" href="https://twitter.com/hashtag/sproutbyhp" data-widget-id="632328929018167296">#sproutbyhp Tweets</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      </div>
    
    </div>
  
    <div class="col-md-8">
  
      <div class="sprout-social-headline sprout-social-headline-ig">
        <img src="<?php echo get_template_directory_uri(); ?>/images/instagram-icon.png" alt="Instagram" class="sprout-social-icon" />
        <div class="sprout-social-hashtag-ig"><p>Instagram, #sproutbyhp</p></div>
      </div>
      <div class="sprout-social-ig"><?php echo do_shortcode( '[show_instagram]' ); ?></div>
    
    </div>

  </div>

</div>

<?php get_footer(); ?>