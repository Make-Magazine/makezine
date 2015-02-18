<?php
/**
 * Template Name: Maker Camp Template
 * Nothing fancy but a template holder... Add all content via the post editor.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
?>
<?php get_header( 'makercamp' ); ?>
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="main-content">
			<?php the_content(); ?>
	<?php endwhile; endif; ?>
<?php get_footer( 'makercamp' ); ?>