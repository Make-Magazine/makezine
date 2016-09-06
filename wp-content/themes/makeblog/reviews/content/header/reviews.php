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

?>
<div class="row">
	<header class="reviews-header col-xs-12">

		<h1 class="review-title"><?php echo get_the_title( $id ); ?></h1>

		<nav class="review-nav">

			<div class="review-nav-choosing" <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_how_we_test() ) { ?> class="active"  <?php } ?> >
				<a href="<?php echo \Reviews\Architecture\Post_Types\Reviews::get_how_we_test_link( $id ); ?>">
					<?php
					$slug  = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( $id );
					$label = '<span>How We Tested <i class="fa fa-angle-right" aria-hidden="true"></i></span>';
					// if ( $slug === 'boards' ) {
					// 	$label = '<span>Choosing a Board:</span> How to Choose the Right One <i class="fa fa-angle-right" aria-hidden="true"></i>';
					// }
     //      elseif ( $slug === 'drones' ) {
					// 	$label = 'Choosing a Drone';
					// }

					echo $label;
					?>
				</a>

				<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( $id ) ) { ?>
					<a href="<?php echo \Reviews\Architecture\Post_Types\Reviews::get_scores_link( $id ); ?>"><span>Understanding Scores</span></a>
				<?php } ?>

			</div>


<!-- 				<li <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_review() ) { ?> class="active"  <?php } ?> >
				<a href="<?php echo get_permalink( $id ); ?>">Compare</a>
			</li> -->


			<!--
			<?php $products = $container['Relationships']->get_products_in_review( $id, [ 'orderby' => 'post_title', 'order' => 'ASC' ] ); ?>
			<li class="has-submenu dropdown">
				<button id="reviews-nav-btn" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reviews</button>
				<section class="submenu" aria-labelledby="reviews-nav-btn">
					<ol>
					<?php foreach ( $products as $product ): ?>
						<li><a href="<?php echo get_permalink( $product->ID ); ?>"><?php echo $product->post_title; ?></a></li>
					<?php endforeach; ?>
					</ol>
				</section>
			</li> -->

			<?php if ( $modal_image ): ?>
				<div class="review-nav-mag">
					<button id="modal-capture-btn" class="modal-capture-btn class-<?php 
					$catslug = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( $id );
					echo $catslug;
					?>">
						<img alt="Review guide featured image" src="<?php echo esc_attr( $modal_image['sizes'][ 'p1' ] ); ?>" />
						<?php echo esc_attr( $modal_text ); ?>
					</button>
				</div>
			<?php endif; ?>

			<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_review() ): ?>
				<div class="review-nav-btns visible-xs-block">
					<button id="show-filters-btn" type="button" class="show-filters-btn btn btn-default" aria-haspopup="true" aria-expanded="false">Filter</button>
					<button id="show-sort-btn" type="button" class="show-sort-btn btn btn-default" aria-haspopup="true" aria-expanded="false">Sort</button>
				</div><!-- .review-nav-btns -->
			<?php endif; ?>

		</nav>
	</header>
</div>