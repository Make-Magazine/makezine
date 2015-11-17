<?php
/**
 * Single Reviews Template
 *
 */
get_header('version-2');
?>

<div class="header-ad">
	<li class="post col-lg-4 col-md-4 col-sm-6 col-xs-12 own_ads">
		<div class="own">
			<div class="home-ads">
				<?php global $make; print $make->ads->leaderboard; ?>
			</div>
		</div>
	</li>
</div><!-- .header-ad -->
	
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
