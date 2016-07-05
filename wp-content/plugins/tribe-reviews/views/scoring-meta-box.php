<?php
global $wpdb;

echo sprintf( '<input type="hidden" name="scoring_nonce" value="%s">', $nonce );

echo '<table>';

echo '<tr>';
echo '<th width="20%">Product</th>';

foreach ( $criterias as $criteria ) {
	$criteria = array_shift( $criteria );
	echo sprintf( '<th width="%d%%">%s</th>', 80 / count( $criterias ), esc_html( $criteria ) );
}
echo '<th>Total</th>';
echo '</tr>';


foreach ( $products as $product ) {
	echo '<tr>';
	echo sprintf( '<td>%s</td>', esc_html( $product->post_title ) );

	$p2p_id = $wpdb->get_var( $wpdb->prepare( "Select p2p_id from $wpdb->p2p where p2p_from = %d and p2p_to = %d", $product->ID, get_the_ID() ) );
	$total = 0;
	foreach ( $criterias as $criteria ) {
		$criteria = sanitize_title( array_shift( $criteria ) );
		$value    = p2p_get_meta( $p2p_id, $criteria, true );
		$total += abs( $value );
		echo sprintf( '<td align="center" valign="middle"><input class="single_score_field" type="text" value="%s" name="scores[%d][%s]" size="2"/></td>',
			abs( $value ), esc_attr( $product->ID ), esc_attr( $criteria ) );
	}
	echo '<td><span class="total_score_label">' . $total . '</span></td>';

	echo '</tr>';
}


echo '</table>';
