<?php
/**
 * Reviews Sidebar Content
 */

$how_scoring_works  = get_field( 'how_scoring_works' );
?>
<aside class="reviews-sidebar tc-sidebar">

	<div class="meta-block ad-1">
		<?php global $make; print $make->ads->ad_300x250_atf; ?>
	</div><!-- .meta-block.ad-1 -->

	<?php if ( ! empty( $how_scoring_works ) ): ?>
	<div class="meta-block how-scoring-works">
		<h4>How Scoring Works</h4>
		<div class="hsw-content">
			<?php echo $how_scoring_works; ?>
		</div>
	</div>
	<?php endif; ?>

	<div class="meta-block ad-2 desktop">
		<?php global $make; print $make->ads->ad_300x600; ?>
	</div><!-- .meta-block.ad-2 -->

</aside><!-- .reviews-sidebar -->
