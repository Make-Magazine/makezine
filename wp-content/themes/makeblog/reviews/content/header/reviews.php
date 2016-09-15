<?php
/**
 * The Reviews Section Header
 */

// Get the correct comaprison post ID
$id        = get_the_ID();
$container = Reviews()->container();

if ( is_singular( \Reviews\Architecture\Post_Types\Products::NAME ) ) {
	$review = $container['Relationships']->get_review_for_product( get_the_ID() );
	if ( count( $review ) > 0 ) {
		$id = $review[0]->ID;
	}
}

$modal_image    = get_field( 'magazine_thumbnail', $id );
$modal_text     = get_field( 'magazine_label', $id );
$slug  = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( $id );

?>
<div class="row">
	<header class="reviews-header col-xs-12">

		<h1 class="review-title"><?php echo get_the_title( $id ); ?></h1>

		<nav class="review-nav">

			<?php if ( $modal_image ): ?>
				<div class="review-nav-mag">
					<button id="modal-capture-btn" class="modal-capture-btn class-<?php 
					$catslug = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( $id );
					echo $catslug;
					?>">
						<img alt="Review guide featured image" src="<?php echo esc_attr( $modal_image['sizes'][ 'p1' ] ); ?>" />
						<?php echo $modal_text; ?>
					</button>
				</div>
			<?php endif; ?>

			<div class="review-nav-choosing" <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_how_we_test() ) { ?> class="active"  <?php } ?> >

				<a <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_review() ) { ?> class="active"  <?php } ?> href="<?php echo get_permalink( $id ); ?>">
					Compare <?php echo $slug; ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
				</a>

				<a href="<?php echo \Reviews\Architecture\Post_Types\Reviews::get_how_we_test_link( $id ); ?>">
					<?php
					if ( $slug === 'boards' ) {
						$choosing_a_cat = 'How to Choose <i class="fa fa-angle-right" aria-hidden="true"></i>';
					}
          elseif ( $slug === 'drones' ) {
						$choosing_a_cat = 'How We Test <i class="fa fa-angle-right" aria-hidden="true"></i>';
					}
          elseif ( $slug === 'printers' ) {
						$choosing_a_cat = 'How We Test <i class="fa fa-angle-right" aria-hidden="true"></i>';
					}
					echo $choosing_a_cat;
					?>
				</a>

				<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( $id ) ) {
          if ( $slug === 'drones' ) {
						$scoring = 'Drone Scoring';
					}
          elseif ( $slug === 'printers' ) {
						$scoring = '3D Printer Scoring';
					} ?>
					<a href="<?php echo \Reviews\Architecture\Post_Types\Reviews::get_scores_link( $id ); ?>"><?php echo $scoring; ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				<?php } ?>

				<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_review() ): ?>
					<button id="show-filters-btn" type="button" class="show-filters-btn visible-xs-inline-block" aria-haspopup="true" aria-expanded="false">Filter</button>
				<?php endif; ?>
			</div>
			

			<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_review() ): ?>
<!-- 				<div class="review-nav-btns visible-xs-block">
					<button id="show-filters-btn" type="button" class="show-filters-btn btn btn-default" aria-haspopup="true" aria-expanded="false">Filter & Sort</button>
					<button id="show-sort-btn" type="button" class="show-sort-btn btn btn-default" aria-haspopup="true" aria-expanded="false">Sort</button>
				</div> -->
			<?php endif; ?>

		</nav>
	</header>
</div>