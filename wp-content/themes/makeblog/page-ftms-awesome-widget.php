<?php
/**
 * @package MakeZine
 * Template Name: FtMS - Awesome Widget
 */
?>

<?php
	
	$the_query = new WP_Query( 'post_type=from-the-maker-shed&posts_per_page=1' );

	while ( $the_query->have_posts() ) : $the_query->the_post();
		$ftms_link = get_post_meta( get_the_ID(), 'ftms_link', true ); 
		if( ! $ftms_link ){
			$ftms_link = 'http://www.makershed.com/';
		}
		echo '<a href="'. esc_url( $ftms_link ).'">';
		the_post_thumbnail('ftms-thumb');
		echo '</a>';
	endwhile;

	// Reset Post Data
	wp_reset_postdata();

?>
