<?php
/**
 * Single Product Review Content
 */
?>

<div class="tc-container">
<section class="reviews-listings tc-content">


	<?php // Sort Bar
	get_template_part( 'reviews/content/header/reviews-sort' ); ?>

	<div class="reviews-items">


		<?php // Single Review Loop Item
		get_template_part( 'reviews/content/loop/reviews' ); ?>


	</div>
	<!-- .items -->


	<div class="no-results">
		<h2>Shoot! None of these printers exactly fit your wish list.</h2>

		<p>Checkout one of our Make: <span>Recommendations</span> for our picks.</p>
	</div>


</section><!-- .reviews-listings -->
</div><!-- .tc-container -->
