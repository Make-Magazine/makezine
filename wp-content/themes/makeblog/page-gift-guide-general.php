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

<div>
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
<?php 
if (have_posts()) {
   while (have_posts()) {
      the_post();
      //the_content(); 
      $page_title_text = get_field('page_title_text');
      $page_header_intro = get_field('page_header_intro');
      echo '<h1>'.$page_title_text.'</h1>';
      echo '<p>'.$page_header_intro.'</p>';
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
   <div id="gift-guide-container"></div>
</div>

<?php get_footer(); ?>