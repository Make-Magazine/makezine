<?php
/**
 * The Product Review Loop Item
 */
?>
<div class="reviews-item clearfix reviews-model">
	<a class="ri-link clearfix" href="<?php the_permalink(); ?>">

		<div class="ri-feature-image ri-cell">

		</div>

		<div class="ri-details ri-cell">
			<h2 class="ri-item-title"></h2>
		</div>

		<div class="ri-price ri-cell">
			<span class="price"></span>
			<small>Price</small>
		</div><!-- .item-price -->

		<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( get_the_ID() ) ) : ?>
			<div class="ri-score ri-cell">
				<span class="score"></span>
				<small>Score</small>
			</div>
		<?php endif; ?>

		<div class="ri-badge ri-cell hidden-xs"></div>

		<div class="ri-item-meta"></div>

	</a>
</div><!-- .item -->
