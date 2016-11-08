<?php
/**
 * Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
get_header('version-2'); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="col-xs-12">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
					<div class="projects-masthead">
						
						<h1><?php the_title(); ?></h1>
						
					</div>
		
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="col-sm-7 col-md-8">
				
					<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>
					
					<?php endwhile; ?>
					<div class="comments">
						<?php comments_template(); ?>
					</div>
					<div id="contextly"></div>
					
					<?php endif; ?>
				</div>
				
				<?php get_sidebar(); ?>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>