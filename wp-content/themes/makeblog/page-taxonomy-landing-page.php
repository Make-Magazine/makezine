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
	   
		<div class="container">
         <div class="row">
				<div class="col-xs-12">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
			<div class="row">

				<div class="col-xs-12">
					<h3>What are you looking for?</h3>
					<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			
					<div class="tool-guide-header">
						<?php
						  $image = get_stylesheet_directory_uri() . '/img/tool-guide-default.jpg';
						  $name = "What's that guide?";
						  $count = 0;
						  
						  $terms = get_the_terms($post->ID, 'product-categories');
						  foreach ($terms as $term) {
							 $termsPlus = apply_filters( 'taxonomy-images-get-terms', '', array('taxonomy' => 'product-categories', 'term_args' => array( 'slug' => $term->slug,)) );
							 var_dump($images);
							 $image = wp_get_attachment_image_src($termsPlus[0]->image_id);
							 $name = $termsPlus[0]->name;
							 $count = $termsPlus[0]->count - 1;
						  }
						?>
						<h4><a href="<?php the_permalink(); ?>"><?php echo($name); ?> (<?php echo($count); ?>)</a></h4>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo($image[0]); ?>" /> </a>
						
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