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
?>

<div class="">
   <div class="hero-header">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 title-image-block">
<?php 
if (have_posts()) {
   while (have_posts()) {
      the_post();
      //the_content();
      $page_title_text = get_field('page_title_text');
      $page_title_image = get_field('page_title_image');
      $page_subtitle_text = get_field('page_subtitle_text');
      $page_header_intro_text = get_field('page_header_intro_text');
      $page_header_hero_image = get_field('page_header_hero_image');
      echo '<div class="page-title" style="background-image: url('.$page_title_image.');"><h2>'.$page_title_text.'</h2></div>';
      echo '<h3 class="hero-subtitle">'.$page_subtitle_text.'</h3>';
      echo '<div class="header-intro-text">'.$page_header_intro_text.'</div>';
      echo '<div class="hero-image"><img src="'.$page_header_hero_image.'" /></div>';
   }
?>
<?php 
} else {
?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php 
};
?>
            </div>
         </div>
      </div>
   </div>
   <div id="gift-guide-container"></div>
</div>

<?php get_footer(); ?>