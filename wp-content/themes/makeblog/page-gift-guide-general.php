<?php
/**
 * Template Name: Gift Guide General
 *
 * @package    makeblog
 * @license    
 * @author     Maker Media
 * 
 */
get_header('universal');

if (have_posts()) {
   while (have_posts()) {
      the_post();
      //the_content();
      $page_title_text = get_field('page_title_text');
      $page_title_image = get_field('page_title_image');
      $page_subtitle_text = get_field('page_subtitle_text');
      $page_header_intro_text = get_field('page_header_intro_text');
      $page_header_hero_image = get_field('page_header_hero_image');
      $page_header_sponsor_tag_text = get_field('page_header_sponsor_tag_text');
      $page_header_sponsor_tag_image = get_field('page_header_sponsor_tag_image');
      $ad_frequency = get_field('ad_frequency');
   }
} else {
   _e('Sorry, no posts matched your criteria.');
}

?>

<div class="gift-guide-container" data-ad-freq="<?php echo $ad_frequency; ?>">
   <a class="social-buttons" data-sumome-share-id=66063407-7e20-418b-a8eb-03e9d38886be></a>
   <div class="hero-header">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 title-image-block">
               <!-- TODO (ts): Ad goes here -->
               <div class="gg-header-ad"><div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="atf"></div></div>
               <!-- <div class="page-title" style="background-image: url('<?php echo $page_title_image; ?>');background-size: contain;"><h2><?php echo $page_title_text; ?></h2></div> -->
               <h3 class="hero-subtitle"><?php echo $page_subtitle_text; ?></h3>
               <div class="header-intro-text"><?php echo $page_header_intro_text; ?></div>
            </div>
         </div>
      </div>
   </div>
   <div class="hero-image-container">
      <div class="page-header-sponsor-tag hidden-lg hidden-xl"><img src="<?php echo $page_header_sponsor_tag_image;?>" alt="<?php echo $page_header_sponsor_tag_text;?>"></div>
      <div class="hero-image hidden-md hidden-sm hidden-xs"><img src="<?php echo $page_header_hero_image; ?>" /></div>
   </div>
   <div id="gift-guide-temp"><h2 class="initial-loading-indicator" style="text-align: center;">Loading... <i class="fa fa-spinner"></i></h2></div>
   <div class="gg-footer-ad"><div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="btf"></div></div>
</div>

<?php get_footer(); ?>