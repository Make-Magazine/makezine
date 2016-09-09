<?php
/**
 * The Product Review Loop Item
 */
$buy_link = get_field( 'buy_link', $id );
?>
<div class="reviews-item clearfix reviews-model">

		<div class="ri-feature-image">
			<a class="ri-link" href="<?php the_permalink(); ?>">
				<div class="ri-badge boards"></div>
			</a>
		</div>

		<div class="ri-info-parent">

			<div class="ri-details">
				<a class="ri-link" href="<?php the_permalink(); ?>">
					<h2 class="ri-item-title"></h2>
				</a>
				<div class="ri-type"></div>
				<div class="ri-item-meta"><span>AWARDS: </span></div>
			</div>

			<div class="ri-score-price">
				<div class="ri-score-price-flex">
					<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( get_the_ID() ) ) : ?>
					<div class="ri-score">
						<span></span>
						<small class="visible-xs-block">Score</small>
					</div>
					<?php endif; ?>
					<div class="ri-price">
						<span></span>
						<small class="visible-xs-block">Price</small>
					</div>
					<div class="ri-more-info">
						<a class="ri-link" href="<?php the_permalink(); ?>">More Info <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
					<div class="ri-buy-now" style="display:none;">
						<a class="btn btn-default" href="#" target="_blank">Buy Now</a>
					</div>
				</div>
			</div>

		</div>

	</a>
</div><!-- .item -->
