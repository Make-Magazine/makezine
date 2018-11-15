<?php
/**
 * Template Name: Toolguide Landing Page
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

				<div class="col-xs-12 grid-wrapper">
					<h3>What are you looking for?</h3>
					<div class="tool-guide-grid">
					   <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
						<?php
						  $image = get_stylesheet_directory_uri() . '/img/tool-guide-default.jpg';
						  $name = "If you're getting an error hear, make sure the Comparison page has the right product category tag";
						  $count = 0;
						  
						  $terms = get_the_terms($post->ID, 'product-categories');
						  foreach ($terms as $term) {
							 if(isset($term)) {
								 $termsPlus = apply_filters( 'taxonomy-images-get-terms', '', array('taxonomy' => 'product-categories', 'term_args' => array( 'slug' => $term->slug,)) );
								 $image = wp_get_attachment_image_src($termsPlus[0]->image_id);
								 $name = $termsPlus[0]->name;
								 $count = $termsPlus[0]->count - 1;
							 }
						  }
						?>
						<div class="tool-guide-item">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo($image[0]); ?>" /> </a>
							<h4><a href="<?php the_permalink(); ?>"><?php echo($name); ?> (<?php echo($count); ?>)</a></h4>
						</div>
					
					  <?php endwhile; ?>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
					
			</div>				</div>

		</div>

	</div>

<?php get_footer(); ?>