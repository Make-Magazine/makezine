<?php
/**
 * Template Name: Gift Guide General
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Rich Haynie
 * 
 */
get_header('universal');
?>

<div style="padding:0px" class="single">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile;
else: ?>

    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>
   
   <div id="gift-guide-container"></div>

</div>



<?php get_footer(); ?>