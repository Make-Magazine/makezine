<?php
/**
 * @param int $offset
 * @param $tag
 *
 * Tag archive pulling logic
 *
 * @return string
 */
function tags_pulling($offset=0, $tag) {
	$outputs     = '';
	$post_counter = 1;
	$large_indicator = 0;
	$post_per_page = 26;
	$arguments   = array(
		'post_type'      => array('post','page','projects','reviews'),
		'posts_per_page' => $post_per_page,
		'post_status'    => 'publish',
		'offset'         => $offset,
		'tag'            => $tag
	);
	$query       = new WP_Query( $arguments );
	$post_weight = 0;
	$row_weight  = 0;
	while ( $query->have_posts() )  :
		$query->the_post();

		/**
		 * Set what position should have large card
		 */
		switch ( $post_counter ) {
			case 1:
				$large_indicator = 1;
				break;
			case 5:
				$large_indicator = 1;
				break;
			case 9:
				$large_indicator = 1;
				break;
			case 14:
				$large_indicator = 1;
				break;
			case 18:
				$large_indicator = 1;
				break;
			case 22:
				$large_indicator = 1;
				break;
			default:
				$large_indicator = 0;
		}


		$post_id      = get_the_ID();
		$type_array   = get_post_meta( $post_id, 'story_type' );
		$story_type[] = $type_array[0];

		if ( $large_indicator == 1 ) {
			$post_weight     = 2;
			$bootstrap_class = 'col-md-6 col-sm-12 col-xs-12 large-card';
			$args            = array(
				'resize' => '397,374',
				'quality' => get_photon_img_quality(),
				'strip' => 'all',
			);
		} else {
			$post_weight     = 1;
			$bootstrap_class = 'col-md-3 col-sm-6 col-xs-12 small-card';
			$args            = array(
				'resize' => '397,374',
				'quality' => get_photon_img_quality(),
				'strip' => 'all',
			);
		}
		$row_weight = $row_weight + $post_weight;
		if ( $row_weight > 4 ) {
			$outputs .= '</div></li>';
			$outputs .= '<li class="row"><div class="post">';
			$row_weight = $post_weight;
		}
		$outputs .= '<div class="post-wrapper ' . $bootstrap_class . '">';
		/**
		 * Get image from photon module
		 */
		$url = wp_get_attachment_image( get_post_thumbnail_id( $post_id ), 'project-thumb' );
		$re  = "/^(.*? src=\")(.*?)(\".*)$/m";
		preg_match_all( $re, $url, $matches );
		$str    = $matches[2][0];
		$photon = jetpack_photon_url( $str, $args );
		if(strlen($url) == 0){
			$photon = catch_first_image_tags();
			$photon = jetpack_photon_url( $photon, $args );
		}
		if ( $large_indicator == 1 ) {
			$outputs .= '<div class="gradient-wrapper">';
			$outputs .= '<div class="gradient_animation">';
			$outputs .= '<a href="' . get_the_permalink() . '"></a>';
			$outputs .= '</div>';
			$outputs .= '<div class="final_gradient">';
			$outputs .= '<a href="' . get_the_permalink() . '"></a>';
			$outputs .= '</div>';
		}
		$outputs .= '<div class="wrapp">';
		$outputs .= '<div class="wrapper-story-link"><a href="' . get_the_permalink() . '" class="story-link"></a></div>';
		$outputs .= '<div class="img-wrapper"><img src = "' . $photon . '" alt = "thumbnail" ></div>';

		$outputs .= '<div class="about-post">';
		if(get_field("sponsored_content_label")) {
			$outputs .= '<span class="sponsored-title-tag">SPONSORED BY ' . get_field("sponsored_content_label") . '</span>';
		}
		$outputs .= '<h2 class="title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
	   if($tag !=  "guides") {
			$outputs .= '<p class="publish-date"><a href="' . get_the_permalink() . '">' . get_the_time( "F d, Y" ) . '</a></p>';
		}
		$outputs .= '</div>';
		$outputs .= '</div>';
		if ( $large_indicator == 1 ) {
			$outputs .= '</div>';
		}
		$outputs .= '</div>';
		$post_counter++;
	endwhile;
	do_action( 'custom_page_hook', $query );
	wp_reset_query();
	$outputs .= '<div class="row infinity-row"></div>';
	$offset = $offset + $post_per_page;
	/**
	 * Check IE for different style more button
	 */
	$ie6 = (preg_match("/MSIE/", $_SERVER["HTTP_USER_AGENT"]) ? true : false);
	$ie7 = (preg_match("/Trident/", $_SERVER["HTTP_USER_AGENT"]) ? true : false);
	$ie8 = (preg_match("/Edge/", $_SERVER["HTTP_USER_AGENT"]) ? true : false);

	if ($ie6 || $ie7 || $ie8) {
		$ie = ' ie ';
	} else {
		$ie = '';
	}
	if ( $post_counter > $post_per_page) {
		$outputs .= '<p id="tag-load-posts" class="row load-more-posts'. $ie .'" data-offset="'. $offset .'" data-ppp="'.$post_per_page.'" "><a href="javascript:void(0);">Show more</a><i class="fa fa-spinner fa-pulse more-button-spinner"></i></p>';
	}
	echo $outputs;
}
function tag_output_with_ajax() {
	$offset = $_POST['offset'];
	$current_slug = $_POST['slug'];
	tags_pulling($offset, $current_slug);
	die();
}
add_action('wp_ajax_tag_output_with_ajax', 'tag_output_with_ajax');
add_action('wp_ajax_nopriv_tag_output_with_ajax', 'tag_output_with_ajax');