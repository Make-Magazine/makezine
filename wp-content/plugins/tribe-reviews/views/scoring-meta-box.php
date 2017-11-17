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
echo '<th>Score Percent</th>';
echo '</tr>';

foreach ( $products as $product ) {
	echo '<tr>';
	echo sprintf( '<td>%s</td>', esc_html( $product->post_title ) );

	$p2p_id = $wpdb->get_var( $wpdb->prepare( "Select p2p_id from $wpdb->p2p where p2p_from = %d and p2p_to = %d", $product->ID, get_the_ID() ) );
	$total = 0;
	$i = 0;
	$ilen = count( $criterias );
	foreach ( $criterias as $criteria ) {
		$criteria = sanitize_title( array_shift( $criteria ) );
		//$criteria = array_pop( $criteria );
		$value    = p2p_get_meta( $p2p_id, $criteria, true );
		
    if( ++$i == $ilen ) {
			echo sprintf( '<td align="center" valign="middle"><input class="single_score_field single_score_percent" type="text" value="%s" name="scores[%d][%s]" size="2"/></td>',
				abs( $value ), esc_attr( $product->ID ), esc_attr( $criteria ) );
			$totalPossible = abs( $value );
    } else {
    	$total 	+= abs( $value );
	 		echo sprintf( '<td align="center" valign="middle"><input class="single_score_field" type="text" value="%s" name="scores[%d][%s]" size="2"/></td>',
				abs( $value ), esc_attr( $product->ID ), esc_attr( $criteria ) );
    }
	}
	$percentage = round(($total / $totalPossible) * 100);
	echo '<td><span class="total_score_label">' . $percentage . '%</span></td>';

	echo '</tr>';
}


echo '</table>';
