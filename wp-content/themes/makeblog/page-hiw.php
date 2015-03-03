<?php
/**
 * Template Name: HIW Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Bill Olson <bolson@makermedia.com>
 * 
 */
?>

<?php get_header('hiw'); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">	

				<?php get_sidebar('hiw-left'); ?>
		
				<div class="span7">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
					<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>
					
					<?php endwhile; ?>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div> <!-- END span8 -->	

									<?php get_sidebar('hiw-right'); ?>
					
			</div> <!-- END row -->	

		</div> <!-- END container -->	

	</div> <!-- END single -->	

<?php get_footer('hiw'); ?>