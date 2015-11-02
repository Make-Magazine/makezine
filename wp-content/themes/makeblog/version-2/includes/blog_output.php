<?php
function story_pulling($offset=0) {
	$outputs     = '';
	$post_per_page = 0;
	$arg = array(
		'post_type'      => 'post',
		'posts_per_page' => 32,
		'post_status'    => 'publish',
		'offset'         => $offset,
	);
	$query       = new WP_Query( $arg );
	$post_weight = 0;
	$row_weight  = 0;
	$row_count   = 0;
	while ( $query->have_posts() )  :
		$query->the_post();

		$post_id      = get_the_ID();
		$type_array   = get_post_meta( $post_id, 'story_type' );
		$story_type[] = $type_array[0];

		if ( ( $type_array[0] == 'News & Features' ) or ( $type_array[0] == 'Skill Builders' ) or ( $type_array[0] == 'Reviews' ) ) {
			$post_weight     = 2;
		} else {
			$post_weight     = 1;
		}
		$row_weight = $row_weight + $post_weight;
		$post_per_page++;
		if ( $row_weight > 4 ) {
			$row_weight = $post_weight;
			$row_count++;
		}
		if ($row_count == 8) {
			$post_per_page--;
			break;
		}
	endwhile;
	do_action( 'custom_page_hook', $query );
	wp_reset_query();



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
		$post_id      = get_the_ID();
		$type_array   = get_post_meta( $post_id, 'story_type' );
		$story_type[] = $type_array[0];
		if ( ( $type_array[0] == 'News & Features' ) or ( $type_array[0] == 'Skill Builders' ) or ( $type_array[0] == 'Reviews' ) ) {
			$post_weight     = 2;
			$bootstrap_class = 'col-lg-6 col-md-6 col-sm-8 col-xs-12 large-card';
			$args            = array(
				'resize' => '397,374',
			);
		} else {
			$post_weight     = 1;
			$bootstrap_class = 'col-lg-3 col-md-3 col-sm-4 col-xs-12 small-card';
			$args            = array(
				'resize' => '192,187',
			);
		}
		$row_weight = $row_weight + $post_weight;
		if ( $row_weight > 4 ) {
			$outputs .= '</li>';
			$outputs .= '<li class="row post">';
			$row_weight = $post_weight;
		}
		$outputs .= '<div class="post-wrapper ' . $bootstrap_class . '">';
		$url = wp_get_attachment_image( get_post_thumbnail_id( $post_id ), 'project-thumb' );
		$re  = "/^(.*? src=\")(.*?)(\".*)$/m";
		preg_match_all( $re, $url, $matches );
		$str    = $matches[2][0];
		$photon = jetpack_photon_url( $str, $args );
		if ( ( $type_array[0] == "News & Features" ) or ( $type_array[0] == "Skill Builders" ) or ( $type_array[0] == "Reviews" ) ) {
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
		$outputs .= '<div class="filter-display-wrapper">';
		$outputs .= '<div class="red-box-category">';

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
			$outputs .= '<p><a href="';
			$outputs .= $cat_link;
			$outputs .= '">#  ';
			$outputs .= $red_cat_name;
			$outputs .= '</a></p>';
		}
		if (!empty($post_video[0])) {
			$outputs .= '<div class="videoblock">';
			$outputs .= '<span class="video fa fa-video-camera"></span>';
			$outputs .= '</div>';
		}
		$outputs .= '</div>';
		$outputs .= '</div>';
		$outputs .= '<a href="' . get_the_permalink() . '" class="story-link"></a>';
		$outputs .= '<img src = "' . $photon . '" alt = "thumbnail" >';

		$outputs .= '<div class="about-post">';
		$outputs .= '<p class="story-type" ><a href="' . get_the_permalink() . '">' . $type_array[0] . '</a></p>';
		$outputs .= '<h2 class="title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
		$outputs .= '<p class="publish-date"><a href="' . get_the_permalink() . '">' . get_the_time( "F d, Y" ) . '</a></p>';
		$outputs .= '</div>';
		$outputs .= '</div>';
		if ( ( $type_array[0] == 'News & Features' ) or ( $type_array[0] == 'Skill Builders' ) or ( $type_array[0] == 'Reviews' ) ) {
			$outputs .= '</div>';
		}
		$outputs .= '</div>';
	endwhile;
	do_action( 'custom_page_hook', $query );
	wp_reset_query();
	$offset = $offset + $post_per_page;
	$outputs .= '<p id="blog-load-posts" class="row" data-offset="'. $offset .'" data-ppp="'.$post_per_page.'"><a href="javascript:void(0);">More</a><i class="fa fa-spinner fa-pulse more-button-spinner"></i></p>';
	return $outputs;
}
