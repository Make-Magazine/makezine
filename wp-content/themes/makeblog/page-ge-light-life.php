<?php

/**
 * Template Name: GE Light Life Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Rich Haynie
 * 
 */
get_header('universal'); ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile;
endif;
?>

<?php get_footer(); ?>