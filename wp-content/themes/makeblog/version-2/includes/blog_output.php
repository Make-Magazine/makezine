<?php
function story_pulling($offset) {
	$outputs     = '';
	$post_counter = 1;
	$large_indicator = 0;
	$post_per_page = 26;
	$arguments   = array(
		'post_type'      => 'post',
		'posts_per_page' => $post_per_page,
		'post_status'    => 'publish',
		'offset'         => $offset,
	);
	$query       = new WP_Query( $arguments );
	$post_weight = 0;
	$row_weight  = 0;
	while ( $query->have_posts() )  :
		$query->the_post();
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
			$bootstrap_class = 'col-md-6 col-sm-12 col-xs-12 large-card ';
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

		$post_video = get_post_meta($post_id, 'ga_youtube_embed');
		$post_flag = get_post_meta($post_id, 'flag_taxonomy');
		$outputs .= '<div class="wrapper-story-link"><a href="' . get_the_permalink() . '" class="story-link"></a></div>';

		$outputs .= '<div class="filter-display-wrapper">';
		if (!empty($post_video[0])) {
			$outputs .= '<div class="red-box-category is-videoblock">';
		} else {
			$outputs .= '<div class="red-box-category">';
		}
		$red_cat_name = '';
		$cat_link = '';
		if ('post' == get_post_type()) {
			$post_display_category = get_post_meta($post_id, 'display_category');
			if (!empty($post_display_category[0])) {
				$red_cat_name = get_tag(intval($post_display_category[0]))->name;
				$cat_link = get_tag_link($post_display_category[0]);
			} else {
				if ($the_tags = get_the_tags()) {
					$the_tag = $the_tags[0];
					$red_cat_name = $the_tag->name;
					$cat_link = get_tag_link($the_tag->term_id);
				}
			}
		} elseif (!empty($post_flag[0])) {
			$red_cat_name = get_cat_name(intval($post_flag[0]));
			$cat_link = get_category_link($post_flag[0]) . '';
		} else {
			$post_categories = get_the_category();
			foreach ($post_categories as $post_category) {
				if (!empty($current_cat_id)) {
					if ($post_category->parent == $current_cat_id) {
						$child_cat[] = $post_category->name;
					}
				} else {
					if ($post_category->category_parent == 0) {
						$parent_cat[] = $post_category->name;
						$parent_id[] = $post_category->term_id;
					}
				}
			}

			if (!empty($current_cat_id)) {
				$child_cat_length = count($child_cat);
				$child_cat_length--;
				$random_cat_number = rand(0, $child_cat_length);
				if ($child_cat_length >= 0) {
					$red_cat_name = $child_cat[$random_cat_number];
				} else {
					$red_cat_name = '';
				}
			} else {
				$parent_cat_length = count($parent_cat);
				$parent_cat_length--;
				$random_cat_number = rand(0, $parent_cat_length);
				$red_cat_name = $parent_cat[$random_cat_number];
				$cat_link = get_category_link($parent_id[$random_cat_number]) . '';
			}
		}
		$red_cat_name = htmlspecialchars_decode($red_cat_name);
    $cat_length = iconv_strlen($red_cat_name, 'UTF-8');
    if ($cat_length > 13) {
      $red_cat_name = substr($red_cat_name, 0, 13) . '...';
    }

		if (!empty($red_cat_name)) {
			$outputs .= '<a href="';
			$outputs .= $cat_link;
			$outputs .= '">';
			$outputs .= $red_cat_name;
			$outputs .= '</a>';
		}
		if (!empty($post_video[0])) {
			$outputs .= '<div class="videoblock"><a href="' . get_the_permalink() . '">';
			$outputs .= '<span class="video fa fa-video-camera"></span>';
			$outputs .= '</a></div>';
		}
		$outputs .= '</div>';
		$outputs .= '</div>';
		$outputs .= '<div class="img-wrapper"><img src = "' . $photon . '" alt = "thumbnail" ></div>';

		$outputs .= '<div class="about-post">';
		if(get_field("sponsored_content_label")) {
			$outputs .= '<span class="sponsored-title-tag">SPONSORED BY ' . get_field("sponsored_content_label") . '</span>';
		}
		$outputs .= '<h2 class="title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
		$outputs .= '<p class="publish-date"><a href="' . get_the_permalink() . '">' . get_the_time( "F d, Y" ) . '</a></p>';
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

	$ie6 = (preg_match("/MSIE\s(?P<v>\d+)/i", $_SERVER["HTTP_USER_AGENT"]) ? true : false);
	$ie7 = (preg_match("/(Trident\/(\d{2,}|7|8|9)(.*)rv:(\d{2,}))/", $_SERVER["HTTP_USER_AGENT"]) ? true : false);
	$ie8 = (preg_match("/Edge/i", $_SERVER["HTTP_USER_AGENT"]) ? true : false);

	if ($ie6 || $ie7 || $ie8) {
		$ie = ' ie ';
	} else {
		$ie = '';
	}

	$outputs .= '<p id="blog-load-posts" class="row load-more-posts' . $ie .'" data-offset="'. $offset .'" data-ppp="'.$post_per_page.'" "><a href="javascript:void(0);">Show more</a><i class="fa fa-spinner fa-pulse more-button-spinner"></i></p>';
	echo $outputs;
}

/**
 * After press more button
 */
function blog_output_with_ajax() {
	$offset = $_POST['offset'];
	story_pulling($offset);

	die();
}
add_action('wp_ajax_blog_output_with_ajax', 'blog_output_with_ajax');
add_action('wp_ajax_nopriv_blog_output_with_ajax', 'blog_output_with_ajax');
