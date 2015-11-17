<?php

$content = get_field( 'why_to_buy' );
$link    = get_field( 'buy_link' );

if ( ! empty( $content ) ): ?>

	<h4>Why To Buy</h4>

	<?php echo $content;

	if ( ! empty( $link ) ): ?>

		<a class="btn-buy" target="_blank"  href="<?php echo esc_url( $link ); ?>">Buy It Now</a>

	<?php endif;
endif;
