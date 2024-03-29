<?php
/**
 * Template Name: Road to Maker Faire
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('universal'); ?>

	<div class="single mf-challenge">
	
		<div class="container">
			
			
			<div class="row">
				<div class="col-xs-12">
					
										
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
					<div class="projects-masthead">
						
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
					</div>
					
				</div>
			</div>
			

			<div class="row secondary-hdr">
				
				<div class="col-md-8">
					
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/psocpioneer-hdr-01.png" alt="PSoC Pioneer Challenge" />
				</div>
				
				<div class="col-md-4 sidebar-ad">
					
					<?php if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) { 
							global $make; print $make->ads->ad_300x250_atf; 
						  } ?>

				</div>

			</div>
			
			<div class="row">
				
				<div class="col-xs-12">
					
				<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>
					
					<?php endwhile; ?>
					
					<?php else: ?>
					
						<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>	
				</div>
			</div>

		</div>

	</div>
	

<?php get_footer(); ?>
