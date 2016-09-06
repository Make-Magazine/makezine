<?php
/**
 * The Product Review Loop Item
 */
?>
<div class="reviews-item clearfix reviews-model">

		<div class="ri-feature-image">
			<a class="ri-link" href="<?php the_permalink(); ?>">
				<div class="ri-badge boards"></div>
			</a>
		</div>

		<div class="ri-details">
			<a class="ri-link" href="<?php the_permalink(); ?>">
				<h2 class="ri-item-title"></h2>
			</a>
			<div class="ri-type"></div>
			<div class="ri-item-meta"><span>AWARDS: </span></div>
		</div>

		<div class="ri-score-price">
			<div class="ri-score-price-flex">
				<div class="ri-score">
					<span></span>
				</div>
				<div class="ri-price">
					<span></span>
				</div>
				<div class="ri-more-info">
					<a class="ri-link" href="<?php the_permalink(); ?>">More Info <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</div>
				<div class="ri-buy-now">
					<a class="btn btn-default" href="#" target="_blank">Buy Now</a>
				</div>
			</div>
		</div>

	</a>
</div><!-- .item -->
