<?php
/**
 * Single Reviews Template
 *
 */
get_header('version-2');
?>

<?php // Reviews Section Header
get_template_part( 'reviews/content/header/ads-leaderboard' ); ?>
	
<main class="container">

	<?php // Reviews Section Header
	get_template_part( 'reviews/content/header/reviews' ); ?>

	<?php // Filter Bar
	get_template_part( 'reviews/content/header/reviews-filters' ); ?>

	<div class="row">

		<?php // Reviews Content
		get_template_part( 'reviews/content/single/reviews' ); ?>

		<?php // Reviews Section Sidebar
		get_template_part( 'reviews/content/sidebar/reviews' ); ?>

	</div><!-- .div -->

</main><!-- .container -->

<?php get_footer(); ?>
