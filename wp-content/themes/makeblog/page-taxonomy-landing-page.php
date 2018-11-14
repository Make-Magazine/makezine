<?php
/**
 * Template Name: Taxonomy Landing Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Rio Roth-Barreiro <rio@makermedia.com>
 * Takes in one select for the type of taxonomy to display and then spits out a list
 */
 
$args = array( 
'orderby' => 'title',
'post_type' => 'reviews',
);
$the_query = new WP_Query( $args );


get_header('universal'); ?>
		
	<div class="tool-guide">
	   <h1><?php the_title(); ?></h1>
		<div class="container">

			<div class="row">

				<div class="col-xs-12">
					<h3>What are you looking for?</h3>
					<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			
					<div class="tool-guide-header">
						<?php
						  var_dump($post->ID);
						  $termID = [];
						  $terms = get_the_terms($post->ID, 'product-categories');
						  var_dump($terms);
						  foreach ($terms as $term) {
    						 $termID[] = $term->term_id;
						  }
						  var_dump($termID);
						?>
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
					</div>
		
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="col-md-8">
				
					<article <?php post_class( 'row' ); ?>>

						<?php the_content(); ?>
						
					</article>
					
					<?php endwhile; ?>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>