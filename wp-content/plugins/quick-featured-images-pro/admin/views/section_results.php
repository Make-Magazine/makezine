<h3><?php _e( 'Results of the action', 'quick-featured-images-pro' ); ?></h3>
<?php
if ( $results ) {
	// translate once for multiple usage and improve performance
	$label_details 	  = __( 'Details', 'quick-featured-images-pro' );
	$label_current_fi = __( 'Current Featured Image', 'quick-featured-images-pro' );
	$label_number 	  = __( 'No.', 'quick-featured-images-pro' );
	$label_changed 	  = __( 'Changed successfully', 'quick-featured-images-pro' );
	$label_unchanged  = sprintf( '<span class="failure">%s</span>', __( 'Unchanged', 'quick-featured-images-pro' ) );
	$label_removed 	  = __( 'Image removed successfully from post', 'quick-featured-images-pro' );
	$label_unremoved  = sprintf( '<span class="failure">%s</span>', __( 'Image not removed from post', 'quick-featured-images-pro' ) );
	// WP core labels
	$text 			  = 'No image set';
	$label_no_image   = __( $text );
	$text             = '(no title)';
	$default_title    = __( $text );
?> 
<p><?php _e( 'The list is in alphabetical order according to post title. You can edit a post in a new window by clicking on its link in the list.', 'quick-featured-images-pro' ); ?></p>
<table class="widefat">
	<thead>
		<tr>
			<th class="num"><?php echo $label_number; ?></th>
			<th><?php echo $label_details; ?></th>
			<th class="num"><?php echo $label_current_fi; ?></th>
		</tr>
	</thead>
	<tbody>
<?php
	$c = 1;
	foreach ( $results as $result ) {
		// post title, else default title
		$post_title = $result[ 1 ] ? $result[ 1 ] : $default_title;
		// check if no featured image for the post, else add default
		$img = $result[ 2 ] ? $result[ 2 ] : $label_no_image;
		// get the result message per post
		$msg = $result[ 3 ] ? $label_changed : $label_unchanged;
		// get notice about removal of first embedded image
		if ( isset( $result[ 4 ] ) ) {
			$msg .= '<br />';
			$msg .= $result[ 4 ] ? $label_removed : $label_unremoved;
		}
		// alternating row colors with error class if error
		$row_classes = $result[ 3 ] ? '' : 'qfi-failure';
		if ( 0 != $c % 2 ) { // if $c is divisible by 2 (so the modulo is 0)
			$row_classes .= $row_classes ? ' alternate' : 'alternate';
		}
		if ( $row_classes ) {
			$row_classes = ' class="' . $row_classes . '"';
		}
		// print the table row
		printf( '<tr%s>', $row_classes );
		printf( '<td class="num">%d</td>', $c );
		printf( 
			'<td><a href="%s" target="_blank">%s</a><br>%s</td>', 
			$result[ 0 ], // edit post link
			$post_title,
			$msg
		);
		printf( '<td class="num">%s</td>', $img );
		print "</tr>\n";
		// increase counter
		$c++;
	}
?>
	</tbody>
	<tfoot>
		<tr>
			<th class="num"><?php echo $label_number; ?></th>
			<th><?php echo $label_details; ?></th>
			<th class="num"><?php echo $label_current_fi; ?></th>
		</tr>
	</tfoot>
</table>
<?php 
} else { 
?>
<p><?php _e( 'No matches found.', 'quick-featured-images-pro' ); ?></p>
<?php 
}
?>
<p><a class="button" href="<?php echo esc_url( admin_url( sprintf( 'admin.php?page=%s', $this->page_slug ) ) );?>"><?php _e( 'Start again', 'quick-featured-images-pro' );?></a></p>
<h3><?php _e( 'Do you like the plugin?', 'quick-featured-images-pro' ); ?></h3>
<p><a href="http://www.quickfeaturedimages.com<?php _e( '/reviews/', 'quick-featured-images-pro' ); ?>"><?php _e( 'Please rate it at quickfeaturedimages.com!', 'quick-featured-images-pro' ); ?></a></p>
