<?php

/**
 * Template Name: GE Light Life Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Rich Haynie
 * 
 */
get_header('version-2');
 wp_register_style('et-googleFonts', 'http://fonts.googleapis.com/css?family=Roboto:300');
  wp_register_style('et-googleFonts', 'http://fonts.googleapis.com/css?family=Roboto+Slab:700');
  wp_enqueue_style('et-googleFonts');
  wp_enqueue_style('ge-light-life', get_stylesheet_directory_uri() . '/css/ge-light-for-life.css',array(), '2.7.8' );


?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile;
endif;
?>

<?php get_footer(); ?>