<h4><?php echo $this->valid_filters[ 'filter_post_types' ]; ?></h4>
<p><?php _e( 'Select post types', 'quick-featured-images-pro' ); ?>. <?php _e( 'You can select posts, pages and available custom posts types.', 'quick-featured-images-pro' ); ?></p>
<p>
<?php
$labeled_custom_post_types = $this->get_custom_post_types_labels();

foreach ( $this->valid_post_types as $key => $label ) {
?>
	<input type="checkbox" id="<?php printf( 'qfi_%s', $key ); ?>" name="post_types[]" value="<?php echo $key; ?>"  <?php checked( in_array( $key, $this->selected_post_types ) ); ?> />
	<label for="<?php printf( 'qfi_%s', $key ); ?>"><?php echo $label; ?></label><br />
<?php
}
if ( $this->valid_custom_post_types ) {
	foreach ( $this->valid_custom_post_types as $type ) {
?>
	<input type="checkbox" id="<?php printf( 'qfi_%s', $type ); ?>" name="custom_post_types[]" value="<?php echo $type; ?>" <?php checked( in_array( $type, $this->selected_custom_post_types ) ); ?> />
	<label for="<?php printf( 'qfi_%s', $type ); ?>"><?php echo $labeled_custom_post_types[ $type ]; ?></label><br />
<?php
	}
} else {
?>
</p>
<p>
<?php
	_e( 'There are no custom post types.', 'quick-featured-images-pro' );
}
?>
</p>
