<?php

$image       = get_field( 'scores_image' );
$parent_link = '';

if ( function_exists( 'Reviews' ) ) {

	$container = Reviews()->container();
	$parent    = $container['Relationships']->get_review_for_product( get_the_ID() );

	if ( ! empty( $parent ) ) {
		$parent      = array_shift( $parent );
		$parent_link = get_permalink( $parent->ID );
	}
}

if ( ! empty( $image ) ): ?>

	<h4>How this scored</h4>
	<img class="product-scores" src="<?php echo esc_attr( $image['url'] ); ?>" alt="Scores"/>
	<p><a href="<?php echo esc_url( $parent_link ); ?>">See all the Scores</a></p>

<?php endif; ?>



