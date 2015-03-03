<?php
/*
Template Name: House Ads
*/
?>

<div class="biggins">

	<?php
		
		$ad_query = new WP_Query( array(
			'post_type' => 'house-ads',
			'posts_per_page' => 20,
			'fields' => 'ids',
			'no_found_rows' => true,
		) );
		$ad_ids = $ad_query->get_posts();

		if ( ! empty( $ad_ids ) ) :
			shuffle( $ad_ids );
			$ad_id = array_shift( $ad_ids );
			$post = get_post( $ad_id );

			if ( $post ) : setup_postdata( $post );
				echo '<a href="'. esc_url( get_post_meta( $post->ID, 'LinkURL', true ) ).'">';
				the_post_thumbnail('house-ad');
				echo '</a>';
			endif;
		endif;

		// Reset Post Data
		wp_reset_postdata();

	?>

</div>