<?php

$content = get_field( 'pro_tips' );

if ( ! empty( $content ) ): ?>

	<h4>Pro Tips</h4>

	<?php echo $content; ?>

<?php endif;
