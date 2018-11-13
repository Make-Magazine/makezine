<?php
/**
 * Single Product Review Content
 */

$slug = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( get_the_ID() );

?>

<div class="tc-container mz-body">

	<?php // Filters	
	get_template_part( 'reviews/content/header/filters/filters' );?>

	<section class="reviews-listings tc-content">

		<?php // Sort Bar
		get_template_part( 'reviews/content/header/sort/sort', $slug ); ?>

		<div class="reviews-items">


			<?php // Single Review Loop Item
			get_template_part( 'reviews/content/loop/reviews', $slug ); ?>


		</div>
		<!-- .items -->


		<div class="no-results">
			<h2>Shoot! None of these items exactly fit your wish list.</h2>

			<p>Checkout one of our Make: <span>Recommendations</span> for our picks.</p>
		</div>

	</section><!-- .reviews-listings -->
</div><!-- .tc-container -->
