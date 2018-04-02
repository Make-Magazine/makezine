<?php
/**
 * Single Reviews Template
 *
 */
get_header( 'version-2' );
?>

<?php // Reviews Section Header
get_template_part( 'reviews/content/header/ads-leaderboard' ); ?>

<main class="container">

	<?php // Reviews Section Header

	$slug = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( get_the_ID() );

	get_template_part( 'reviews/content/header/reviews' );

	?>

	<div class="row">

		<?php // Reviews Content
		get_template_part( 'reviews/content/single/reviews' ); ?>

		<?php // Reviews Section Sidebar
		get_template_part( 'reviews/content/sidebar/reviews' ); ?>

	</div>
	<!-- .div -->

</main><!-- .container -->

<?php get_footer(); ?>
