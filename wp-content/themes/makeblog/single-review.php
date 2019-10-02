<?php
/**
 * Single Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
get_header('universal'); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="col-xs-12">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
					<div class="projects-masthead">
						
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
					</div>
					
					<ul class="projects-meta">
						<li>
							By <?php 
							if( function_exists( 'coauthors_posts_links' ) ) {	
								coauthors_posts_links(); 
							} else { 
								the_author_posts_link(); 
							} ?>
						</li>
						<li>
							<?php the_date('Y/m/d \@ g:i a'); ?>
						</li>
					</ul>
		
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="col-sm-7 col-md-8">
				
					<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>
					
					<?php endwhile; ?>
					

					<!--<div id="contextly"></div>-->
					
					<?php if (function_exists('make_featured_products')) { make_featured_products(); } ?>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<div class="comments">
					<?php comments_template(); ?>
					</div>					

					<?php endif; ?>
				</div>
				
				
				<?php get_sidebar(); ?>
					
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>
