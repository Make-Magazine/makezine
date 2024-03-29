<h3><?php _e( 'Refine your selection', 'quick-featured-images-pro' ); ?></h3>
<?php
// display selected filters
if ( $this->selected_filters ) {
?>
<form method="post" action="<?php echo esc_url( admin_url( sprintf( 'admin.php?page=%s&amp;step=confirm', $this->page_slug ) ) ); ?>">
	<fieldset>
		<legend><span><?php _e( 'Refine filters', 'quick-featured-images-pro' ); ?></span></legend>
		<p><?php _e( 'Now you can find posts and pages by matching parameters. Refine them here.', 'quick-featured-images-pro' ); ?></p>
		<p><?php _e( 'Whatever you do: You can confirm your choice on the next page.', 'quick-featured-images-pro' ); ?></p>
<?php
	foreach ( $this->selected_filters as $filter ) {
		$filename = $filter . '.php';
		if ( file_exists( dirname( __FILE__ ) . '/' . $filename ) ) {
			include_once( $filename );
		} else {
?>
		<p><?php printf( __( 'File %s is not available.', 'quick-featured-images-pro' ), $filename ); ?></p>
<?php
		}
?>
	<input type="hidden" name="filters[]" value="<?php echo $filter; ?>" />
<?php
	}
?>
	</fieldset>
	<p>
<?php
// remember selected options if there are some
if ( $this->selected_options ) {
	foreach ( $this->selected_options as $v ) {
?>
		<input type="hidden" name="options[]" value="<?php echo $v; ?>" />
<?php
	}
}
// remember selected approach if there is one
if ( $this->selected_approach ) {
?>
		<input type="hidden" name="approach" value="<?php echo $this->selected_approach; ?>" />
<?php 
}
// remember selected multiple images if there are some
if ( $this->selected_multiple_image_ids ) {
	$v = implode( ',', $this->selected_multiple_image_ids );
?>
		<input type="hidden" name="multiple_image_ids" value="<?php echo $v; ?>" />
<?php
}
?>
		<input type="hidden" name="image_id" value="<?php echo $this->selected_image_id; ?>" />
		<input type="hidden" name="action" value="<?php echo $this->selected_action; ?>" />
		<?php wp_nonce_field( 'quickfi_refine', $this->plugin_slug . '_nonce' ); ?>
		<input type="submit" class="button" value="<?php _e( 'Preview filtering', 'quick-featured-images-pro' ); ?>" />
	</p>
</form>
<?php
} else {
?>
	<p><?php _e( 'There are no selected filters. Modify your filter selection or just go on by clicking on the next button.', 'quick-featured-images-pro' ); ?></p>
<?php
}// if() 
?>
